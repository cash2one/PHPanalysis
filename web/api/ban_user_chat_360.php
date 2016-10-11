<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/5
 * Time: 13:47
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//http://[your_url]/qid=278479758&server_id=S1&type=1&time=1438141186&sign=db093eb05e51e61121c3fd3c9ae0b307&keeptime=0
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


if (empty($name) || empty($time) || empty($sign))
{
    echo -1;
    die();
}
else
{
    $token = md5($name . $serverId . $type . $keeptime . $time . $key);
    #echo $token;echo "<br>";
    if($token != $sign)
    {
        echo -2;
        die();
    }
    else
    {
        $sqlCount="SELECT `role_id` FROM `db_role_base_p` WHERE `account_name` = '{$name}' ";
        $accounttemp = $db->fetchOne($sqlCount);
        $role_id=$accounttemp['role_id'];
        if(!isset($accounttemp['role_id']))
        {
            echo -3;
            die();
        }
        else
        {
            if($type == 1){
                if($keeptime == 0){
                    $chatTime = 315360000; //100年 == 永久
                }else{
                    $chatTime = $keeptime;
                }
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
            else if($type == 0)
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
            else{
                echo -1;
                die();
            }
        }

    }
}







