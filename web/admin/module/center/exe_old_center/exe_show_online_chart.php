<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

echo "It's constructing...";die();

$sql = 'select id , now_time , sum( now_online ) as sum_now_online , sum( max_online ) as sum_max_online , '
        . ' sum( min_online ) as sum_min_online , sum( all_max_online ) as sum_all_max_online , '
        . ' game_server_id , agent_id '
        . ' from '
        . ' ( '
        . ' select * from ( select * from t_log_online_summary_all order by id desc ) a '
        . ' group by agent_id , game_server_id '
        . ' ) b '
        . ' group by agent_id , game_server_id '
        . ' with rollup'; 
$all_online_info = $db->FetchAll($sql);
foreach($all_online_info as $key => $value)
{
	$all_online_info[$key]['agent_name'] = $AGENT_NAME[$value['agent_id']];
}

$smarty->assign("all_online_info", $all_online_info);
$smarty->display("module/center/exe_show_online_chart.html");
