<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/9/29
 * Time: 10:07
 */

include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_INCLUDE."/functions.php";

$server_id = $GAME_SERVER;

if($server_id == 3){
    $key = '';
    $pay_to_user = $_REQUEST['qid'];
    $pay_money = $_REQUEST['order_amount'];
    $pay_num = $_REQUEST['order_id'];
    $flag = $_REQUEST['sign'];
    $pay_role_id = $_REQUEST['role_id'];                //充值角色
    $pay_gold = $pay_money*10;
    $pay_time = time();
    $token = md5($username.$pay_money.$order_id.$server_id.$key);
    if($token != $flag){
        echo(0);    //验证失败
        die();
    }else{
        header("Location:./pay.php?pay_to_user=". $pay_to_user ."&pay_time=". $pay_time ."&pay_num=". $pay_num ."&pay_money=". $pay_money ."&pay_gold=". $pay_gold ."&flag=".$sign);
        die();
    }
}