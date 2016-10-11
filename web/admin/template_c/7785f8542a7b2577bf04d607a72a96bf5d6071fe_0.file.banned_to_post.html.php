<?php
/* Smarty version 3.1.29, created on 2016-09-08 20:38:52
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\gm\banned_to_post.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57d15bdc9beb59_50913637',
  'file_dependency' => 
  array (
    '7785f8542a7b2577bf04d607a72a96bf5d6071fe' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\gm\\banned_to_post.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d15bdc9beb59_50913637 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_options')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\function.html_options.php';
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
    <link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
    <?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 language="javascript">
        function doImport(){
            $("#frmImport").submit();
        }

        function doBanOne(role_id){
            if($.trim( $("#ban_"+role_id+"_ban_reason").val() ) == "" ){
                alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js1'];?>
");
            }else if($.trim( $("#ban_"+role_id+"_ban_time").val() ) == "null" ){
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

        function doBanMany(){
            var flag = true;
            var num = 0;
            $(".Ban_check").each(function(i){
                if($(this).attr("checked"))
                {
                    var role_id = $(this).val();
                    if($.trim( $("#ban_"+role_id+"_ban_reason").val() ) == "" ){
                        alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js4'];?>
"+role_id+"<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js5'];?>
");
                        flag = false;
                        return false;
                    }else if($.trim( $("#ban_"+role_id+"_ban_time").val() ) == "null" ){
                        alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js6'];?>
"+role_id+"<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js7'];?>
");
                        flag = false;
                        return false;
                    }
                    num = 1;
                }
            });
            if(flag==true){
                if(num==0){
                    alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js8'];?>
");
                    return false;
                }
                else{
                    yes = confirm("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js9'];?>
");
                    if(yes){
                        $("#frmBan").attr("action","?action=doBanMany");
                        $("#frmBan").submit();
                    }
                }
            }
        }

        function doUnBan(role_id,account_name){
            if(role_id){
                yes = confirm("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js10'];?>
");
                if(yes){
                    $("#frmUnBan").attr("action","?action=doUnBan");
                    $("#unBanRoleID").val(role_id);
                    $("#unBanAccountName").val(account_name);
                    $("#frmUnBan").submit();
                }
            }
        }

        function doCheckAll(checkBoxName){
            var checkBox = document.getElementsByName(checkBoxName);
            for (var i = 0; i < checkBox.length; i++)
            {
                var temp = checkBox[i];
                temp.checked = true;
            }
        }

        function doUnBanMany(){
            $("#frmUnBan").attr("action","?action=doUnBanMany");
            var num = 0;
            $(".unBan_check").each(function(i){
                if($(this).attr("checked"))
                {
                    num = 1;
                }
            });
            if(num==0){
                alert("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js11'];?>
");
                return false;
            }
            else{
                yes = confirm("<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_js12'];?>
");
                if(yes){
                    $("#frmUnBan").submit();
                }
            }
        }
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function(){
            $("#role_id").keydown(function(){
                $("#role_name").val('');
                $("#account_name").val('');
                $("#ip_addr").val('');
            });
            $("#role_name").keydown(function(){
                $("#role_id").val('');
                $("#account_name").val('');
                $("#ip_addr").val('');
            });
            $("#account_name").keydown(function(){
                $("#role_id").val('');
                $("#role_name").val('');
                $("#ip_addr").val('');
            });
            $("#ip_addr").keydown(function(){
                $("#role_id").val('');
                $("#role_name").val('');
                $("#account_name").val('');
            });
        });
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
        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_account'];?>

    </title>
</head>

<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_manage'];?>
：禁言管理</div>

<form action="?action=search" id="frmSearch" method="POST" >
    <table cellspacing="1" cellpadding="5" class="SumDataGrid" width="900">
        <tr>
            <td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
：</td>
            <td><input type="text" name="role_id" id="role_id" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['role_id'];?>
" /></td>
            <td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
：</td>
            <td><input type="text" name="role_name" id="role_name" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['role_name'];?>
" /></td>
            <td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
：</td>
            <td><input type="text" name="account_name" id="account_name" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['account_name'];?>
" /></td>
            <td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['ip_address'];?>
：</td>
            <td><input type="text" name="ip_addr" id="ip_addr" value="<?php echo $_smarty_tpl->tpl_vars['ip_addr']->value;?>
" /></td>
            <td><input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/></td>
        </tr>
    </table>
    <br>
</form>

<!-- <form action="?action=import" id="frmImport" method="POST">
	<table width="100%" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr class="table_list_head" align="left">
			<td width="100%"><input name="btnBanImport" onclick="doImport();" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_account_note1'];?>
" type="button">
			<font color="red"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_account_note2'];?>
</font>
			</td>
		</tr>
	</table>
	<br>
</form> -->


<form action="?action=doBan" method="POST" id="frmBan">
    <?php if ($_smarty_tpl->tpl_vars['same_ip_rst']->value) {?>
    <table width="100%" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr bgcolor="#E5F9FF">
            <td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
                <font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['all_normal_account_the_same_IP'];?>
</b></font>
            </td>
        </tr>
    </table>
    <input name="ip_addr" id="ip_addr" value="<?php echo $_smarty_tpl->tpl_vars['ip_addr']->value;?>
" type="hidden">
    <table width="100%" cellspacing="1" cellpadding="5" border="0">
        <!-- SECTION  START -------------------------->
        <?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['same_ip_rst']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
        <tr class='table_list_head'  align="center">
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['ip_address'];?>
</td>
            <td>转生</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_level'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['total_recharge'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['statu'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_time_long'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_reason'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['operating'];?>
<!--<input name="btnBanMany" onclick="doBanMany();" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['lot_banned'];?>
" type="button">--></td>
            <!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['select'];?>
<input name="btnCheckAll" onclick="doCheckAll('Ban_check[]');" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['select_all'];?>
" type="button"></td>-->
        </tr>
        <?php }?>

        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
        <tr class='trEven'  align="center">
            <?php } else { ?>
        <tr class='trOdd'  align="center">
            <?php }?>
            <td>
                <input name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][role_id]" value="<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>

            </td>
            <td>
                <input name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][role_name]" value="<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>

            </td>
            <td>
                <input name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][account_name]" value="<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>

            </td>
            <td>
                <input name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][last_login_ip]" value="<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_ip'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_ip'];?>

            </td>
            <td>
                <input name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][reincarnation]" value="<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['reincarnation'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['reincarnation'];?>

            </td>
            <td>
                <input name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][level]" value="<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>

            </td>
            <td>
                <input name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][pay_all]" value="<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['pay_all'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['pay_all'];?>

            </td>
            <td>
                <input name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][is_online]" value="<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['is_online'];?>
" type="hidden">
                <?php if ($_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['is_online'] == 1) {?><font color="#0000FF"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['online'];?>
</font>
                <?php } else {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['offline'];
}?>
            </td>
            <td>
                <select name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][ban_time]" id="ban_<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
_ban_time">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['ban_time_option']->value,'selected'=>$_smarty_tpl->tpl_vars['ban_time']->value),$_smarty_tpl);?>

                </select>
            </td>
            <td>
                <input class="ban_reason" name="ban[<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][ban_reason]" id="ban_<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
_ban_reason" size="40" type="text">
            </td>
            <td>
                <input name="btnBan" onclick="doBanOne('<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
');" value="禁言" type="button">
            </td>
            <!--<td>
                <input name="Ban_check[]" class="Ban_check" value="<?php echo $_smarty_tpl->tpl_vars['same_ip_rst']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
" type="checkbox">
            </td>-->
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
    </table>
    <input name="banRoleID" id="banRoleID" value="" type="hidden">
    <br>
    <?php }?>
</form>


<form action="?action=doUnBan" method="POST" id="frmUnBan">
    <?php if ($_smarty_tpl->tpl_vars['all_ban_account']->value) {?>
    <table width="100%" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr bgcolor="#E5F9FF">
            <td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
                <font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_account'];?>
</b></font>
            </td>
        </tr>
    </table>

    <input name="ip_addr" id="ip_addr" value="<?php echo $_smarty_tpl->tpl_vars['ip_addr']->value;?>
" type="hidden">
    <table width="100%" cellspacing="1" cellpadding="5" border="0">
        <!-- SECTION  START -------------------------->
        <?php
$__section_loop_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['all_ban_account']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_1_total = $__section_loop_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_1_total != 0) {
for ($__section_loop_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_1_iteration <= $__section_loop_1_total; $__section_loop_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_1_iteration;
?>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
        <tr class='table_list_head'  align="center">
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['ip_address'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_level'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['total_recharge'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_time'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['no_banned_time'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_reason'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['operator'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['operating'];?>
<!--<input name="btnUnBanMany" onclick="doUnBanMany();" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['lot_no_banned'];?>
" type="button">--></td>
            <!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['select'];?>
</td>-->
        </tr>
        <?php }?>

        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
        <tr class='trEven'  align="center">
            <?php } else { ?>
        <tr class='trOdd'  align="center">
            <?php }?>
            <td>
                <input name="unBan[<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][role_id]" value="<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>

            </td>
            <td>
                <input name="unBan[<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][role_name]" value="<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>

            </td>
            <td>
                <input name="unBan[<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
][account_name]" value="<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
" type="hidden">
                <?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_ip'];?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['pay_all'];?>

            </td>
            <td>
                <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['start_time'],"%Y-%m-%d %H:%M:%S");?>

            </td>
            <td>
                <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['end_time'],"%Y-%m-%d %H:%M:%S");?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['ban_reason'];?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['admin'];?>

            </td>
            <td>
                <input name="btnUnBan" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['no_banned'];?>
" onclick="doUnBan('<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
','<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
');" type="button">
            </td>
            <!--<td>
                <input name="unBan_check[]" class="unBan_check" value="<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
" type="checkbox">
            </td>-->
        </tr>
        <?php }} else {
 ?>
        <?php
}
if ($__section_loop_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_1_saved;
}
?>
        <!-- SECTION  END -------------------------->
    </table>
    <input name="unBanRoleID" id="unBanRoleID" value="" type="hidden">
    <input name="unBanAccountName" id="unBanAccountName" value="" type="hidden">
    <?php }?>
</form>

<table width="100%" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
    <tr bgcolor="#E5F9FF">
        <td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
            <font color="#666600" class="STYLE2"><b>::封禁历史</b></font>
        </td>
    </tr>
</table>
<table width="100%" cellspacing="1" cellpadding="5" border="0">
    <!-- SECTION  START -------------------------->
    <?php
$__section_loop_2_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['get_ban_h']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_2_total = $__section_loop_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_2_total != 0) {
for ($__section_loop_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_2_iteration <= $__section_loop_2_total; $__section_loop_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_2_iteration;
?>
    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
    <tr class='table_list_head'  align="center">
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['ip_address'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_level'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['total_recharge'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['banned_time'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['no_banned_time'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['banned_reason'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['operator'];?>
</td>
        <!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['operating'];?>
<input name="btnUnBanMany" onclick="doUnBanMany();" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['lot_no_banned'];?>
" type="button"></td>-->
        <!--<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['select'];?>
</td>-->
    </tr>
    <?php }?>

    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
    <tr class='trEven'  align="center">
        <?php } else { ?>
    <tr class='trOdd'  align="center">
        <?php }?>
        <td>
            <?php echo $_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>

        </td>
        <td>
            <?php echo $_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_name'];?>

        </td>
        <td>
            <?php echo $_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>

        </td>
        <td>
            <?php echo $_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['last_login_ip'];?>

        </td>
        <td>
            <?php echo $_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['level'];?>

        </td>
        <td>
            <?php echo $_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['pay_all'];?>

        </td>
        <td>
            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['start_time'],"%Y-%m-%d %H:%M:%S");?>

        </td>
        <td>
            <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['end_time'],"%Y-%m-%d %H:%M:%S");?>

        </td>
        <td>
            <?php echo $_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['ban_reason'];?>

        </td>
        <td>
            <?php echo $_smarty_tpl->tpl_vars['get_ban_h']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['admin'];?>

        </td>
    <!--<td>
        <input name="btnUnBan" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['no_banned'];?>
" onclick="doUnBan('<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
','<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['account_name'];?>
');" type="button">
    </td>
    <td>
    <input name="unBan_check[]" class="unBan_check" value="<?php echo $_smarty_tpl->tpl_vars['all_ban_account']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['role_id'];?>
" type="checkbox">
    </td>-->
    </tr>
    <?php }} else {
 ?>
    <?php
}
if ($__section_loop_2_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = $__section_loop_2_saved;
}
?>
    <!-- SECTION  END -------------------------->
</table>

</body>
</html>
<?php }
}
