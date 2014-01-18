<?php
if(isset($_SESSION['kunde'])) {
	if (!empty($_SESSION["warenkorb"])) {

		// Warenkorb aus der SESSION-Varieble lesen
		$shoppingCart = new ShoppingCart($_SESSION["warenkorb"], $database);
		// Alle Platten im Warenkorb aus der DB laden
		$albums = $shoppingCart->getAlbumsInCart();
		
		echo '<ul>';
		foreach ($albums as $album) {
			$cartItem = $shoppingCart->cart[$album->ID];
			$isChecked = $cartItem->withDigital == 'on' ? $translator->get("Ja") : $translator->get("Nein");
			$digitalDownloadPrice = $cartItem->withDigital == 'on' ? '(+9.90)' : "";
			?>
				<li>
					<div class="platte">
						<a href="?site=detail&item=<? echo $album->ID . $translator->getLangUrl() ?>">
							<img class="album_cover" alt="<? echo $album->Album ?>"
							src="Resources/Covers/<? echo $album->CoverName ?>" />
						</a>
						<div class="album_info">
							<h4><? echo $album->Artist ." - ". $album->Album ?></h4>
							<p>
								<span class="detail_left"><? echo $translator->get("Anzahl").':' ?></span>
								<span><? echo $cartItem->count ?></span>
							</p>
							<p>
								<span class="detail_left"><? echo $translator->get("Mit digitalem Download").':' ?></span>
								<span><? echo $isChecked ?></span>
							</p>
							<p>
								<span class="detail_left"><? echo $translator->get("Preis").':' ?></span>
								<span><b><? echo $album->Price . ' ' . $digitalDownloadPrice . ' CHF' ?></b></span>
							</p>
						</div>
					</div>
				</li>
			<?
		}	
		echo '</ul>';
		// Bestellungs-Optionen Formular
		?>
	
		<div class="total_container">
			<span class="detail_left total"><? echo $translator->get("Total").':' ?></span>
			<span><b><? echo $shoppingCart->totalPrice ?> CHF</b></span>
		</div>
		
		<script src="JS/validation.js"></script>
		<form action="?site=start<? echo $translator->getLangUrl() ?>" method="POST" name="checkout"
			onsubmit="return confirmPurchase();">
			<fieldset>
				<p class="total_container">
					<label class="detail_left" for="shipping"><? echo $translator->get("Versandoptionen") ?>:</label>
					<select name="shipping" size="1">
						<option value="<? echo $translator->get("Postpaket") ?>"><? echo $translator->get("Postpaket") ?></option>
						<option value="<? echo $translator->get("DeFex Express") ?>"><? echo $translator->get("DeFex Express") ?></option>
						<option value="<? echo $translator->get("Economy") ?>"><? echo $translator->get("Economy") ?></option>
					</select>
				</p>
				<p class="total_container">
					<label class="detail_left" for="payment"><? echo $translator->get("Bezahloptionen") ?>:</label>
					<select name="payment" size="1">
						<option value="<? echo $translator->get("Rechnung") ?>"><? echo $translator->get("Rechnung") ?></option>
						<option value="<? echo $translator->get("Kreditkarte") ?>"><? echo $translator->get("Kreditkarte") ?></option>
						<option value="<? echo $translator->get("PostFinance") ?>"><? echo $translator->get("PostFinance") ?></option>
					</select>
				</p>
			</fieldset>
			<div class="total_container">
				<input class="detail_left" type="submit" name="bestellung" value=<? echo $translator->get("Bestellung absenden") ?> />
			</div>
		</form><?
	} else {
		echo $translator->get("Der Warenkorb ist leer");
	}
} else {
	echo $translator->get("Bitte loggen sie sich ein");
}
?>