<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';
include SYSDIR_ADMIN."/class/broadcast.class.php";
global $db;

/*
 * sign	身份验证签名	加密规则：md5($action.$id.$keySign)
 * $keySign 为双方约定的私鈅
*/

$broadcastClass = new BroadcastClass($erlangWebAdminHost);
$keySign = "dt2BroadcastKode";

$sign = trim($_REQUEST['sign']);
$action = trim($_REQUEST['action']);
$id = trim($_REQUEST['id']);
if($action != 'del') {
    $foreign_id = trim($_REQUEST['foreign_id']);
    $type = trim($_REQUEST['type']);
    $send_strategy = trim($_REQUEST['send_strategy']);
    $start_date = trim($_REQUEST['start_date']);
    $end_date = trim($_REQUEST['end_date']);
    $start_time = trim($_REQUEST['start_time']);
    $end_time = trim($_REQUEST['end_time']);
    $interval = trim($_REQUEST['interval']);
    $content = urlencode(trim($_REQUEST['content']));
}

$token = md5($action.$id.$keySign);
if($token != $sign) {
    echo(json_encode("sign_error "));
    die();
}
else {
    switch ($action) {
        case 'del':
            $result = $broadcastClass -> delBroadcast($id,"id");
            echo json_encode($result);
            break;
        case 'save':
            $result = $broadcastClass -> saveBroadcast($id,$foreign_id,$type,$send_strategy,$start_date,
                    $end_date,$start_time,$end_time,$interval,$content);
            echo json_encode($result);
            break;
        case 'list':
            $result = $broadcastClass -> listBroadcast();
            echo json_encode($result);
            break;
        default:
            echo "sign_error";
    }
}