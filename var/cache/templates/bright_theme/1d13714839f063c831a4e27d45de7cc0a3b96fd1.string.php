<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 15:48:42
         compiled from "1d13714839f063c831a4e27d45de7cc0a3b96fd1" */ ?>
<?php /*%%SmartyHeaderCode:223565b489faa07c594-15414591%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d13714839f063c831a4e27d45de7cc0a3b96fd1' => 
    array (
      0 => '1d13714839f063c831a4e27d45de7cc0a3b96fd1',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '223565b489faa07c594-15414591',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'addons' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b489faa1f7199_12607668',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b489faa1f7199_12607668')) {function content_5b489faa1f7199_12607668($_smarty_tpl) {?><?php if (!is_callable('smarty_function_call_phone')) include 'D:/xampp/htdocs/cscart/app/addons/call_requests/functions/smarty_plugins\\function.call_phone.php';
if (!is_callable('smarty_function_call_request')) include 'D:/xampp/htdocs/cscart/app/addons/call_requests/functions/smarty_plugins\\function.call_request.php';
?><?php if ($_smarty_tpl->tpl_vars['addons']->value['call_requests']['status']=="A") {?>
<div class="ty-cr-phone-number-link">
    <div class="ty-cr-phone"><?php echo smarty_function_call_phone(array(),$_smarty_tpl);?>
  <span class="ty-cr-work">Пн-Пт с 9:00 до 18:00</span></div>
    <div class="ty-cr-link"><?php echo smarty_function_call_request(array(),$_smarty_tpl);?>
</div>
</div>
<?php }?><?php }} ?>
