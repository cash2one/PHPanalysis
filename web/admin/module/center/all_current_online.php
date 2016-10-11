<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';

global $smarty, $db;
if ( isset($_REQUEST['dStartDate'])) {

    $dStartDate = trim(SS($_REQUEST['dStartDate']));
}
else {
    $dStartDate = strftime ("%Y-%m-%d", time() );
}
$action = isset($_REQUEST['radio_agent'])?$_REQUEST['radio_agent']:0;

$where = $action!=0? " and agent_id=$action":' ';

if($action == 0) {
    $chart_name = $AGENT_NAME;
    $chart_name[0] = $buf_lang['left']['all_agents'];
} else {
    foreach($ALL_SERVER_LIST[$action] as $key=>$value) {
        $chart_name[$key] = $value['desc'];
    }
    $chart_name[0] = $AGENT_NAME[$action];
}

$sql_max_id = "select max(id)as id from all_server_online where date='$dStartDate' $where group by agent_id,server_id";
$id_array = $db->fetchAll($sql_max_id);
if(!empty($id_array)) {
    $flag=0;
    foreach ($id_array as $v) {
        if($flag==1) $id_list .= ',';
        $id_list .= $v['id'];
        $flag=1;
    }
//    $sql_all = "SELECT max(a.online) as max, min(a.online) as min from(select sum(online) as online,date,hour,min from all_server_online where date='$dStartDate' $where  group by date,hour,min)  a  group by a.date";


    $sql_agent = "SELECT max(a.online) as max, min(a.online) as min,a.agent_id as id from(select sum(online) as online ,date,hour,min,agent_id from all_server_online where date='$dStartDate'  group by agent_id,date,hour,min)  a  group by a.agent_id";
    $sql_now_online_agent = "select sum(online) as now,agent_id as id from all_server_online where id in($id_list) group by agent_id order by agent_id";

    $sql_server = "select max(online) as max,min(online) as min,server_id as id from all_server_online where date='$dStartDate' $where group by server_id";
    $sql_now_online_server = "select online as now,server_id as id from all_server_online where id in($id_list) $where  order by server_id";
    if($action==0) {
        $max_min_online = $db->fetchAll($sql_agent);
        $now_online = $db->fetchAll($sql_now_online_agent);
       
    }
    else {
        $max_min_online = $db->fetchAll($sql_server);
        $now_online = $db->fetchAll($sql_now_online_server);
        
    }
    foreach($max_min_online as $value ) {
        $format_max_min[$value['id']] = $value;
    }
    foreach ($now_online as $key =>$value) {
        $id = $value['id'];
        $now_online[$key]['max'] = $format_max_min[$id]['max'];
        $now_online[$key]['min'] = $format_max_min[$id]['min'];
        $now_online[$key]['desc'] = $chart_name[$id];
        $total['now'] += $value['now'];
        $total['max'] += $format_max_min[$id]['max'];
        $total['min'] += $format_max_min[$id]['min'];
    }
    $total['desc'] ='<b>'. $buf_lang['conmon']['total'].'</b>';
    $now_online[] = $total;
    $online = $now_online;
    

}
else $online = null;

$smarty->assign('agent',$action);
$smarty->assign("dStartDate", $dStartDate);
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("all_online_info", $online);
$smarty->display('module/center/all_current_online.html');

