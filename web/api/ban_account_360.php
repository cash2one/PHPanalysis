<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/5
 * Time: 10:03
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include "../include/functions.php";
global $db;


//http://[your_url]/qid=116369412&server_id=S1&type=1&time=1322551365&sign=9fd65020649416a68ce39a3db2e98bbd
/*
 * 返回值
 *  1 成功
 *  -1 参数错误
 *  -2 参数验证失败
 *  -3 获取数据失败
 *  -4 已在封禁状态
 *  -5 其它错误
 */

$key = $API_SECURITY_TICKEY_LOGIN;
$name = trim($_REQUEST['qid']);
$serverId = trim($_REQUEST['server_id']);
$type = trim($_REQUEST['type']);
$time = trim($_REQUEST['time']);
$sign = trim($_REQUEST['sign']);
$keeptime = trim($_REQUEST['keeptime']);

$keep_time = empty($keeptime) ? 0:$keeptime;


if (empty($name)  || empty($time) || empty($sign) || empty($serverId))
{
    echo -1;
    die();
}
else
{
    $game_serverid = 'S'.$GAME_SERVER;
    if($game_serverid != $serverId){
        echo -1;
        die();
    }
    $token= md5($name.$serverId.$type.$keep_time.$time.$key);
    if($token != $sign){
        echo -2;
        die();
    }
    else
    {

        $sql = "select role_id,account_name,role_name from db_role_base_p where account_name=".$name;
        $accounttemp = $db->fetchOne($sql);
        $role_id=$accounttemp['role_id'];
        $account_name=$accounttemp['account_name'];
        $role_name = $accounttemp['role_name'];
        if(!isset($accounttemp['role_id']))
        {
            echo -3;
            die();
        }
        if($type == 1){
            $operate_user = "1010g_api";
            $ban_reason2 = "360ban";
            $ban_role_id = $role_id;

            if($keep_time == 0){
                $ban_time = 315360000; //10年 == 永久
            }else{
                $ban_time = $keep_time;
            }
            $start_time = time();
            $ban_time_cnt = $ban_time;
            $end_time = time() + $ban_time_cnt;

            //发送账号到游戏服进行封禁
            $admin_id = 0;

            $account_name_log = $account_name;
            $account_name = urlString($account_name);

            $result_ban_role = getJson ($erlangWebAdminHost."gm/ban_role/"
                ."?role_name={$account_name}&role_id={$role_id}&ban_time={$ban_time_cnt}&admin_id={$admin_id}");

            if ($result_ban_role['result']=='ok') {
    //			$loger = new AdminLogClass();
    //			$loger->Log( AdminLogClass::TYPE_BAN_USER, $ban_reason2, '','', $role_id, $account_name_log);

                //插入封禁信息到MySQL
                $insert_sql = "INSERT INTO `t_ban_account` (`role_id`,`role_name`,`account_name`,`last_login_ip`, `start_time` ,`end_time` ,`ban_reason` ,`admin`) " .
                                                    " VALUES ('$role_id', '$role_name', '{$account_name_log}', '', '{$start_time}', '{$end_time}', '$ban_reason2', '{$operate_user}')";

                $db->query($insert_sql);

                echo 1;
                die();
            }
            else
            {
                echo -5;
                die();
            }
        }else if($type==0){
            //echo 111;exit;
            $unban_role_id = $role_id;

            //发送到游戏服解封账号
            $account_name_log = $account_name;
            $account_name = urlString($account_name);

            $result_dis_ban_role = getJson ($erlangWebAdminHost."gm/dis_ban_role/?role_name={$account_name}");

            if ($result_dis_ban_role['result']=='ok')
            {
                $now_time = time();
                $sql_update = "UPDATE `t_ban_account` SET `end_time` = '{$now_time}' WHERE `t_ban_account`.`role_id` ='{$unban_role_id}';";
                $db->query($sql_update);

                echo 1;
                die();
            }
            else
            {
                echo -5;
                die();
            }

        }else{
            echo -1;
            die();
        }
    }

}




