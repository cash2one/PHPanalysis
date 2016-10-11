<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

if ( !isset($_REQUEST['dStartDate'])) {
    $getdate = getdate(time());
    if($getdate['mon']<6){
        $mon = $getdate['mon']+12-5;
        $year = $getdate['year']-1;
    } else{
        $year = $getdate['year'];
        $mon = $getdate['mon']-5;
    }
    $mon = $mon<10? '0'.$mon:$mon;
    $dStartTime = $year.'-'.$mon;
}
else {
    $dStartTime  = trim(SS($_REQUEST['dStartDate']));
}
if ( !isset($_REQUEST['dEndDate'])) {
    $dEndTime = strftime ("%Y-%m", time() );
}
else {
    $dEndTime = trim(SS($_REQUEST['dEndDate']));
}
if($dEndTime<$dStartTime) {
    errorExit("开始日期大于结束日期");
}


$action = isset($_REQUEST['radio_agent'])?$_REQUEST['radio_agent']:0;
$date1=$dEndTime;
$date2=$dStartTime;
//echo $date1,',',$date2;exit;
$str_start = strtotime($dStartTime);
$arr_start = getdate($str_start);

$str_date = $dStartTime;
for($i=0;$dEndTime>=$str_date;$i++) {
    if($i>120) break;
    $arr_date[] = $str_date;
    $d = strtotime('+1 month',strtotime($str_date));
    $str_date = date('Y-m',$d);
}
$arr_date = array_reverse($arr_date);
$length = count($arr_date);

if($action == 0) {
    $sql = "select sum(pay_money)/100 as money ,FROM_UNIXTIME(pay_time,'%Y-%m') as date,agent_id from all_source_paylog_rmb where from_unixtime(pay_time,'%Y-%m')<='$dEndTime' and from_unixtime(pay_time,'%Y-%m') >='$dStartTime' group by agent_id,date order by agent_id,date desc";
} else {
    $sql = "select sum(pay_money)/100 as money ,FROM_UNIXTIME(pay_time,'%Y-%m') as date,server_id from all_source_paylog_rmb where from_unixtime(pay_time,'%Y-%m')<='$dEndTime' and from_unixtime(pay_time,'%Y-%m') >='$dStartTime' and agent_id=$action group by server_id,date order by server_id,date desc";
}

$result = $db->fetchAll($sql);

foreach($result as $key=>$value) {
    $date = $value['date'];
    $id = $action!=0?$value['server_id']:$value['agent_id'];
    $money = round($value['money'],2);
    $data[$id][$date] = $money;
    $sum[$date] += $money;
}

if(isset($data))
    $data[0]=$sum;
if($action == 0) {
    $chart_name = $AGENT_NAME;
    $chart_name[0] = $buf_lang['left']['all_agents'];

} else {
    foreach($ALL_SERVER_LIST[$action] as $key=>$value) {
        $chart_name[$key] = $value['desc'];
    }
    $chart_name[0] = $AGENT_NAME[$action];

}
ksort($chart_name);
foreach($chart_name as $key=>$value) {
    foreach($arr_date as $v) {
        $money = isset($data[$key][$v])? $data[$key][$v] : 0;
        $format_data[$key][$v] = $money;
        $format_sum[$key] += $money;
    }
}
$date1 = str_replace('-', '/', $dStartTime);
$date2 = str_replace('-', '/', $dEndTime);

foreach($chart_name as $key=>$value) {
    $caption = $value.'   '.$date1.'——'.$date2;
    if($format_sum[$key]>0)
        $chart_message[] = getChart($caption, $format_data[$key],$format_sum[$key], $length, $buf_lang);
}
if(empty($chart_message))
    $smarty->assign('message','查询范围内无充值记录');

$smarty->assign('data',$chart_message);
$smarty->assign('agent',$action);
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("dStartTime", $dStartTime);
$smarty->assign("dEndTime", $dEndTime);
$smarty->display('module/center/pay_month_sum_pic.html');



/*
 * 获取绘制图表所需的XML以及图表信息
 * @params $caption strin  XML表头信息
 * @params $arr  array  XML中set数据
 * @params $sum  number 金额总数
 * @params $count   number 查询的天数
 * @return  $data array   $data['message']是图表描述 $data['xml']图表所需XML数据
*/
function getChart($caption,$arr,$sum,$count,$arr_lang) {
    $avg_value = round($sum/$count);
    $head = "<graph bgcolor='e1f5ff' hovercapbg='FFFFDD' hovercapborder='000000' numdivlines='4' canvasBorderColor='114B78' animation='0' showAlternateHGridColor='1' alternateHGridAlpha='10' alternateHGridColor='006F00' formatNumberScale='0' decimalPrecision='0' caption =' ".$caption."' >";
    if(empty($arr))
        $set = '';
    else {
        foreach($arr as $key=>$value) {
            $color = 'AFD8F8';
            $set .= "<set name='$key' value='$value' color='$color' />";
        }
    }
    if(!isset($avg_value)||empty($avg_value))
        $avg = ' ';
    else
        $avg = "<trendlines><line startvalue='$avg_value' displayValue='平均值' color='FF0000' thickness='2' isTrendZone='0'/></trendlines>";
    $data['xml'] = $head.$set.$avg.'</graph>';
    $data['message'] = $caption.$arr_lang['left']['view_limit'].'，'.$arr_lang['left']['total_recharge'].'：<font color="#FF0000">￥'.round($sum,2).'</font>，'.$arr_lang['left']['average_recharge'].': <font color="#FF0000">￥'.round($avg_value,2).'</font>';
    return $data;
}