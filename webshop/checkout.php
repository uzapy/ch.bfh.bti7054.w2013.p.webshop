<?
if(isset($_SESSION['kunde'])) {


	if(!empty($_SESSION["warenkorb"])) {
	
	/*

x restricted

email & pdf

mysql insert 

 */
 
 
 
 
 echo '<ul>';
	$tot_price = 0;
	
	foreach ($_SESSION["warenkorb"] as $key => $value) {
	
	if(isset($value["album_id"])) {
		$query = "SELECT * FROM Platten WHERE ID = ".$value["album_id"];
		
		if ($result = $mysql->query($query)) {
		
			$platte = $result->fetch_object();
			$preis = ((int)$platte->Price)*(int)$value["anzahl"];
			
				?>
					<li>
						<div class="platte">
							
								<img class="album_cover" alt="<? echo $platte->Album ?>"
								src="Resources/Covers/<? echo $platte->CoverName ?>" />
								
							<div class="album_info>
								<h4>
										<? echo $platte->Artist ." - ". $platte->Album; ?>
								</h4>
								<span class="album_details">Anzahl: <? echo $value["anzahl"];?></span><br>
								<span class="album_details">Digitaler Download? <? echo  ($value["digital"]=='on') ? ' JA' : 'Nein';?></span>
		
								<span class="album_details rechts"> <? echo $preis;?> CHF</span>
								
							</div>
						</div>
					</li>
			<?
			
			//total preis errechnen
			$tot_price = $tot_price + $preis;
			
			}	
		}
	}

echo '<li class="blank">
	
	<div class="platte blank">
		<span class="album_details rechts"></span>
		<span class="album_details rechts">Total: <b>'.number_format($tot_price, 0, '', '`').' CHF</b></span>
	</div>
	</li></ul>';
 
?>

<br><br><br><br>

<form accept-charset="utf-8" id="checkoutForm" autocomplete="on" action="?site=checkout" method="POST" name="registerForm">
	<fieldset>
		<p>
			<label for="shipping"><? echo $translator->get("Versandoptionen") ?>:</label>
			<select name="shipping" size="1">
				<option value="<? echo $translator->get("Postpaket") ?>"><? echo $translator->get("Postpaket") ?></option>
				<option value="<? echo $translator->get("DeFex Express") ?>"><? echo $translator->get("DeFex Express") ?></option>
				<option value="<? echo $translator->get("Economy") ?>"><? echo $translator->get("Economy") ?></option>
			</select>
		</p>
		<p>
			<label for="payment"><? echo $translator->get("Bezahloptionen") ?>:</label>
			<select name="payment" size="1">
				<option value="<? echo $translator->get("Rechnung") ?>"><? echo $translator->get("Rechnung") ?></option>
				<option value="<? echo $translator->get("Kreditkarte") ?>"><? echo $translator->get("Kreditkarte") ?></option>
				<option value="<? echo $translator->get("PostFinance") ?>"><? echo $translator->get("PostFinance") ?></option>
			</select>
		</p>
	</fieldset>
	
	<br>
<input type="submit" name="bestellung_submit" value="Bestellung absenden" />

</form>

	<?
	} else {
	?>
	Der Warenkorb ist leer
	<?
	}


} else {
?>
Bitte loggen sie sich ein
<?
}
?>