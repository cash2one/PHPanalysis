<?php
/* Smarty version 3.1.29, created on 2016-09-29 09:27:11
  from "E:\phpStudy\WWW\sanguo\web\admin\template\default\error.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57ec6defc4a803_83019836',
  'file_dependency' => 
  array (
    '3c195d88ef1c870754781bf9d42b169442caac56' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\sanguo\\web\\admin\\template\\default\\error.html',
      1 => 1468910702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ec6defc4a803_83019836 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['back_sys_name'];?>
</title>
<style type="text/css">
body {font-size:14px; font-family:"Courier New", Courier, monospace; text-align:center; margin:auto;}
#all {text-align:left;margin-left:4px;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}

</style>
<?php echo '<script'; ?>
 type="text/javascript" src="../admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
</head>

<body>
	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr bgcolor="#E5F9FF">
        	<td colspan="2" background="../admin/static/images/wbg.gif"><font color="#666600" class="STYLE2"><b>◆出错提示</b></font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="100%"><a href="javascript:window.history.go(-1);"><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
 | 点击返回上一页</a></td>
        </tr>
      </table>
</body>
</html>
<?php }
}
