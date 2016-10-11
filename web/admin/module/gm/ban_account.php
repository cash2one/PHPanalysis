<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty;

$role_id = trim (SS($_REQUEST ['role_id']));
$role_name = trim (SS($_REQUEST ['role_name']));
$account_name = trim (SS($_REQUEST ['account_name']));
$ip_addr = trim (SS($_REQUEST ['ip_addr']));
$now_time = time();
$username = $_SESSION['admin_user_name'];

$get_first_one = array(); 
$same_ip_result = array();

$get_one_ban = array();
$get_other_ban = array();

$action = trim($_GET['action']);
if ($action == 'import')
{
	//游戏服封禁的账号
	$game_result = getJson ( $erlangWebAdminHost."gm/get_ban_role/");
	foreach ($game_result as $value)
	{
		$sql_one = "SELECT b.role_id, b.role_name, b.account_name, a.last_login_ip, t.level, t.reincarnation, e.is_online," .
				" IF ((select round(sum(pay.pay_money)/100,2) from db_pay_log_p as pay where pay.role_id=b.role_id group by pay.role_id) IS NULL, 0, " .
				" (select round(sum(pay.pay_money)/100,2) from db_pay_log_p as pay where pay.role_id=b.role_id group by pay.role_id)) as pay_all " .
				" FROM db_role_base_p as b, db_account_p as a, db_role_attr_p as t, db_role_ext_p as e" .
				" WHERE a.agent_id = ".$AGENT_ID." and a.server_id = ".$GAME_SERVER." and b.account_name=a.account_name AND b.role_id=t.role_id AND b.role_id=e.role_id" .
				" AND b.account_name='{$value['rolename']}' AND b.role_id not in" .
				" (select role_id from t_ban_account where end_time>'{$now_time}')";
		$get_one = $db->fetchOne($sql_one);
		
		//插入到后台数据库
		$insert_sql = "INSERT INTO `t_ban_account` (`role_id`, `role_name`, `account_name`, `last_login_ip`, `level`, `pay_all`, `start_time`, `end_time`, `ban_reason`, `admin`) VALUES" .
			" ('{$get_one['role_id']}', '{$get_one['role_name']}', '{$get_one['account_name']}', '{$get_one['last_login_ip']}', '{$get_one['level']}', '{$get_one['pay_all']}', '{$now_time}', '{$value['deadline']}', '旧服封禁的账号，未记录原因', '{$username}')";

		$db->query($insert_sql);
	}
}
else if ($action == 'search') 
{
	if (!empty($role_id) || !empty($role_name) || !empty($account_name))
	{
		$sql = "SELECT b.role_id, b.role_name, b.account_name, a.last_login_ip, b.agent_id, b.server_id FROM db_role_base_p as b, db_account_p as a WHERE b.account_name=a.account_name";
		if (!empty($role_id))
		{
			$sql .= " AND b.role_id='{$role_id}'";
		}
		else if (!empty($role_name))
		{
			$sql .= " AND b.role_name='{$role_name}'";
		}
		else if (!empty($account_name))
		{
			$sql .= " AND b.account_name='{$account_name}'";
		}
		
		$role_result = $db->fetchOne($sql);
		$one_role_id = $role_result['role_id'];
		$ip_addr = $role_result['last_login_ip'];
	}
	if (!empty($ip_addr))
	{
		if (!empty($one_role_id))
		{
			$sql_first_one = "SELECT b.role_id, b.role_name, b.account_name, a.last_login_ip, t.level, t.reincarnation, e.is_online," .
				" IF ((select round(sum(pay.pay_money)/100,2) " .
				" from db_pay_log_p as pay " .
				" where pay.role_id=b.role_id group by pay.role_id) IS NULL, 0, " .
				" (select round(sum(pay.pay_money)/100,2) " .
				" from db_pay_log_p as pay " .
				" where pay.role_id=b.role_id group by pay.role_id)) as pay_all " .
				" FROM db_role_base_p as b, db_account_p as a, db_role_attr_p as t, db_role_ext_p as e" .
				" WHERE a.agent_id = ".$role_result["agent_id"]." and a.server_id = ".$role_result["server_id"]." and b.account_name=a.account_name AND b.role_id=t.role_id AND b.role_id=e.role_id" .
				" AND b.role_id='{$one_role_id}' AND b.role_id not in" .
				" (select role_id from t_ban_account where end_time>'{$now_time}')";
			$get_first_one = $db->fetchAll($sql_first_one);
			
			$sql_get_one_ban = "SELECT * FROM t_ban_account WHERE end_time > '{$now_time}' AND role_id = '{$one_role_id}'";
			$get_one_ban = $db->fetchAll($sql_get_one_ban);
		}
		
		$sql_ip = "SELECT b.role_id, b.role_name, b.account_name, a.last_login_ip, t.level, t.reincarnation, e.is_online," .
			" IF ((select round(sum(pay.pay_money)/100,2) " .
			" from db_pay_log_p as pay " .
			" where pay.role_id=b.role_id group by pay.role_id) IS NULL, 0, " .
			" (select round(sum(pay.pay_money)/100,2) " .
			" from db_pay_log_p as pay " .
			" where pay.role_id=b.role_id group by pay.role_id)) as pay_all " .
			" FROM db_role_base_p as b, db_account_p as a, db_role_attr_p as t, db_role_ext_p as e" .
			" WHERE b.agent_id = ".$role_result["agent_id"]." and b.server_id = ".$role_result["server_id"]." and a.agent_id = ".$role_result["agent_id"]." and a.server_id = ".$role_result["server_id"]." and b.account_name=a.account_name AND b.role_id=t.role_id AND b.role_id=e.role_id" .
			" AND a.last_login_ip='{$ip_addr}' AND b.role_id not in" .
			" (select role_id from t_ban_account where end_time>'{$now_time}')";
		if (!empty($one_role_id))
		{
			$sql_ip .= " AND b.role_id != '{$one_role_id}'";
		}
		$same_ip_result = $db->fetchAll($sql_ip);
	}
}
else if ($action == 'doBan')
{
	$ban_role_id = trim (SS($_REQUEST ['banRoleID']));
	$ban_role_info =  $_REQUEST['ban']["{$ban_role_id}"];
		
	$start_time = time();
	$ban_time_cnt = getBanTime($ban_role_info['ban_time']);
	$end_time = time() + $ban_time_cnt;
		
	//发送账号到游戏服进行封禁
	$admin_id = 0;
	$account_name_log = $ban_role_info['account_name'];
	
	$ban_role_info['account_name'] = str_replace("\\'", "'", $ban_role_info['account_name']); // 还原 '
	$ban_role_info['account_name'] = str_replace("\\\"", "\"", $ban_role_info['account_name']);  // 还原 "
	$ban_role_info['account_name'] = str_replace("\\\\", "\\", $ban_role_info['account_name']);  // 还原 \
	$ban_role_info['account_name'] = urlencode($ban_role_info['account_name']);

	if($ban_role_info['is_online'])
    	$result = getJson($erlangWebAdminHost."killuser/stop_chat/?role_id={$ban_role_info['role_id']}&chat_time={$ban_time_cnt}");

	$result_ban_role = getJson ($erlangWebAdminHost."gm/ban_role/?role_name={$ban_role_info['account_name']}&role_id={$ban_role_info['role_id']}&ban_time={$ban_time_cnt}&admin_id={$admin_id}");
	
	if ($result_ban_role['result']=='ok')
	{
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_BAN_USER, $ban_role_info['ban_reason'], '','', $ban_role_info['role_id'], $account_name_log);
		
		//插入封禁信息到MySQL
		$insert_sql = "INSERT INTO `t_ban_account` (`role_id`,`role_name`,`account_name`,`last_login_ip` ,`level`, `pay_all`, `start_time` ,`end_time` ,`ban_reason` ,`admin`) " .
			" VALUES ('{$ban_role_info['role_id']}', '{$ban_role_info['role_name']}', '{$account_name_log}', '{$ban_role_info['last_login_ip']}', '{$ban_role_info['level']}', '{$ban_role_info['pay_all']}', '{$start_time}', " .
			"'{$end_time}', '{$ban_role_info['ban_reason']}', '{$username}')";

        $db->query($insert_sql);
		
		infoExit("封玩家角色帐号成功");
	}
	else
	{
		errorExit ("封禁失败");
	}
}
else if ($action == 'doBanMany')
{
	$ban_role_list = $_REQUEST['Ban_check'];
	$all_succ = true;
	foreach ($ban_role_list as $key => $value)
	{
		$ban_role_info =  $_REQUEST['ban']["{$value}"];
		
		$start_time = time();
		$ban_time_cnt = getBanTime($ban_role_info['ban_time']);
		$end_time = time() + $ban_time_cnt;
		$username = $_SESSION['admin_user_name'];
				
		//发送账号到游戏服进行封禁
		$admin_id = 0;
		
		$account_name_log = $ban_role_info['account_name'];
		
		$ban_role_info['account_name'] = str_replace("\\'", "'", $ban_role_info['account_name']); // 还原 '
        $ban_role_info['account_name'] = str_replace("\\\"", "\"", $ban_role_info['account_name']);  // 还原 "
		$ban_role_info['account_name'] = str_replace("\\\\", "\\", $ban_role_info['account_name']);  // 还原 \
		$ban_role_info['account_name'] = urlencode($ban_role_info['account_name']);

		if($ban_role_info['is_online'])
			$result = getJson($erlangWebAdminHost."killuser/stop_chat/?role_id={$ban_role_info['role_id']}&chat_time={$ban_time_cnt}");

		$result_ban_role = getJson ($erlangWebAdminHost."gm/ban_role/?role_name={$ban_role_info['account_name']}&role_id={$ban_role_info['role_id']}&ban_time={$ban_time_cnt}&admin_id={$admin_id}");
		
		if ($result_ban_role['result']=='ok')
		{
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_BAN_USER,$ban_role_info['ban_reason'], '','', $ban_role_info['role_id'], $account_name_log);
			
			//插入封禁信息到MySQL
			$insert_sql = "INSERT INTO `t_ban_account` (`id`,`role_id`,`role_name`,`account_name`,`last_login_ip` ,`level`, `pay_all`, `start_time` ,`end_time` ,`ban_reason` ,`admin`) " .
				" VALUES ('', '{$ban_role_info['role_id']}', '{$ban_role_info['role_name']}', '{$ban_role_info['account_name']}', " .
				" '{$ban_role_info['last_login_ip']}', '{$ban_role_info['level']}', '{$ban_role_info['pay_all']}', '{$start_time}', " .
				"'{$end_time}', '{$ban_role_info['ban_reason']}', '{$username}')";
			$db->query($insert_sql);
		}
		else
		{
			$all_succ = false;
			//errorExit ("玩家角色账号不存在，封禁失败");
		}
	}
	if ($all_succ)
	{
		infoExit("批量封禁成功");
	}
	else
	{
		errorExit ("批量封禁失败");
	}
}
else if ($action == 'doUnBan')
{
	$unban_role_id = trim (SS($_REQUEST ['unBanRoleID']));
	$unban_role_info =  $_REQUEST['unBan']["{$unban_role_id}"];
	
	//发送到游戏服解封账号	
	
	$unban_acc_log = $unban_role_info['account_name'];
	
	$unban_role_info['account_name'] = str_replace("\\'", "'", $unban_role_info['account_name']); // 还原 '
	$unban_role_info['account_name'] = str_replace("\\\"", "\"", $unban_role_info['account_name']);  // 还原 "
	$unban_role_info['account_name'] = str_replace("\\\\", "\\", $unban_role_info['account_name']);  // 还原 \
	$unban_role_info['account_name'] = urlencode($unban_role_info['account_name']);


	
	$result_dis_ban_role = getJson ($erlangWebAdminHost."gm/dis_ban_role/?role_name={$unban_role_info['account_name']}");
	
	if ($result_dis_ban_role['result']=='ok')
	{
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_UNBAN_USER,'', '','', $unban_role_id, $unban_acc_log);
		
		//修改结束时间为当前时间
		$sql_update = "UPDATE `{$dbConfig['dbname']}`.`t_ban_account` SET `end_time` = '{$now_time}' WHERE `t_ban_account`.`role_id` ='{$unban_role_id}';";
		$db->query($sql_update);
		
		infoExit("解封玩家角色帐号成功");
	}
	else
	{
		errorExit ("解封玩家角色帐号失败");
	}
}
else if ($action == 'doUnBanMany')
{
	$unban_role_list = $_REQUEST['unBan_check'];
	$all_succ = true;
	
	foreach ($unban_role_list as $key=>$value)
	{
		$unban_role_info =  $_REQUEST['unBan']["{$value}"];
		
		$unban_acc_log = $unban_role_info['account_name'];
		
		$unban_role_info['account_name'] = str_replace("\\'", "'", $unban_role_info['account_name']); // 还原 '
                $unban_role_info['account_name'] = str_replace("\\\"", "\"", $unban_role_info['account_name']);  // 还原 "
                $unban_role_info['account_name'] = str_replace("\\\\", "\\", $unban_role_info['account_name']);  // 还原 \
                $unban_role_info['account_name'] = urlencode($unban_role_info['account_name']);

		$result_dis_ban_role = getJson ($erlangWebAdminHost."gm/dis_ban_role/"
			."?role_name={$unban_role_info['account_name']}");
		
		if ($result_dis_ban_role['result']=='ok')
		{
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_UNBAN_USER,'', '','', $unban_role_info['role_id'], $unban_acc_log);
			
			//修改结束时间为当前时间
			$sql_update = "UPDATE `{$dbConfig['dbname']}`.`t_ban_account` SET `end_time` = '{$now_time}' WHERE `t_ban_account`.`role_id` ='{$unban_role_info['role_id']}';";
			$db->query($sql_update);
		}
		else
		{
			$all_succ = false;
			//errorExit ("解封玩家角色帐号失败");
		}
	}
	if ($all_succ)
	{
		infoExit("批量解封成功");
	}
	else
	{
		errorExit ("批量解封失败");
	}
}


