<?php 

namespace App\Controllers;

class PagesController {

	public function home() {

		return redirect('reservations');

	}
}