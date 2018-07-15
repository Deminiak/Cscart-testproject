<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 16:20:04
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\addons\yml_export\hooks\product_options\properties.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:275175b48a70413c0c8-36467083%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ba26261acb3fae640909c2cebff8c36550fdaab' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\addons\\yml_export\\hooks\\product_options\\properties.post.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '275175b48a70413c0c8-36467083',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'option_data' => 0,
    'yml2_options' => 0,
    'code' => 0,
    'option' => 0,
    'option_key' => 0,
    'type' => 0,
    'name_type' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a704227071_26219058',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a704227071_26219058')) {function content_5b48a704227071_26219058($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'D:/xampp/htdocs/cscart/app/functions/smarty_plugins\\function.script.php';
?><?php
fn_preload_lang_vars(array('yml2_type_options','yml2_type_option_param'));
?>
<?php echo smarty_function_script(array('src'=>"js/addons/yml_export/ym_options.js"),$_smarty_tpl);?>

<div class="control-group">
    <label class="control-label" for="elm_option_yml2_type_options_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("yml2_type_options");?>
</label>
    <div class="controls">
        <select id="elm_option_yml2_type_options_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" name="option_data[yml2_type_options]" class="cm-ym-option-select" data-option-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <option value="" <?php if (empty($_smarty_tpl->tpl_vars['option_data']->value['yml2_type_options'])) {?>selected="selected"<?php }?>>--</option>
            <?php  $_smarty_tpl->tpl_vars["option"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["option"]->_loop = false;
 $_smarty_tpl->tpl_vars["code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['yml2_options']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["option"]->key => $_smarty_tpl->tpl_vars["option"]->value) {
$_smarty_tpl->tpl_vars["option"]->_loop = true;
 $_smarty_tpl->tpl_vars["code"]->value = $_smarty_tpl->tpl_vars["option"]->key;
?>
                <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['option_data']->value['yml2_type_options']==$_smarty_tpl->tpl_vars['code']->value) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
            <?php } ?>
        </select>
    </div>
</div>

<?php  $_smarty_tpl->tpl_vars["option"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["option"]->_loop = false;
 $_smarty_tpl->tpl_vars["option_key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['yml2_options']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["option"]->key => $_smarty_tpl->tpl_vars["option"]->value) {
$_smarty_tpl->tpl_vars["option"]->_loop = true;
 $_smarty_tpl->tpl_vars["option_key"]->value = $_smarty_tpl->tpl_vars["option"]->key;
?>

    <?php if (!empty($_smarty_tpl->tpl_vars['option']->value['types'])) {?>
    <div class="control-group ym-option" id="ym_option_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option_key']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['option_data']->value['yml2_type_options']!=$_smarty_tpl->tpl_vars['option_key']->value) {?> style="display: none"<?php }?>>
        <label class="control-label" for="elm_option_yml2_option_param_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("yml2_type_option_param");?>
</label>
        <div class="controls">
            <select id="elm_option_yml2_option_param_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option_key']->value, ENT_QUOTES, 'UTF-8');?>
" name="option_data[yml2_option_param]" class="cm-ym-option-type-select" data-option-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option_key']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['option_data']->value['yml2_type_options']!=$_smarty_tpl->tpl_vars['option_key']->value) {?>disabled="disabled"<?php }?>>
                <?php  $_smarty_tpl->tpl_vars["name_type"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["name_type"]->_loop = false;
 $_smarty_tpl->tpl_vars["type"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['option']->value['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["name_type"]->key => $_smarty_tpl->tpl_vars["name_type"]->value) {
$_smarty_tpl->tpl_vars["name_type"]->_loop = true;
 $_smarty_tpl->tpl_vars["type"]->value = $_smarty_tpl->tpl_vars["name_type"]->key;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['option_data']->value['yml2_option_param']==$_smarty_tpl->tpl_vars['type']->value) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name_type']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
                <?php if ($_smarty_tpl->tpl_vars['option']->value['customer_type']) {?>
                    <option value="customer" <?php if (!empty($_smarty_tpl->tpl_vars['option_data']->value['yml2_option_param'])&&!array_key_exists($_smarty_tpl->tpl_vars['option_data']->value['yml2_option_param'],$_smarty_tpl->tpl_vars['option']->value['types'])) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__('yml2_option_type_customer');?>
</option>
                <?php }?>
            </select>
            <?php if ($_smarty_tpl->tpl_vars['option']->value['customer_type']) {?>
                <input type="text" name="option_data[yml2_option_param]" id="elm_yml2_option_param_input_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option_key']->value, ENT_QUOTES, 'UTF-8');?>
" size="10" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option_data']->value['yml2_option_param'], ENT_QUOTES, 'UTF-8');?>
" class="input-long option_param_input"
                        <?php if (empty($_smarty_tpl->tpl_vars['option_data']->value['yml2_option_param'])||array_key_exists($_smarty_tpl->tpl_vars['option_data']->value['yml2_option_param'],$_smarty_tpl->tpl_vars['option']->value['types'])) {?> disabled="disabled" style="display: none;"<?php }?>/>
            <?php }?>
        </div>
    </div>
    <?php }?>
<?php } ?>
<?php }} ?>
