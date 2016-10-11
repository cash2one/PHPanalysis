<?php
/**
 * 玩家创建角色信息接口
 * @author zengjintong
 * @date 2011.06.01
 * 传入参数：日期:YYYY-MM-DD
 * 返回：当日玩家账号，玩家创建角色名称，创建时间
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

$sql = "SELECT account_name, role_name, from_unixtime(create_time) create_time FROM db_role_base_p ";
$sql .= " WHERE create_time >= ".$starttime." AND create_time <=".$endtime;

$keywordlist = $db->fetchAll($sql);

$result = json_encode($keywordlist);

echo($result);
/*
$countnum = count($keywordlist);
for($i=0;$i<$countnum;$i++)
{
	echo $keywordlist[$i][account_name];
	echo " ";
	echo $keywordlist[$i][role_name];
	echo " ";
	echo $keywordlist[$i][create_time];
	echo "\n";
}*/
//echo $keywordlist;




