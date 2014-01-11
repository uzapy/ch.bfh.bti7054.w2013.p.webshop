<?php
if(isset($_GET['next'])) {
	$target = $_GET['next'];
} else {
	$target = 'start';
}
?>

<form action="?site=<? echo $target.$translator->getLangUrl() ?>" method="POST" name="login">
	<fieldset>
		<p>
			<label for="email"><? echo $translator->get("E-Mail Adresse") ?>:</label>
			<input id="email" name="email" required="required" type="text" placeholder="mymail@mail.com" />
		</p>
		<p>
			<label for="password"><? echo $translator->get("Passwort") ?>:</label>
			<input id="password" name="password" required="required" type="password" placeholder="password" />
		</p>
		<input type="submit" value="Login" />
		<a href="?site=register<? echo $translator->getLangUrl() ?>">Registrieren</a>
	</fieldset>
</form>