<?php
/* Smarty version 3.1.29, created on 2016-07-25 17:26:35
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\analysis\silver_use_stat.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5795db4b555001_07362143',
  'file_dependency' => 
  array (
    '0f3ac9673d0595f5d8d4b4ff9e929b80846f1f86' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\analysis\\silver_use_stat.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5795db4b555001_07362143 ($_smarty_tpl) {
if (!is_callable('smarty_function_cycle')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\function.cycle.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
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
	$(document).ready(function(){
		$("#role_id").keydown(function(){
			$("#acname").val('');
			$("#nickname").val('');
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
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['silver_use_statistics'];?>

</title>
</head>

<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['data_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['silver_use_statistics'];?>
</div>
<span style="color:red;font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['start_to_now'];?>
 【<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['silver_use'];?>
】<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['binded'];?>
:<?php echo $_smarty_tpl->tpl_vars['silver_bind_all']->value;?>
 + <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['not_binded'];?>
:<?php echo $_smarty_tpl->tpl_vars['silver_unbind_all']->value;?>
</span><br>

<div class='divOperation'>
<form name="myform" method="post" action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
">
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
:<input type="text" id="role_id" name="role_id" size="10" value="<?php echo $_smarty_tpl->tpl_vars['role_id']->value;?>
" />
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
:<input type='text' id="nickname" name='nickname' size='10' value='<?php echo $_smarty_tpl->tpl_vars['search1']->value;?>
'/>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
:<input type='text' id="acname" name='acname' size='10' value='<?php echo $_smarty_tpl->tpl_vars['search2']->value;?>
'/>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $_smarty_tpl->tpl_vars['search_keyword1']->value;?>
'/>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $_smarty_tpl->tpl_vars['search_keyword2']->value;?>
'/>
&nbsp;<input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"  />
&nbsp;
<input type="button" class="button" name="datePrev" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['today'];?>
" onclick="javascript:location.href='<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&dateStart=<?php echo $_smarty_tpl->tpl_vars['dateStrToday']->value;?>
&dateEnd=<?php echo $_smarty_tpl->tpl_vars['dateStrToday']->value;?>
';">&nbsp
&nbsp;
<input type="button" class="button" name="datePrev" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['before_one_day'];?>
" onclick="javascript:location.href='<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&dateStart=<?php echo $_smarty_tpl->tpl_vars['dateStrPrev']->value;?>
&dateEnd=<?php echo $_smarty_tpl->tpl_vars['dateStrPrev']->value;?>
';">
&nbsp;
<input type="button" class="button" name="dateNext" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['after_one_day'];?>
" onclick="javascript:location.href='<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&dateStart=<?php echo $_smarty_tpl->tpl_vars['dateStrNext']->value;?>
&dateEnd=<?php echo $_smarty_tpl->tpl_vars['dateStrNext']->value;?>
';">
&nbsp;
<input type="button" class="button" name="dateAll" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['all_total'];?>
" onclick="javascript:location.href='<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&dateStart=ALL&dateEnd=ALL';">
</form>

<?php if ($_smarty_tpl->tpl_vars['list']->value) {?>
<table class='paystat' style="width:100%">
	<tr class='table_list_head'>
		<td>角色Id</td>
		<td>角色名</td>
		<td>用户名</td>
		<td>操作</td>
	</tr>
	<?php
$_from = $_smarty_tpl->tpl_vars['list']->value;
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
?type=url&search_id=<?php echo $_smarty_tpl->tpl_vars['val']->value['rold_id'];?>
&search_nickname=<?php echo $_smarty_tpl->tpl_vars['val']->value['role_name'];?>
&search_acname=<?php echo $_smarty_tpl->tpl_vars['account_name']->value;?>
&dateEndStamp=<?php echo $_smarty_tpl->tpl_vars['dateEndStamp']->value;?>
&dateStartStamp=<?php echo $_smarty_tpl->tpl_vars['dateStartStamp']->value;?>
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


</div>

<?php if ($_smarty_tpl->tpl_vars['keywordlist']->value) {?>
	<div style='float:left;margin-right:5px;'>
	<table cellspacing="1" cellpadding="3" border="0" class='paystat' >
	<!-- SECTION  START -------------------------->

	<tr class='table_list_head'>
		<td colspan=7 >
	    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['silver_use_statistics'];?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['time_statistics'];?>
：<?php echo $_smarty_tpl->tpl_vars['search_keyword1']->value;?>
 0:0:0
	    ~ <?php echo $_smarty_tpl->tpl_vars['search_keyword2']->value;?>
 23:59:59</td>
		<?php if ($_smarty_tpl->tpl_vars['type']->value) {?><td></td><td></td><?php }?>
	</tr>

	<form id="form1" name="form1" method="post" action="">
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
		<tr class='table_list_head'>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['operation_type'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['record_operating_times'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['record_operating_man_num'];?>
</td>
			<!-- <td>总银两</td> -->
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bind'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['silver'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['rate'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['no_bind'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['silver'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['rate'];?>
</td>
		</tr>
		<?php }?>

		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
		<tr class='trEven'>
		<?php } else { ?>
		<tr class='trOdd'>
		<?php }?>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>

			</td>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['c'];?>

			</td>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_num'];?>

			</td>
<!-- 			<td>
			<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver'];?>

			</td> -->
			<td>
			<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver_bind'];?>

			</td>
			<td>
			<font color="red">
				<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver_bind_per'];
if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver_bind'] >= 0) {?>%<?php }?>
			</font>
			</td>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver_unbind'];?>

			</td>
			<td>
			<font color="red">
			<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver_unbind_per'];
if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver_unbind'] >= 0) {?>%<?php }?>
			</font>
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
	</div>
<?php }
if ($_smarty_tpl->tpl_vars['buy_stat']->value) {?>
	<div style='float:left;'>
	<table cellspacing="1" cellpadding="3" border="0" class='paystat' >
		<tr class='table_list_head'>
			<td colspan=10>
				(<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['buy_by_silver'];?>
)<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['props_statistics'];?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['time_statistics'];?>
：<?php echo $_smarty_tpl->tpl_vars['search_keyword1']->value;?>
 0:0:0 ~ <?php echo $_smarty_tpl->tpl_vars['search_keyword2']->value;?>
 23:59:59
			</td>
		<tr>
	<?php
$_from = $_smarty_tpl->tpl_vars['buy_stat']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_1_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$__foreach_row_1_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_1_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
		<?php if ($_smarty_tpl->tpl_vars['key']->value%20 == 0) {?>
		<tr class='table_list_head'>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['props_id'];?>
</a></td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['props_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['total_ge'];?>
</a></td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bind'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['silver'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['rate'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['no_bind'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['silver'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['rate'];?>
</td>
			<!-- <td>总银两</a></td> -->
		</tr>
		<?php }?>
		<tr class="<?php echo smarty_function_cycle(array('values'=>'trOdd, trEven'),$_smarty_tpl);?>
">
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['itemid'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['item_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['amount'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['silver_bind'];?>
</td>
			<td>
				<font color="red">
					<?php echo $_smarty_tpl->tpl_vars['row']->value['silver_bind_per'];
if ($_smarty_tpl->tpl_vars['row']->value['silver_bind'] >= 0) {?>%<?php }?>
				</font>
			</td>
			<td><?php echo $_smarty_tpl->tpl_vars['row']->value['silver_unbind'];?>
</td>
			<td>
				<font color="red"><?php echo $_smarty_tpl->tpl_vars['row']->value['silver_unbind_per'];
if ($_smarty_tpl->tpl_vars['row']->value['silver_unbind'] >= 0) {?>%<?php }?></font>
			</td>
			<!-- <td><?php echo $_smarty_tpl->tpl_vars['row']->value['silver_unbind'];?>
</td> -->
		</tr>
	<?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_1_saved_local_item;
}
if ($__foreach_row_1_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_1_saved_item;
}
if ($__foreach_row_1_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_row_1_saved_key;
}
?>
	</table>
	</div>
<?php } else { ?>
<br><label style="color:red; font-weight:bold;">【<?php echo $_smarty_tpl->tpl_vars['search2']->value;?>
】</label><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['buy_by_silver'];?>

<?php }?>

</body>
</html><?php }
}
