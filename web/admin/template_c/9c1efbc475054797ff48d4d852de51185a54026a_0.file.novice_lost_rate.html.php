<?php
/* Smarty version 3.1.29, created on 2016-08-18 20:26:26
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\novice\novice_lost_rate.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57b5a97259ed48_57926404',
  'file_dependency' => 
  array (
    '9c1efbc475054797ff48d4d852de51185a54026a' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\novice\\novice_lost_rate.html',
      1 => 1470729286,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57b5a97259ed48_57926404 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>新手引导流失率</title>
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
        <span>&diams;单服：新手流程流失率：每个新手流程流失玩家数量/该服流失玩家总数量*100%</span><br>
        <span>&diams;全服：新手流程流失率：每个新手流程流失玩家数量/全服流失玩家总数量*100%</span><br>

    </div><br>
    <hr>
    <form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" name="myform" id="myform" method="post">
        <span><b>新手流程流失率</b></span>&nbsp;&nbsp;
        <span>
            <select name="server" style="width:100px;">
                <option value="all">所有服</option>
                <option value="2002">2002服</option>
                <option value="2003">2003服</option>
                <option value="2007">2007服</option>
                <option value="3001">3001服</option>
            </select>
        </span>
        <span><input type="submit" name="search" /></span>&nbsp;&nbsp;&nbsp;&nbsp;
        <span>服务器：<input type="text" name="sertxt"  readonly style="width:100px;" value="<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
" /></span>&nbsp;
        <span>新手引导流程流失总数：<input type="text" name="flowtxt"  readonly style="width:100px;" value="<?php echo $_smarty_tpl->tpl_vars['flow_num']->value;?>
" /></span>&nbsp;
        <span>该服流失总数：<input type="text" name="numtxt"  readonly style="width:100px;" value="<?php echo $_smarty_tpl->tpl_vars['server_num']->value;?>
" /></span>&nbsp;
        <span>所有服流失总数：<input type="text" name="allnumtxt"  readonly style="width:100px;" value="<?php echo $_smarty_tpl->tpl_vars['all_server_num']->value;?>
" /></span>&nbsp;
         
        <!--<span>统计开始时间:<input type="date" name="begin_time" id="begin_time" />&nbsp;至&nbsp;<input type="date" name="end_time" id="end_time" /></span>
        <span><input type="submit" name="tosubmit" value="搜索"/></span>&nbsp;
        <span><a href="" id="oneweek" onclick="timeSelect(this)" >最近一周</a></span>&nbsp;
        <span><a href="" id="onemonth" onclick="timeSelect(this)">最近1个月</a></span>&nbsp;
        <span><a href="" id="threemonth" onclick="timeSelect(this)">最近3个月</a></span>&nbsp;
        <span><a href="" id="sixmonth" onclick="timeSelect(this)">最近6个月</a></span>-->
    <hr>

        <table id="main_table">
        <tr style="background-color:#2e6fac; color:white;">
            <td>流失流程ID</td>
            <td>该流程流失总数</td>
            <td>该流程流失率</td>
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
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['id'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['num'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['rate'];?>
 %</td>
           </tr>
        <?php
}
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
        </table>
    <br>
</form>
   

</body>
</html>
<?php }
}
