<?php

require 'fpdf/fpdf1/fpdf.php';
require_once 'classes/cSetup.php';

$setup = new Setup();

if ($setup->db) {

    $razonsocial = $_POST['razonsocial'];

    $sql = "SELECT v.numero, v.serie, v.fecha, v.total, c.razonsocial 
            FROM ventas v 
            INNER JOIN clientes c ON v.idcliente = c.idcliente 
            WHERE c.idcliente = :razonsocial";

    $stmt = $setup->db->prepare($sql);
    $stmt->execute(['razonsocial' => $razonsocial]);

    $ventas = [];
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ventas[] = $fila;
    }

    $nombre_cliente = $ventas[0]['razonsocial'];

    // Agrupar datos por año
    $ventasPorAno = [];
    foreach ($ventas as $venta) {
        $fecha = new DateTime($venta['fecha']);
        $ano = (int)$fecha->format('Y');
        if (!isset($ventasPorAno[$ano])) {
            $ventasPorAno[$ano] = 0;
        }
        $ventasPorAno[$ano] += $venta['total'];
    }

    // Generar gráfico
    $imagenAncho = 600;  // Aumento el ancho de la imagen para acomodar más años
    $imagenAlto = 300;
    $imagen = imagecreate($imagenAncho, $imagenAlto);

    // Colores
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);
    $azul = imagecolorallocate($imagen, 0, 0, 255);

    // Datos del gráfico
    $anchoBarra = 40; // Aumento el ancho de la barra para ajustar a los años
    $espacio = 20;    // Aumento el espacio entre las barras
    $base = $imagenAlto - 20;

    $maxValue = max($ventasPorAno);
    $x = 10; // Inicia el primer valor de x

    foreach ($ventasPorAno as $ano => $valor) {
        $x1 = $x;
        $y1 = $base - ($valor / $maxValue) * ($imagenAlto - 40);
        $x2 = $x + $anchoBarra;
        $y2 = $base;
        imagefilledrectangle($imagen, $x1, $y1, $x2, $y2, $azul);
        imagestring($imagen, 2, $x1 + 5, $base + 5, $ano, $negro);
        $x += $anchoBarra + $espacio;
    }

    
    imagerectangle($imagen, 0, 0, $imagenAncho - 1, $imagenAlto - 1, $negro);
    imagestring($imagen, 5, 5, 5, 'Grafico de Ventas del cliente: '.iconv('UTF-8', 'windows-1252', $nombre_cliente), $negro);

    $imagePath = 'grafico.png';
    imagepng($imagen, $imagePath);
    imagedestroy($imagen);


    $pdf = new FPDF("P", "mm", "letter");
    $pdf->AddPage();
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(190, 5, "Reporte de ventas de ".iconv('UTF-8', 'windows-1252', $nombre_cliente), 0, 1, "C");
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

    // Insertar imagen
    $pdf->Image($imagePath, 10, 150, 190, 0, 'PNG');

    // Salida del PDF
    $pdf->Output();

} else {
    echo "Error: No se pudo conectar a la base de datos.";
}

?>

