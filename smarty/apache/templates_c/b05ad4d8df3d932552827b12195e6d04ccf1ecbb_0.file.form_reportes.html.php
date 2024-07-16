<?php
/* Smarty version 4.5.3, created on 2024-07-16 12:10:27
  from 'C:\Users\Deyber\Documents\Web\tecnologiaweb\html\form_reportes.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6696a983c06ad3_97199730',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b05ad4d8df3d932552827b12195e6d04ccf1ecbb' => 
    array (
      0 => 'C:\\Users\\Deyber\\Documents\\Web\\tecnologiaweb\\html\\form_reportes.html',
      1 => 1721149826,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_6696a983c06ad3_97199730 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\Deyber\\Documents\\Web\\tecnologiaweb\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'head'), 0, false);
?>
        <title>Ventas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php echo '<script'; ?>
 type="text/javascript">
    function calcularIGV() {
        var subtotal = parseFloat(document.getElementById("subtotal").value) || 0;
        var igv = subtotal * 0.18;
        document.getElementById("igv").value = igv.toFixed(2);
        document.getElementById("total").value = (subtotal + igv).toFixed(2);
    }
    function calcularTotalProducto() {
        var precio = parseFloat(document.getElementById("precio").value) || 0;
        var cantidad = parseFloat(document.getElementById("cantidad").value) || 0;
        document.getElementById("totalProducto").value = (precio * cantidad).toFixed(2);
    }
<?php echo '</script'; ?>
>

</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>

        <div class="container mt-5">
            <div class="card">
                <div class="card-header">POR CLIENTE</div>
                <div class="card-body">
                    <form action="ReporteClientes.php" method="post">
                        <div class="form-group">
                            <label for="razonsocial">Seleccione un cliente: </label>
                            <select name="razonsocial" id="razonsocial" class="form-control" required>
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['clientes']->value,'selected'=>$_smarty_tpl->tpl_vars['v']->value['idcliente']),$_smarty_tpl);?>

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Generar reporte</button>
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">POR FECHAS</div>
                <div class="card-body">
                    <form action="ReporteFechas.php" method="post">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha inicio: </label>
                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Fecha fin: </label>
                            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                        </div>
                        <button type="submit" class="btn btn-primary">Generar reporte</button>
                    </form>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">REPRTE GRÁFICO GENERAL</div>
                <div class="card-body">
                    <a href="ReporteGeneral.php" class="btn btn-primary">GENREAR REPORTE</a>
                </div>
            </div>
        </div>

        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
