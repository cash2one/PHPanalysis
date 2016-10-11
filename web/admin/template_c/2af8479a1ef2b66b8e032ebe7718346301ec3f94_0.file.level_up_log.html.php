<?php
/* Smarty version 3.1.29, created on 2016-07-22 10:02:50
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\analysis\level_up_log.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57917ecaa1aef6_89692822',
  'file_dependency' => 
  array (
    '2af8479a1ef2b66b8e032ebe7718346301ec3f94' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\analysis\\level_up_log.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57917ecaa1aef6_89692822 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_upgrade_record'];?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<style type="text/css">
#all {text-align:left;margin-left:4px; line-height:1;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}
</style>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
		$("#role_id").keydown(function(){
			$("#role_name").val('');
			$("#account_name").val('');
		});
		$("#role_name").keydown(function(){
			$("#role_id").val('');
			$("#account_name").val('');
		});
		$("#account_name").keydown(function(){
			$("#role_id").val('');
			$("#role_name").val('');
		});
	});
<?php echo '</script'; ?>
>
</head>

<body>
	<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['data_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_upgrade_record'];?>
</div>

	<form action="?action=search" id="frm" method="POST" >
	<table cellspacing="1" cellpadding="5" class="SumDataGrid" width="800">
		<tr>
			<td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
：</td>
			<td><input type="text" name="role_id" id="role_id" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['role_id'];?>
" /></td>
			<td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
：</td>
			<td><input type="text" name="role_name" id="role_name" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['role_name'];?>
" /></td>
			<td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
：</td>
			<td><input type="text" name="account_name" id="account_name" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['account_name'];?>
" /></td>
			<td><input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/></td>
		</tr>
	</table>
	<br>
	</form>
	<?php if ($_smarty_tpl->tpl_vars['role']->value) {?>
		<table class='paystat' style="width:57%">
			<tr class='table_list_head'>
				<td>角色ID</td>
				<td>角色名</td>
				<td>用户名</td>
				<td>操作</td>
			</tr>
			<?php
$_from = ((string)$_smarty_tpl->tpl_vars['role']->value);
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_val_0_saved_item = isset($_smarty_tpl->tpl_vars['val']) ? $_smarty_tpl->tpl_vars['val'] : false;
$_smarty_tpl->tpl_vars['val'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['val']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
$__foreach_val_0_saved_local_item = $_smarty_tpl->tpl_vars['val'];
?>
			<tr class="trOdd">
				<td><?php echo $_smarty_tpl->tpl_vars['val']->value['role_id'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['val']->value['role_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['val']->value['account_name'];?>
</td>
				<td><a href="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?action=search&type=continue&role_id=<?php echo $_smarty_tpl->tpl_vars['val']->value['role_id'];?>
&role_name=<?php echo $_smarty_tpl->tpl_vars['val']->value['role_id'];?>
&account_name=<?php echo $_smarty_tpl->tpl_vars['val']->value['account_name'];?>
">查询</a></td>
			</tr>
			<?php
$_smarty_tpl->tpl_vars['val'] = $__foreach_val_0_saved_local_item;
}
if ($__foreach_val_0_saved_item) {
$_smarty_tpl->tpl_vars['val'] = $__foreach_val_0_saved_item;
}
?>
		</table>
	<?php }?>
	<br>
	<table width="800"  border="0" cellpadding="4" cellspacing="1">
		<tr bgcolor="#E9EEF2">
			<td colspan="3" align="left">
				<font color="#006600"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_upgrade_record_alert'];?>
</b></font>
			</td>
        </tr>
	</table>
	<br>
	<!-- 具体一个玩家的升级记录 -->
	<?php if ($_smarty_tpl->tpl_vars['level_data']->value) {?>
	<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr bgcolor="#E5F9FF">
			<td colspan="3" background="/web/admin/static/images/wbg.gif" align="left">
				<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_upgrade_record'];?>
</b></font>
			</td>
        </tr>
	</table>
	<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<!-- SECTION  START ------------------------ -->
		<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['level_data']->value) ? count($_loop) : max(0, (int) $_loop));
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
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['riginal_level'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['now_level'];?>
</td>
                <td>转生等级</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_upgrade_time'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_upgrade_place'];?>
</td>
			</tr>
		<?php }?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
		<tr class='trEven'  align="center">
		<?php } else { ?>
		<tr class='trOdd'  align="center">
		<?php }?>
			<td><?php echo $_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['old_level'];?>
</td>
			<td>
				<?php if ($_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['new_level']-$_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['old_level'] > 1) {?><font color="red"><?php }
echo $_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['new_level'];?>

			</td>
            <td><?php echo $_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['reincarnation'];?>
</td>
			<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mtime'],"%Y-%m-%d %H:%M:%S");?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['level_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['map_id'];?>
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
	<br>
	<?php }?>
    

	<!-- 升级有问题的玩家 -->
	<?php if ($_smarty_tpl->tpl_vars['wrong_level']->value) {?>
	<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr bgcolor="#E5F9FF">
			<td colspan="3" background="/web/admin/static/images/wbg.gif" align="left">
				<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['upgrade_exception_record'];?>
</b></font><font color="#000000"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_upgrade_record_note'];?>
</b></font>
			</td>
        </tr>
	</table>
	<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<!-- SECTION  START -------------------------->
		<?php
$__section_loop_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['wrong_level']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_1_total = $__section_loop_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_1_total != 0) {
for ($__section_loop_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_1_iteration <= $__section_loop_1_total; $__section_loop_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_1_iteration;
?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
			<tr class="table_list_head" align="center">
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['riginal_level'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['now_level'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_upgrade_time'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_upgrade_place'];?>
</td>
			</tr>
		<?php }?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
		<tr class='trEven'  align="center">
		<?php } else { ?>
		<tr class='trOdd'  align="center">
		<?php }?>
			<td><?php echo $_smarty_tpl->tpl_vars['wrong_level']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['wrong_level']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['wrong_level']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['wrong_level']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['old_level'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['wrong_level']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['new_level'];?>
</td>
			<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['wrong_level']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mtime'],"%Y-%m-%d %H:%M:%S");?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['wrong_level']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['map_id'];?>
</td>

		</tr>
		<?php }} else {
 ?>
		<?php
}
if ($__section_loop_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_1_saved;
}
?>
		<!-- SECTION  END -------------------------->
	</table>
	<?php }?>

</body>
</html>
<?php }
}
