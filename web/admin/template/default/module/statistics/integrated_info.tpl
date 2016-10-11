<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<link rel="stylesheet" href="/web/admin/static/css/base.css" type="text/css">
<link rel="stylesheet" href="/web/admin/static/css/style.css" type="text/css">
<script type="text/javascript" src="/web/admin/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/web/admin/static/js/My97DatePicker/WdatePicker.js"></script>
<title>
	综合信息报表
</title>
</head>



<body style="margin:0">
<div id="position">数据分析：综合信息报表</div>
<div class='divOperation'>
				<form name="myform" method="post" action="<{$URL_SELF}>">

<form name="myform" method="post" >
统计起始时间<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='datestart' name='datestart' size='12' value='<{$start|date_format:"%Y-%m-%d"}>'/>
&nbsp;终止时间：<input type="text" class="Wdate" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" id='dateend' name='dateend' size='12' value='<{$end|date_format:"%Y-%m-%d"}>'/>
&nbsp;<input type="submit" class="button" name="Submit" value="搜索">
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
 <a href="<{$URL_SELF}>?datestart=<{$start|date_format:"%Y-%m-%d"}>&amp;dateend=<{$end|date_format:"%Y-%m-%d"}>&amp;page=<{$item}>&amp;forceFlag=<{$forceFlag}>"><{$key}></a><span style="width:5px;"></span>
 <{/foreach}>

<{if $page_count > 0}>
总页数(<{$page_count}>)
<{if $page_count > 5}>
	<input name="datestart" type="hidden" value="<{$start|date_format:"%Y-%m-%d"}>">
	<input name="dateend" type="hidden" value="<{$end|date_format:"%Y-%m-%d"}>">
  <input name="page" type="text" class="text" size="3" maxlength="6">&nbsp;<input type="submit" class="button" name="Submit" value="GO">
<{/if}>

[ <a href="<{$URL_SELF}>?excel=true&datestart=<{$start|date_format:"%Y-%m-%d"}>&amp;dateend=<{$end|date_format:"%Y-%m-%d"}>&amp;forceFlag=<{$forceFlag}>">导出Excel文件</a> ]
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
		<td >日期</td>
		<td >总登陆账号</td>
		<td>新增账号</td>
		<td>充值金额（元）</td>
		<td>充值元宝（元宝）</td>
		<td >消耗元宝（元宝）</td>
		<td >充值人数</td>
		<td >ARPU</td>
		<td >峰值在线</td>
		<td >平均在线</td>
		<td >平均在线时长</td>
		<td >活跃用户数</td>
	</tr>
	<{/if}>

	<{if $smarty.section.loop.rownum % 2 == 0}>
	<tr class='trEven'>
	<{else}>
	<tr class='trOdd'>
	<{/if}>
		<td>
		<{$keywordlist[loop].datetime|date_format:"%Y-%m-%d"}>
		</td><td>
		<{$keywordlist[loop].total_login}>
		</td><td>
		<{$keywordlist[loop].new_account}>
		</td><td>
		<{$keywordlist[loop].total_pay}>
		</td><td>
		<{$keywordlist[loop].total_gold}>
		</td><td>
		<{$keywordlist[loop].gold_cons}>
		</td><td>
		<{$keywordlist[loop].pay_num}>
		</td><td>
		<{$keywordlist[loop].arpu}>
		</td><td>
		<{$keywordlist[loop].hight_online}>
		</td><td>
		<{$keywordlist[loop].avg_online}>
		</td><td>
		<{$keywordlist[loop].avg_ol_time}>
		</td><td>
		<{$keywordlist[loop].active_user}>
		</td>
	</tr>
<{sectionelse}>

<{/section}>
<!-- SECTION  END -------------------------->

</form>
</table>

</body>
</html>
