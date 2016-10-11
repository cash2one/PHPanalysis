<?php
/* Smarty version 3.1.29, created on 2016-09-28 21:02:06
  from "E:\phpStudy\WWW\sanguo\web\admin\template\default\module\keep_active\user_freshness.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57ebbf4e94cb58_91808098',
  'file_dependency' => 
  array (
    '6c740b53e3414b96327ba0705610af2eab10f9c6' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\sanguo\\web\\admin\\template\\default\\module\\keep_active\\user_freshness.html',
      1 => 1474967514,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/pages.shtml' => 1,
  ),
),false)) {
function content_57ebbf4e94cb58_91808098 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>用户新鲜度</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/web/admin/static/css/tags.css" type="text/css">
    <link rel="stylesheet" href="/web/admin/static/js/date/daterangepicker.css" />
    <?php echo '<script'; ?>
 src="/web/admin/static/js/jquery-3.0.0.min.js"><?php echo '</script'; ?>
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
    <?php echo '<script'; ?>
 src="/web/admin/static/js/highcharts/highcharts.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/web/admin/static/js/highcharts/modules/exporting.js"><?php echo '</script'; ?>
>
     <?php echo '<script'; ?>
 language="JavaScript">
    $(document).ready(function() {
       var title = {
          text: '用户进入游戏的时间分布'   
       };
       var subtitle = {
          text: 'X:时间,Y:进入游戏的用户数'
       };
       var xAxis = {
          title: {
            text: '时间'  
          },
          categories: <?php echo $_smarty_tpl->tpl_vars['H_i_s']->value;?>

       };
       var yAxis = {
          title: {
             text: '进入游戏的用户数'
          },
          plotLines: [{
             value: 0,
             width: 1,
             color: '#808080'
          }]
       };   

       var tooltip = {
          valueSuffix: '个'
       }

       var legend = {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle',
          borderWidth: 0
       };

       var series =  [
          {
            name: '进入游戏用户数',
            data: <?php echo $_smarty_tpl->tpl_vars['json_new_data']->value;?>

          }
       ];

       var json = {};

       json.title = title;
       json.subtitle = subtitle;
       json.xAxis = xAxis;
       json.yAxis = yAxis;
       json.tooltip = tooltip;
       json.legend = legend;
       json.series = series;

       $('#container').highcharts(json);
    });

<?php echo '</script'; ?>
>
</head>
<?php echo '<script'; ?>
>
function toajax(str)
{
    var xmlhttp;
    if (str.length==0)
   { 
      document.getElementById("channelslist").innerHTML="";
      return;
   }
    if (window.XMLHttpRequest)
   {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
   }
    else
   {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
    xmlhttp.onreadystatechange=function()
   {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById("channelslist").innerHTML=xmlhttp.responseText;
        }
   }
    xmlhttp.open("GET","./ajax.php?svr_id="+str,true);
    xmlhttp.send();
 }
<?php echo '</script'; ?>
>
<body>
    <div class="explain">
        <span>&diams;用户新鲜度：用户进入游戏的时间分布</span><br>
        <span>&diams;统计算法例子：每小时0-29分钟登录的用户总数汇总到对应小时初（比如13:00）；30-59分钟登录的用户总数汇总到当小时半（比如13:30）</span><br>
        <span><b>&diams;注意：</b>统计时间选择同一天则统计当天用户进入游戏的时间分布，若选择的不是同一天，则按照统计开始时间当天一天的时间进行统计</span><br>
    </div><br>
    <hr>
    <form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" name="myform" id="myform" method="post">
        <span><b>用户进入游戏的时间分布</b></span>&nbsp;&nbsp;
        <span>
        <select name="server" id="serverlist" style="width:100px;" onchange="toajax(this.value)" >
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
        </select> 
        </span>
        <span id="channelslist">

        </span>&nbsp;
        统计开始时间：<input type="text" name="begin_time" id="begin_time" size="10" placeholder="年/月/日" value="<?php echo $_smarty_tpl->tpl_vars['begin_time']->value;?>
" />&nbsp;
        结束时间：<input type="text" name="end_time" id="end_time" size="10" placeholder="年/月/日" value="<?php echo $_smarty_tpl->tpl_vars['end_time']->value;?>
" />&nbsp;
        <input type="submit" name="search" value="搜索"/>&nbsp;
      <hr>
      <div id="container" style="width: 100%; height: 500px; margin: 0 auto"></div>  
      <!--<hr>
      <span>统计时段:<?php echo $_smarty_tpl->tpl_vars['begin_time']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['end_time']->value;?>
(选中的时间中没有出现在表格中的则表示当天新增用户数为0)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新增用户总数：<?php echo $_smarty_tpl->tpl_vars['server_role_num']->value;?>
</span><br><br>
     <table id="main_table">
        <tr style="background-color:#2e6fac; color:white;">
            <td>日期</td>
            <td>新增用户数</td>
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
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['data_time'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['user_num'];?>
 </td>
           </tr>
        <?php
}
}
if ($__section_loop_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_1_saved;
}
?>
        </table><br>-->
        <!--  <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/pages.shtml", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  -->

</form>
   

</body>
</html>
<?php }
}
