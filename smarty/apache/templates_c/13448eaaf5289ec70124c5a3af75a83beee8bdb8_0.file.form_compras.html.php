<?php
/* Smarty version 4.5.3, created on 2024-07-16 12:33:08
  from 'C:\Users\Deyber\Documents\Web\tecnologiaweb\html\form_compras.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6696aed4262d50_77722588',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13448eaaf5289ec70124c5a3af75a83beee8bdb8' => 
    array (
      0 => 'C:\\Users\\Deyber\\Documents\\Web\\tecnologiaweb\\html\\form_compras.html',
      1 => 1721151187,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_6696aed4262d50_77722588 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\Deyber\\Documents\\Web\\tecnologiaweb\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html>
<head>
    <?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'head'), 0, false);
?>
    <title>Compras</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
    <?php echo '<script'; ?>
 type="text/javascript">
        function calcularIGV() {
            var subtotal = parseFloat(document.getElementById("subtotal").value) || 0;
            var igv = subtotal * 0.18;
            document.getElementById("igv").value = igv.toFixed(2);
            document.getElementById("total").value = (subtotal + igv).toFixed(2);
        }
    <?php echo '</script'; ?>
>

</head>
<body>
    <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
    <div class="container">
        <div class="card my-4">
            <div class="card-header">Registro de compras</div>
            <div class="card-body">
                <form id="frmClt" name="frmClt" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>
" onsubmit="return validarFrm()">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['fecha']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['fecha'];
}?>" name="fecha" id="fecha" class="form-control" required autofocus/>
                            </div>
                            <div class="form-group">
                                <label for="idproveedor">Proveedor</label>
                                <select name="idproveedor" id="idproveedor" class="form-control" required>
                                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['proveedores']->value,'selected'=>$_smarty_tpl->tpl_vars['cr']->value['idproveedor']),$_smarty_tpl);?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="serie">Serie</label>
                                <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['serie']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['serie'];
}?>" name="serie" id="serie" class="form-control" placeholder="Serie" maxlength="11" required onkeypress="return Text(event)"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero">Número</label>
                                <input type="number" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['numero']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['numero'];
} else {
echo $_smarty_tpl->tpl_vars['numero_inicial']->value;
}?>" name="numero" id="numero" class="form-control" placeholder="Número" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="subtotal">Subtotal</label>
                                <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['subtotal']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['subtotal'];
}?>" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" oninput="calcularIGV()"/>
                            </div>
                            <div class="form-group">
                                <label for="igv">IGV</label>
                                <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['igv']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['igv'];
} else {
echo 0;
}?>" name="igv" id="igv" class="form-control" placeholder="IGV" readonly/>
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['total']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['total'];
}?>" name="total" id="total" class="form-control" placeholder="Total" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <input type="submit" id="bnguardar" name="mod" class="btn btn-primary" value="<?php if ((isset($_REQUEST['mod'])) == 'editar') {?>Modificar<?php } else { ?>Insertar<?php }?>"/>
                        <input type="reset" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='<?php echo $_SERVER['SCRIPT_NAME'];?>
';"/>
                    </div>
                    
                </form>
            </div>
        </div>

        <div class="form-group">
            <input type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getCompras()" class="form-control"/>
        </div>
        <table id="data" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Fecha</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Serie</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Número</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Subtotal</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Total</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Proveedor</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left"></th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    
    <?php echo '<script'; ?>
 type="text/javascript" src="js/compras.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        getCompras();
    <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
