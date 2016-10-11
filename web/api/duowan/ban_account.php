<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/10/23
 * Time: 15:07
 */

define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
//include "../admin/class/admin_log_class.php";
global $db;

//http://www.xxx.com/kick.php?accounts=&ts=&game=&server=&sign=70014F35EAC8F92557FAB4FC83DEE69A

$accounts = $_REQUEST['accounts'];
$ts = $_REQUEST['ts'];
$game = $_REQUEST['game'];
$server = $_REQUEST['server'];
$sign = $_REQUEST['sign'];

$key = $API_SECURITY_TICKEY_LOGIN;
//$key = '1010gzhanjiangsanguodk';
$time = time();

if(($time-$ts)>300){
    echo -1;
}else{
    $token = strtoupper(md5($accounts.$game.$server.$ts.$key));
    if($token != $sign){
        echo -1;
    }
    else{
        $users = explode(",",$accounts);
        $all_succ = TRUE;
        foreach($users as $v){
            $sql = "select role_id,account_name,role_name from db_role_base_p where account_name='{$v}'";
            $accounttemp = $db->fetchOne($sql);
            if(empty($accounttemp))
            {
                $all_succ = false;
                continue;
            }
            $role_id=$accounttemp['role_id'];
            $account_name=$accounttemp['account_name'];
            $role_name = $accounttemp['role_name'];
            $role_id=$accounttemp['role_id'];


            $operate_user = "1010g_api";
            $ban_reason2 = "YYban";
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
            //$account_name = urlString($account_name);

            $result_ban_role = getJson ($erlangWebAdminHost."gm/ban_role/?role_name={$account_name}&role_id={$role_id}&ban_time={$ban_time_cnt}&admin_id={$admin_id}");

            if ($result_ban_role['result']=='ok') {

                //插入封禁信息到MySQL
                $insert_sql = "INSERT INTO `t_ban_account` (`role_id`,`role_name`,`account_name`,`last_login_ip`, `start_time` ,`end_time` ,`ban_reason` ,`admin`) " .
                    " VALUES ('$role_id', '$role_name', '{$account_name_log}', '', '{$start_time}', '{$end_time}', '$ban_reason2', '{$operate_user}')";

                $db->query($insert_sql);

            }else{
                $all_succ = false;
            }
        }
        if($all_succ){
            echo 1;
            die();
        }else{
            echo -1;
            die();
        }
    }
}
