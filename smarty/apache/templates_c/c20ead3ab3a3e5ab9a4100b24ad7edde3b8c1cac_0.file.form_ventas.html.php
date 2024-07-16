<?php
/* Smarty version 4.5.3, created on 2024-07-16 03:28:42
  from 'C:\Users\Deyber\Documents\Web\tecnologiaweb\html\form_ventas.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66962f3a155a35_67650663',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c20ead3ab3a3e5ab9a4100b24ad7edde3b8c1cac' => 
    array (
      0 => 'C:\\Users\\Deyber\\Documents\\Web\\tecnologiaweb\\html\\form_ventas.html',
      1 => 1721118520,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_66962f3a155a35_67650663 (Smarty_Internal_Template $_smarty_tpl) {
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
        document.getElementById("totalProducto").value = (precio*cantidad).toFixed(2);
    }
<?php echo '</script'; ?>
>

</head>

<body>
    <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>

    <!-- Modal -->
    <div class="modal fade" id="modal-registros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="form-modal-registros">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle de venta <span class="badge badge-secondary"
                                id="estado-detalle"></span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- alerta del modal-->
                        <div id="alerta-modal-registros" class="alert alert-primary" role="alert"
                            style="display: none;"></div>
                        <div class="row">
                            <div class="col-md-6">
                                Comprobante: <span id="nComprobante-detalle" class="h6">F-10004</span>
                            </div>
                            <div class="col-md-6">
                                Fecha: <span id="fecha-detalle">2020-05-15</span>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td>Cliente:</td>
                                        <td>Deyber Manrique Acuña</td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2">Subtotal:</td>
                                        <td id="subtotal-detalle">10</td>
                                    </tr>
                                    <tr>
                                        <td>IGV:</td>
                                        <td id="igv-detalle">10</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table id="tabla-ver-detalles" class="table table-striped table-sm">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Importe (S/.)</th>
                                    </tr>
                                </thead>
                                <tbody >

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
        <!-- Modal Agregar producto-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="form-producto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Producto:</label>
                                <select name="idproducto" id="idproducto" class="form-control" required>
                                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['productos']->value),$_smarty_tpl);?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Precio:</label>
                                <input class="form-control" type="number" step=".01" name="" oninput="calcularTotalProducto()" id="precio" required>
                            </div>
                            <div class="form-group">
                                <label for="">Cantidad:</label>
                                <input class="form-control" type="number" step=".01" name="" id="cantidad" oninput="calcularTotalProducto()" required>
                            </div>
                            <div class="form-group">
                                <label for="">Total:</label>
                                <input class="form-control" type="number" step=".01" name="" id="totalProducto" disabled required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <form id="frmClt" name="frmClt" class="container" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>
">
            <div class="card mt-2">
                <div class="card-header">
                    Registro de ventas
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['fecha']))) {
echo $_smarty_tpl->tpl_vars['v']->value['fecha'];
}?>" name="fecha"
                                    id="fecha" class="form-control" required autofocus />
                            </div>
                            <div class="form-group">
                                <label for="idcliente">Clientes</label>
                                <select name="idcliente" id="idcliente" class="form-control" required>
                                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['clientes']->value,'selected'=>$_smarty_tpl->tpl_vars['v']->value['idcliente']),$_smarty_tpl);?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="serie">Serie</label>
                                <!-- <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['serie']))) {
echo $_smarty_tpl->tpl_vars['v']->value['serie'];
}?>" name="serie"
                                    id="serie" class="form-control" placeholder="Serie" maxlength="11" required/> -->
                                <select name="serie" id="serie" class="form-control">
                                    <option value="E001" <?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['serie'])) && $_smarty_tpl->tpl_vars['ct']->value['serie'] == 'E001') {
echo 'selected';
}?> >E001</option>
                                    <option value="E002" <?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['serie'])) && $_smarty_tpl->tpl_vars['ct']->value['serie'] == 'E002') {
echo 'selected';
}?> >E002</option>
                                    <option value="E003" <?php if ((isset($_smarty_tpl->tpl_vars['ct']->value['serie'])) && $_smarty_tpl->tpl_vars['ct']->value['serie'] == 'E003') {
echo 'selected';
}?> >E003</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero">Número</label>
                                <input type="number"
                                    value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['numero']))) {
echo $_smarty_tpl->tpl_vars['v']->value['numero'];
} else {
echo $_smarty_tpl->tpl_vars['numero_inicial']->value;
}?>"
                                    name="numero" id="numero" class="form-control" placeholder="Número" readonly />
                            </div>
                            <div class="form-group">
                                <label for="subtotal">Subtotal</label>
                                <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['subtotal']))) {
echo $_smarty_tpl->tpl_vars['v']->value['subtotal'];
}?>"
                                     id="subtotal" class="form-control" placeholder="Subtotal"
                                    readonly/>
                            </div>
                            <div class="form-group">
                                <label for="igv">IGV</label>
                                <input type="number" step=".01"
                                    value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['igv']))) {
echo $_smarty_tpl->tpl_vars['v']->value['igv'];
} else {
echo 0;
}?>" name="igv" id="igv"
                                    class="form-control" placeholder="IGV" readonly />
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['total']))) {
echo $_smarty_tpl->tpl_vars['v']->value['total'];
}?>"
                                    name="total" id="total" class="form-control" placeholder="Total" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">
                            <span>Detalle de venta</span>
                            <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                data-target="#exampleModal">
                                Agregar producto
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="detalle-venta" class="table table-striped table-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ((isset($_smarty_tpl->tpl_vars['detalles']->value))) {?>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['detalles']->value, 'detalle');
$_smarty_tpl->tpl_vars['detalle']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['detalle']->value) {
$_smarty_tpl->tpl_vars['detalle']->do_else = false;
?>
                                            <tr data-id="<?php echo $_smarty_tpl->tpl_vars['detalle']->value['idproducto'];?>
"">
                                                <td><?php echo $_smarty_tpl->tpl_vars['detalle']->value['producto'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['detalle']->value['precio'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['detalle']->value['cantidad'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['detalle']->value['importe'];?>
</td>
                                                <td class="text-center"><span style="cursor: pointer;" title="Eliminar" onclick="eliminarFila(this)">❌</span>️</td></tr>
                                            </tr>    
                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <input type="hidden" id="bnguardar" name="mod" class="btn btn-primary"
                            value="<?php if ((isset($_REQUEST['mod'])) == 'editar') {?>Modificar<?php } else { ?>Insertar<?php }?>" />
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <input type="reset" value="Cancelar" class="btn btn-secondary"
                            onclick="window.location.href='<?php echo $_SERVER['SCRIPT_NAME'];?>
';" />
                    </div>
                </div>
            </div>
        </form>

        <br />
        <div class="container mb-4">
            <table id="data" class="table table-striped table-sm">
                <input type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getVentas()"
                    class="form-control my-2" />
                <thead class="bg-gray-100">
                    <tr>
                        <th>Fecha</th>
                        <th>Serie-Num</th>
                        <th>Subtotal</th>
                        <th>IGV</th>
                        <th>Total</th>
                        <th>Cliente</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="js/ventas.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript">
            getVentas();
        <?php echo '</script'; ?>
>
</body>

</html><?php }
}
