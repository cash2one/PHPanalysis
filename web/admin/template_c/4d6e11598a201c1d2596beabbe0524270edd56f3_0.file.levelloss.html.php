<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:42:34
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\levelcount\levelloss.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c6a569305_01135648',
  'file_dependency' => 
  array (
    '4d6e11598a201c1d2596beabbe0524270edd56f3' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\levelcount\\levelloss.html',
      1 => 1468910703,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c6a569305_01135648 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['level_lose_rate'];?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
    <?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
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
<?php echo '</script'; ?>
>
</head>

<body>
	<div id="all">	
	<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['loss_rate_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['level_lose_rate'];?>
</div>
	<table width="100%" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr bgcolor="#E5F9FF">
		<td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
			<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['note'];?>
</b></font>
		</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['level_lose_rate_note1'];?>
</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['level_lose_rate_note2'];?>
</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['level_lose_rate_note3'];?>
</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['level_lose_rate_note4'];?>
</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['level_lose_rate_note5'];?>
</td>
	</tr>
</table>
<br>
        <div id="main">
            <div class="box">
                <div id="nodes">
                <form name="myform" method="post" ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['registered_time'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_day_time'];?>
&nbsp;
                    <input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dStartTime' size='12' value='<?php echo $_smarty_tpl->tpl_vars['dStartTime']->value;?>
'/>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['end_day_time'];?>
&nbsp;<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateEnd' name='dEndTime' size='12' value='<?php echo $_smarty_tpl->tpl_vars['dEndTime']->value;?>
'/>
              &nbsp; &nbsp; <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_level'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['from'];?>
：<input type='text' name='minlevel' size='3' value='<?php echo $_smarty_tpl->tpl_vars['minlevel']->value;?>
' />
                &nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['to'];?>
：<input type='text' name='maxlevel' size='3' value='<?php echo $_smarty_tpl->tpl_vars['maxlevel']->value;?>
' />
                &nbsp;<input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/>
                </form>
                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr class='table_list_head'>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_level'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['on_level_users_num'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['on_level_users_rate'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['on_level_users_lose_num'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['on_level_users_lose_rate'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['level_lose_rate'];?>
</td>
                        </tr>

                    <?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['keywordlist']->value) ? count($_loop) : max(0, (int) $_loop));
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
                            <td>
                            <?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'] == null) {?> 总计
                            <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>

                            <?php }?>
                            </td>
							<td>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['count'];?>

                            </td>
							<td>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level_rate'];?>
%
							</td>
							<td>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['loss'];?>

                            </td>
							<td><?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level_loss_rate'] >= 50) {?><font color="red"><?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level_loss_rate'];?>
%
							</td>
							<td><?php if ($_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['lossrate'] >= 50) {?><font color="red"><?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['keywordlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['lossrate'];?>
%
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
                </div>
            </div>
        </div>
	</div>
</body>
</html>
<?php }
}
