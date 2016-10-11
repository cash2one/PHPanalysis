<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';
global $db;


$starttime = trim($_REQUEST['starttime']);
$endtime = trim($_REQUEST['endtime']);
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";
$token = md5($starttime . $key . $endtime);


$add_type = "2016,4002,4004,4015,4016,4023,4031";
$send_type = "4001,3001";
$gold_spend = LogGoldClass::getSpendTypeList();
$first_flag=0;
foreach($gold_spend as $k=>$value) {
    if($first_flag) $used_type .= ',';
    $used_type .= $k;
    $first_flag = 1;
}
$loss_time = $starttime-10*24*60*60;


if($token != $sign) {
    echo(json_encode("sign_error"));
    die();
}
else {
    $sql_left_gold = " select  sum(a.gold) as gold_unbind,sum(a.gold_bind) as gold_bind FROM `db_role_attr_p` a,`db_role_ext_p` b
                where a.role_id=b.role_id and b.last_login_time>=$loss_time";
    $left_gold = $db->fetchOne($sql_left_gold);

    $sql_add_gold = " select sum(gold_unbind) as gold_unbind, sum(gold_bind) as gold_bind from t_log_use_gold
            where  mtime>={$starttime} and mtime<={$endtime} and mtype in($add_type)";
    $add_gold = $db->fetchOne($sql_add_gold);

    $sql_used_gold = " select sum(gold_unbind) as gold_unbind, sum(gold_bind) as gold_bind from t_log_use_gold
            where  mtime>={$starttime} and mtime<={$endtime} and mtype in ($used_type)";
    $used_gold = $db->fetchOne($sql_used_gold);

    $sql_send_gold = "select sum(gold_unbind) as gold_unbind, sum(gold_bind) as gold_bind from t_log_use_gold
            where  mtime>={$starttime} and mtime<={$endtime} and mtype in ($send_type)";
    $send_gold = $db->fetchOne($sql_send_gold);

    $sql_avg_online = "SELECT avg(online) as online  from `t_log_online`
            where dateline>=$starttime and dateline<=$endtime ";
    $avg_online = $db->fetchOne($sql_avg_online);
    $online = round($avg_online['online']);

    $add_gold_unbind = 0-$add_gold['gold_unbind'];
    $add_gold_bind = 0-$add_gold['gold_bind'];
    $send_gold_unbind = 0-$send_gold['gold_unbind'];
    $send_gold_bind = 0-$send_gold['gold_bind'];

    $result['left_unbind'] = $left_gold['gold_unbind'];
    $result['left_bind'] = $left_gold['gold_bind'];
    $result['add_unbind'] = $add_gold_unbind;
    $result['add_bind'] = $add_gold_bind;
    $result['used_unbind'] = $used_gold['gold_unbind'];
    $result['used_bind'] = $used_gold['gold_bind'];
    $result['send_unbind'] = $send_gold_unbind;
    $result['send_bind'] = $send_gold_bind;
    $result['avg_online'] = round($avg_online['online']);
    $result['dateline'] = $starttime;

    $sql_insert = "insert ignore into t_log_day_gold(left_unbind,left_bind,add_unbind,add_bind,used_unbind,used_bind,send_unbind,send_bind,avg_online,dateline) values(
            {$left_gold['gold_unbind']},{$left_gold['gold_bind']},{$add_gold_unbind},{$add_gold_bind},
            {$used_gold['gold_unbind']},{$used_gold['gold_bind']},{$send_gold_unbind},{$send_gold_bind},
            $online,$starttime)";
    $db->query($sql_insert);

    
    echo json_encode($result);
}