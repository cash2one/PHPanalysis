<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
//include "../admin/class/admin_log_class.php";
global $db;

//nickname={$role}&minutes={$min}&time={$time}&ticket={$sign}

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
$minutes = trim($_REQUEST['minutes']);
$time = trim($_REQUEST['time']);
$ticket = trim($_REQUEST['ticket']);

if (empty($nickname) || empty($minutes) || empty($time) || empty($ticket))
{
	$result = array(
		'code' => 0,
		'msg' => $reason[1],
	);
}
else
{
	$token = md5($nickname2 . $minutes . $time . $API_SECURITY_TICKET_DATA);
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
		
		$chatTime = $minutes * 60;
		
		$result_stop_chat = getJson($erlangWebAdminHost."killuser/stop_chat/"
            ."?role_id={$role_id}&chat_time={$chatTime}");
		if ($result_stop_chat['result']=='ok') 
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


