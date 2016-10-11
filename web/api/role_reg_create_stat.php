<?php
/**
 * 玩家创建角色统计接口
 * @author zengjintong
 * @date 2011.06.01
 * 传入参数：日期:YYYY-MM-DD
 * 返回：日期，当日创建角色数
 */

define('IN_DATANG_SYSTEM', true);

include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$datetime    = trim($_REQUEST['date']);           //查询时间
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);

if(empty($datetime)|| empty($time) || empty($flag) )
{
	echo json_encode("-1");
	exit;
}

else
{
	$token = md5($datetime.$time.$API_SECURITY_TICKEY_LOGIN);

	if($token != $flag )
	{
		echo json_encode("-2");
		exit;
	}
}

$starttime = strtotime($datetime);
$endtime = $starttime+86400;
$sql = "SELECT count(1) count FROM db_role_base_p ";
$sql .= "WHERE create_time >= ".$starttime." AND create_time <=".$endtime;

$result = $db->fetchOne($sql);
$count_result = $result[count];
$string = array ( 'time'=> $datetime, 'count' => $count_result);

$result = json_encode($string);

echo($result);




