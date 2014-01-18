<?php
if (!isset($_SESSION["warenkorb"])) {
	$_SESSION["warenkorb"] = array();
}

// Warenkorb aus der SESSION-Varieble lesen
$shoppingCart = new ShoppingCart($_SESSION["warenkorb"], $database);

// Neue Platte zu Warenkorb hinzhufügen
if (isset($addItem)) {
	$shoppingCart->add($addItem);
}
// Platte aus Warenkorb entfernen
if (isset($removeItem)) {
	$shoppingCart->remove($removeItem);
}

// Änderungen am Warenkorb speichern
if(isset($_POST["save"])) {
	$albumDigitals = null;
	if (isset($_POST["album_digital"]) && count($_POST["album_digital"]) > 0) {
		$albumDigitals = $_POST["album_digital"];
	}
	$shoppingCart->refresh($_POST["album_id"], $_POST["album_count"], $albumDigitals);
}

// Alle Platten im Warenkorb aus der DB laden
$albums = $shoppingCart->getAlbumsInCart();
if (count($albums) > 0) {
?>
<form action="?site=cart<? echo $translator->getLangUrl() ?>" method="POST" name="shopping_cart">
	<ul>
		<?
		foreach ($albums as $album) {
			$cartItem = $shoppingCart->cart[$album->ID];
			$isChecked = $cartItem->withDigital == 'on' ? "checked='checked'" : "";
			$digitalDownloadPrice = $cartItem->withDigital == 'on' ? '(+9.90)' : "";
			?>
			<li>
				<input type="hidden" name="album_id[]" value="<? echo $album->ID ?>">
				<div class="platte">
					<a href="?site=detail&item=<? echo $album->ID . $translator->getLangUrl() ?>">
						<img class="album_cover" alt="<? echo $album->Album ?>"
						src="Resources/Covers/<? echo $album->CoverName ?>" />
					</a>
					<div class="album_info">
						<h4><? echo $album->Artist ." - ". $album->Album ?></h4>
						<p>
							<span class="detail_left"><? echo $translator->get("Anzahl").':' ?></span>
							<input class="count_input" name="album_count[]" type="number" value="<? echo $cartItem->count;?>" />
						</p>
						<p>
							<span class="detail_left"><? echo $translator->get("Mit digitalem Download").':' ?></span>
							<input class="check_input" name="album_digital[]" type="checkbox" value="<? echo $album->ID ?>" <? echo $isChecked ?>/>
						</p>	
						<p>
							<span class="detail_left"><? echo $translator->get("Preis").':' ?></span>
							<span><b><? echo $album->Price . ' ' . $digitalDownloadPrice . ' CHF' ?></b></span>
						</p>
						<p>
							<a class="link" href="?site=cart&remove=<? echo $album->ID . $translator->getLangUrl(); ?>">
								<? echo $translator->get("Entfernen") ?>
							</a>
						</p>
					</div>
				</div>
			</li>
			<?
		}
		?>
	</ul>
	
	<div class="total_container">
		<span class="detail_left total"><? echo $translator->get("Total").':' ?></span>
		<span><b><? echo $shoppingCart->totalPrice ?> CHF</b></span>
	</div>
	
	<div class="total_container">
		<input class="detail_left" type="submit" name="save" value="<? echo $translator->get("Änderungen speichern") ?>" />
		<a class="link" href="?site=checkout<? echo $translator->getLangUrl() ?>"><? echo $translator->get("Bestellen") ?></a>
	</div>
	
</form>
<?php
} else {
	echo $translator->get("Der Warenkorb ist leer");
}

// Änderungen am Warenkorb in SESSION-Variable speichern
if (isset($shoppingCart->cart)) {
	$_SESSION["warenkorb"] = $shoppingCart->cart;
}
?>