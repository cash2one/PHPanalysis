<?php
/* Smarty version 3.1.29, created on 2016-09-28 09:29:11
  from "E:\phpStudy\WWW\slg\web\admin\template\default\login_new.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57eb1ce74103f6_63234772',
  'file_dependency' => 
  array (
    '7ddc52fabec39fda4a181386c1ad8c7e1864bed4' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\slg\\web\\admin\\template\\default\\login_new.html',
      1 => 1468910702,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57eb1ce74103f6_63234772 ($_smarty_tpl) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
 
    <title><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['back_sys_name'];?>
</title>
    <link href="/web/admin/static/css/login_styles.css" type="text/css" media="screen" rel="stylesheet" />
    <?php echo '<script'; ?>
 src="/web/admin/static/js/jquery-1.6.2.min.js"><?php echo '</script'; ?>
>
</head>
<body id="login">
    <div id="wrappertop">
    </div>
    <div id="wrapper">
        <div id="content">
            <div id="header">
                <!--<h1><a href="login.php"><img src="/web/admin/static/images/dtzl2.png"   height="50"  width="100"  alt="logo"></a></h1>-->
            </div>
            <div id="darkbanner" class="banner320">
                <h2><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['back_sys_name'];?>
</h2>
            </div>
            <div id="darkbannerwrap"  >
            </div>
            <div>
            
            <div>
            <form name="form1" method="post" action="login.php">
                <input type="hidden" name="action" value="login" />
                <fieldset class="form">
                    <p><label style="margin-left: 3.5cm;"  ><font color="red" > <?php echo $_smarty_tpl->tpl_vars['errorMsg']->value;?>
</font></label></p>
                    <p>
                        <label class="loginlabel" for="user_name"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['user_name'];?>
:</label>
                        <input class="logininput ui-keyboard-input ui-widget-content ui-corner-all" name="username" id="user_name" type="text" value="" />
                    </p>
                    <p>
                        <label class="loginlabel" for="user_password"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['pass_word'];?>
：</label>
                        <span><input class="logininput"   name="password" id="user_password" type="password" value=""  /></span>
                    </p>
                    <p>
                        <label class="loginlabel" for="validation"><img src="image.php" ></label>
                        <span><input class="logininput ui-keyboard-input ui-widget-content ui-corner-all" name="validation" id="validation" type="text" value="" /></span>
                    </p>
                    <p>
                        <button id="loginbtn" type="submit" class="positive" name="Submit"><img src="/web/admin/static/images/key.png" alt="Announcement" /><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['login'];?>
</button>
                        <button id="loginbtn" type="reset"  class="positive" name="Reset"><img src="/web/admin/static/images/key.png" alt="Announcement" /><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['clear'];?>
</button>
                    </p>
                </fieldset>
<!--                <p  class="loginchk" style="margin-top:20px;">
                    <div style=" font-weight: bold;"><input type="checkbox" id="setcookie" name="chkcookie" <?php if ($_smarty_tpl->tpl_vars['checked']->value == 1) {?> checked <?php }?>  value="1" /><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['save_pwd'];?>
</div>
                </p>-->
            </form>

        </div>
<!--               <p align="right" style=" margin-top:-25px; font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['_lang']->value['login']['lang_select'];?>
：
            <select name="LANG" id="switchlang" style="width:100px; height:30px; margin-right:100px; margin-bottom:0px;">
				<option  value ="ZH_CN">Chinese(Simplified)-简体中文</option>
				<?php if ($_smarty_tpl->tpl_vars['agent_id']->value == 2) {?>
					<option  value ="ZH_TW" selected='selected'>Chinese(Traditional)-繁体中文</option>
				<?php } else { ?>
					<option  value ="ZH_TW">Chinese(Traditional)-繁体中文</option>
				<?php }?>
				<option  value ="EN">English-English</option>
				<?php if ($_smarty_tpl->tpl_vars['agent_id']->value == 15) {?>
					<option  value ="VN" selected='selected'>Vietnamese-Tiếng Việt</option>
				<?php } else { ?>
					<option  value ="VN">Vietnamese-Tiếng Việt</option>
				<?php }?>

			</select>
			</p><br /> -->
    </div>

    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function() {
            $(".logininput").blur(function() {
                if ($(this).val() == "") {
                    $(this).css("border-color", "red");
                                    }
                else
                    $(this).css("border-color", "#D9D6C4");
            })
        });
  
  
//语言包  start
	$(document).ready(function () 
{
	$('#switchlang').change(function(){
		  var txt=$("#switchlang").val();
		  $.post("/web/admin/login.php",{LANG:txt},function(result){
			 window.location.reload();
		  });
	});
});
//语言包  and      

    <?php echo '</script'; ?>
>
</body>
<?php }
}
