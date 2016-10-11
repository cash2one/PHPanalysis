<?php
/**
 * 任务完成记录接口（附加等级）
 * @author 胡斌
 * @date 2011.06.02
 * 传入参数：date=YYYY-MM-DD
 * 		  time= UNIX时间戳
 * 		  flag=md5(date+time+key)
 * 返回：任务ID，任务名称，每个任务完成数量，任务完成级别，各级别完成该任务的数量
 * 	   mission_id,name,comp_num,level,level_complete_num
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
	echo $token;
	if($token != $flag )
	{           
		echo json_encode("-2");
		exit;
	}
}


$time_stamp = $dateStartStamp = strtotime($datetime . ' 0:0:0');
$year = date('Y', $time_stamp);
$month = (int)date('m', $time_stamp);
$day = (int)date('d', $time_stamp);


$sqlCount="SELECT A.mission_id ,A.name,B.comp_num,A.level,A.level_complete_num FROM t_log_mission_complete A ,(select mission_id,sum(level_complete_num) comp_num from t_log_mission_complete where year=".$year." and month=".$month." and day =".$day." group by mission_id)B WHERE  A.year=".$year.
" and A.month=".$month." and A.day=".$day." and A.mission_id=B.mission_id order by mission_id";

$resultCount = $db->fetchAll($sqlCount);

$result = json_encode($resultCount);  

echo($result);


