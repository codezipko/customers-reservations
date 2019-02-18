<?php

$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');

$router->get('users', 'UsersController@index');
$router->post('users-create', 'UsersController@store');
$router->post('users', 'UsersController@login');

$router->get('dashboard', 'UsersController@dashboard');
$router->post('logout', 'UsersController@logout');
$router->get('addReservation', 'UsersController@create');
$router->post('createReservation', 'UsersController@addUser');
$router->get('delete', 'UsersController@destroy');

$router->get('reservations', 'ReservationController@index');
$router->post('reservations', 'ReservationController@store');
$router->get('cancel-reservation', 'ReservationController@destroy');