<?php
/**
 * 3.9	玩家创建角色信息接口 
 * @author wangxuefeng@4399.com
 * @date 2011.07.29
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：当日玩家账号，玩家创建角色名称，创建时间
 * 	   {account_name, role_name， reg_time}
 */
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//-1:参数不全 -2:验证失败
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
	$token = md5($date . $time . $API_SECURITY_TICKET_DATA);
	//echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

$start_time = strtotime($date);
$end_time = $start_time + 86400;
$sql = "SELECT account_name, role_name, from_unixtime(create_time) as reg_time FROM `db_role_base_p`" .
	   " WHERE create_time>='{$start_time}' AND create_time<'{$end_time}' ORDER BY role_id asc";
$result = $db->fetchAll($sql);

echo json_encode($result);

