<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 16:20:12
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\addons\yml_export\hooks\product_features\variants_list_clone.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:293015b48a70ce53fc7-45560398%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '261b41baba9418212dfa5b57162d2f574dfb566e' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\addons\\yml_export\\hooks\\product_features\\variants_list_clone.post.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '293015b48a70ce53fc7-45560398',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'num' => 0,
    'var' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a70ce71554_66173848',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a70ce71554_66173848')) {function content_5b48a70ce71554_66173848($_smarty_tpl) {?><td>
    <input type="text" name="feature_data[variants][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][yml2_unit]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['yml2_unit'], ENT_QUOTES, 'UTF-8');?>
" class="span2">
</td>
<?php }} ?>
