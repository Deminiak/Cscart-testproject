<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 15:58:15
         compiled from "D:\xampp\htdocs\cscart\design\themes\responsive\templates\blocks\static_templates\profile_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23285b48a1e7a4c075-54805019%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97a82b1c691387bc4f6de9509364916a6f99b73c' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\themes\\responsive\\templates\\blocks\\static_templates\\profile_info.tpl',
      1 => 1531482567,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '23285b48a1e7a4c075-54805019',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a1e7ab6826_75098699',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a1e7ab6826_75098699')) {function content_5b48a1e7ab6826_75098699($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'D:/xampp/htdocs/cscart/app/functions/smarty_plugins\\function.set_id.php';
?><?php
fn_preload_lang_vars(array('text_profile_benefits','text_profile_details','text_profile_benefits','text_profile_details'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['runtime']->value['controller']=='profiles') {?>
    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=='add') {?>
    <div class="ty-account-benefits">
        <?php echo $_smarty_tpl->__("text_profile_benefits");?>

    </div>

    <?php } elseif ($_smarty_tpl->tpl_vars['runtime']->value['mode']=='update') {?>
        <div class="ty-account-detail">
            <?php echo $_smarty_tpl->__("text_profile_details");?>

        </div>
    <?php }?>
<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/static_templates/profile_info.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/static_templates/profile_info.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['runtime']->value['controller']=='profiles') {?>
    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=='add') {?>
    <div class="ty-account-benefits">
        <?php echo $_smarty_tpl->__("text_profile_benefits");?>

    </div>

    <?php } elseif ($_smarty_tpl->tpl_vars['runtime']->value['mode']=='update') {?>
        <div class="ty-account-detail">
            <?php echo $_smarty_tpl->__("text_profile_details");?>

        </div>
    <?php }?>
<?php }
}?><?php }} ?>
