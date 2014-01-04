<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") ." GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Cache-Control: post-check=0, pre-check=0", FALSE);

// DB-Connect 
$mysql = new mysqli("localhost", "root", "root");
$mysql->select_db("plattelade");

require_once 'php/translator.php';

include 'php/get_variables.php';

$menu_items = array(
		'start' => 'Plattelade',
		'store' => 'Sortiment',
		'contact' => 'Kontakt',
		'search' => 'Suche',
		'register' => 'Registrieren',
		'login' => 'Login');

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
			<h1><? echo $menu_items[$title]; ?></h1>
		</header>

		<div class="content">
		
		<?php		
		// Content-Seite laden
		if (file_exists($title.".php")) {
			include $title.".php";
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

<?php $mysql->close(); ?>