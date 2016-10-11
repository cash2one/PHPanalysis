<?php
/**
 * 恶人排名 
 * @author wangxuefeng@4399.com
 * @date 2011.08.25
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：恶人排行：排名，角色名，PK值，杀人数，等级，帮派，门派，vip等级
 *     {rank, role_name, pk_point, kill_num, role_level, family_name, category, vip_grade}
 * 
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
	//echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

$sql = "SELECT rank, role_name, pk_point, kill_num, role_level, family_name, category, vip_grade FROM t_ranking_villain " .
		" ORDER BY rank asc LIMIT 0, 100";
$result = GFetchRowSet($sql);

foreach($result as $key => $value)
{
	if($value['category'] == 1)
	{
		$result[$key]['category'] = '天刀门';
	}
	else if($value['category'] == 2)
	{
		$result[$key]['category'] = '弈剑门';
	}
	else if($value['category'] == 3)
	{
		$result[$key]['category'] = '阴葵派';
	}
	else if($value['category'] == 4)
	{
		$result[$key]['category'] = '慈航静斋';		
	}	
}
//print_r($result);
echo json_encode($result);
 