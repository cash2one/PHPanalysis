<?php
define('IN_DATANG_SYSTEM', true);
//include "../config/config.php";
//include SYSDIR_ROOT_CLIENT.'config/config.key.php';
//include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

include "/data/mge/client/web/config/config.php";
include "/data/mge/client/web/include/global.php";

//当前在线人数
$sql = 'SELECT online, dateline FROM `t_log_online` WHERE 1 ORDER BY id DESC LIMIT 1';
$now_online = $db->fetchAll($sql);

$t = strftime("%Y%m%d%H%M%S", $now_online[0]['dateline']);
$r = 1;
$h = 1000+$GAME_SERVER;
$u = $now_online[0]['online'];

$url_req = "http://local.dtzl.mop.com/online.php?" . "t=" . urlencode($t) . "&r=" . urlencode($r) . "&h=" . urlencode($h) . "&u=" . urlencode($u);

$req_cnt = 3;
while($req_cnt > 0)
{
	$result_req = @ file_get_contents($url_req);
	if($result_req == 'ok')
	{
		break;
		die();
	}
	else
	{
		$req_cnt = $req_cnt -1;
	}
}

die();

