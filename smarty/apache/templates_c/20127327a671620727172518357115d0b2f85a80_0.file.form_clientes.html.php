<?php
/* Smarty version 4.5.3, created on 2024-06-20 18:31:17
  from 'C:\wamp64\www\tecnologiaweb\html\form_clientes.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6674bbc52f2149_83184459',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '20127327a671620727172518357115d0b2f85a80' => 
    array (
      0 => 'C:\\wamp64\\www\\tecnologiaweb\\html\\form_clientes.html',
      1 => 1718925879,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_6674bbc52f2149_83184459 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'head'), 0, false);
?>
        <title>Clientes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            table{border-spacing:0px; border-collapse:collapse; border:0.1px solid #000; font-size:12px;}
            thead{background-color:#dce6f1;}            
            th, td {padding: 0px; border:0.1px solid #000; vertical-align: middle}
            table th{vertical-align: middle}
            #data tr:nth-child(odd) td{background-color:#c5daeb}
            #data tr:nth-child(even) td{background-color:#e3fbf0}
        </style>
    </head>
    <body>
        <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
        <br/>
        <table id="data" border="1" cellspacing="0" cellpadding="0" align="center" style="min-width:90%;">
            <caption style="text-align:left"><input type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getClientes()"/></caption>
            <thead><tr><th>CLIENTE</th><th>RUC / DNI</th><th>DIRECCION</th></tr></thead>
            <tbody><tr><th>CLIENTE</th><th>RUC / DNI</th><th>DIRECCION</th></tr>
            </tbody>
        </table>
        <?php echo '<script'; ?>
 type="text/javascript" src="js/clientes.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript">
            getClientes();
        <?php echo '</script'; ?>
>
    </body>
</html><?php }
}
