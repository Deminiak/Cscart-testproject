<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 16:19:25
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\addons\product_variations\hooks\products\list_extra_links.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:311105b48a6dda96719-27123792%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b509cff97563f2bf17ada77a3f27d551522773f8' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\addons\\product_variations\\hooks\\products\\list_extra_links.post.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '311105b48a6dda96719-27123792',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a6ddaf0f20_62073218',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a6ddaf0f20_62073218')) {function content_5b48a6ddaf0f20_62073218($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('product_variations.variations'));
?>
<?php if ($_smarty_tpl->tpl_vars['product']->value['product_type']===constant("\Tygh\Addons\ProductVariations\Product\Manager::PRODUCT_TYPE_CONFIGURABLE")) {?>
    <li><?php ob_start();
echo htmlspecialchars(constant("\Tygh\Addons\ProductVariations\Product\Manager::PRODUCT_TYPE_VARIATION"), ENT_QUOTES, 'UTF-8');
$_tmp2=ob_get_clean();?><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("product_variations.variations"),'href'=>"products.manage?parent_product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])."&product_type=".$_tmp2));?>
</li>
<?php }?><?php }} ?>
