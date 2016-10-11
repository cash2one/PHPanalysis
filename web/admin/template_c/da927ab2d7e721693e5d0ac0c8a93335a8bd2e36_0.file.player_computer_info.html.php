<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:42:31
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\register\player_computer_info.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c67922063_81023233',
  'file_dependency' => 
  array (
    'da927ab2d7e721693e5d0ac0c8a93335a8bd2e36' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\register\\player_computer_info.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c67922063_81023233 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\function.html_options.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"><?php echo '</script'; ?>
>
<title>
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['player_software_info'];?>

</title>
</head>



<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['loss_rate_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['player_software_info'];?>
</div>
<form action="?action=search" id="frm" method="POST" >
	<table cellspacing="1" cellpadding="5" class="SumDataGrid" width="500">
		<tr>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['message_type'];?>
：&nbsp;&nbsp;<select name="info_type" id="info_type"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['info_type_option']->value,'selected'=>$_smarty_tpl->tpl_vars['info_type']->value),$_smarty_tpl);?>
</select></td>
			<td width="40%"><input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/></td>
		</tr>
	</table>
	<br>
</form>

<?php if ($_smarty_tpl->tpl_vars['info_type']->value) {?>
<table width="400" border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr class='table_list_head'>
		<td colspan=2 align="center">
	    <font color="red"><?php if ($_smarty_tpl->tpl_vars['info_type']->value == 'version') {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_flash_version'];
} elseif ($_smarty_tpl->tpl_vars['info_type']->value == 'resolution') {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['display_resolution_statistics'];
} elseif ($_smarty_tpl->tpl_vars['info_type']->value == 'brower') {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['browser_version_statistics'];
}?></font></td>
	</tr>
	
	<tr class='table_list_head' align='center'>
		<td><?php if ($_smarty_tpl->tpl_vars['info_type']->value == 'version') {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['version'];
} elseif ($_smarty_tpl->tpl_vars['info_type']->value == 'resolution') {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['display_resolution'];
} elseif ($_smarty_tpl->tpl_vars['info_type']->value == 'brower') {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['browser_version'];
}?></td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_num'];?>
</td>
	</tr>

		<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['version_data']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
		<?php }?>
			<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
			<tr class='trEven' align='center'>
			<?php } else { ?>
			<tr class='trOdd' align='center'>
			<?php }?>
				<td width='60%'><?php echo $_smarty_tpl->tpl_vars['version_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['version_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['version_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['version_cnt'];?>
</td>
			</tr>
		<?php }} else {
 ?>
        <?php
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
</table>
<?php }?>

</body>
</html>
<?php }
}
