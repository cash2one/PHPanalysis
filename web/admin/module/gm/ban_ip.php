<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty;

$now_time = time();
$username = $_SESSION['admin_user_name'];
$ip = trim($_POST['ip']);
if (!empty($ip))
{
	if(strcmp(long2ip(sprintf("%u",ip2long($ip))),$ip))
	{
		errorExit("IP地址的格式不正确！");
	}
}
$online_cnt = -1;
$admin_id = 0;
$action = trim($_GET['action']);
if ($action == 'import')
{
	$ip_result = getJson ( $erlangWebAdminHost."gm/get_ban_ip/");
	foreach($ip_result as $value)
	{
		$sql_insert_ip = "INSERT INTO `{$dbConfig['dbname']}`.`t_ban_ip` (`id` ,`last_login_ip` ,`end_time` ,`ban_reason` ,`admin`) " .
			"VALUES (NULL , '{$value['ip']}', '{$value['deadline']}', '旧服封禁的IP，未记录原因', '{$username}');";
		$db->query($sql_insert_ip);
	}
}
else if ($action == 'countOnline') 
{
	$sql_ip_cnt = "SELECT count(b.role_id) as cnt" .
		" FROM db_account_p as a, db_role_ext_p as e, db_role_base_p as b " .
		" WHERE a.last_login_ip='{$ip}' AND a.account_name=b.account_name AND e.role_id=b.role_id";
	$ip_cnt = $db->fetchOne($sql_ip_cnt);		
	$online_cnt = $ip_cnt['cnt'];
}
else if ($action == 'doBanIp')
{
	$ban_time = SS($_REQUEST['ban_time']);
	$ban_time_cnt = getBanTime($ban_time);
	$end_time = time() + $ban_time_cnt;
	$ban_reason = $_REQUEST['ban_reason'];
	
	$result_ban_ip = getJson ($erlangWebAdminHost."gm/ban_ip/"
		."?ip={$ip}&ban_time={$ban_time_cnt}&admin_id={$admin_id}");
	
	if($result_ban_ip['result'] == 'ok')
	{
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_BAN_IP, $ban_reason, '','', '', $ip);
		
		$sql = "SELECT id FROM t_ban_ip WHERE last_login_ip='{$ip}'";
		$ip_rst = $db->fetchOne($sql);
		if(!empty($ip_rst))
		{
			$sql_update = "UPDATE `{$dbConfig['dbname']}`.`t_ban_ip` SET `end_time` = '{$end_time}' WHERE `t_ban_ip`.`id` ='{$ip_rst['id']}';";
			$db->query($sql_update);
		}
		else
		{
			$sql_insert_ip = "INSERT INTO `{$dbConfig['dbname']}`.`t_ban_ip` (`id` ,`last_login_ip` ,`end_time` ,`ban_reason` ,`admin`) " .
				"VALUES (NULL , '{$ip}', '{$end_time}', '{$ban_reason}', '{$username}');";
			$db->query($sql_insert_ip);
		}
		
		infoExit("封禁IP成功");
	}
	else
	{
		errorExit("封禁IP失败");
	}
}
else if($action == 'doUnBanIp')
{
	$unban_ip = $_REQUEST ['unBanIp'];
	if (!empty($unban_ip))
	{
		$result_dis_ban_ip = getJson ($erlangWebAdminHost."gm/dis_ban_ip/"
			."?ip={$unban_ip}");
		
		if($result_dis_ban_ip['result'] == 'ok')
		{
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_UNBAN_IP,'', '','', '', $ip);
			
			$sql_update = "UPDATE `{$dbConfig['dbname']}`.`t_ban_ip` SET `end_time` = '{$now_time}' WHERE `t_ban_ip`.`last_login_ip` ='{$unban_ip}';";
			$db->query($sql_update);
			
			infoExit("解封IP成功");
		}
		else
		{
			errorExit("IP没有被封禁，无需解封");
		}
		
	}
}

$sql_all_ban_ip = "SELECT * FROM t_ban_ip WHERE end_time>'{$now_time}'";
$all_ban_ip = $db->fetchAll($sql_all_ban_ip);

$ban_time_option = getBanTimeOption($buf_lang);
$smarty->assign("ban_time_option", $ban_time_option);
$smarty->assign("online_cnt", $online_cnt);
$smarty->assign("ip", $ip);
$smarty->assign("ban_ip_list", $all_ban_ip);
$smarty->display("module/gm/ban_ip.html");

function getBanTimeOption($arr_lang = array())
	{
	return array(
		"null" 			    => $arr_lang['left']['select'],
		"one_hour"          => '1'.$arr_lang['left']['after_hour'],
		"three_hour"        => ' 3'.$arr_lang['left']['after_hour'],
		"five_hour"         => ' 5'.$arr_lang['left']['after_hour'],
		"twenty_four_hour"  => ' 24'.$arr_lang['left']['after_hour'],
		"seventy_two_hour"  => ' 72'.$arr_lang['left']['after_hour'],
		"one_week"          => ' 1'.$arr_lang['left']['after_week'],
		"one_month"         => ' 1'.$arr_lang['left']['after_month'],
		"forever"           => $arr_lang['left']['forever'],
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