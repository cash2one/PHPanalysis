<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$year = date('Y');
$month = date('m');
$day = date('d');
$dateStart  = trim(SS($_REQUEST['dateStart']));
$hour = trim(SS($_REQUEST['hour']));
$min = trim(SS($_REQUEST['min']));

$where = '';
if (!empty($dateStart) || !empty($hour) || !empty($min)){
	if($dateStart){
		$dateStartStamp = strtotime($dateStart);
		$year = date('Y',$dateStartStamp);
		$month=date('m',$dateStartStamp);
		$day = date('d',$dateStartStamp);
		$where = " and year = {$year} and month = {$month} and day = {$day}";
	}
	if($hour){
		$where .= " and hour = {$hour}";
	}
	if($min){
		$where .= " and min = {$min}";
	}
}


$page = getUrlParam('pid');

if ($page == 0) 
{ 
	$begin = 0;
} else 
{
	$begin = ($page - 1) * LIST_PER_PAGE_RECORDS;
}

//先取出最大的在线
$sql = "select max(online) as online from ".T_LOG_ONLINE." where 1 ".$where;
$result = $db->fetchAll($sql);
$maxOnline = $result[0]['online'];

$sqlCount = "select count(id) as count from ".T_LOG_ONLINE." where 1".$where;
$resultCount = $db->fetchOne($sqlCount);
$counts = $resultCount['count'];
	
//分页显示
$sql = "select online, dateline,distinct_ip from ".T_LOG_ONLINE." order by dateline desc limit $begin, ".LIST_PER_PAGE_RECORDS;
if($where != ''){
	$where = substr($where,4,strlen($where)-1);
	$sql = "select online, dateline,distinct_ip from ".T_LOG_ONLINE." where ". $where . " order by dateline desc limit $begin, ".LIST_PER_PAGE_RECORDS;
}

$result = $db->fetchAll($sql);

foreach ($result as &$v) {
	$v['weight'] = @($v['online'] / $maxOnline) * 480;
}

$pagesHTML = getPages($page, $counts, LIST_PER_PAGE_RECORDS);

$smarty->assign(array('onlines' => $result, 'pageHTML'=>$pagesHTML));
$smarty->assign("page_count", ceil($counts/LIST_PER_PAGE_RECORDS));
$smarty->assign("time_start", $dateStart);
$smarty->assign("hour",$hour);
$smarty->assign("min",$min);
$smarty->display("module/online/history.html");

