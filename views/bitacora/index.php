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
        $this->Cell(60, 10, utf8_decode('Bitácora de préstamos'), 1, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(25, 10, utf8_decode('Préstamó'), 1, 0, 'C', 0);
        $this->Cell(25, 10, utf8_decode('Hora'), 1, 0, 'C', 0);
        $this->Cell(30, 10, utf8_decode('Solicitó'), 1, 0, 'C', 0);
        $this->Cell(30, 10, utf8_decode('Prestó'), 1, 0, 'C', 0);
        $this->Cell(30, 10, utf8_decode('Recibió'), 1, 0, 'C', 0);
        $this->Cell(25, 10, utf8_decode('Devolución'), 1, 0, 'C', 0);
        $this->Cell(25, 10, utf8_decode('Hora'), 1, 1, 'C', 0);
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
$pdf->SetFont('Times', '', 12);
foreach ($bitacora as $fila) {
    $pdf->Cell(25, 10, $fila->fecha_prestamo, 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $fila->hora_prestamo, 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $fila->solicitante, 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $fila->prestador, 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $fila->recibidor, 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $fila->fecha_devolucion, 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $fila->hora_devolucion, 1, 0, 'C', 0);
}
$pdf->Output();

?>

<!-- <?php include_once __DIR__ . '/../admin/header-admin.php' ?>
<table class="tabla-bitacora">
    <thead class="tabla-encabezado">
        <th>Fecha Prestamo</th>
        <th>Hora Prestamo</th>
        <th>Solicitó</th>
        <th>Prestó</th>
        <th>Recibió</th>
        <th>Fecha Entrega</th>
        <th>Hora Entrega</th>
    </thead>
    <tbody class="tabla-cuerpo">
        <?php
        foreach ($bitacora as $fila) { ?>
            <tr>
                <td><?php echo $fila->fecha_prestamo ?></td>
                <td><?php echo $fila->hora_prestamo ?></td>
                <td><?php echo $fila->solicitante ?></td>
                <td><?php echo $fila->prestador ?></td>
                <td><?php echo $fila->recibidor ?></td>
                <td><?php echo $fila->fecha_devolucion ?></td>
                <td><?php echo $fila->hora_devolucion ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php include_once __DIR__ . '/../admin/footer-admin.php' ?> -->