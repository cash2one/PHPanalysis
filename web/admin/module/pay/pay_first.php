<?php
/**
 * Created by PhpStorm.
 * User: zhangbowen
 * Date: 2015/3/28
 * Time: 11:56
 */

define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';
//include SYSDIR_ADMIN.'/class/log_gold_class.php';
//include SYSDIR_INCLUDE."/functions.php";
global $smarty;

/*$order_id = "201503281428503478";
$ac_name = 'jian1234567';
$pay_time= time();
$pay_money = 123;
$pay_ticket = 0;
$year = date('Y', $pay_time);
$month = date('m', $pay_time);
$day = date('d', $pay_time);
$hour = date('H', $pay_time);
$server_id = $GAME_SERVER;

$url = "api/pay/?order_id={$order_id}&ac_name={$ac_name}&pay_gold={$pay_gold}&pay_time={$pay_time}&pay_money={$pay_money}&pay_ticket={$pay_ticket}&year={$year}&month={$month}&day={$day}&hour={$hour}&server_id={$server_id}&agent_id={$AGENT_ID}";
echo $url;exit;
$result = getWebJson($url);
echo '<pre>';var_dump($result);exit;*/


if ( !isset($_REQUEST['dateStart'])){
    $start_day = GetTime_Today0() - 7*86400;
    $dateStart = strftime("%Y-%m-%d",$start_day);
}
elseif ( $_REQUEST['dateStart'] == 'ALL') {
    $dateStart  = SERVER_ONLINE_DATE;
}
else
{
    $dateStart  = trim(SS($_REQUEST['dateStart']));
}

if (!isset($_REQUEST['dateEnd']))
    $dateEnd = strftime ("%Y-%m-%d", time());
else{
    if ($_REQUEST['dateStart'] == 'ALL') {
        $dateEnd = strftime ("%Y-%m-%d", time() );
    }
    else
        $dateEnd = trim(SS($_REQUEST['dateEnd']));
}
$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

//查询首充等级人数
$sql = "SELECT COUNT(distinct(`role_id`)) as role_cnt, level FROM `t_log_first_pay` where mtime >= ".$dateStartStamp." and mtime <" .$dateEndStamp." group by level order by level";
$result = GFetchRowSet($sql);
if(!is_array($result)){
    $numStat = array();
}else{
    $numSum = 0;
    foreach($result as $k => $v){
        $numSum += $v['role_cnt'];
    }
    $numStat = array();
    foreach($result as $k => $v){
        $numStat[$k] = $v;
        $numStat[$k]['cnt'] = round($v['role_cnt']*100/$numSum ,2).'%';
    }
}




//首充金额人数
$sql = "SELECT COUNT(distinct(role_id)) as role_cnt, first_pay_money FROM `t_log_first_pay` WHERE mtime >= ". $dateStartStamp ." and mtime < ". $dateEndStamp ." group by first_pay_money order by first_pay_money desc";
$result = GFetchRowSet($sql);
if(!is_array($result)){
    $moneyStat = array();
}else{
    $moneySum = 0;
    foreach($result as $k => $v){
        $moneySum += $v['role_cnt']*$v['first_pay_money']/100;
    }
    $moneyStat = array();
    foreach($result as $k => $v){
        $moneyStat[$k] = $v;
        $moneyStat[$k]['cnt'] = round($v['first_pay_money']*$v['role_cnt']/$moneySum , 2).'%';
    }
}

$smarty->assign('search_keyword1', $dateStartStr);
$smarty->assign('search_keyword2', $dateEndStr);
$smarty->assign('numStat', $numStat);
$smarty->assign('moneyStat', $moneyStat);
$smarty->assign('numSum', $numSum);
$smarty->assign('moneySum', $moneySum);
$smarty->display("module/pay/pay_first.html");



