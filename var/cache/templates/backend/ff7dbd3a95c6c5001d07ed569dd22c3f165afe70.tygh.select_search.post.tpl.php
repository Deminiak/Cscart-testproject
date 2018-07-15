<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 16:19:38
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\addons\bestsellers\hooks\products\select_search.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:100905b48a6eaccd086-95865205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff7dbd3a95c6c5001d07ed569dd22c3f165afe70' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\addons\\bestsellers\\hooks\\products\\select_search.post.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '100905b48a6eaccd086-95865205',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'search' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a6eace3783_64546650',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a6eace3783_64546650')) {function content_5b48a6eace3783_64546650($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('bestsellers'));
?>
<option <?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="bestsellers") {?>selected="selected"<?php }?> value="bestsellers"><?php echo $_smarty_tpl->__("bestsellers");?>
</option><?php }} ?>
