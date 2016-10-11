<?php
/**
 * 3.16	玩家银两消耗记录日志接口 
 * @author wangxuefeng@4399.com
 * @date 2011.08.01
 * 传入参数:username=AAAA
 * 		 date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(username+date+time+key)
 * 返回：角色名，账号，银两使用时间，消费银两，消费明细，剩余银两
 *     {role_name, account_name, time, silver, consume_desc, remain_silver}
 */
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//-1:参数不全 -2:验证失败
$username = trim($_REQUEST['username']);
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
if (empty($date) || empty($time) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	echo $username . $date . $time . $API_SECURITY_TICKET_DATA;
	$token = md5($username . $date . $time . $API_SECURITY_TICKET_DATA);
	//echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

$start_time = strtotime($date);
$end_time = $start_time + 86400;

$sql = "SELECT b.role_name, b.account_name, from_unixtime(s.mtime) as time, s.silver_unbind as silver," .
	   " s.mdetail as consume_desc, s.remain_unbind as remain_silver" .
	   " FROM t_log_use_silver as s, db_role_base_p as b" .
	   " WHERE b.role_id=s.user_id AND mtime>='{$start_time}' AND mtime<'{$end_time}'";
if (!empty($username))
{
	$sql .= " AND b.account_name='{$username}' AND b.server_id='{$GAME_SERVER}'";
}
$result = $db->fetchAll($sql);
//print_r($result);
echo json_encode($result);
