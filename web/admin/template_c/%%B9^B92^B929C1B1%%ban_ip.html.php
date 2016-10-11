<?php /* Smarty version 2.6.25, created on 2016-05-21 14:56:02
         compiled from module/gm/ban_ip.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'module/gm/ban_ip.html', 164, false),array('modifier', 'date_format', 'module/gm/ban_ip.html', 181, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script language="javascript">
	$(document).ready(function(){
		$("#btnAdd").click(function(){
			var flag = true;
			if("" == $.trim( $("#ip").val() )){
				alert("<?php echo $this->_tpl_vars['_lang']['new']['banned_ip_js1']; ?>
");
				flag = false;
			}else if("null" == $.trim( $("#ban_time").val())){
				alert("<?php echo $this->_tpl_vars['_lang']['new']['banned_ip_js2']; ?>
");
				flag = false;
			}
			else if("" == $.trim( $("#ban_reason").val() )){
				alert("<?php echo $this->_tpl_vars['_lang']['new']['banned_ip_js3']; ?>
");
				flag = false;
			}
			if(flag){
				yes = confirm("<?php echo $this->_tpl_vars['_lang']['new']['banned_ip_js4']; ?>
");
				if(yes){
					$("#frmBan").submit();
				}
			}
		});

		$("#btnChkOnline").click(function(){
			if("" == $.trim( $("#ip").val() )){
				alert("<?php echo $this->_tpl_vars['_lang']['new']['banned_ip_js1']; ?>
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
<script language="javascript">
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
</script>
<title>
	<?php echo $this->_tpl_vars['_lang']['left']['banned_ip']; ?>

</title>
</head>

<body>
<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['gm_manage']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['banned_ip']; ?>
</div>

<table width="1000" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr bgcolor="#E5F9FF">
		<td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
			<font color="#666600" class="STYLE2"><b>::<?php echo $this->_tpl_vars['_lang']['left']['banned_ip_attention']; ?>
</b></font>
		</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><?php echo $this->_tpl_vars['_lang']['left']['banned_ip_attention_1']; ?>
</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><?php echo $this->_tpl_vars['_lang']['left']['banned_ip_attention_2']; ?>
</td>
	</tr>
	<tr bgcolor="#E5F9FF" align="left">
		<td><font color="Red"><b><?php echo $this->_tpl_vars['_lang']['left']['banned_ip_attention_3']; ?>
</b></font></td>
	</tr>
</table>
<br>
<form action="?action=import" id="frmImport" method="POST">
	<table width="1000" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr class="table_list_head" align="left">
			<td width="100%"><input name="btnBanImport" onclick="doImport();" value="<?php echo $this->_tpl_vars['_lang']['left']['banned_ip_attention_4']; ?>
" type="button">
			<font color="red"><?php echo $this->_tpl_vars['_lang']['left']['banned_ip_attention_5']; ?>
</font>
			</td>
		</tr>
	</table>
	<br>
</form>
<?php if ($this->_tpl_vars['online_cnt'] >= 0): ?>
<table width="1000" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr bgcolor="#E5F9FF" align="left">
		<td><font color="Red"><b><?php echo $this->_tpl_vars['_lang']['left']['login_ip_is']; ?>
：<?php echo $this->_tpl_vars['ip']; ?>
 <?php echo $this->_tpl_vars['_lang']['left']['s_online_num']; ?>
：<?php echo $this->_tpl_vars['online_cnt']; ?>
<?php echo $this->_tpl_vars['_lang']['conmon']['ren']; ?>
。</b></font></td>
	</tr>
</table>
<?php endif; ?>
<form action="?action=doBanIp" method="POST" id="frmBan">
<table width="1000" cellspacing="1" cellpadding="5" border="0">
	<tr class='table_list_head'  align="center">
		<td width="15%"><?php echo $this->_tpl_vars['_lang']['left']['ip_address']; ?>
</td>
		<td width="15%"><?php echo $this->_tpl_vars['_lang']['left']['lifted_time']; ?>
</td>
		<td><?php echo $this->_tpl_vars['_lang']['left']['banned_reason']; ?>
</td>
		<td width="20%"><?php echo $this->_tpl_vars['_lang']['conmon']['operating']; ?>
</td>
		<td width="10%"><?php echo $this->_tpl_vars['_lang']['new']['operator']; ?>
</td>
	</tr>
	<tr class='table_list_head'  align="center">
		<td><input name="ip" id="ip" type="text"></td>
		<td><select name="ban_time" id="ban_time"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['ban_time_option'],'selected' => $this->_tpl_vars['ban_time']), $this);?>
</select></td>
		<td><input class="ban_reason" size="30" name="ban_reason" id="ban_reason" type="text"></td>
		<td>
			<input name="btnChkOnline" id="btnChkOnline" value="<?php echo $this->_tpl_vars['_lang']['left']['check_the_IP_online_people']; ?>
" type="button">
			<input name="btnAdd" id="btnAdd" value="<?php echo $this->_tpl_vars['_lang']['left']['banned']; ?>
" type="button">
		</td>
		<td></td>
	</tr>
	<?php if ($this->_tpl_vars['ban_ip_list']): ?>
	<!-- SECTION  START -------------------------->
	<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['ban_ip_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<tr class='trEven'  align="center">
		<?php else: ?>
		<tr class='trOdd'  align="center">
		<?php endif; ?>
			<td><?php echo $this->_tpl_vars['ban_ip_list'][$this->_sections['loop']['index']]['last_login_ip']; ?>
</td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['ban_ip_list'][$this->_sections['loop']['index']]['end_time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
			<td><?php echo $this->_tpl_vars['ban_ip_list'][$this->_sections['loop']['index']]['ban_reason']; ?>
</td>
			<td><input name="btnRemove" value="<?php echo $this->_tpl_vars['_lang']['new']['no_banned']; ?>
" onclick="doRemove('<?php echo $this->_tpl_vars['ban_ip_list'][$this->_sections['loop']['index']]['last_login_ip']; ?>
');" type="button"></td>
			<td><?php echo $this->_tpl_vars['ban_ip_list'][$this->_sections['loop']['index']]['admin']; ?>
</td>
		</tr>
	<?php endfor; else: ?>
	<?php endif; ?>
	<!-- SECTION  END -------------------------->
	<?php endif; ?>
</table>
<input name="unBanIp" id="unBanIp" value="" type="hidden">
</form>


</body>
</html>