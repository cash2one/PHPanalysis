<?php

/**
 * 未消耗元宝
 * @author 叶军谊
 * @date 2012.04.18
 * 传入参数：
 *      fromDate 开始时间，
 *      toDate 结束时间，
 *      sign MD5验证串md5(fromDate.toDate.KEY)
 * 返回：开始时间，结束时间，累计充值金额，赠送元宝数，剩余元宝数
 * {fromDate,toDate,TotalPayNum ,TotalZsGold,TotalRemain}
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$fromDate = trim($_REQUEST['fromDate']);
$toDate = trim($_REQUEST['toDate']);
$sign = trim($_REQUEST['sign']);
$key = '91wan#cw@6T*%x6&Pe#4399';

if(!$fromDate||!$toDate){
    echo -2 ;
    exit;
}
$startDate = strtotime($fromDate);
$endDate = strtotime($toDate);

$token = md5($fromDate.$toDate.$key);

if($token != $sign){
    echo -1;
    exit;
}else{
    $sql = 'select sum(add_unbind ) as TotalGold,sum(send_unbind ) as  Total_Zs_Num ,max(dateline) as date
         from `t_log_day_gold` where dateline>='.$startDate.' and dateline<='.$endDate .' limit 1';
    $result = $db->fetchOne($sql);
    $maxdate = $result['date'];
    $sql_left = 'select left_unbind as TotalRemain from `t_log_day_gold` where dateline='.$maxdate.' limit 1';
    $rt = $db->fetchOne($sql_left);

    
    $json['Total_Zs_Num'] = $result['Total_Zs_Num'];
    $json['TotalGold'] = $result['TotalGold'];
    $json['fromDate'] = $fromDate;
    $json['toDate'] = $toDate;
    $json['TotalRemain'] = $rt['TotalRemain'];
    echo json_encode($json);
}



