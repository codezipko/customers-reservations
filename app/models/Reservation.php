<?php 

namespace App\Models;

use App\Core\App;


class Reservation
{

	public $arguments = [];
	public $laterDate = [];

	public function usersToArray()
	{

		$users = App::get('database')
			->selectAll(
				'register_at, created_at',
				'reservation'
		);

		foreach($users as $user) {
			$this->arguments[] = strtotime($user->created_at);
			$this->laterDate[] = date("Y-m-d H:i", strtotime($user->created_at));
		}

		return $this;
	}	

	public function removeCookie()
	{
		unset($_COOKIE['user_reservation']);
		setcookie('user_reservation', null, -1, '/');

		return $this;
	}

	public function cancelReservation($id, $cookie_name)
	{
		$user = App::get('database')->authUser('*', 'reservation', $id, $cookie_name);
		
		$userVisited = App::get('database')->getByName('*', 'visited_customers', strtolower($user['firstname']));

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

	public function incrementVisited($visited, $firstname)
	{
		return App::get('database')
				->updateVisitors(
					'visited_customers', 
					$visited + 1, 
					$firstname
		);
	}

	public function createVisited($lowerUsername)
	{
		$visited = 1;
		return App::get('database')->insert('visited_customers', [
				'firstname'		=> $lowerUsername,
				'visited'		=> $visited,
				'created_at'	=> date("Y-m-d H:i")
		]);
	}	

	public function userCookie($firstname)
	{
		return setcookie("user_reservation", strtolower($firstname), time() + 100000, "/");
	}		

}