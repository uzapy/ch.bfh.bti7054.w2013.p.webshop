<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") ." GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Cache-Control: post-check=0, pre-check=0", FALSE);

$menu_items = array(
		'start' => 'Plattelade',
		'store' => 'Sortiment',
		'contact' => 'Kontakt',
		'search' => 'Suche',
		'register' => 'Registrieren',
		'login' => 'Login');

include 'php/db_connection.php';
include 'php/translator.php';
include 'php/get_variables.php';
include 'php/html_header.php';

?>

	<body>
		<nav>
			<div class="navigation">
				<ul class="nav-list">
				<?
					foreach($menu_items as $key => $name)
					{
						// Seiten-Key
						echo '<li><a href="?site=' . $key;
						
						// Sprache falls definiert
						if(isset($_GET['lang'])) {
							echo '&lang=' . $translator->getCurrent() . '"';
						}
													
						echo '"';
						
						// Aktiven Link hervorheben
						if($key==$title){
							echo ' class="active"';
						}
						
						// †bersetzte Link-Bezeichung
						echo '>' . $translator->get($name) . '</a></li>';
					}
				?>
				</ul>
			</div>
		</nav>
		
		<header>
			<h1><? echo $translator->get($title); ?></h1>
		</header>

		<div class="content">
		
		<?		
		// Content-Seite laden
		if (isset($_GET['item'])) {
			include "detail.php";
		} else if (isset($_GET['site']) && file_exists($site.".php")) {
			include $site.".php";
		} else {
			include 'start.php';
		}
		?>

		</div>

		<footer>
<!-- 			<p> -->
<!-- 				<tt>Footer</tt> -->
<!-- 			</p> -->
		</footer>
	</body>
</html>

<? $mysql->close(); ?>