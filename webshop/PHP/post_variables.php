<?php
//login
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$email = stripslashes($email);
	$password = stripslashes($password);
	
	$email = $mysql->real_escape_string($email);
	$password = $mysql->real_escape_string($password);
	
	$kunde = $database->getKunde($email);
	if ($kunde) {
		if (password_verify($password, $kunde->Password)) {
			$meldung = "Login erfolgreich";
			$_SESSION['kunde'] = $kunde->EMail;
		} else {
			$site = 'login';
			$meldung = "Passwort nicht korrekt";
		}
	} else {
		$site = 'login';
		$meldung = "Email nicht gefunden";
	}
}

//logout
if ($site == 'logout') {
	unset($_SESSION['kunde']);
	unset($_SESSION['warenkorb']);
	$site = 'start';
	$meldung = "Logout erfolgreich";
}

//registrierung
if (isset($_POST['new_email']) && isset($_POST['firstname']) && isset($_POST['lastname'])
	&& isset($_POST['street']) && isset($_POST['number']) && isset($_POST['postal']) && isset($_POST['city'])
	&& isset($_POST['new_password']) && isset($_POST['new_password_confirm'])) {
	
	$phoneNumber = isset($_POST['phone']) ? $_POST['phone'] : "";
	$lastFmUser = isset($_POST['lastfm']) ? $_POST['lastfm'] : "";
	$password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
	
	$newAddress = $database->saveAddress($_POST['street'], $_POST['number'], $_POST['postal'], $_POST['city']);

	$newKunde = $database->saveKunde($_POST['firstname'], $_POST['lastname'], $_POST['new_email'],
		$password, $phoneNumber, $lastFmUser, $newAddress->ID);
	
	$meldung = "Registrierung erfolgreich!";
	$_SESSION['kunde'] = $newKunde->EMail;
}

//bestellung verarbeiten
if(isset($_POST['bestellung_submit'])) {
		
		$query = "SELECT * FROM Kunden WHERE EMail = '".$_SESSION['kunde']."';";

		if ($result = $mysql->query($query)) {

			if($result->num_rows >= 1) {
			
				$kunde = $result->fetch_object();
				$mail = $kunde->EMail;
								
				// Bestellung eintragen
				$sql_bestellung = "INSERT INTO `Bestellungen` (`KundenID`, `PaymentMethod`, `ShippingMethod`, `ShippingAddressID`, `IsShipped`) VALUES (".$kunde->ID.", '".$_POST['shipping']."', '".$_POST['payment']."', ".$kunde->AddressID.", '0');";
				
				$mysql->query($sql_bestellung);
				
				$order_id = $mysql->insert_id;
				
				foreach ($_SESSION["warenkorb"] as $key => $value) {
				
					//platten eintragen
					$sql_platten= "INSERT INTO `Platten_Bestellungen` (`PlattenID`, `BestellungID`, `WithDigitalDownload`, `Anzahl`) VALUES (".$value->ID.", ".$order_id.", 0, ".$value->count.");";
					//echo $sql_platten;
					$mysql->query($sql_platten);
					
				}
				
				
				// email versenden
				include("PHP/mailer.php");
				
				// pdf ersetllen
				include("PDF/order.php");
				
				$my_file = "bestellung_".$order_id.".pdf"; 
				$my_path = "Resources/Bestellungen/";
				
				$my_name = "Marko";
				$my_mail = "uzapy@hotmail.com";
				$my_replyto = "uzapy@hotmail.com";
				$my_subject = "Bestellung Nr. ".$order_id;
				$my_message = "Hallo,\r\nVielen Dank fuer deine Bestellung!\r\n\r\nGruss, Marko";
				
				mail_attachment($my_file, $my_path, $mail, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
				unset($_SESSION["warenkorb"]);
				
				$meldung = "Bestelllung erfolgreich übermittelt";
				
			}
		}
		
	}

?>