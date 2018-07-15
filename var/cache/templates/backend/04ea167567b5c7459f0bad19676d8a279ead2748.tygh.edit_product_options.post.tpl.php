<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 16:20:08
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\addons\yml_export\hooks\product_options\edit_product_options.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92475b48a708039474-33913527%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04ea167567b5c7459f0bad19676d8a279ead2748' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\addons\\yml_export\\hooks\\product_options\\edit_product_options.post.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '92475b48a708039474-33913527',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'num' => 0,
    'vr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a708076134_17121332',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a708076134_17121332')) {function content_5b48a708076134_17121332($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('yml_export.yml2_option_variant'));
?>
<div class="control-group cm-non-cb">
    <label class="control-label"><?php echo $_smarty_tpl->__("yml_export.yml2_option_variant");?>
</label>
    <div class="controls">
        <input type="text" name="option_data[variants][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][yml2_variant]" value="<?php if (!empty($_smarty_tpl->tpl_vars['vr']->value['yml2_variant'])) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['vr']->value['yml2_variant'], ENT_QUOTES, 'UTF-8');
}?>" class="input-medium" />
    </div>
</div>
<?php }} ?>
