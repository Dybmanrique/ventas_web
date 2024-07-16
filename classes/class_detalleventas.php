<?php
/** @package EBC
 * @author Elmer Blas
 * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com
 * @copyright Elmer Blas
 */
require_once ("cSetup.php");

class detalleventas extends Setup {
    var $error;
    var $mod;
    var $query = array(
        0 => 'SELECT d.*, v.numero, p.producto 
              FROM detalleventa d 
              INNER JOIN ventas v ON d.idventa = v.idventa 
              INNER JOIN productos p ON p.idproducto = d.idproducto  
              AND IF(LENGTH(?), p.producto LIKE ? ,1) 
              ORDER BY d.iddetalleventa ASC 
              LIMIT 30',
        1 => 'SELECT * FROM detalleventa WHERE iddetalleventa = ?',
        2 => 'UPDATE detalleventa 
              SET precio = ?, cantidad = ?, importe = ?, idproducto = ?, idventa = ? 
              WHERE iddetalleventa = ?',
        3 => 'INSERT INTO detalleventa (precio, cantidad, importe, idproducto, idventa) 
              VALUES(?, ?, ?, ?, ?)',
        4 => 'DELETE FROM detalleventa WHERE iddetalleventa = ?'
    );

    function __construct() {
        parent::__construct();
        if (isset($_REQUEST['mod'])) {
            $this->mod = $_REQUEST['mod'];
        }
    }

    function form() {
        $this->getTipodocumento();
        $this->getProductos();
        $this->getVentas();
        if ($this->mod == 'editar') {
            $this->cargarDatos();
        }
        $this->smarty->display('form_detalleventas.html');
    }

    function getProductos() {
        $sql = "SELECT idproducto, producto FROM productos";
        $p = $this->db->prepare($sql);
        $p->execute();
        $productos = array();
        while ($row = $p->fetch()) {
            $productos[$row['idproducto']] = $row['producto'];
        }
        $this->smarty->assign('productos', $productos);
    }

    function getVentas() {
        $sql = "SELECT idventa, numero FROM ventas";
        $p = $this->db->prepare($sql);
        $p->execute();
        $ventas = array();
        while ($row = $p->fetch()) {
            $ventas[$row['idventa']] = $row['numero'];
        }
        $this->smarty->assign('ventas', $ventas);
    }

    function getDetalleVentas() {
        $p = $this->db->prepare($this->query[0]);
        $p->execute(array($_REQUEST['bsc'], '%' . $_REQUEST['bsc'] . '%'));
        $detalles = array();
        while ($rw = $p->fetch()) {
            $detalles[] = $rw;
        }
        echo json_encode($detalles);
    }

    function cargarDatos() {
        $p = $this->db->prepare($this->query[1]);
        $p->execute(array($_REQUEST['iddetalleventa']));
        $cr = $p->fetch();
        $this->smarty->assign('cr', $cr);
    }

    function guardar() {
        try {
            if (isset($_REQUEST['iddetalleventa'])) {
                $p = $this->db->prepare($this->query[2]);
                $p->execute(array($_REQUEST['precio'], $_REQUEST['cantidad'], $_REQUEST['importe'], $_REQUEST['idproducto'], $_REQUEST['idventa'], $_REQUEST['iddetalleventa']));
            } else {
                $p = $this->db->prepare($this->query[3]);
                $p->execute(array($_REQUEST['precio'], $_REQUEST['cantidad'], $_REQUEST['importe'], $_REQUEST['idproducto'], $_REQUEST['idventa']));
            }
            header('location: detalleventas.php');
        } catch (Exception $exc) {
            $this->error = 1;
            $this->msg = $exc->getMessage();
        }
    }

    function eliminar() {
        try {
            $p = $this->db->prepare($this->query[4]);
            $p->execute(array($_REQUEST['iddetalleventa']));
            echo 'Se ha eliminado correctamente.';
        } catch (Exception $exc) {
            $this->error = 1;
            echo 'Error [' . $exc->getMessage() . ']';
        }
    }
}
?>
