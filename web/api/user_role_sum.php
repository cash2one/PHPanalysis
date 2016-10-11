<?php
/**
 * 3.10	玩家创建角色统计接口 
 * @author wangxuefeng@4399.com
 * @date 2011.07.30
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：当日创建角色数 role_reg_count
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
$sql = "SELECT COUNT(role_id) as role_reg_count FROM `db_role_base_p`" .
	   " WHERE create_time>='{$start_time}' AND create_time<'{$end_time}'";
$result = $db->fetchOne($sql);
echo json_encode($result);

