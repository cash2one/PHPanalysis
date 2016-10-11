<?php
/* Smarty version 3.1.29, created on 2016-09-28 17:57:18
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\basic_info\currency_get_expend.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eb93fe0eeda8_34805773',
  'file_dependency' => 
  array (
    'db3c114d82bc4bae00a7b0108aa1641145a53727' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\basic_info\\currency_get_expend.html',
      1 => 1475056400,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/pages.shtml' => 1,
  ),
),false)) {
function content_57eb93fe0eeda8_34805773 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>货币的获取和消耗</title>
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
    <div class="explain">
        <span>&diams;根据玩家角色名/id/账号名等条件，在一定时间段内，查询拥有的资源数量变化情况（发生时间，变更前，变更数，变更后，变化原因）</span><br>
    </div><br>
<h3>货币的获取和消耗</h3>
<hr>
<form name="condition" id="myform" action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" method="post">
    角色名：<input type="text" name="role_name" size="15" value="<?php echo $_smarty_tpl->tpl_vars['role_name']->value;?>
" />&nbsp;
    玩家ID：<input type="text" name="role_id" size="15" value="<?php echo $_smarty_tpl->tpl_vars['role_id']->value;?>
" />&nbsp;
    账号名：<input type="text" name="account_id" size="15" value="<?php echo $_smarty_tpl->tpl_vars['account_id']->value;?>
" />&nbsp;
    <input type="hidden" name="server_i" value="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
" />
        <span>
        <select name="server" id="serverlist" style="width:100px;" onchange="toajax(this.value)" >
                <option value="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
">选择服务器</option>
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
        </select> 
        </span>&nbsp;
        统计开始时间：<input type="text" name="begin_time" id="begin_time" size="10" placeholder="年/月/日" value="<?php echo $_smarty_tpl->tpl_vars['begin_time']->value;?>
" />&nbsp;
        结束时间：<input type="text" name="end_time" id="end_time" size="10" placeholder="年/月/日" value="<?php echo $_smarty_tpl->tpl_vars['end_time']->value;?>
" />&nbsp;
    <input type="submit" name="Submit" value="搜索"/>

    <hr>
    <div id="main_div">
    <table id="main_table">
        <tr style="background-color:#2e6fac; color:white;">
            <td>角色名</td>
            <td>玩家ID</td>
            <td>账号名</td>
            <td>资源类型</td>
            <td>变化原因</td>
            <td>发生时间</td>
            <td>变更前数量</td>
            <td>变更数量</td>
            <td>变更后数量</td>
            
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
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_id'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['item_type'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['action'];?>
 </td>
            <td> <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['time'],"%Y-%m-%d %H:%M:%S");?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['before_count'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['count'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_count'];?>
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
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/pages.shtml", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</form>
</div><br><br>

</body>
</html>
<?php }
}
