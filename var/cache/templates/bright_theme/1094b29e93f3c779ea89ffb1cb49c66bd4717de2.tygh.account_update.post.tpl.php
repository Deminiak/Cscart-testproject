<?php /* Smarty version Smarty-3.1.21, created on 2018-07-13 15:58:15
         compiled from "D:\xampp\htdocs\cscart\design\themes\responsive\templates\addons\hybrid_auth\hooks\profiles\account_update.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:180585b48a1e71368b7-65810719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1094b29e93f3c779ea89ffb1cb49c66bd4717de2' => 
    array (
      0 => 'D:\\xampp\\htdocs\\cscart\\design\\themes\\responsive\\templates\\addons\\hybrid_auth\\hooks\\profiles\\account_update.post.tpl',
      1 => 1531482650,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '180585b48a1e71368b7-65810719',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'providers_list' => 0,
    'provider_data' => 0,
    'linked_providers' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5b48a1e7316fe2_92675989',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b48a1e7316fe2_92675989')) {function content_5b48a1e7316fe2_92675989($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'D:/xampp/htdocs/cscart/app/functions/smarty_plugins\\function.set_id.php';
?><?php
fn_preload_lang_vars(array('hybrid_auth.link_provider','hybrid_auth.text_link_provider','hybrid_auth.linked_provider','hybrid_auth.not_linked_provider','hybrid_auth.link_provider','hybrid_auth.text_link_provider','hybrid_auth.linked_provider','hybrid_auth.not_linked_provider'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['providers_list']->value) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("hybrid_auth.link_provider")), 0);?>

    <p><?php echo $_smarty_tpl->__("hybrid_auth.text_link_provider");?>
</p>

    <div class="clearfix ty-hybrid-auth__icon-container" id="hybrid_providers">
        <?php  $_smarty_tpl->tpl_vars["provider_data"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["provider_data"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['providers_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["provider_data"]->key => $_smarty_tpl->tpl_vars["provider_data"]->value) {
$_smarty_tpl->tpl_vars["provider_data"]->_loop = true;
?>
        <?php if (in_array($_smarty_tpl->tpl_vars['provider_data']->value['provider'],$_smarty_tpl->tpl_vars['linked_providers']->value)) {?>
        <div class="ty-hybrid-auth__icon ty-float-left">
            <a class="cm-unlink-provider ty-hybrid-auth__remove" data-idp="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['provider'], ENT_QUOTES, 'UTF-8');?>
"><i class="ty-icon-cancel-circle"></i></a>
            <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['icon'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("hybrid_auth.linked_provider");?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['provider'], ENT_QUOTES, 'UTF-8');?>
"/>
        </div>
        <?php }?>
        <?php } ?>
        <div class="ty-hybrid-auth__icon ty-float-left">&nbsp;</div>
        <?php  $_smarty_tpl->tpl_vars["provider_data"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["provider_data"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['providers_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["provider_data"]->key => $_smarty_tpl->tpl_vars["provider_data"]->value) {
$_smarty_tpl->tpl_vars["provider_data"]->_loop = true;
?>
        <?php if (!in_array($_smarty_tpl->tpl_vars['provider_data']->value['provider'],$_smarty_tpl->tpl_vars['linked_providers']->value)) {?>
        <div class="ty-hybrid-auth__icon ty-float-left">

            <a class="cm-link-provider ty-link-unlink-provider" data-idp="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['provider'], ENT_QUOTES, 'UTF-8');?>
">
                <i class="ty-hybrid-auth__add ty-icon-plus-circle"></i>
                <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['icon'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("hybrid_auth.not_linked_provider");?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['provider'], ENT_QUOTES, 'UTF-8');?>
"/>
            </a>
        </div>
        <?php }?>
        <?php } ?>
    <!--hybrid_providers--></div>
<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/hybrid_auth/hooks/profiles/account_update.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/hybrid_auth/hooks/profiles/account_update.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['providers_list']->value) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("hybrid_auth.link_provider")), 0);?>

    <p><?php echo $_smarty_tpl->__("hybrid_auth.text_link_provider");?>
</p>

    <div class="clearfix ty-hybrid-auth__icon-container" id="hybrid_providers">
        <?php  $_smarty_tpl->tpl_vars["provider_data"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["provider_data"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['providers_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["provider_data"]->key => $_smarty_tpl->tpl_vars["provider_data"]->value) {
$_smarty_tpl->tpl_vars["provider_data"]->_loop = true;
?>
        <?php if (in_array($_smarty_tpl->tpl_vars['provider_data']->value['provider'],$_smarty_tpl->tpl_vars['linked_providers']->value)) {?>
        <div class="ty-hybrid-auth__icon ty-float-left">
            <a class="cm-unlink-provider ty-hybrid-auth__remove" data-idp="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['provider'], ENT_QUOTES, 'UTF-8');?>
"><i class="ty-icon-cancel-circle"></i></a>
            <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['icon'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("hybrid_auth.linked_provider");?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['provider'], ENT_QUOTES, 'UTF-8');?>
"/>
        </div>
        <?php }?>
        <?php } ?>
        <div class="ty-hybrid-auth__icon ty-float-left">&nbsp;</div>
        <?php  $_smarty_tpl->tpl_vars["provider_data"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["provider_data"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['providers_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["provider_data"]->key => $_smarty_tpl->tpl_vars["provider_data"]->value) {
$_smarty_tpl->tpl_vars["provider_data"]->_loop = true;
?>
        <?php if (!in_array($_smarty_tpl->tpl_vars['provider_data']->value['provider'],$_smarty_tpl->tpl_vars['linked_providers']->value)) {?>
        <div class="ty-hybrid-auth__icon ty-float-left">

            <a class="cm-link-provider ty-link-unlink-provider" data-idp="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['provider'], ENT_QUOTES, 'UTF-8');?>
">
                <i class="ty-hybrid-auth__add ty-icon-plus-circle"></i>
                <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['icon'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("hybrid_auth.not_linked_provider");?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_data']->value['provider'], ENT_QUOTES, 'UTF-8');?>
"/>
            </a>
        </div>
        <?php }?>
        <?php } ?>
    <!--hybrid_providers--></div>
<?php }
}?><?php }} ?>
