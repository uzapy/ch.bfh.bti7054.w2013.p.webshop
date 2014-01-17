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
		$selectKunde = "SELECT * FROM Kunden WHERE `EMail` = '$email';";
		
		if ($result = $this->mysqli->query($selectKunde)) {
			if ($result->num_rows == 1) {
				return $result->fetch_object ();
			}
		}
	}
	
	private function getKundeById($id) {
		$id = $this->mysqli->real_escape_string ($id);
		$selectKunde = "SELECT * FROM Kunden WHERE `ID` = '$id';";
		
		if ($result = $this->mysqli->query($selectKunde)) {
			if ($result->num_rows == 1) {
				return $result->fetch_object();
			}
		}
	}
	
	public function getPlatte($id) {
		$selectPlatte = "SELECT * FROM `Platten` WHERE `ID` = $id";
		if ($result = $this->mysqli->query($selectPlatte)) {
			if ($result->num_rows == 1) {
				return $result->fetch_object();
			}
		}
	}
	
	public function getPlatten($cart) {
		$platten = array();
		foreach ($cart as $key => $value) {
			array_push($platten, $this->getPlatte($value->ID));
		}
		return $platten;
	}
	
	public function getAllPlatten() {
		$selectPlatten = "SELECT * FROM `Platten`";
		return $this->mysqli->query($selectPlatten);
	}
	
	public function saveKunde($firstName, $lastName, $eMail, $password, $phoneNumber, $lastFmUser, $addressID) {
		$firstName = $this->mysqli->real_escape_string($firstName);
		$lastName = $this->mysqli->real_escape_string($lastName);
		$eMail = $this->mysqli->real_escape_string($eMail);
		$password = $this->mysqli->real_escape_string($password);
		$phoneNumber = $this->mysqli->real_escape_string($phoneNumber);
		$lastFmUser = $this->mysqli->real_escape_string($lastFmUser);
		$addressID = $this->mysqli->real_escape_string($addressID);
		
		$insertKunde = "INSERT INTO `Kunden` (`FirstName`, `LastName`, `EMail`, `Password`, `PhoneNumber`, `LastFmUser`, `AddressID`) ";
		$insertKunde .= "VALUES ('" . $firstName . "', '" . $lastName . "', '" . $eMail . "', '" . $password . "', '" . $phoneNumber . "', '" . $lastFmUser . "', '" . $addressID . "');";
		
		if ($this->mysqli->query($insertKunde)) {
			if ($this->mysqli->insert_id > 0) {
				return $this->getKundeById($this->mysqli->insert_id);
			}
		}
	}
	
	public function getAddress($id) {
		$id = $this->mysqli->real_escape_string ($id);
		$selectAddress = "SELECT * FROM Adressen WHERE ID = '$id';";
		
		if ($result = $this->mysqli->query($selectAddress)) {
			if ($result->num_rows == 1) {
				return $result->fetch_object();
			}
		}
	}
	
	public function saveAddress($street, $number, $postalCode, $city) {
		$street = $this->mysqli->real_escape_string($street);
		$number = $this->mysqli->real_escape_string($number);
		$postalCode = $this->mysqli->real_escape_string($postalCode);
		$city = $this->mysqli->real_escape_string($city);
		
		$insertAddress = "INSERT INTO `Adressen` (`Street`, `Number`, `PostalCode`, `City`) ";
		$insertAddress .= "VALUES ('" . $street . "', '" . $number . "', '" . $postalCode . "', '" . $city . "');";
		
		if ($this->mysqli->query($insertAddress)) {
			if ($this->mysqli->insert_id > 0) {
				return $this->getAddress($this->mysqli->insert_id);
			}
		}
	}
	
	public function saveOrder($email, $cart, $shippingMethod, $paymentMethod) {
		$kunde = $this->getKunde($email);
		$insertBestellung = "INSERT INTO `Bestellungen` (`KundenID`, `PaymentMethod`, `ShippingMethod`, `BillingAddressID`, `IsShipped`) ";
		$insertBestellung .= "VALUES (" . $kunde->ID . ", '" . $shippingMethod . "', '" . $paymentMethod . "', " . $kunde->AddressID . ", " . "1 )";
		
		if ($this->mysqli->query($insertBestellung)) {
			if ($this->mysqli->insert_id > 0) {
				$orderID = $this->mysqli->insert_id;
				
				foreach ($cart as $key => $item) {
					$this->saveItem($item, $orderID);
				}
				
				return $orderID;
			}
		}
	}
	
	public function saveItem($item, $orderID) {
		$insertItem = "INSERT INTO `Platten_Bestellungen` (`PlattenID`, `BestellungID`, `WithDigitalDownload`, `Anzahl`) ";
		$insertItem .= "VALUES (" . $item->ID . ", " . $orderID . ", '" . $item->withDigital . "', " . $item->count . " )";
		
		$this->mysqli->query($insertItem);
	}
}
?>