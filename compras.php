<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once("classes/class_compras.php");
$obj = new compras();
switch($obj->mod){
    case 'getCompras': $obj->getCompras(); break;
    case 'Modificar': $obj->guardar();break;
    case 'Insertar': $obj->guardar();break;
    case 'eliminar': $obj->eliminar();break;
    default: $obj->form(); break;
}
?>