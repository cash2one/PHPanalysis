<?php
/* Smarty version 3.1.29, created on 2016-09-08 20:38:42
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\gm\ban_ip.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d15bd279f513_22285690',
  'file_dependency' => 
  array (
    '667c62d40192e4b30873538c094a1a59fd169da6' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\gm\\ban_ip.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d15bd279f513_22285690 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\function.html_options.php';
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript">
	$(document).ready(function(){
		$("#btnAdd").click(function(){
			var flag = true;
			if("" == $.trim( $("#ip").val() )){
				alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_ip_js1'];?>
");
				flag = false;
			}else if("null" == $.trim( $("#ban_time").val())){
				alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_ip_js2'];?>
");
				flag = false;
			}
			else if("" == $.trim( $("#ban_reason").val() )){
				alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_ip_js3'];?>
");
				flag = false;
			}
			if(flag){
				yes = confirm("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_ip_js4'];?>
");
				if(yes){
					$("#frmBan").submit();
				}
			}
		});

		$("#btnChkOnline").click(function(){
			if("" == $.trim( $("#ip").val() )){
				alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_ip_js1'];?>
");
				flag = false;
			}else{
				$("#frmBan").attr("action","?action=countOnline");
				$("#frmBan").submit();
			}
		});
	});
	function doRemove(ip){
		if(ip){
				$("#frmBan").attr("action","?action=doUnBanIp");
				$("#unBanIp").val(ip);
				$("#frmBan").submit();
			}
		}
	function doImport(){
		$("#frmImport").submit();
	}
<?php echo '</script'; ?>
>

<style type="text/css">
	#ulBandReason{
		width:300px;
		margin:0px;
		padding:0px;
		list-style:none;
		background-color:#D9D9D9;
		border:2px solid blue;
		position:absolute;
		display:none;
	}
	#ulBandReason li{
		height:20px;
		border:1px solid #CCC;
	}
	#closeReason{
		text-align:right;
		text-decoration:underline;
	}
	.reasonItem{
		text-align:left;
	}
</style>
<ul id="ulBandReason">
	<li id="closeReason"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['close'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['about_steal_account'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['irregularities'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['spreading_false_information'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['fake_GM'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['use_third_party_software'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['use_forbid_rolename'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['illegal_transactions'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['use_bug'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['use_forbid_rolename'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['abuse_others'];?>
</a></li>
</ul>
<?php echo '<script'; ?>
 language="javascript">
	$(document).ready(function(){
		window.fromInput = null;
		$(".ban_reason").click(function(){
			var offset = $(this).offset();
			window.fromInput = $(this);
			$("#ulBandReason").css("top",offset.top+20).css("left",offset.left);
			$("#ulBandReason").show();
		});
		$("#closeReason").click(function(){
			$("#ulBandReason").hide();
		});
		$(".reasonItem").click(function(){
			window.fromInput.val($(this).find("a").text());
			$("#ulBandReason").hide();
			event.stopPropagation();
		});
		$("#ban_reason").keydown(function(){
			$("#ulBandReason").hide();
		});
	});
<?php echo '</script'; ?>
>
<title>
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_ip'];?>

</title>
</head>

<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_manage'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_ip'];?>
</div>

<table width="1000" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr bgcolor="#E5F9FF">
		<td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
			<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_ip_attention'];?>
</b></font>
		</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_ip_attention_1'];?>
</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_ip_attention_2'];?>
</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><font color="Red"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_ip_attention_3'];?>
</b></font></td>
	</tr>
</table>
<br>
<form action="?action=import" id="frmImport" method="POST">
	<table width="1000" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr class="table_list_head" align="left">
			<td width="100%"><input name="btnBanImport" onclick="doImport();" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_ip_attention_4'];?>
" type="button">
			<font color="red"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_ip_attention_5'];?>
</font>
			</td>
		</tr>
	</table>
	<br>
</form>
<?php if ($_smarty_tpl->tpl_vars['online_cnt']->value >= 0) {?>
<table width="1000" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr bgcolor="#E5F9FF" align="left">
		<td><font color="Red"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['login_ip_is'];?>
：<?php echo $_smarty_tpl->tpl_vars['ip']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['s_online_num'];?>
：<?php echo $_smarty_tpl->tpl_vars['online_cnt']->value;
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['ren'];?>
。</b></font></td>
	</tr>
</table>
<?php }?>
<form action="?action=doBanIp" method="POST" id="frmBan">
<table width="1000" cellspacing="1" cellpadding="5" border="0">
	<tr class='table_list_head'  align="center">
		<td width="15%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['ip_address'];?>
</td>
		<td width="15%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['lifted_time'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_reason'];?>
</td>
		<td width="20%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['operating'];?>
</td>
		<td width="10%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['operator'];?>
</td>
	</tr>
	<tr class='table_list_head'  align="center">
		<td><input name="ip" id="ip" type="text"></td>
		<td><select name="ban_time" id="ban_time"><?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ban_time_option']->value,'selected'=>$_smarty_tpl->tpl_vars['ban_time']->value),$_smarty_tpl);?>
</select></td>
		<td><input class="ban_reason" size="30" name="ban_reason" id="ban_reason" type="text"></td>
		<td>
			<input name="btnChkOnline" id="btnChkOnline" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['check_the_IP_online_people'];?>
" type="button">
			<input name="btnAdd" id="btnAdd" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned'];?>
" type="button">
		</td>
		<td></td>
	</tr>
	<?php if ($_smarty_tpl->tpl_vars['ban_ip_list']->value) {?>
	<!-- SECTION  START -------------------------->
	<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ban_ip_list']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
		<tr class='trEven'  align="center">
		<?php } else { ?>
		<tr class='trOdd'  align="center">
		<?php }?>
			<td><?php echo $_smarty_tpl->tpl_vars['ban_ip_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_ip'];?>
</td>
			<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ban_ip_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['end_time'],"%Y-%m-%d %H:%M:%S");?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['ban_ip_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['ban_reason'];?>
</td>
			<td><input name="btnRemove" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['no_banned'];?>
" onclick="doRemove('<?php echo $_smarty_tpl->tpl_vars['ban_ip_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_ip'];?>
');" type="button"></td>
			<td><?php echo $_smarty_tpl->tpl_vars['ban_ip_list']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['admin'];?>
</td>
		</tr>
	<?php }} else {
 ?>
	<?php
}
if ($__section_loop_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_0_saved;
}
?>
	<!-- SECTION  END -------------------------->
	<?php }?>
</table>
<input name="unBanIp" id="unBanIp" value="" type="hidden">
</form>


</body>
</html>
<?php }
}
