<?php
//Array mit Daten beladen
include('db_connection.php');

$query = "SELECT * FROM Platten";
if ($result = $mysql->query($query)) {
	while ($platte = $result->fetch_object()) {
		$keywords[] = $platte->Artist;
	}
}

if ($result = $mysql->query($query)) {
	while ($platte = $result->fetch_object()) {
		$keywords[] = $platte->Album;
	}	
}

if ($result = $mysql->query($query)) {
	while ($platte = $result->fetch_object()) {
		$keywords[] = $platte->Year;
	}	
}

if ($result = $mysql->query($query)) {
	while ($platte = $result->fetch_object()) {
		$keywords[] = $platte->Genre;
	}	
}

if ($result = $mysql->query($query)) {
	while ($platte = $result->fetch_object()) {
		$keywords[] = $platte->Label;
	}	
}

if ($result = $mysql->query($query)) {
	while ($platte = $result->fetch_object()) {
		$keywords[] = $platte->Number;
	}	
}

$keywords = array_unique($keywords);

//Suchbegriff aus der URL per GET filtern
$q=$_GET["q"];
//String-LŠnge ermitteln und falls groesser 0 -> weiter
if (strlen($q) > 0){
	$hint="";
	foreach($keywords as $keyword_aktuell) {	
  		if (strtolower($q)==strtolower(substr($keyword_aktuell,0,strlen($q)))) {

      		$hint=$hint.'<div class="ergebnis"><a href="?site=search&q='.$keyword_aktuell.'">'.$keyword_aktuell.'</a></div>';
      		
    	}
  	}
}

//Checken, ob Eintraege gefunden wurden. Wenn nicht, Fehler ausgeben
if (empty($hint)) {
	$response="Leider keine Eintr&auml;ge";
}
else{
	$response=$hint;
}

//Und nur noch das Ganze ausgeben
echo $response;
?>