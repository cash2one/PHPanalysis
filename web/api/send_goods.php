<?php
/**
 * 道具發送接口 
 * @author wangxuefeng@4399.com
 * @date 2011.07.08
 * 传入参数:account
 * 		 type 1:道具 2:寶石 3:裝備 5:坐騎 6:坐騎裝備
 * 		 itemid
 * 		 number
 * 		 bind=1|2 （1:綁定元寶 2：不綁定元寶）
 * 		 date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(account+type+item_id+number+bind+date+time+key)
 * 		 reason (字符之間不要有空格)
 * 返回：1:發送道具成功 0：發送道具失敗 -1:参数不全 -2:验证失败 -3:账号不存在 -4:道具ID與類型不符
 */
 
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include "../admin/class/admin_log_class.php";
global $db;

$ITEM_TYPE = array(
	1 => 'send_item',
	2 => 'send_stone',
	3 => 'send_equip',
	5 => 'send_mount',
	6 => 'send_mount_equip',
);

//-1:参数不全 -2:验证失败 -3:账号不存在
$account = trim($_REQUEST['account']);
$type = intval(trim($_REQUEST['type']));
$item_id = intval(trim($_REQUEST['itemid']));
$number = intval(trim($_REQUEST['number']));
$bind = intval(trim($_REQUEST['bind']));
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
$reason = trim($_REQUEST['reason']);

$reason_log = $reason;

$reason = str_replace("\\'", "'", $reason); // 还原 '
$reason = str_replace("\\\"", "\"", $reason);  // 还原 "
$reason = str_replace("\\\\", "\\", $reason);  // 还原 \
$reason = urlencode($reason);

if (empty($account) || empty($type) || empty($item_id) || empty($number) || empty($bind) || empty($date) || empty($time) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($account. $type. $item_id. $number. $bind. $date . $time . $API_SECURITY_TICKET_DATA);
	//echo $token.'<br>';
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

if($type ==1)  //道具
{
	if(!ereg("^1", $item_id))
	{
		echo(json_encode(-4));
		die();
	}
}
else if($type == 2)  //寶石
{
	if(!ereg("^2", $item_id))
	{
		echo(json_encode(-4));
		die();
	}
}
else if($type == 3)  //裝備
{
	if(!ereg("^3", $item_id))
	{
		echo(json_encode(-4));
		die();
	}
}
else if($type == 5)  //坐騎
{
	if(!ereg("^5", $item_id))
	{
		echo(json_encode(-4));
		die();
	}
}
else if($type == 6)  //坐騎裝備
{
	if(!ereg("^6", $item_id))
	{
		echo(json_encode(-4));
		die();
	}
}

$item_bind = 2;
if($bind == 1)
{
	$item_bind =1;
}

$role_id = $result['role_id'];
$role_name = $result['role_name'];

$role_name_log = $role_name;
$role_name = str_replace("\\'", "'", $role_name); // 还原 '
$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \
$role_name = urlencode($role_name);

$result = getJson($erlangWebAdminHost."goods/send_goods/" .
		"?&role_id={$result['role_id']}&role_name={$result['role_name']}&number={$number}&type={$type}&typeid={$item_id}&bind={$item_bind}&reason={$reason}");
if ($result['result'] == 'ok')
{
	ReviewApiLog(AdminLogClass::TYPE_API_SEND_ITEM, '', $number, '', $role_id, $role_name_log, $ITEM_TYPE[$type], $item_id, $item_bind, $reason_log);
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

		
		
		