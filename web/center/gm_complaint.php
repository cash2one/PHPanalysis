<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$keySign = "FTNN4399payKode";
$sign = trim($_REQUEST['sign']);
$action = trim($_REQUEST['action']);

switch ($action) {
    case 'reply':
        $id = trim($_REQUEST['id']);
        $role_id = trim($_REQUEST['role_id']);
        $role_name = trim($_REQUEST['role_name']);
        $content = trim($_REQUEST['content']);
        $token = md5($action.$id.$keySign);
        break;
    case 'list':
        $start_time = trim($_REQUEST['starttime']);
        $end_time = trim($_REQUEST['endtime']);
        $token=md5($start_time.$keySign.$end_time);
        break;
    case 'ignore':
        $id = trim($_REQUEST['id']);
        $token=md5($action.$id.$keySign);
        break;
}

if($token != $sign||$sign=='') {
    echo(json_encode("sign_error:$token"));
    die();
}else {
    switch ($action) {
        case 'reply':
            $result = getJson ( $erlangWebAdminHost."email/send_email/" .
                    "?role_id={$role_id}&role_name={$role_name}&content={$content}" );
            if($result['result']=='ok')
                $updateSql = 'UPDATE  `t_GM_Complaint` SET `state` = 1, reply =  \'' .
                        urldecode($content) .
                        '\' where id='.$id.'';
            $db->query($updateSql);
            echo (json_encode($result['result']));
            break;
        case 'list':
            $sql = 'select * from t_GM_Complaint where `time`>='.$start_time.' and `time`<='.$end_time.'  limit 100';
            $result = $db->fetchAll($sql);
            echo (json_encode($result));
            break;
        case 'ignore':
            $sql = "update t_GM_Complaint set state=1 where id={$id} limit 1";
            $db->query($sql);
            echo (json_encode('ok'));
            break;
        default:
            echo json_encode("error");
    }
}


