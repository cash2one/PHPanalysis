<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:42:33
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\register\time_lost_rate.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c69388960_85892045',
  'file_dependency' => 
  array (
    '58ee3d46d36b4d100187f25a078bb28ca64d05ef' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\register\\time_lost_rate.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c69388960_85892045 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
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
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['time_lose_rate'];?>

</title>
</head>

<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['loss_rate_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['time_lose_rate'];?>
</div>
	<table width="100%" cellspacing="1" cellpadding="3" border="0" class='table_list'>
		<tr align='left'>
		<td colspan=9><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['sys_time_now'];?>
：<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %H:%M:%S");?>
</td>
		</tr>
	</table>
<div style="float:left;margin:5px 0;">
	<form name="myform" method="post" >
	&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：
	<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='datestart' name='datestart' size='12' value='<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['start']->value,"%Y-%m-%d");?>
'/>
	&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：
	<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateend' name='dateend' size='12' value='<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['end']->value,"%Y-%m-%d");?>
'/>
	&nbsp;<input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/>
	&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['total_role_name'];?>
：<font color="red"><b><?php echo $_smarty_tpl->tpl_vars['total_user']->value;?>
</b></font>&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['roles_in_times'];?>
：<font color="red"><b><?php echo $_smarty_tpl->tpl_vars['count_all_user']->value;?>
</b></font>
	</form>
</div>
<br><br>
<div style='float:left;margin-right:5px;'>
	<table cellspacing=1 cellpadding=3 border=0 class='table_list' style='width:auto;'>
		<tr bgcolor="#A5D0F1">
			<td colspan=3><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['one_day'];?>
</b></td>
		</tr>
		<tr class='table_list_head'>
			<td width="auto"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['finally_offline_time'];?>
<font color="red"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['minus'];?>
</font><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['registered_time'];?>
</b></td>
			<td width="100"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['people_num'];?>
</b></td>
			<td width="100"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['rate'];?>
</b></td>
		</tr>
		<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['one_day_result']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
		<tr class='trEven'>
		<?php } else { ?>
		<tr class='trOdd'>
		<?php }?>
		<td><?php echo $_smarty_tpl->tpl_vars['one_day_result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['one_day_result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['num'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['one_day_result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['rate'];?>
%</td>
		<tr>
		<?php
}
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
	</table>
</div>

<div style='float:left;'>
	<table cellspacing=1 cellpadding=3 border=0 class='table_list' style='width:auto;'>
		<tr bgcolor="#A5D0F1">
			<td colspan=3><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['one_month'];?>
</b></td>
		</tr>
		<tr class='table_list_head'>
			<td width="auto"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['finally_offline_time'];?>
<font color="red"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['minus'];?>
</font><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['registered_time'];?>
</b></td>
           <td width="100"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['people_num'];?>
</b></td>
			<td width="100"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['rate'];?>
</b></td>
		</tr>
		<?php
$__section_loop_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['one_month_result']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_1_total = $__section_loop_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_1_total != 0) {
for ($__section_loop_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_1_iteration <= $__section_loop_1_total; $__section_loop_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_1_iteration;
?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
		<tr class='trEven'>
		<?php } else { ?>
		<tr class='trOdd'>
		<?php }?>
		<td><?php echo $_smarty_tpl->tpl_vars['one_month_result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['one_month_result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['num'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['one_month_result']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['rate'];?>
%</td>
		<tr>
		<?php
}
}
if ($__section_loop_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_1_saved;
}
?>
	</table>
</div>


</body>
</html>
<?php }
}
