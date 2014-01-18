<script src="JS/validation.js"></script>
<form accept-charset="utf-8" id="registerForm" autocomplete="on" action="?site=start<? echo $translator->getLangUrl(); ?>" 
	method="POST" name="registerForm" onsubmit="return validateRegister();">

	<fieldset>
		<p>
			<label class="detail_left" for="new_email"><? echo $translator->get("E-Mail Adresse") ?>:</label>
			<input id="new_email" name="new_email" required="required" type="text" placeholder="mymail@mail.com" />
		</p>
		<p>
			<label class="detail_left" for="lastfm"><? echo $translator->get("Last.fm Benutzername") ?>:</label>
			<input id="lastfm" name="lastfm" type="text" />
		</p>
		<p>
			<label class="detail_left" for="firstname"><? echo $translator->get("Vorname") ?>:</label>
			<input id="firstname" name="firstname" required="required" type="text" />
		</p>
		<p>
			<label class="detail_left" for="lastname"><? echo $translator->get("Nachname") ?>:</label>
			<input id="lastname" name="lastname" required="required" type="text" />
		</p>
		<p>
			<label class="detail_left" for="phone"><? echo $translator->get("Telefonnummer") ?>:</label>
			<input id="phone" name="phone" type="number" placeholder="031 123 45 67" />
		</p>
		<p>
			<label class="detail_left" for="street"><? echo $translator->get("Strasse") ?>:</label>
			<input id="street" name="street" type="text" required="required" />
		</p>
		<p>
			<label class="detail_left" for="number"><? echo $translator->get("Nummer") ?>:</label>
			<input id="number" name="number" type="number" required="required" />
		</p>
		<p>
			<label class="detail_left" for="postal"><? echo $translator->get("PLZ") ?>:</label>
			<input id="postal" name="postal" type="number" required="required" />
		</p>
		<p>
			<label class="detail_left" for="city"><? echo $translator->get("Ort") ?>:</label>
			<input id="city" name="city" type="text" required="required" />
		</p>
		<p>
			<label class="detail_left" for="new_password"><? echo $translator->get("Passwort") ?>:</label>
			<input id="new_password" name="new_password" required="required" type="password" placeholder="X8df!90EO" />
		</p>
		<p>
			<label class="detail_left" for="new_password_confirm"><? echo $translator->get("Passwort wiederholen") ?>:</label>
			<input id="new_password_confirm" name="new_password_confirm" required="required" type="password" placeholder="X8df!90EO" />
		</p>
		<input class="login_container" type="submit" value="<? echo $translator->get("Registrieren") ?>" />
	</fieldset>
</form>