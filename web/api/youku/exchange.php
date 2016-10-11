<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/11/4
 * Time: 17:25
 */


define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_INCLUDE."/functions.php";
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//http://游戏充值接口地址?qid=50469470&order_amount=10&order_id=youkutest1011&server_id=S1&sign=7439fb6fa5f82104c107648e9ac77d76

$qid = $_REQUEST['qid'];
$order_amount = $_REQUEST['order_amount'];
$order_id = $_REQUEST['order_id'];
$serverId = $_REQUEST['server_id'];
$sign = $_REQUEST['sign'];
$key = $API_SECURITY_TICKET_PAY;
$pay_time = time();
$server_id = substr($serverId,1);

if(empty($qid) || empty($order_amount) || empty($order_id) || empty($serverId) || empty($sign)){
    echo 0;exit;
}else{
    $token = md5($qid.$order_amount.$order_id.$serverId.$key);
    if($token != $sign){
        echo 0;exit;
    }else{

        $pay_money = intval(floatval($order_amount) * 100);
        $pay_gold    = $order_amount*10;
        $year = date('Y', $pay_time);
        $month = date('m', $pay_time);
        $day = date('d', $pay_time);
        $hour = date('H', $pay_time);

        $url = "api/pay/?order_id={$order_id}&ac_name={$qid}&pay_gold={$pay_gold}&pay_time={$pay_time}&pay_money={$pay_money}&pay_ticket=0&year={$year}&month={$month}&day={$day}&hour={$hour}&server_id={$server_id}&agent_id={$AGENT_ID}";

        $result = getWebJson($url);
        $cold = $result['pay_result'];
        if($cold == 1){
            echo 1;die();
        }elseif($cold == 2){
            echo 2;die();
        }else{
            echo 0;die();
        }
    }
}


