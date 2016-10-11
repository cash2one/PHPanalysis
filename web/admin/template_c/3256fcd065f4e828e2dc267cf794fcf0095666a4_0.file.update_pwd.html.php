<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:44:32
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\system\update_pwd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65ce0630464_17848531',
  'file_dependency' => 
  array (
    '3256fcd065f4e828e2dc267cf794fcf0095666a4' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\system\\update_pwd.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65ce0630464_17848531 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['change_login_password'];?>
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
 type="text/javascript">
<?php echo '</script'; ?>
>

<body>
	<div id="all">
	<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['sys_manage'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['change_login_password'];?>
</div>
                	<form  name=form action="" method="post">
					<input type='hidden' name='dopost' value='update'>
                	<table width="800"  border="0" cellpadding="4" cellspacing="1" bgcolor="#FFFFFF">
                	   <tr bgcolor="#D2E9FF">
                	      <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['change_password'];?>
</td>
                	   </tr>
                       <tr bgcolor="#E0EEEE">
                           <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['old_password'];?>
</td>
                           <td><input type="password" name="password" value="" /></td>
                       </tr>
                       <tr bgcolor="#E0EEEE">
                           <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['new_password'];?>
</td>
                           <td><input type="password" name="pwd" value="" /></td>
                       </tr>
                       <tr bgcolor="#E0EEEE">
                           <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['input_password_againt'];?>
</td>
                           <td><input type="password" name="pwd1" value="" /></td>
                       </tr>
                       <tr bgcolor="#D2E9FF">
						   <td></td>
                           <td colspan="2"><div align="left">&nbsp;&nbsp;<input type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['save'];?>
" />
                                            &nbsp;&nbsp;<input type="reset" name="reset" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['modify'];?>
" /></div></td>
						</tr>

                     </table>

                     </form>
                </div>
            </div>
</body>
</html><?php }
}
