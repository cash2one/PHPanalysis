<?php
/**
 * 等级、财富排行接口 
 * @author wangxuefeng@4399.com
 * @date 2011.06.04
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：等级排行：角色名，等级   财富排行：角色名，银两
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
//	echo $date . $time . $API_SECURITY_TICKET_DATA.'<br>';
//	echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

$level_sql = 'SELECT role_name, level FROM `db_role_attr_p`'
        . ' order by level desc, exp desc, role_id desc '
        . ' limit 0, 100'; 
$level_result = GFetchRowSet($level_sql);

$silver_sql = 'SELECT role_name , silver as assets FROM `db_role_attr_p` '
        . ' order by silver desc '
        . ' LIMIT 0, 100 '; 
$silver_result = GFetchRowSet($silver_sql);

$final_out = array('level_rank' => $level_result, 'assets_rank' => $silver_result);
echo json_encode($final_out);

