<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$year = date('Y');
$month = date('m');
$day = date('d');

//当前在线人数
$sql0 = 'SELECT online,distinct_ip FROM `t_log_online` where dateline = ( select max( dateline ) from t_log_online ) group by dateline LIMIT 0, 30 '; 
$now_online = $db->fetchAll($sql0);


//先取出最大的在线
$sql1 = "select max(online) as online , max(distinct_ip) as distinct_ip from ".T_LOG_ONLINE." where year={$year} and month = {$month} and day={$day}";
$result = $db->fetchAll($sql1);
$maxOnline = $result[0]['online'];
$maxOnlineIp = $result[0]['distinct_ip'];

//当日最低在线
$sql2 = 'SELECT min(online) as minNum , min(distinct_ip) as min_ip FROM `t_log_online` WHERE year=' .$year.' and month='.$month .' and day='.$day; 
$min_online = $db->fetchAll($sql2);

//全服最高在线
$sql3 = "SELECT max(online) as allMax , max(distinct_ip) as max_ip FROM `t_log_online`";
$all_max = $db->fetchOne($sql3);

//不分页显示
$sql = "select online, dateline, distinct_ip from ".T_LOG_ONLINE." where year={$year} and month = {$month} and day={$day} order by dateline desc limit 0, 30";
	
$result = $db->fetchAll($sql);
foreach ($result as &$v) {
	$v['weight'] = @($v['online'] / $maxOnline) * 480;
}


//今天在线数据
$sql_today = "select online, dateline, distinct_ip from ".T_LOG_ONLINE." where year={$year} and month = {$month} and day={$day} order by dateline asc";
	
$today_result = $db->fetchAll($sql_today);
$today_data = '';
$today_data_ip = '';
$flag = false;
foreach($today_result as $key=>$row)
{
	if($flag)
	{
		$today_data .= ',';
		$today_data_ip .= ',';
	}
	$tmp = '';
	$tmp_ip = '';
	//$tmp = '[Date.UTC('. strftime("%Y, %m-1, %d, %H, %M, %S", $row['dateline']) . '),' .$row['online'].']';
	$tmp = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['dateline']) . '),' .$row['online'].']';
	$tmp_ip = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['dateline']) . '),' .$row['distinct_ip'].']';
	$today_data .= $tmp;
	$today_data_ip .= $tmp_ip;
	$flag = true;
}

//昨天在线数据
$yesterday =  time() - 86400; 
$year_yest = strftime("%Y", $yesterday);
$month_yest = strftime("%m", $yesterday);
$day_yest = strftime("%d", $yesterday);

$sql_yest = "select online, dateline, distinct_ip from ".T_LOG_ONLINE." where year={$year_yest} and month = {$month_yest} and day={$day_yest} order by dateline asc";
	
$yest_result = $db->fetchAll($sql_yest);
$yest_data = '';
$yest_data_ip = '';

$flag = false;
foreach($yest_result as $key=>$row)
{
	if($flag)
	{
		$yest_data .= ',';
		$yest_data_ip .= ',';
	}
	$tmp = '';
	$tmp_ip = '';
	//$tmp = '[Date.UTC('. strftime("%Y, %m-1, %d, %H, %M, %S", $row['dateline']) . '),' .$row['online'].']';
	$tmp = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['dateline']) . '),' .$row['online'].']';
	$tmp_ip = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['dateline']) . '),' .$row['distinct_ip'].']';
	$yest_data .= $tmp;
	$yest_data_ip .= $tmp_ip;
	$flag = true;
}

//前天在线数据
$the_day_before_yesterday =  time() - 2*86400; 
$year_be_yest = strftime("%Y", $the_day_before_yesterday);
$month_be_yest = strftime("%m", $the_day_before_yesterday);
$day_be_yest = strftime("%d", $the_day_before_yesterday);

$sql_be_yest = "select online, dateline, distinct_ip from ".T_LOG_ONLINE." where year={$year_be_yest} and month = {$month_be_yest} and day={$day_be_yest} order by dateline asc";
	
$be_yest_result = $db->fetchAll($sql_be_yest);
$be_yest_data = '';
$be_yest_data_ip = '';
$flag = false;
foreach($be_yest_result as $key=>$row)
{
	if($flag)
	{
		$be_yest_data .= ',';
		$be_yest_data_ip .= ',';
	}
	$tmp = '';
	$tmp_ip = '';
	//$tmp = '[Date.UTC('. strftime("%Y, %m-1, %d, %H, %M, %S", $row['dateline']) . '),' .$row['online'].']';
	$tmp = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['dateline']) . '),' .$row['online'].']';
	$tmp_ip = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['dateline']) . '),' .$row['distinct_ip'].']';
	$be_yest_data .= $tmp;
	$be_yest_data_ip .= $tmp_ip;
	$flag = true;
}


//上周在线数据
$lastweek = time() - 7*86400;
$year_lw = strftime("%Y", $lastweek);
$month_lw = strftime("%m", $lastweek);
$day_lw = strftime("%d", $lastweek);

$sql_lw = "select online, dateline,distinct_ip from ".T_LOG_ONLINE." where year={$year_lw} and month = {$month_lw} and day={$day_lw} order by dateline asc";
	
$lw_result = $db->fetchAll($sql_lw);

$lw_data = '';
$lw_data_ip = '';
$flag = false;
foreach($lw_result as $key=>$row)
{
	if($flag)
	{
		$lw_data .= ',';
	}
	$tmp = '';
	$tmp_ip = '';
	//$tmp = '[Date.UTC('. strftime("%Y, %m-1, %d, %H, %M, %S", $row['dateline']) . '),' .$row['online'].']';
	$tmp = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['dateline']) . '),' .$row['online'].']';
	$tmp_ip = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['dateline']) . '),' .$row['distinct_ip'].']';
	$lw_data .= $tmp;
	$lw_data_ip .= $tmp_ip;
	$flag = true;
}

$today_str = strftime("%Y-%m-%d", time());
$yest_str = strftime("%Y-%m-%d", time()-86400);
$be_yest_str = strftime("%Y-%m-%d", time()-2*86400);
$lw_str = strftime("%Y-%m-%d", time()-7*86400);

$smarty->assign("today_str", $today_str);
$smarty->assign("yest_str", $yest_str);
$smarty->assign("be_yest_str", $be_yest_str);
$smarty->assign("lw_str", $lw_str);

$smarty->assign("now_online", intval($now_online[0]['online']));
$smarty->assign("now_onlineip", intval($now_online[0]['distinct_ip']));

$smarty->assign("max_online", intval($maxOnline));
$smarty->assign("max_onlineip",intval($maxOnlineIp));

$smarty->assign("min_online", intval($min_online[0]['minNum']));
$smarty->assign("min_onlineip", intval($min_online[0]['min_ip']));

$smarty->assign("all_max", intval($all_max['allMax']));
$smarty->assign("all_maxip", intval($all_max['max_ip']));

$smarty->assign("today_data", $today_data);
$smarty->assign("today_data_ip", $today_data_ip);

$smarty->assign("yest_data", $yest_data);
$smarty->assign("yest_data_ip", $yest_data_ip);

$smarty->assign("be_yest_data", $be_yest_data);
$smarty->assign("be_yest_data_ip", $be_yest_data_ip);

$smarty->assign("lw_data", $lw_data);
$smarty->assign("lw_data_ip", $lw_data_ip);

$smarty->assign(array('onlines' => $result));
$smarty->display("module/online/today.html");

