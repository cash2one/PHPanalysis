<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/9/28
 * Time: 16:59
 */
define(IN_DATANG_SYSTEM,TRUE);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';

global $db;
//http://domain/[active]?qid=28318249&server_id=S1&sign=90852a3c4819dbc28b20a02d300b2c9d"
$key = $API_SECURITY_TICKEY_LOGIN;
$username = trim($_REQUEST['qid']);
$serverId = $_REQUEST['server_id'];
$sign   = $_REQUEST['sign'];
$token = md5($username.$serverId.$key);

if($token != $sign){
    echo 0;die();
}else{
    $sql = "select a.account_name from db_account_p as a left join  db_role_base_p as b on a.account_name = b.account_name where a.account_name=".$username;
    $account_list = $db->fetchAll($sql);

    if(!empty($account_list)){
        echo 1;
    }else{
        echo 0;
    }
    die();
}



