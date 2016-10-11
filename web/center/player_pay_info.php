<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

/*
 * sign	身份验证签名	加密规则：md5($starttime.$key.$endtime)
 * $key 为双方约定的私鈅
*/

$starttime = trim($_REQUEST['starttime']);
$endtime = trim($_REQUEST['endtime']);
$role_id_list = trim($_REQUEST['role_id_list']);
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";

$token = md5($starttime . $key . $endtime);
if($token != $sign) {
    echo(json_encode("sign_error"));
    die();
}
else {
    $sql = 'SELECT  e.role_id,a.level,a.gold,from_unixtime(e.`last_login_time`, "%Y-%m-%d %H:%i:%s" ) AS last_login_time FROM `db_role_attr_p` a,db_role_ext_p e where  e.role_id=a.role_id and a.role_id in('.$role_id_list.')';
    $result = $db->fetchAll($sql);
    echo json_encode($result);
}