$sql_get_all_ban = "SELECT * FROM `t_ban_account` WHERE end_time>'{$now_time}'";
if(!empty($role_id))
{
	$sql_get_all_ban .= " AND role_id != '{$role_id}'";
}
else if(!empty($role_name))
{
	$sql_get_all_ban .= " AND role_name != '{$role_name}'";
}
else if(!empty($account_name))
{
	$sql_get_all_ban .= " AND account_name != '{$account_name}'";
}
$get_other_ban = $db->fetchAll($sql_get_all_ban);

$sql_get_h = "SELECT * FROM `t_ban_account` WHERE end_time<'{$now_time}'";
if(!empty($role_id))
{
    $sql_get_h .= " AND role_id != '{$role_id}'";
}
else if(!empty($role_name))
{
    $sql_get_h .= " AND role_name != '{$role_name}'";
}
else if(!empty($account_name))
{
    $sql_get_h .= " AND account_name != '{$account_name}'";
}
$get_other_ban_h = $db->fetchAll($sql_get_h);


$ban_time_option = getBanTimeOption();
$smarty->assign("ban_time_option", $ban_time_option);
$smarty->assign("role", $role_result);
$smarty->assign("ip_addr", $ip_addr);
$smarty->assign("same_ip_rst", array_merge($get_first_one, $same_ip_result));
$smarty->assign("all_ban_account", array_merge($get_one_ban, $get_other_ban));
$smarty->assign("get_other_ban_h", $get_other_ban_h);
$smarty->display("module/gm/ban_account.html");


function getBanTimeOption()
{
    return array(
        "null" 			    => '请选择',
        "one_hour"          => '1小时',
        "three_hour"        => '3小时',
        "five_hour"         => '5小时',
        "twenty_four_hour"  => '24小时',
        "seventy_two_hour"  => '72小时',
        "one_week"          => '1周',
        "one_month"         => '1个月',
        "forever"           => '永久',
    );
}

function getBanTime($str)
{
    $BanTimeCnt = 0;
    switch ($str)
    {
        case "one_hour":
            $BanTimeCnt = 3600;
            break;
        case "three_hour":
            $BanTimeCnt = 10800;
            break;
        case "five_hour":
            $BanTimeCnt = 18000;
            break;
        case "twenty_four_hour":
            $BanTimeCnt = 86400;
            break;
        case "seventy_two_hour":
            $BanTimeCnt = 259200;
            break;
        case "one_week":
            $BanTimeCnt = 604800;
            break;
        case "one_month":
            $BanTimeCnt = 2592000;
            break;
        case "forever":
            $BanTimeCnt = 3153600000;   //100年
            break;
        default:
            break;
    }
    return $BanTimeCnt;
}
