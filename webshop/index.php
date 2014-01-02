<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") ." GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Cache-Control: post-check=0, pre-check=0", FALSE);

// DB-Connect 
$mysql = new mysqli("localhost", "root", "root");
$mysql->select_db("plattelade");

require_once 'php/translation.php';
include 'php/get_variables.php';
include 'php/html_header.php';

$menu_items = array(
		'start' => 'Plattelade',
		'store' => 'Sortiment',
		'contact' => 'Kontakt',
		'search' => 'Suche',
		'register' => 'Registrieren',
		'login' => 'Login');
?>

	<body>
		<nav>
			<div class="navigation">
				<ul class="nav-list">
				<?
					foreach($menu_items as $key => $name)
					{
						echo '<li><a href="?site=' . $key . '"';
						
						if($key==$title){
							echo ' class="active"';
						}
						
						echo '>';
						$translate->get($name);
						echo '</a></li>';
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
		
		$translate->get('Willkommen');
		
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