<?php
/**
 * 3.12	用户当前在线查询接口 
 * @author wangxuefeng@4399.com
 * @date 2011.07.30
 * 传入参数:username=AAAA
 * 		 date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(username+date+time+key)
 * 返回：玩家账号，角色名称，在线时长，帮派，门派
 * 	   account_name, role_name, online_second_cnt, family_name, category
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
if (empty($date) || empty($time) || empty($flag))
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

$sql = "SELECT b.role_name, b.account_name, e.last_login_time, b.family_name, b.category" .
	   " FROM db_role_base_p as b, db_role_ext_p as e" .
	   " WHERE e.is_online=1 and b.role_id=e.role_id";
if (!empty($username))
{
	$sql .= " AND b.account_name='{$username}' and b.server_id='{$GAME_SERVER}'";
}
$sql .= " ORDER BY e.role_id asc";
$result = $db->fetchAll($sql);

$final_out = array();
foreach($result as $key => $value)
{
	$final_out[$key]['account_name'] = $value['account_name'];
	$final_out[$key]['role_name'] = $value['role_name'];
	$final_out[$key]['online_second_cnt'] = time() - $value['last_login_time'];
	$final_out[$key]['family_name'] = $value['family_name'];
	switch ($value['category'])
	{
		case 1:
			$final_out[$key]['category'] = '天刀门';
			break;
		case 2:
			$final_out[$key]['category'] = '奕剑门';
			break;
		case 3:
			$final_out[$key]['category'] = '阴葵派';
			break;
		case 4:
			$final_out[$key]['category'] = '慈航静斋';
			break;
		default:
			break;
			
	}
}
echo json_encode($final_out);

