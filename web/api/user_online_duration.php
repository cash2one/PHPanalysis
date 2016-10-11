<?php
/**
 * 3.17	玩家在线时长接口 
 * @author wangxuefeng@4399.com
 * @date 2011.07.30
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：各时长的人数：5分钟以内，5分钟到60分钟，1小时到2小时，大于2小时
 * 	   {zero_to_five_minutes, five_to_sixty_minutes, one_to_two_hours, more_than_two_hours}
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

$five_minutes = 300;
$sixty_minutes = 3600;
$two_hours = 7200;

$now_time = time();

//5分钟以内
$in_five_sql = "SELECT count(role_id) as num" .
	" FROM `db_role_ext_p`" .
	" WHERE is_online = 1 AND ('{$now_time}'-last_login_time) <'{$five_minutes}'";
$in_five_result = $db->fetchOne($in_five_sql);

//5分钟到60分钟
$five_to_sixty_minutes_sql = "SELECT count(role_id) as num" .
	" FROM `db_role_ext_p`" .
	" WHERE is_online = 1 AND ('{$now_time}'-last_login_time) <'{$sixty_minutes}'" .
	" AND ('{$now_time}'-last_login_time) >='{$five_minutes}'";
$five_to_sixty_minutes_result = $db->fetchOne($five_to_sixty_minutes_sql);

//1小时到2小时
$one_to_two_hours_sql = "SELECT count(role_id) as num" .
	" FROM `db_role_ext_p`" .
	" WHERE is_online = 1 AND ('{$now_time}'-last_login_time) <'{$two_hours}'" .
	" AND ('{$now_time}'-last_login_time) >='{$sixty_minutes}'";
$one_to_two_hours_result = $db->fetchOne($one_to_two_hours_sql);

//大于2小时
$more_than_two_hours_sql = "SELECT count(role_id) as num" .
	" FROM `db_role_ext_p`" .
	" WHERE is_online = 1 AND ('{$now_time}'-last_login_time) >='{$two_hours}'";
$more_than_two_hours_result = $db->fetchOne($more_than_two_hours_sql);

$result = array(
	'zero_to_five_minutes'  =>$in_five_result['num'], 
	'five_to_sixty_minutes' =>$five_to_sixty_minutes_result['num'], 
	'one_to_two_hours'      =>$one_to_two_hours_result['num'],
	'more_than_two_hours'   =>$more_than_two_hours_result['num'],
);
//print_r($result);
echo json_encode($result);
