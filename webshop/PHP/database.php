<?php
class Database {
	private $mysqli;
	
	public function __construct() {
		$this->mysqli = new mysqli("localhost", "root", "root");
		$this->mysqli->select_db("plattelade");
		$this->mysqli->query("SET NAMES 'utf8'");
	}
	
	public function close() {
		$this->mysqli->close();
	}
	
	public function sanitizeString($str) {
		$str = stripslashes($str);
		$str = $this->mysqli->real_escape_string($str);
		return $str;
	}
	
	// Einen Kunden laden per Email
	public function getKunde($email) {
		$email = $this->sanitizeString($email);
		$selectKunde = "SELECT * FROM `Kunden` WHERE `EMail` = '$email';";
		
		if ($result = $this->mysqli->query($selectKunde)) {
			if ($result->num_rows == 1) {
				return $result->fetch_object ();
			}
		}
	}
	
	// Einen Kunden laden per ID
	private function getKundeById($id) {
		$id = $this->sanitizeString($id);
		$selectKunde = "SELECT * FROM `Kunden` WHERE `ID` = '$id';";
		
		if ($result = $this->mysqli->query($selectKunde)) {
			if ($result->num_rows == 1) {
				return $result->fetch_object();
			}
		}
	}
	
	// Eine Platte laden per ID
	public function getPlatte($id) {
		$selectPlatte = "SELECT * FROM `Platten` WHERE `ID` = $id";
		if ($result = $this->mysqli->query($selectPlatte)) {
			if ($result->num_rows == 1) {
				return $result->fetch_object();
			}
		}
	}
	
	// Platten laden, die im Warenkorb liegen
	public function getPlatten($cart) {
		$platten = array();
		foreach ($cart as $key => $value) {
			array_push($platten, $this->getPlatte($value->ID));
		}
		return $platten;
	}
	
	// Alle Platten laden
	public function getAllPlatten() {
		$selectPlatten = "SELECT * FROM `Platten`";
		return $this->mysqli->query($selectPlatten);
	}
	
	// Platten suchen nach Suchkriterium (Ÿber alle Eigenschaften)
	public function searchPlattenAll($term) {
		$term = $this->sanitizeString($term);
		
		$selectPlatten = "SELECT * FROM `Platten` WHERE ";
		$selectPlatten .= "`Artist` LIKE '%".$term."%' OR ";
		$selectPlatten .= "`Album` LIKE '%".$term."%' OR ";
		$selectPlatten .= "`Year` LIKE '%".$term."%' OR ";
		$selectPlatten .= "`Country` LIKE '%".$term."%' OR ";
		$selectPlatten .= "`Genre` LIKE '%".$term."%' OR ";
		$selectPlatten .= "`Style` LIKE '%".$term."%' OR ";
		$selectPlatten .= "`Label` LIKE '%".$term."%'";
		$selectPlatten .= " ORDER BY Artist ASC;";
		
		return $this->mysqli->query($selectPlatten);
	}
	
	// Platten suchen nach Suchkriterium (beschrŠnkt auf eine Eigenschaft z.B. 'Land')
	public function searchPlattenByCategory($category, $term) {
		$term = $this->sanitizeString($term);
		
		$selectPlatten = "SELECT * FROM `Platten` WHERE ";
		$selectPlatten .= "`".$category."` LIKE '%".$term."%'";
		$selectPlatten .= " ORDER BY Artist ASC;";
		
		return $this->mysqli->query($selectPlatten);
	}
	
	// Platten suchen nach Liste von KŸnstlern
	public function searchPlattenByArtistSet($set) {
		$selectPlatten = "SELECT * FROM `Platten` WHERE ";
		foreach ($set as $artist) {
			$artist = $this->sanitizeString($artist);
			
			$selectPlatten .= "`Artist` LIKE '" . $artist . "' ";
			
			if ($artist !== end($set)) {
				$selectPlatten .= "OR ";
			}
		}
		
		return $this->mysqli->query($selectPlatten);
	}
	
	// Neuen Kunden abspeichern
	public function saveKunde($firstName, $lastName, $eMail, $password, $phoneNumber, $lastFmUser, $addressID) {
		$firstName = $this->sanitizeString($firstName);
		$lastName = $this->sanitizeString($lastName);
		$eMail = $this->sanitizeString($eMail);
		$password = $this->sanitizeString($password);
		$phoneNumber = $this->sanitizeString($phoneNumber);
		$lastFmUser = $this->sanitizeString($lastFmUser);
		$addressID = $this->sanitizeString($addressID);
		
		$insertKunde = "INSERT INTO `Kunden` (`FirstName`, `LastName`, `EMail`, `Password`, `PhoneNumber`, `LastFmUser`, `AddressID`) ";
		$insertKunde .= "VALUES ('" . $firstName . "', '" . $lastName . "', '" . $eMail . "', '" . $password . "', '" . $phoneNumber . "', '" . $lastFmUser . "', '" . $addressID . "');";
		
		if ($this->mysqli->query($insertKunde)) {
			if ($this->mysqli->insert_id > 0) {
				return $this->getKundeById($this->mysqli->insert_id);
			}
		}
	}
	
	// Adresse laden per ID
	public function getAddress($id) {
		$id = $this->mysqli->real_escape_string ($id);
		$selectAddress = "SELECT * FROM Adressen WHERE ID = '$id';";
		
		if ($result = $this->mysqli->query($selectAddress)) {
			if ($result->num_rows == 1) {
				return $result->fetch_object();
			}
		}
	}
	
	// Neue Adresse abspeichern
	public function saveAddress($street, $number, $postalCode, $city) {
		$street = $this->sanitizeString($street);
		$number = $this->sanitizeString($number);
		$postalCode = $this->sanitizeString($postalCode);
		$city = $this->sanitizeString($city);
		
		$insertAddress = "INSERT INTO `Adressen` (`Street`, `Number`, `PostalCode`, `City`) ";
		$insertAddress .= "VALUES ('" . $street . "', '" . $number . "', '" . $postalCode . "', '" . $city . "');";
		
		if ($this->mysqli->query($insertAddress)) {
			if ($this->mysqli->insert_id > 0) {
				return $this->getAddress($this->mysqli->insert_id);
			}
		}
	}
	
	// Neue Bestellung abspeichern
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
	
	// Platten einer Bestellung zuordnen
	public function saveItem($item, $orderID) {
		$insertItem = "INSERT INTO `Platten_Bestellungen` (`PlattenID`, `BestellungID`, `WithDigitalDownload`, `Anzahl`) ";
		$insertItem .= "VALUES (" . $item->ID . ", " . $orderID . ", '" . $item->withDigital . "', " . $item->count . " )";
		
		$this->mysqli->query($insertItem);
	}
}
?>