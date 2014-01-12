<?php
if (isset ( $_GET['site'] )) {
	$site = $_GET['site'];
} else {
	$site = 'start';
}

if (isset ( $_GET['next'] )) {
	$next = $_GET['next'];
} else {
	$next = 'start';
}

if (isset ( $_GET['item'] )) {
	$item = $_GET['item'];
} else {
	unset ( $item );
}

if (isset ( $_GET['lang'] )) {
	$lang = $_GET['lang'];
} else {
	$lang = 'de';
}

?>