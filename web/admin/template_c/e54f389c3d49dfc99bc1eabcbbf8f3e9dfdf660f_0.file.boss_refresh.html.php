<?php
/* Smarty version 3.1.29, created on 2016-07-22 10:02:52
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\analysis\boss_refresh.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57917ecc8dce10_54489176',
  'file_dependency' => 
  array (
    'e54f389c3d49dfc99bc1eabcbbf8f3e9dfdf660f' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\analysis\\boss_refresh.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57917ecc8dce10_54489176 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
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
			$("#account_name").val('');
			$("#role_name").val('');
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
<title>
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['transaction_records_view'];?>

</title>
</head>



<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['data_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['boss_refresh'];?>
</div>
<div class='divOperation'>
<form name="myform" method="post" action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
">
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['map_id'];?>
:<input type="text" id="role_id" name="map_id" size="10" value="<?php echo $_smarty_tpl->tpl_vars['post1']->value['map_id'];?>
" />
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['map_name'];?>
：<input type='text' id="role_name" name='map_name' size='10' value='<?php echo $_smarty_tpl->tpl_vars['post1']->value['map_name'];?>
'/> 
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['boss_name'];?>
：<input type='text' id="account_name" name='boss_name' size='10' value='<?php echo $_smarty_tpl->tpl_vars['post1']->value['boss_name'];?>
'/>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['type'];?>
id：<input type='text' id="type_id" name='type_id' size='10' value='<?php echo $_smarty_tpl->tpl_vars['post1']->value['type_id'];?>
'/>

&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='datestart' name='dateStart' size='12' value='<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
'/>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateend' name='dateEnd' size='12' value='<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
'/>
&nbsp;<input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/>
<?php if ($_smarty_tpl->tpl_vars['record_count']->value) {?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['total'];
echo $_smarty_tpl->tpl_vars['record_count']->value;
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['records'];?>

<?php } else { ?>
&nbsp;&nbsp;<font color="red"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_in_limittime_no_exc_record'];?>
</font>
<?php }?>
</form>
</div>



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
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['time'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['boss_name'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['type'];?>
id</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['map_name'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['map_id'];?>
</td>
		
	</tr>
	<?php }?>

	<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
	<tr class='trEven'>
	<?php } else { ?>
	<tr class='trOdd'>
	<?php }?>
		<td>
		<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['id'];?>

		</td><td>
		<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mtime'],"%Y-%m-%d %H:%M:%S");?>

		</td><td>
		<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['boss_name'];?>

		</td><td>
		<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['type_id'];?>

		</td><td>
		<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['map_name'];?>

		</td><td>
		<?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['map_id'];?>

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
<div id='1'><center>
                        <?php echo $_smarty_tpl->tpl_vars['page']->value;?>

                    </center>
                </div>
</body>
</html>
<?php }
}
