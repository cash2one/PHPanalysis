<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;


if ( !isset($_REQUEST['dStartDate'])) {
    $dStartTime = date("Y-m-d",time()-30*60*60*24);
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

$where = $group_by = '';
if($action_agent!=0){
    $where = " and agent_id=$action_agent ";
    $group_by = ",agent_id ";
    if($action_server!=0){
        $where .= " and server_id = $action_server ";
        $group_by .= " ,server_id ";
    }
}

$sql = "select `date`,sum(all_players) as all_players,sum(accept_players) as accept_players,sum(accept_teams) as accept_teams,sum(login_players) as login_players
    ,sum(login_teams) as login_teams from all_inter_pk_3v3  where `date`>='$dStartTime' and `date`<='$dEndTime' $where group by `date` $group_by order by `date` desc";
$result = $db->fetchAll($sql);

$week_ch = array(0=>'(星期天)',1=>'(星期一)',2=>'(星期二)',3=>'(星期三)',4=>'(星期四)',5=>'(星期五)',6=>'(星期六)');

foreach($result as $k=>$v){
    
    $date = $v['date'];
    $week = date('w',strtotime($date));
    $result[$k]['date'] .= $week_ch[$week];
    $result[$k]['ap_percent'] = round($v['accept_players']/$v['all_players']*100,2) .'%';
    $result[$k]['lp_percent'] = round($v['login_players']/$v['accept_players']*100,2) .'%';
    $result[$k]['lt_percent'] = round($v['login_teams']/$v['accept_teams']*100,2) .'%';
}


$smarty->assign('data',$result);
$smarty->assign('agent_id',$action_agent);
$smarty->assign('server_id',$action_server);
$smarty->assign('servers',json_encode($servers));
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("dStartTime", $dStartTime);
$smarty->assign("dEndTime", $dEndTime);
$smarty->display('module/center/all_inter_pk_3v3.html');



