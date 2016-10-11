<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

# 注册信息

$time_begin = trim($_REQUEST['time_begin']);
$time_end = trim($_REQUEST['time_end']);
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";

$server_id_tag = 'S'.$GAME_SERVER;

$server_stat = $ALL_SERVER_LIST[$AGENT_ID][$GAME_SERVER]['stat'];
if($server_stat != 1)
{
	echo json_encode("error_".$server_stat);
	die();
}

$token = md5($time_begin . $key . $time_end);
#echo $token;echo "<br>";
if($token != $sign) 
{
	echo(json_encode("sign error"));
	die();
}
else
{	
	$sql_acc = 'select `account_name` as user, `datetime` as time ' .
		'FROM `t_log_game_event2` ' .
		'where event in (\'pageload\', \'beforeloadflash\', \'flashloaded\', \'createplayer\', \'playercreated\', \'entergame\', \'mission0\', \'mission1\', \'mission2\', \'mission3\', \'mission4\', \'mission5\') and datetime >= ' .
		$time_begin .
		' and datetime < ' .
		$time_end .
		' and server_name=\'' .
		$server_id_tag .
		'\' ' .
		'group by account_name order by id asc'; 	
	$result_acc = GFetchRowSet($sql_acc);
	echo json_encode($result_acc);
}

