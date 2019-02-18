<?php 

namespace App\Models;

use App\Core\App;


class User
{
	public function getId($userId)
	{
		if(is_null($userId)) {
			return true;
		}
		return false;
	}	

	public function storeUser($username, $password)
	{
		return App::get('database')->insert('users', [

			'name'			=> $username,
			'password'		=> base64_encode($password),
			'created_at'	=> date("Y-m-d H:i:s")

		]);
	}	

	public function makeAuth($username, $password)
	{
		
		$check = App::get('database')
				->checkLogin(
					'*', 
					'users', 
					$username, 
					base64_encode($password)
				);
				
        if ($username == $check['name'] && base64_encode($password) == $check['password']) {
        
        	$_SESSION["user_id"] = $check['id'];

        		return redirect('dashboard');

        } else {
            return redirect('users');
        }
	}	

	public function getReservation($date = null)
	{
		return App::get('database')
		->selectByDates(
			'reservation.id, reservation.firstname, reservation.phone, reservation.created_at, visited_customers.visited', 
			'reservation', 
			$date
		);
	}	

	public function showSearchByName($name)
	{
		$customer = App::get('database')->searchByName(
			'visited_customers.firstname, visited_customers.visited, reservation.id, reservation.phone, reservation.created_at',
			'visited_customers', 
			'reservation', 
			$name
		);
		
		if(Strtolower($name) != $customer['firstname']) {
			return false;
		}

		return $customer;
	}

	public function cancelReservartion($id)
	{
		$user = App::get('database')->authUser('*', 'reservation', $id);
		
		$userVisited = App::get('database')->getByName('*', 'visited_customers', strtolower($user['firstname']));

		if( isset($id) ) {
			$delete = App::get('database')->delete($id);
			if($user['id'] == $id) {
				$descrement = App::get('database')
				->updateVisitors(
					'visited_customers', 
					$userVisited['visited'] - 1, 
					$userVisited['firstname']
				);
			}

		}
	}

	public function incrementVisited($visited, $username)
	{
		if($visited >= 5) {
			$visited = 0;
		}
		return App::get('database')
			->updateVisitors(
				'visited_customers', 
				$visited + 1, 
				$username
			);
	}		

	public function createVisited($username)
	{
		return App::get('database')->insert('visited_customers', [
			'firstname'		=> strtolower($username),
			'visited'		=> 1,
			'created_at'	=> date("Y-m-d H:i")
		]);
	}	

	public function createReservation($username, $phone, $register_at, $created_at)
	{
		return App::get('database')->insert('reservation', [
			'firstname'		=> $username,
			'set_cookie'	=> null,
			'phone'			=> $phone,
			'register_at'	=> $register_at,
			'created_at'	=> $created_at
			]);
	}

	public function searchTommorow($date)
	{
		if($_GET['search'] == "tommorow") {
			$date = date("Ymd", strtotime(date("Ymd"). " + 1 days"));
		}
		return $date;
	}	

	public function searchSubmit($submit_date)
	{
		$searchDate = str_replace('-', '', $_GET['search_date']);

		return $searchDate;
	}	

}