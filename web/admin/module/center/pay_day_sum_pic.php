<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

if ( !isset($_REQUEST['dStartDate'])) {
    $dStartTime = date("Y-m-d",time()-14*60*60*24);
}
else {
    $dStartTime  = trim(SS($_REQUEST['dStartDate']));
}
if ( !isset($_REQUEST['dEndDate'])) {
    $dEndTime = strftime ("%Y-%m-%d", time() );
}
else {
    $dEndTime = trim(SS($_REQUEST['dEndDate']));
}
$action = isset($_REQUEST['radio_agent'])?$_REQUEST['radio_agent']:0;
$date1=$dEndTime;
$date2=$dStartTime;
//if(!isset($_REQUEST['radio_agent'])){
//    $date1 = '2011-11-5';
//    $date2 = '2011-10-15';
//}
$strtime1 = strtotime($date1)+60*60*24;
$strtime2 = strtotime($date2);
for($t=$strtime1-1,$i=0; $t>=$strtime2; ) {
    $arr_date[] = date('Y-m-d',$t);
    $t -= 60*60*24;
}
$length = count($arr_date);

if($action == 0) {
    $sql = "select  sum(pay_money)/100 as money ,FROM_UNIXTIME(pay_time,'%Y-%m-%d') as date,agent_id from all_source_paylog_rmb where pay_time<$strtime1 and pay_time>=$strtime2
      group by agent_id,date order by agent_id,date desc limit 100";
} else {
    $sql = "select sum(pay_money)/100 as money ,FROM_UNIXTIME(pay_time,'%Y-%m-%d') as date,server_id from all_source_paylog_rmb where pay_time<$strtime1 and pay_time>=$strtime2 and agent_id=$action
      group by server_id,date order by server_id,date desc limit 100";
}
$result = $db->fetchAll($sql);

foreach($result as $key=>$value) {
    $date = $value['date'];
    $id = $action!=0?$value['server_id']:$value['agent_id'];
    $money = $value['money'];
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
$smarty->display('module/center/pay_day_sum_pic.html');



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
            $d = date('N',strtotime($key));
            if($d==6 || $d==7)
                $color = 'F6BD0F';
            else $color = 'AFD8F8';
            $name = substr($key, 5);
            $set .= "<set name='$name' value='$value' color='$color' />";
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