<?php

/**
 * 道具消耗接口
 * @author yejunyi@4399.com
 * @date 2012.2.10
 * 传入参数:dateStart=YYYY-MM-DD
 *       dateEnd=YYYY-MM-DD
 *       flag=md5(dateStart+dateEnd+key)
 * 返回：日期，购买元宝，消耗元宝，剩余元宝，赠送元宝
 * 	   {date, pay_gold， used_gold， left_gold， send_gold}
 *    注:date:YYYY-MM-DD，left_gold=pay_gold+send_gold-left_gold
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';
global $db;

//-1:参数不全 -2:验证失败

$dateStart = trim($_REQUEST['dateStart']);
$dateEnd   = trim($_REQUEST['dateEnd']);
$flag      = trim($_REQUEST['flag']);
if (empty($dateStart) || empty($dateEnd) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($dateStart . $dateEnd . $API_SECURITY_TICKET_DATA);
	echo $token;
	if($token != $flag)
	{
		echo(json_encode(-2));
		die();
	}
}


$str_start_time = strtotime($dateStart.' 00:00:00');
$str_end_time = strtotime($dateEnd.' 23:59:59');



for($d = $str_start_time;$d<$str_end_time;){
    $return[]['date'] = date('Y-m-d',$d);
    $d += 60*60*24;
}




$mflag=0;
$mtype = LogGoldClass::getSpendTypeList();
foreach($mtype as $key=>$value){
    if($mflag==1) $str_mtype .=',';
    $str_mtype .=$key;
    $mflag=1;
}
$sql_pay_gold = "SELECT  FROM_UNIXTIME(pay_time,'%Y-%m-%d') as date,sum(pay_gold) as pay_gold FROM `t_log_pay`
                where pay_time>=$str_start_time and pay_time<=$str_end_time group by date order by date asc";

$sql_used_gold = "SELECT  FROM_UNIXTIME(mtime,'%Y-%m-%d') as date,sum(`gold_unbind`) as used_gold  FROM `t_log_use_gold`
                where mtime>=$str_start_time and mtime<=$str_end_time and mtype in ( $str_mtype ) group by date order by date asc";

$sql_send_gold = "SELECT  FROM_UNIXTIME(mtime,'%Y-%m-%d') as date,sum(`gold_unbind`) as used_gold  FROM `t_log_use_gold`
                where mtime>=$str_start_time and mtime<=$str_end_time and mtype=4001 group by date order by date asc";

$pay_gold  = $db->fetchAll($sql_pay_gold);
$used_gold = $db->fetchAll($sql_used_gold);
$send_gold = $db->fetchAll($sql_send_gold);



foreach($used_gold as $value){
    $date = $value['date'];
    $gold = $value['used_gold'];
    $format_used_gold[$date] = $gold;
}

foreach($send_gold as $value){
    $date = $value['date'];
    $gold = $value['used_gold'];
    $format_send_gold[$date] = $gold;
}

foreach($pay_gold as $value){
    $date = $value['date'];
    $gold = $value['pay_gold'];
    $format_pay_gold[$date] = $gold;
}


foreach($return as $key=>$value){
    $date = $value['date'];

    $pay_gold  = isset($format_pay_gold[$date])?$format_pay_gold[$date]:0;
    $used_gold = isset($format_used_gold[$date])?$format_used_gold[$date]:0;
    $send_gold = 0-(isset($format_send_gold[$date])?$format_send_gold[$date]:0);//赠送元宝数据库中值为负

    $return[$key]['pay_gold']  = $pay_gold;
    $return[$key]['used_gold'] = $used_gold;
    $return[$key]['send_gold'] = $send_gold;
    $return[$key]['left_gold'] = $pay_gold + $send_gold - $used_gold;
}

echo json_encode($return);


