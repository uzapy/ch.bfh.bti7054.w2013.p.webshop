<?php
// Array mit Daten beladen
include 'database.php';
$database = new Database();
$allePlatten = $database->getAllPlatten();
$keywords = array();
$response = "";

if ($allePlatten->num_rows > 1) {
	while ($platte = $allePlatten->fetch_object()) {
		$keywords[] = $platte->Artist;
		$keywords[] = $platte->Album;
		$keywords[] = $platte->Year;
		$keywords[] = $platte->Genre;
		$keywords[] = $platte->Label;
	}
}

// Doppelte Werte herausfiltern
$keywords = array_unique($keywords);

// Suchbegriff aus der URL per GET filtern / String-Länge ermitteln und falls groesser 0 -> weiter
if (isset($_GET["q"]) && strlen($_GET["q"]) > 0) {
	$query = $_GET["q"];
	$hint="";
	
	// Liste mit Vorschlägen erstellen
	foreach($keywords as $currentKeyword) {
		if (strtolower($query) == strtolower(substr($currentKeyword, 0, strlen($query)))) {
			$hint .= '<div class="ergebnis">';
			$hint .= '<a class="link" href="?site=search&q=' . $currentKeyword . '">' . $currentKeyword;
			$hint .= '</a></div>';
		}
	}
}

// Prüfen, ob Eintraege gefunden wurden. Wenn nicht, nichts ausgeben
if (empty($hint)) {
	$response="";
}
else{
	$response=$hint;
}

// Das Ergebnis ausgeben
echo $response;
?>