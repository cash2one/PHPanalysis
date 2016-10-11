<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


#角色创建
$time_begin = trim($_REQUEST['time_begin']);
$time_end = trim($_REQUEST['time_end']);
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";

$server_stat = $ALL_SERVER_LIST[$AGENT_ID][$GAME_SERVER]['stat'];
if($server_stat != 1)
{
	echo json_encode("error_".$server_stat);
	die();
}

$token = md5($time_begin . $key . $time_end);
//echo $token;echo "<br>";
if($token != $sign) 
{
	echo(json_encode("sign error"));
	die();
}
else
{
	//user	role	server	agent	time

	$sql = "SELECT account_name as user, role_name as role, server_id as server, agent_id as agent, create_time as time" .
		" FROM db_role_base_p WHERE create_time>{$time_begin} and create_time<={$time_end} order by create_time asc";
	$result = $db->FetchAll($sql);
	//	print_r($result);echo "<br>";

	echo json_encode($result);
}