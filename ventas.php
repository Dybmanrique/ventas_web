<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once("classes/class_ventas.php");
$obj = new ventas();
switch($obj->mod){
    case 'getVentas': $obj->getVentas(); break;
    case 'getDetalleVentas': $obj->getDetalleVentas(); break;
    case 'Modificar': $obj->guardar();break;
    // case 'Modificar': echo json_encode(['xd'=>'respuesta']);break;
    case 'Insertar': $obj->guardar();break;
    case 'eliminar': $obj->eliminar();break;
    default: $obj->form(); break;
}
?>