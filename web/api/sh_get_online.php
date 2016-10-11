<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//-1:参数不全 -2:验证失败
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
$key_flag = md5('center4399server');
if (empty($date) || empty($time) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($date . $time . $key_flag);
//	echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

$sql = 'SELECT * FROM `t_log_online_summary`  WHERE 1 ORDER BY id DESC LIMIT 1';
$result = $db->fetchOne($sql);
$result['agent_id'] = $AGENT_ID;
$result['game_server_id'] = $GAME_SERVER;

echo json_encode($result);

