<?php
/* Smarty version 3.1.29, created on 2016-09-19 16:03:59
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\level_lost\new_role_lost_level.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57df9befdf63e8_98599210',
  'file_dependency' => 
  array (
    '04219907354bd95b676b77747c19772f2ea48be6' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\level_lost\\new_role_lost_level.html',
      1 => 1473645119,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57df9befdf63e8_98599210 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>等级流失</title>
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
          text: '新增角色流失等级折线图'   
       };
       var subtitle = {
          text: 'X:角色等级,Y:流失角色总数'
       };
       var xAxis = {
          title: {
            text: '流失角色等级'  
          },
           tickInterval: 1
       };
       var yAxis = {
          title: {
             text: '角色总数'
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
            name: '<?php echo $_smarty_tpl->tpl_vars['server']->value;?>
',
            data: <?php echo $_smarty_tpl->tpl_vars['json_data']->value;?>

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
        <span>&diams;新增角色流失等级：新增角色当天停留在该关卡，且次日不再登录，则记为该等级的流失数</span><br>
    </div><br>
    <hr>
    <form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" name="myform" id="myform" method="post">
    <span><b>新增角色流失等级折线图</b></span>&nbsp;&nbsp;
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
        <input type="submit" name="tosubmit" value="搜索"/>&nbsp;
    <hr>
     <div id="container" style="width: 100%; height: 500px; margin: 0 auto"></div>  
     <br>
        <span><b>角色流失等级</b></span>

    <hr>
        <table id="main_table">
        <tr style="background-color:#2e6fac; color:white;">
            <td>流失等级</td>
            <td>角色数</td>
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
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['num'];?>
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
</form><br>


</body>
</html>
<?php }
}
