<?php /* Smarty version 2.6.25, created on 2016-07-21 11:12:02
         compiled from login_new.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
 
    <title><?php echo $this->_tpl_vars['_lang']['login']['back_sys_name']; ?>
</title>
    <link href="/web/admin/static/css/login_styles.css" type="text/css" media="screen" rel="stylesheet" />
    <script src="/web/admin/static/js/jquery-1.6.2.min.js"></script>
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
                <h2><?php echo $this->_tpl_vars['_lang']['login']['back_sys_name']; ?>
</h2>
            </div>
            <div id="darkbannerwrap"  >
            </div>
            <div>
            
            <div>
            <form name="form1" method="post" action="login.php">
                <input type="hidden" name="action" value="login" />
                <fieldset class="form">
                    <p><label style="margin-left: 3.5cm;"  ><font color="red" > <?php echo $this->_tpl_vars['errorMsg']; ?>
</font></label></p>
                    <p>
                        <label class="loginlabel" for="user_name"><?php echo $this->_tpl_vars['_lang']['login']['user_name']; ?>
:</label>
                        <input class="logininput ui-keyboard-input ui-widget-content ui-corner-all" name="username" id="user_name" type="text" value="" />
                    </p>
                    <p>
                        <label class="loginlabel" for="user_password"><?php echo $this->_tpl_vars['_lang']['login']['pass_word']; ?>
：</label>
                        <span><input class="logininput"   name="password" id="user_password" type="password" value=""  /></span>
                    </p>
                    <p>
                        <label class="loginlabel" for="validation"><img src="image.php" ></label>
                        <span><input class="logininput ui-keyboard-input ui-widget-content ui-corner-all" name="validation" id="validation" type="text" value="" /></span>
                    </p>
                    <p>
                        <button id="loginbtn" type="submit" class="positive" name="Submit"><img src="/web/admin/static/images/key.png" alt="Announcement" /><?php echo $this->_tpl_vars['_lang']['login']['login']; ?>
</button>
                        <button id="loginbtn" type="reset"  class="positive" name="Reset"><img src="/web/admin/static/images/key.png" alt="Announcement" /><?php echo $this->_tpl_vars['_lang']['login']['clear']; ?>
</button>
                    </p>
                </fieldset>
<!--                <p  class="loginchk" style="margin-top:20px;">
                    <div style=" font-weight: bold;"><input type="checkbox" id="setcookie" name="chkcookie" <?php if ($this->_tpl_vars['checked'] == 1): ?> checked <?php endif; ?>  value="1" /><?php echo $this->_tpl_vars['_lang']['login']['save_pwd']; ?>
</div>
                </p>-->
            </form>

        </div>
<!--               <p align="right" style=" margin-top:-25px; font-weight: bold;"><?php echo $this->_tpl_vars['_lang']['login']['lang_select']; ?>
：
            <select name="LANG" id="switchlang" style="width:100px; height:30px; margin-right:100px; margin-bottom:0px;">
				<option  value ="ZH_CN">Chinese(Simplified)-简体中文</option>
				<?php if ($this->_tpl_vars['agent_id'] == 2): ?>
					<option  value ="ZH_TW" selected='selected'>Chinese(Traditional)-繁体中文</option>
				<?php else: ?>
					<option  value ="ZH_TW">Chinese(Traditional)-繁体中文</option>
				<?php endif; ?>
				<option  value ="EN">English-English</option>
				<?php if ($this->_tpl_vars['agent_id'] == 15): ?>
					<option  value ="VN" selected='selected'>Vietnamese-Tiếng Việt</option>
				<?php else: ?>
					<option  value ="VN">Vietnamese-Tiếng Việt</option>
				<?php endif; ?>

			</select>
			</p><br /> -->
    </div>

    <script type="text/javascript">
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

    </script>
</body>