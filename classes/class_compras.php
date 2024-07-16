<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once ("cSetup.php");
class compras extends Setup{
    var $error;
    var $mod;
    var $query = array( 0 => 'select c.*,p.razonsocial from compras c inner join proveedores p where c.idproveedor=p.idproveedor  and if(length(?), c.numero like ? ,1) order by c.idcompra asc limit 30',
                        1 => 'select * from compras where idcompra=?',
                        2 => 'update compras set fecha=?, serie=?, numero=?, subtotal=?, igv=?,total=?, idproveedor=? where idcompra=?',
                        3 => 'insert into compras (fecha, serie, numero, subtotal, igv,total, idproveedor) values(?, ?, ?, ?,?, ?, ?)',
                        4 => 'delete from compras where idcompra=?',
                        5 => 'select MAX(numero) as max_numero FROM compras'
);
    function __construct() {
        parent::__construct();
        if (isset($_REQUEST['mod'])) {
            $this->mod = $_REQUEST['mod'];
        }
        
    }
    
    function setNumeroInicial() {
        $p = $this->db->prepare($this->query[5]);
        $p->execute();
        $result = $p->fetch();
        $numero = $result['max_numero'] ? $result['max_numero'] + 1 : 1000;
        $this->smarty->assign('numero_inicial', $numero);
    }

    function form(){
        $this->getTipodocumento();
        $this->getProveedores(); // Añadir esta línea
        if ($this->mod == 'editar')
            $this->cargarDatos();
        else
            $this->setNumeroInicial(); // Llamamos a la nueva función
        $this->smarty->display('form_compras.html');
    }
    
    function getProveedores() {
        $sql = "SELECT idproveedor, razonsocial FROM proveedores";
        $p = $this->db->prepare($sql);
        $p->execute();
        $proveedores = array();
        while($row = $p->fetch()) {
            $proveedores[$row['idproveedor']] = $row['razonsocial'];
        }
        $this->smarty->assign('proveedores', $proveedores);
    }
    
    function getCompras(){
        $p = $this->db->prepare($this->query[0]);
        $p->execute(array($_REQUEST['bsc'], '%'.$_REQUEST['bsc'].'%'));
        while($rw=$p->fetch())
            $compras[]=$rw;
        echo json_encode($compras);
    }
    function cargarDatos(){
        $p = $this->db->prepare($this->query[1]);
        $p->execute(array($_REQUEST['idcompra']));
        $cr = $p->fetch();
        $this->smarty->assign('cr', $cr);
    }
    function guardar(){
        try {
//            $this->db->beginTransaction();
            if(isset($_REQUEST['idcompra'])){
                $p = $this->db->prepare($this->query[2]);
                $p->execute(array($_REQUEST['fecha'],$_REQUEST['serie'],$_REQUEST['numero'],$_REQUEST['subtotal'],$_REQUEST['igv'],$_REQUEST['total'],$_REQUEST['idproveedor'],$_REQUEST['idcompra']));
            }else{
                $p = $this->db->prepare($this->query[3]);
                $p->execute(array($_REQUEST['fecha'],$_REQUEST['serie'],$_REQUEST['numero'],$_REQUEST['subtotal'],$_REQUEST['igv'],$_REQUEST['total'],$_REQUEST['idproveedor']));
            }
            header('location: compras.php');
//            $this->db->commit();
        } catch (Exception $exc) {
//            $this->db->rollback();
            $this->error=1;
            $this->msg = $p->errorInfo()[2]; //$p->queryString;
        }
    }
    function eliminar(){
        
        try {
            //code...
            $p = $this->db->prepare($this->query[4]);
            $p->execute(array($_REQUEST['idcompra']));
        } catch (Exception $exc) {
            $this->error=1;
        }
        echo $this->error ? 'Error ['.$p->errorInfo()[2] .']' : 'Se ha eliminado corectamente.';
    }
}
