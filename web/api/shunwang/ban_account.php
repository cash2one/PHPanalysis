<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/10/27
 * Time: 15:44
 */

define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


$uid = $_REQUEST['uid'];
$serverId = $_REQUEST['server_id'];
$type = $_REQUEST['type'];
$time = $_REQUEST['time'];
$sign = $_REQUEST['sign'];

$key = $API_SECURITY_TICKEY_LOGIN;

if(empty($uid) || empty($serverId) || empty($type) || empty($time) || empty($sign)){
    echo -1;
    die();
}
else{
    $token = md5($uid.$serverId.$type.$time.$key);
    if($token != $sign){
        echo -2;
        die();
    }else{
        $sql = "select role_id,account_name,role_name from db_role_base_p where account_name=".$uid;
        $accounttemp = $db->fetchOne($sql);
        $role_id=$accounttemp['role_id'];
        $account_name=$accounttemp['account_name'];
        $role_name = $accounttemp['role_name'];
        if(!isset($accounttemp['role_id']))
        {
            echo -3;
            die();
        }
        if($type == 3) {
            $operate_user = "1010g_api";
            $ban_reason2 = "shunWang";

            $start_time = time();
            $ban_time_cnt = 315360000;//10年 == 永久
            $end_time = time() + $ban_time_cnt;

            //发送账号到游戏服进行封禁
            $admin_id = 0;

            $account_name_log = $account_name;


            $result_ban_role = getJson($erlangWebAdminHost . "gm/ban_role/"
                . "?role_name={$account_name}&role_id={$role_id}&ban_time={$ban_time_cnt}&admin_id={$admin_id}");

            if ($result_ban_role['result'] == 'ok') {
                //插入封禁信息到MySQL
                $insert_sql = "INSERT INTO `t_ban_account` (`role_id`,`role_name`,`account_name`, `start_time` ,`end_time` ,`ban_reason` ,`admin`) " .
                    " VALUES ('$role_id', '$role_name', '{$account_name_log}', '{$start_time}', '{$end_time}', '$ban_reason2', '{$operate_user}')";

                $db->query($insert_sql);

                echo 1;
                die();
            }else{
                echo -5;
                die();
            }
        }
        elseif($type == 4)
        {
            $unban_role_id = $role_id;

            //发送到游戏服解封账号
            $account_name_log = $account_name;


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
        }
        elseif($type == 1)
        {
            $chatTime = 315360000; //100年 == 永久
            $result_stop_chat = getJson($erlangWebAdminHost."killuser/stop_chat/?role_id={$role_id}&chat_time={$chatTime}");
            if ($result_stop_chat['result']=='ok')
            {
                echo 1;
                die();
            }
            else
            {
                echo -5;
                die();
            }
        }
        elseif($type == 2)
        {
            $chatTime = 0;
            $result_stop_chat = getJson($erlangWebAdminHost."killuser/stop_chat/?role_id={$role_id}&chat_time={$chatTime}");
            if ($result_stop_chat['result']=='ok')
            {
                echo 1;
                die();
            }
            else
            {
                echo -5;
                die();
            }
        }
    }

}










