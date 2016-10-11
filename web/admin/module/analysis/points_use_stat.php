<?php
define('IN_DATANG_SYSTEM', true);
//TODO:需要增加用户的安全验证

global $smarty; 
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_points_class.php';

$total_used_points = getShopTotal();

$sql_points = "SELECT sum(points) as points_all FROM t_log_use_points WHERE points > 0";
$points_all_result = GFetchRowOne($sql_points);
$points_all = $points_all_result['points_all'];

//print_r($silver_bind_all);echo "<br>";

/*$sql_unbind = "SELECT sum(silver_unbind) as silver_unbind_all FROM t_log_use_silver WHERE silver_unbind > 0";
$silver_unbind_all_result = GFetchRowOne($sql_unbind);
$silver_unbind_all = $silver_unbind_all_result['silver_unbind_all'];*/

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

if ( !isset($_REQUEST['dateEnd']))
	$dateEnd = strftime ("%Y-%m-%d", time() );
elseif ( $_REQUEST['dateStart'] == 'ALL') {
    $dateEnd = strftime ("%Y-%m-%d", time() );
}
else
	$dateEnd = trim(SS($_REQUEST['dateEnd']));

$role_id = trim(SS($_POST['role_id']));
$nickname = trim(SS($_POST['nickname']));
$acname = trim(SS($_POST['acname']));

$userid = 0;
if (!empty($role_id) || !empty($nickname) || !empty($acname))
{
	$sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1 ";
	if (!empty($role_id))
	{
		$sql .= " AND role_id='{$role_id}'";
	}
	else if (!empty($nickname))
	{
		$sql .= " AND role_name='{$nickname}'";
	}
	else if (!empty($acname))
	{
		$sql .= " AND account_name='{$acname}' AND agent_id='{$AGENT_ID}'";
	}
	$role_result = $db->fetchOne($sql);
	$userid = $role_result['role_id'];
}

$get_all = false;
if ($userid<1)
{
	$get_all = true;
}


$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

$dateStrPrev  = strftime ("%Y-%m-%d", $dateStartStamp - 86400);
$dateStrToday = strftime ("%Y-%m-%d");
$dateStrNext  = strftime ("%Y-%m-%d", $dateStartStamp + 86400);

if($get_all || $userid>=1)
{
	$data = getPointsUseStatData($dateStartStamp, $dateEndStamp, $userid, $points_all);
}

$buy_stat = array(); 
if($get_all || $userid>=1)
{
	$buy_stat = LogPointsClass :: getBuyLogStats($userid, $dateStartStamp, $dateEndStamp);
}

$pointclass=new LogPointsClass();

foreach($buy_stat as $id => $row) {
    $buy_stat[$id]['item_name'] = get_item_list($row['itemid'], $pointclass->item_list);
	
	if ($total_used_points[0]['points_all'] == 0)
	{
		$buy_stat[$id]['points_per'] = 0;
	}
	else
	{
		if($row['points'] < 0)
		{
			$buy_stat[$id]['points_per'] = '';
		}
		else
		{
			$buy_stat[$id]['points_per'] = round($row['points']*100/$total_used_points[0]['points_all'], 2);
		}
	}
}
//exit(print_r($buy_stat));
//$tlist = LogSilverClass :: GetTypeList();

$smarty->assign("tlist", $tlist);
$smarty->assign("points_all", $points_all);
$smarty->assign("total_used_points", $total_used_points);

$smarty->assign("silver_bind_all", $silver_bind_all);
$smarty->assign("silver_unbind_all", $silver_unbind_all);

$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);

$smarty->assign("dateStrPrev", $dateStrPrev);
$smarty->assign("dateStrNext", $dateStrNext);
$smarty->assign("dateStrToday", $dateStrToday);

$smarty->assign("keywordlist", $data);
$smarty->assign("search1", $role_result['role_name']);
$smarty->assign("search2", $role_result['account_name']);
$smarty->assign("role_id", $role_result['role_id']);

$smarty->assign("buy_stat", $buy_stat);

$smarty->display("module/analysis/points_use_stat.html");
exit;
//////////////////////////////////////////////////////////////

function getPointsUseStatData($startTime, $endTime,$uid, $points_all)
{
	
	$sql = "SELECT l.`mtype`, count(distinct (l.`user_id`)) as role_num, count( l.`id` ) AS c, sum( l.`amount` ) AS ss ,sum(l.`points`) AS points  FROM `t_log_use_points` as l"
		 . " WHERE `mtime`>={$startTime} AND `mtime`<={$endTime} " ;
	if($uid)
		$sql .= " AND l.`user_id`={$uid} ";	
	$sql .= " GROUP BY `mtype` " ;	
	$sql .=  " ORDER BY ss DESC, c DESC ";
	
	$result = GFetchRowSet($sql);
	//exit(print_r($result));
	if(!is_array($result))
		$result = array();

	$tlist = LogPointsClass :: GetTypeList();
	foreach($result as $id => $row) {
		$mtype = intval($row['mtype']);
		$result[$id]['desc'] = $tlist[$mtype];
		if ($points_all == 0)
		{
			$result[$id]['points_per'] = 0;
		}
		else
		{
			if($row['points'] < 0)
			{
				$result[$id]['points_per'] = '';
			}
			else
			{
				$result[$id]['points_per'] = round($row['points']*100/$points_all, 2);
			}
		}
	}
	return $result;
}

function getShopTotal()
{
	$sql = 'SELECT sum( l. `points` ) AS points_all '
         . ' FROM `t_log_use_points` as l '
         . ' where `mtype` = 9001 ';
	$row = GFetchRowSet($sql);
	return $row;
}
function get_item_list($itemid , $array = array()) {
		if (isset ($array[$itemid]))
			return $array[$itemid];
		else
			return '未知';
		}