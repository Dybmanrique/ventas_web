<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once ("cSetup.php");
class proveedor extends Setup{
    var $error;
    var $mod;
    var $query = array(0 => 'select * from proveedores where if(length(?),concat(razonsocial,numero) like ?,1) order by 2 limit 30',
        1 => 'select * from proveedores where idproveedor=?',
        2 => 'update proveedores set razonsocial=?, numero=?, direccion=?, celular=?, email=?, url=?, idtipodocumento=? where idproveedor=?',
        3 => 'insert into proveedores (razonsocial, numero, direccion, celular, email, url, idtipodocumento) values(?, ?, ?, ?, ?, ?, ?)',
        4 => 'delete from proveedores where idproveedor=?'
    );
    function __construct() {
        parent::__construct();
        if (isset($_REQUEST['mod'])) {
            $this->mod = $_REQUEST['mod'];
        }
        
    }
    function form(){
        $this->getTipodocumento();
        if ($this->mod == 'editar')
            $this->cargarDatos();
        $this->smarty->display('form_proveedores.html');
    }
    function getProveedores(){
        $p = $this->db->prepare($this->query[0]);
        $p->execute(array($_REQUEST['bsc'], '%'.$_REQUEST['bsc'].'%'));
        while($rw=$p->fetch())
            $proveedores[]=$rw;
        echo json_encode($proveedores);
    }
    function cargarDatos(){
        $p = $this->db->prepare($this->query[1]);
        $p->execute(array($_REQUEST['idproveedor']));
        $ct = $p->fetch();
        $this->smarty->assign('ct', $ct);
    }
    function guardar(){
        try {
//            $this->db->beginTransaction();
            if(isset($_REQUEST['idproveedor'])){
                $p = $this->db->prepare($this->query[2]);
                $p->execute(array($_REQUEST['razonsocial'],$_REQUEST['numero'],$_REQUEST['direccion'],$_REQUEST['celular'],$_REQUEST['email'],$_REQUEST['url'],$_REQUEST['idtipodocumento'],$_REQUEST['idproveedor']));
            }else{
                $p = $this->db->prepare($this->query[3]);
                $p->execute(array($_REQUEST['razonsocial'],$_REQUEST['numero'],$_REQUEST['direccion'],$_REQUEST['celular'],$_REQUEST['email'],$_REQUEST['url'],$_REQUEST['idtipodocumento']));
            }
//            $this->db->commit();
            header('Location:proveedor.php');
        } catch (Exception $exc) {
//            $this->db->rollback();
            $this->error=1;
            $this->msg = $p->errorInfo()[2]; //$p->queryString;
        }
    }
    function eliminar(){
        try{
            $p = $this->db->prepare($this->query[4]);
            $p->execute(array($_REQUEST['idproveedor']));
        } catch (Exception $exc){
            $this->error=1;
        }
        echo $this->error ? 'Error ['.$p->errorinfo()[2].']':'se ah eliminado correctamente.';
    }
}