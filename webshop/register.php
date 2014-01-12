<script src="js/validation.js"></script>
<form accept-charset="utf-8" id="registerForm" autocomplete="on" action="?site=start" method="POST" name="registerForm"
	onsubmit="return validateForm();">

	<fieldset>
		<p>
			<label for="new_email"><? echo $translator->get("E-Mail Adresse") ?>:</label>
			<input id="new_email" name="new_email" required="required" type="text" placeholder="mymail@mail.com" />
		</p>
		<p>
			<label for="lastfm"><? echo $translator->get("Last.fm Benutzername") ?>:</label>
			<input id="lastfm" name="lastfm" type="text" />
		</p>
		<p>
			<label for="firstname"><? echo $translator->get("Vorname") ?>:</label>
			<input id="firstname" name="firstname" required="required" type="text" />
		</p>
		<p>
			<label for="lastname"><? echo $translator->get("Nachname") ?>:</label>
			<input id="lastname" name="lastname" required="required" type="text" />
		</p>
		<p>
			<label for="phone"><? echo $translator->get("Telefonnummer") ?>:</label>
			<input id="phone" name="phone" type="number" placeholder="031 123 45 67" />
		</p>
		<p>
			<label for="street"><? echo $translator->get("Strasse") ?>:</label>
			<input id="street" name="street" type="text" required="required" />
			<label for="number"><? echo $translator->get("Nummer") ?>:</label>
			<input id="number" name="number" type="number" required="required" />
		</p>
		<p>
			<label for="postal"><? echo $translator->get("PLZ") ?>:</label>
			<input id="postal" name="postal" type="number" required="required" />
			<label for="city"><? echo $translator->get("Ort") ?>:</label>
			<input id="city" name="city" type="text" required="required" />
		</p>
		<p>
			<label for="new_password"><? echo $translator->get("Passwort") ?>:</label>
			<input id="new_password" name="new_password" required="required" type="password" placeholder="X8df!90EO" />
		</p>
		<p>
			<label for="new_password_confirm"><? echo $translator->get("Passwort wiederholen") ?>:</label>
			<input id="new_password_confirm" name="new_password_confirm" required="required" type="password" placeholder="X8df!90EO" />
		</p>
		<input type="submit" value="<? echo $translator->get("Registrieren") ?>" />
	</fieldset>
</form>