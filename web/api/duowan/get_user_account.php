<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/10/23
 * Time: 10:07
 */

define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//http://www.xxx.com/getuidbyrole.php?server=&nickname=&ts=&sign=70014F35EAC8F92557FAB4FC83DEE69A

$server = $_REQUEST['server'];
$nickname = $_REQUEST['nickname'];
$ts = $_REQUEST['ts'];
$sign = $_REQUEST['sign'];
$key = $API_SECURITY_TICKEY_LOGIN;
//$key = '1010gzhanjiangsanguodk';
$now_time = time();

if(($now_time-$ts) > 300){
    echo -2;
    die();
}
else
{
    $role_name = urldecode($nickname);
    $token = strtoupper(md5($key.$server.$role_name.$ts));
    if($token != $sign){
        echo -2;die();
    }
    else
    {
        $sql = "select account_name from db_role_base_p where role_name='{$role_name}'";
        $uid = $db->fetchOne($sql);
        if(!empty($uid)){
            $accountName = $uid['account_name'];
            echo $accountName;die();
        }else{
            echo -1;exit;
        }

    }
}
