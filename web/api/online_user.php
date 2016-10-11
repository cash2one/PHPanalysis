<?php
/**
 * 在线用户统计接口 
 * @author wangxuefeng@4399.com
 * @date 2011.06.04
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：当前在线人数，当天最大在线人数，当天最小在线人数
 * 	   {now_online, max_online， min_online}
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
//	echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

//当前在线人数
$sql = 'SELECT online FROM `t_log_online` WHERE 1 ORDER BY id DESC LIMIT 1';
$now_online = $db->fetchAll($sql);
//echo json_encode($now_online);

$dateStartStamp = strtotime($date . ' 0:0:0');
$year = date('Y', $dateStartStamp);
$month = date('m', $dateStartStamp);
$day = date('d', $dateStartStamp);

//当日最高在线
$sql = 'SELECT max(online) as maxNum FROM `t_log_online` '
        . ' WHERE year=' .
        $year .
        ' and month=' .
        $month .
        ' and day=' .
        $day;
$max_online = $db->fetchAll($sql);
//echo json_encode($max_online);


//当日最低在线
$sql = 'SELECT min(online) as minNum FROM `t_log_online` '
        . ' WHERE year=' .
        $year .
        ' and month=' .
        $month .
        ' and day=' .
        $day; 
$min_online = $db->fetchAll($sql);
//echo json_encode($min_online);

if (empty($max_online[0]['maxNum']))
{
	$max_online[0]['maxNum'] =0;
}

if (empty($min_online[0]['minNum']))
{
	$min_online[0]['minNum'] =0;
}

$final_out = array('now_online' => $now_online[0]['online'],
					'max_online' => $max_online[0]['maxNum'],
					'min_online' => $min_online[0]['minNum']);
echo json_encode($final_out);

