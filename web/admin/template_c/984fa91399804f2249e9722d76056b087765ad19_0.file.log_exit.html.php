<?php
/* Smarty version 3.1.29, created on 2016-07-22 10:02:54
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\analysis\log_exit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57917eceed68e8_17933022',
  'file_dependency' => 
  array (
    '984fa91399804f2249e9722d76056b087765ad19' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\analysis\\log_exit.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57917eceed68e8_17933022 ($_smarty_tpl) {
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
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['error_logout'];?>

</title>
</head>



<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['data_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['error_logout'];?>
</div>
<div class='divOperation'>
<form name="myform" method="post" action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?action=do">
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
:<input type="text" id="role_id" name="role_id" size="10" value="<?php echo $_smarty_tpl->tpl_vars['role_id']->value;?>
" />
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
：<input type='text' id="acname" name='acname' size='10' value='<?php echo $_smarty_tpl->tpl_vars['search_keyword1']->value;?>
'/>
&nbsp;IP：<input type='text'  name='ip' size='15' value='<?php echo $_smarty_tpl->tpl_vars['ip']->value;?>
' />
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


<table width="100%"  border="0" cellspacing="0" cellpadding="0" class='table_page_num'>
  <tr>
    <td height="30" class="even">
<form method="get" action="">
 <?php
$_from = $_smarty_tpl->tpl_vars['page_list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_0_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_0_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_0_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?dateStart=<?php echo rawurlencode($_smarty_tpl->tpl_vars['time_start']->value);?>
&amp;dateEnd=<?php echo rawurlencode($_smarty_tpl->tpl_vars['time_end']->value);?>
&amp;role_id=<?php echo rawurlencode($_smarty_tpl->tpl_vars['role_id']->value);?>
&amp;acname=<?php echo rawurlencode($_smarty_tpl->tpl_vars['search_keyword1']->value);?>
&amp;nickname=<?php echo rawurlencode($_smarty_tpl->tpl_vars['search_keyword2']->value);?>
&amp;sort_1=<?php echo $_smarty_tpl->tpl_vars['search_sort_1']->value;?>
&amp;sort_2=<?php echo $_smarty_tpl->tpl_vars['search_sort_2']->value;?>
&amp;page=<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
&amp;ip=<?php echo $_smarty_tpl->tpl_vars['ip']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</a><span style="width:5px;"></span>
 <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
if ($__foreach_item_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_0_saved_key;
}
if ($_smarty_tpl->tpl_vars['page_count']->value > 0) {?>

<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all_page'];?>
(<?php echo $_smarty_tpl->tpl_vars['page_count']->value;?>
)
<?php if ($_smarty_tpl->tpl_vars['page_count']->value > 5) {?>
	<input name="role_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['role_id']->value;?>
">
	<input name="nickname" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['search_keyword2']->value;?>
">
	<input name="acname" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['search_keyword1']->value;?>
">
	<input name="sort_1" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['search_sort_1']->value;?>
">
	<input name="sort_2" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['search_sort_2']->value;?>
">
    <input name="page" type="text" class="text" size="3" maxlength="6">
	&nbsp;<input type="submit" class="button" name="Submit" value="GO">
<?php }?>

[ <a href="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?excel=true&role_id=<?php echo rawurlencode($_smarty_tpl->tpl_vars['role_id']->value);?>
&amp;acname=<?php echo rawurlencode($_smarty_tpl->tpl_vars['search_keyword1']->value);?>
&amp;nickname=<?php echo rawurlencode($_smarty_tpl->tpl_vars['search_keyword2']->value);?>
&amp;sort_1=<?php echo $_smarty_tpl->tpl_vars['search_sort_1']->value;?>
&amp;sort_2=<?php echo $_smarty_tpl->tpl_vars['search_sort_2']->value;?>
&amp;forceFlag=<?php echo $_smarty_tpl->tpl_vars['forceFlag']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['out_excel'];?>
</a> ]
<?php }?>
</form>
    </td>
  </tr>
</table>

<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
<!-- SECTION  START -------------------------->
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
		<td>id</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['use_time'];?>
</td>
		<td>ip</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['reason'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['before_state'];?>
</td>
	</tr>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
	<tr class='trEven'>
	<?php } else { ?>
	<tr class='trOdd'>
	<?php }?>
		<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
</td>
		<td>
		<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mtime'],"%Y-%m-%d %H:%M");?>

		</td>
		<td><?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['ip'];?>

		</td><td>
		<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['reason'];?>

		</td>
		<td>
		<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['state_view'];?>

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
