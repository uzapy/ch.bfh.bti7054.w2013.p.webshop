<?php
//login
if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$email = stripslashes($email);
	$password = stripslashes($password);
	
	$email = $mysql->real_escape_string($email);
	$password = $mysql->real_escape_string($password);
	
	$query = "SELECT * FROM Kunden WHERE EMail = '$email';";
	if ($result = $mysql->query($query)) {
		if ($result->num_rows == 1) {
			$kunde = $result->fetch_object();
		
			if (password_verify($password, $kunde->Password)) {
				$site = 'start';
				$_SESSION['kunde'] = $kunde->EMail;
			} else {
				$site = 'login'; // TODO: Meldung: passwort stimmt nicht
			}
		} else {
			$site = 'login'; // TODO: Meldung: email nicht gefunden
		}
	} 
}

//logout
if ($site == 'logout') {
	unset($_SESSION['kunde']);
	$site = 'start';
}

//registrierung
if (isset($_POST['email']) 
&& isset($_POST['firstname'])
&& isset($_POST['lastname'])
&& isset($_POST['street'])
&& isset($_POST['number'])
&& isset($_POST['postal'])
&& isset($_POST['city'])
&& isset($_POST['password'])
&& isset($_POST['password_confirm'])) {

	$sql_adress = 'INSERT INTO `Adressen` (`Street`, `Number`, `PostalCode`, `City`) VALUES (\''.$mysql->real_escape_string($_POST['street']).'\', \''.$mysql->real_escape_string($_POST['number']).'\', \''.$mysql->real_escape_string($_POST['postal']).'\', \''.$mysql->real_escape_string($_POST['city']).'\');';
	
	$mysql->query($sql_adress);
	
	$sql_kunde = 'INSERT INTO `Kunden` (`FirstName` ,`LastName` ,`EMail` ,`Password` ,`PhoneNumber` ,`LastFmUser` ,`AddressID`) VALUES (\''.$_POST['firstname'].'\', \''.$_POST['lastname'].'\', \''.$_POST['email'].'\', \''.password_hash($_POST['password'], PASSWORD_DEFAULT).'\', \''.$_POST['phone'].'\', \''.$_POST['lastfm'].'\', \''.$mysql->insert_id.'\');';
	
	$mysql->query($sql_kunde);

}
?>