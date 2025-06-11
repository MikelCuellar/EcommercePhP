<?php 
include 'generate_invoice_logic.php'; 

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$total = 0;
foreach ($_SESSION['cart'] as $id => $quantity) {
    $product = $products[$id];
    $subtotal = $product['price'] * $quantity;
    $total += $subtotal;
    $pdf->Cell(0,10, "{$product['name']} x{$quantity} - $".number_format($subtotal, 0, ',', '.'),0,1);
}

$pdf->Ln(10);
$pdf->Cell(0,10,"Total: $".number_format($total, 0, ',', '.'),0,1);
$pdf->Output();
?>
