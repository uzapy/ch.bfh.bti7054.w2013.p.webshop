<?
if(isset($_SESSION['kunde'])) {
	
	if(!empty($_SESSION["warenkorb"])) {

	 	echo '<ul>';
		$tot_price = 0;
		
		foreach ($_SESSION["warenkorb"] as $key => $value) {
		
			$a_id = $value->ID;
		
			if(isset($a_id)) {
				
				$a_count = $value->count;	
				$a_digi = $value->withDigital;
				$platte = $platte = $database->getPlatte($a_id);
				$preis = ((int)$platte->Price)*(int)$a_count;
				
				if($value->withDigital == "on") {
					$preis = $preis + 9.9;
				}
				
				//total preis errechnen
				$tot_price = $tot_price + $preis;
				
				?><li>
					<div class="platte">
						<img class="album_cover" alt="<? echo $platte->Album ?>" src="Resources/Covers/<? echo $platte->CoverName ?>" />
						<div class="album_info">
							<h4><? echo $platte->Artist ." - ". $platte->Album; ?></h4>
							<span class="album_details">Anzahl: <? echo $a_count;?></span><br>
							<span class="album_details">Inklusive Digitaler Download? <? echo  ($a_digi=='on') ? ' JA' : 'Nein';?></span>
							<span class="album_details rechts"> <? echo $preis;?> CHF</span>
						</div>
					</div>
				</li><?				
			}
		}
	
	?><li class="blank">
			<div class="platte blank">
				<span class="album_details rechts"></span>
				<span class="album_details rechts">Total: <b><? echo number_format($tot_price, 0, '', '`') ?> CHF</b>
				</span>
			</div>
		</li>
	</ul>
	
	<br/><br/><br/><br/>
	
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
		echo "Der Warenkorb ist leer";
	}
} else {
	echo "Bitte loggen sie sich ein";
}
?>