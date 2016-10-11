<?php
define('IN_DATANG_SYSTEM', true);
//include "../config/config.php";
//include SYSDIR_ROOT_CLIENT.'config/config.key.php';
//include SYSDIR_ADMIN.'/include/api_global.php';


include "/data/mge_test/client/web/config/config.php";
include "/data/mge_test/client/web/config/config.center.php";
include "/data/mge_test/client/web/include/global.php";

global $db;

$action = $_REQUEST['action'];
$agent_id =  $_REQUEST['agent_id'];
$server_id =  $_REQUEST['server_id'];
if($action=='save') {
    $domain_name = $_REQUEST['domain_name'];
    $type =  $_REQUEST['type'];
    $stat = $_REQUEST['stat'];
    $open_time =  $_REQUEST['open_time'];
    $close_time =  $_REQUEST['close_time'];
    $combine_time =  $_REQUEST['combine_time'];
    $desc = $_REQUEST['desc'];
}

$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";
$token = md5($agent_id . $key . $server_id);
if($token != $sign) {
    echo(json_encode("sign_error"));
    die();
}
else {
    if($action=='save'){
        $ip = gethostbyname($domain_name);
        $sql = "insert into all_server_info(agent_id,server_id,domain_name,ip,s_type,stat,open_time,combine_time,close_time,s_desc)
            values($agent_id,$server_id,'$domain_name','$ip',$type,$stat,$open_time,$combine_time,$close_time,'$desc')
        ON DUPLICATE KEY UPDATE domain_name='$domain_name',ip='$ip',s_type=$type,stat=$stat,open_time=$open_time,
        combine_time=$combine_time,close_time=$close_time,s_desc='$desc'";
        $db->query($sql);
    }
    $sql = "select * from all_server_info where agent_id=$agent_id and server_id=$server_id limit 1";
    $rt = $db->fetchAll($sql);
    $rt= $rt[0];
    echo json_encode($rt);
}