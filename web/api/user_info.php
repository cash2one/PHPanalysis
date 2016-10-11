<?php
/**
 * 3.18	玩家信息查询接口 
 * @author wangxuefeng@4399.com
 * @date 2011.08.01
 * 传入参数:username=AAAA
 * 		 date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(username+date+time+key)
 * 返回：角色名，账号，在线状态(1->在线，0->离线)，门派，帮派，等级，不绑定元宝，绑定元宝，银两
 * 	   role_name, account_name， is_online, category, family_name, level, gold_unbind, gold_bind, silver
 */
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//-1:参数不全 -2:验证失败
$username = trim($_REQUEST['username']);
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
if (empty($username) || empty($date) || empty($time) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($username . $date . $time . $API_SECURITY_TICKET_DATA);
	//echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}
//role_name, account_name， is_online, category, family_name, level, gold_unbind, gold_bind, silver
$sql = "SELECT b.role_name, b.account_name, e.is_online, b.category, b.family_name, a.level," .
		" a.gold as gold_unbind, a.gold_bind, a.silver" .
	   " FROM db_role_base_p as b, db_role_ext_p as e, db_role_attr_p as a" .
	   " WHERE b.role_id=e.role_id AND b.role_id=a.role_id AND b.account_name='{$username}' and b.server_id='{$GAME_SERVER}'";

$result = $db->fetchAll($sql);
foreach($result as $key=>$value)
{
	switch ($value['category'])
	{
		case 1:
			$result[$key]['category'] = '天刀门';
			break;
		case 2:
			$result[$key]['category'] = '奕剑门';
			break;
		case 3:
			$result[$key]['category'] = '阴葵派';
			break;
		case 4:
			$result[$key]['category'] = '慈航静斋';
			break;
		default:
			break;	
	}
}
//print_r($result);
echo json_encode($result);
