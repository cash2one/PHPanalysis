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
$action_agent = isset($_REQUEST['radio_agent'])?$_REQUEST['radio_agent']:0;
$action_server = isset($_REQUEST['radio_server'])?$_REQUEST['radio_server']:0;
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

foreach($ALL_SERVER_LIST as $key=>$value) {
    if($key == 0) continue;
    foreach($value as $k=>$v) {
        $serStr = "S".$k;
        if($v['stat'] == 4)//未开
        {
            continue;
        }
        else if($v['stat'] == 2)//合服
        {
            $serStr .= "(合)";
        }
        else if($v['stat'] == 3)//关服
        {
            $serStr .= "(关)";
        }
        $servers[$key][$k] = $serStr;
    }
}

$min = array(0,30);
for($i=0;$i<=23;$i++){
    foreach($min as $v){
        $h = $i>=10?$i:'0'.$i;
        $m = $v>0? $v:'00';
        $key = $h.'/'.$m;
        $arr_time[$i][$v] = $key;
        $format_time[] = $key;
    }
}

$action .= $action_agent  > 0? " agent_id=$action_agent and  ":' 1 and  ';
$action .= $action_server > 0? " server_id=$action_server and  ":' 1 and  ';

$sql = "select sum(online) as online,date,hour,min from all_server_online where $action date>='$dStartTime' and date<='$dEndTime'  group by date,hour,min";
$result = $db->fetchAll($sql);


foreach($result as $key=>$value) {
    $date = $value['date'];
    $h = $value['hour'];
    $m = $value['min'];
    $time = $arr_time[$h][$m];
    //$id = $action != 0? $value['server_id']:$value['agent_id'];
    $online = $value['online'];
    $data[$date][$time] = $online;
}
empty($data)?$data=array():$data;
foreach($data as $key=>$value) {
    foreach($format_time as $v) {
        $online = isset($value[$v])? $value[$v] : 0;
        $format_data[$key][$v] = $online;
        if($online>$format_max[$key]['max']){
            $format_max[$key]['max'] = $online;
            $format_max[$key]['time'] = $v;
        }
        $format_sum[$key] += $online;
    }
}

$date1 = str_replace('-', '/', $dStartTime);
$date2 = str_replace('-', '/', $dEndTime);

foreach($arr_date as $value) {
    $caption = $value;
    if($format_max[$value]['max']>0)
        $chart_message[] = getChart($caption, $format_data[$value],$format_max[$value],$format_sum[$value],48,$buf_lang);
}

if(empty($chart_message))
    $smarty->assign('message','查询范围内无充值记录');



$smarty->assign('data',$chart_message);
$smarty->assign('agent_id',$action_agent);
$smarty->assign('server_id',$action_server);
$smarty->assign('servers',json_encode($servers));
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("dStartTime", $dStartTime);
$smarty->assign("dEndTime", $dEndTime);
$smarty->display('module/center/online_half_hour_pic.html');



/*
 * 获取绘制图表所需的XML以及图表信息
 * @params $caption strin  XML表头信息
 * @params $arr  array  XML中set数据
 * @params $sum  number 金额总数
 * @params $count   number 查询的天数
 * @return  $data array   $data['message']是图表描述 $data['xml']图表所需XML数据
*/
function getChart($caption,$arr,$format_max,$sum,$count,$arr_lang = array()) {
    $avg_value = round($sum/$count);
    $head = "<graph bgcolor='e1f5ff' hovercapbg='FFFFDD' hovercapborder='000000' numdivlines='4' numVDivLines='46' rotateNames='1'  canvasBorderColor='114B78'  animation='0' showAlternateHGridColor='1' alternateHGridAlpha='10'  formatNumberScale='0' decimalPrecision='0' caption =' ".$caption."' >";
    if(empty($arr))
        $set = '';
    else {
        foreach($arr as $key=>$value) {
//            $d = date('N',strtotime($key));
//            if($d==6 || $d==7)
//                $color = 'F6BD0F';
//            else $color = 'AFD8F8';
            $color = 'F6BD0F';
            $name = substr($key, 5);
            $set .= "<set name='$key' value='$value' color='$color' />";
        }
    }
 if(!isset($avg_value)||empty($avg_value))
        $avg = ' ';
    else
        $avg = "<trendlines><line startvalue='$avg_value' displayValue='".$arr_lang['new']['average']."' color='FF0000' thickness='2' isTrendZone='0'/></trendlines>";
    $data['xml'] = $head.$set.$avg.'</graph>';
     $data['message'] = $caption.'——【'.$arr_lang['new']['online_hour_hightest'].'： <font color="#FF0000">'.$format_max['max'].$arr_lang['conmon']['ren'].'('.$format_max['time'].')</font>'.'；'. $arr_lang['new']['average'].'：<font color="#FF0000">'.round($avg_value).$arr_lang['conmon']['ren'].'</font>】';
    return $data;
}