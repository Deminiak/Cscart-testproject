<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 16:17:59
         compiled from "D:\xampp\htdocs\cscart\design\backend\templates\addons\gift_certificates\hooks\orders\search_form.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210185b48a68776b677-06679036%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f35b9d488ee5b29b2ce32ad41b64c84b1ec31375' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\backend\\templates\\addons\\gift_certificates\\hooks\\orders\\search_form.post.tpl',
      1 => 1531112124,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '210185b48a68776b677-06679036',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'search' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a68781a633_73349702',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a68781a633_73349702')) {function content_5b48a68781a633_73349702($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('gift_cert_code','purchased','used'));
?>
<div class="search-field">
    <label for="gift_cert_code"><?php echo $_smarty_tpl->__("gift_cert_code");?>
:</label>
    <input type="text" name="gift_cert_code" id="gift_cert_code" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['gift_cert_code'], ENT_QUOTES, 'UTF-8');?>
" size="30" class="input-text" />
    <select name="gift_cert_in">
        <option value="B|U">--</option>
        <option value="B" <?php if ($_smarty_tpl->tpl_vars['search']->value['gift_cert_in']=="B") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("purchased");?>
</option>
        <option value="U" <?php if ($_smarty_tpl->tpl_vars['search']->value['gift_cert_in']=="U") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("used");?>
</option>
    </select>
</div><?php }} ?>
