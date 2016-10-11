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
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";

$token = md5($starttime . $key . $endtime);
if($token != $sign) {
    echo(json_encode("sign_error"));
    die();
}
else {
    $sql_max = "SELECT max(online) as online, from_unixtime(dateline,'%Y-%m-%d') as date, hour,min-min%30 as min FROM `t_log_online` where dateline>=$starttime and dateline<=$endtime group by date, hour,(min-min%30)/30 ";
    $result['max'] = $db->FetchAll($sql_max);
    $sql_avg = "SELECT avg(online) as online ,from_unixtime(dateline,'%Y-%m-%d') as date  from `t_log_online` where dateline>=$starttime and dateline<=$endtime group by date";
    $result['avg'] = $db->FetchAll($sql_avg);
    $sql_register = "SELECT COUNT(*) as account,from_unixtime(create_time,'%Y-%m-%d') as date  from `db_account_p` where create_time>=$starttime and create_time<=$endtime group by date";
    $result['register'] = $db->FetchAll($sql_register);

    echo json_encode($result);
}

