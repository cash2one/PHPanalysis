<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


$sign = trim($_REQUEST['sign']);
$dateline = trim($_REQUEST['time']);
$key = "FTNN4399payKode";

$token = md5($key.$dateline);
if($token != $sign) {
    echo(json_encode("sign_error"));
    die();
}
else {
    $loss_time=time()-5*24*60*60;

    $sql_select = 'select a.role_id,a.prestige from `db_role_attr_p` a ,`db_role_ext_p` b where a.role_id=b.role_id and a.prestige>=5000 and b.last_login_time>='.$loss_time;
    $result = $db->fetchAll($sql_select);
    $sql_insert = 'insert into t_log_prestige(role_id,prestige,dateline) values';
    $flag = 0;
    foreach($result as $value){
        if($flag) $sql_insert.=',';
        $sql_insert .="({$value['role_id']},{$value['prestige']},{$dateline})";
        $flag=1;
    }
    $db->query($sql_insert);
}