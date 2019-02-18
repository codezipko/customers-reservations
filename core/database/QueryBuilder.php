<?php

class QueryBuilder {

	protected $pdo;

	public function __construct(PDO $pdo) {

		$this->pdo = $pdo;

	}

	public function selectAll($arguments = null, $table) {

		$statement = $this->pdo->prepare("SELECT {$arguments} FROM {$table}");

		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_CLASS);

	}

	public function selectByDates($arguments = null, $table, $date = null) {

		if($date == null) {
			$date = "CURDATE()";
		}

		$statement = $this->pdo->prepare("
			SELECT 
			{$arguments} 
			FROM 
			{$table} 
			LEFT JOIN visited_customers 
			ON reservation.firstname = visited_customers.firstname 
			WHERE DATE(reservation.created_at) = {$date} 
			ORDER BY visited_customers.visited DESC
		");

		$statement->execute();

		return $statement->fetchAll(PDO::FETCH_CLASS);

	}

	public function checkLogin($arguments, $table, $name, $password)
	{
		$statement = $this->pdo->prepare("
			SELECT 
			{$arguments} 
			FROM 
			{$table} 
			WHERE name = :name 
			AND password = :password
		");

		$statement->execute(array(
			":name" => $name,
			":password" => $password
		));

		return $statement->fetch(PDO::FETCH_ASSOC);
	}	

	public function authUser($arguments, $table, $user_id)
	{
		$statement = $this->pdo->prepare("SELECT {$arguments} FROM {$table} WHERE id = :id");

		$statement->bindparam(":id", $user_id);

		$statement->execute();

		return $statement->fetch(PDO::FETCH_ASSOC);
	}	
	public function userCanCancel($arguments, $table, $user_id, $cookie_name)
	{
		$statement = $this->pdo->prepare("SELECT {$arguments} FROM {$table} WHERE id = :id AND set_cookie = :set_cookie");

		$statement->bindparam(":id", $user_id);

		$statement->bindparam(":set_cookie", $cookie_name);

		$statement->execute();

		return $statement->fetch(PDO::FETCH_ASSOC);
	}	

	public function getByName($arguments, $table, $username)
	{
		$statement = $this->pdo->prepare("SELECT {$arguments} FROM {$table} WHERE firstname = :firstname");
		$statement->execute(array(
			":firstname"	=> $username
		));
		return $statement->fetch(PDO::FETCH_ASSOC);
	}	

	public function getCookieReservation($arguments, $table, $cookie_name)
	{
		$statement = $this->pdo->prepare("
			SELECT 
			{$arguments} 
			FROM 
			{$table} 
			WHERE set_cookie = :set_cookie 
			ORDER BY created_at DESC
		");

		$statement->execute(array(
			":set_cookie"	=> $cookie_name
		));

		return $statement->fetch(PDO::FETCH_ASSOC);
		
	}	

	public function insert($table, $parameters) {

		$sql = sprintf(
			'insert into %s (%s) values (%s)',
			$table,
			implode(', ', array_keys($parameters)),
			':' . implode(', :', array_keys($parameters))
		);

		try {

		$statement = $this->pdo->prepare($sql);

		$statement->execute($parameters);

		} catch(Exception $e) {

			die('Something wrong... Try again!');

		}
	}

	public function updateVisitors($table, $visited, $username)
	{
		$statement = $this->pdo->prepare("UPDATE {$table} SET visited = :visited WHERE firstname = :firstname");
		$statement->execute(array(
			":visited"		=> $visited,
			":firstname"	=> $username
		));
	}	

	public function countReservation($table, $date = null)
	{
		if($date == null) {
			$date = "CURDATE()";
		}

		$statement = $this->pdo->prepare("SELECT COUNT(*) FROM {$table} WHERE DATE(created_at) = {$date}");

		$statement->execute();

		return $statement;
	}	

	public function paginate($limit, $offset, $date = null)
	{
		if($date == null) {
			$date = "CURDATE()";
		}

		$statement = $this->pdo->prepare("
			SELECT 
			reservation.id, 
			reservation.firstname, 
			reservation.created_at, 
			reservation.phone,
			visited_customers.visited
			FROM reservation 
				LEFT JOIN visited_customers 
				ON reservation.firstname = visited_customers.firstname
				WHERE DATE(reservation.created_at) = {$date} 
				ORDER BY visited_customers.visited 
				DESC 
				LIMIT :limit 
				OFFSET :offset");

	    // Bind the query params
	    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
	    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
	    $statement->execute();

	    return $statement->fetchAll(PDO::FETCH_CLASS);

	}

	public function searchByName($arguments, $table, $table2, $name)
	{
		$statement = $this->pdo->prepare("
			SELECT 
			{$arguments}
			FROM {$table}
				LEFT JOIN {$table2}
				ON {$table}.firstname = {$table2}.firstname
			WHERE {$table}.firstname = :firstname
			ORDER BY {$table2}.created_at 
			DESC
			");

		$statement->execute(array(
			':firstname'	=> $name
		));

		return $statement->fetch(PDO::FETCH_ASSOC);
	}	

	public function checkUserVisited($username)
	{
		$statement = $this->pdo->prepare("SELECT firstname, visited FROM visited_customers WHERE firstname = :firstname");

		$statement->execute(array(
			':firstname'	=> $username
		));

		return $statement->fetch(PDO::FETCH_ASSOC);
	}

	public function checkExistsDate($dateTime)
	{

		$statement = $this->pdo->prepare("SELECT * FROM reservation WHERE created_at = :created_at");

		$statement->execute(array(
			':created_at'	=> $dateTime
		));

		return $statement->fetch(PDO::FETCH_ASSOC);

	}	

	public function delete($id)
	{
		$statement = $this->pdo->prepare("DELETE FROM reservation WHERE id = :id");
		$statement->execute(array(
			':id'	=> $id
		));

		return $statement->fetch(PDO::FETCH_ASSOC);
	}	

}