<?php
// Login
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $database->sanitizeString($_POST['email']);
	$password = $database->sanitizeString($_POST['password']);
	
	$kunde = $database->getKunde($email);
	
	if ($kunde) {
		// Passwort überprüfen
		if (password_verify($password, $kunde->Password)) {
			$meldung = $translator->get("Login erfolgreich");
			// Falls das Passwort korrekt ist, Session eröffnen
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

// Logout
if ($site == 'logout') {
	// Session und Warenkorb zerstören und Umleiten auf Startseite
	unset($_SESSION['kunde']);
	unset($_SESSION['warenkorb']);
	$site = 'start';
	$meldung = $translator->get("Logout erfolgreich");
}

// Registrierung
if (isset($_POST['new_email']) && isset($_POST['firstname']) && isset($_POST['lastname'])
	&& isset($_POST['street']) && isset($_POST['number']) && isset($_POST['postal']) && isset($_POST['city'])
	&& isset($_POST['new_password']) && isset($_POST['new_password_confirm'])) {
	
	$phoneNumber = isset($_POST['phone']) ? $_POST['phone'] : "";
	$lastFmUser = isset($_POST['lastfm']) ? $_POST['lastfm'] : "";
	// Passwort Hashen und Salten mit der Standard-Methode
	$password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
	
	// Neue Adresse speichern
	$newAddress = $database->saveAddress($_POST['street'], $_POST['number'], $_POST['postal'], $_POST['city']);

	// Neuen Kunden speichern
	$newKunde = $database->saveKunde($_POST['firstname'], $_POST['lastname'], $_POST['new_email'],
		$password, $phoneNumber, $lastFmUser, $newAddress->ID);
	
	// Falls eine gültige Kunden-ID zurückgesendet wurde
	if ($newKunde->ID > 0) {
		$meldung = $translator->get("Registrierung erfolgreich!");
		// Session eröffnen
		$_SESSION['kunde'] = $newKunde->EMail;
	} else {
		$meldung = $translator->get("Es ist etwas schief gelaufen bei der Registrierung");
	}
}

// Bestellung verarbeiten
if(isset($_POST['bestellung'])) {
	
	// Bestellung speichern
	$orderID = $database->saveOrder($_SESSION['kunde'], $_SESSION["warenkorb"], $_POST['shipping'], $_POST['payment']);
	
	// Platten aus dem Warenkorb laden
	$platten = $database->getPlatten($_SESSION["warenkorb"]);
	
	// PDF ersetllen
	$pdfCreator = new PdfCreator($platten, $_SESSION["warenkorb"], $orderID, $translator);
	$fileName = $pdfCreator->create();
	
	// Email versenden
	include("php/mailer.php");
	$mailer = new Mailer($_SESSION['kunde'], $orderID, $translator, $database);
	$isMailSent = $mailer->sendMailWithAttachment($fileName);
	
	if ($isMailSent) {
		// Warenkorb löschen
		unset($_SESSION["warenkorb"]);
		$meldung = $translator->get("Bestellung erfolgreich übermittelt. Vielen Dank!");
	} else {
		$meldung = $translator->get("Etwas ist schief gelaufen. Bitte versuchen Sie es später erneut.");
	}
}
?>