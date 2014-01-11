<?php
class CartItem {
	private $album_id;
	private $count;
	private $withDigital;
	
	public function __construct($album_id, $count, $withDigital) {
		$this->album_id = $album_id;
		$this->count = $count;
		
		if (isset($withDigital) && in_array($this->album_id, $withDigital)) {
			$this->withDigital = true;
		}
	}
	
	public function getID() {
		return $this->album_id;
	}
	
	public function getCount() {
		return $this->count;
	}
	
	public function setCount($count) {
		$this->count = $count;
	}
	
	public function increaseCount() {
		$this->count += 1;
	}
	
	public function getWithDigital() {
		return $this->withDigital;
	}
	
	public function setWithDigital($withDigital) {
		$this->withDigital = $withDigital;
	}
}
?>