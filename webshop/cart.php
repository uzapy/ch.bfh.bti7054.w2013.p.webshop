
<?php
if (!isset($_SESSION["warenkorb"])) {
	$_SESSION["warenkorb"] = array();
}

if(isset($_POST["refresh"])) {

	foreach($_POST['anzahl'] as $felder) {
		echo $felder;
	}

}
 

//warenkorb leeren
//unset($_SESSION["warenkorb"]);

//print_r($_SESSION["warenkorb"]);

if(isset($_GET["item"])) {

	if(!isset($_GET["del"])) {
		// album hinzufügen
		
		$album = array();
		$album["album_id"] = $_GET["item"];
		$album["anzahl"] = 1;
		$album["digital"] = "0";
		
		if(empty($_SESSION["warenkorb"])) {
			// neues album in den warebkorb
			$_SESSION["warenkorb"][$album["album_id"]] = $album;
		} else {		
			if($_SESSION["warenkorb"][$album["album_id"]]["album_id"] != $album["album_id"]) {
				// neues album in den warebkorb
				$_SESSION["warenkorb"][$album["album_id"]] = $album;
			} else {
				//bisheriges album um 1 erhöhen
				$_SESSION["warenkorb"][$album["album_id"]]["anzahl"] = $_SESSION["warenkorb"][$album["album_id"]]["anzahl"] + 1;
			}
		}
	} else {
		// album entfernen
		unset($_SESSION["warenkorb"][$_GET["item"]]);
	}


}

if(!empty($_SESSION["warenkorb"])) {
	
	echo '<ul><form action="?site=cart" method="POST" name="warenkorb_form">';
	$tot_price = 0;
	
	foreach ($_SESSION["warenkorb"] as $key => $value) {
	
		
	$query = "SELECT * FROM Platten WHERE ID = ".$value["album_id"];
	
	if ($result = $mysql->query($query)) {
	
		$platte = $result->fetch_object();
		$preis = $platte->Price*$value["anzahl"];
		
			?>
				<li>
					<div class="platte" stlye="width:100%;">
						<input type="hidden" name="album_id" value="<? echo $value["album_id"];?>">
							<img class="album_cover" alt="<? echo $platte->Album ?>"
							src="Resources/Covers/<? echo $platte->CoverName ?>" />
						<div class="album_info" stlye="display:inline-table;width:100%;">
							<h4>
									<? echo $platte->Artist ." - ". $platte->Album ?>
							</h4>
							<span class="album_details">Anzahl <input type="number" value="<? echo $value["anzahl"];?>" name="anzahl[]"></span>
							
							<span class="album_details">Digitaler Download? <input type="checkbox" name="digital[]"></span>
							
							<span class="album_details"> <? echo $platte->Price*$value["anzahl"];?> CHF</span>
							
							<span class="album_details"> <a href="?site=cart&item=<? echo $value["album_id"];?>&del">X</a></span>
						</div>
					</div>
				</li>
		<?
		
		//total preis errechnen
		$tot_price = $tot_price + $preis;
		
		}
		
	
	}

	echo '<li>Total: '.$tot_price.' CHF</li> <input type="submit" name="refresh" value="Aktualisieren" />
</form><ul>';
	
} else {
	echo "Der Warenkorb ist leer";
}
	
	
?>

