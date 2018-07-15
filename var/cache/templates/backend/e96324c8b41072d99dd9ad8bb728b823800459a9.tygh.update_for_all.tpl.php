<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 16:19:24
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\buttons\update_for_all.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66005b48a6dc6e77e5-58013036%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e96324c8b41072d99dd9ad8bb728b823800459a9' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\buttons\\update_for_all.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '66005b48a6dc6e77e5-58013036',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'display' => 0,
    'hide_element' => 0,
    'settings' => 0,
    'title_act' => 0,
    'title_dis' => 0,
    'runtime' => 0,
    'visible' => 0,
    'meta' => 0,
    'title' => 0,
    'object_id' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a6dc759fd1_39470787',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a6dc759fd1_39470787')) {function content_5b48a6dc759fd1_39470787($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis'));
?>
<?php if ($_smarty_tpl->tpl_vars['display']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['hide_element']->value) {?>
        <?php $_smarty_tpl->tpl_vars['title_act'] = new Smarty_variable($_smarty_tpl->__("update_for_all_hid_act"), null, 0);?>
        <?php $_smarty_tpl->tpl_vars['title_dis'] = new Smarty_variable($_smarty_tpl->__("update_for_all_hid_dis"), null, 0);?>
    <?php } else { ?>
        <?php $_smarty_tpl->tpl_vars['title_act'] = new Smarty_variable($_smarty_tpl->__("update_for_all_act"), null, 0);?>
        <?php $_smarty_tpl->tpl_vars['title_dis'] = new Smarty_variable($_smarty_tpl->__("update_for_all_dis"), null, 0);?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['settings']->value['Stores']['default_state_update_for_all']=='active') {?>
        <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable($_smarty_tpl->tpl_vars['title_act']->value, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['visible'] = new Smarty_variable("visible", null, 0);?>
    <?php } else { ?>
        <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable($_smarty_tpl->tpl_vars['title_dis']->value, null, 0);?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['simple_ultimate']) {?>
        <?php $_smarty_tpl->tpl_vars['visible'] = new Smarty_variable("hidden", null, 0);?>
    <?php }?>

    <a class="cm-update-for-all-icon icon-group cm-tooltip <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['visible']->value, ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-title-active="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title_act']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-title-disabled="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title_dis']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-disable-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['hide_element']->value) {?>data-ca-hide-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['hide_element']->value, ENT_QUOTES, 'UTF-8');?>
"<?php }?>></a>
    <input type="hidden" class="cm-no-hide-input" id="hidden_update_all_vendors_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="Y" <?php if ($_smarty_tpl->tpl_vars['settings']->value['Stores']['default_state_update_for_all']=='not_active'&&!$_smarty_tpl->tpl_vars['runtime']->value['simple_ultimate']) {?>disabled="disabled"<?php }?> />
<?php }?>
<?php }} ?>
