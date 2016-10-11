<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;


if ( isset($_REQUEST['dStartDate'])){
	$dateStart = $_REQUEST['dStartDate'];
}
else
{
	$dateStart = strftime ("%Y-%m-%d", time()-(60*60*24)*5 );
}

if ( isset($_REQUEST['dEndDate']))
{
    $dateEnd = $_REQUEST['dEndDate'];
}
else
{
	$dateEnd= strftime ("%Y-%m-%d",time());
}
$agent = isset($_REQUEST['radio_agent'])?$_REQUEST['radio_agent']:0;
$server_ids = isset($_REQUEST['server_ids'])?$_REQUEST['server_ids']:array(0);
$flag = 0;
foreach($server_ids as $k=>$v){
    if($flag) $server_list .=',';
    $server_list .= $k;
    $flag = 1;
}


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
$where = ' ';
if($agent){
    $where .= " and agent_id=$agent  and server_id in($server_list) ";
}

$starttime = strtotime($dateStart.' 00:00:00');
$endtime = strtotime($dateEnd.' 23:59:59');

$start = date('Y-m-d',strtotime($dateStart)-24*60*60);
$end = $dateEnd;
$sql = "select sum(left_unbind) as left_unbind,sum(left_bind) as left_bind,sum(add_unbind) as add_unbind,sum(add_bind) as add_bind,
    sum(used_unbind) as used_unbind ,sum(used_bind) as used_bind,sum(send_unbind) as send_unbind ,sum(send_bind) as send_bind,sum(avg_online) as avg_online,
    agent_id,server_id,FROM_UNIXTIME(dateline,'%Y-%m-%d') as date
    from `t_log_day_gold` where `dateline`>=$starttime and `dateline`<=$endtime $where  group by `dateline` order by dateline asc";
$result = $db->fetchAll($sql);


$format[0]['date'] = $buf_lang['conmon']['maximum'];
$format[1]['date'] = $buf_lang['new']['average'];
$times = 0;
foreach($result as $key=>$value) {

    if(!$key) {
        if($value['date']<$dateStart) {
            $last['gold_bind'] = $value['left_bind'];
            $last['gold_unbind'] = $value['left_unbind'];
            continue ;
        }
        else {
            $last['gold_bind'] = 0;
            $last['gold_unbind'] = 0;
        }
    }
    $online = $value['avg_online']|1;

    $result[$key]['p_add_bind'] = round($value['add_bind']/$online);
    $result[$key]['p_add_unbind'] = round($value['add_unbind']/$online);
    $result[$key]['p_used_bind'] = round($value['used_bind']/$online);
    $result[$key]['p_used_unbind'] = round($value['used_unbind']/$online);
    $result[$key]['last_unbind'] = $last['gold_unbind'];
    $result[$key]['last_bind'] = $last['gold_bind'];
    $result[$key]['used_bind_percent'] = div_round($value['used_bind'],$last['gold_bind']+$value['add_bind'],4)*100;
    $result[$key]['used_unbind_percent'] = div_round($value['used_unbind'],$last['gold_unbind']+$value['add_unbind'],4)*100;
    $result[$key]['add_bind_percent'] = div_round($value['add_bind']-$value['used_bind'],$value['add_bind'],4)*100;
    $result[$key]['add_unbind_percent'] = div_round($value['add_unbind']-$value['used_unbind'],$value['add_unbind'],4)*100;
    $last['gold_bind'] = $value['left_bind'];
    $last['gold_unbind'] = $value['left_unbind'];

    $format[] = $result[$key];
    $times += 1;
    foreach($result[$key] as $k=>$v) {

        if($k!='date') {
            $format[0][$k]<$v? $format[0][$k]=$v:'';
            $format[1][$k] += $v;
        }
    }
}

foreach($format[1] as $k=>$v){
    if($k=='date') continue;
    $format[1][$k] = round($v/$times);
}
$charts[0]['desc'] = $buf_lang['new']['used_gold'];
$charts[1]['desc'] = $buf_lang['left']['bind'].$buf_lang['new']['used_gold'];
$charts[2]['desc'] = $buf_lang['new']['added_gold'];
$charts[3]['desc'] = $buf_lang['left']['bind'].$buf_lang['new']['added_gold'];
$charts[4]['desc'] = $buf_lang['new']['left_gold'];
$charts[5]['desc'] = $buf_lang['left']['bind'].$buf_lang['new']['left_gold'];
$charts[6]['desc'] = $buf_lang['new']['person_added_gold'];
$charts[7]['desc'] = $buf_lang['new']['person_added_gold'].'('.$buf_lang['left']['bind'].')';
$charts[8]['desc'] = $buf_lang['new']['person_used_gold'];
$charts[9]['desc'] = $buf_lang['new']['person_used_gold'].'('.$buf_lang['left']['bind'].')';


$flag = 0;
foreach($format as $k=>$v){
    if($k==1||$k==0) continue;

    $xAxis .= ($flag==1?',':'').  "'". $v['date']."'";
    $charts[0]['data'] .= ($flag==1?',':''). $v['used_unbind'];
    $charts[1]['data'] .= ($flag==1?',':''). $v['used_bind'];
    $charts[2]['data'] .= ($flag==1?',':''). $v['add_unbind'];
    $charts[3]['data'] .= ($flag==1?',':''). $v['add_bind'];
    $charts[4]['data'] .= ($flag==1?',':''). $v['left_unbind'];
    $charts[5]['data'] .= ($flag==1?',':''). $v['left_bind'];
    $charts[6]['data'] .= ($flag==1?',':''). $v['p_add_unbind'];
    $charts[7]['data'] .= ($flag==1?',':''). $v['p_add_bind'];
    $charts[8]['data'] .= ($flag==1?',':''). $v['p_used_unbind'];
    $charts[9]['data'] .= ($flag==1?',':''). $v['p_used_bind'];
    $flag = 1;
}


$smarty->assign("time_start", $dateStart);
$smarty->assign("time_end", $dateEnd);
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign('agent_id',$agent);
$smarty->assign('servers',json_encode($servers));
$smarty->assign('server_id',json_encode($server_ids));
$smarty->assign('charts',$charts);
$smarty->assign('xAxis',$xAxis);
$smarty->assign("data", $format);

$smarty->display("module/center/day_gold_log.html");


//若$b=0,返回0
//return round($a/$b,$flag);
function div_round($a,$b,$flag=2){
    if($b==0) return 0;
    return round($a/$b,$flag);
}