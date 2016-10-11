<?php

/**
 * 获取订单信息
 * @author 叶军谊
 * @date 2012.04.18
 * 传入参数：
 *      order 订单号，
 *      time  UNIX时间戳，
 *      flag  加密串md5(order+time+key)，
 *      serverid  充值的服务器id（如果不需要该参数或无服务器概念，可无视）
 * 返回：订单号，平台id，游币，游戏币，时间，角色名，服务器id
 * {order,username,money,gamemoney,time:,nickname,serve_id}
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$order= trim($_REQUEST['order']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
$server_id = trim($_REQUEST['serverid']);

$key = '91wan#cw@6T*%x6&Pe#4399';

if(!$order||!$time||!$flag){
    echo 4;
    exit;

    }


$agent_name = $AGENT_NAME[$AGENT_ID];
$serverID = $GAME_SERVER;

$token = md5($order.$time.$key);
if($token!=$flag){
    echo 5;
    exit;
}else{
    $sql = 'select order_id as `order`,role_name as nickname, from_unixtime(pay_time,"%Y-%m-%d %H:%i:%s") as time,(pay_money/100+pay_ticket/10) as money,pay_gold as gamemoney
        from db_pay_log_p  where order_id="'.$order.'" limit 1';
    $result = $db->fetchOne($sql);
    if(!$result){
        echo -1;
        exit;
    } else{
        $json = $result;
        $json['username'] = $agent_name;
        $json['server_id'] = $serverID;
        echo json_encode($json);
    }
}


