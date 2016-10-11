<?php
/* Smarty version 3.1.29, created on 2016-09-29 09:27:10
  from "E:\phpStudy\WWW\sanguo\web\admin\template\default\top.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57ec6dee7e14e5_07572210',
  'file_dependency' => 
  array (
    '27244e3771e99492469ef6715389a25a46543a2e' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\sanguo\\web\\admin\\template\\default\\top.html',
      1 => 1474527053,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57ec6dee7e14e5_07572210 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['back_sys_name'];?>
</title>
<?php echo '<script'; ?>
 type="text/javascript" src="/web/admin/static/js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$(function(){ 
    getSelectVal(); 
    $("#agentname").change(function(){ 
        getSelectVal(); 
    });	
}); 
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
function getSelectVal(){ 
    $.getJSON("agent_server.php",{agentname:$("#agentname").val()},function(json){ 
        var servername = $("#servername"); 
        $("option",servername).remove(); //清空原有的选项 
        $.each(json,function(index,array){ 
			if(array['id'] == '<?php echo $_smarty_tpl->tpl_vars['server_id']->value;?>
')
			{
            var option = "<option value='"+array['id']+"' selected='selected'>"+array['title']+"</option>"; 
            }
			else 
			{
				var option = "<option value='"+array['id']+"'>"+array['title']+"</option>";
			}
			servername.append(option); 
        }); 
    }); 
}

//语言包  start
	$(document).ready(function () 
{
	$('#switchlang').change(function(){
		  var txt=$("#switchlang").val();
		  $.post("top.php",{LANG:txt},function(result){
			 window.location.reload();
			 window.parent.frames["main_frame"].location="main.php";
			 window.parent.frames["left_frame"].location="left.php";
		  });
	});
});
//语言包  and
	

<?php echo '</script'; ?>
>
<style type="text/css">
body1 { width:100%; height:70px; text-align:center; margin:0 auto; background:#CCC;background:url(../admin/static/images/header.jpg);clear:both;}
body {width:100%; height:50px; text-align:center; margin:0 auto; background:#CCC; background:#DCE2F1;clear:both;}
#all {width:100%; height:100%;}

#title {float:left; width:37%; line-height:50%; text-align:left;}  
#select {float:left; width:63%; line-height:50%; text-align:left;position:relative;left:0px;top:10px;}

</style>
</head>

<body>
    <div id="all">
    	<div id="title">
			<h2><font color="#000000">&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['back_sys_name'];?>
</font></h2>
		</div>
        
		<div id='select'>
			<form  name=form action="?action=do&type=search" method="post">
			<table border="0" cellpadding="4" cellspacing="1" >
				<tr>
				<td>
					<select name="agentname" id="agentname"> 
						<?php
$_from = $_smarty_tpl->tpl_vars['agent_name_option']->value;
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
							<?php if ($_smarty_tpl->tpl_vars['item']->value['agentid'] == $_smarty_tpl->tpl_vars['agent_name_select']->value) {?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['agentid'];?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['item']->value['agentname'];?>
</option>
							<?php } else { ?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['agentid'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['agentname'];?>
</option>
							<?php }?>
						<?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
if ($__foreach_item_0_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_item_0_saved_key;
}
?>
					</select>
				</td>
				<td><select name="servername" id="servername"></select></td>
				<td><input type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['_lang']->value['top']['server_select'];?>
" /></td>
                <td  style=" white-space: nowrap;">&nbsp;<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['_lang']->value['top']['hello'];?>
</td><td style="width:500px;">
        		<td>
					<?php if ($_smarty_tpl->tpl_vars['auth_cnt']->value > 1) {?>
					<select name="LANG" id="switchlang">
						<option  value ="ZH_CN">Chinese(Simplified)-简体中文</option>
						<!--
                        <?php if ($_smarty_tpl->tpl_vars['lang_type']->value == 'ZH_TW') {?>
							<option  value ="ZH_TW" selected="selected">Chinese(Traditional)-繁体中文</option>
						<?php } else { ?>
							<option  value ="ZH_TW">Chinese(Traditional)-繁体中文</option>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['lang_type']->value == 'EN') {?>
							<option  value ="EN" selected="selected">English-English</option>
						<?php } else { ?>
							<option  value ="EN">English-English</option>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['lang_type']->value == 'VN') {?>
							<option  value ="VN" selected="selected">Vietnamese-Tiếng Việt</option>
						<?php } else { ?>
							<option  value ="VN">Vietnamese-Tiếng Việt</option>
						<?php }?>
						-->
					</select>

					<?php }?>
				</td>
				<td>
       <div style="height:20px;width:100px;float:right;text-align:center;background:url(/web/admin/static/images/button.png);"><a style="color:#FFF; text-decoration:none; font:10px" href="module/system/logoff.php"><br><?php echo $_smarty_tpl->tpl_vars['_lang']->value['left']['logout'];?>
<br></a> </div></td>
				</tr>
			</table>
			</form>
		</div>
    	
    </div>
</body>
</html>
<?php }
}
