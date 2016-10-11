<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/10/29
 * Time: 11:55
 */

define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_INCLUDE."/functions.php";
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


//http://mall.com/somepath?api_key=a001&user_id=110&server_id=s1&order_id=1234567890&wanba_oid=567567567&amount=100&currency=CNY&result=1&back_send=N&timestamp=2010-04-22 12:12:12&sign=wewet8fddafafgfghdfh
$apiKey = $_REQUEST['api_key'];
$userId = $_REQUEST['user_id'];
$serverId = $_REQUEST['server_id'];
$orderId = $_REQUEST['order_id'];
$wanbaOid = $_REQUEST['wanba_oid'];
$amount = $_REQUEST['amount'];

$pay_money = intval(floatval($amount) * 100);     //单元转换成分
$pay_gold  = $amount*10;        //充值元宝

$currency = $_REQUEST['currency'];
$result = $_REQUEST['result'];
$backSend = $_REQUEST['back_send'];
$timestamp = $_REQUEST['timestamp'];
$sign = $_REQUEST['sign'];

$secret_key = $API_SECURITY_TICKET_PAY;
$server_id = $GAME_SERVER;

$str = $secret_key."amount".$amount."api_key".$apiKey."back_send".$backSend."currency".$currency."order_id".$orderId."result".$result."server_id".$serverId."timestamp".$timestamp."user_id".$userId."wanba_oid".$wanbaOid;
$token = strtoupper(md5($str));

if($token != $sign){
    echo '';
    die();
}
else
{
    $time = strtotime($timestamp);
    $year = date('Y', $time);
    $month = date('m', $time);
    $day = date('d', $time);
    $hour = date('H', $time);

    //充值的具体逻辑由游戏服完成，返回 array('pay_result' => $result);
    $url = "api/pay/?order_id={$orderId}&ac_name={$userId}&pay_gold={$pay_gold}&pay_time={$time}&pay_money={$pay_money}&pay_ticket=0&year={$year}&month={$month}&day={$day}&hour={$hour}&server_id={$server_id}&agent_id={$AGENT_ID}";
    //echo $url;exit;
    $result = getWebJson($url);
    $cold = $result['pay_result'];
    if($cold == 1 || $cold == 2){
        if($backSend == 'N'){
            echo "";
            die();
        }elseif($backSend == 'Y'){
            echo "<!--recv=ok-->";
        }
    }

}




