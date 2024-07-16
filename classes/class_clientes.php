<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once ("cSetup.php");
class clientes extends Setup{
    var $error;
    var $mod;
    var $query = array(0 => 'select * from clientes where if(length(?),concat(razonsocial,numero) like ?,1) order by 2 limit 30',
        1 => 'select * from clientes where idcliente=?',
        2 => 'update clientes set razonsocial=?, numero=?, direccion=?, celular=?, email=?, idtipodocumento=? where idcliente=?',
        3 => 'insert into clientes (razonsocial, numero, direccion, celular, email, idtipodocumento) values(?, ?, ?, ?, ?, ?)',
        4 => 'delete from clientes where idcliente=?'
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
        $this->smarty->display('form_clientes.html');
    }
    function getClientes(){
        $p = $this->db->prepare($this->query[0]);
        $p->execute(array($_REQUEST['bsc'], '%'.$_REQUEST['bsc'].'%'));
        while($rw=$p->fetch())
            $clientes[]=$rw;
        echo json_encode($clientes);
    }
    function cargarDatos(){
        $p = $this->db->prepare($this->query[1]);
        $p->execute(array($_REQUEST['idcliente']));
        $ct = $p->fetch();
        $this->smarty->assign('ct', $ct);
    }
    function guardar(){
        try {
//            $this->db->beginTransaction();
            if(isset($_REQUEST['idcliente'])){
                $p = $this->db->prepare($this->query[2]);
                $p->execute(array($_REQUEST['razonsocial'],$_REQUEST['numero'],$_REQUEST['direccion'],$_REQUEST['celular'],$_REQUEST['email'],$_REQUEST['idtipodocumento'],$_REQUEST['idcliente']));
            }else{
                $p = $this->db->prepare($this->query[3]);
                $p->execute(array($_REQUEST['razonsocial'],$_REQUEST['numero'],$_REQUEST['direccion'],$_REQUEST['celular'],$_REQUEST['email'],$_REQUEST['idtipodocumento']));
            }
//            $this->db->commit();
            header('Location:clientes.php');
        } catch (Exception $exc) {
//            $this->db->rollback();
            $this->error=1;
            $this->msg = $p->errorInfo()[2]; //$p->queryString;
        }
    }
    function eliminar(){
        try{
            $p = $this->db->prepare($this->query[4]);
            $p->execute(array($_REQUEST['idcliente']));
        } catch (Exception $exc){
            $this->error=1;
        }
        echo $this->error ? 'Error ['.$p->errorinfo()[2].']':'se ah eliminado correctamente.';
    }
}