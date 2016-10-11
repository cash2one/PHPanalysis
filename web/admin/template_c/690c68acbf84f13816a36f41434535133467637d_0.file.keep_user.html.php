<?php
/* Smarty version 3.1.29, created on 2016-09-28 17:03:04
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\keep_active\keep_user.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eb8748beffc7_64608807',
  'file_dependency' => 
  array (
    '690c68acbf84f13816a36f41434535133467637d' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\keep_active\\keep_user.html',
      1 => 1474271882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/pages.shtml' => 1,
  ),
),false)) {
function content_57eb8748beffc7_64608807 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>新增/活跃</title>
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
          text: '留存用户折线图'   
       };
       var subtitle = {
          text: 'X:日期,Y:用户留存率 %'
       };
       var xAxis = {
          title: {
            text: '日期'  
          },
          categories: <?php echo $_smarty_tpl->tpl_vars['date_m_d']->value;?>

       };
       var yAxis = {
          title: {
             text: '用户留存率 %'
          },
          plotLines: [{
             value: 0,
             width: 1,
             color: '#808080'
          }]
       };   

       var tooltip = {
          valueSuffix: '%'
       }

       var legend = {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle',
          borderWidth: 0
       };

       var series =  [
          {
            name: '留存率',
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
        <span>&diams;注册日期+留存天数的日期用户有登录则+1</span><br>
        <span>&diams;折线图仅反映统计开始日期当天的新增用户数往后的留存数据</span><br>
        <span>&diams;统计开始日期(不包含当天)+1天快捷键 则表示统计开始日期当天新增的用户数在第二天的留存数据</span><br>
        <span>&diams;统计开始日期(不包含当天)+2天快捷键 则表示统计开始日期当天新增的用户数在第二天和第三天2天的留存数据，3-7天，14天和30天以此类推</span><br>
    </div><br>
    <hr>
    <form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" name="myform" id="myform" method="post">
        <span><b>留存用户</b></span>&nbsp;&nbsp;
        <span>
        <input type="hidden" name="tag" value="tag" />
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
        统计开始时间：<span><input type="text" name="begin_time" id="begin_time" size="10" placeholder="年/月/日" value="<?php echo $_smarty_tpl->tpl_vars['begin_time']->value;?>
" /></span>&nbsp;
        结束时间：<span id="end_time_span"><input type="text" name="end_time" id="end_time" size="10" placeholder="年/月/日" value="<?php echo $_smarty_tpl->tpl_vars['end_time']->value;?>
" /></span>&nbsp;
        <input type="submit" name="search" value="搜索"/>&nbsp;
        <input type="button" name="oneday" id="86400" value="1天" onclick="thedays(this.id)" />
        <input type="button" name="twoday" id="172800" value="2天" onclick="thedays(this.id)"/>
        <input type="button" name="threeday" id="259200" value="3天" onclick="thedays(this.id)"/>
        <input type="button" name="fourday" id="345600" value="4天" onclick="thedays(this.id)"/>
        <input type="button" name="fineday" id="432000" value="5天" onclick="thedays(this.id)"/>
        <input type="button" name="sixday" id="518400" value="6天" onclick="thedays(this.id)"/>
        <input type="button" name="sevenday" id="604800" value="7天" onclick="thedays(this.id)"/>
        <input type="button" name="fourteenthday" id="1209600" value="14天" onclick="thedays(this.id)"/>
        <input type="button" name="thirty" id="2592000" value="30天" onclick="thedays(this.id)"/>
      <hr>
      <div id="container" style="width: 100%; height: 500px; margin: 0 auto"></div>  
       <!-- <table id="main_table">
        <tr style="background-color:#2e6fac; color:white;">
            <td>日期</td>
            <td>活跃用户数</td>
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
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['active_user_num'];?>
 </td>
            <td> <?php echo $_smarty_tpl->tpl_vars['dataList']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['new_user_num'];?>
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
