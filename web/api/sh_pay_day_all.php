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
	//echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

//台湾充值统计除以汇率（4.75）
if($AGENT_ID == 2)
{
	$sql = 'SELECT pay_time, year , month , day , round(sum(pay_money)/475,2) as pay_day, count(distinct role_id) as role_cnt,' .
		' count(role_id) as times_cnt, round(sum(pay_money)/475/(count(distinct role_id)), 2) as arpu' .
		' FROM `db_pay_log_p` '
		. ' where 1'
		. ' group by from_unixtime(pay_time, \'%Y\') , from_unixtime(pay_time, \'%m\') , from_unixtime(pay_time, \'%d\') order by year desc, month desc, day desc'; 
}
else
{
	$sql = 'SELECT pay_time, year , month , day , round(sum(pay_money)/100,2) as pay_day, count(distinct role_id) as role_cnt,' .
		' count(role_id) as times_cnt, round(sum(pay_money)/100/(count(distinct role_id)), 2) as arpu' .
		' FROM `db_pay_log_p` '
		. ' where 1'
		. ' group by from_unixtime(pay_time, \'%Y\') , from_unixtime(pay_time, \'%m\') , from_unixtime(pay_time, \'%d\') order by year desc, month desc, day desc'; 
}
$result = GFetchRowSet($sql);

if(!empty($result))
{
	$sql = 'REPLACE INTO `'.$dbConfig['dbname'].'`.`t_log_pay_day` (`id`, `pay_day`, `role_cnt`, `times_cnt`, `arpu`, ' .
		'`year`, `month`, `day`, `agent_id`, `game_server_id`) VALUES ';
	$comma_flag = false;
	foreach($result as $kkk => $vvv)
	{
		$result[$kkk]['agent_id'] = $AGENT_ID;
		$result[$kkk]['game_server_id'] = $GAME_SERVER;
		$result[$kkk]['id'] = strftime("%Y-%m-%d",$vvv['pay_time']).'-'.agentid_to_str($AGENT_ID).'-'.gameid_to_str($GAME_SERVER);
		
		if($comma_flag)
		{
			$sql .= ', ';
		}
		$sql .= '(\'' .
			$result[$kkk]['id'] .
			'\', \'' .
			$vvv['pay_day'] .
			'\', \'' .
			$vvv['role_cnt'] .
			'\', \'' .
			$vvv['times_cnt'] .
			'\', \'' .
			$vvv['arpu'] .
			'\', \'' .
			$vvv['year'] .
			'\', \'' .
			$vvv['month'] .
			'\', \'' .
			$vvv['day'] .
			'\', \'' .
			$result[$kkk]['agent_id'] .
			'\', \'' .
			$result[$kkk]['game_server_id'] .
			'\')';
		$comma_flag = true;	
	}
	$sql .= ';';
	$db->query($sql);
}	   

echo json_encode($result);
die();

function agentid_to_str($agent_id)
{
	if($agent_id < 10)
	{
		return '0'.$agent_id;		
	}
	else
	{
		return $agent_id;
	}
}
function gameid_to_str($game_id)
{
	if($game_id < 10)
	{
		return '000'.$game_id;
	}
	else if($game_id < 100)
	{
		return '00'.$game_id;
	}
	else if($game_id < 1000)
	{
		return '0'.$game_id;
	}
	else
	{
		return $game_id;
	}
}

