<?php 

namespace App\Controllers;

use App\Core\App;
use App\Models\User;
use App\Models\Pagination;

class UsersController
{
	public $user;

	public $pagination;

	public function __construct()
	{
		session_start();

		date_default_timezone_set('Europe/Vilnius');

		$this->user = new User;
	}	
	
	public function index()
	{

		$users = App::get('database')
			->selectAll('*', 'users');

		if(isset($_SESSION['user_id'])) {

			redirect("dashboard");

		}
		return view('users', compact('users'));

	}

	public function store()
	{

		if($_POST['name'] != "" && $_POST['password'] != "")
		{
			$this->user->storeUser($_POST['name'], $_POST['password']);
		}

		return redirect('users');
	}

	public function login()
	{

		if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

			$this->user->makeAuth($_POST['username'], $_POST['password']);

        }

	}

	public function dashboard()
	{
		$date = "";
		$name = "";

		$user_check = $_SESSION['user_id'];

		$check = App::get('database')
			->authUser('*', 'users', $user_check);
	   
		$loginUser = $check['name'];

		if($this->user->getId($user_check)) {

			return redirect('users');

		}

		if(isset($_GET['search'])) {

			$date = $this->user->searchTommorow($date);

		}

		if(isset($_GET['search_submit'])) {

			$date = $this->user->searchSubmit($_GET['search_date']);

		}

		$this->pagination = new Pagination($date);

		$reservation = $this->user->getReservation($date);

		$total = $this->pagination->total;

		$limit = $this->pagination->limit;

		if(isset($_GET['search']) || isset($_GET['search_submit'])) {

			$limit = $total;

		}

		if( isset($_GET['search_name']) ) {

			$name = $_GET['search_name'];

			$customer = $this->user->showSearchByName($name);

		}

	    $paginate = $this->pagination->paginate();

	    $pagination = $this->pagination;

		return view('dashboard', compact(
			'loginUser', 
			'total', 
			'paginate',
			'customer', 
			'pagination'
		));
	}	

	public function create()
	{
		$user_check = $_SESSION['user_id'];

		$check = App::get('database')
			->authUser('*', 'users', $user_check);
	   
		$loginUser = $check['name'];

		if($this->user->getId($user_check)) {

			return redirect('users');

		}

		$range = range( strtotime("10:00"),strtotime("20:00"),15*60 );

		return view('add', compact('range'));
	}	

	public function addUser()
	{
		if ( isset($_POST['username_check']) ) {
		  	$username = strtolower($_POST['username']);

		  	$add = App::get('database')->checkUserVisited($username);

		  	if ( $add['visited'] >= 5 ) {

		  	  echo "have_discount";	

		  	} else if( $add['firstname'] != $username ) {

		  		echo "no_user";

		  	} else {

		  	  echo 'no_discount';

		  	}
		  	exit();
		}

		if(isset($_POST['exists_date'])) {

			$dateTime = $_POST['pick_date'] . ' ' . $_POST['choose_time'] . ':00';

			$getDatabaseDate = App::get('database')->checkExistsDate($dateTime);

			$finishDate = $_POST['pick_date'] . ' ' . $_POST['choose_time'];

			if($getDatabaseDate['created_at'] == $dateTime || date("Y-m-d H:i") >= $finishDate) {

				echo 'time_already_exists';

			} else { 

				echo 'time_free';

			}
			exit();
		}

		if(isset($_POST['save'])) {

			$phone = $_POST['phone'];

			$pickup_at = date("H:i", $_POST['choose_time']);

			$pick_date = date("Y.m.d", $_POST['pick_date']);

			$created_at = $_POST['pick_date'] . ' ' . $_POST['choose_time'];

			$checkIfexists = App::get('database')
				->getByName(
					'firstname, visited',
					'visited_customers', 
					strtolower($_POST['username'])
				);

			$toReservation = $this->user->createReservation(
				$_POST['username'], 
				$phone, 
				$_POST['choose_time'], 
				$created_at
			);

			if($checkIfexists['firstname'] == strtolower($_POST['username'])) {

				$increment = $this->user
					->incrementVisited(
						$checkIfexists['visited'], 
						$checkIfexists['firstname']
					);

			} else {

			$increment = $this->user->createVisited($_POST['username']);

				echo 'Saved';
				exit();
			}

		}
	}	

	public function destroy()
	{
		$id = $_GET['delete'];
	
		$cancel = $this->user->cancelReservartion($id);

		return redirect('dashboard');
	}	

	public function logout()
	{
		if(session_destroy()) {
	      	return redirect('users');
	    } else {
	    	return;
	    }
	}	

}