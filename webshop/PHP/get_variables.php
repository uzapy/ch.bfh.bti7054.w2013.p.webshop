<?php
if(isset($_GET['site'])) {
	$site = $_GET['site'];
} else {
	$site = 'start';
}

if (isset($_GET['item'])) {
	$item = $_GET['item'];
}

if(isset($_GET['lang'])) {
	$lang = $_GET['lang'];
} else {
	$lang = 'de';	
}
?>