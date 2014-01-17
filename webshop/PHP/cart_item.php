<?php
// Element im Warenkorb
class CartItem {
	public $ID;
	public $count;
	public $withDigital;
	
	public function __construct($album_id, $count, $withDigital) {
		$this->ID = $album_id;
		$this->count = $count;
		
		if (isset($withDigital) && in_array($this->ID, $withDigital)) {
			$this->withDigital = true;
		}
	}
	
	public function increaseCount() {
		$this->count += 1;
	}
}
?>