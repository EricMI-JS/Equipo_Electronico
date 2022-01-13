<?php

use Classes\FPDF;

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Times', 'B', 12);
        // Movernos a la derecha
        $this->Cell(65);
        // Título
        $this->Cell(60, 10, utf8_decode('Folios Componentes'), 1, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true);
$pdf->SetFont('Times', '', 12);
foreach ($componentes as $componente) {
    $pdf->SetX(55);
    $pdf->Cell(25, 10, $componente->id, 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $componente->nombre, 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $componente->categoria, 1, 1, 'C', 0);
}
$pdf->Output();
