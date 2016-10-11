<?php
/* Smarty version 3.1.29, created on 2016-09-28 17:51:02
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\basic_info\role_info.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eb928680fb71_37172228',
  'file_dependency' => 
  array (
    '4706a4a70d157b4573156711b1b42d60d862167f' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\basic_info\\role_info.html',
      1 => 1473320039,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eb928680fb71_37172228 ($_smarty_tpl) {
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>角色信息</title>
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
          text: '不同角色等级的角色总数'   
       };
       var subtitle = {
          text: 'X:角色等级,Y:角色总数'
       };
       var xAxis = {
          title: {
            text: '角色等级'  
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
        <span>&diams;角色等级分布：汇总当前每个等级的角色总数</span><br>
    </div><br>
<hr>
 <form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" name="myform" id="myform" method="post">
        <span><b>角色信息折线图</b></span>&nbsp;&nbsp;
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
        <span><input type="submit" name="search" value="搜索" /></span>&nbsp;&nbsp;&nbsp;&nbsp;
        <hr>
         <div id="container" style="width: 100%; height: 500px; margin: 0 auto"></div>  
         <br>
    <hr>
 </form>

</body>
</html>



<?php }
}
