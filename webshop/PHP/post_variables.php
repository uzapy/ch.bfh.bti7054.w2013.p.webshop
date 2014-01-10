<?php
//login
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$query = "SELECT * FROM Kunden WHERE EMail = '$email';";
	if ($result = $mysql->query($query)) {
		if ($result->num_rows == 1) {
			$kunde = $result->fetch_object();
		
			if (password_verify($password, $kunde->Password)) {
				$site = 'start';
			} else {
				$site = 'login'; // TODO: Meldung: passwort stimmt nicht
			}
		} else {
			$site = 'login'; // TODO: Meldung: email nicht gefunden
		}
	} 
}

//registrierung

?>