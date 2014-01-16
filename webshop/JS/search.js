var xmlHttp;

function suggest(suchbegriff) {

	var cS = document.getElementById("col_search");
	var a = document.getElementById("ausgabe");
	var colSearch = cS.options[cS.selectedIndex].value;

	if (colSearch == 'all') {

		a.style.display = 'block';

		xmlHttp = httpXMLobjects();
		if (xmlHttp == null) {
			alert("Browser does not support AJAX");
			return;
		}
		if (suchbegriff.length == 0) {
			document.getElementById("ausgabe").innerHTML = "";
			return;
		} else {
			// URL vorbereiten, Zufallszahl umgeht den Browsercache
			var aufruf = "PHP/suggest.php" + "?q=" + suchbegriff + "&sid=" + Math.random();
			xmlHttp.onreadystatechange = stateChanged;
			xmlHttp.open("GET", aufruf, true);
			xmlHttp.send(null);
		}
	} else {
		a.style.display = 'none';
	}
} 

function stateChanged() {
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
		document.getElementById("ausgabe").innerHTML = xmlHttp.responseText;
	}
}

//AJAX-Standards
function httpXMLobjects() {
	var xmlHttp = null;
	try {
		// Fuer Firefox, Opera und Safari
		xmlHttp = new XMLHttpRequest();
	} catch (e) {
		// Der Internet Explorer wills wieder anders
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}