<form accept-charset="utf-8" id="checkoutForm" autocomplete="on" action="?site=start" method="POST" name="registerForm">
	<fieldset>
		<p>
			<label for="shipping"><? echo $translator->get("Versandoptionen") ?>:</label>
			<select name="shipping" size="1">
				<option value="<? echo $translator->get("Postpaket") ?>"><? echo $translator->get("Postpaket") ?></option>
				<option value="<? echo $translator->get("DeFex Express") ?>"><? echo $translator->get("DeFex Express") ?></option>
				<option value="<? echo $translator->get("Economy") ?>"><? echo $translator->get("Economy") ?></option>
			</select>
		</p>
	</fieldset>
</form>

<br>

<a href="PDF/order.php">Bestellung als PDF anzeigen</a>