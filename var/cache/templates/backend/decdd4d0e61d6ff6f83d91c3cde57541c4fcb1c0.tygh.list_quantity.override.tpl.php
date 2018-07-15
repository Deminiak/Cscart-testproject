<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 16:19:25
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\addons\product_variations\hooks\products\list_quantity.override.tpl" */ ?>
<?php /*%%SmartyHeaderCode:67535b48a6dd2d7438-88147063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'decdd4d0e61d6ff6f83d91c3cde57541c4fcb1c0' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\addons\\product_variations\\hooks\\products\\list_quantity.override.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '67535b48a6dd2d7438-88147063',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a6dd2fdaa4_94518455',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a6dd2fdaa4_94518455')) {function content_5b48a6dd2fdaa4_94518455($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('edit'));
?>
<?php if ($_smarty_tpl->tpl_vars['product']->value['product_type']===constant("\Tygh\Addons\ProductVariations\Product\Manager::PRODUCT_TYPE_CONFIGURABLE")) {?>
    <?php ob_start();
echo htmlspecialchars(constant("\Tygh\Addons\ProductVariations\Product\Manager::PRODUCT_TYPE_VARIATION"), ENT_QUOTES, 'UTF-8');
$_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("edit"),'but_href'=>"products.manage?parent_product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])."&product_type=".$_tmp1,'but_role'=>"edit"), 0);?>

<?php }?><?php }} ?>
