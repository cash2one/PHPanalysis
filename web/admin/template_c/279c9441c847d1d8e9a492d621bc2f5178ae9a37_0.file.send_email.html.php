<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:41:06
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\pay\send_email.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c120e1f71_05188254',
  'file_dependency' => 
  array (
    '279c9441c847d1d8e9a492d621bc2f5178ae9a37' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\pay\\send_email.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c120e1f71_05188254 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['send_message'];?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<style type="text/css">
#all {
	text-align: left;
	margin-left: 4px;
	line-height: 1;
}

#nodes {
	width: 100%;
	float: left;
	border: 1px #ccc solid;
}

#result {
	width: 100%;
	height: 100%;
	clear: both;
	border: 1px #ccc solid;
}
</style>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$(document).ready(function(){
		$("#role_id").keydown(function(){
			$("#role_name").val('');
		});
		$("#role_name").keydown(function(){
			$("#role_id").val('');
		});
});
<?php echo '</script'; ?>
>
</head>

<body>
<div id="position">	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['message_manage'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['send_message'];?>
</div>
<div id="all">
<div id="main">
<div class="box">
<div id="nodes">
<form action="?action=do&type=email" method="post">
<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr bgcolor="#E5F9FF">
		<td colspan="2" background="/web/admin/static/images/wbg.gif"><font
			color="#666600" class="STYLE2"><b>发送信件：</b></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%" align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['send_message_note1'];?>
：</td>
	<!--	<td width="75%"><input type="text" name="role_id" value="" /></td>  -->
		<td><textarea rows="2" cols="60" id="role_id" name="role_id" ></textarea>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%" align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['send_message_note2'];?>
：</td>
	<!--	<td width="75%"><input type="text" name="role_name" value="" /></td>  -->
		<td><textarea rows="3" cols="60" id="role_name" name="role_name" ><?php echo $_smarty_tpl->tpl_vars['role_name']->value;?>
</textarea>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%" align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['send_message_content'];?>
：</td>
		<td><textarea rows="8" cols="60" id="content" name="content"></textarea>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%"></td>
		<td width="75%"><input type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['send_confirm'];?>
" />
		</td>
	</tr>
</table>
</form>
<!--
<form action="?action=do2&type=email" method="post">
<table width="100%" border="0" cellpadding="4" cellspacing="1"
	bgcolor="#A5D0F1">
	<tr bgcolor="#E5F9FF">
		<td colspan="2" background="/web/admin/static/images/wbg.gif"><font
			color="#666600" class="STYLE2"><b>发送信件（等级过滤）：</b></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%">最低等级：</td>
		<td width="75%"><input type="text" name="low_level" value="1" /></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%">最高等级：</td>
		<td width="75%"><input type="text" name="high_level" value="100" /></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%">信件内容：</td>
		<td><textarea rows="8" cols="60" id="content" name="content"></textarea>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%"></td>
		<td width="75%"><input type="submit" name="submit" value="确认发送" />
		</td>
	</tr>
</table>
</form>
-->

</div>
</div>
</div>
</div>
</body>
</html>
<?php }
}
