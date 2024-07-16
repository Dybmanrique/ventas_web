<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once("classes/class_proveedores.php");
$obj = new proveedor();
switch($obj->mod){
    case 'getProveedores': $obj->getProveedores(); break;
    case 'Modificar': $obj->guardar();break;
    case 'Insertar': $obj->guardar();break;
    case 'eliminar': $obj->eliminar();break;
    default: $obj->form(); break;
}
?>