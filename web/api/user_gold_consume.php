<?php
/**
 * 3.16	玩家元宝消耗记录日志接口 
 * @author wangxuefeng@4399.com
 * @date 2011.08.01
 * 传入参数:username=AAAA
 * 		 date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(username+date+time+key)
 * 返回：角色名，账号，元宝使用时间，绑定元宝，不绑定元宝，消费明细，剩余绑定元宝，剩余不绑定元宝
 *     {role_name, account_name, time, gold_bind, gold_unbind, consume_desc, remain_gold_bind, remain_gold_unbind}
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

$sql = "SELECT user_name as role_name, account_name, from_unixtime(mtime) as time, gold_bind, gold_unbind," .
	   " mdetail as consume_desc, remain_goldbind as remain_gold_bind, remain_gold as remain_gold_unbind" .
	   " FROM t_log_use_gold" .
	   " WHERE mtime>='{$start_time}' AND mtime<'{$end_time}'";
if (!empty($username))
{
	$sql .= " AND account_name='{$username}'";
}
$result = $db->fetchAll($sql);
//print_r($result);
echo json_encode($result);
