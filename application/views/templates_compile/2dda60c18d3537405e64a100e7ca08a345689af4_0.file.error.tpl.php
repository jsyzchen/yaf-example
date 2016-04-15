<?php /* Smarty version 3.1.27, created on 2016-01-19 12:42:47
         compiled from "/Users/chenchen/web/php/project/chachalou/application/views/error/error.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1892816378569dbec70b13d8_86263376%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2dda60c18d3537405e64a100e7ca08a345689af4' => 
    array (
      0 => '/Users/chenchen/web/php/project/chachalou/application/views/error/error.tpl',
      1 => 1453178492,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1892816378569dbec70b13d8_86263376',
  'variables' => 
  array (
    'exception' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_569dbec70b6db0_41389011',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_569dbec70b6db0_41389011')) {
function content_569dbec70b6db0_41389011 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1892816378569dbec70b13d8_86263376';
?>
Error Msg:<?php echo $_smarty_tpl->tpl_vars['exception']->value->getMessage();?>


<?php }
}
?>