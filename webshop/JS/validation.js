function validateForm() {
	var x=document.forms["registerForm"]["email"].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
		alert("Bitte Email Adresse korrekt eingeben");
		return false;
	}
}