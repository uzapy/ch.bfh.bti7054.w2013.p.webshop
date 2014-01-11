<?php
require('fpdf.php');
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	
	$pdf->Cell(80,10,'Plattelade - Bestellungen',0, 1);
	
	$pdf->SetFont('Arial','',12);
	
	$tot_price = 0;
	
	foreach ($_SESSION["warenkorb"] as $key => $value) {
	
		$query = "SELECT * FROM Platten WHERE ID = ".$value->getID();
		
		if ($result = $mysql->query($query)) {
		
			$platte = $result->fetch_object();
			$preis = ((int)$platte->Price)*(int)$value->getCount();
			
			if($value->getWithDigital() == "on") {
				$preis = $preis + 9.9;
			}
			
			$pdf->Cell(90,10,$value->getCount()."x ".$platte->Artist ." - ". $platte->Album,0, 1);
			
			$pdf->Cell(180,10, $preis." CHF", 0, 2, 'R');
			
			//total preis errechnen
			$tot_price = $tot_price + $preis;
			
		}
	}
	
	$pdf->SetFont('Arial','B',12);
	
	$pdf->Cell(180,10,'Total: '.$tot_price.' CHF',0, 1, 'R');
	
	$pdf->Output('Resources/Bestellungen/bestellung_'.$order_id.'.pdf','F');
?>