<?php
//Array mit Daten beladen
//include('db_connection.php');
include 'php/database.php';
$database = new Database();
$allePlatten = $database->getAllPlatten();
$keywords = array();

if ($allePlatten->num_rows > 1) {
	while ($platte = $allePlatten->fetch_object()) {
		$keywords[] = $platte->Artist;
		$keywords[] = $platte->Album;
		$keywords[] = $platte->Year;
		$keywords[] = $platte->Genre;
		$keywords[] = $platte->Label;
	}
}

$keywords = array_unique($keywords);

//Suchbegriff aus der URL per GET filtern / String-LŠnge ermitteln und falls groesser 0 -> weiter
if (isset($_GET["q"]) && strlen($_GET["q"] > 0)) {
	$query = $_GET["q"];
	
	$hint="";
	foreach($keywords as $currentKeyword) {
		
		if (strtolower($query) == strtolower( substr($currentKeyword, 0, strlen($query)) )) {
	
			$hint .= '<div class="ergebnis"><a href="?site=search&q=' . $currentKeyword . '">' . $currentKeyword . '</a></div>';
		}
	}
}

//Checken, ob Eintraege gefunden wurden. Wenn nicht, Fehler ausgeben
if (empty($hint)) {
	$response="Leider keine EintrŠge gefunden";
}
else{
	$response=$hint;
}

//Und nur noch das Ganze ausgeben
echo $response;
?>