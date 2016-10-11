<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/10/8
 * Time: 10:29
 */

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
//echo $role_id;exit;
$action = trim($_GET['action']);
if ($action == 'search')
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
        //echo $sql;exit;
        $role_result = $db->fetchOne($sql);
        $one_role_id = $role_result['role_id'];
        $ip_addr = $role_result['last_login_ip'];
        //print_r($role_result);exit;
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
                " (select role_id from t_banned_to_post where end_time>'{$now_time}')";
            $get_first_one = $db->fetchAll($sql_first_one);

            $sql_get_one_ban = "SELECT * FROM t_banned_to_post WHERE end_time > '{$now_time}' AND role_id = '{$one_role_id}'";
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
            " (select role_id from t_banned_to_post where end_time>'{$now_time}')";
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

    //发送账号到游戏服进行禁言
    $admin_id = 0;
    $account_name_log = $ban_role_info['account_name'];

    $ban_role_info['account_name'] = str_replace("\\'", "'", $ban_role_info['account_name']); // 还原 '
    $ban_role_info['account_name'] = str_replace("\\\"", "\"", $ban_role_info['account_name']);  // 还原 "
    $ban_role_info['account_name'] = str_replace("\\\\", "\\", $ban_role_info['account_name']);  // 还原 \
    $ban_role_info['account_name'] = urlencode($ban_role_info['account_name']);

    $url = $erlangWebAdminHost."killuser/stop_chat/?role_id={$ban_role_id}&chat_time={$ban_time_cnt}";
    $result = getJson($url);
    //var_dump($result);exit;
    if ($result['result']=='ok')
    {
        $loger = new AdminLogClass();
        $loger->Log( AdminLogClass::TYPE_BAN_CHAT, $ban_role_info['ban_reason'], '','', $ban_role_info['role_id'], $account_name_log);

        //插入封禁信息到MySQL
        $insert_sql = "INSERT INTO `t_banned_to_post` (`role_id`,`role_name`,`account_name`,`last_login_ip` ,`level`, `pay_all`, `start_time` ,`end_time` ,`ban_reason` ,`admin`) " .
            " VALUES ('{$ban_role_info['role_id']}', '{$ban_role_info['role_name']}', '{$account_name_log}', '{$ban_role_info['last_login_ip']}', '{$ban_role_info['level']}', '{$ban_role_info['pay_all']}', '{$start_time}', " .
            "'{$end_time}', '{$ban_role_info['ban_reason']}', '{$username}')";

        $db->query($insert_sql);

        infoExit("禁言玩家角色帐号成功");
    }
    else
    {
        errorExit ("禁言失败");
    }
}
else if ($action == 'doUnBan')
{
    $unban_role_id = trim (SS($_REQUEST ['unBanRoleID']));
    $unban_role_info =  $_REQUEST['unBan']["{$unban_role_id}"];
    $time = 0;
    $now_time = time();
    //发送到游戏服解封账号

    $unban_acc_log = $unban_role_info['account_name'];

    $unban_role_info['account_name'] = str_replace("\\'", "'", $unban_role_info['account_name']); // 还原 '
    $unban_role_info['account_name'] = str_replace("\\\"", "\"", $unban_role_info['account_name']);  // 还原 "
    $unban_role_info['account_name'] = str_replace("\\\\", "\\", $unban_role_info['account_name']);  // 还原 \
    $unban_role_info['account_name'] = urlencode($unban_role_info['account_name']);



    $url = $erlangWebAdminHost."killuser/stop_chat/?role_id={$unban_role_id}&chat_time={$time}";
    $result = getJson($url);
    if ($result['result']=='ok')
    {
        $loger = new AdminLogClass();
        $loger->Log( AdminLogClass::TYPE_UNBAN_CHAT,'', '','', $unban_role_id, $unban_acc_log);

        //修改结束时间为当前时间
        $sql_update = "UPDATE `{$dbConfig['dbname']}`.`t_banned_to_post` SET `end_time` = '{$now_time}' WHERE `t_banned_to_post`.`role_id` ='{$unban_role_id}';";
        $db->query($sql_update);

        infoExit("解禁玩家角色帐号成功");
    }
    else
    {
        errorExit ("解禁玩家角色帐号失败");
    }
}

$sql_get_all_ban = "SELECT * FROM `t_banned_to_post` WHERE end_time>'{$now_time}'";
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

$sql_get_all_ban_h = "SELECT * FROM `t_banned_to_post` WHERE end_time<'{$now_time}'";
if(!empty($role_id))
{
    $sql_get_all_ban_h .= " AND role_id != '{$role_id}'";
}
else if(!empty($role_name))
{
    $sql_get_all_ban_h .= " AND role_name != '{$role_name}'";
}
else if(!empty($account_name))
{
    $sql_get_all_ban_h .= " AND account_name != '{$account_name}'";
}
$get_ban_h = $db->fetchAll($sql_get_all_ban_h);

$ban_time_option = getBanTimeOption();
$smarty->assign("ban_time_option", $ban_time_option);
$smarty->assign("role", $role_result);
$smarty->assign("ip_addr", $ip_addr);
$smarty->assign("same_ip_rst", array_merge($get_first_one, $same_ip_result));
$smarty->assign("all_ban_account", array_merge($get_one_ban, $get_other_ban));
$smarty->assign("get_ban_h",$get_ban_h);
$smarty->display("module/gm/banned_to_post.html");


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




