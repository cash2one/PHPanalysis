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

$now_time = trim($_REQUEST['nowtime']);
$dateline = trim($_REQUEST['dateline']);
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";

$token = md5($now_time . $key . $dateline);

if($token != $sign) {
    echo(json_encode("sign_error"));
    die();
}
else {
    $sql_accept = "select count(distinct role_id) as accept_players,count(distinct team_id) as accept_teams from t_log_inter_pk_3v3 where dateline=$dateline and type=1";
    $sql_login = "select count(distinct role_id) as login_players,count(distinct team_id) as login_teams from t_log_inter_pk_3v3 where dateline=$dateline and type=2";
    $sql_all = "select count(a.role_id) as all_players from db_role_attr_p a,db_role_ext_p b where  a.role_id=b.role_id and a.level>=60 and b.last_login_time>=$dateline";

    $all=$db->fetchOne($sql_all);
    $result['all_players'] = $all['all_players'];
    
    $accept = $db->fetchOne($sql_accept);
    $result['accept_players'] = $accept['accept_players'];
    $result['accept_teams'] = $accept['accept_teams'];

    $login = $db->fetchOne($sql_login);
    $result['login_players'] = $login['login_players'];
    $result['login_teams'] = $login['login_teams'];
    
    echo json_encode($result);
}

