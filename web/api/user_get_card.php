<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//http://domain/[getcard]?type=1&qid=123456&server_id=S1&sign=1477c11ef8ec28fd6fd2e79b45d8a861
$key = $API_SECURITY_TICKEY_LOGIN;
$account = trim($_REQUEST['qid']);
$serverId = trim($_REQUEST['server_id']);
$type = $_REQUEST['type'];
$sign = $_REQUEST['sign'];
$time = time();
//echo 111;exit;
if(!empty($account) && !empty($serverId))
{
    $token = md5($account.$serverId.$type.$key);
    if($token == $sign){
        //$card_num = strtoupper(md5($account.$server_id.$time));
        $card_num = substr('26'.md5($account.$server_id.$time),0,32);
        $result = getJson ( $erlangWebAdminHost."gm/get_360_owner_card/?card_num={$card_num}");
        echo $card_num;
        die();
    }else{
        echo -1;
        die();
    }

}