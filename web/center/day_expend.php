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

$silver_spend = array(
        1001,
        1003,1011,1021,1055,1056,1057,1059,
        1009,1010,1012,1013,1015,1019,1020,1058,1060,1061,1062,1070,1091,1092,
        1030,1031,1032,1033,1034,1039,1042,1043,1044,1045,1046,1080,
        1050,1051,1053,1054,1071,1072,1093,
        1002,
);
$points_spend = array(9001);

$gold_spend = LogGoldClass::getSpendTypeList();
$first_flag=0;
foreach($gold_spend as $k=>$value){
    if($first_flag) $gold_spend_str .= ',';
    $gold_spend_str .= $k;
    $first_flag = 1;
}
$silver_spend_str = implode(',',$silver_spend);
$points_spend_str = implode(',', $points_spend);

$token = md5($starttime . $key . $endtime);
if($token != $sign) {
    echo(json_encode("sign_error "));
    die();
}
else {
     $sql_gold = "select from_unixtime(mtime,'%Y-%m-%d') as date,count(distinct(user_id)) as customers, count( user_id ) AS buy_times, sum( gold_bind ) AS gold_bind, sum( gold_unbind ) AS gold_unbind, mtype,itemid
        FROM `t_log_use_gold` where mtime>=$starttime and mtime<$endtime and mtype in ($gold_spend_str) group by date, mtype,itemid";
    $result['gold'] = $db->fetchAll($sql_gold);

    $sql_points = "select from_unixtime(mtime,'%Y-%m-%d') as date,count(distinct(user_id)) as customers,count(user_id) AS buy_times, sum(points) AS points , mtype,itemid
        FROM `t_log_use_points` where mtime>=$starttime and mtime<$endtime and mtype in ($points_spend_str) group by date,mtype,itemid";
    $result['points'] = $db->fetchAll($sql_points);

    $sql_silver = "select from_unixtime(mtime,'%Y-%m-%d') as date,count(distinct(user_id)) as customers, count(user_id) AS buy_times, sum(silver_bind) AS silver_bind, sum(silver_unbind) AS silver_unbind, mtype
        FROM `t_log_use_silver` where mtime>=$starttime and mtime<$endtime and mtype in ($silver_spend_str)  group by date,mtype";
    $result['silver'] = $db->fetchAll($sql_silver);

    echo json_encode($result);
}
