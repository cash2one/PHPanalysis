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

$strtime1 = strtotime($date1)+60*60*24;
$strtime2 = strtotime($date2);
for($t=$strtime1-1,$i=0; $t>=$strtime2; ) {
    $arr_date[] = date('Y-m-d',$t);
    $t -= 60*60*24;
}
$length = count($arr_date);
if($action == 0) {
    $sql_all = "SELECT max(a.online) as online,date from(select sum(online) as online ,date,hour,min,agent_id from all_server_online where date>='$dStartTime' and date<='$dEndTime'  group by date,hour,min)  a  group by a.date";
    $sql     = "SELECT max(a.online) as online,date,agent_id from(select sum(online) as online ,date,hour,min,agent_id from all_server_online where date>='$dStartTime' and date<='$dEndTime'  group by date,hour,min,agent_id)  a  group by a.date,a.agent_id";
} else {
    $sql_all = "SELECT max(a.online) as online,date from(select sum(online) as online ,date,hour,min,agent_id from all_server_online where date>='$dStartTime' and date<='$dEndTime' and agent_id=$action  group by date,hour,min,agent_id)  a  group by a.date,a.agent_id";
    $sql     = "select max(online) as online,date,server_id from all_server_online where date>='$dStartTime' and date<='$dEndTime' and agent_id=$action group by date,server_id ";
}

$result = $db->fetchAll($sql);
$result_all = $db->fetchAll($sql_all);

foreach($result_all as $value){
    $date = $value['date'];
    $online = $value['online'];
    $data[0][$date] = $online;
}

foreach($result as $key=>$value) {
    $date = $value['date'];
    $id = $action != 0? $value['server_id']:$value['agent_id'];
    $online = $value['online'];
    $data[$id][$date] = $online;
}

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
        $online = isset($data[$key][$v])? $data[$key][$v] : 0;
        $format_data[$key][$v] = $online;
        if($online>$format_max[$key]['max']){
            $format_max[$key]['max'] = $online;
            $format_max[$key]['date'] = $v;
        }
    }
}

$date1 = str_replace('-', '/', $dStartTime);
$date2 = str_replace('-', '/', $dEndTime);

foreach($chart_name as $key=>$value) {
    $caption = $value.'   '.$date1.'——'.$date2;
    if($format_max[$key]['max']>0)
        $chart_message[] = getChart($caption, $format_data[$key],$format_max[$key],$buf_lang);
}

if(empty($chart_message))
    $smarty->assign('message','查询范围内无充值记录');
$smarty->assign('data',$chart_message);
$smarty->assign('agent',$action);
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("dStartTime", $dStartTime);
$smarty->assign("dEndTime", $dEndTime);
$smarty->display('module/center/online_day_max_pic.html');



/*
 * 获取绘制图表所需的XML以及图表信息
 * @params $caption strin  XML表头信息
 * @params $arr  array  XML中set数据
 * @params $format_max  array 峰值在线数据：max=>最高值，data=>日期
 * @return  $data array   $data['message']是图表描述 $data['xml']图表所需XML数据
*/
function getChart($caption,$arr,$format_max,$arr_lang = array()) {
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
    $data['xml'] = $head.$set.$avg.'</graph>';
    $data['message'] = $caption.$arr_lang['left']['view_limit'].'，'.$arr_lang['new']['most_top'].$arr_lang['left']['top_online'].'——【 <font color="#FF0000">'.$arr_lang['new']['time'].'：'.$format_max['date'].' '.$arr_lang['conmon']['people_num'].'：'.$format_max['max'].'</font>】';
    return $data;

}