<?php
header('Content-Type: text/html; charset=utf-8');

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Datum in der Vergangenheit

session_start();

include 'php/sites.php';
include 'php/db_connection.php';
include 'php/get_variables.php';
include 'php/post_variables.php';
include 'php/translator.php';

$translator = new Translator($lang);
$title = $translator->get($sites[$site]);

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
						echo '<li><a href="?site='.$key;
						// Sprache falls definiert
						echo $translator->getLangUrl().'"';
						
						// Aktiven Link hervorheben
						if($key==$site){
							echo ' class="active"';
						}
						
						// †bersetzte Link-Bezeichung
						echo '>' . $translator->get($name) . '</a></li>';
					}
				?>
				</ul>
			</div>
			<div>
				<?
					$itemPost = isset($item) ? '&item='.$item : "";
				?>
				<a class="language-link" href="?site=<? echo $site . $itemPost; ?>&lang=de" >DE</a>
				<a class="language-link" href="?site=<? echo $site . $itemPost; ?>&lang=en" >EN</a>
			</div>
		</nav>
		
		<header>
			<h1><? echo $translator->get($title) ?></h1>
		</header>

		<div class="content">
		<?	
		// Content-Seite laden
		if (file_exists($site.".php")) {
			include $site.".php";
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