<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

if ( !isset($_REQUEST['dStartDate'])) {
    $dStartTime = date("Y-m-d",time()-7*60*60*24);
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

$strtime1 = strtotime($dEndTime)+60*60*24;
$strtime2 = strtotime($dStartTime);

$search_action = $action != 0? "  and agent_id=$action  " : ' ';
$sql = "select sum(pay_money)/100 as money ,FROM_UNIXTIME(pay_time,'%Y-%m-%d') as date,FROM_UNIXTIME(pay_time,'%H') as hour  from all_source_paylog_rmb where pay_time<$strtime1 and pay_time>=$strtime2 $search_action
      group by date,hour order by date desc,hour desc limit 100";
//echo $sql;exit;
$result = $db->fetchAll($sql);

//echo '<pre>';print_r($result);exit;
$data = array();
foreach($result as $key=>$value) {
    $hour = $value['hour'];
    $id = $action?$value['date']:$value['date'];
    $money = $value['money'];
    $data[$id][$hour] = $money;
}

$chart_name = $AGENT_NAME;
$chart_name[0] = $buf_lang['left']['all_agents'];
ksort($chart_name);
//echo '<pre>';print_r($data);exit;
$format_data = array();
$format_sum = array();
if(isset($data)) {
    foreach($data as $key=>$value) {
        for($i=0; $i<=23;  $i++ ) {
            if($i<10){
                $k = "0".$i;
            }else{
                $k = $i;
            }
            $money = isset($data[$key][$k])? $data[$key][$k] : 0;
            $format_data[$key][$k] = $money;
            $format_sum[$key] += $money;
        }
    }
    foreach($format_data as $key=>$value) {
        $caption = $chart_name[$action].'  '.$key;
        if($format_sum[$key]>0)
            $chart_message[] = getChart($caption, $format_data[$key],$format_sum[$key], 24 , $buf_lang);
    }
} else
    $smarty->assign('message','无充值记录');

$smarty->assign('data',$chart_message);
$smarty->assign('agent',$action);
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("dStartTime", $dStartTime);
$smarty->assign("dEndTime", $dEndTime);
$smarty->display('module/center/pay_hour_sum_pic.html');



/*
 * 获取绘制图表所需的XML以及图表信息
 * @params $caption strin  XML表头信息
 * @params $arr  array  XML中set数据
 * @params $sum  number 金额总数
 * @params $count   number 24
 * @return  $data array   $data['message']是图表描述 $data['xml']图表所需XML数据
*/
function getChart($caption,$arr,$sum,$count,$arr_lang = array()) {
    $avg_value = round($sum/$count);
    $head = "<graph bgcolor='e1f5ff' hovercapbg='FFFFDD' hovercapborder='000000' numdivlines='4' numVDivLines='22' canvasBorderColor='114B78'  animation='0' showAlternateHGridColor='1' alternateHGridAlpha='10'  formatNumberScale='0' decimalPrecision='0' caption =' ".$caption."' >";
    if(empty($arr))
        $set = '';
    else {
        foreach($arr as $key=>$value) {
//            $d = date('N',strtotime($key));
//            if($d==6 || $d==7)
//                $color = 'F6BD0F';
//            else $color = 'AFD8F8';
//            $name = substr($key, 5);
            $color = 'F6BD0F';
            $set .= "<set name='$key' value='$value' color='$color' />";
        }
    }
    if(!isset($avg_value)||empty($avg_value))
        $avg = ' ';
    else
        $avg = "<trendlines><line startvalue='$avg_value' displayValue='平均值' color='FF0000' thickness='2' isTrendZone='0'/></trendlines>";
   $data['xml'] = $head.$set.$avg.'</graph>';
    $data['message'] = $caption.$arr_lang['new']['hour_detail_view'].' ' .$arr_lang['left']['total_recharge'].'：<font color="#FF0000">￥'.round($sum,2).'</font>，'.$arr_lang['left']['average_recharge'].': <font color="#FF0000">￥'.round($avg_value,2).'</font>';
    return $data;
}