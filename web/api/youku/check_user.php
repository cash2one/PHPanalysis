<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/11/4
 * Time: 16:47
 */

define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_INCLUDE."/functions.php";
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


//http://角色检查接口地址?qid=28318249&server_id=S1&sign=90852a3c4819dbc28b20a02d300b2c9d

$qid = $_REQUEST['qid'];
$server_id = $_REQUEST['server_id'];
$sign = $_REQUEST['sign'];
$login_key = $API_SECURITY_TICKEY_LOGIN;


if(empty($qid) || empty($server_id) || empty($sign)){
    echo 0;
    exit;
}else{
    $token = md5($qid.$server_id.$login_key);
    if($token != $sign){
        echo 0;
        exit;
    }else{
        $sql = 'select * from db_role_base_p where account_name='.$qid;
        $base = $db->fetchAll($sql);
        if(empty($base)){
            echo 0;
            exit;
        }else{
            echo 1;
            exit;
        }

    }
}



