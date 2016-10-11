<?php
/* Smarty version 3.1.29, created on 2016-08-31 10:55:44
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\pay\send_item.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57c6473083b655_42182016',
  'file_dependency' => 
  array (
    'f5f789e3b768b27a999efa60dd4e629f06a98531' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\pay\\send_item.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57c6473083b655_42182016 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['apply_props'];?>
</title>
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/jquery.ui.autocomplete.css"/>
<style type="text/css">
#all {
	text-align: left;
	margin-left: 4px;
	line-height: 1;
}

#nodes {
	width: 100%;
	float: left;
	border: 1px #ccc solid;
}

#result {
	width: 100%;
	height: 100%;
	clear: both;
	border: 1px #ccc solid;
}
</style>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/ui/jquery.ui.core.js"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/ui/jquery.ui.widget.js"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/ui/jquery.ui.position.js"><?php echo '</script'; ?>
> 
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/ui/jquery.ui.autocomplete.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
	function doAddGoods(){
		$("#frmEvent").attr("action","?action=doAddGoods");
		$("#frmEvent").submit();
	}

	function doRemoveGoods(goods_id){
		$("#frmEvent").attr("action","?action=doRemoveGoods");
		$("#remove_goods_id").val(goods_id);
		$("#frmEvent").submit();
	}
	function doSendGoods(){
		$("#frmEvent").attr("action","?action=doSendGoods");
		$("#frmEvent").submit();
	}

	function doClear(){
		$("#frmEvent").attr("action","?action=doClear");
		$("#frmEvent").submit();
	}
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
$(function(){
	$( "#goods_name" ).autocomplete({
		source: "all_goods_name.php",
		minLength: 2,
		autoFocus: true
	});
});
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
$(document).ready(
	function(){
		$("#role_name_list").append('<?php echo $_smarty_tpl->tpl_vars['role_name_list']->value;?>
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
		$("#item_selected").change(
			function(){	
				obj = document.getElementById("item_fill");
				obj.value="";
			}
		);
		$("#item_fill").focus(
			function(){
				obj = document.getElementById("item_selected");
				obj.options[0].selected = true;
			}
		);
		$("#goods_id").keydown(function(){
			$("#goods_type").val('');
		});
		$("#goods_name").keydown(function(){
			$("#goods_id").val('');
		});
	}
);
<?php echo '</script'; ?>
>

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
		<li id="closeReason"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['close'];?>
</a></li>

		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['apply_item_note1'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['apply_item_note2'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['apply_item_note3'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['apply_item_note4'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['apply_item_note5'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['apply_item_note6'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['apply_item_note7'];?>
</a></li>
		<li class="reasonItem"><a href="javascript:void(0);"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['apply_item_note8'];?>
</a></li>
</ul>

<?php echo '<script'; ?>
 language="javascript">
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
<?php echo '</script'; ?>
>
</head>

<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['recharge_consumption'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['apply_props'];?>
</div>
<form action="?action=search&role_name_list=<?php echo $_smarty_tpl->tpl_vars['role_name_list']->value;?>
" id="frm" method="POST" >
	<table cellspacing="1" cellpadding="5" class="SumDataGrid" width="800">
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
			<input type="hidden" name="role_name_list" value="<?php echo $_smarty_tpl->tpl_vars['role_name_list']->value;?>
" id="roleNameList">
			<td><input type="text" name="account_name" id="account_name" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['account_name'];?>
" /></td>
			<td><input type="image" name='search' src="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['search_button'];?>
" class="input2"/></td>
		</tr>
	</table>
	<br>
</form>

	<?php if (count($_smarty_tpl->tpl_vars['role']->value) != 0) {?>
	<table class='paystat' style="width:57%">
		<tr class='table_list_head'>
			<td>角色Id</td>
			<td>角色名</td>
			<td>用户名</td>
			<td>操作</td>
		</tr>
		<?php
$_from = $_smarty_tpl->tpl_vars['role']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_0_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_0_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
		<tr class="trOdd">
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['role_id'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['role_name'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['item']->value['account_name'];?>
</td>
			<td><a class="touch" href="#" type ="<?php echo $_smarty_tpl->tpl_vars['item']->value['role_name'];?>
" >添加</a></td>
		</tr>
		<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
	</table>
	<?php echo '<script'; ?>
 type="text/javascript">
		$(document).ready(function(){
			$(".touch").click(function(event){
				var roleName = event.srcElement['type'];
				var listName = $("#roleNameList").attr("value");
				if(listName== ""){
					var roleListName = roleName;
				}else{
					var roleListName = listName + ',' + roleName;
				}
				
				$("#roleNameList").attr('value',roleListName);
				$("#role_name_list").val(roleListName);
			});
			$("#role_name_list").change(function(event){
				var str = event.srcElement['value'];
				$("#roleNameList").attr('value',str);
			});
		});
	<?php echo '</script'; ?>
>
	<?php }?>

<form action="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?action=send_item&role_id=<?php echo $_smarty_tpl->tpl_vars['role']->value['role_id'];?>
&role_name=<?php echo $_smarty_tpl->tpl_vars['role']->value['role_name'];?>
&account_name=<?php echo $_smarty_tpl->tpl_vars['role']->value['account_name'];?>
&role_name_list=<?php echo $_smarty_tpl->tpl_vars['role_name_list']->value;?>
" method="post" id="frmEvent">
<table width="800" border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
		<tr bgcolor="#E5F9FF">
			<td colspan="2" background="/web/admin/static/images/wbg.gif" align="left">
				<font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_role_list'];?>
</b></font>&nbsp;&nbsp;&nbsp;&nbsp;<font color="red"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['user_num'];?>
：<?php echo $_smarty_tpl->tpl_vars['role_count']->value;?>
</b></font>
			</td>
		</tr>
		<tr bgcolor="#E5F9FF">
			<td align="left">
				<font color="red"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['note'];?>
1:</b></font>
				<font class="STYLE2"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['apply_silver_note1'];?>
</b></font>
			</td>
		</tr>
		<tr bgcolor="#E5F9FF">
			<td align="left">
				<font color="red"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['note'];?>
2:</b></font>
				<font class="STYLE2"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['apply_silver_note2'];?>
</b></font>
			</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td><textarea rows="4" cols="91" id="role_name_list" name="role_name_list"></textarea></td>
		</tr>
</table>
<table width="800" border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr bgcolor="#E5F9FF">
		<td colspan="8" background="/web/admin/static/images/wbg.gif" align="left"><font color="#666600" class="STYLE2"><b>::<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['giving_props'];?>
</b></font></td>
	</tr>
<!-- 	<tr bgcolor="#E5F9FF">
			<td colspan="8" align="left">
				<font color="red"><b>说明1:</b></font>
				<font class="STYLE2"><b>该版本暂时不能赠送<font color="red">宠物、宝物、宝物部件</font></b></font>
			</td>
		</tr> -->
		<tr bgcolor="#E5F9FF">
			<td colspan="8" align="left">
				<font color="red"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['note'];?>
1:</b></font>
				<font class="STYLE2"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['apply_props_note1'];?>
</b></font>
			</td>
		</tr>
		<tr bgcolor="#E5F9FF">
			<td colspan="8" align="left">
				<font color="red"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['note'];?>
2:</b></font>
				<font class="STYLE2"><b><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['apply_props_note2'];?>
</b></font>
			</td>
		</tr>
	<tr bgcolor="#FFFFFF">
		<!-- 道具id -->
		<td align="right">ID</td>
		<td><input type="text" name="goods_id" id="goods_id" value=""/></td>
		<!-- 道具名 -->
		<td align="right">(<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['or'];?>
)<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['name'];?>
</td>
		<td><input type="text" name="goods_name" id="goods_name" value=""/></td>
		<!-- 分配数量 -->
		<td align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['num'];?>
(<=50)</td>
		<td><input type="text" name="goods_num" id="goods_num" value="" size="7"/></td>
		<td align="center">
			<input type="checkbox" name="goods_bind" value="1" checked="checked" /><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['if_bind_item'];?>

		</td>
		<td align="center"><input name="btnAddGoods" onclick="doAddGoods();" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['add_props'];?>
" type="button"></td>
	</tr>
<table>

<?php if ($_smarty_tpl->tpl_vars['send_goods_data']->value) {?>
<table width="800" cellspacing="1" cellpadding="5" border="0">
	<!-- SECTION  START -------------------------->
	<?php
$__section_loop_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_loop']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop'] : false;
$__section_loop_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['send_goods_data']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_loop_0_total = $__section_loop_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_loop'] = new Smarty_Variable(array());
if ($__section_loop_0_total != 0) {
for ($__section_loop_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] = 0; $__section_loop_0_iteration <= $__section_loop_0_total; $__section_loop_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] = $__section_loop_0_iteration;
?>
		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%20 == 1) {?>
			<tr class='table_list_head'  align="center">
				<td>ID</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['num'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['type'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['is_band'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['operating'];?>
</td>
			</tr>
		<?php }?>

		<?php if ((isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['rownum'] : null)%2 == 0) {?>
		<tr class='trEven'  align="center">
		<?php } else { ?>
		<tr class='trOdd'  align="center">
		<?php }?>
			<td>
				<input name="goods[<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_id'];?>
][goods_id]" value="<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_id'];?>
" type="hidden">
				<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_id'];?>

			</td>
			<td>
				<input name="goods[<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_id'];?>
][goods_name]" value="<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_name'];?>
" type="hidden">
				<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_name'];?>

			</td>
			<td>
				<input name="goods[<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_id'];?>
][goods_num]" value="<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_num'];?>
" type="hidden">
				<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_num'];?>

			</td>
			<td>
				<input name="goods[<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_id'];?>
][goods_type]" value="<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_type'];?>
" type="hidden">
				<?php if ($_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_type'] == 5) {
echo $_smarty_tpl->tpl_vars['_lang']->value['left']['item'];?>

				<?php } elseif ($_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_type'] == 6) {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['gemstone'];?>

				<?php } elseif ($_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_type'] == 7) {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['equip'];?>

				<?php }?>
			</td>
			<td>
				<input name="goods[<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_id'];?>
][goods_bind]" value="<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_bind'];?>
" type="hidden">
				<?php if ($_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_bind'] == "1") {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['yes'];?>

				<?php } elseif ($_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_bind'] == "0") {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['no'];?>

				<?php }?>
			</td>
			<td>
				<input name="btnRemoveGoods" onclick="doRemoveGoods('<?php echo $_smarty_tpl->tpl_vars['send_goods_data']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_loop']->value['index'] : null)]['goods_id'];?>
');" value="移除物品" type="button">
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
</table>
<input name="remove_goods_id" id="remove_goods_id" value="" type="hidden">
<?php }?>

<table width="800" border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
	<tr bgcolor="#FFFFFF">
        <td width="22%" colspan="1" align="right"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['giving_reasons'];?>
(<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['no_less_than_5'];?>
)</td>
        <td colspan="3" align="left"><input type="text" name="reason" value="" size="50" id="gold_reason"/></td>
    </tr>
	<tr bgcolor="#FFFFFF">
		<td colspan="2" width="50%" align="center"><input name="btnAddEvent" onclick="doSendGoods();" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['sure_giving'];?>
" type="button"></td>
		<td colspan="2" width="50%" align="center"><input name="btnClear" onclick="doClear();" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['modify'];?>
" type="button"></td>
	</tr>
</table>
</form>

</body>
</html>
<?php }
}
