<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:43:01
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\online\now_role_list.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c855728d7_52288395',
  'file_dependency' => 
  array (
    'febb09bc8c2b3ff4bc365c8ed1132550e9e30a1a' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\online\\now_role_list.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c855728d7_52288395 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_math')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\function.math.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_list'];?>
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
</head>

<body>
	<div id="all">
		<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_register'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_list'];?>
</div>
    	<div><?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</div>
        <div id="main">
            <div class="box">
                <div id="nodes">
                	<table>
                    	<tr>
						<form method="get" action="">
                        	<?php
$_from = $_smarty_tpl->tpl_vars['pageHTML']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_page_id_0_saved_item = isset($_smarty_tpl->tpl_vars['page_id']) ? $_smarty_tpl->tpl_vars['page_id'] : false;
$__foreach_page_id_0_saved_key = isset($_smarty_tpl->tpl_vars['page_name']) ? $_smarty_tpl->tpl_vars['page_name'] : false;
$_smarty_tpl->tpl_vars['page_id'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['page_name'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['page_id']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['page_name']->value => $_smarty_tpl->tpl_vars['page_id']->value) {
$_smarty_tpl->tpl_vars['page_id']->_loop = true;
$__foreach_page_id_0_saved_local_item = $_smarty_tpl->tpl_vars['page_id'];
?>
                        	<td><a href="?pid=<?php echo $_smarty_tpl->tpl_vars['page_id']->value;?>
&role_id=<?php echo $_smarty_tpl->tpl_vars['role_id']->value;?>
&nickname=<?php echo $_smarty_tpl->tpl_vars['nickname']->value;?>
&acname=<?php echo $_smarty_tpl->tpl_vars['acname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page_name']->value;?>
</a></td>
                            <?php
$_smarty_tpl->tpl_vars['page_id'] = $__foreach_page_id_0_saved_local_item;
}
if ($__foreach_page_id_0_saved_item) {
$_smarty_tpl->tpl_vars['page_id'] = $__foreach_page_id_0_saved_item;
}
if ($__foreach_page_id_0_saved_key) {
$_smarty_tpl->tpl_vars['page_name'] = $__foreach_page_id_0_saved_key;
}
?>
							<td><?php if ($_smarty_tpl->tpl_vars['page_count']->value > 0) {
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all_page'];?>
(<?php echo $_smarty_tpl->tpl_vars['page_count']->value;?>
)<?php }?></td>
              <td>
                &nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
:<input type="text" id="role_id" name="role_id" size="10" value="<?php echo $_smarty_tpl->tpl_vars['role_id']->value;?>
" />
                &nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
：<input type='text' id="nickname" name='nickname' size='10' value='<?php echo $_smarty_tpl->tpl_vars['nickname']->value;?>
'/> 
                &nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
：<input type='text' id="acname" name='acname' size='10' value='<?php echo $_smarty_tpl->tpl_vars['acname']->value;?>
'/>
              </td>
							<td><input name="pid" type="text" class="text" size="3" maxlength="6">&nbsp;
								<input type="submit" class="button" name="Submit" value="GO">
							</td>
						</form>
          </tr>
          

          
              
                    </table>
                	<table width="100%" cellspacing="1" cellpadding="3" border="0" class='table_list'>
                        <tr>
                            <td colspan=9><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['sys_time_now'];?>
：<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %H:%M:%S");?>
</td>
                        </tr>
                    </table>
                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF">
                            <td colspan="5" background="/web/admin/static/images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_user_list_15second_per'];?>
</b></font>
                            </td>
                        </tr>
                        <tr class='table_list_head'>
                          <td width="15%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
                          <td width="15%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['current_online_time'];?>
(<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['minute'];?>
)</td>
                          <td width="20%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['login_ip'];?>
</td>
                        </tr>
                        <?php
$_from = $_smarty_tpl->tpl_vars['onlines']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_online_1_saved_item = isset($_smarty_tpl->tpl_vars['online']) ? $_smarty_tpl->tpl_vars['online'] : false;
$__foreach_online_1_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['online'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['online']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['online']->value) {
$_smarty_tpl->tpl_vars['online']->_loop = true;
$__foreach_online_1_saved_local_item = $_smarty_tpl->tpl_vars['online'];
?>
						<?php if ($_smarty_tpl->tpl_vars['key']->value%2 == 0) {?>
						<tr class='trEven'>
						<?php } else { ?>
						<tr class='trOdd'>
						<?php }?>
                          <td width="15%"><?php echo $_smarty_tpl->tpl_vars['online']->value['role_id'];?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['online']->value['role_name'];?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['online']->value['account_name'];?>
</td>
                          <td width="15%"><?php echo smarty_function_math(array('equation'=>"(now - lasttime)/60",'now'=>time(),'lasttime'=>$_smarty_tpl->tpl_vars['online']->value['last_login_time'],'format'=>"%.d"),$_smarty_tpl);?>
</td>
                          <td width="20%"><?php echo $_smarty_tpl->tpl_vars['online']->value['last_login_ip'];?>
</td>
                        </tr>
                        <?php
$_smarty_tpl->tpl_vars['online'] = $__foreach_online_1_saved_local_item;
}
if (!$_smarty_tpl->tpl_vars['online']->_loop) {
?>
                       	<tr bgcolor="#FFFFFF">
                          <td colspan="5"><font color="#FF0000"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['no_record'];?>
</font></td>
                        </tr>
                        <?php
}
if ($__foreach_online_1_saved_item) {
$_smarty_tpl->tpl_vars['online'] = $__foreach_online_1_saved_item;
}
if ($__foreach_online_1_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_online_1_saved_key;
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
