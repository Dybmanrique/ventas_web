<?php

/** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once("cSetup.php");
class ventas extends Setup
{
    var $error;
    var $mod;
    var $query = array(
        
    );
    function __construct()
    {
        parent::__construct();
        if (isset($_REQUEST['mod'])) {
            $this->mod = $_REQUEST['mod'];
        }
    }

    function form()
    {
        $this->getClientes(); // Añadir esta línea
        if ($this->mod == 'editar')
            $this->cargarDatos();
        $this->smarty->display('form_reportes.html');
    }

    function getClientes()
    {
        $sql = "SELECT idcliente, razonsocial FROM clientes";
        $p = $this->db->prepare($sql);
        $p->execute();
        $clientes = array();
        while ($row = $p->fetch()) {
            $clientes[$row['idcliente']] = $row['razonsocial'];
        }
        $this->smarty->assign('clientes', $clientes);
    }
}
