<?php
/* Smarty version 3.1.29, created on 2016-07-22 10:02:54
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\analysis\exp_add_log_view.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57917ece512729_90000955',
  'file_dependency' => 
  array (
    '33d021e2ffd3cef843aad6ddeb970c352d9a8b5c' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\analysis\\exp_add_log_view.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57917ece512729_90000955 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\function.html_options.php';
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
		$("#role_id").keydown(function(){
			$("#nickname").val('');
			$("#acname").val('');
		});
		$("#nickname").keydown(function(){
			$("#role_id").val('');
			$("#acname").val('');
		});
		$("#acname").keydown(function(){
			$("#role_id").val('');
			$("#nickname").val('');
		});
	});
<?php echo '</script'; ?>
>
<title>
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['silver_use_records'];?>

</title>

    <style>
        .show_page{
            margin:0 4px;
        }
        .me{
            color:#ff0000;
        }
    </style>
</head>



<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['data_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['role_add_exp'];?>
</div>
<div class='divOperation'>
<form name="myform" method="post" action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?action=do">
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
:<input type="text" id="role_id" name="role_id" size="10" value="<?php echo $_smarty_tpl->tpl_vars['role_id']->value;?>
" />
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
：<input type='text' id="nickname" name='nickname' size='10' value='<?php echo $_smarty_tpl->tpl_vars['search_keyword2']->value;?>
'/> 
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
：<input type='text' id="acname" name='acname' size='10' value='<?php echo $_smarty_tpl->tpl_vars['search_keyword1']->value;?>
'/>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $_smarty_tpl->tpl_vars['time_start']->value;?>
'/>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $_smarty_tpl->tpl_vars['time_end']->value;?>
'/>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['sort'];?>

<select name="sort_1">
	<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['sortoption']->value,'selected'=>$_smarty_tpl->tpl_vars['search_sort_1']->value),$_smarty_tpl);?>

</select>
&nbsp;<input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/>
&nbsp;&nbsp;
<?php if ($_smarty_tpl->tpl_vars['record_count']->value) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['total'];
echo $_smarty_tpl->tpl_vars['record_count']->value;
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['records'];?>

<?php }?>
</form>
</div>

<?php if ($_smarty_tpl->tpl_vars['role']->value) {?>
<table class='paystat' style="width:100%">
	<tr class='table_list_head'>
		<td>角色ID</td>
		<td>角色名称</td>
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
?action=continue&role_id=<?php echo $_smarty_tpl->tpl_vars['val']->value['role_id'];?>
&role_name=<?php echo $_smarty_tpl->tpl_vars['val']->value['role_name'];?>
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
<!-- <?php if ($_smarty_tpl->tpl_vars['balance']->value) {?>
<span style="color:red;font-weight: bold;">银两流水统计：<?php echo $_smarty_tpl->tpl_vars['balance']->value;?>
银两</span>
<span>这里的数值必须是负数或0。正数表明该玩家帐号有问题。如果为-100，则表示该玩家目前拥有100银两；0表示没有银两。</span>
<?php }?> -->

<table width="100%"  border="0" cellspacing="0" cellpadding="0" class='table_page_num'>
  <tr>
    <td height="30" class="even">
        <?php echo $_smarty_tpl->tpl_vars['show']->value;?>

    </td>
  </tr>
</table>

<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
<!-- SECTION  START -------------------------->
<form id="form1" name="form1" method="post" action="">
<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['list']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
	<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
	<tr class='table_list_head'>
		<td>id</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['use_time'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['level_after_add'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['old_exp'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['now_exp'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['add_exp'];?>
</td>
	</tr>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
	<tr class='trEven'>
	<?php } else { ?>
	<tr class='trOdd'>
	<?php }?>
		<td><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
</td>
		<td>
		<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mtime'],"%Y-%m-%d %H:%M:%S");?>

		</td>
		<td><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>

		</td>
        <td><?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['old_exp'];?>

		</td>
        <td>
		<?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['now_exp'];?>

		</td>
		<td>
		<?php echo $_smarty_tpl->tpl_vars['list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['add_exp'];?>

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

</form>
</table>

</body>
</html>
<?php }
}
