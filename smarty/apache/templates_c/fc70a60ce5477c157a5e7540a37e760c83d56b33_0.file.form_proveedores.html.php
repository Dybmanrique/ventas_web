<?php
/* Smarty version 4.5.3, created on 2024-07-16 12:58:51
  from 'C:\Users\Usuario\Desktop\X\web\ventas_web\html\form_proveedores.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6696b4db9b8074_07905604',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc70a60ce5477c157a5e7540a37e760c83d56b33' => 
    array (
      0 => 'C:\\Users\\Usuario\\Desktop\\X\\web\\ventas_web\\html\\form_proveedores.html',
      1 => 1721152674,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_6696b4db9b8074_07905604 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\Usuario\\Desktop\\X\\web\\ventas_web\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html>
    <head>
        <?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'head'), 0, false);
?>
        <title>Proveedores</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">Registro de Proveedores</div>
                <div class="card-body">
                    <form id="frmPrv" name="frmPrv" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>
" onsubmit="return validarFrm()">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Razón social:</label>
                                    <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['razonsocial']))) {
echo $_smarty_tpl->tpl_vars['ct']->value['razonsocial'];
}?>" name="razonsocial" id="razonsocial" placeholder="Razon social" title="Razon social" required autofocus class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Tipo documento:</label>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['idtipodocumento']))) {?>
                                            <?php $_smarty_tpl->_assignInScope('tipodoc', $_smarty_tpl->tpl_vars['ct']->value['idtipodocumento']);?>
                                        <?php } else { ?>
                                            <?php $_smarty_tpl->_assignInScope('tipodoc', 6);?>
                                        <?php }?>
                                        <?php echo smarty_function_html_options(array('name'=>'idtipodocumento','id'=>'idtipodocumento','options'=>$_smarty_tpl->tpl_vars['tipodocumento']->value,'selected'=>$_smarty_tpl->tpl_vars['tipodoc']->value,'title'=>"Tipo documento",'required'=>"required",'onchange'=>"onchangeIdtipodocumento(this)",'class'=>"form-control"),$_smarty_tpl);?>

                                </div>
                                <div class="form-group">
                                    <label for="">Documento:</label>
                                    <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['numero']))) {
echo $_smarty_tpl->tpl_vars['ct']->value['numero'];
}?>" name="numero" id="numero" placeholder="Ruc" title="Numero" onkeypress="return number(event)" maxlength="11" required class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dirección:</label>
                                    <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['direccion']))) {
echo $_smarty_tpl->tpl_vars['ct']->value['direccion'];
}?>" name="direccion" id="direccion" placeholder="Direccion" title="Direccion" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="email" value="<?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['email']))) {
echo $_smarty_tpl->tpl_vars['ct']->value['email'];
}?>" name="email" id="email" placeholder="Email" title="Email" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Url:</label>
                                    <input type="url" value="<?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['url']))) {
echo $_smarty_tpl->tpl_vars['ct']->value['url'];
}?>" name="url" id="url" placeholder="URL" title="URL" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Celular:</label>
                                    <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['celular']))) {
echo $_smarty_tpl->tpl_vars['ct']->value['celular'];
}?>" name="celular" id="celular" placeholder="Celular" title="Celular" onkeypress="return number(event);" maxlength="9" class="form-control"/>
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
            <br/>
            <div class="form-group">
                <input type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getProveedores()" class="form-control"/>
            </div>
            <table id="data" class="table table-striped table-sm">
                <thead><tr><th>PROVEEDORES</th><th>RUC / DNI</th><th>DIRECCION</th><th>TELEFÓNO</th><th>URL</th><th></th><th></th></tr></thead>
                <tbody></tbody>
            </table>
        </div>
        <?php echo '<script'; ?>
 type="text/javascript" src="js/proveedores.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript">
            getProveedores();
        <?php echo '</script'; ?>
>
    </body>
</html><?php }
}
