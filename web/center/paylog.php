<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

/* 
 * id	自增主键	返回大于这个id的充值记录
 * time	当前时间戳	使签名每次不同，无其他用途
 * sign	身份验证签名	加密规则：md5($id.$key.$time)
 * $key 为双方约定的私鈅
 */
 
$id = trim($_REQUEST['id']);
$time = trim($_REQUEST['time']);
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";

$token = md5($id . $key . $time);
//echo $token;echo "<br>";
if($token != $sign) 
{
	echo(json_encode("sign_error"));
	die();
}
else
{
	$sql = "SELECT id, order_id, role_id, role_name, account_name, pay_time, pay_gold, pay_money, agent_id FROM db_pay_log_p WHERE id>{$id} order by id asc";
	$result = $db->FetchAll($sql);
    //echo '<pre>';print_r($result);exit;
	if(!empty($result))
	{
		foreach($result as $key => $value)
		{
			$result[$key]['server_id'] = $GAME_SERVER;
		}
		
		$last_id = $result[count($result)-1]['id'];
		
		echo json_encode(array($last_id => $result));
	}
	else
	{
		echo json_encode($result);
	}
}

