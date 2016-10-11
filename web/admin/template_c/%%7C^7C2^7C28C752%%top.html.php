<?php /* Smarty version 2.6.25, created on 2016-07-21 11:50:19
         compiled from top.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['login']['back_sys_name']; ?>
</title>
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript">
$(function(){ 
    getSelectVal(); 
    $("#agentname").change(function(){ 
        getSelectVal(); 
    });	
}); 
</script>
<script type="text/javascript">
function getSelectVal(){ 
    $.getJSON("agent_server.php",{agentname:$("#agentname").val()},function(json){ 
        var servername = $("#servername"); 
        $("option",servername).remove(); //清空原有的选项 
        $.each(json,function(index,array){ 
			if(array['id'] == '<?php echo $this->_tpl_vars['server_id']; ?>
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
	

</script>
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
			<h2><font color="#000000">&nbsp;<?php echo $this->_tpl_vars['_lang']['login']['back_sys_name']; ?>
==><?php echo $this->_tpl_vars['game_server_name']; ?>
</font></h2>
		</div>
        
		<div id='select'>
			<form  name=form action="?action=do&type=search" method="post">
			<table border="0" cellpadding="4" cellspacing="1" >
				<tr>
				<td>
					<select name="agentname" id="agentname"> 
						<?php $_from = $this->_tpl_vars['agent_name_option']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
							<?php if ($this->_tpl_vars['item']['agentid'] == $this->_tpl_vars['agent_name_select']): ?>
								<option value="<?php echo $this->_tpl_vars['item']['agentid']; ?>
" selected="selected"><?php echo $this->_tpl_vars['item']['agentname']; ?>
</option>
							<?php else: ?>
								<option value="<?php echo $this->_tpl_vars['item']['agentid']; ?>
"><?php echo $this->_tpl_vars['item']['agentname']; ?>
</option>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
				<td><select name="servername" id="servername"></select></td>
				<td><input type="submit" name="submit" value="<?php echo $this->_tpl_vars['_lang']['top']['server_select']; ?>
" /></td>
                <td  style=" white-space: nowrap;">&nbsp;<?php echo $this->_tpl_vars['username']; ?>
&nbsp;<?php echo $this->_tpl_vars['_lang']['top']['hello']; ?>
</td><td style="width:500px;">
        		<td>
					<?php if ($this->_tpl_vars['auth_cnt'] > 1): ?>
					<select name="LANG" id="switchlang">
						<option  value ="ZH_CN">Chinese(Simplified)-简体中文</option>
						<!--
                        <?php if ($this->_tpl_vars['lang_type'] == 'ZH_TW'): ?>
							<option  value ="ZH_TW" selected="selected">Chinese(Traditional)-繁体中文</option>
						<?php else: ?>
							<option  value ="ZH_TW">Chinese(Traditional)-繁体中文</option>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['lang_type'] == 'EN'): ?>
							<option  value ="EN" selected="selected">English-English</option>
						<?php else: ?>
							<option  value ="EN">English-English</option>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['lang_type'] == 'VN'): ?>
							<option  value ="VN" selected="selected">Vietnamese-Tiếng Việt</option>
						<?php else: ?>
							<option  value ="VN">Vietnamese-Tiếng Việt</option>
						<?php endif; ?>
						-->
					</select>

					<?php endif; ?>
				</td>
				<td>
       <div style="height:20px;width:100px;float:right;text-align:center;background:url(/web/admin/static/images/button.png);"><a style="color:#FFF; text-decoration:none; font:10px" href="module/system/logoff.php"><br><?php echo $this->_tpl_vars['_lang']['left']['logout']; ?>
<br></a> </div></td>
				</tr>
			</table>
			</form>
		</div>
    	
    </div>
</body>
</html>