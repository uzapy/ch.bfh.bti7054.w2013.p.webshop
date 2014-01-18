<form action="?site=<? echo $next . $translator->getLangUrl() ?>" method="POST" name="login">
	<fieldset>
		<p>
			<label class="detail_left" for="email"><? echo $translator->get("E-Mail Adresse") ?>:</label>
			<input id="email" name="email" required="required" type="text" placeholder="mymail@mail.com" />
		</p>
		<p>
			<label class="detail_left" for="password"><? echo $translator->get("Passwort") ?>:</label>
			<input id="password" name="password" required="required" type="password" placeholder="password" />
		</p>
		<div class="login_container">
			<a class="detail_left link" href="?site=register<? echo $translator->getLangUrl() ?>">
				<? echo $translator->get("Registrieren") ?>
			</a>
			<input type="submit" value="Login" />
		</div>
	</fieldset>
</form>