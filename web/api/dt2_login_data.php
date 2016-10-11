<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

# 登陆
# todo
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

	//user	role	server	agent
	$sql = "SELECT b.account_name as user, b.role_name as role, b.server_id as server, b.agent_id as agent" .
		" FROM db_role_base_p as b, db_role_ext_p as e WHERE e.last_login_time>{$time_begin} and e.last_login_time<={$time_end} and b.role_id=e.role_id order by e.last_login_time asc";
	$result = $db->FetchAll($sql);
	//	print_r($result);echo "<br>";

	echo json_encode($result);
}

