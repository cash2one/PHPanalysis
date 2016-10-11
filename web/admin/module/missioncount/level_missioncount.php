<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

if ( !isset($_REQUEST['dateStart'])){
	$start_day = GetTime_Today0();
	$dateStart = strftime("%Y-%m-%d",$start_day);
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}
$time_stamp = $dateStartStamp = strtotime($dateStart . ' 0:0:0');
$year = date('Y', $time_stamp);
$month = (int)date('m', $time_stamp);
$day = (int)date('d', $time_stamp);

$mission_id = trim(SS($_POST['mission_id']));
$mission_name = trim(SS($_POST['mission_name']));

$sqlCount="SELECT * FROM t_log_mission_complete WHERE year='{$year}' AND month='{$month}' AND day='{$day}'";

if (!empty($mission_id))
{
	$sqlCount .= " AND mission_id='{$mission_id}'";
}
if (!empty($mission_name))
{
	$sqlCount .= " AND name='{$mission_name}'";
}

$sqlCount .= " order by mission_id, level";

$resultCount = $db->fetchAll($sqlCount);

$pageno = getUrlParam('page');
$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$count_result = count($resultCount);
for($i=1;$i<= $per_page_record;$i++)
{
	if( $i+$startno > $count_result )
	{
		break;
	}
	$keywordlist[$i-1] = $resultCount[$startno+$i-1];
}
$pagelist	= getPages($pageno, $count_result, $per_page_record);

if (!empty($mission_id) || !empty($mission_name))
{
	$mission_id = $keywordlist[0]['mission_id'];
	$mission_name = $keywordlist[0]['name'];
}

$smarty->assign(array(
	'mission'=>$keywordlist
));
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));
$smarty->assign("mission_id", $mission_id);
$smarty->assign("mission_name", $mission_name);
$smarty->assign("search_keyword1", $dateStart);
$smarty->display("module/missioncount/missioncount_level.html");


