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
			$meldung = $translator->get("Login erfolgreich");
			$_SESSION['kunde'] = $kunde->EMail;
		} else {
			$site = 'login';
			$meldung = $translator->get("Passwort nicht korrekt, bitte versuchen Sie es erneut");
		}
	} else {
		$site = 'login';
		$meldung = $translator->get("Email nicht gefunden");
	}
}

//logout
if ($site == 'logout') {
	unset($_SESSION['kunde']);
	unset($_SESSION['warenkorb']);
	$site = 'start';
	$meldung = $translator->get("Logout erfolgreich");
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
	
	if ($newKunde->ID > 0) {
		$meldung = $translator->get("Registrierung erfolgreich!");
		$_SESSION['kunde'] = $newKunde->EMail;
	} else {
		$meldung = $translator->get("Es ist etwas schief gelaufen bei der Registrierung");
	}
}

//bestellung verarbeiten
if(isset($_POST['bestellung'])) {
	
	$orderID = $database->saveOrder($_SESSION['kunde'], $_SESSION["warenkorb"], $_POST['shipping'], $_POST['payment']);
	
	$platten = $database->getPlatten($_SESSION["warenkorb"]);
	
	// pdf ersetllen
	$pdfCreator = new PdfCreator($platten, $_SESSION["warenkorb"], $orderID);
	$pdfCreator->create();
	
	// email versenden
	include("PHP/mail_header.php");
	$mail = $_SESSION['kunde'];
	$my_file = "bestellung_".$orderID.".pdf"; 
	$my_path = "Resources/Bestellungen/";
	
	$my_name = "Marko";
	$my_mail = "uzapy@hotmail.com";
	$my_replyto = "uzapy@hotmail.com";
	$my_subject = "Bestellung Nr. ".$orderID;
	$my_message = "Hallo,\r\nVielen Dank fuer deine Bestellung!\r\n\r\nGruss, Marko";
	
	mail_attachment($my_file, $my_path, $mail, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
	unset($_SESSION["warenkorb"]);
	
	$meldung = $translator->get("Bestellung erfolgreich übermittelt");
}
?>