<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$sqlCount="SELECT * from ".T_LOG_MISSION." ORDER BY mission_id";
$resultCount = $db->fetchAll($sqlCount);
foreach($resultCount as $key=>$value)
{
	if($value['accept_num'] == 0)
	{
		$resultCount[$key]['mission_lost_rate'] = 0.00;
	}
	else
	{
		$resultCount[$key]['mission_lost_rate'] = round(($value['accept_num']-$value['complete_num'])*100/$value['accept_num'],2);
	}
}
//echo '<pre>';print_r($resultCount);exit;
$smarty->assign(array(
	'mission'=>$resultCount
));

$smarty->display("module/missioncount/missioncount.html");


