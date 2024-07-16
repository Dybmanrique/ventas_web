<?php

require_once 'classes/cSetup.php';
require 'fpdf/fpdf1/fpdf.php';

$setup = new Setup();

if ($setup->db) {

    $sql = "SELECT v.fecha, v.total FROM ventas v";

    $stmt = $setup->db->prepare($sql);
    $stmt->execute();

    $ventas = [];
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ventas[] = $fila;
    }

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

    // Configuración del gráfico
    $cantidadAnios = count($ventasPorAno);
    $imagenAncho = max(600, $cantidadAnios * 60); 
    $imagenAlto = 320;
    $imagen = imagecreate($imagenAncho, $imagenAlto);

    // Colores
    $blanco = imagecolorallocate($imagen, 255, 255, 255);
    $negro = imagecolorallocate($imagen, 0, 0, 0);
    $azul = imagecolorallocate($imagen, 0, 0, 255);
    $rojo = imagecolorallocate($imagen, 255, 0, 0);

    // Ruta de la fuente Arial
    $fuenteArial = 'fonts/arial.ttf';

    // Calcular el margen para centrar el gráfico
    $margenIzquierdo = 40;
    $margenDerecho = 20;
    $margenSuperior = 20;
    $margenInferior = 40;
    $base = $imagenAlto - $margenInferior;

    $maxValue = max($ventasPorAno);
    $escalaX = ($imagenAncho - $margenIzquierdo - $margenDerecho) / ($cantidadAnios - 1);
    $escalaY = ($imagenAlto - $margenSuperior - $margenInferior) / $maxValue;

    // Dibujar ejes
    imageline($imagen, $margenIzquierdo, $base, $imagenAncho - $margenDerecho, $base, $negro);
    imageline($imagen, $margenIzquierdo, $margenSuperior, $margenIzquierdo, $base, $negro);

    // Dibujar el gráfico de líneas
    $puntos = array_keys($ventasPorAno);
    for ($i = 0; $i < $cantidadAnios - 1; $i++) {
        $x1 = $margenIzquierdo + $i * $escalaX;
        $y1 = $base - $ventasPorAno[$puntos[$i]] * $escalaY;
        $x2 = $margenIzquierdo + ($i + 1) * $escalaX;
        $y2 = $base - $ventasPorAno[$puntos[$i + 1]] * $escalaY;
        imageline($imagen, $x1, $y1, $x2, $y2, $azul);
        imagefilledellipse($imagen, $x1, $y1, 5, 5, $rojo);
        imagettftext($imagen, 10, 0, $x1 - 10, $base + 15, $negro, $fuenteArial, $puntos[$i]);
    }
    imagefilledellipse($imagen, $x2, $y2, 5, 5, $rojo);
    imagettftext($imagen, 10, 0, $x2 - 10, $base + 15, $negro, $fuenteArial, end($puntos));

    imagettftext($imagen, 15, 0, 35, 20, $negro, $fuenteArial, 'Gráfico del Total Generado por Ventas por Año');

    $imagePath = 'grafico1.png';
    imagepng($imagen, $imagePath);
    imagedestroy($imagen);

    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'GRÁFICO').' GENERAL DE VENTAS', 0, 1, 'C');
    
    $pdf->Image($imagePath, 10, 50, 270,80);
    
    $pdf->Output();

    

} else {
    echo "Error: No se pudo conectar a la base de datos.";
}

?>

