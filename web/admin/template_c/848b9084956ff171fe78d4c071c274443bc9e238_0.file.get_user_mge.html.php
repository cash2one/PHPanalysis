<?php
/* Smarty version 3.1.29, created on 2016-07-25 17:26:31
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\account\get_user_mge.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5795db4747bb26_64749822',
  'file_dependency' => 
  array (
    '848b9084956ff171fe78d4c071c274443bc9e238' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\account\\get_user_mge.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5795db4747bb26_64749822 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_html_options')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\function.html_options.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['player_data_view'];?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<style type="text/css">

#all {text-align:left;margin-left:4px; line-height:1;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}

</style>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function(){
		$("#role_id").keydown(function(){
			$("#role_name").val('');
			$("#account_name").val('');
		});
		$("#role_name").keydown(function(){
			$("#role_id").val('');
			$("#account_name").val('');
		});
		$("#account_name").keydown(function(){
			$("#role_id").val('');
			$("#role_name").val('');
		});
	});
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

    function doBanOne(role_id){
		if($.trim( $("#ban_reason").val() ) == "" ){
			alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js1'];?>
");
		}else if($.trim( $("#ban_time").val() ) == "null" ){
			alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js2'];?>
");
		}else{
			yes = confirm("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js3'];?>
");
			if(yes){
				$("#frmBan").attr("action","?action=doBan");
				$("#banRoleID").val(role_id);
				$("#frmBan").submit();
			}
		}
	}
    function doUnBan(role_id,account_name){
        if(role_id){
            yes = confirm("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js10'];?>
");
            if(yes){
                $("#frmBan").attr("action","?action=doUnBan");
                $("#frmBan").submit();
            }
        }
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
</head>

<body>
	<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['data_analysis'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['player_data_view'];?>
</div>
	<form action="?action=search" id="frm" method="POST" >
        <table cellspacing="1" cellpadding="5" class="SumDataGrid" width="800">
            <tr>
                <td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
：</td>
                <td><input type="text" name="role_id" id="role_id" value="<?php echo $_smarty_tpl->tpl_vars['search_role_id']->value;?>
" /></td>
                <td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
：</td>
                <td><input type="text" name="role_name" id="role_name" value="<?php echo $_smarty_tpl->tpl_vars['search_role_name']->value;?>
" /></td>
                <td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
：</td>
                <td><input type="text" name="account_name" id="account_name" value="<?php echo $_smarty_tpl->tpl_vars['search_account_name']->value;?>
" /></td>
                <td><input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/></td>
            </tr>
        </table>
	    <br>
	</form>
    <?php if (count($_smarty_tpl->tpl_vars['role_result']->value) != 0) {?>
    <table class='paystat' style="width:55%">
        <tr class='table_list_head'>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmoon']['operating'];?>
</td>
        </tr>
        <?php
$_from = ((string)$_smarty_tpl->tpl_vars['role_result']->value);
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_roleData_0_saved_item = isset($_smarty_tpl->tpl_vars['roleData']) ? $_smarty_tpl->tpl_vars['roleData'] : false;
$_smarty_tpl->tpl_vars['roleData'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['roleData']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['roleData']->value) {
$_smarty_tpl->tpl_vars['roleData']->_loop = true;
$__foreach_roleData_0_saved_local_item = $_smarty_tpl->tpl_vars['roleData'];
?>
        <tr class="trOdd">
            <td><?php echo $_smarty_tpl->tpl_vars['roleData']->value['role_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['roleData']->value['role_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['roleData']->value['account_name'];?>
</td>
            <td><a href="?action=search&type=continue&role_id=<?php echo $_smarty_tpl->tpl_vars['roleData']->value['role_id'];?>
&role_name=<?php echo $_smarty_tpl->tpl_vars['roleData']->value['role_name'];?>
&search_role_id=<?php echo $_smarty_tpl->tpl_vars['search_role_id']->value;?>
&search_role_name=<?php echo $_smarty_tpl->tpl_vars['search_role_name']->value;?>
&search_account_name=<?php echo $_smarty_tpl->tpl_vars['search_account_name']->value;?>
">查询</a></td>
        </tr>
        <?php
$_smarty_tpl->tpl_vars['roleData'] = $__foreach_roleData_0_saved_local_item;
}
if ($__foreach_roleData_0_saved_item) {
$_smarty_tpl->tpl_vars['roleData'] = $__foreach_roleData_0_saved_item;
}
?>
    </table>
    <br>
    <?php }?>
    <!--
    <form action="?action=kill" method="post">
        <?php
$_from = ((string)$_smarty_tpl->tpl_vars['role']->value);
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_userData_1_saved_item = isset($_smarty_tpl->tpl_vars['userData']) ? $_smarty_tpl->tpl_vars['userData'] : false;
$_smarty_tpl->tpl_vars['userData'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['userData']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['userData']->value) {
$_smarty_tpl->tpl_vars['userData']->_loop = true;
$__foreach_userData_1_saved_local_item = $_smarty_tpl->tpl_vars['userData'];
?>
        <input name="role_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['userData']->value['role_id'];?>
" >
        <input name="role_name" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['userData']->value['role_name'];?>
" >
        <input name="account_name" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['userData']->value['account_name'];?>
" >
        <?php
$_smarty_tpl->tpl_vars['userData'] = $__foreach_userData_1_saved_local_item;
}
if ($__foreach_userData_1_saved_item) {
$_smarty_tpl->tpl_vars['userData'] = $__foreach_userData_1_saved_item;
}
?>
        <table width="800s"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
            <tr bgcolor="#A5D0F1" align="left">
                <td><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_manage'];?>
</b><font color="red">（<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['player_data_view_note'];?>
）</font></td>
            </tr>
            <tr bgcolor="#FFFFFF">
                <td width="70%">
                    <input type="radio" name="action_type" value = "kill_role"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['kick_user_offline'];?>

                    <!--<input type="radio" name="action_type" value = "kill_role_utill">封玩家帐号<input type="text" name="ban_time" value = "30" size=12>分钟
                    <input type="radio" name="action_type" value = "stop_chat"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gag'];?>

                    <input type="text" name="chat_time" value = "60" size=12><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['minute'];?>

                </td>
                <td width="30%"><input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['submit'];?>
"></td>
            </tr>
        </table>                    
    </form>
    <br>
    <form action="?action=doBan" method="POST" id="frmBan">
        <table width="800s" cellspacing="1" cellpadding="5" border="0">
            <tr bgcolor="#A5D0F1" align="left"><td colspan="5">
                    <b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_account'];?>
+<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gag'];?>
</b>
                </td>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['ban_account']->value) {?>
			<tr class='table_list_head'  align="center">				
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_time'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['no_banned_time'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_reason'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['operator'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['operating'];?>
</td>
			</tr>
            <tr class='trOdd'  align="center">
                <input name="role_id" value="<?php echo $_smarty_tpl->tpl_vars['ban_account']->value['role_id'];?>
" type="hidden">
                <input name="role_name" value="<?php echo $_smarty_tpl->tpl_vars['ban_account']->value['role_name'];?>
" type="hidden">
                <input name="account_name" value="<?php echo $_smarty_tpl->tpl_vars['ban_account']->value['account_name'];?>
" type="hidden">
                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ban_account']->value['start_time'],"%Y-%m-%d %H:%M:%S");?>
</td>
                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['ban_account']->value['end_time'],"%Y-%m-%d %H:%M:%S");?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['ban_account']->value['ban_reason'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['ban_account']->value['admin'];?>
</td>
                <td><input name="btnUnBan" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['no_banned'];?>
" onclick="doUnBan('<?php echo $_smarty_tpl->tpl_vars['ban_account']->value['role_id'];?>
','<?php echo $_smarty_tpl->tpl_vars['ban_account']->value['account_name'];?>
');" type="button"></td>
            </tr>
            <?php } else { ?>
			<tr class='table_list_head'  align="center">
				<!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>-->
				<!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['ip_address'];?>
</td>-->
				<!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_level'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['total_recharge'];?>
</td>-->
				<!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['statu'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_time_long'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_reason'];?>
</td>
                <td width="20%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['operating'];?>
</td>
			</tr>
            <tr class='trOdd'  align="center">
                <input name="role_id" value="<?php echo $_smarty_tpl->tpl_vars['account']->value['role_id'];?>
" type="hidden">
                <input name="role_name" value="<?php echo $_smarty_tpl->tpl_vars['account']->value['role_name'];?>
" type="hidden">
                <input name="account_name" value="<?php echo $_smarty_tpl->tpl_vars['account']->value['account_name'];?>
" type="hidden">
                <input name="pay_all" value="<?php echo $_smarty_tpl->tpl_vars['account']->value['pay'];?>
" type="hidden">
                <td><input name="last_login_ip" value="<?php echo $_smarty_tpl->tpl_vars['account']->value['last_login_ip'];?>
" type="hidden"><?php echo $_smarty_tpl->tpl_vars['account']->value['last_login_ip'];?>
</td>
                <td><input name="is_online" value="<?php echo $_smarty_tpl->tpl_vars['account']->value['is_online'];?>
" type="hidden"><?php if ($_smarty_tpl->tpl_vars['account']->value['is_online'] == 1) {?><font color="#0000FF"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['online'];?>
</font><?php } else {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['offline'];
}?></td>
                <td>
                    <select name="ban_time" id="ban_time">
                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ban_time_option']->value,'selected'=>$_smarty_tpl->tpl_vars['ban_time']->value),$_smarty_tpl);?>

                    </select>
                </td>
                <td><input class="ban_reason" name="ban_reason" id="ban_reason" size="40" type="text"></td>
                <td><input name="btnBan" onclick="doBanOne('<?php echo $_smarty_tpl->tpl_vars['account']->value['role_id'];?>
');" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned'];?>
" type="button"></td>
			</tr>
       		<?php }?>
        </table>
    </form>
	<br>-->

	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr align="left">
			<td><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_info'];?>
</b></td>
		</tr>
		<tr class='table_list_head'>
			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td><!-- 角色ID -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td><!-- 账号名 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td><!-- 角色名 -->

            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['career'];?>
</td><!-- 新增 职业-->

            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['sex'];?>
</td><!-- 性别 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['martial_art'];?>
</td><!-- 国家 -->

            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['family'];?>
</td><!-- 新增 家族-->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['vip'];?>
</td> <!-- 新增 vip-->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['suicide'];?>
</td> <!--新增 转生-->

			<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_level'];?>
</td><!-- 角色等级 -->

            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['rank'];?>
</td><!--新增 军衔-->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['map'];?>
</td><!--新增 所在地图 -->

            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['statu'];?>
</td><!-- 状态 -->
        </tr>
        <?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['role']->value) ? count($_loop) : max(0, (int) $_loop));
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
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>
</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['class_id'] == 1) {?>
                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mengjiang'];?>

                <?php } elseif ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['class_id'] == 2) {?>
                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['moushi'];?>

                <?php } elseif ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['class_id'] == 3) {?>
                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['fangshi'];?>

                <?php }?>
            </td>

            <?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['sex'] == 1) {?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['man'];?>
</td>
            <?php } else { ?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['woman'];?>
</td>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['faction_id'] == 1) {?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['tiandao'];?>
</td>
            <?php } elseif ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['faction_id'] == 2) {?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['yijian'];?>
</td>
            <?php } elseif ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['faction_id'] == 3) {?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['yinkui'];?>
</td>
            <?php } else { ?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['cihang'];?>
</td>
            <?php }?>

            <td>
                <?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['family_name']) {?>
                <?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['family_name'];?>

                <?php } else { ?>
                暂无家族
                <?php }?>    
            </td>
            <!-- <td>
                <?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['family_name']) {?>
                    <?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['family_name'];?>

                <?php } else { ?>
                    null
                <?php }?>
            </td> -->
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['vip_level'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['reincarnation'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['militaryranks'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['map'];?>
</td>
            <!--<td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['create_time'];?>
</td>
            <td><?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['is_online'] == 1) {?><font color="#0000FF">0</font><?php } else {
if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_day'] >= 3) {?><font color="red"><?php }
echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_day'];?>
天<?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_h_m'];
}?></td>

            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gongxun'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['exp'];?>
</td>-->
            <td><?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['is_online'] == 1) {?><font color="red"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['online'];?>
<font><?php } else {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['offline'];
}?></td>
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
    <table  width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr class='table_list_head'>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['rechenge_sum'];?>
</td><!--新增 累积充值元宝 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['sycee'];?>
</td><!-- 新增 当前元宝 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['bind_gold'];?>
</td> <!--新增 礼金 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['silver'];?>
</td><!-- 银两 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['remain_bind_silver'];?>
</td><!--新增 remain_bind_silver -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['vigour'];?>
</td><!--新增 元气 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['courage'];?>
</td><!--新增 魄力 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['GOVCR'];?>
</td><!--新增 国家贡献 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['prestige'];?>
</td><!-- 功勋 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['honor'];?>
</td><!--新增 荣誉值-->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['pk'];?>
</td><!--新增 pk值 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['experience'];?>
</td><!-- 经验 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['up_experience'];?>
</td><!-- 升级经验 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['registered_time'];?>
</td><!-- 注册时间 -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['last_log_time'];?>
</td><!--新增 最后登录时间 -->
            <!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['register_ip'];?>
</td><!--新增 注册IP-->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['last_login_ip'];?>
</td><!-- 最后登录IP -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['offline_time'];?>
</td><!-- 离线时长 -->
        </tr>
        <?php
$__section_loop_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['role']->value) ? count($_loop) : max(0, (int) $_loop));
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
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['pay_gold'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gold'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gold_bind'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver_bind'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['vitality'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['soul'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['jungong'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['exploit'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['honor'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['pk_points'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['exp'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['next_level_exp'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['create_time'];?>
</td>
            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_time'],'%Y-%m-%d %H:%M:%S');?>
</td>
            <!--<td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['login_ip'];?>
</td>-->
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_ip'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_day'];?>
天<?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_h_m'];?>
</td>
        <!--
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
</td>
            <td><?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['is_online'] == 1) {?><font color="red"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['online'];?>
<font><?php } else {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['offline'];
}?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gold'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gold_bind'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['silver'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_ip'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['create_time'];?>
</td>
            <td><?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['is_online'] == 1) {?><font color="#0000FF">0</font><?php } else {
if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_day'] >= 3) {?><font color="red"><?php }
echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_day'];?>
天<?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['left_h_m'];
}?></td>
            <?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['sex'] == 1) {?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['man'];?>
</td>
            <?php } else { ?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['woman'];?>
</td>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['faction_id'] == 1) {?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['tiandao'];?>
</td>
            <?php } elseif ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['faction_id'] == 2) {?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['yijian'];?>
</td>
            <?php } elseif ($_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['faction_id'] == 3) {?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['yinkui'];?>
</td>
            <?php } else { ?>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['cihang'];?>
</td>
            <?php }?>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['family_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['gongxun'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['exp'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['role']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['next_level_exp'];?>
</td>
        -->
        </tr>
        <?php
}
}
if ($__section_loop_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_1_saved;
}
?>

    </table>
    <!--<br>
    <table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
        	<td><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_mounts_info'];?>
</b></td>
        </tr>
		     <tr class='table_list_head'>
                <!--  <td>物品id</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_id'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_type'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_color'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_timetype'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_time'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_level'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_class'];?>
</td>
             </tr>
             <?php
$__section_loop_2_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['mounts']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_2_total = $__section_loop_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_2_total != 0) {
for ($__section_loop_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_2_iteration <= $__section_loop_2_total; $__section_loop_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_2_iteration;
?>
                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
					<tr class='trEven'>
					<?php } else { ?>
					<tr class='trOdd'>
					<?php }?>
                            <td><?php echo $_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['typeid'];?>
</td>
                        	<td><?php echo $_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['name'];?>
</td>
                            <td><?php if ($_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['endurance'] == 1) {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_zhu'];
} else {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_pi'];
}?></td>
                        	<?php if ($_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['color'] == 1) {?><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['white'];?>
</td>
							<?php } elseif ($_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['color'] == 2) {?><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['green'];?>
</td>
							<?php } elseif ($_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['color'] == 3) {?><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['blue'];?>
</td>
							<?php } elseif ($_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['color'] == 4) {?><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['purple'];?>
</td>
							<?php } else { ?><td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['orange'];?>
</td>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['cur_endu'] == 0) {?>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_yongjiu'];?>
</td>
                            <td>0</td>
                            <?php } elseif ($_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['cur_endu'] == 1) {?>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_riqi'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['equips']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['end_time'];?>
</td>
                            <?php } else { ?>
                            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_shixian'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['end_time'];?>
</td>
                            <?php }?>
                            <td><?php echo $_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['class_level'];?>
</td>
                  </tr>
             <?php
}
}
if ($__section_loop_2_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_2_saved;
}
?>
    </table>
    -->
    <br>
    <!-- 装备 -->
    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
			 <tr align="left">
				<td><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_equipment_info'];?>
</b></td>
			 </tr>
		     <tr class='table_list_head'>
                <!--  <td>物品id</td> -->
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['equipment_id'];?>
</td><!-- 装备ID -->
                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['equipment_name'];?>
</td><!-- 装备名称 -->
                 <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['equipment_num'];?>
</td><!-- 装备等级 -->
                <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['rein_num'];?>
</td><!-- 强化等级 -->
                <!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['star_num'];?>
</td><!-- 强化星数 -->
                 <!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['hole_num'];?>
</td><!-- 装备孔数 -->
                 <!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gemstone'];?>
</td><!-- 灵石 -->
                 <!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['is_band'];?>
</td><!-- 是否绑定 -->
             </tr>
        <?php
$__section_loop_3_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_3_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['equips']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_3_total = $__section_loop_3_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_3_total != 0) {
for ($__section_loop_3_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_3_iteration <= $__section_loop_3_total; $__section_loop_3_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_3_iteration;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
        <tr class='trEven'>
        <?php } else { ?>
        <tr class='trOdd'>
        <?php }?>
           <!--  <td><?php echo $_smarty_tpl->tpl_vars['equips']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['id'];?>
</td> -->
            <td><?php echo $_smarty_tpl->tpl_vars['equips']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['typeid'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equips']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['name'];?>
</td>
            <td>穿戴等级:<?php echo $_smarty_tpl->tpl_vars['equips']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['min_level'];?>
(转生等级:<?php echo $_smarty_tpl->tpl_vars['equips']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['reincarnation'];?>
)</td>
            <td><?php echo $_smarty_tpl->tpl_vars['equips']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['reinforce'];?>
</td>
        </tr>
        <?php
}
}
if ($__section_loop_3_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_3_saved;
}
?>
    </table>
    <br>

    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
            <!--<td><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_props_info'];?>
</b></td><!-- 背包物品 -->
        	<td><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bag_goods'];?>
</b></td><!-- 背包物品 -->
        </tr>
        <tr class='table_list_head'>
            <!-- <td>物品id</td> -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['goods_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['goods_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['goods_num'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['is_band'];?>
</td>
        </tr>
        <?php
$__section_loop_4_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_4_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['goods']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_4_total = $__section_loop_4_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_4_total != 0) {
for ($__section_loop_4_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_4_iteration <= $__section_loop_4_total; $__section_loop_4_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_4_iteration;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
        <tr class='trEven'>
        <?php } else { ?>
        <tr class='trOdd'>
        <?php }?>
            <!-- <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['id'];?>
</td> -->
            <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['typeid'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['name'];?>
</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['current_num']) {?>
                <?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['current_num'];?>

                <?php } else { ?>
                1
                <?php }?>
            </td>
            <td>
            	<?php if ($_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['bind'] == 1) {?>
                	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bind'];?>

                <?php } else { ?>
                	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['tradable'];?>

                <?php }?>
            </td>
        </tr>
        <?php
}
}
if ($__section_loop_4_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_4_saved;
}
?>
    </table>
    <br>



    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
            <!--<td><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_props_info'];?>
</b></td><!-- 背包物品 -->
            <td><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['warehouse_goods'];?>
</b></td><!-- 背包物品 -->
        </tr>
        <tr class='table_list_head'>
            <!-- <td>物品id</td> -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['goods_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['goods_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['goods_num'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['is_band'];?>
</td>
        </tr>
        <?php
$__section_loop_5_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_5_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['depot']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_5_total = $__section_loop_5_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_5_total != 0) {
for ($__section_loop_5_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_5_iteration <= $__section_loop_5_total; $__section_loop_5_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_5_iteration;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
        <tr class='trEven'>
            <?php } else { ?>
        <tr class='trOdd'>
            <?php }?>
            <!-- <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['id'];?>
</td> -->
            <td><?php echo $_smarty_tpl->tpl_vars['depot']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['typeid'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['depot']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['name'];?>
</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['depot']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['current_num']) {?>
                <?php echo $_smarty_tpl->tpl_vars['depot']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['current_num'];?>

                <?php } else { ?>
                1
                <?php }?>
            </td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['depot']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['bind'] == 1) {?>
                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bind'];?>

                <?php } else { ?>
                <?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['tradable'];?>

                <?php }?>
            </td>
        </tr>
        <?php
}
}
if ($__section_loop_5_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_5_saved;
}
?>
    </table>
    <br>
<!--
    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
        	<td><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['warehouse_goods'];?>
</b></td>
        </tr>
        <tr class='table_list_head'>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['goods_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['goods_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['goods_num'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['is_band'];?>
</td>
        </tr>
        <?php
$__section_loop_6_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_6_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['goods']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_6_total = $__section_loop_6_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_6_total != 0) {
for ($__section_loop_6_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_6_iteration <= $__section_loop_6_total; $__section_loop_6_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_6_iteration;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
        <tr class='trEven'>
        <?php } else { ?>
        <tr class='trOdd'>
        <?php }?>
            <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['typeid'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['current_num'];?>
</td>
            <td>
            	<?php if ($_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['bind'] == 1) {?>
                	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bind'];?>

                <?php } else { ?>
                	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['tradable'];?>

                <?php }?>
            </td>
        </tr>
        <?php
}
}
if ($__section_loop_6_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_6_saved;
}
?>
    </table>
    <br>
-->

<!--
    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
        	<td><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['inlay_gem'];?>
</b></td>
        </tr>
        <tr class='table_list_head'>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['inlay_part'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gemID'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gem_name'];?>
</td>
        </tr>
        <?php
$__section_loop_7_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_7_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['goods']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_7_total = $__section_loop_7_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_7_total != 0) {
for ($__section_loop_7_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_7_iteration <= $__section_loop_7_total; $__section_loop_7_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_7_iteration;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
        <tr class='trEven'>
        <?php } else { ?>
        <tr class='trOdd'>
        <?php }?>
            <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['typeid'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['current_num'];?>
</td>
            <td>
            	<?php if ($_smarty_tpl->tpl_vars['goods']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['bind'] == 1) {?>
                	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bind'];?>

                <?php } else { ?>
                	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['tradable'];?>

                <?php }?>
            </td>
        </tr>
        <?php
}
}
if ($__section_loop_7_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_7_saved;
}
?>
    </table>
-->

    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
            <td><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_mounts_info'];?>
</b></td><!-- 坐骑信息 -->
        </tr>
        <tr class='table_list_head'>
            <!-- <td>物品id</td> -->
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_level'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['mountsment_class'];?>
</td>
          <!--  <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['is_band'];?>
</td>-->
        </tr>
        <?php
$__section_loop_8_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_8_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['mounts']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_8_total = $__section_loop_8_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_8_total != 0) {
for ($__section_loop_8_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_8_iteration <= $__section_loop_8_total; $__section_loop_8_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_8_iteration;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
        <tr class='trEven'>
        <?php } else { ?>
        <tr class='trOdd'>
        <?php }?>
            <td><?php echo $_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['star_level'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['mounts']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['step_level'];?>
</td>
        </tr>
        <?php
}
}
if ($__section_loop_8_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_8_saved;
}
?>
    </table>
</body>
</html>
<?php }
}
