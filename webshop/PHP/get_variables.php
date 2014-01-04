<?php
if(isset($_GET['site'])) {
	$site = $_GET['site'];
} else if (isset($_GET['item'])) {
	$item = $_GET['item'];
} else {
	$site = "start";
}

if(isset($_GET['lang'])) {
	$translator = new Translator($_GET['lang']);
} else {
	$translator = new Translator('de');	
}

if (isset($_GET['site'])) {
	$title = $translator->get($menu_items[$site]);
} else if (isset($_GET['item'])) {
	$title = $translator->get('Details');
} else {
	$title = $translator->get($menu_items['start']);
}
?>