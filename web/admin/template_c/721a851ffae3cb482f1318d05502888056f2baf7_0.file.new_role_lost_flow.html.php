<?php
/* Smarty version 3.1.29, created on 2016-08-27 10:00:13
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\novice\new_role_lost_flow.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57c0f42d5ce1e7_60728987',
  'file_dependency' => 
  array (
    '721a851ffae3cb482f1318d05502888056f2baf7' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\novice\\new_role_lost_flow.html',
      1 => 1471523420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/pages.shtml' => 1,
  ),
),false)) {
function content_57c0f42d5ce1e7_60728987 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>新手引导</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <span>&diams;新增角色当天停留在该流程，且次日不再登录，则记为该流程的流失数。未进入流程为0。</span><br>
    </div><br>
    <hr>
    <form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" name="myform" id="myform" method="post">
        <span><b>新增角色流失流程</b></span>
    服务器：<select name="server" style="width:100px;">
        <?php if ($_smarty_tpl->tpl_vars['server_show']->value <> '2002') {?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['server_show']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['server_show']->value;?>
</option>  
        <?php }?>  
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2007">2007</option>
                <option value="3001">3001</option>
            </select> &nbsp;
        统计开始时间：<input type="text" name="begin_time" id="begin_time" size="10" placeholder="年/月/日" value="<?php echo $_smarty_tpl->tpl_vars['begin_time']->value;?>
" />&nbsp;
        结束时间：<input type="text" name="end_time" id="end_time" size="10" placeholder="年/月/日" value="<?php echo $_smarty_tpl->tpl_vars['end_time']->value;?>
" />&nbsp;
        <input type="submit" name="tosubmit" value="搜索"/>&nbsp;
       <!-- <span><a href="" id="oneweek" onclick="timeSelect(this)" >最近一周</a></span>&nbsp;
        <span><a href="" id="onemonth" onclick="timeSelect(this)">最近1个月</a></span>&nbsp;
        <span><a href="" id="threemonth" onclick="timeSelect(this)">最近3个月</a></span>&nbsp;
        <span><a href="" id="sixmonth" onclick="timeSelect(this)">最近6个月</a></span>-->

        <span>该服角色总数：<input type="text" name="numtxt"  readonly style="width:70px;border:0px;" value="<?php echo $_smarty_tpl->tpl_vars['server_role_num']->value;?>
" /></span>&nbsp;
    <hr>

        <table id="main_table">
        <tr style="background-color:#2e6fac; color:white;">
            <td>玩家ID</td>
            <td>角色名</td>
            <td>挑战过最高流程ID</td>
        </tr>
        <?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['dataList']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
            <tr class='trEven'>
            <?php } else { ?>
                <tr class='trOdd'>
            <?php }?>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['uid'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['nick'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['condition_guide_ids'];?>
 </td>
           </tr>
        <?php
}
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
        </table>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/pages.shtml", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</form>
   

</body>
</html>
<?php }
}
