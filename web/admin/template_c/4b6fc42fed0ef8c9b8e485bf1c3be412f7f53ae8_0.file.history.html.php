<?php
/* Smarty version 3.1.29, created on 2016-09-12 15:42:45
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\online\history.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d65c758211b7_10406532',
  'file_dependency' => 
  array (
    '4b6fc42fed0ef8c9b8e485bf1c3be412f7f53ae8' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\online\\history.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d65c758211b7_10406532 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['history_online'];?>
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
 type="text/javascript">
<?php echo '</script'; ?>
>
</head>

<body>
	<div id="all">	
		<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_register'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['history_online'];?>
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
&dateStart=<?php echo $_smarty_tpl->tpl_vars['time_start']->value;?>
&hour=<?php echo $_smarty_tpl->tpl_vars['hour']->value;?>
&min=<?php echo $_smarty_tpl->tpl_vars['min']->value;?>
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
                  <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['start_time'];?>
：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateStart' name='dateStart' size='12' 
                      value='<?php echo $_smarty_tpl->tpl_vars['time_start']->value;?>
'/>
                  <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['hour'];?>
<input type='text' id="nickname" name='hour' size='10' value='<?php echo $_smarty_tpl->tpl_vars['hour']->value;?>
'/> 
                  <?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['minute'];?>
<input type='text' id="nickname" name='min' size='10' value='<?php echo $_smarty_tpl->tpl_vars['min']->value;?>
'/>    
              </td>
							<td><input name="pid" type="text" class="text" size="3" maxlength="6">&nbsp;<input type="submit" class="button" name="Submit" value="GO"></td>
						</form>
                        </tr>
                    </table>
                	<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
                        <tr>	
                            <td colspan=9><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['sys_time_now'];?>
：<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d %H:%M:%S");?>
</td>
                        </tr>
                    </table>
                	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
                        <tr bgcolor="#E5F9FF"> 
                            <td colspan="4" background="/web/admin/static/images/wbg.gif">
                            	<font color="#666600" class="STYLE2"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['today_online_Statistics_30second_per'];?>
</b></font>
                            </td>
                        </tr>
                        <tr class='table_list_head'> 
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['statistical_time'];?>
</td>
                          <td width="25%"><label style="color:red; font-weight:bold;"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['current'];?>
</label><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_num'];?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['ip_count'];?>
</td>
                          <td width="50%"></td>
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
                          <td width="25%"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['online']->value['dateline'],"%Y-%m-%d %H:%M:%S");?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['online']->value['online'];?>
</td>
                          <td width="25%"><?php echo $_smarty_tpl->tpl_vars['online']->value['distinct_ip'];?>
</td>
                          <td width="50%" align="left"><img src="/web/admin/static/images/green.gif" height="5" width="<?php echo $_smarty_tpl->tpl_vars['online']->value['weight'];?>
" /></td>
                        </tr>
                        <?php
$_smarty_tpl->tpl_vars['online'] = $__foreach_online_1_saved_local_item;
}
if (!$_smarty_tpl->tpl_vars['online']->_loop) {
?>
                       	<tr bgcolor="#FFFFFF"> 
                          <td colspan="3"><font color="#FF0000"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['no_record'];?>
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
