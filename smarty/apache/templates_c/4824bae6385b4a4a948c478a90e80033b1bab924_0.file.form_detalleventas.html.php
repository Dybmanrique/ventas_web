<?php
/* Smarty version 4.5.3, created on 2024-07-10 12:22:30
  from 'C:\xampp\htdocs\tecnologiaweb\tecnologiaweb\html\form_detalleventas.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_668ec356bfdcb2_52356051',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4824bae6385b4a4a948c478a90e80033b1bab924' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tecnologiaweb\\tecnologiaweb\\html\\form_detalleventas.html',
      1 => 1720632149,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_668ec356bfdcb2_52356051 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\tecnologiaweb\\tecnologiaweb\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html>
<head>
    <?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'head'), 0, false);
?>
    <title>Detalles de Ventas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style type="text/css">
        table{border-spacing:0px; border-collapse:collapse; border:0.1px solid #000; font-size:12px;}
        thead{background-color:#dce6f1;}            
        th, td {padding: 0px; border:0.1px solid #000; vertical-align: middle}
        table th{vertical-align: middle}
        #data tr:nth-child(odd) td{background-color:#c5daeb}
        #data tr:nth-child(even) td{background-color:#e3fbf0}
    </style>
    <?php echo '<script'; ?>
 type="text/javascript">
        function calcularImporte() {
            var precio = parseFloat(document.getElementById("precio").value) || 0;
            var cantidad = parseFloat(document.getElementById("cantidad").value) || 0;
            var importe = precio * cantidad;
            document.getElementById("importe").value = importe.toFixed(2);
        }
    <?php echo '</script'; ?>
>
</head>
<body>
    <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
    <div class="container">
        <form id="frmClt" name="frmClt" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>
" onsubmit="return validarFrm()">
            <fieldset class="border p-2">
                <legend class="w-auto" style="color: blue">Registro de Detalle de Ventas</legend>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="idproducto">Producto</label>
                            <select name="idproducto" id="idproducto" class="form-control" required>
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['productos']->value,'selected'=>$_smarty_tpl->tpl_vars['cr']->value['idproducto']),$_smarty_tpl);?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="idventa">Venta</label>
                            <select name="idventa" id="idventa" class="form-control" required>
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ventas']->value,'selected'=>$_smarty_tpl->tpl_vars['cr']->value['idventa']),$_smarty_tpl);?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['precio']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['precio'];
}?>" name="precio" id="precio" class="form-control" placeholder="Precio" oninput="calcularImporte()"/>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['cantidad']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['cantidad'];
} else {
echo 0;
}?>" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" oninput="calcularImporte()"/>
                        </div>
                        <div class="form-group">
                            <label for="importe">Importe</label>
                            <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['importe']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['importe'];
}?>" name="importe" id="importe" class="form-control" placeholder="Total" readonly/>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <input type="submit" id="bnguardar" name="mod" class="btn btn-primary" value="<?php if ((isset($_REQUEST['mod'])) == 'editar') {?>Modificar<?php } else { ?>Insertar<?php }?>"/>
                    <input type="reset" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='<?php echo $_SERVER['SCRIPT_NAME'];?>
';"/>
                </div>
            </fieldset>
        </form>
    </div>
    <br/>
    <table id="data" class="min-w-full bg-white border border-gray-300">
        <caption class="text-left p-2">
            <input type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getDetalleVentas()" class="mb-4 p-2 border border-gray-300 rounded-md w-full"/>
        </caption>
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b border-gray-300 text-left">Precio</th>
                <th class="py-2 px-4 border-b border-gray-300 text-left">Cantidad</th>
                <th class="py-2 px-4 border-b border-gray-300 text-left">Importe</th>
                <th class="py-2 px-4 border-b border-gray-300 text-left">Producto</th>
                <th class="py-2 px-4 border-b border-gray-300 text-left">Venta</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/detalleventas.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        getDetalleVentas();
    <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
