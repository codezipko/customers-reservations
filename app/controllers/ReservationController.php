<?php 

namespace App\Controllers;

use App\Core\App;
use App\Models\Reservation;

class ReservationController
{
	public $reservation;

	public function __construct()
	{
		date_default_timezone_set('Europe/Vilnius');

		$this->reservation = new Reservation;
	}	
	
	public function index()
	{

		$range = range( strtotime("10:00"),strtotime("20:00"),15*60 );

		$arg = $this->reservation->usersToArray()->arguments;

		$laterDate = $this->reservation->usersToArray()->laterDate;
		

		if(isset($_COOKIE['user_reservation'])) {

			$readyToCook = App::get('database')->getCookieReservation('*', 'reservation', $_COOKIE['user_reservation']);

		} else {

			$readyToCook = null;

		}

		if(date("Y-m-d H:i:s") >= $readyToCook['created_at'])
		{
			$this->reservation->removeCookie();
		}

		return view('reservation', compact(
			'range', 
			'reserv', 
			'arg',
			'laterDate',
			'readyToCook'
		));

	}

	public function destroy()
	{
		$id = $_GET['cancel-reservation'];

		if(isset($_COOKIE['user_reservation'])) {
			$this->reservation->cancelReservation($id, $_COOKIE['user_reservation']);
		}

		return redirect('reservations');
	}	

	public function store()
	{
		
		$pickup_at = date("H:i", $_POST['pickup_at']);

		$created_at = date("Y.m.d H:i", $_POST['pickup_at']);

		if (isset($_POST['date_time']) && $_POST['date_time'] != "") {
			$dateTime = date("Y.m.d", $_POST['date_time']);
			$created_at = $dateTime . ' ' . $pickup_at;
		} else {
			$created_at = date("Y.m.d H:i", $_POST['pickup_at']);
		}

		$this->reservation->userCookie($_POST['firstname']);

		$insert = App::get('database')->insert('reservation', [

			'firstname'		=> $_POST['firstname'],
			'phone'			=> $_POST['phone'],
			'set_cookie'	=> strtolower($_POST['firstname']),
			'register_at'	=> $pickup_at,
			'created_at'	=> $created_at

		]);

		$lowerUsername = strtolower($_POST['firstname']);

		$checkIfexists = App::get('database')
			->getByName(
				'firstname, visited',
				'visited_customers', 
				$lowerUsername
			);

		if($checkIfexists['firstname'] == $lowerUsername) {

			$increment = $this->reservation->incrementVisited($checkIfexists['visited'], $checkIfexists['firstname']);

		} else {

			$increment = $this->reservation->createVisited($lowerUsername);

		}

		return redirect('reservations');
	}	

}