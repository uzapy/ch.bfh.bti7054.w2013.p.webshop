<?php
if(isset($_GET['site'])) {
	$title = $_GET['site'];
} else {
	$title = "start";
}

if(isset($_GET['lang'])) {
	$translator = new Translator($_GET['lang']);
} else {
	$translator = new Translator('de');	
}

?>