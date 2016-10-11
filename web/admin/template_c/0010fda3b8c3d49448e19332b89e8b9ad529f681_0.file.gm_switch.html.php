<?php
/* Smarty version 3.1.29, created on 2016-08-04 18:39:02
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\gm\gm_switch.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57a31b46de6dc5_10483265',
  'file_dependency' => 
  array (
    '0010fda3b8c3d49448e19332b89e8b9ad529f681' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\gm\\gm_switch.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57a31b46de6dc5_10483265 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['open_close'];?>
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
 type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript">
	//竞技场
	function doOpenMatch(){
		$("#frmMatch").attr("action","?action=do1&type=open");
		$("#frmMatch").submit();
	}
	function doCloseMatch(){
		$("#frmMatch").attr("action","?action=do2&type=close");
		$("#frmMatch").submit();
	}
	function doForceStop(){
		$("#frmMatch").attr("action","?action=do8&type=close");
		$("#frmMatch").submit();
	}
	function doOpenMatchTime(){
		$("#frmMatch").attr("action","?action=do3&type=open_time");
		$("#frmMatch").submit();
	}

	//坐骑竞技
	function doOpenMountMatch(){
		$("#frmMatch").attr("action","?action=do5&type=open");
		$("#frmMatch").submit();
	}
	function doCloseMountMatch(){
		$("#frmMatch").attr("action","?action=do6&type=close");
		$("#frmMatch").submit();
	}
	function doOpenMountMatchTime(){
		$("#frmMatch").attr("action","?action=do7&type=open_time");
		$("#frmMatch").submit();
	}
	//防沉迷系统
	function doOpenFcm(){
		$("#frmMatch").attr("action","?action=do9&type=open");
		$("#frmMatch").submit();
	}
	function doCloseFcm(){
		$("#frmMatch").attr("action","?action=do10&type=close");
		$("#frmMatch").submit();
	}
<?php echo '</script'; ?>
>
</head>

 <body>
 <div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_manage'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['open_close'];?>
</div>
 <div id="all">
					<form action="?action=do0&type=title" id="frmMatch" method="post">
                		<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF">
                            <td colspan="3" background="/web/admin/static/images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['arena'];?>
</b></font>
							</td>
                        </tr>
						<tr class='trEven'  align="center">
							<td>
								<input name="btnOpenMatch" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['open_arena_sys'];?>
" onclick="doOpenMatch();" type="button">
							</td>
							<td>
								<input name="btnCloseMatch" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['close_arena_sys'];?>
" onclick="doCloseMatch();" type="button">
							</td>
							<td>
								<input name="btnForceStop" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['forced_end_game'];?>
" onclick="doForceStop();" type="button">
							</td>
						</tr>
						<tr class='trOdd'  align="center">
							<td ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date_time'];?>
</td>
							<td >
								<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'HH:mm'})" id='match_start_time' name='match_start_time' size='12' value='<?php echo $_smarty_tpl->tpl_vars['match_start_time']->value;?>
'/>
							</td>
							<td>
								<input name="btnOpenMatchTime" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['set_arena_on_time'];?>
" onclick="doOpenMatchTime();" type="button">
							</td>
						</tr>
						</table>
					</form>

					<br>

					<form action="?action=do4&type=title" method="post">
                		<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF">
                            <td colspan="3" background="/web/admin/static/images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['horse_sports'];?>
</b></font>
							</td>
                        </tr>
						<tr class='trEven'  align="center">
							<td>
								<input name="btnOpenMountMatch" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['on_horse_sports'];?>
" onclick="doOpenMountMatch();" type="button">
							</td>
							<td>
								<input name="btnCloseMountMatch" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['off_horse_sports'];?>
" onclick="doCloseMountMatch();" type="button">
							</td>
							<td>
							</td>
						</tr>
						<tr class='trOdd'  align="center">
							<td ><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['date_time'];?>
</td>
							<td >
								<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'HH:mm'})" id='mount_match_start_time' name='mount_match_start_time' size='12' value='<?php echo $_smarty_tpl->tpl_vars['mount_match_start_time']->value;?>
'/>
							</td>
							<td>
								<input name="btnOpenMountMatchTime" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['set_horse_sports_on_time'];?>
" onclick="doOpenMountMatchTime();" type="button">
							</td>
						</tr>
						</table>
					</form>

					<br>

					<form action="?action=do&type=title" method="post">
                		<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF">
                            <td colspan="3" background="/web/admin/static/images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['fatigue_system'];?>
</b></font>
							</td>
                        </tr>
						<tr class='trEven'  align="center">
							<td>
								<input name="btnOpenFcm" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['on_fatigue_system'];?>
" onclick="doOpenFcm();" type="button">
							</td>
							<td>
								<input name="btnCloseFcm" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['off_fatigue_system'];?>
" onclick="doCloseFcm();" type="button">
							</td>
						</tr>
						</table>
					</form>
	</div>
 
 </body>
</html>
<?php }
}
