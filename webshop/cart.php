<?php
// Falls die Variable nicht existiert, neu erstellen.
if (!isset($_SESSION["warenkorb"])) {
	$_SESSION["warenkorb"] = array();
}

$shoppingCart = $_SESSION["warenkorb"];

//warenkorb aktualisieren
if(isset($_POST["refresh"])) {

	for($i=0;$i<=count($_POST["album_id"])-1; $i++) {
		$chk_digital = isset($_POST["chk_digital"]) ? $_POST["chk_digital"] : null;
		$currentAlbum = new CartItem($_POST["album_id"][$i], $_POST["anzahl"][$i], $chk_digital);
		
		$shoppingCart[$currentAlbum->getID()]->setCount($currentAlbum->getCount());
		
		if($currentAlbum->getWithDigital() != null) {
			$shoppingCart[$currentAlbum->getID()]->setWithDigital($currentAlbum->getWithDigital());
		} else {
			$shoppingCart[$currentAlbum->getID()]->setWithDigital(null);
		}
	}
}

//warenkorb leeren
if(isset($_GET["clear"])) {
	unset($_SESSION["warenkorb"]);
	unset($shoppingCart);
}

if(isset($_GET["item"])) {

	if(!isset($_GET["del"])) {
		// album hinzufŸgen
		$newAlbum = new CartItem($_GET["item"], 1, null);
		
		if(empty($shoppingCart)) {
			// neues album in den warenkorb
			$shoppingCart[$newAlbum->getID()] = $newAlbum;
		} else if(!isset($shoppingCart[$newAlbum->getID()])) {
			// neues album in den warenkorb
			$shoppingCart[$newAlbum->getID()] = $newAlbum;
		} else  {
			//bisheriges album um 1 erhšhen
			$shoppingCart[$newAlbum->getID()]->increaseCount();
		}
	} else {
		// album entfernen
		unset($shoppingCart[$_GET["item"]]);
	}
}

if(!empty($shoppingCart)) {
	
	echo '<ul><form action="?site=cart" method="POST" name="warenkorb_form">';
	
	$tot_price = 0;
	
	foreach ($shoppingCart as $key => $value) {
	
		if(isset($key)) {
			
			$query = "SELECT * FROM Platten WHERE ID = ".$key;
		
			if ($result = $mysql->query($query)) {
			
				$platte = $result->fetch_object();
				
				$preis = ((double)$platte->Price)*(int)$value->getCount();
				
				if($value->getWithDigital() == "on") {
					$preis = $preis + 9.9;
				}
				?>
					<li>
						<div class="platte">
							
							<input type="hidden" name="album_id[]" value="<? echo $platte->ID ?>">
							
								<img class="album_cover" alt="<? echo $platte->Album ?>"
								src="Resources/Covers/<? echo $platte->CoverName ?>" />
								
								<div class="album_info">
								<h4>
									<? echo $platte->Artist ." - ". $platte->Album; ?>
								</h4>
								<span class="album_details">Anzahl
									<input type="number" value="<? echo $value->getCount();?>" name="anzahl[]">
								</span>
								<span class="album_details">
									<input type="checkbox" value="<? echo $platte->ID ?>" name="chk_digital[]" <? if($value->getWithDigital()=='on') { echo ' checked';}?> />
									Inklusive Digitaler Download?</span>
								
								<span class="album_details rechts">
									<a href="?site=cart&item=<? echo $platte->ID; ?>&del">X</a>
								</span>
								
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
				<span class="album_details rechts">&nbsp;&nbsp;</span>
				<span class="album_details rechts">Total: <b>'.number_format($tot_price, 0, '', '`').' CHF</b></span>
			</div>
		</li>
		<li>Warenkorb
			<input type="submit" name="refresh" value="aktualisieren" />
			<input type="button" name="refresh" value="leeren" onclick="location.href=\'?site=cart&clear\'"/>
		</li>
	</form>
	<li>
		<br><input class="rechts" type="button" name="refresh" value="Weiter zu den Versandoptionen" onclick="location.href=\'?site=checkout\'"/>
	</li>
<ul>';
	
} else {
	echo "Der Warenkorb ist leer";
}
	
if (isset($shoppingCart)) {
	$_SESSION["warenkorb"] = $shoppingCart;
}	
?>

