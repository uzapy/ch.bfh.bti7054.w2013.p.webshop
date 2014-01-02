<?php
if(isset($_GET['site'])) {
	$title = $_GET['site'];
} else {
	$title = "start";
}

if(isset($_GET['lang'])) {
	$translate = new Translator($_GET['lang']);
} else{
	$translate = new Translator('en');	
}

?>