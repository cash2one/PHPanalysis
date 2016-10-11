<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/10/23
 * Time: 16:20
 */

define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_INCLUDE."/functions.php";
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$account = $_REQUEST['account'];
$role = $_REQUEST['role'];
$orderid = $_REQUEST['orderid'];
$rmb = $_REQUEST['rmb'];
$pay_money = intval(floatval($rmb) * 100);     //单元转换成分
$pay_gold  = $rmb*10;        //充值元宝

$num = $_REQUEST['num'];
$time = $_REQUEST['time'];
$type = $_REQUEST['type'];
$game = $_REQUEST['game'];
$server = $_REQUEST['server'];
$sign = $_REQUEST['sign'];
$key = $API_SECURITY_TICKET_PAY;
$itemid = $_REQUEST['itemid'];
$price = $_REQUEST['price'];
$cparam = $_REQUEST['cparam'];
$request = array();
$now_time = time();
$server_id = $GAME_SERVER;


if(empty($account) || empty($orderid) || empty($rmb) || empty($num) || empty($type) || empty($time) || empty($game) || empty($server) || empty($role) || empty($itemid) || empty($price)){

    $request = array(
        'code' => -10,
        'date' => null
    );
    echo json_encode($request);
    die();
}

if(($now_time-$time) > 10000){
    $request = array(
        'code' => -15,
        'date' => null
    );
    echo json_encode($request);
}
else
{
    $roleName = urldecode($role);
    $cparamStr = urldecode($cparam);

    $token = strtolower(md5($account.$orderid.$rmb.$num.$type.$time.$game.$server.$roleName.$itemid.$price.$cparamStr.$key));
    //echo $token;exit;
    if($token != $sign){
        $request = array(
            'code' => -11,
            'data' => null
        );
        echo json_encode($request);
    }else{

        $sql = "select account_name from db_role_base_p where role_id=".$role;
        $user = $db->fetchOne($sql);
        $accountName = $user['account_name'];

        $year = date('Y', $time);
        $month = date('m', $time);
        $day = date('d', $time);
        $hour = date('H', $time);

//充值的具体逻辑由游戏服完成，返回 array('pay_result' => $result);
        $url = "api/pay/?order_id={$orderid}&ac_name={$accountName}&pay_gold={$pay_gold}&pay_time={$time}&pay_money={$pay_money}&pay_ticket=0&year={$year}&month={$month}&day={$day}&hour={$hour}&server_id={$server_id}&agent_id={$AGENT_ID}";

        $result = getWebJson($url);

        $cold = $result['pay_result'];
        if($cold == 1){
            $request = array(
                'code' => 1,
                'date' => array(
                    'orderid' => $orderid,
                    'rmb'     => $rmb,
                    'account' => $account
                )
            );
            echo json_encode($request);

        }elseif($cold == 2){
            $request = array(
                'code' => -18,
                'date' => null
            );
            echo json_encode($request);
        }else{
            $request = array(
                'code' => -20,
                'date' => null
            );
            echo json_encode($request);
        }
    }
}







