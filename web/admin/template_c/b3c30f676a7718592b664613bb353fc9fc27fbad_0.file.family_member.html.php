<?php
/* Smarty version 3.1.29, created on 2016-07-22 10:02:56
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\analysis\family_member.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57917ed07d5dc1_00326238',
  'file_dependency' => 
  array (
    'b3c30f676a7718592b664613bb353fc9fc27fbad' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\analysis\\family_member.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57917ed07d5dc1_00326238 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\function.html_options.php';
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$(document).ready(
	function(){
		$("#family_selected").change(
			function(){	
				obj = document.getElementById("family_fill");
				obj.value="";
			}
		);

		$("#family_fill").focus(
			function(){
				obj = document.getElementById("family_selected");
				obj.options[0].selected = true;
			}
		);
	}
);
<?php echo '</script'; ?>
>
<title>
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gang_member_view'];?>

</title>
</head>

<body>

<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['data_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gang_member_view'];?>
</div>

<form action="?action=search" id="frm" method="POST" >
	<table cellspacing="1" cellpadding="5" class="SumDataGrid" width="800">
		<tr>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['select_gang'];?>
：<select name="family" id="family_selected"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['family_option']->value,'selected'=>$_smarty_tpl->tpl_vars['family']->value),$_smarty_tpl);?>
</select></td>
			<td>（<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['or'];?>
）<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['input_gang_name'];?>
：<input id="family_fill" type="text" name="family_fill" value="<?php echo $_smarty_tpl->tpl_vars['family_fill_name']->value;?>
" /></td>
			<td width="30%"><input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/></td>
		</tr>
	</table>
	<br>
</form>

<?php if ($_smarty_tpl->tpl_vars['keywordlist']->value) {?>
	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr bgcolor="#E5F9FF">
			<td colspan="3" background="/web/admin/static/images/wbg.gif" align="left">
				<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['gang_user_list'];?>
</b></font>
			</td>
        </tr>
	</table>
	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<!-- SECTION  START -------------------------->
		<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['keywordlist']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
			<tr class="table_list_head" align="center">
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gang'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['martial_art'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['Office'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['sex'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_level'];?>
</td>
				<td>转生</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['bind_gold'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['unbind_gold'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['silver'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['registered_time'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['offline_time'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['last_offline_time'];?>
</td>
			</tr>
		<?php }?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
		<tr class='trEven'  align="center">
		<?php } else { ?>
		<tr class='trOdd'  align="center">
		<?php }?>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['family_name'];?>
</td>
			<td>
				<?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['faction_id'] == 1) {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['tiandao'];?>

				<?php } elseif ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['faction_id'] == 2) {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['yijian'];?>

				<?php } elseif ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['faction_id'] == 3) {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['yinkui'];?>

				<?php } else {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['cihang'];?>

                <?php }?>
			</td>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['type'];?>
</td>
			<td>
				<?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['sex'] == 1) {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['man'];?>

				<?php } else {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['woman'];?>

				<?php }?>	
			</td>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['reincarnation'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gold_bind'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gold'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver'];?>
</td>
			<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['create_time'],"%Y-%m-%d %H:%M:%S");?>
</td>
			<td>
				<?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['is_online'] == 1) {?><font color="#0000FF"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['online'];?>
</font><?php } else {
if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_day'] >= 3) {?><font color="red"><?php }
echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_day'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['day'];
echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_h_m'];
}?></font>
			</td>
			<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_offline_time'],"%Y-%m-%d %H:%M:%S");?>
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
		<!-- SECTION  END -------------------------->
	</table>
<?php }?>

</body>
</html>
<?php }
}
