<?php /* Smarty version 2.6.25, created on 2016-07-21 11:50:20
         compiled from error.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['_lang']['login']['back_sys_name']; ?>
</title>
<style type="text/css">
body {font-size:14px; font-family:"Courier New", Courier, monospace; text-align:center; margin:auto;}
#all {text-align:left;margin-left:4px;}
#nodes {width:100%; float:left;border:1px #ccc solid;}
#result {width: 100%; height:100%; clear:both; border:1px #ccc solid;}

</style>
<script type="text/javascript" src="../admin/static/js/jquery.min.js"></script>
</head>

<body>
	<table width="100%"  border="0" cellpadding="4" cellspacing="1" bgcolor="#A5D0F1">
        <tr bgcolor="#E5F9FF">
        	<td colspan="2" background="../admin/static/images/wbg.gif"><font color="#666600" class="STYLE2"><b>◆出错提示</b></font></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td width="100%"><a href="javascript:window.history.go(-1);"><?php echo $this->_tpl_vars['errorMsg']; ?>
 | 点击返回上一页</a></td>
        </tr>
      </table>
</body>
</html>