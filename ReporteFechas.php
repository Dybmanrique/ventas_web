<?php

require 'fpdf/fpdf1/fpdf.php';
require_once 'classes/cSetup.php';

$setup = new Setup();

if ($setup->db) {

    $inicio = $_POST['fecha_inicio'];
    $fin = $_POST['fecha_fin'];

    $sql = "SELECT v.numero, v.serie, v.fecha, v.total, c.razonsocial 
            FROM ventas v 
            INNER JOIN clientes c ON v.idcliente = c.idcliente 
            WHERE v.fecha between :fecha_inicio and :fecha_fin";

    $stmt = $setup->db->prepare($sql);
    $stmt->execute(['fecha_inicio' => $inicio, 'fecha_fin' => $fin]);

    $ventas = [];
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ventas[] = $fila;
    }

    $pdf = new FPDF("P", "mm", "letter");
    $pdf->AddPage();
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(190, 5, "Reporte de ventas desde el ".$inicio." hasta el ".$fin, 0, 1, "C");
    $pdf->Ln(2);

    $pdf->Cell(20, 5, "Numero", 1, 0, "C");
    $pdf->Cell(20, 5, "Serie", 1, 0, "C");
    $pdf->Cell(40, 5, "Fecha", 1, 0, "C");
    $pdf->Cell(30, 5, "Total", 1, 0, "C");
    $pdf->Cell(80, 5, "Cliente", 1, 1, "C");

    $pdf->SetFont("Arial", "", 12);

    foreach ($ventas as $fila) {
        $pdf->Cell(20, 5, $fila['numero'], 1, 0, "C");
        $pdf->Cell(20, 5, $fila['serie'], 1, 0, "C");
        $pdf->Cell(40, 5, $fila['fecha'], 1, 0, "C");
        $pdf->Cell(30, 5, $fila['total'], 1, 0, "C");
        $pdf->Cell(80, 5, iconv('UTF-8', 'windows-1252', $fila['razonsocial']), 1, 1, "C");
    }
    $pdf->Output();

} else {
    echo "Error: No se pudo conectar a la base de datos.";
}

?>

