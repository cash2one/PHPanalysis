<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

echo "It's constructing...";die();

if ( !isset($_REQUEST['dateStart'])){
	$start_day = GetTime_Today0();
	$dateStart = strftime("%Y-%m-%d",$start_day);
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}

$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);

$year = date('Y', $dateStartStamp);
$month = date('m', $dateStartStamp);
$day = date('d', $dateStartStamp);

$sql = 'SELECT id , round(sum( pay_day ),2) as sum_pay_day , round(sum( role_cnt ),2) as sum_role_cnt , round(sum( times_cnt ),2) as sum_times_cnt , ' .
	   'round( sum( arpu ) / count( id ) , 2 ) as sum_arpu , year , month , day , agent_id , game_server_id '
     . ' FROM `t_log_pay_day_all` '
     . ' where year = ' .
       $year .
       ' and month = ' .
       $month .
       ' and day = ' .
       $day
     . ' group by agent_id , game_server_id '
     . ' with rollup'; 
$all_online_info = $db->FetchAll($sql);
foreach($all_online_info as $key => $value)
{
	$all_online_info[$key]['agent_name'] = $AGENT_NAME[$value['agent_id']];
}

$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("all_online_info", $all_online_info);
$smarty->display("module/center/exe_show_pay_day_chart.html");
