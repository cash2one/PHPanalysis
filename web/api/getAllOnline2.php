<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

## ?date={$date_str}&time={$now_time}&agent_id={$AGENT_ID}&game_id={$GAME_SERVER}&cnt={$cnt}&flag={$token}";
$dStartDate = $_REQUEST['date'];
$now_time = $_REQUEST['time'];
$agent_id = $_REQUEST['agent_id'];
$game_id = $_REQUEST['game_id'];
$cnt = $_REQUEST['cnt'];
$flag = $_REQUEST['flag'];



$key = "getAllonline4399Test";
$token = md5($date_str . $now_time . $key . $agent_id . $game_id);
if($token != $flag)
{
	die();
}
else
{
	$sql = "SELECT online,  agent_id , server_id , max(online) as max_online , min(online) as min_online , max(id) as now_online_id FROM  `all_server_online`  where agent_id = '$agent_id ' and date = '$dStartDate'  group by  server_id";
	$result = $db->fetchAll($sql);
    $sql1 = "SELECT * FROM  `all_server_online` where agent_id = '$agent_id' and date = '$dStartDate' ";
    $id_arr_all = $db->fetchAll($sql1);
	$json = array($result,$id_arr_all);
	
	
	echo json_encode($json);
	die();
}