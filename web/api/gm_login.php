<?php
/**
 * GM登陆玩家账号接口 
 * @author wangxuefeng@4399.com
 * @date 2011.07.07
 * 传入参数:account
 * 		 date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(account+date+time+key)
 * 返回：登陆游戏
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


//-1:参数不全 -2:验证失败 -3:账号不存在
$account = trim($_REQUEST['account']);
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
if (empty($account) || empty($date) || empty($time) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($account. $date . $time . $API_SECURITY_TICKET_DATA);
	//echo $token;
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

//$sql = "SELECT * FROM `db_account_p` WHERE account_name='{$account}'";
//$result = $db->fetchOne($sql);
//if(empty($result))
//{
//	echo(json_encode(-3));
//	die();
//}

$time = time();
$cm = 1;
$flag2 = md5($account.$time.$API_SECURITY_TICKEY_LOGIN.$cm);	
header("Location:http://".WEB_SITE."/start.php?username=".urlencode($account)."&time=".$time."&cm=".$cm."&flag=".$flag2);
