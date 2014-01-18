<?php
// http://tympanus.net/codrops/2009/12/30/easy-php-site-translation/
class Translator {

    private $language	= 'de';
	private $lang		= array();
	
	public function __construct($language) {
		$this->language = $language;
	}
	
	// String abhŠngig von der Sprache aus dem Array lesen
    private function findString($str) {
        if (array_key_exists($str, $this->lang[$this->language])) {
			return $this->lang[$this->language][$str];
        }
        return $str;
    }
    
	private function splitStrings($str) {
        return explode('=',trim($str));
    }
	
    // String oder dessen †bersetzung auslesen
	public function get($str) {	
        if (!array_key_exists($this->language, $this->lang)) {
            if (file_exists('Resources/Language/'.$this->language.'.txt')) {
                $strings = array_map(array($this,'splitStrings'), file('Resources/Language/'.$this->language.'.txt'));
                
                foreach ($strings as $key => $value) {
					$this->lang[$this->language][$value[0]] = $value[1];
                }
                return $this->findString($str);
            }
            else {
                return $str;
            }
        }
        else {
            return $this->findString($str);
        }
    }
    
    // Aktuelle Sprache als GET-Parameter ausgeben
    public function getLangUrl() {
    	if(isset($_GET['lang'])) {
    		return '&lang=' . $this->language;
    	}
    }
    
    // Aktuelle Sprache zurŸckgeben
    public function getActiveLang($str) {
    	if ($str == $this->language) {
    		return ' active';
    	}
    }
}
?>