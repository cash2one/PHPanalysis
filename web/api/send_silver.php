<?php
/**
 * 银两发送接口 
 * @author wangxuefeng@4399.com
 * @date 2011.08.22
 * 传入参数:account
 * 		 number
 * 		 date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(account+number+bind+date+time+key)
 * 		 reason (字符之間不要有空格)
 * 返回：1:發送银两成功 0：發送银两失敗 -1:参数不全 -2:验证失败 -3:账号不存在
 */
 
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include "../admin/class/admin_log_class.php";
global $db;

//-1:参数不全 -2:验证失败 -3:账号不存在
$account = trim($_REQUEST['account']);
$number = intval(trim($_REQUEST['number']));
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
$reason = trim($_REQUEST['reason']);

$reason_log = $reason;

$reason = str_replace("\\'", "'", $reason); // 还原 '
$reason = str_replace("\\\"", "\"", $reason);  // 还原 "
$reason = str_replace("\\\\", "\\", $reason);  // 还原 \
$reason = urlencode($reason);

if (empty($account) || empty($number) || empty($date) || empty($time) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($account. $number. $date . $time . $API_SECURITY_TICKET_DATA);
	//echo $token;
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

$sql = "SELECT role_id, role_name FROM `db_role_base_p` where account_name='{$account}' AND server_id='{$GAME_SERVER}'";
$result = $db->fetchOne($sql);
if(empty($result))
{
	echo(json_encode(-3));
	die();
}

$role_id = $result['role_id'];
$role_name = $result['role_name'];

$role_name_log = $role_name;
$role_name = str_replace("\\'", "'", $role_name); // 还原 '
$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \
$role_name = urlencode($role_name);
	
$result = getJson($erlangWebAdminHost."pay/send_silver/"
	."?reason={$reason}&role_id={$result['role_id']}&role_name={$result['role_name']}&"
	."number={$number}&type=account");
if ($result['result'] == 'ok') 
{
	ReviewApiLog(AdminLogClass::TYPE_API_SEND_SILVER, '', $number, '', $role_id, $role_name_log, 'send_silver', '0', '0', $reason_log); 
	
	echo(json_encode(1));
	die();
} 
else 
{
	echo(json_encode(0));
	die();        
}

function ReviewApiLog($type, $detail, $number, $desc, $user_id, $user_name, $item_name, $item_id, $bind, $reason)
{
	$f['admin_id']   = '';
	$f['admin_name'] = '';
	$f['admin_ip']   = '';
	
	$f['user_id']    = $user_id;
	$f['user_name']  = $user_name;
	
	$f['mtime']    = time();
	$f['mtype']    = $type;
	$f['mdetail']  = $detail;
	$f['number']   = $number;
	if (!empty($desc))
		$f['desc']     = $desc;
	else {
		global $ADMIN_LOG_TYPE;
		$f['desc']     = $ADMIN_LOG_TYPE[$type];
	}
	
	$f['item_name'] = $item_name;
	$f['item_id'] = $item_id;
	$f['bind'] = $bind;
	$f['reason'] = $reason;
	$f['status'] = '4';
	$f['review_admin_id'] = '';
	$f['review_admin_ip'] = '';
	$f['review_admin_name'] = '';
	$f['review_mtime'] = time();
	
	global $dbConfig;
	$sql = 'INSERT INTO `'.$dbConfig['dbname'].'`.`t_log_review` (`admin_id`, `admin_name`, `admin_ip`, `user_id`, `user_name`,`mtime`,`mtype`,`mdetail`,`number`,`desc`,' .
		'`item_name`, `item_id`, `bind`, `reason`, `status`, `review_admin_id`, `review_admin_name`, `review_admin_ip`, `review_mtime`)' .
		' VALUES (\'' .$f['admin_id'].'\',\'' .$f['admin_name'].'\', \'' .$f['admin_ip'].'\', \'' .$f['user_id'].'\', \'' .$f['user_name'].'\', \'' .$f['mtime'].'\', \'' .$f['mtype'].'\', \'' .$f['mdetail'].'\', \'' .$f['number'].'\', \'' .$f['desc'].'\',  \'' .$f['item_name'].'\', \'' .$f['item_id'].'\', \'' .$f['bind'].'\', \'' .$f['reason'].'\', \'' .$f['status'].'\', \'' .$f['review_admin_id'].'\', \'' .$f['review_admin_name'].'\', \'' .$f['review_admin_ip'].'\', \'' .$f['review_mtime'].'\');';
	global $db ;
	$db->query($sql);
}


