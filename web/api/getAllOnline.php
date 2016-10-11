<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

## ?date={$date_str}&time={$now_time}&agent_id={$AGENT_ID}&game_id={$GAME_SERVER}&cnt={$cnt}&flag={$token}";
$date_str = $_REQUEST['date'];
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
	$sql = "SELECT * FROM t_log_online_summary_all WHERE agent_id={$agent_id} ORDER BY id DESC LIMIT 0,{$cnt}";
	$result = $db->fetchAll($sql);
	echo json_encode($result);
	die();
}