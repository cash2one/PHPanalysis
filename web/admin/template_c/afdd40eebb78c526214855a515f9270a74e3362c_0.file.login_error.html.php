<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:42:30
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\register\login_error.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c66a94fe9_14317230',
  'file_dependency' => 
  array (
    'afdd40eebb78c526214855a515f9270a74e3362c' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\register\\login_error.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c66a94fe9_14317230 ($_smarty_tpl) {
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
	 <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_error_statistics'];?>

</title>
</head>

<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['loss_rate_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_error_statistics'];?>
</div>

<table width="800" border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr class='table_list_head'>
		<td colspan=3 align="center">
	    <font color="red"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_error_statistics'];?>
</font></td>
	</tr>
	
	<tr class='table_list_head' align='center'>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['error_place'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['error_type'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['people_num'];?>
</td>
	</tr>

		<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['error_data']->value) ? count($_loop) : max(0, (int) $_loop));
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
				<td><?php echo $_smarty_tpl->tpl_vars['error_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['error_step'];?>
---<?php echo $_smarty_tpl->tpl_vars['error_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['error_desc'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['error_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['error_id'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['error_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['error_cnt'];?>
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

</body>
</html>
<?php }
}
