<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once("classes/class_detalleventas.php");
$obj = new detalleventas();
switch($obj->mod){
    case 'getDetalleVentas': $obj->getDetalleVentas(); break;
    case 'Modificar': $obj->guardar();break;
    case 'Insertar': $obj->guardar();break;
    case 'eliminar': $obj->eliminar();break;
    default: $obj->form(); break;
}
?>