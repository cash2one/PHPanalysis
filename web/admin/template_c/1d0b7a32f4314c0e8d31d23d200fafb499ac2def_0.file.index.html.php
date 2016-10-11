<?php
/* Smarty version 3.1.29, created on 2016-09-29 09:27:10
  from "E:\phpStudy\WWW\sanguo\web\admin\template\default\index.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57ec6dee6106f1_71477431',
  'file_dependency' => 
  array (
    '1d0b7a32f4314c0e8d31d23d200fafb499ac2def' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\sanguo\\web\\admin\\template\\default\\index.html',
      1 => 1468910702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ec6dee6106f1_71477431 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo '<script'; ?>
 type="text/javascript" src="../admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['back_sys_name'];?>
</title>
<style type="text/css">
body {
scrollbar-base-color:#C0D586;
scrollbar-arrow-color:#FFFFFF;
scrollbar-shadow-color:DEEFC6
}
</style>
<?php echo '<script'; ?>
 type="text/javascript">
    $('#switchlang').change(function(){
        window.location.reload();
    });
<?php echo '</script'; ?>
>
</head>

<frameset rows="50,*"  frameborder="no" cols="*" border="0" framespacing="0">
    <frame noresize="noresize" id="top_frame" src="/web/admin/top.php" scrolling="no"></frame>
    <frameset cols="175, *" rows="*"  frameborder="no" border="0" framespacing="0">
        <frame noresize="noresize" id="left_frame" name="left_frame" src="/web/admin/left.php" scrolling="yes"></frame>
        <frame name="main_frame" name="main_frame" id="main_frameID" src="/web/admin/module/pay/server_profile.php" scrolling="yes"></frame>
    <noframes>
        <body>你的浏览器不支持框架！</body>
    </noframes>

<frame src="UntitledFrame-2"></frameset>
</html>
<?php }
}
