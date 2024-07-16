<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once("classes/class_reportes.php");
$obj = new ventas();
switch($obj->mod){
    default: $obj->form(); break;
}
?>