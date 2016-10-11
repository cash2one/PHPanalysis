<?php
/* Smarty version 3.1.29, created on 2016-08-04 18:38:52
  from "E:\phpStudy\WWW\slg\web\admin\template\default\module\gm\gm_complaint.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57a31b3c44dc45_37730604',
  'file_dependency' => 
  array (
    '349e4213b47c8f3fe53b93e61fcbf98c58ff5860' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\module\\gm\\gm_complaint.html',
      1 => 1468910704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57a31b3c44dc45_37730604 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'E:\\phpStudy\\WWW\\slg\\web\\admin\\library\\smarty\\plugins\\modifier.date_format.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<title>
	<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bug_info'];?>

</title>

</head>

<body>
<div id="position"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['gm_manage'];?>
：<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bug_info'];?>
</div>
<table class="table_page_num" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td class="even" height="30">
<form method="get" action="">
  <?php
$_from = $_smarty_tpl->tpl_vars['page_list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_0_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_0_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_0_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
	<a href="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?page=<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</a><span style="width:5px;"></span>
 <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
if ($__foreach_item_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_0_saved_key;
}
echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['all_page'];?>
(<?php echo $_smarty_tpl->tpl_vars['page_count']->value;?>
)
  <input name="page" type="text" class="text" size="3" maxlength="6">&nbsp;<input type="submit" class="button" name="Submit" value="GO">
</form>
</td>
</tr></tbody></table>

<table cellspacing="1" cellpadding="3" border="0" class='table_list' style="table-layout:fixed;word-break:break-all;word-wrap:break-word;">
    <tr class='table_list_head'>
		<td width="4%">ID</td>
		<td width="5%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_id'];?>
</td>
		<td width="8%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['user_account'];?>
</td>
		<td width="5%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
</td>
		<td width="5%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_level'];?>
</td>
		<td width="5%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['submit_time'];?>
</td>
		<td width="5%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bug_type'];?>
</td>
		<td width="10%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['title'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['content'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['reply_content'];?>
</td>
		<td width="5%"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['bug_statu'];?>
</td>
	</tr>
	<?php
$_from = $_smarty_tpl->tpl_vars['rs']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_1_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_1_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$__foreach_item_1_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
		<?php if ($_smarty_tpl->tpl_vars['key']->value%2 == 0) {?>
		<tr class='trEven'>
		<?php } else { ?>
		<tr class='trOdd'>
		<?php }?>
		    <td>
			<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>

			</td>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['item']->value['roleid'];?>

			</td>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['item']->value['account_name'];?>

			</td>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['item']->value['role_name'];?>

			</td>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['item']->value['level'];?>

			</td>
			<td>
			<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['time'],"%Y-%m-%d %H:%M:%S");?>

			</td>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['item']->value['msgType'];?>

			</td>
			<td>
			<?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>

			</td>
			<td style="word-break : break-all;width:200px;overflow:auto; ">
			<a href="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['content'];?>
</a>
			</td>
			<td>
			<a href="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&id=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['reply'];?>
</a>
			</td>
			<td>
			<?php if ($_smarty_tpl->tpl_vars['item']->value['state'] == 0) {?><a href="<?php echo $_smarty_tpl->tpl_vars['URL_SELF']->value;?>
?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&amp;action=<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['mark_has_handled'];?>
</a>
			<?php } elseif ($_smarty_tpl->tpl_vars['item']->value['state'] == 1) {?><FONT color=red><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['processed'];?>

			<?php } else {
echo $_smarty_tpl->tpl_vars['_lang']->value['new']['put_off'];?>

			<?php }?>
			</td>
	</tr>
	<?php if ($_smarty_tpl->tpl_vars['one_msg']->value['id'] == $_smarty_tpl->tpl_vars['item']->value['id']) {?>
	<tr id="div1" >
		<td colspan="11">
	      <div  align=left>
	        ID:<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['conmon']['role_name'];?>
：<?php echo $_smarty_tpl->tpl_vars['role_name']->value;?>
<br>
	        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['title'];?>
：<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
<br>
	        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['content'];?>
：<?php echo $_smarty_tpl->tpl_vars['content']->value;?>
<br>
	        <?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['reply_content'];?>
：<?php echo $_smarty_tpl->tpl_vars['reply']->value;?>

	        <div style="text-align:center;width:150px;">
				<font color="green"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['new']['direct_replay_player'];?>
：</font>
			</div>
			<form name="myform" method="post" action="../../module/gm/reply.php">
			  <table style="text-align:;left;">
			   <tr>
				<input type='hidden' name='id' size='10' value=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 />
				<input type='hidden' name='roleid' size='10' value=<?php echo $_smarty_tpl->tpl_vars['roleid']->value;?>
 />
				<input type='hidden' name='role_name' size='10' value='<?php echo $_smarty_tpl->tpl_vars['role_name']->value;?>
' />
				<input type='hidden' name='page' size='10' value=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
 />
			   </tr>
			   <tr>
				<textarea  name='content' style="width:350px;height:100px;"></textarea>
			   </tr>
			   <tr>
				<div style="text-align:center;width:300px;">
					<input type="submit" name='submit' value='<?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['submit'];?>
' class="input2"  />
				</div>
				</tr>
			  </table>
			</form>
			</div>
		</td>
	</tr>
	<?php }?>

<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_local_item;
}
if ($__foreach_item_1_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_item;
}
if ($__foreach_item_1_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_1_saved_key;
}
?>

</table>
<br>

</body>

</html><?php }
}
