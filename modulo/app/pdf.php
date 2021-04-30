<?php
require('fpdf.php');


class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../../img/logo.png', 10, 8, 43);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 8);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(80, 10, utf8_decode('Reporte Presupuesto Semanal'), 1, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(15, 10, "Fecha", 1, 0, 'C', 0);
        $this->Cell(50, 10, "Articulo", 1, 0, 'C', 0);
        $this->Cell(20, 10, "Valor Total", 1, 0, 'C', 0);
        $this->Cell(25, 10, "Centro de Costo", 1, 0, 'C', 0);
        $this->Cell(33, 10, "Proveedor", 1, 0, 'C', 0);
        $this->Cell(55, 10, "Detalles", 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 10);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Page ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

require '../../helper/conexion-pdf.php';
$consulta = "SELECT mantenimiento.id, mantenimiento.fecha, mantenimiento.articulo, mantenimiento.valor_total, 
    centro_costo.centro_costo, mantenimiento.proveedor, mantenimiento.detalles 
    from mantenimiento inner join centro_costo on centro_costo.id = mantenimiento.centro_costo ;";

$resultado = $mysqli->query($consulta);


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 7);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(15, 10, $row['fecha'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $row['articulo'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, number_format($row['valor_total'], 2, ",", "."), 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $row['centro_costo'], 1, 0, 'C', 0);
    $pdf->Cell(33, 10,  utf8_decode($row['proveedor']), 1, 0, 'C', 0);
    $pdf->Cell(55, 10,  utf8_decode($row['detalles']), 1, 1, 'C', 0);
}


$pdf->Output();
