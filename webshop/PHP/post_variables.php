<?php
//login
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$email = $database->sanitizeString($email);
	$password = $database->sanitizeString($password);
	
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
	$fileName = $pdfCreator->create();
	
	// email versenden
	include("php/mailer.php");
	$mailer = new Mailer($_SESSION['kunde'], $orderID, $translator, $database);
	$isMailSent = $mailer->sendMailWithAttachment($fileName);
	
	if ($isMailSent) {
		unset($_SESSION["warenkorb"]);
		$meldung = $translator->get("Bestellung erfolgreich übermittelt. Vielen Dank!");
	} else {
		$meldung = $translator->get("Etwas ist schief gelaufen. Bitte versuchen Sie es später erneut.");
	}
}
?>