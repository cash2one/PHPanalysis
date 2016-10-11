<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:42:37
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\register\role_reg_lost_stat.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c6d9beb47_82965749',
  'file_dependency' => 
  array (
    '1178cc915231b7d447cc29a028aa6bdd73957a1c' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\register\\role_reg_lost_stat.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c6d9beb47_82965749 ($_smarty_tpl) {
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
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['create_page_lose_rate'];?>

</title>
</head>



<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['loss_rate_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['create_page_lose_rate'];?>
</div>
<div class='divOperation'>
<form name="myform" method="post" action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
">
<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['statistics'];
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：
<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" id='datestart' name='datestart' size='23' value='<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['start']->value,"%Y-%m-%d %H:%M:%S");?>
'/>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_time'];?>
：
<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" id='dateend' name='dateend' size='23' value='<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['end']->value,"%Y-%m-%d %H:%M:%S");?>
'/>
&nbsp;<input type="image" name='search' src="/web/admin/static/images/search.gif" class="input2"/>
</form>
<br>
<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
	<tr class='table_list_head'>
		<td colspan=10 align="left" >
	    <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['time_statistics'];?>
：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['start']->value,"%Y-%m-%d %H:%M:%S");?>
 ~ <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['end']->value,"%Y-%m-%d %H:%M:%S");?>

		</td>
	</tr>
</table>
<br>
<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
	<tr class='table_list_head'>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['cross_num'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['flash_num'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['create_role_page_num'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['click_create_role_num'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['create_role_num'];?>
</td>
	</tr>

	<tr class='trOdd'>
		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[0];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['page_load'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[0];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['page_load_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['page_load_rate'];?>
%</b></td>

		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[1];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['before_load_flash'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[1];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['before_load_flash_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['before_load_flash_rate'];?>
%</b></td>

		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[2];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['flash_loaded'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[2];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['flash_loaded_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['flash_loaded_rate'];?>
%</b></td>

		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[3];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['create_player'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[3];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['create_player_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['create_player_rate'];?>
%</b></td>

		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[4];?>
</td>
	</tr>
</table>
<br><br>
<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
	<tr class='table_list_head'>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['create_role_num'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
                                        <!-- 		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['all_source_loaded'];?>
</td>
                                                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td> -->
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['scene_num'];?>
</td>
                        <!-- <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['take_task1'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task1'];?>
</td> -->
	</tr>

	<tr class='trOdd'>
		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[4];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['player_created'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[4];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['player_created_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['player_created_rate'];?>
%</b></td>

                            <!-- 		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['load_complete'];?>
</td>
                                    <td>(<?php echo $_smarty_tpl->tpl_vars['event_data']->value['load_complete'];?>
-<?php echo $_smarty_tpl->tpl_vars['event_data']->value['enter_game'];?>
)/<?php echo $_smarty_tpl->tpl_vars['all']->value[5];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['load_complete_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['load_complete_rate'];?>
%</b></td> -->

		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[5];?>
</td>
		<!-- <td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['enter_game'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[5];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['enter_game_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['enter_game_rate'];?>
%</b></td>

		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[6];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission0'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[6];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['mission0_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission0_rate'];?>
%</b></td>

		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[7];?>
</td> -->
	</tr>
</table>
<br><br>

<!-- <table cellspacing="1" cellpadding="3" border="0" class='table_list' >
	<tr class='table_list_head'>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task1'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task2'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task3'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task4'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lose_rate'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['task5'];?>
</td>
	</tr>
 
	<tr class='trOdd'>
		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[7];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission1'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[7];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['mission1_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission1_rate'];?>
%</b></td>

		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[8];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission2'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[8];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['mission2_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission2_rate'];?>
%</b></td>
		
		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[9];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission3'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[9];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['mission3_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission3_rate'];?>
%</b></td>

		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[10];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission4'];?>
/<?php echo $_smarty_tpl->tpl_vars['all']->value[10];?>
=<?php if ($_smarty_tpl->tpl_vars['event_data']->value['mission4_rate'] >= 25) {?><font color="red"><?php }?><b><?php echo $_smarty_tpl->tpl_vars['event_data']->value['mission4_rate'];?>
%</b></td>
		
		<td><?php echo $_smarty_tpl->tpl_vars['all']->value[11];?>
</td>
	</tr>
</table>
<br> -->

<!--
<table width="400" border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr class='table_list_head'>
		<td colspan=2 align="left">
	    <font color="red"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_flash_version'];?>
</font>&nbsp;&nbsp;&nbsp;&nbsp;<br><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['time_statistics'];?>
：<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['start']->value,"%Y-%m-%d %H:%M:%S");?>
 ~ <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['end']->value,"%Y-%m-%d %H:%M:%S");?>

		</td>
	</tr>
	
	<tr class='table_list_head'>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['flash_version'];?>
</td>
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
			<tr class='trEven'>
			<?php } else { ?>
			<tr class='trOdd'>
			<?php }?>
				<td width='60%'><?php echo $_smarty_tpl->tpl_vars['version_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['version'];?>
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
</table> -->

<br><br>
</body>
</html><?php }
}
