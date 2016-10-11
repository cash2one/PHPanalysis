<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//-1:参数不全 -2:验证失败
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
$key_flag = md5('center4399server');
if (empty($date) || empty($time) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($date . $time . $key_flag);
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

//当前在线人数
$sql = 'SELECT online, dateline FROM `t_log_online` WHERE 1 ORDER BY id DESC LIMIT 1';
$now_online = $db->fetchAll($sql);

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


//当日最低在线
$sql = 'SELECT min(online) as minNum FROM `t_log_online` '
        . ' WHERE year=' .
        $year .
        ' and month=' .
        $month .
        ' and day=' .
        $day; 
$min_online = $db->fetchAll($sql);

//单服最高在线
$sql = 'SELECT all_max_online FROM `t_log_online_summary` WHERE 1 ORDER BY id DESC LIMIT 1';
$all_max_online = $db->fetchAll($sql);

if (empty($max_online[0]['maxNum']))
{
	$max_online[0]['maxNum'] =0;
}

if (empty($min_online[0]['minNum']))
{
	$min_online[0]['minNum'] =0;
}

if (empty($all_max_online[0]['all_max_online']))
{
	$all_max_online[0]['all_max_online'] =0;
}
if ($max_online[0]['maxNum'] > $all_max_online[0]['all_max_online'])
{
	$all_max_online[0]['all_max_online'] = $max_online[0]['maxNum'];
}

$final_out = array( 'now_time' => $now_online[0]['dateline'],
					'now_online' => $now_online[0]['online'],
					'max_online' => $max_online[0]['maxNum'],
					'min_online' => $min_online[0]['minNum'],
					'all_max_online' => $all_max_online[0]['all_max_online']);

$sql = 'INSERT INTO `'.$dbConfig['dbname'].'`.`t_log_online_summary` ' .
	   '(`id`, `now_time`, `now_online`, `max_online`, `min_online`, `all_max_online`) VALUES ' .
	   '(NULL, \'' .
	   $now_online[0]['dateline'] .
	   '\', \'' .
	   $now_online[0]['online'] .
	   '\', \'' .
	   $max_online[0]['maxNum'] .
	   '\', \'' .
	   $min_online[0]['minNum'] .
	   '\', \'' .
	   $all_max_online[0]['all_max_online'] .
	   '\');'; 
$db->query($sql);
echo json_encode(1);
die();
