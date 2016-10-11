<?php
define('IN_DATANG_SYSTEM', true);
//TODO:需要增加用户的安全验证

global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';



if ( !isset($_REQUEST['dateStart'])){
	$start_day = GetTime_Today0() - 7*86400;
	$dateStart = strftime("%Y-%m-%d",$start_day);
}
elseif ( $_REQUEST['dateStart'] == 'ALL') {
    $dateStart  = SERVER_ONLINE_DATE;
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}

if (!isset($_REQUEST['dateEnd']))
	$dateEnd = strftime ("%Y-%m-%d", time());
else{
    if ($_REQUEST['dateStart'] == 'ALL') {
    $dateEnd = strftime ("%Y-%m-%d", time() );
}
else
	$dateEnd = trim(SS($_REQUEST['dateEnd']));
}
$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

$data = getDragonItemData($dateStartStamp, $dateEndStamp);
$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);
$smarty->assign('items',$data);
$smarty->display("module/analysis/dragon_item_logs.html");
exit;

/*
 * 返回某一时间段屠龙获得道具统计
 * @param startTime unix时间戳
 * 起始时间
 * @param endTime unix时间戳
 * 结束时间
 * @rerurn 道具统计数据 array 包含字段包括物品ID，物品名，数量，百分比
 */
function getDragonItemData($startTime, $endTime)
{
    $sql = 'select `item_id` as id,`item_name` as name, sum(`item_num`) as number, COUNT(DISTINCT role_id) AS role_count from `t_log_item` where mtype=10003 and mtime>='.$startTime.' and  mtime<='.$endTime.' group by  item_id ';

    $result = GFetchRowSet($sql);
    if(!is_array($result))
		$result = array();

    $itemTotal = 0;
    $len = count($result);
    for ($i=0; $i<$len; $i++)
    {
        $itemTotal += $result[$i]['number'];
    }
    $len = count($result);
    for($i=0; $i<$len; $i++)
    {
        $percent = round($result[$i]['number']/$itemTotal *100,2);
        $result[$i]['percent'] = $percent.'%';
    }
    
    return $result;  
}