<?php
// Crear imagen
$imagenAncho = 500;
$imagenAlto = 300;
$imagen = imagecreate($imagenAncho, $imagenAlto);

// Colores
$blanco = imagecolorallocate($imagen, 255, 255, 255);
$negro = imagecolorallocate($imagen, 0, 0, 0);
$rojo = imagecolorallocate($imagen, 255, 0, 0);
$verde = imagecolorallocate($imagen, 0, 255, 0);
$azul = imagecolorallocate($imagen, 0, 0, 255);

// Datos del gráfico
$datos = [100, 200, 150, 300, 250];
$anchoBarra = 50;
$espacio = 20;
$base = $imagenAlto - 20;

// Dibujar barras
foreach ($datos as $key => $valor) {
    $x1 = $key * ($anchoBarra + $espacio) + $espacio;
    $y1 = $base - $valor;
    $x2 = $x1 + $anchoBarra;
    $y2 = $base;
    imagefilledrectangle($imagen, $x1, $y1, $x2, $y2, $azul);
}

// Añadir bordes
imagerectangle($imagen, 0, 0, $imagenAncho - 1, $imagenAlto - 1, $negro);

// Guardar imagen
$imagePath = 'grafico.png';
imagepng($imagen, $imagePath);

// Liberar memoria
imagedestroy($imagen);
?>