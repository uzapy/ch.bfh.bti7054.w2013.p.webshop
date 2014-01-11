<?php
require('fpdf.php');

session_start();

include '../php/db_connection.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->Cell(80,10,'Plattelade - Bestellungen',0, 1);

$pdf->SetFont('Arial','',12);

$tot_price = 0;

foreach ($_SESSION["warenkorb"] as $key => $value) {
	
	
	if(isset($value["album_id"])) {
		$query = "SELECT * FROM Platten WHERE ID = ".$value["album_id"];
		
		if ($result = $mysql->query($query)) {
		
			$platte = $result->fetch_object();
			$preis = ((int)$platte->Price)*(int)$value["anzahl"];
			
			//$pdf->Image('../Resources/Covers/'.$platte->CoverName, 10, 20, 20, 20);
			
			$pdf->Cell(90,10,$value["anzahl"]."x ".$platte->Artist ." - ". $platte->Album,0, 1);
			
			$pdf->Cell(180,10, $preis." CHF", 0, 2, 'R');
			
			//total preis errechnen
			$tot_price = $tot_price + $preis;
			
		}
	}
}


$pdf->SetFont('Arial','B',12);


$pdf->Cell(180,10,'Total: '.$tot_price.' CHF',0, 1, 'R');


$pdf->Output();
?>