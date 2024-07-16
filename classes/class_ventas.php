<?php

/** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once("cSetup.php");
class ventas extends Setup
{
    var $error;
    var $mod;
    var $query = array(
        0 => 'SELECT v.*,cl.razonsocial from ventas v inner join clientes cl where v.idcliente=cl.idcliente 
                            and if(length(?), concat(v.numero, cl.razonsocial, cl.numero) like ?,1) order by v.idventa asc limit 15',
        1 => 'SELECT * from ventas where idventa=?',
        2 => 'update ventas set fecha=?, serie=?, numero=?, subtotal=?, igv=?,total=?, idcliente=? where idventa=?',
        3 => 'insert into ventas (fecha, serie, numero, subtotal, igv,total, idcliente) values(?, ?, ?, ?,?, ?, ?)',
        4 => 'delete from ventas where idventa=?',
        5 => 'select MAX(numero) as max_numero FROM ventas',
        6 => 'INSERT into detalleventa (precio, cantidad, importe, idproducto, idventa) values(?, ?, ?, ?, ?)',
        7 => 'DELETE from detalleventa where idventa=?',
        8 => 'SELECT iddetalleventa,precio,cantidad,importe,detalleventa.idproducto,idventa,concat(producto," (",peso,"-",abreviado ,")") as producto from detalleventa
                join productos on productos.idproducto = detalleventa.idproducto
                join unidadmedida on unidadmedida.idunidadmedida = productos.idunidadmedida where idventa=?',
    );
    function __construct()
    {
        parent::__construct();
        if (isset($_REQUEST['mod'])) {
            $this->mod = $_REQUEST['mod'];
        }
    }

    function setNumeroInicial()
    {
        $p = $this->db->prepare($this->query[5]);
        $p->execute();
        $result = $p->fetch();
        $numero = $result['max_numero'] ? $result['max_numero'] + 1 : 1000;
        $this->smarty->assign('numero_inicial', $numero);
    }

    function form()
    {
        $this->getTipodocumento();
        $this->getClientes(); // Añadir esta línea
        $this->getProducto();
        if ($this->mod == 'editar')
            $this->cargarDatos();
        else
            $this->setNumeroInicial(); // Llamamos a la nueva función
        $this->smarty->display('form_ventas.html');
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

    function getVentas()
    {
        $p = $this->db->prepare($this->query[0]);
        $p->execute(array($_REQUEST['bsc'], '%' . $_REQUEST['bsc'] . '%'));
        while ($rw = $p->fetch())
            $ventas[] = $rw;
        echo json_encode($ventas);
    }
    function getDetalleVentas()
    {
        $p = $this->db->prepare($this->query[8]);
        $p->execute(array($_REQUEST['idventa']));
        $rw = $p->fetchAll();
            
        echo json_encode($rw);
    }

    function cargarDatos()
    {
        $p = $this->db->prepare($this->query[1]);
        $p->execute(array($_REQUEST['idventa']));
        $v = $p->fetch();

        $p = $this->db->prepare($this->query[8]);
        $p->execute(array($_REQUEST['idventa']));
        $detalles = $p->fetchAll();

        $this->smarty->assign('v', $v);
        $this->smarty->assign('detalles', $detalles);
    }
    function guardar()
    {
        try {
            //            $this->db->beginTransaction();
            if (isset($_REQUEST['idventa'])) {
                $p = $this->db->prepare($this->query[2]);
                $p->execute(array($_REQUEST['fecha'], $_REQUEST['serie'], $_REQUEST['numero'], $_REQUEST['subtotal'], $_REQUEST['igv'], $_REQUEST['total'], $_REQUEST['idcliente'], $_REQUEST['idventa']));

                $p = $this->db->prepare($this->query[7]);
                $p->execute(array($_REQUEST['idventa']));

                $detalles = json_decode($_POST['detalles'], true);
                foreach ($detalles as $key => $value) {
                    $p = $this->db->prepare($this->query[6]);
                    $p->execute(array($value['precio'], $value['cantidad'], $value['total'], $value['id'], $_REQUEST['idventa']));
                }
            } else {
                $p = $this->db->prepare($this->query[3]);
                $p->execute(array($_REQUEST['fecha'], $_REQUEST['serie'], $_REQUEST['numero'], $_REQUEST['subtotal'], $_REQUEST['igv'], $_REQUEST['total'], $_REQUEST['idcliente']));

                $stmt = $this->db->query("SELECT idventa FROM ventas ORDER BY idventa DESC LIMIT 1");
                $ultimaVenta = $stmt->fetch();

                if ($ultimaVenta) {
                    $detalles = json_decode($_POST['detalles'], true);
                    foreach ($detalles as $key => $value) {
                        $p = $this->db->prepare($this->query[6]);
                        $p->execute(array($value['precio'], $value['cantidad'], $value['total'], $value['id'], $ultimaVenta['idventa']));
                    }
                }
            }
            // header('location: ventas.php');
            //            $this->db->commit();
            echo json_encode(['code' => 200, 'message' => 'Guardado']);
        } catch (Exception $exc) {
            //            $this->db->rollback();
            $this->error = 1;
            $this->msg = $p->errorInfo()[2]; //$p->queryString;
            echo json_encode(['code' => 500, 'message' => $exc]);
        }
    }
    function eliminar()
    {

        try {
            //code...
            $p = $this->db->prepare($this->query[4]);
            $p->execute(array($_REQUEST['idventa']));
        } catch (Exception $exc) {
            $this->error = 1;
        }
        echo $this->error ? 'Error [' . $p->errorInfo()[2] . ']' : 'Se ha eliminado corectamente.';
    }
}
