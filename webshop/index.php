<?php
include 'php/database.php';
include 'php/cart_item.php';

session_start();

$database = new Database();

include 'php/db_connection.php';
include 'pdf/fpdf.php';
include 'pdf/pdfCreator.php';
include 'php/get_variables.php';
include 'php/translator.php';
$translator = new Translator($lang);

include 'php/post_variables.php';
include 'php/sites.php';
include 'php/shopping_cart.php';

if (isset($_SESSION['kunde'])) {
	unset($sites['login']);
	unset($menu_items['login']);
	$sites['logout'] = 'Logout';
	$menu_items['logout'] = 'Logout';
}

if(!isset($_SESSION['kunde']) && $site == "checkout") {
	$redirect = "Location: ?site=login&next=checkout" . $translator->getLangUrl();
	header($redirect);
}

$title = $translator->get($sites[$site]);

include 'php/html_header.php';

?>
	<body>
		<nav>
			<div class="navigation">
				<ul class="nav-list">
					<li><a  href="?site=start<? echo $translator->getLangUrl() ?>">
						<img class="logo" alt="Logo" src="Resources/logo.png" />
					</a></li>
				<?
					foreach($menu_items as $key => $name)
					{
						// Seiten-Key / Sprache falls definiert / Aktiven Link hervorheben / †bersetzte Link-Bezeichung
						$active = $key == $site ? 'active' : '';
						echo '<li><a class="menu ' . $active . '" href="?site=' . $key . $translator->getLangUrl() . '">' . $translator->get($name) . '</a></li>';
					}
					
					if (isset($_SESSION['kunde'])) {
						echo '<li><span class="user-hint">('.
							$translator->get("eingeloggt als") . ' ' . $_SESSION['kunde'] .')</span></li>';
					}
				?>
				</ul>
				
			</div>
			<div class="language-links">
				<?
					$itemPost = isset($item) ? '&item='.$item : "";
				?>
				<a class="language-link<? echo $translator->getActiveLang('de'); ?>"
					href="?site=<? echo $site . $itemPost; ?>&lang=de" >de</a>
				<a class="language-link<? echo $translator->getActiveLang('en'); ?>"
					href="?site=<? echo $site . $itemPost; ?>&lang=en" >en</a>
			</div>
		</nav>
		
		<?
		if (isset($meldung)) {
			echo '<div class="meldung">'.$meldung.'</div>';
		}
		?>
		
		<header>
			<h1>
				<img class="logo-title" alt="Logo" src="Resources/logo.png" />
				<? echo $translator->get($title) ?>
			</h1>
		</header>

		<div class="content">
		<?	
		// Content-Seite laden
		if (file_exists($site.".php")) {
			include $site.".php";
		}
		?>

		</div>
	</body>
</html>

<? $mysql->close(); ?>