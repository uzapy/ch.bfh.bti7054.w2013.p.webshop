<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="UTF-8" />
		
		<meta name="viewport" content="width=device-width; initial-scale=1.0" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="Resources/disc.ico" />
		<link rel="apple-touch-icon" href="Resources/disc.png" />
		
		<link rel="stylesheet" href="CSS/reset/reset.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="CSS/screen/format.css" type="text/css" media="screen" title="Screen"/>
		<link rel="stylesheet" href="CSS/screen/layout.css" type="text/css" media="screen" title="Screen"/>
		<link rel="alternate stylesheet" href="CSS/handheld/mobile.css" type="text/css" media="handheld" title="Handheld"/>
		
		<script language="php">
			require("PHP/basic.php");
		</script>
		
		<title>Webshop</title>
	</head>

	<body>
		<div>
			<header>
				<h1>start</h1>
			</header>
			<nav>
				<p>
					<a href="/">Home</a>
				</p>
				<p>
					<a href="/contact">Contact</a>
				</p>
			</nav>

			<div>
				<?php first_echo() ?>
			</div>

			<footer>
				<p>
					<tt>Footer</tt>
				</p>
			</footer>
		</div>
	</body>
</html>
