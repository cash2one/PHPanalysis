<?php
/* Smarty version 3.1.29, created on 2016-09-07 20:11:20
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\pay\gold_use_list.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d003e81c3774_10817084',
  'file_dependency' => 
  array (
    'c7e9199ca66c285f2cf2de27cee2b7f5b2164aa0' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\pay\\gold_use_list.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d003e81c3774_10817084 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
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
<title>
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['ingot_use_rank'];?>

</title>
</head>

<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['data_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['ingot_use_rank'];?>
 【元宝交易不计入排行】</div>
<div class='divOperation'>
<form name="myform" method="post" action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
">
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' value='<?php echo $_smarty_tpl->tpl_vars['search_keyword1']->value;?>
'/>

&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dateEnd' size='12' value='<?php echo $_smarty_tpl->tpl_vars['search_keyword2']->value;?>
'/>

&nbsp;&nbsp;

<input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"  />

&nbsp;&nbsp;&nbsp;&nbsp
<input type="button" class="button" name="datePrev" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['today'];?>
" onclick="javascript:location.href='<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&dateStart=<?php echo $_smarty_tpl->tpl_vars['dateStrToday']->value;?>
&dateEnd=<?php echo $_smarty_tpl->tpl_vars['dateStrToday']->value;?>
&level_type=<?php echo $_smarty_tpl->tpl_vars['level_type']->value;?>
';">
&nbsp;&nbsp
<input type="button" class="button" name="datePrev" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['before_one_day'];?>
" onclick="javascript:location.href='<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&dateStart=<?php echo $_smarty_tpl->tpl_vars['dateStrPrev']->value;?>
&dateEnd=<?php echo $_smarty_tpl->tpl_vars['dateStrPrev']->value;?>
&level_type=<?php echo $_smarty_tpl->tpl_vars['level_type']->value;?>
';">
&nbsp;&nbsp
<input type="button" class="button" name="dateNext" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['after_one_day'];?>
" onclick="javascript:location.href='<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&dateStart=<?php echo $_smarty_tpl->tpl_vars['dateStrNext']->value;?>
&dateEnd=<?php echo $_smarty_tpl->tpl_vars['dateStrNext']->value;?>
&level_type=<?php echo $_smarty_tpl->tpl_vars['level_type']->value;?>
';">
&nbsp;&nbsp
<input type="button" class="button" name="dateAll" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['all_total'];?>
" onclick="javascript:location.href='<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?order=<?php echo $_smarty_tpl->tpl_vars['order']->value;?>
&dateStart=ALL&dateEnd=ALL&level_type=<?php echo $_smarty_tpl->tpl_vars['level_type']->value;?>
';">

</form>

</div>
<div>
<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
<!-- SECTION  START -------------------------->
<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['rs']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
	<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
	<tr class='table_list_head'>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['rank'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
		<!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['total_ingot_use'];?>
</td>-->
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['total_use_gole'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['total_use_bind_gole'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['offline_time'];?>
 </td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['last_offline_time'];?>
</td>
		
	</tr>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
	<tr class='trEven'>
	<?php } else { ?>
	<tr class='trOdd'>
	<?php }?>
    <td><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)+$_smarty_tpl->tpl_vars['pgno']->value;?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['user_id'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['user_name'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
</td>
    <!--<td><?php echo $_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['ug'];?>
</td>-->
    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gub'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gb'];?>
</td>
    <td><?php if ($_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['is_online'] == 1) {?><font color="#0000FF"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['online'];?>
</font><?php } else {
if ($_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_day'] >= 3) {?><font color="red"><?php }
echo $_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_day'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['day'];
echo $_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_h_m'];
}?></font></td>
    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_offline_time'],"%Y-%m-%d %H:%M:%S");?>
</td>
	</tr>
<?php }} else {
 ?>
<tr><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['no_ranking'];?>
</td></tr>
<?php
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
</table>
</div>
<br>

</body>
</html><?php }
}
