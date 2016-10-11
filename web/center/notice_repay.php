<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$keySign = "FTNN4399payKode";
$sign = trim($_REQUEST['sign']);
$action = trim($_REQUEST['action']);
$token = md5($keySign.$action);
if($sign!=$token) {
    echo json_encode('sign_error');
    
}
else {
    if($action=='bulletin') {
        $title = trim($_REQUEST['title']);
        $text = trim($_REQUEST['text']);
        $dateEndStamp=trim($_REQUEST['time']);
//        $text = str_replace("\\'", "'", $text); // 还原 '
//	$text = str_replace("\\\"", "\"", $text);  // 还原 "
//	$text = str_replace("\\\\", "\\", $text);  // 还原 \
	$text = base64_decode(($text));
        $result = getJson($erlangWebAdminHost."bulletin/do_bulletin_publish/"
		."?title={$title}&text={$text}&end_time={$dateEndStamp}");

        if ($result['result']=='ok') {
            echo json_encode('ok');
        }else {
            echo json_encode('error ');
        }
    }elseif($action=='compensation_conf') {
        $level_max = intval(trim(SS($_REQUEST['level_max'])));
        $level_min = intval(trim(SS($_REQUEST['level_min'])));
        $goods = intval(SS(trim($_REQUEST['goods'])));
        $num = intval(SS(trim($_REQUEST['num'])));
        $admin = '[C]'.SS(trim($_REQUEST['admin']));
        $dateStartStamp = intval(SS(trim($_REQUEST['start_time'])));
        $dateEndStamp   = intval(SS(trim($_REQUEST['end_time'])));
        $result = getJson($erlangWebAdminHost."bulletin/compensation_conf/"
                ."?level_min={$level_min}&level_max={$level_max}"
                ."&start_time={$dateStartStamp}&end_time={$dateEndStamp}"
                ."&goods={$goods}&num={$num}");
        if ($result['result']=='ok') {
            $insert_sql = "INSERT INTO `t_log_notice_reply` (`id` ,`start_time` ,`end_time` ,`goods_id` ,`num` ,`level_min` ,`level_max`,`operator`)VALUES ('','{$dateStartStamp}', '{$dateEndStamp}', '{$goods}', '{$num}', '{$level_min}', '{$level_max}','{$admin}')";
            $db->query($insert_sql);
            echo json_encode('ok');
        }else {
            echo json_encode('error');
        }
    }
}