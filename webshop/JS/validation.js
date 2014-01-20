function validateRegister() {
	// Email validieren
	validateEmail("registerForm", "new_email");
	
	// Passwörter auslesen
	var password1 = document.forms["registerForm"]["new_password"].value;
	var password2 = document.forms["registerForm"]["new_password_confirm"].value;
	
	// Passwörter vergleichen
	if (password1 != password2) {
		window.alert("Das wiederholte Passwort stimmt nicht mit dem erten überein");
		return false;
	}
}

function validateLogin() {
	// Email validieren
	return validateEmail("login", "email");
}

function validateEmail(form, element) {
	// Email auslesen
	var email = document.forms[form][element].value;
	// Posotion des @-Zeichens
	var atpos = email.indexOf("@");
	// Position des letzten Punkts
	var dotpos = email.lastIndexOf(".");

	// Falls das @ ganz vorne is ODER der letzte Punkt vor dem @ ODER falls vor dem Punkt (und der TLD) nichts steht
	if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
		window.alert("Bitte Email Adresse korrekt eingeben");
		return false;
	}
}

function confirmPurchase() {
	// Kauf bestätigen oder Kauf abbrechen
	return window.confirm("Wollen sie diese Platten wirklich kaufen?");
}