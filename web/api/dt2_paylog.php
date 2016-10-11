<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

####充值记录
/* 
 * id	自增主键	返回大于这个id的充值记录
 * time	当前时间戳	使签名每次不同，无其他用途
 * sign	身份验证签名	加密规则：md5($id.$key.$time)
 * $key 为双方约定的私鈅
 */
 
/*order	订单号	可用于财务对账的订单号
agent	运营商简称/代号	
user	充值账号	
money	原始金额	单位：元，可包含小数位，如10.5
gold	元宝数	
server	游戏服	格式：Sn ，n为大于0的整数
time	充值时间	时间戳
*/

 
$id = trim($_REQUEST['id']);
$time = trim($_REQUEST['time']);
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";

$server_stat = $ALL_SERVER_LIST[$AGENT_ID][$GAME_SERVER]['stat'];
if($server_stat != 1)
{
	echo json_encode("error_".$server_stat);
	die();
}

$token = md5($id . $key . $time);
//echo $token;echo "<br>";
if($token != $sign) 
{
	echo(json_encode("sign error"));
	die();
}
else
{
	$sql = "SELECT id, order_id, account_name, pay_money, pay_gold, pay_time" .
		" FROM db_pay_log_p WHERE id>{$id} order by id asc";
	$result = $db->FetchAll($sql);
	//	print_r($result);echo "<br>";
	if(!empty($result))
	{
		foreach($result as $key => $value)
		{
			$result[$key]['agent'] = $AGENT_ID;
			$result[$key]['server'] = $GAME_SERVER;
		}
		$last_id = $result[count($result)-1]['id'];
		
		//	print_r($result); echo "<br>";
		
		echo json_encode(array($last_id => $result));	
	}
	else
	{
		echo json_encode($result);
	}	
}

