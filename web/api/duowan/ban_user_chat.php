<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/10/22
 * Time: 16:54
 */

define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
//include "../admin/class/admin_log_class.php";
global $db;

//http://www.xxx.com/donttalk.php?accounts=&keeptime=&ts=&game=&server=&sign=70014F35EAC8F92557FAB4FC83DEE69A

$accounts = trim($_REQUEST['accounts']);
$keeptime = $_REQUEST['keeptime'];
$ts = $_REQUEST['ts'];
$game = $_REQUEST['game'];
$server = $_REQUEST['server'];
$sign = $_REQUEST['sign'];
$key = $API_SECURITY_TICKEY_LOGIN;
//$key = '1010gzhanjiangsanguodk';
$time = time();

if(($time-$ts)>300){
    echo -1;
    die();
}
else{
    $token = strtoupper(md5($accounts.$keeptime.$game.$server.$ts.$key));
    if($token != $sign){
        echo -1;
        die();
    }
    else
    {
        $users = explode(",",$accounts);
        $all_succ = TRUE;
        foreach($users as $v){
            $sqlCount="SELECT `role_id` FROM `db_role_base_p` WHERE `account_name` = '{$v}' ";

            $accounttemp = $db->fetchOne($sqlCount);

            $role_id=$accounttemp['role_id'];

            if(!isset($accounttemp['role_id']))
            {
                $all_succ = false;
                continue;
            }
            $chatTime = $keeptime * 60;
            $result_stop_chat = getJson($erlangWebAdminHost."killuser/stop_chat/?role_id={$role_id}&chat_time={$chatTime}");
            if($result_stop_chat['result'] != 'ok'){
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
