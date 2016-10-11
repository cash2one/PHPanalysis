<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//nickname={$role}&time={$time}&ticket={$sign} 

//1:成功 0：失败
//{‘code’:1,’msg’:’’} 

$reason = array(
	1 => '参数不全',
	2 => '验证失败',
	3 => '角色不存在',
	4 => '角色已经下线',
);

$nickname = trim($_REQUEST['nickname']);
$nickname2 = urldecode($nickname);
$time = trim($_REQUEST['time']);
$ticket = trim($_REQUEST['ticket']);

if (empty($nickname) || empty($time) || empty($ticket))
{
	$result = array(
		'code' => 0,
		'msg' => $reason[1],
	);
}
else
{
	$token = md5($nickname2 . $time . $API_SECURITY_TICKET_DATA);
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
		$sqlCount="SELECT `role_id` FROM `db_role_base_p` WHERE `role_name` = '{$nickname2}' ";
		$accounttemp = $db->fetchOne($sqlCount);
		$role_id=$accounttemp['role_id'];
		if(!isset($accounttemp['role_id'])) 
		{
			$result = array(
				'code' => 0,
				'msg' => $reason[3],
			);
			echo(json_encode($result));
			die();
		}
		
		$result_kill = getJson($erlangWebAdminHost."killuser/kill_user_role/"
			."?role_id={$role_id}");
		if ($result_kill['result']=='ok') 
		{
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


