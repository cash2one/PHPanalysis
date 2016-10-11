<?php
/* Smarty version 3.1.29, created on 2016-08-27 10:00:14
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\novice\role_lost_flow.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57c0f42e44f630_95920197',
  'file_dependency' => 
  array (
    'cc526529c0c584f97f09cae8c3ae6779b4f361b4' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\novice\\role_lost_flow.html',
      1 => 1470993751,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/pages.shtml' => 1,
  ),
),false)) {
function content_57c0f42e44f630_95920197 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>新手引导</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/web/admin/static/css/tags.css" type="text/css">
    <?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery-3.0.0.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/web/admin/static/js/highcharts/highcharts.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/web/admin/static/js/highcharts/modules/exporting.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/web/admin/static/js/databackend.js"><?php echo '</script'; ?>
>
</head>
<body>
    <div class="explain">
        <span>&diams;角色当天停留在该流程，且次日不再登录，则记为该流程的流失数。未进入流程为0。</span><br>
    </div><br>
    <hr>
    <form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" name="myform" id="myform" method="post">
        <span><b>角色流失流程</b></span>
         <span>
            <select  name="server" style="width:100px;">
                <option value="">选择服务器</option>
                <option value="2002">2002服</option>
                <option value="2003">2003服</option>
                <option value="2007">2007服</option>
                <option value="3001">3001服</option>
            </select>
        </span>
        <!--<span>统计开始时间:<input type="date" name="begin_time" id="begin_time" />&nbsp;至&nbsp;<input type="date" name="end_time" id="end_time" /></span>-->
        <span><input type="submit" name="tosubmit" value="搜索"/></span>&nbsp;
       <!-- <span><a href="" id="oneweek" onclick="timeSelect(this)" >最近一周</a></span>&nbsp;
        <span><a href="" id="onemonth" onclick="timeSelect(this)">最近1个月</a></span>&nbsp;
        <span><a href="" id="threemonth" onclick="timeSelect(this)">最近3个月</a></span>&nbsp;
        <span><a href="" id="sixmonth" onclick="timeSelect(this)">最近6个月</a></span>-->
        <span>服务器：<input type="text" name="servertxt"  readonly style="width:80px;border:0px;" value="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
" /></span>&nbsp;
        <span>该服角色总数：<input type="text" name="numtxt"  readonly style="width:70px;border:0px;" value="<?php echo $_smarty_tpl->tpl_vars['server_role_num']->value;?>
" /></span>&nbsp;
        <span>统计时段：<input type="text" name="starttime" readonly style="width:100px;border:0px;" value="<?php echo $_smarty_tpl->tpl_vars['begin_time']->value;?>
"/>-<input type="text" name="endtime" readonly style="width:100px;border:0px;" value="<?php echo $_smarty_tpl->tpl_vars['end_time']->value;?>
"/></span>
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
