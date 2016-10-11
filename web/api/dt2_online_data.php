<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


#在线
 
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
$key = "FTNN4399payKode";

$server_stat = $ALL_SERVER_LIST[$AGENT_ID][$GAME_SERVER]['stat'];
if($server_stat != 1)
{
	echo json_encode("error_".$server_stat);
	die();
}

$token = md5($date. $time. $key);
//echo $token;echo "<br>";
if($token != $flag) 
{
	echo(json_encode("sign error"));
	die();
}
else
{
	//count	max	min	agent	server
	//当前在线人数
	$sql = 'SELECT online FROM `t_log_online` WHERE 1 ORDER BY id DESC LIMIT 1';
	$now_online = $db->fetchAll($sql);
	if(empty($now_online))
	{
		echo json_encode('[]');
		die();
	}
	
	$dateStartStamp = strtotime($date . ' 0:0:0');
	$year = date('Y', $dateStartStamp);
	$month = date('m', $dateStartStamp);
	$day = date('d', $dateStartStamp);
	
	//当日最高在线
	$sql = 'SELECT max(online) as maxNum FROM `t_log_online` '
		. ' WHERE year=' .
		$year .
		' and month=' .
		$month .
		' and day=' .
		$day;
	$max_online = $db->fetchAll($sql);
	//echo json_encode($max_online);
	
	
	//当日最低在线
	$sql = 'SELECT min(online) as minNum FROM `t_log_online` '
		. ' WHERE year=' .
		$year .
		' and month=' .
		$month .
		' and day=' .
		$day; 
	$min_online = $db->fetchAll($sql);
	
	if (empty($max_online[0]['maxNum']))
	{
		$max_online[0]['maxNum'] =0;
	}
	
	if (empty($min_online[0]['minNum']))
	{
		$min_online[0]['minNum'] =0;
	}
	
	$result = array();	
	$result['count'] = $now_online[0]['online'];
	$result['max'] = $max_online[0]['maxNum'];
	$result['min'] = $min_online[0]['minNum'];
	$result['agent'] = $AGENT_ID;
	$result['server'] = $GAME_SERVER;

	echo json_encode($result);
}

