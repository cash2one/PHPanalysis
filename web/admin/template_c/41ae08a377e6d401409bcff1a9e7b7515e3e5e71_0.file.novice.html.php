<?php
/* Smarty version 3.1.29, created on 2016-08-01 15:57:13
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\loss_analysis\novice.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_579f00d9ec0329_43844234',
  'file_dependency' => 
  array (
    '41ae08a377e6d401409bcff1a9e7b7515e3e5e71' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\loss_analysis\\novice.html',
      1 => 1470038110,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_579f00d9ec0329_43844234 ($_smarty_tpl) {
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
    <hr>
    <form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
" name="myform" enctype="multipart/form-data" id="myform" method="post" target="id_iframe">
        <div>
       <span><b>角色最高流程:</b></span>
       统计时段:<input type="date" name="begin_time" /> 至 <input type="date" name="end_time"/>&nbsp;
       <span><a href="" onclick="timeSelect(this)" id="oneweek" >最近一周</a></span>&nbsp;
       <span><a href="" onclick="timeSelect(this)" id="onemonth">最近一个月</a></span>&nbsp;
       <span><a href="" onclick="timeSelect(this)" id="threemonth"/>最近三个月</a></span>&nbsp;
       <span><a href="" onclick="timeSelect(this)" id="sixmonth"/>最近六个月</a></span>

           <input type="hidden" name="begin_time_interval" id="begin_time" />
           <input type="hidden" name="end_time_interval" id="end_time" />
        </div>
    </form>
    <hr>
    <iframe id="id_iframe" name="id_iframe" style="width:100%;height:500px;">



    </iframe>
</body>
</html>
<?php }
}
