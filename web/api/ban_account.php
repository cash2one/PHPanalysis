<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include "../include/functions.php";
global $db;

//nickname={$role}&account_name={$user}&ban_time={$min}&ban_reason={$reason}&time={$time}&ticket={$sign} 

//1:成功 0：失败
//{‘code’:1,’msg’:’’} 

$reason = array(
	1 => '参数不全',
	2 => '验证失败',
	3 => '账号不存在',
	4 => '账号已封禁',
);

$nickname = trim($_REQUEST['nickname']);
$nickname2 = urldecode($nickname);
$account_name = trim($_REQUEST['account_name']);
$account_name2 = urldecode($account_name);
$ban_time = trim($_REQUEST['ban_time']);
$ban_reason = trim($_REQUEST['ban_reason']);
$ban_reason2 = urldecode($ban_reason);
$time = trim($_REQUEST['time']);
$ticket = trim($_REQUEST['ticket']);

if (empty($nickname) || empty($account_name) || empty($ban_time) || empty($ban_reason) || empty($time) || empty($ticket))
{
	$result = array(
		'code' => 0,
		'msg' => $reason[1],
	);
}
else
{
	$token = md5($nickname2 . $account_name2 . $ban_time . $time . $API_SECURITY_TICKET_DATA);
	#echo $token;echo "<br>";
	if($token != $ticket) 
	{
		$result = array(
			'code' => 0,
			'msg' => $reason[2],
		);
	}
	else
	{
		$sqlCount="SELECT `role_id`, `account_name` FROM `db_role_base_p` WHERE `role_name` = '{$nickname2}' ";
		$accounttemp = $db->fetchOne($sqlCount);
		$role_id=$accounttemp['role_id'];
		$account_name=$accounttemp['account_name'];
		
		if(!isset($accounttemp['role_id'])) 
		{
			$result = array(
				'code' => 0,
				'msg' => $reason[3],
			);
			echo(json_encode($result));
			die();
		}
		
		$operate_user = "1010g_api";
		$ban_role_id = $role_id;
		
		$start_time = time();
		$ban_time_cnt = $ban_time * 60;
		$end_time = time() + $ban_time_cnt;
		
		//发送账号到游戏服进行封禁
		$admin_id = 0;
		
		$account_name_log = $account_name;
		$account_name = urlString($account_name);

		$result_ban_role = getJson ($erlangWebAdminHost."gm/ban_role/"
			."?role_name={$account_name}&role_id={$role_id}&ban_time={$ban_time_cnt}&admin_id={$admin_id}");
		
		if ($result_ban_role['result']=='ok') {

			//插入封禁信息到MySQL
			$insert_sql = "INSERT INTO `t_ban_account` (" .
				"`role_id`,`role_name`,`account_name`,`last_login_ip` ,`level`, `pay_all`," .
				" `start_time` ,`end_time` ,`ban_reason` ,`admin`) " .
				" VALUES ( '$role_id', '$nickname2', '{$account_name_log}', " .
				" '', '', '', '{$start_time}', " .
				"'{$end_time}', '$ban_reason2', '{$operate_user}')";
			$db->query($insert_sql);
			
			$result = array(
				'code' => 1,
				'msg' => "",
			);
		}
		else
		{
			$result = array(
				'code' => 0,
				'msg' => $reason[4],
			);
		}
	}
}


echo(json_encode($result));
die();


