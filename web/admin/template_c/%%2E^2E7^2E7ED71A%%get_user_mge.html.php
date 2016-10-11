<?php /* Smarty version 2.6.25, created on 2016-05-21 11:25:22
         compiled from module/account/get_user_mge.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'module/account/get_user_mge.html', 131, false),array('modifier', 'date_format', 'module/account/get_user_mge.html', 191, false),array('function', 'html_options', 'module/account/get_user_mge.html', 219, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['player_data_view']; ?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<style type="text/css">

#all {text-align:left;margin-left:4px; line-height:1;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}

</style>
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript">
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
			alert("<?php echo $this->_tpl_vars['_lang']['new']['banned_js1']; ?>
");
		}else if($.trim( $("#ban_time").val() ) == "null" ){
			alert("<?php echo $this->_tpl_vars['_lang']['new']['banned_js2']; ?>
");
		}else{
			yes = confirm("<?php echo $this->_tpl_vars['_lang']['new']['banned_js3']; ?>
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
            yes = confirm("<?php echo $this->_tpl_vars['_lang']['new']['banned_js10']; ?>
");
            if(yes){
                $("#frmBan").attr("action","?action=doUnBan");
                $("#frmBan").submit();
            }
        }
    }

</script>
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
	<li id="closeReason"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['close']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['about_steal_account']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['irregularities']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['spreading_false_information']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['fake_GM']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['use_third_party_software']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['use_forbid_rolename']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['illegal_transactions']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['use_bug']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['use_forbid_rolename']; ?>
</a></li>
    <li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['abuse_others']; ?>
</a></li>
</ul>
</head>

<body>
	<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['data_analysis']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['player_data_view']; ?>
</div>
	<form action="?action=search" id="frm" method="POST" >
        <table cellspacing="1" cellpadding="5" class="SumDataGrid" width="800">
            <tr>
                <td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
：</td>
                <td><input type="text" name="role_id" id="role_id" value="<?php echo $this->_tpl_vars['search_role_id']; ?>
" /></td>
                <td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
：</td>
                <td><input type="text" name="role_name" id="role_name" value="<?php echo $this->_tpl_vars['search_role_name']; ?>
" /></td>
                <td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
：</td>
                <td><input type="text" name="account_name" id="account_name" value="<?php echo $this->_tpl_vars['search_account_name']; ?>
" /></td>
                <td><input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"/></td>
            </tr>
        </table>
	    <br>
	</form>
    <?php if (count($this->_tpl_vars['role_result']) != 0): ?>
    <table class='paystat' style="width:55%">
        <tr class='table_list_head'>
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['conmoon']['operating']; ?>
</td>
        </tr>
        <?php $_from = ($this->_tpl_vars['role_result']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['roleData']):
?>
        <tr class="trOdd">
            <td><?php echo $this->_tpl_vars['roleData']['role_id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['roleData']['role_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['roleData']['account_name']; ?>
</td>
            <td><a href="?action=search&type=continue&role_id=<?php echo $this->_tpl_vars['roleData']['role_id']; ?>
&role_name=<?php echo $this->_tpl_vars['roleData']['role_name']; ?>
&search_role_id=<?php echo $this->_tpl_vars['search_role_id']; ?>
&search_role_name=<?php echo $this->_tpl_vars['search_role_name']; ?>
&search_account_name=<?php echo $this->_tpl_vars['search_account_name']; ?>
">查询</a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <br>
    <?php endif; ?>
    <!--
    <form action="?action=kill" method="post">
        <?php $_from = ($this->_tpl_vars['role']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userData']):
?>
        <input name="role_id" type="hidden" value="<?php echo $this->_tpl_vars['userData']['role_id']; ?>
" >
        <input name="role_name" type="hidden" value="<?php echo $this->_tpl_vars['userData']['role_name']; ?>
" >
        <input name="account_name" type="hidden" value="<?php echo $this->_tpl_vars['userData']['account_name']; ?>
" >
        <?php endforeach; endif; unset($_from); ?>
        <table width="800s"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
            <tr bgcolor="#A5D0F1" align="left">
                <td><b>::<?php echo $this->_tpl_vars['_lang']['left']['user_manage']; ?>
</b><font color="red">（<?php echo $this->_tpl_vars['_lang']['left']['player_data_view_note']; ?>
）</font></td>
            </tr>
            <tr bgcolor="#FFFFFF">
                <td width="70%">
                    <input type="radio" name="action_type" value = "kill_role"><?php echo $this->_tpl_vars['_lang']['left']['kick_user_offline']; ?>

                    <!--<input type="radio" name="action_type" value = "kill_role_utill">封玩家帐号<input type="text" name="ban_time" value = "30" size=12>分钟
                    <input type="radio" name="action_type" value = "stop_chat"><?php echo $this->_tpl_vars['_lang']['left']['gag']; ?>

                    <input type="text" name="chat_time" value = "60" size=12><?php echo $this->_tpl_vars['_lang']['conmon']['minute']; ?>

                </td>
                <td width="30%"><input type="submit" value="<?php echo $this->_tpl_vars['_lang']['left']['submit']; ?>
"></td>
            </tr>
        </table>                    
    </form>
    <br>
    <form action="?action=doBan" method="POST" id="frmBan">
        <table width="800s" cellspacing="1" cellpadding="5" border="0">
            <tr bgcolor="#A5D0F1" align="left"><td colspan="5">
                    <b>::<?php echo $this->_tpl_vars['_lang']['left']['banned_account']; ?>
+<?php echo $this->_tpl_vars['_lang']['left']['gag']; ?>
</b>
                </td>
            </tr>
            <?php if ($this->_tpl_vars['ban_account']): ?>
			<tr class='table_list_head'  align="center">				
				<td><?php echo $this->_tpl_vars['_lang']['new']['banned_time']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['new']['no_banned_time']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['banned_reason']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['new']['operator']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['conmon']['operating']; ?>
</td>
			</tr>
            <tr class='trOdd'  align="center">
                <input name="role_id" value="<?php echo $this->_tpl_vars['ban_account']['role_id']; ?>
" type="hidden">
                <input name="role_name" value="<?php echo $this->_tpl_vars['ban_account']['role_name']; ?>
" type="hidden">
                <input name="account_name" value="<?php echo $this->_tpl_vars['ban_account']['account_name']; ?>
" type="hidden">
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ban_account']['start_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['ban_account']['end_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
                <td><?php echo $this->_tpl_vars['ban_account']['ban_reason']; ?>
</td>
                <td><?php echo $this->_tpl_vars['ban_account']['admin']; ?>
</td>
                <td><input name="btnUnBan" value="<?php echo $this->_tpl_vars['_lang']['new']['no_banned']; ?>
" onclick="doUnBan('<?php echo $this->_tpl_vars['ban_account']['role_id']; ?>
','<?php echo $this->_tpl_vars['ban_account']['account_name']; ?>
');" type="button"></td>
            </tr>
            <?php else: ?>
			<tr class='table_list_head'  align="center">
				<!--<td><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
</td>-->
				<!--<td><?php echo $this->_tpl_vars['_lang']['left']['ip_address']; ?>
</td>-->
				<!--<td><?php echo $this->_tpl_vars['_lang']['conmon']['role_level']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['total_recharge']; ?>
</td>-->
				<!--<td><?php echo $this->_tpl_vars['_lang']['left']['statu']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['new']['banned_time_long']; ?>
</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['banned_reason']; ?>
</td>
                <td width="20%"><?php echo $this->_tpl_vars['_lang']['conmon']['operating']; ?>
</td>
			</tr>
            <tr class='trOdd'  align="center">
                <input name="role_id" value="<?php echo $this->_tpl_vars['account']['role_id']; ?>
" type="hidden">
                <input name="role_name" value="<?php echo $this->_tpl_vars['account']['role_name']; ?>
" type="hidden">
                <input name="account_name" value="<?php echo $this->_tpl_vars['account']['account_name']; ?>
" type="hidden">
                <input name="pay_all" value="<?php echo $this->_tpl_vars['account']['pay']; ?>
" type="hidden">
                <td><input name="last_login_ip" value="<?php echo $this->_tpl_vars['account']['last_login_ip']; ?>
" type="hidden"><?php echo $this->_tpl_vars['account']['last_login_ip']; ?>
</td>
                <td><input name="is_online" value="<?php echo $this->_tpl_vars['account']['is_online']; ?>
" type="hidden"><?php if ($this->_tpl_vars['account']['is_online'] == 1): ?><font color="#0000FF"><?php echo $this->_tpl_vars['_lang']['conmon']['online']; ?>
</font><?php else: ?><?php echo $this->_tpl_vars['_lang']['new']['offline']; ?>
<?php endif; ?></td>
                <td>
                    <select name="ban_time" id="ban_time">
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['ban_time_option'],'selected' => $this->_tpl_vars['ban_time']), $this);?>

                    </select>
                </td>
                <td><input class="ban_reason" name="ban_reason" id="ban_reason" size="40" type="text"></td>
                <td><input name="btnBan" onclick="doBanOne('<?php echo $this->_tpl_vars['account']['role_id']; ?>
');" value="<?php echo $this->_tpl_vars['_lang']['left']['banned']; ?>
" type="button"></td>
			</tr>
       		<?php endif; ?>
        </table>
    </form>
	<br>-->

	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr align="left">
			<td><b><?php echo $this->_tpl_vars['_lang']['left']['user_info']; ?>
</b></td>
		</tr>
		<tr class='table_list_head'>
			<td><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
</td><!-- 角色ID -->
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
</td><!-- 账号名 -->
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
</td><!-- 角色名 -->

            <td><?php echo $this->_tpl_vars['_lang']['conmon']['career']; ?>
</td><!-- 新增 职业-->

            <td><?php echo $this->_tpl_vars['_lang']['left']['sex']; ?>
</td><!-- 性别 -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['martial_art']; ?>
</td><!-- 国家 -->

            <td><?php echo $this->_tpl_vars['_lang']['conmon']['family']; ?>
</td><!-- 新增 家族-->
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['vip']; ?>
</td> <!-- 新增 vip-->
            <td><?php echo $this->_tpl_vars['_lang']['left']['suicide']; ?>
</td> <!--新增 转生-->

			<td><?php echo $this->_tpl_vars['_lang']['conmon']['role_level']; ?>
</td><!-- 角色等级 -->

            <td><?php echo $this->_tpl_vars['_lang']['left']['rank']; ?>
</td><!--新增 军衔-->
            <td><?php echo $this->_tpl_vars['_lang']['left']['map']; ?>
</td><!--新增 所在地图 -->

            <td><?php echo $this->_tpl_vars['_lang']['left']['statu']; ?>
</td><!-- 状态 -->
        </tr>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['role']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
        <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
        <tr class='trEven'>
        <?php else: ?>
        <tr class='trOdd'>
        <?php endif; ?>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['role_id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['account_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['role_name']; ?>
</td>
            <td>
                <?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['class_id'] == 1): ?>
                <?php echo $this->_tpl_vars['_lang']['left']['mengjiang']; ?>

                <?php elseif ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['class_id'] == 2): ?>
                <?php echo $this->_tpl_vars['_lang']['left']['moushi']; ?>

                <?php elseif ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['class_id'] == 3): ?>
                <?php echo $this->_tpl_vars['_lang']['left']['fangshi']; ?>

                <?php endif; ?>
            </td>

            <?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['sex'] == 1): ?>
            <td><?php echo $this->_tpl_vars['_lang']['new']['man']; ?>
</td>
            <?php else: ?>
            <td><?php echo $this->_tpl_vars['_lang']['new']['woman']; ?>
</td>
            <?php endif; ?>

            <?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['faction_id'] == 1): ?>
            <td><?php echo $this->_tpl_vars['_lang']['left']['tiandao']; ?>
</td>
            <?php elseif ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['faction_id'] == 2): ?>
            <td><?php echo $this->_tpl_vars['_lang']['left']['yijian']; ?>
</td>
            <?php elseif ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['faction_id'] == 3): ?>
            <td><?php echo $this->_tpl_vars['_lang']['left']['yinkui']; ?>
</td>
            <?php else: ?>
            <td><?php echo $this->_tpl_vars['_lang']['left']['cihang']; ?>
</td>
            <?php endif; ?>

            <td>
                <?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['family_name']): ?>
                <?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['family_name']; ?>

                <?php else: ?>
                暂无家族
                <?php endif; ?>    
            </td>
            <!-- <td>
                <?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['family_name']): ?>
                    <?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['family_name']; ?>

                <?php else: ?>
                    null
                <?php endif; ?>
            </td> -->
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['vip_level']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['reincarnation']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['level']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['militaryranks']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['map']; ?>
</td>
            <!--<td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['create_time']; ?>
</td>
            <td><?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['is_online'] == 1): ?><font color="#0000FF">0</font><?php else: ?><?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['left_day'] >= 3): ?><font color="red"><?php endif; ?><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['left_day']; ?>
天<?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['left_h_m']; ?>
<?php endif; ?></td>

            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['gongxun']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['exp']; ?>
</td>-->
            <td><?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['is_online'] == 1): ?><font color="red"><?php echo $this->_tpl_vars['_lang']['conmon']['online']; ?>
<font><?php else: ?><?php echo $this->_tpl_vars['_lang']['new']['offline']; ?>
<?php endif; ?></td>
        </tr>
        <?php endfor; endif; ?>
    </table>
    <br>
    <table  width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr class='table_list_head'>
            <td><?php echo $this->_tpl_vars['_lang']['left']['rechenge_sum']; ?>
</td><!--新增 累积充值元宝 -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['sycee']; ?>
</td><!-- 新增 当前元宝 -->
            <td><?php echo $this->_tpl_vars['_lang']['new']['bind_gold']; ?>
</td> <!--新增 礼金 -->
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['silver']; ?>
</td><!-- 银两 -->
            <td><?php echo $this->_tpl_vars['_lang']['new']['remain_bind_silver']; ?>
</td><!--新增 remain_bind_silver -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['vigour']; ?>
</td><!--新增 元气 -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['courage']; ?>
</td><!--新增 魄力 -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['GOVCR']; ?>
</td><!--新增 国家贡献 -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['prestige']; ?>
</td><!-- 功勋 -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['honor']; ?>
</td><!--新增 荣誉值-->
            <td><?php echo $this->_tpl_vars['_lang']['left']['pk']; ?>
</td><!--新增 pk值 -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['experience']; ?>
</td><!-- 经验 -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['up_experience']; ?>
</td><!-- 升级经验 -->
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['registered_time']; ?>
</td><!-- 注册时间 -->
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['last_log_time']; ?>
</td><!--新增 最后登录时间 -->
            <!--<td><?php echo $this->_tpl_vars['_lang']['left']['register_ip']; ?>
</td><!--新增 注册IP-->
            <td><?php echo $this->_tpl_vars['_lang']['conmon']['last_login_ip']; ?>
</td><!-- 最后登录IP -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['offline_time']; ?>
</td><!-- 离线时长 -->
        </tr>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['role']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
        <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
        <tr class='trEven'>
            <?php else: ?>
        <tr class='trOdd'>
            <?php endif; ?>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['pay_gold']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['gold']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['gold_bind']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['silver']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['silver_bind']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['vitality']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['soul']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['jungong']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['exploit']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['honor']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['pk_points']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['exp']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['next_level_exp']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['create_time']; ?>
</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['role'][$this->_sections['loop']['index']]['last_login_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')); ?>
</td>
            <!--<td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['login_ip']; ?>
</td>-->
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['last_login_ip']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['left_day']; ?>
天<?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['left_h_m']; ?>
</td>
        <!--
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['role_id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['role_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['account_name']; ?>
</td>
            <td><?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['is_online'] == 1): ?><font color="red"><?php echo $this->_tpl_vars['_lang']['conmon']['online']; ?>
<font><?php else: ?><?php echo $this->_tpl_vars['_lang']['new']['offline']; ?>
<?php endif; ?></td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['level']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['gold']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['gold_bind']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['silver']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['last_login_ip']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['create_time']; ?>
</td>
            <td><?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['is_online'] == 1): ?><font color="#0000FF">0</font><?php else: ?><?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['left_day'] >= 3): ?><font color="red"><?php endif; ?><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['left_day']; ?>
天<?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['left_h_m']; ?>
<?php endif; ?></td>
            <?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['sex'] == 1): ?>
            <td><?php echo $this->_tpl_vars['_lang']['new']['man']; ?>
</td>
            <?php else: ?>
            <td><?php echo $this->_tpl_vars['_lang']['new']['woman']; ?>
</td>
            <?php endif; ?>
            <?php if ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['faction_id'] == 1): ?>
            <td><?php echo $this->_tpl_vars['_lang']['left']['tiandao']; ?>
</td>
            <?php elseif ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['faction_id'] == 2): ?>
            <td><?php echo $this->_tpl_vars['_lang']['left']['yijian']; ?>
</td>
            <?php elseif ($this->_tpl_vars['role'][$this->_sections['loop']['index']]['faction_id'] == 3): ?>
            <td><?php echo $this->_tpl_vars['_lang']['left']['yinkui']; ?>
</td>
            <?php else: ?>
            <td><?php echo $this->_tpl_vars['_lang']['left']['cihang']; ?>
</td>
            <?php endif; ?>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['family_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['gongxun']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['exp']; ?>
</td>
            <td><?php echo $this->_tpl_vars['role'][$this->_sections['loop']['index']]['next_level_exp']; ?>
</td>
        -->
        </tr>
        <?php endfor; endif; ?>

    </table>
    <!--<br>
    <table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
        	<td><b>::<?php echo $this->_tpl_vars['_lang']['left']['user_mounts_info']; ?>
</b></td>
        </tr>
		     <tr class='table_list_head'>
                <!--  <td>物品id</td>
				<td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_id']; ?>
</td>
                <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_name']; ?>
</td>
                <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_type']; ?>
</td>
                <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_color']; ?>
</td>
                <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_timetype']; ?>
</td>
                <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_time']; ?>
</td>
                <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_level']; ?>
</td>
                <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_class']; ?>
</td>
             </tr>
             <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['mounts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
                    <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
					<tr class='trEven'>
					<?php else: ?>
					<tr class='trOdd'>
					<?php endif; ?>
                            <td><?php echo $this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['typeid']; ?>
</td>
                        	<td><?php echo $this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['name']; ?>
</td>
                            <td><?php if ($this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['endurance'] == 1): ?><?php echo $this->_tpl_vars['_lang']['left']['mountsment_zhu']; ?>
<?php else: ?><?php echo $this->_tpl_vars['_lang']['left']['mountsment_pi']; ?>
<?php endif; ?></td>
                        	<?php if ($this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['color'] == 1): ?><td><?php echo $this->_tpl_vars['_lang']['new']['white']; ?>
</td>
							<?php elseif ($this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['color'] == 2): ?><td><?php echo $this->_tpl_vars['_lang']['new']['green']; ?>
</td>
							<?php elseif ($this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['color'] == 3): ?><td><?php echo $this->_tpl_vars['_lang']['new']['blue']; ?>
</td>
							<?php elseif ($this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['color'] == 4): ?><td><?php echo $this->_tpl_vars['_lang']['new']['purple']; ?>
</td>
							<?php else: ?><td><?php echo $this->_tpl_vars['_lang']['new']['orange']; ?>
</td>
                            <?php endif; ?>
                            <?php if ($this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['cur_endu'] == 0): ?>
                            <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_yongjiu']; ?>
</td>
                            <td>0</td>
                            <?php elseif ($this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['cur_endu'] == 1): ?>
                            <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_riqi']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['equips'][$this->_sections['loop']['index']]['end_time']; ?>
</td>
                            <?php else: ?>
                            <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_shixian']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['end_time']; ?>
</td>
                            <?php endif; ?>
                            <td><?php echo $this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['level']; ?>
</td>
                            <td><?php echo $this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['class_level']; ?>
</td>
                  </tr>
             <?php endfor; endif; ?>
    </table>
    -->
    <br>
    <!-- 装备 -->
    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
			 <tr align="left">
				<td><b><?php echo $this->_tpl_vars['_lang']['left']['user_equipment_info']; ?>
</b></td>
			 </tr>
		     <tr class='table_list_head'>
                <!--  <td>物品id</td> -->
				<td><?php echo $this->_tpl_vars['_lang']['left']['equipment_id']; ?>
</td><!-- 装备ID -->
                <td><?php echo $this->_tpl_vars['_lang']['left']['equipment_name']; ?>
</td><!-- 装备名称 -->
                 <td><?php echo $this->_tpl_vars['_lang']['left']['equipment_num']; ?>
</td><!-- 装备等级 -->
                <td><?php echo $this->_tpl_vars['_lang']['left']['rein_num']; ?>
</td><!-- 强化等级 -->
                <!--<td><?php echo $this->_tpl_vars['_lang']['left']['star_num']; ?>
</td><!-- 强化星数 -->
                 <!--<td><?php echo $this->_tpl_vars['_lang']['left']['hole_num']; ?>
</td><!-- 装备孔数 -->
                 <!--<td><?php echo $this->_tpl_vars['_lang']['left']['gemstone']; ?>
</td><!-- 灵石 -->
                 <!--<td><?php echo $this->_tpl_vars['_lang']['left']['is_band']; ?>
</td><!-- 是否绑定 -->
             </tr>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['equips']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
        <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
        <tr class='trEven'>
        <?php else: ?>
        <tr class='trOdd'>
        <?php endif; ?>
           <!--  <td><?php echo $this->_tpl_vars['equips'][$this->_sections['loop']['index']]['id']; ?>
</td> -->
            <td><?php echo $this->_tpl_vars['equips'][$this->_sections['loop']['index']]['typeid']; ?>
</td>
            <td><?php echo $this->_tpl_vars['equips'][$this->_sections['loop']['index']]['name']; ?>
</td>
            <td>穿戴等级:<?php echo $this->_tpl_vars['equips'][$this->_sections['loop']['index']]['min_level']; ?>
(转生等级:<?php echo $this->_tpl_vars['equips'][$this->_sections['loop']['index']]['reincarnation']; ?>
)</td>
            <td><?php echo $this->_tpl_vars['equips'][$this->_sections['loop']['index']]['reinforce']; ?>
</td>
        </tr>
        <?php endfor; endif; ?>
    </table>
    <br>

    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
            <!--<td><b><?php echo $this->_tpl_vars['_lang']['left']['user_props_info']; ?>
</b></td><!-- 背包物品 -->
        	<td><b><?php echo $this->_tpl_vars['_lang']['left']['bag_goods']; ?>
</b></td><!-- 背包物品 -->
        </tr>
        <tr class='table_list_head'>
            <!-- <td>物品id</td> -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['goods_id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['goods_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['goods_num']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['is_band']; ?>
</td>
        </tr>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['goods']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
        <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
        <tr class='trEven'>
        <?php else: ?>
        <tr class='trOdd'>
        <?php endif; ?>
            <!-- <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['id']; ?>
</td> -->
            <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['typeid']; ?>
</td>
            <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['name']; ?>
</td>
            <td>
                <?php if ($this->_tpl_vars['goods'][$this->_sections['loop']['index']]['current_num']): ?>
                <?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['current_num']; ?>

                <?php else: ?>
                1
                <?php endif; ?>
            </td>
            <td>
            	<?php if ($this->_tpl_vars['goods'][$this->_sections['loop']['index']]['bind'] == 1): ?>
                	<?php echo $this->_tpl_vars['_lang']['left']['bind']; ?>

                <?php else: ?>
                	<?php echo $this->_tpl_vars['_lang']['new']['tradable']; ?>

                <?php endif; ?>
            </td>
        </tr>
        <?php endfor; endif; ?>
    </table>
    <br>



    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
            <!--<td><b><?php echo $this->_tpl_vars['_lang']['left']['user_props_info']; ?>
</b></td><!-- 背包物品 -->
            <td><b><?php echo $this->_tpl_vars['_lang']['left']['warehouse_goods']; ?>
</b></td><!-- 背包物品 -->
        </tr>
        <tr class='table_list_head'>
            <!-- <td>物品id</td> -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['goods_id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['goods_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['goods_num']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['is_band']; ?>
</td>
        </tr>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['depot']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
        <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
        <tr class='trEven'>
            <?php else: ?>
        <tr class='trOdd'>
            <?php endif; ?>
            <!-- <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['id']; ?>
</td> -->
            <td><?php echo $this->_tpl_vars['depot'][$this->_sections['loop']['index']]['typeid']; ?>
</td>
            <td><?php echo $this->_tpl_vars['depot'][$this->_sections['loop']['index']]['name']; ?>
</td>
            <td>
                <?php if ($this->_tpl_vars['depot'][$this->_sections['loop']['index']]['current_num']): ?>
                <?php echo $this->_tpl_vars['depot'][$this->_sections['loop']['index']]['current_num']; ?>

                <?php else: ?>
                1
                <?php endif; ?>
            </td>
            <td>
                <?php if ($this->_tpl_vars['depot'][$this->_sections['loop']['index']]['bind'] == 1): ?>
                <?php echo $this->_tpl_vars['_lang']['left']['bind']; ?>

                <?php else: ?>
                <?php echo $this->_tpl_vars['_lang']['new']['tradable']; ?>

                <?php endif; ?>
            </td>
        </tr>
        <?php endfor; endif; ?>
    </table>
    <br>
<!--
    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
        	<td><b><?php echo $this->_tpl_vars['_lang']['left']['warehouse_goods']; ?>
</b></td>
        </tr>
        <tr class='table_list_head'>
            <td><?php echo $this->_tpl_vars['_lang']['left']['goods_id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['goods_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['goods_num']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['is_band']; ?>
</td>
        </tr>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['goods']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
        <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
        <tr class='trEven'>
        <?php else: ?>
        <tr class='trOdd'>
        <?php endif; ?>
            <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['typeid']; ?>
</td>
            <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['current_num']; ?>
</td>
            <td>
            	<?php if ($this->_tpl_vars['goods'][$this->_sections['loop']['index']]['bind'] == 1): ?>
                	<?php echo $this->_tpl_vars['_lang']['left']['bind']; ?>

                <?php else: ?>
                	<?php echo $this->_tpl_vars['_lang']['new']['tradable']; ?>

                <?php endif; ?>
            </td>
        </tr>
        <?php endfor; endif; ?>
    </table>
    <br>
-->

<!--
    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
        	<td><b><?php echo $this->_tpl_vars['_lang']['left']['inlay_gem']; ?>
</b></td>
        </tr>
        <tr class='table_list_head'>
            <td><?php echo $this->_tpl_vars['_lang']['left']['inlay_part']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['gemID']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['gem_name']; ?>
</td>
        </tr>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['goods']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
        <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
        <tr class='trEven'>
        <?php else: ?>
        <tr class='trOdd'>
        <?php endif; ?>
            <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['typeid']; ?>
</td>
            <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['goods'][$this->_sections['loop']['index']]['current_num']; ?>
</td>
            <td>
            	<?php if ($this->_tpl_vars['goods'][$this->_sections['loop']['index']]['bind'] == 1): ?>
                	<?php echo $this->_tpl_vars['_lang']['left']['bind']; ?>

                <?php else: ?>
                	<?php echo $this->_tpl_vars['_lang']['new']['tradable']; ?>

                <?php endif; ?>
            </td>
        </tr>
        <?php endfor; endif; ?>
    </table>
-->

    <table width="50%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr align="left">
            <td><b><?php echo $this->_tpl_vars['_lang']['left']['user_mounts_info']; ?>
</b></td><!-- 坐骑信息 -->
        </tr>
        <tr class='table_list_head'>
            <!-- <td>物品id</td> -->
            <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_level']; ?>
</td>
            <td><?php echo $this->_tpl_vars['_lang']['left']['mountsment_class']; ?>
</td>
          <!--  <td><?php echo $this->_tpl_vars['_lang']['left']['is_band']; ?>
</td>-->
        </tr>
        <?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['mounts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
        <?php if ($this->_sections['loop']['rownum'] % 2 == 0): ?>
        <tr class='trEven'>
        <?php else: ?>
        <tr class='trOdd'>
        <?php endif; ?>
            <td><?php echo $this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['star_level']; ?>
</td>
            <td><?php echo $this->_tpl_vars['mounts'][$this->_sections['loop']['index']]['step_level']; ?>
</td>
        </tr>
        <?php endfor; endif; ?>
    </table>
</body>
</html>