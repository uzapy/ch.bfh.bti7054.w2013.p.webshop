<?php
include 'php/sites.php';
include 'php/db_connection.php';
include 'php/get_variables.php';
include 'php/post_variables.php';
include 'php/session';
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