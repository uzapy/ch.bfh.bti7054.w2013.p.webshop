<form id="registerForm" autocomplete="on">
	<fieldset>
		<p>
			<label for="email"><? echo $translator->get("E-Mail Adresse") ?>:</label>
			<input id="email" name="email" required="required" type="text" placeholder="mymail@mail.com" />
		</p>
		<p>
			<label for="lastfm"><? echo $translator->get("Last.fm Benutzername") ?>:</label>
			<input id="lastfm" name="lastfm" type="text" />
		</p>
		<p>
			<label for="firstname"><? echo $translator->get("Vorname") ?>:</label>
			<input id="firstname" name="firstname" required="required"
				type="text" />
		</p>
		<p>
			<label for="lastname"><? echo $translator->get("Nachname") ?>:</label>
			<input id="lastname" name="lastname" required="required" type="text" />
		</p>
		<p>
			<label for="phone"><? echo $translator->get("Telefonnummer") ?>:</label>
			<input id="phone" name="phone" type="text" placeholder="031 123 45 67" />
		</p>
		<p>
			<label for="street"><? echo $translator->get("Strasse") ?>:</label>
			<input id="street" name="street" type="text" required="required" />
			<label for="number"><? echo $translator->get("Nummer") ?>:</label>
			<input id="number" name="number" type="text" required="required" />
		</p>
		<p>
			<label for="postal"><? echo $translator->get("PLZ") ?>:</label>
			<input id="postal" name="postal" type="text" required="required" />
			<label for="city"><? echo $translator->get("Ort") ?>:</label>
			<input id="city" name="city" type="text" required="required" />
		</p>
		<p>
			<label for="password"><? echo $translator->get("Passwort") ?>:</label>
			<input id="password" name="password" required="required" type="password" placeholder="X8df!90EO" />
		</p>
		<p>
			<label for="password_confirm"><? echo $translator->get("Passwort wiederholen") ?>:</label>
			<input id="password_confirm" name="password_confirm" required="required" type="password" placeholder="X8df!90EO" />
		</p>
		<input type="submit" value="<? echo $translator->get("Registrieren") ?>" />
	</fieldset>
</form>