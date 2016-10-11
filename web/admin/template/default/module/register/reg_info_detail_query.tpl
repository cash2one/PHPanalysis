<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
<title>
	注册信息明细
</title>
</head>



<body style="margin:0">
<div id="position">在线与注册：注册信息明细</div>
<div class='divOperation'>
<form name="myform" method="post" action="<{$URL_SELF}>">
统计起始时间：
<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='datestart' name='datestart' size='12' value='<{$start|date_format:"%Y-%m-%d"}>'/>
&nbsp;终止时间：
<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateend' name='dateend' size='12' value='<{$end|date_format:"%Y-%m-%d"}>'/>
&nbsp;<input type="submit" class="button" name="Submit" value="搜索">


&nbsp;&nbsp;&nbsp;排序
<select name="sort_1">
	<{html_options options=$sortoption selected=$search_sort_1}>
</select>

<select name="sort_2">
	<{html_options options=$sortoption selected=$search_sort_2}>
</select>
</form>


&nbsp;&nbsp;&nbsp;
<{if $record_count}>
总共<{$record_count}>个记录
<{/if}>
				</form>
</div>

<table width="100%"  border="0" cellspacing="0" cellpadding="0" class='table_page_num'>
  <tr>
    <td height="30" class="even">
<form method="get" action="">
 <{foreach key=key item=item from=$page_list}>
 <a href="<{$URL_SELF}>?datestart=<{$start|date_format:"%Y-%m-%d"}>&amp;dateend=<{$end|date_format:"%Y-%m-%d"}>&amp;sort_1=<{$search_sort_1}>&amp;sort_2=<{$search_sort_2}>&amp;page=<{$item}>&amp;forceFlag=<{$forceFlag}>"><{$key}></a><span style="width:5px;"></span>
 <{/foreach}>
<{if $page_count > 0}>

总页数(<{$page_count}>)
<{if $page_count > 5}>
	<input name="datestart" type="hidden" value="<{$start|date_format:"%Y-%m-%d"}>">
	<input name="dateend" type="hidden" value="<{$end|date_format:"%Y-%m-%d"}>">
	<input name="sort_1" type="hidden" value="<{$search_sort_1}>">
	<input name="sort_2" type="hidden" value="<{$search_sort_2}>">
  <input name="page" type="text" class="text" size="3" maxlength="6">&nbsp;<input type="submit" class="button" name="Submit" value="GO">
<{/if}>

[ <a href="<{$URL_SELF}>?excel=true&datestart=<{$start|date_format:"%Y-%m-%d"}>&amp;dateend=<{$end|date_format:"%Y-%m-%d"}>&amp;sort_1=<{$search_sort_1}>&amp;sort_2=<{$search_sort_2}>&amp;forceFlag=<{$forceFlag}>">导出Excel文件</a> ]
<{/if}>
</form>
    </td>
  </tr>
</table>

<table cellspacing="1" cellpadding="3" border="0" class='table_list' >
<!-- SECTION  START -------------------------->
<form id="form1" name="form1" method="post" action="">
<{section name=loop loop=$keywordlist}>
	<{if $smarty.section.loop.rownum % 20 == 1}>
	<tr class='table_list_head'>
		<td >账号名</td>
		<td >角色名</td>
		<td>注册时间</td>
		<td>最后登录时间</td>
		<td>最后登录IP</td>
		<td >角色等级</td>
	</tr>
	<{/if}>

	<{if $smarty.section.loop.rownum % 2 == 0}>
	<tr class='trEven'>
	<{else}>
	<tr class='trOdd'>
	<{/if}>
		<td>
		<{$keywordlist[loop].account_name}>
		</td><td>
		<{$keywordlist[loop].role_name}>
		</td><td>
		<{$keywordlist[loop].create_time|date_format:"%Y-%m-%d %H:%M:%S"}>
		</td><td>
		<{$keywordlist[loop].last_login_time|date_format:"%Y-%m-%d %H:%M:%S"}>
		</td><td>
		<{$keywordlist[loop].last_login_ip}>
		</td><td>
		<{$keywordlist[loop].level}>
		</td>
	</tr>
<{sectionelse}>

<{/section}>
<!-- SECTION  END -------------------------->

</form>
</table>

</body>
</html>
