<?php
require('fpdf.php');
session_start();

$products = [
    1 => ["name" => "Pelota de Fútbol", "price" => 15000],
    2 => ["name" => "Balón de Básquetbol", "price" => 18000],
    3 => ["name" => "Raqueta de Tenis", "price" => 30000],
    4 => ["name" => "Guantes de Boxeo", "price" => 25000]
];

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',16);
        $this->Cell(0,10,'Boleta de Compra',0,1,'C');
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
    }
}
?>
