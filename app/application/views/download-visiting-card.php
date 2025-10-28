<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../fpdf/fpdf.php');

class IDCardPDF extends FPDF {
    function Header() {
        // No border rectangle needed since background is an image
    }

    function Footer() {
        $this->SetFont('Arial', 'I', 8);
    }
}

// Create PDF
$pdf = new IDCardPDF('P', 'mm', 'A4'); // ID card size
$pdf->AddPage();

// Set Background Image (adjust width and height to match the card size)
$pdf->Image('../assets/images/card.jpeg', 0, 0, 85.6, 53.98); 
$pdf->SetTitle('Visiting Card');

// Add Text Over Image
$pdf->SetFont('Arial', 'B', 7);
// $pdf->SetTextColor(255, 255, 255);
$pdf->Ln(1.8);
$pdf->SetX(20); // Set position for text
$pdf->Cell(0, 0, $profile[0]->name);

$pdf->Ln(3.5);
$pdf->SetX(20);
$pdf->Cell(0, 0, $profile[0]->customer_id);

$pdf->SetFont('Arial', '', 6);
$pdf->Ln(9.5);
$pdf->SetX(10);
$pdf->Cell(0, 0, $profile[0]->mobile);

$pdf->Ln(6.5);
$pdf->SetX(10);
$pdf->Cell(0, 0, $profile[0]->email);

$pdf->Ln(5);
$pdf->SetX(10);
$pdf->MultiCell(26, 2, $profile[0]->address);

$pdf->Image('../portal_assets/images/logo.png', 48.5, 14.5, 26, 26);

// Output PDF to browser
$pdf->Output();
?>
