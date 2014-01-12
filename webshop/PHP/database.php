<?php
class Database {
	private $mysqli;
	
	public function __construct() {
		$this->mysqli = new mysqli("localhost", "root", "root");
		$this->mysqli->select_db("plattelade");
		$this->mysqli->query("SET NAMES 'utf8'");
	}
	
	public function getKunde($email) {
		$email = $this->mysqli->real_escape_string ($email);
		$selectKunde = "SELECT * FROM Kunden WHERE EMail = '$email';";
		
		if ($result = $this->mysqli->query($selectKunde)) {
			if ($result->num_rows == 1) {
				return $result->fetch_object ();
			}
		}
	}
}
?>