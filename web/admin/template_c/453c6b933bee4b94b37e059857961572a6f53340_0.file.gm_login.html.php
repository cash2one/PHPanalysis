<?php
/* Smarty version 3.1.29, created on 2016-08-04 18:38:53
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\gm\gm_login.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57a31b3d75b063_44599173',
  'file_dependency' => 
  array (
    '453c6b933bee4b94b37e059857961572a6f53340' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\gm\\gm_login.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57a31b3d75b063_44599173 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_login_usercount'];?>
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
<?php echo '</script'; ?>
>
</head>

<body>
<div id="all">
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_manage'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_login_usercount'];?>
</div>
<form action="?action=do" method="post">
<table width="600" border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr bgcolor="#E5F9FF">
		<td colspan="2" background="/web/admin/static/images/wbg.gif"><font
			color="#666600" class="STYLE2"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_login'];?>
：</b></font></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_to_user_name'];?>
：</td>
		<td width="75%"><input type="text" name="username" value="" /></td>
	</tr>
    <tr bgcolor="#FFFFFF">
        <td width="25%">serverId：</td>
        <td width="75%"><input type="text" name="serverId" value="" /></td>
    </tr>
	<tr bgcolor="#FFFFFF">
		<td width="25%"></td>
		<td width="75%"><input type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['login'];?>
" />
		</td>
	</tr>
</table>
</form>
</div>
</body>
</html>
<?php }
}
