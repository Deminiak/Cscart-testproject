<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 14:52:01
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\addons\maps_provider\hooks\index\scripts.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:52675b4892610fc425-67868159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d31b17d95992f127b30726cc15d286c3869821a' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\addons\\maps_provider\\hooks\\index\\scripts.post.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '52675b4892610fc425-67868159',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'settings' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b489261221475_75041680',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b489261221475_75041680')) {function content_5b489261221475_75041680($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'D:/xampp/htdocs/cscart/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_inline_script')) include 'D:/xampp/htdocs/cscart/app/functions/smarty_plugins\\block.inline_script.php';
?><?php echo smarty_function_script(array('src'=>"js/addons/maps_provider/map.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/maps_provider/providers/".((string)$_smarty_tpl->tpl_vars['settings']->value['maps_provider']['general']['map_provider']).".js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/maps_provider/func.js"),$_smarty_tpl);?>



<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
//<![CDATA[
(function(_, $) {
    $.extend(_, {
        maps_provider: <?php echo json_encode(unserialize($_smarty_tpl->tpl_vars['settings']->value['maps_provider_']));?>

    });
}(Tygh, Tygh.$));
//]]>
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>
