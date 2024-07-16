<?php
/* Smarty version 4.5.3, created on 2024-06-20 18:31:17
  from 'C:\wamp64\www\tecnologiaweb\html\menu_top.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6674bbc53d4c87_35839329',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c94fa8c4591ab711c0f015f8a193a76c7cedcb6' => 
    array (
      0 => 'C:\\wamp64\\www\\tecnologiaweb\\html\\menu_top.html',
      1 => 1718926140,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6674bbc53d4c87_35839329 (Smarty_Internal_Template $_smarty_tpl) {
?><header id="menu_top">
    <div id="menu">
        <!--Begin Menu-->
        <nav id="main-nav">
            <ul id="main-menu" class="sm sm-blue">
                <li><a href="menu.php">Inicio</a></li>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['vars']->value['menu'], 'menu', false, 'idmenu');
$_smarty_tpl->tpl_vars['menu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['idmenu']->value => $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->do_else = false;
?>
                    <li><a><?php echo $_smarty_tpl->tpl_vars['menu']->value;?>
</a>
                        <ul> 
                            <li><a href="menu.php?idmenu=<?php echo $_smarty_tpl->tpl_vars['idmenu']->value;?>
">Inicio</a></li>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menus']->value[$_smarty_tpl->tpl_vars['idmenu']->value], 'link', false, 'idlink');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['idlink']->value => $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['link']->value['nombre'];?>
</a></li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <li><a href="login.php?mod=logout">Salir</a></li>
            </ul>
        </nav>
        <!--End Menu-->
    </div>
    <div id="titleWrap">
        <b>Bienvenido(a) Admin:  Elmer Blas</b><!-- &nbsp; &nbsp; 
        <a href="menu.php" class="link_button">&nbsp;Men&uacute;&nbsp;</a> &nbsp; <a href="login.php?mod=logout" class="link_button">&nbsp;Salir&nbsp;</a> &nbsp; <img src="images/user10.png" height="20" alt="Users Online" align="middle">-->
    </div>
    <div id="insetWrap"></div>
</header>
<?php }
}
