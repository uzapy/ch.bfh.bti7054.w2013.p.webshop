<?php
class ShoppingCart {
	private $database;
	private $albums = array();
	public $cart;
	public $totalPrice = 0;
	
	public function __construct($cart, $database) {
		$this->cart = $cart;
		$this->database = $database;
	}
	
	// Neues Album zum Warenkorb hinzufŸgen, oder Anzahl von einem bestehenden erhšhen
	public function add($id) {
		$newAlbum = new CartItem($id, 1, null);
		
		if(empty($this->cart) || !isset($this->cart[$newAlbum->ID])) {
			// Neues Album in den Warenkorb
			$this->cart[$newAlbum->ID] = $newAlbum;
		} else  {
			// Bisheriges Album um 1 erhšhen
			$this->cart[$newAlbum->ID]->increaseCount();
		}
	}
	
	// Album aus dem Warenkorb entfernen
	public function remove($id) {
		unset($this->cart[$id]);
	}
	
	// Durch alle Alben gehen und Werte aktualisieren (Anzahl / mit oder ohne digitalen Download)
	public function refresh($albumIDs, $albumCounts, $albumDigitals) {
		for($i=0; $i<=count($albumIDs)-1; $i++) {
			$albumDigitalChecked = isset( $albumDigitals ) ? $albumDigitals : null;
		
			$currentAlbum = new CartItem($albumIDs[$i], $albumCounts[$i], $albumDigitalChecked );
		
			if ($currentAlbum->count == 0) {
				$this->remove($currentAlbum->ID);
			} else {
				$this->cart[$currentAlbum->ID]->count = $currentAlbum->count;
			
				if ($currentAlbum->withDigital != null) {
					$this->cart[$currentAlbum->ID]->withDigital = $currentAlbum->withDigital;
				} else {
					$this->cart[$currentAlbum->ID]->withDigital = null;
				}
			}
			
		}
	}
	
	// Alle Alben im Warenkorb aus der DB laden und Preis berechnen
	public function getAlbumsInCart() {
		foreach ($this->cart as $item) {
			$album = $this->database->getPlatte($item->ID);
			array_push($this->albums, $album);
			
			$preis = ((double)$album->Price) * ((double)$item->count);
				
			if($item->withDigital == "on") {
				$preis += 9.9;
			}
			
			$this->totalPrice += $preis;
			
		}
		return $this->albums;
	}
}
?>