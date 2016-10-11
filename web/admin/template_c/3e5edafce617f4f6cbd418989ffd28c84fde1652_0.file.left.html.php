<?php
/* Smarty version 3.1.29, created on 2016-09-29 09:27:10
  from "E:\phpStudy\WWW\sanguo\web\admin\template\default\left.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57ec6deeb15aa5_34919929',
  'file_dependency' => 
  array (
    '3e5edafce617f4f6cbd418989ffd28c84fde1652' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\sanguo\\web\\admin\\template\\default\\left.html',
      1 => 1474190072,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ec6deeb15aa5_34919929 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['back_sys_name'];?>
</title>
<link rel="stylesheet" href="../admin/static/css/base.css" type="text/css">
<style type="text/css">
body { margin:3px; padding:0px; font-size:12px; font-family:"Courier New", Courier, monospace; background:#86C1FF; margin:3 0 0 0;}
.tdborder {
	border-left: 1px solid #43938B;
	border-right: 1px solid #43938B;
	border-bottom: 1px solid #43938B;
}
.tdrl {
	border-left: 1px solid #788C47;
	border-right: 1px solid #788C47;
}
.topitem {
	cursor: hand;
	background-image:url(../admin/static/images/mtbg1.gif);
	height:24px;
	width:98%;
	border-right: 1px solid #2FA1DB;
	border-left: 1px solid #2FA1DB;
	clear:left
}
.itemsct {
	border-right: 1px solid #2FA1DB;
	border-left: 1px solid #2FA1DB;
	background-color:#EEFAFE;
	margin-bottom:6px;
	width:98%;
}
.itemem {
	text-align:left;
	clear:left;
	border-bottom: 1px solid #2FA1DB;
	height:21px;
}
.tdl {
	float:left;
	margin-top:2px;
	margin-left:6px;
	margin-right:5px
}
.tdr {
	float:left;
	margin-top:2px
}
.topl {
	float:left;

	margin-right:3px;
}
.topr {
	padding-top:4px;
	cursor:pointer;
}
.toprt {
	text-align:center;
	padding-top:3px
}
body {
	scrollbar-base-color:#8CC1FE;
	scrollbar-arrow-color:#FFFFFF;
	scrollbar-shadow-color:#6994C2
}
.green{
	background-color:#CCFFCC;
}


</style>
<?php echo '<script'; ?>
 type="text/javascript" src="../admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
showHide = function(objID) {
	$('#' + objID).toggle();//切换元素的可见状态
}
$(document).ready(function(){
	$(".itemem").click(function(){
		$(".itemem").removeClass("green");
		$(this).addClass("green");
	});
});

<?php echo '</script'; ?>
>
</head>

<body>
	<div id="all">
    	<div class='topitem' align='left'>
    		<div class='topl'></div>
    		<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['back_sys_name'];?>
</div>
  	</div>
         
            
        <!--  原本的目录  -->
        <!--
    	<div onClick='showHide("items1")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['server_info'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items1' class='itemsct'>
		<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "SERVER_INFO") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
     	</div>


        <div onClick='showHide("items2")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['online_register'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items2' class='itemsct'>
		<?php
$__section_loop_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_1_total = $__section_loop_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_1_total != 0) {
for ($__section_loop_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_1_iteration <= $__section_loop_1_total; $__section_loop_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "ONLINE_REG") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_1_saved;
}
?>
     	</div>

        
	<div onClick='showHide("items3")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['loss_rate_analysis'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items3' class='itemsct'>
		<?php
$__section_loop_2_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_2_total = $__section_loop_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_2_total != 0) {
for ($__section_loop_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_2_iteration <= $__section_loop_2_total; $__section_loop_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "LOST_RATE") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_2_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_2_saved;
}
?>
     	</div>


        <div onClick='showHide("items4")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['recharge_consumption'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items4' class='itemsct'>
        <?php
$__section_loop_3_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_3_total = $__section_loop_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_3_total != 0) {
for ($__section_loop_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_3_iteration <= $__section_loop_3_total; $__section_loop_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "CONSUME_LOG") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_3_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_3_saved;
}
?>
     	</div>


     	<div onClick='showHide("items5")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['data_analysis'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items5' class='itemsct'>
		<?php
$__section_loop_4_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_4_total = $__section_loop_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_4_total != 0) {
for ($__section_loop_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_4_iteration <= $__section_loop_4_total; $__section_loop_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "DATA_ANL") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_4_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_4_saved;
}
?>
     	</div>


	<div onClick='showHide("items6")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['operate_act'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items6' class='itemsct'>
		<?php
$__section_loop_5_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_5_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_5_total = $__section_loop_5_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_5_total != 0) {
for ($__section_loop_5_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_5_iteration <= $__section_loop_5_total; $__section_loop_5_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "FESTIVAL_DATA") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_5_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_5_saved;
}
?>
     	</div>


     	<div onClick='showHide("items7")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['message_manage'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items7' class='itemsct'>
        <?php
$__section_loop_6_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_6_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_6_total = $__section_loop_6_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_6_total != 0) {
for ($__section_loop_6_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_6_iteration <= $__section_loop_6_total; $__section_loop_6_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "MSG_MAN") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_6_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_6_saved;
}
?>
     	</div>


     	<div onClick='showHide("items8")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_manage'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items8' class='itemsct'>
        <?php
$__section_loop_7_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_7_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_7_total = $__section_loop_7_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_7_total != 0) {
for ($__section_loop_7_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_7_iteration <= $__section_loop_7_total; $__section_loop_7_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "GM_MAN") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_7_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_7_saved;
}
?>
     	</div>


     	<div onClick='showHide("items9")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['admin_manage'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items9' class='itemsct'>
        <?php
$__section_loop_8_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_8_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_8_total = $__section_loop_8_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_8_total != 0) {
for ($__section_loop_8_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_8_iteration <= $__section_loop_8_total; $__section_loop_8_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
            <?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "BACK_MAN") {?>
		<dl class='itemem'>
                  <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                  <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
                </dl>
            <?php }?>
	<?php
}
}
if ($__section_loop_8_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_8_saved;
}
?>
     	</div>
    -->  

     	<div onClick='showHide("items10")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['sys_manage'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items10' class='itemsct'>
        <?php
$__section_loop_9_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_9_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_9_total = $__section_loop_9_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_9_total != 0) {
for ($__section_loop_9_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_9_iteration <= $__section_loop_9_total; $__section_loop_9_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
            <?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "SYSTEM") {?>
		<dl class='itemem'>
                  <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                  <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
                </dl>
            <?php }?>
	<?php
}
}
if ($__section_loop_9_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_9_saved;
}
?>
     	</div>
      
        
    <!-- 以下为新加入功能 根据数据后台需求表-->
    <!-- 基本信息 -->
        <div onClick='showHide("items11")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['data']['basic_info'];?>
</div>
      	</div>
      	<div style='clear:both'></div><!-- 清除全部样式 使下面的div不会错位 -->
      	<div style='display:none' id='items11' class='itemsct'>
        <?php
$__section_loop_10_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_10_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_10_total = $__section_loop_10_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_10_total != 0) {
for ($__section_loop_10_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_10_iteration <= $__section_loop_10_total; $__section_loop_10_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
            <?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "BASIC_INFO") {?>
                <dl class='itemem'>
                    <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                    <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
                </dl>
            <?php }?>
        <?php
}
}
if ($__section_loop_10_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_10_saved;
}
?>
     	</div>
        
        <!-- 用户付费 -->
        <div onClick='showHide("items12")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['data']['user_pay'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items12' class='itemsct'>
        <?php
$__section_loop_11_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_11_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_11_total = $__section_loop_11_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_11_total != 0) {
for ($__section_loop_11_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_11_iteration <= $__section_loop_11_total; $__section_loop_11_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "USER_PAY") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_11_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_11_saved;
}
?>
     	</div>
        
        <!-- 留存活跃 -->
        <div onClick='showHide("items13")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['data']['keep_active'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items13' class='itemsct'>
        <?php
$__section_loop_12_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_12_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_12_total = $__section_loop_12_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_12_total != 0) {
for ($__section_loop_12_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_12_iteration <= $__section_loop_12_total; $__section_loop_12_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "KEEP_ACTIVE") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_12_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_12_saved;
}
?>
     	</div>
        
        <!-- 参与信息 -->
        <div onClick='showHide("items14")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['data']['participate_info'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items14' class='itemsct'>
        <?php
$__section_loop_13_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_13_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_13_total = $__section_loop_13_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_13_total != 0) {
for ($__section_loop_13_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_13_iteration <= $__section_loop_13_total; $__section_loop_13_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "PARTICIPATE_INFO") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_13_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_13_saved;
}
?>
     	</div>
        
        <!-- 资源概况 -->
       <div onClick='showHide("items15")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['data']['resource_overview'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items15' class='itemsct'>
        <?php
$__section_loop_14_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_14_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_14_total = $__section_loop_14_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_14_total != 0) {
for ($__section_loop_14_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_14_iteration <= $__section_loop_14_total; $__section_loop_14_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
			<?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "RESOURCE_OVERVIEW") {?>
			<dl class='itemem'>
              <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
              <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
            </dl>
			<?php }?>
		<?php
}
}
if ($__section_loop_14_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_14_saved;
}
?>
     	</div>
        
        <!-- 新手引导-->
        <div onClick='showHide("items16")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['data']['novice'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items16' class='itemsct'>
        <?php
$__section_loop_15_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_15_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_15_total = $__section_loop_15_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_15_total != 0) {
for ($__section_loop_15_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_15_iteration <= $__section_loop_15_total; $__section_loop_15_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
            <?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "NOVICE") {?>
                <dl class='itemem'>
                  <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                  <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
                </dl>
            <?php }?>
	<?php
}
}
if ($__section_loop_15_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_15_saved;
}
?>
     	</div>
        
        <!-- 关卡流失 -->
        <div onClick='showHide("items17")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['data']['checkpoint_lost'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items17' class='itemsct'>
        <?php
$__section_loop_16_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_16_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_16_total = $__section_loop_16_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_16_total != 0) {
for ($__section_loop_16_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_16_iteration <= $__section_loop_16_total; $__section_loop_16_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
            <?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "CHECKPOINT_LOST") {?>
                <dl class='itemem'>
                  <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                  <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
                </dl>
            <?php }?>
	<?php
}
}
if ($__section_loop_16_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_16_saved;
}
?>
     	</div>
        
        <!-- 等级流失 -->
        <div onClick='showHide("items18")' class='topitem' align='left'>
        	<div class='topl'><img src='./static/images/mtimg1.gif' width='21' height='24' border='0'></div>
        	<div class='topr'><?php echo $_smarty_tpl->tpl_vars['_lang']->value['data']['level_lost'];?>
</div>
      	</div>
      	<div style='clear:both'></div>
      	<div style='display:none' id='items18' class='itemsct'>
        <?php
$__section_loop_17_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_17_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['user_power']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_17_total = $__section_loop_17_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_17_total != 0) {
for ($__section_loop_17_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_17_iteration <= $__section_loop_17_total; $__section_loop_17_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
?>
            <?php if ($_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['man_type'] == "LEVEL_LOST") {?>
                <dl class='itemem'>
                  <dd class='tdl'><img src='./static/images/newitem.gif' width='7' height='10' alt=''/></dd>
                  <dd class='tdr'><a href=<?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['url'];?>
 target='main_frame'><?php echo $_smarty_tpl->tpl_vars['user_power']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['desc'];?>
</a></dd>
                </dl>
            <?php }?>
	<?php
}
}
if ($__section_loop_17_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_17_saved;
}
?>
     	</div>

    </div>
</body>
</html>
<?php }
}
