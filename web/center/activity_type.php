<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';
global $db;

/*
 * sign	身份验证签名	加密规则：md5($starttime.$key.$endtime)
 * $key 为双方约定的私鈅
*/

$starttime = trim($_REQUEST['starttime']);
$endtime = trim($_REQUEST['endtime']);
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";


$start = date("Ymd",$starttime);
$end = date('Ymd',$endtime);

$token = md5($starttime . $key . $endtime);
if($token != $sign) {
    echo(json_encode("sign_error "));
    die();
}
else {
    $sql = "select * from t_log_routine where mtime>={$start} and mtime<={$end} ";
    $result  = $db->fetchAll($sql);
    echo json_encode($result);
}