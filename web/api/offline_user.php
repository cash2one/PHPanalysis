<?php
/**
 * 离线玩家统计接口 
 * @author wangxuefeng@4399.com
 * @date 2011.09.22
 * 传入参数:time_s 记录开始时间	UNIX时间戳
 * 		 time_e	记录结束时间	UNIX 时间戳
 *       flag = md5(time_s + key + time_e)
 * 返回：用戶名，等級，离线时间
 * 	   {user_name, level， offline_time}
 */
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
//include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$key = 'm5qrbf4Gep4MzsQB';
//-1:参数不全 -2:验证失败
$time_s = trim($_REQUEST['time_s']);
$time_e = trim($_REQUEST['time_e']);
$flag = trim($_REQUEST['flag']);
if (empty($time_s) || empty($time_e) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($time_s. $key. $time_e);
	//echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

$sql = "SELECT b.account_name as username, a.level, (unix_timestamp(now())-last_login_time) as offline_time" .
	   " FROM db_role_attr_p as a, db_role_base_p as b, db_role_ext_p as e " .
	   " WHERE a.role_id=b.role_id AND a.role_id=e.role_id AND e.last_login_time<e.last_offline_time " .
	   " AND (unix_timestamp(now())-last_login_time > 180) AND last_login_time>={$time_s} " .
	   " AND last_login_time<={$time_e} ORDER BY a.role_id ASC";
$offline_result = $db->fetchAll($sql);
//print_r($offline_result);
echo json_encode($offline_result);

