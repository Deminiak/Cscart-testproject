<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 16:19:28
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\components\easter_egg.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169675b48a6e00d4a09-18707906%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ae803d9ca6707a62929b8fe5bd5ba2000acd647' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\components\\easter_egg.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '169675b48a6e00d4a09-18707906',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'images_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a6e00f1fc6_28439545',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a6e00f1fc6_28439545')) {function content_5b48a6e00f1fc6_28439545($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('easter.coming_soon_message','cancel'));
?>

<div class="easter">
    <div class="easter__image-container">
        <img
            src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['images_dir']->value, ENT_QUOTES, 'UTF-8');?>
/tux.png"
            class="easter__image"
        />
    </div>

    <p class="easter__text"><?php echo $_smarty_tpl->__("easter.coming_soon_message");?>
</p>

    <div class="easter__close-button">
        <a class="cm-dialog-closer cm-cancel tool-link btn"><?php echo $_smarty_tpl->__("cancel");?>
</a>
    </div>
</div>
<?php }} ?>
