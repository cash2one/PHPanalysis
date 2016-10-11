<?php /* Smarty version 2.6.25, created on 2016-05-21 11:23:10
         compiled from module/pay/send_gold.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'module/pay/send_gold.html', 129, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['left']['apply_ingot']; ?>
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
            $("#role_name_list").append('<?php echo $this->_tpl_vars['role_name_list']; ?>
');
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
</script>
<style type="text/css">
	#ulSendGoldReason{
		width:300px;
		margin:0px;
		padding:0px;
		list-style:none;
		background-color:#D9D9D9;
		border:2px solid blue;
		position:absolute;
		display:none;
	}
	#ulSendGoldReason li{
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
<ul id="ulSendGoldReason">
		<li id="closeReason"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['close']; ?>
</a></li>

		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['apply_ingot_note1']; ?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['apply_ingot_note2']; ?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['apply_ingot_note3']; ?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['apply_ingot_note4']; ?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['apply_ingot_note5']; ?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['apply_ingot_note6']; ?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['apply_ingot_note7']; ?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['apply_ingot_note8']; ?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $this->_tpl_vars['_lang']['new']['apply_ingot_note9']; ?>
</a></li>
</ul>
<script language="javascript">
	$(document).ready(function(){
		window.fromInput = null;
		$("#gold_reason").click(function(){
			var offset = $(this).offset();
			window.fromInput = $(this);
			$("#ulSendGoldReason").css("top",offset.top+20).css("left",offset.left);
			$("#ulSendGoldReason").show();
		});
		$("#closeReason").click(function(){
			$("#ulSendGoldReason").hide();
		});
		$(".reasonItem").click(function(){
			window.fromInput.val($(this).find("a").text());
			$("#ulSendGoldReason").hide();
			return false;
		});
		$("#gold_reason").keydown(function(){
			$("#ulSendGoldReason").hide();
		});
	});

</script>

</head>

<body>
	<div id="position"><?php echo $this->_tpl_vars['_lang']['left']['recharge_consumption']; ?>
：<?php echo $this->_tpl_vars['_lang']['left']['apply_ingot']; ?>
</div>

	<!--
	<form action="?action=search" id="frm" method="POST" >
	<table cellspacing="1" cellpadding="5" class="SumDataGrid" width="800">
		<tr>
			<td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
：</td>
			<td><input type="text" name="role_id" id="role_id" value="<?php echo $this->_tpl_vars['role']['role_id']; ?>
" /></td>
			<td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
：</td>
			<td><input type="text" name="role_name" id="role_name" value="<?php echo $this->_tpl_vars['role']['role_name']; ?>
" /></td>
			<td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
：</td>
			<td><input type="text" name="account_name" id="account_name" value="<?php echo $this->_tpl_vars['role']['account_name']; ?>
" /></td>
			<td><input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"/></td>
			<td><input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"/></td>
		</tr>
	</table>
	<br>
	</form>
        -->

    <form action="?action=search&role_name_list=<?php echo $this->_tpl_vars['role_name_list']; ?>
" id="frm" method="POST" >
		<table cellspacing="1" cellpadding="5" class="SumDataGrid" width="800">
			<tr>
				<td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['user_id']; ?>
：</td>
				<td><input type="text" name="role_id" id="role_id" value="<?php echo $this->_tpl_vars['role']['role_id']; ?>
" /></td>
				<td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['role_name']; ?>
：</td>
				<td><input type="text" name="role_name" id="role_name" value="<?php echo $this->_tpl_vars['role']['role_name']; ?>
" /></td>
				<td align="right"><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
：</td>
				<input type="hidden" name="role_name_list" value="<?php echo $this->_tpl_vars['role_name_list']; ?>
" id="roleNameList">
				<td><input type="text" name="account_name" id="account_name" value="<?php echo $this->_tpl_vars['role']['account_name']; ?>
" /></td>
				<td><input type="image" name='search' src="<?php echo $this->_tpl_vars['_lang']['new']['search_button']; ?>
" class="input2"/></td>
			</tr>
		</table>
		<br>
	</form>
	<?php if (count($this->_tpl_vars['list']) != 0): ?>
	<table class='paystat' style="width:57%">
		<tr class='table_list_head'>
			<td>角色Id</td>
			<td>角色名</td>
			<td>用户名</td>
			<td>操作</td>
		</tr>
		<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<tr class="trOdd">
			<td><?php echo $this->_tpl_vars['item']['role_id']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['role_name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['account_name']; ?>
</td>
			<td><a class="touch" href="#" type ="<?php echo $this->_tpl_vars['item']['role_name']; ?>
" >添加</a></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
	</table>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".touch").click(function(event){
				var roleName = event.srcElement['type'];
				var listName = $("#roleNameList").attr("value");
				if(listName== ""){
					var roleListName = roleName;
				}else{
					var roleListName = listName + ','+ roleName;
				}
				
				$("#roleNameList").attr('value',roleListName);
				$("#role_name_list").val(roleListName);
			});
			$("#role_name_list").change(function(event){
				var str = event.srcElement['value'];
				$("#roleNameList").attr('value',str);
			});
		});
	</script>
	<?php endif; ?>

	<form action="<?php echo $this->_tpl_vars['URL_SELF']; ?>
?action=send_gold&role_id=<?php echo $this->_tpl_vars['role']['role_id']; ?>
&role_name=<?php echo $this->_tpl_vars['role']['role_name']; ?>
&account_name=<?php echo $this->_tpl_vars['role']['account_name']; ?>
" method="post">
            <table width="800" border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr bgcolor="#E5F9FF">
			<td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
				<font color="#666600" class="STYLE2"><b>::<?php echo $this->_tpl_vars['_lang']['left']['user_role_list']; ?>
</b></font>
			</td>
		</tr>
		<tr bgcolor="#E5F9FF">
			<td align="left">
				<font color="red"><b><?php echo $this->_tpl_vars['_lang']['left']['note']; ?>
1:</b></font>
				<font class="STYLE2"><b><?php echo $this->_tpl_vars['_lang']['left']['apply_silver_note1']; ?>
</b></font>
			</td>
		</tr>
		<tr bgcolor="#E5F9FF">
			<td align="left">
				<font color="red"><b><?php echo $this->_tpl_vars['_lang']['conmon']['user_account']; ?>
<?php echo $this->_tpl_vars['_lang']['left']['note']; ?>
2:</b></font>
				<font class="STYLE2"><b><?php echo $this->_tpl_vars['_lang']['left']['apply_silver_note2']; ?>
</b></font>
			</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td><textarea rows="4" cols="91" id="role_name_list" name="role_name_list"></textarea></td>
		</tr>
            </table>
		<table width="800"  border="1" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
			<tr bgcolor="#E5F9FF">
               <td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
                  <font color="#666600" class="STYLE2"><b>::<?php echo $this->_tpl_vars['_lang']['left']['giving_ingot']; ?>
</b></font>
               </td>
            </tr>
            <tr bgcolor="#FFFFFF">
                <td width="25%" align="right"><?php echo $this->_tpl_vars['_lang']['left']['giving_reasons']; ?>
(<?php echo $this->_tpl_vars['_lang']['left']['no_less_than_5']; ?>
)</td>
                <td width="75%" align="left"><input id="gold_reason" type="text" name="reason" value="" size="50"/></td>
            </tr>
            <tr bgcolor="#FFFFFF">
				<td width="25%" align="right"><?php echo $this->_tpl_vars['_lang']['left']['giving_num']; ?>
(0,100000)</td>
                <td width="75%" align="left">
                <input type="text" name="number" value="" />
                &nbsp;&nbsp;
				<input type="checkbox" name="bind" value="1" />[<?php echo $this->_tpl_vars['_lang']['left']['if_bind']; ?>
]
                </td>
           </tr>
			<tr bgcolor="#FFFFFF">
              <td width="25%"></td>
              <td width="75%" align="left">
              <input type="submit" name="submit" value="<?php echo $this->_tpl_vars['_lang']['left']['sure_giving']; ?>
"/>
			  &nbsp;
              <input type="reset" name="reset" value="<?php echo $this->_tpl_vars['_lang']['left']['modify']; ?>
"/>
              </td>
           </tr>
       </table>
  </form>
</body>
</html>