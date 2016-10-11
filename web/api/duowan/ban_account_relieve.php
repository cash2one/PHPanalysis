<?php
/**
 * Created by PhpStorm.
 * User: Tonyzhang
 * Date: 2015/10/23
 * Time: 15:40
 */

define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
//include "../admin/class/admin_log_class.php";
global $db;

//http://www.xxx.com/unlock.php?accounts=&ts=&game=&server=&sign=70014F35EAC8F92557FAB4FC83DEE69A


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
            //发送到游戏服解封账号

            $result_dis_ban_role = getJson ($erlangWebAdminHost."gm/dis_ban_role/?role_name={$account_name}");

            if ($result_dis_ban_role['result']=='ok')
            {
                $now_time = time();
                $sql_update = "UPDATE `t_ban_account` SET `end_time` = '{$now_time}' WHERE `t_ban_account`.`role_id` ='{$role_id}';";
                $db->query($sql_update);

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
