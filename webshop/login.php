<script type="text/javascript">
function form_validation () {
	// alert('test');
}
</script>

<form action="javascript: form_validation();" method="POST" name="login">
	<fieldset>
		<p>
			<label for="email"><? echo $translator->get("E-Mail Adresse") ?>:</label>
			<input id="email" name="email" required="required" type="text" placeholder="mymail@mail.com" />
		</p>
		<p>
			<label for="password"><? echo $translator->get("Passwort") ?>:</label>
			<input id="password" name="password" required="required" type="password" placeholder="X8df!90EO" />
		</p>
		<input type="submit" value="Login" />
	</fieldset>
</form>