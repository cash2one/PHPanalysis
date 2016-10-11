<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/9/29
 * Time: 11:12
 * 传入参数:
 *    pay_num 订单号，360充值中心生成的订单id，最长18位
 * 	  pay_to_user  用户id，帐号是3－13位，纯数字，运营商玩家唯一标识
 *    role_id  充值角色id
 * 	  pay_money  充值额，人民币，单位：元
 * 	  pay_ticket  代金券，单位：Q点
 * 	  pay_gold 元宝数
 * 	  pay_time UNIX时间戳
 *    flag=md5(pay_num + pay_to_user + pay_to_role_id + pay_money + pay_ticket + pay_gold + pay_time + key)
 * 返回：1：成功，2：订单重复，-1：参数不全，-2：验证失败，-3：用户不存在 -4：超时，-5:充值失败
 *
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_INCLUDE."/functions.php";

//1:成功，2:订单重复      -1:参数不全 -2:验证失败 -3:用户不存在 -4:超时 -5:充值失败
//http://domain/[exchange]?qid=50469470&order_amount=10&order_id=360test1056&server_id=S1&sign=7439fb6fa5f82104c107648e9ac77d76
$key = $API_SECURITY_TICKET_PAY;
$order_id    = trim($_REQUEST['order_id']);           //订单号
$ac_name     = trim($_REQUEST['qid']);       //充值的平台帐号  uid
//$pay_role_id = $_REQUEST['role_id'];                //充值角色
$pay_money_yuan   = $_REQUEST['order_amount'];     //充值金额，人民币
//$pay_ticket   = $_REQUEST['pay_ticket'];     //消耗代金券，Q点
$pay_money = intval(floatval($pay_money_yuan) * 100);     //单元转换成分
$pay_gold    = $pay_money_yuan*10;        //充值元宝
$pay_time    = time();        //充值时间
$sign = trim($_REQUEST['sign']);

$server_id = $GAME_SERVER;


if(empty($order_id) || empty($ac_name) || empty($pay_gold) || $pay_gold < 0 || empty($pay_time) || empty($sign)){
    echo 0;      //提交的参数不全
    die();
}
else{
    $token = md5($ac_name.$pay_money_yuan.$order_id."S".$server_id.$key);
    if($token != $sign){
        echo 0;    //验证失败
        die();
    }
}
$year = date('Y', $pay_time);
$month = date('m', $pay_time);
$day = date('d', $pay_time);
$hour = date('H', $pay_time);

//充值的具体逻辑由游戏服完成，返回 array('pay_result' => $result);
$url = "api/pay/?order_id={$order_id}&ac_name={$ac_name}&pay_gold={$pay_gold}&pay_time={$pay_time}&pay_money={$pay_money}&pay_ticket=0&year={$year}&month={$month}&day={$day}&hour={$hour}&server_id={$server_id}&agent_id={$AGENT_ID}";

$result = getWebJson($url);
$cold = $result['pay_result'];
if($cold == 1){
    echo 1;die();
}elseif($cold == 2){
    echo 2;die();
}else{
    echo 0;die();
}