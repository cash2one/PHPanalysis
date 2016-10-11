<?php
/* Smarty version 3.1.29, created on 2016-09-28 17:55:20
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\basic_info\info_log.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eb9388686069_50209312',
  'file_dependency' => 
  array (
    'fb283de52ae98a0da6a9c4bda65ed02e7b60495b' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\basic_info\\info_log.html',
      1 => 1472542752,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eb9388686069_50209312 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>信息日志</title>
<link rel="stylesheet" href="/web/admin/static/css/tags.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/js/date/daterangepicker.css" />
<?php echo '<script'; ?>
 src="/web/admin/static/js/date/jquery-1.11.2.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/web/admin/static/js/date/moment.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/web/admin/static/js/date/jquery.daterangepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/web/admin/static/js/databackend.js"><?php echo '</script'; ?>
>

</head>
<body>

<h3>信息日志</h3>
<hr>
<form name="condition" id="myform" action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" method="post">
    <input type="hidden" name="action" value="select_role_base" /> 
   玩家ID：<input type="text" name="role_id" size="15" />&nbsp;
   账号：<input type="text" name="account_id" size="15"  />&nbsp;
   角色名：<input type="text" name="role_name" size="15"  />&nbsp;
   服务器：<select name="server" style="width:100px;">
                <option value="">选择服务器</option>
            <?php
$__section_server_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_server']) ? $_smarty_tpl->tpl_vars['__smarty_section_server'] : false;
$__section_server_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['serverlist']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_server_0_total = $__section_server_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_server'] = new Smarty_Variable(array());
if ($__section_server_0_total != 0) {
for ($__section_server_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_server']->value['index'] = 0; $__section_server_0_iteration <= $__section_server_0_total; $__section_server_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_server']->value['index']++){
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['serverlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_server']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_server']->value['index'] : null)]['svr_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['serverlist']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_server']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_server']->value['index'] : null)]['name'];?>
</option>
            <?php
}
}
if ($__section_server_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_server'] = $__section_server_0_saved;
}
?>
            </select> &nbsp;
    <input type="submit" name="search" value="搜索"/>&nbsp;
    </form>
    <hr>
    <div id="main_div">
    <table id="main_table">
        <tr style="background-color:#2e6fac; color:white;">
            <td>玩家ID</td>
            <td>玩家账号</td>
            <td>角色名</td>
            <td>角色等级</td>
            <td>VIP等级</td>
            <td>钻石数量</td>
            <td>金币数量</td>
            <td>角色注册时间</td>
            <td>最近登录时间</td>
            <td>最后退出时间</td>
        </tr>
        <?php
$__section_loop_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['dataList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_1_total = $__section_loop_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_1_total != 0) {
for ($__section_loop_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_1_iteration <= $__section_loop_1_total; $__section_loop_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_1_iteration;
?>
            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
            <tr class='trEven'>
            <?php } else { ?>
                <tr class='trOdd'>
            <?php }?>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['id'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['aid'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['nick'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['vip_level'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['ingot'];?>
</td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['coin'];?>
</td>
            <td> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['reg_time'],"%Y-%m-%d %H:%M:%S");?>
 </td>
            <td> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_time'],"%Y-%m-%d %H:%M:%S");?>
 </td>
            <td> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['logout_time'],"%Y-%m-%d %H:%M:%S");?>
 </td>
           </tr>
        <?php
}
}
if ($__section_loop_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_1_saved;
}
?>
    </table>

</div><br>

</body>
</html>



<?php }
}
