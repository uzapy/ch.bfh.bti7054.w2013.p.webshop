<?php
class PdfCreator {
	private $platten;
	private $cart;
	private $orderID;
	private $totalPrice = 0;
	private $pdf;
	
	public function __construct($platten, $cart, $orderID) {
		$this->platten = $platten;
		$this->cart = $cart;
		$this->orderID = $orderID;
		$this->pdf = new FPDF();
		$this->database = new Database();
	}
	
	public function create() {
		$this->pdf->AddPage();
		
		$this->pdf->SetFont('Arial','B',16);
		
		$this->pdf->Cell(80,10,'Plattelade - Bestellungen', 0, 1);
		
		$this->pdf->SetFont('Arial','',12);
		
		foreach ($this->platten as $key => $value) {
			
			$cartItem = $this->cart[$value->ID];
			$preis = ((int)$value->Price)*(int)$cartItem->count;
				
			if($cartItem->withDigital == "on") {
				$preis = $preis + 9.9;
			}
				
			$this->pdf->Cell(90,10,$cartItem->count."x ".$value->Artist ." - ". $value->Album, 0, 1);
				
			$this->pdf->Cell(180,10, $preis." CHF", 0, 2, 'R');
				
			//total preis errechnen
			$this->totalPrice += $preis;
		}
		
		$this->pdf->SetFont('Arial','B',12);
		
		$this->pdf->Cell(180,10,'Total: ' . $this->totalPrice . ' CHF', 0, 1, 'R');
		
		$this->pdf->Output('Resources/Bestellungen/bestellung_' . $this->orderID . '.pdf','F');
	}
}
?>