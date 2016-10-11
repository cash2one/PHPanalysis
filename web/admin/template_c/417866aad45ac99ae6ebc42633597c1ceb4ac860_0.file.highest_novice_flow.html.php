<?php
/* Smarty version 3.1.29, created on 2016-08-01 16:23:16
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\novice\highest_novice_flow.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_579f06f4d83460_07841543',
  'file_dependency' => 
  array (
    '417866aad45ac99ae6ebc42633597c1ceb4ac860' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\novice\\highest_novice_flow.html',
      1 => 1469869086,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/pages.shtml' => 1,
  ),
),false)) {
function content_579f06f4d83460_07841543 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        <span>&diams;角色最高流程：角色挑战过的最高流程(无论是否通过)，未进入流程为0</span><br>
        <span>&diams;新增角色最高流程：新增角色当天挑战过的最高流程(无论是否通过)，未进入流程为0</span><br>
        <span>&diams;角色流失流程：角色当天停留在该流程，且次日不再登录，则记为该流程的流失数。未进入流程为0</span><br>
        <span>&diams;新增角色流失流程：新增角色当天停留在该流程，且次日不再登录，则记为该流程的流失数。未进入流程为0</span><br>
    </div><br>

    <div style='float: left;'><h3>角色最高流程</h3></div>
    <form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" name="myform" id="myform" method="post">
    <div>
        <span>统计开始时间:</span><input type="date" name="begin_time" id="begin_time" />
        <span>结束时间:</span><input type="date" name="end_time" id="end_time" />
        <input type="submit" name="submit" value="搜索"/>
    </div>
    <hr>




    <div id=con>
      <ul id=tags>
        <li><a onClick="timeSelect('tagContent',this)" id="oneweek" href="javascript:void(0)">最近一周</a> </li>
        <li><a onClick="timeSelect('tagContent',this)" id="onemonth" href="javascript:void(0)">最近一个月</a> </li>
        <li><a onClick="timeSelect('tagContent',this)" id="threemonth" href="javascript:void(0)">最近三个月</a> </li>
        <li><a onClick="timeSelect('tagContent',this)" id="sixmonth" href="javascript:void(0)">最近六个月</a> </li>
      </ul>
      <div id=tagContent>
        <div class="tagContent selectTag" id=tagContent>
        <table id="main_table">
        <tr style="background-color:#2e6fac; color:white;">
            <td>玩家ID</td>
            <td>角色名</td>
            <td>挑战过最高流程ID</td>
            <td>挑战过该流程的角色总数</td>
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
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['mac_addr'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_id'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_level'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_vip'];?>
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

        </div>
      </div>
    </div><br>

    </form>

</body>
</html>
<?php }
}
