<?php
// cSetup.php

/** @package EBC
 * @autor Elmer Blas
 * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com
 * @copyright Elmer Blas
 */

session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', true);
setlocale(LC_CTYPE, "es_ES");

if (function_exists("date_default_timezone_set"))
    date_default_timezone_set('America/Lima');

require_once('vars.php');
require_once('config.php');

ini_set('include_path', $CONFIG['path'] . 'smarty/libs/' . PATH_SEPARATOR . $CONFIG['path'] . 'html/' . PATH_SEPARATOR);

require_once('Smarty.class.php');

class Setup extends Smarty
{
    var $smarty;
    var $db;

    function __construct()
    {
        parent::__construct();
        $this->initializeSmarty();
        $this->connect();
        $this->beDefaultModules();
        $this->feDefaultModules();
    }

    private function initializeSmarty()
    {
        $this->smarty = new Smarty();
        $this->smarty->template_dir = $GLOBALS['CONFIG']['path'] . 'html/';
        $this->smarty->compile_dir = $GLOBALS['CONFIG']['path'] . 'smarty/apache/templates_c';
        //        $this->smarty->cache_dir = $GLOBALS['CONFIG']['path'].'smarty/apache/cache';
        $this->smarty->config_dir = $GLOBALS['CONFIG']['path'] . 'smarty/apache/configs';
        $this->smarty->left_delimiter = '<{';
        $this->smarty->right_delimiter = '}>';
        $this->smarty->debugging = false;
    }

    private function connect()
    {
        $dbdsn = $GLOBALS['CONFIG']['dbtype'] . ':host=' . $GLOBALS['CONFIG']['dbhost'] . ';port=' . $GLOBALS['CONFIG']['dbport'] . ';dbname=' . $GLOBALS['CONFIG']['dbname'];
        try {
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $this->db = new PDO($dbdsn, $GLOBALS['CONFIG']['dbuser'], $GLOBALS['CONFIG']['dbpass'], $opciones);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: No se pudo conectar a la base de datos: ' . $e->getMessage();
        }
    }

    function beDefaultModules()
    {
        // Implementación por defecto
    }

    function feDefaultModules()
    {
        $this->smarty->assign('vars', $GLOBALS['CONFIG']);
    }

    function getTipodocumento()
    {
        $sql = "SELECT * FROM tipodocumento";
        $rs = $this->db->query($sql);
        while ($rw = $rs->fetch())
            $tipodocumento[$rw['idtipodocumento']] = $rw['descripcion'];
        $this->smarty->assign('tipodocumento', $tipodocumento);
    }

    function getProveedor()
    {
        $sql = "SELECT * FROM proveedores";
        $rs = $this->db->query($sql);
        while ($rw = $rs->fetch())
            $proveedor[$rw['idproveedor']] = $rw['razonsocial'];
        $this->smarty->assign('proveedor', $proveedor);
    }

    function getProducto()
    {
        $sql = "SELECT idproducto, producto, peso, productos.idunidadmedida, descripcion, abreviado FROM PRODUCTOS 
                JOIN unidadmedida on productos.idunidadmedida = unidadmedida.idunidadmedida";
        $rs = $this->db->query($sql);
        while ($rw = $rs->fetch())
            $productos[$rw['idproducto']] = $rw['producto'].' ('.$rw['peso'].'-'.$rw['abreviado'].')';
        $this->smarty->assign('productos', $productos);
    }
}
