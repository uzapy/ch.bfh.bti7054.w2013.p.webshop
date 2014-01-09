<?php
if(isset($_GET['site'])) {
	$site = $_GET['site'];
}

if (isset($_GET['item'])) {
	$item = $_GET['item'];
}

if(isset($_GET['lang'])) {
	$translator = new Translator($_GET['lang']);
} else {
	$translator = new Translator('de');	
}

$title = $translator->get($sites[$site]);
?>