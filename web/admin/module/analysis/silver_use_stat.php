<?php
define('IN_DATANG_SYSTEM', true);
//TODO:需要增加用户的安全验证

global $smarty; 
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_silver_class.php';

$total_used_silver = getShopTotal();
//print_r($total_used_silver);

$sql_bind = "SELECT sum(silver_bind) as silver_bind_all FROM t_log_use_silver WHERE silver_bind > 0";
$silver_bind_all_result = GFetchRowOne($sql_bind);
$silver_bind_all = $silver_bind_all_result['silver_bind_all'];

//print_r($silver_bind_all);echo "<br>";

$sql_unbind = "SELECT sum(silver_unbind) as silver_unbind_all FROM t_log_use_silver WHERE silver_unbind > 0";
$silver_unbind_all_result = GFetchRowOne($sql_unbind);
$silver_unbind_all = $silver_unbind_all_result['silver_unbind_all'];

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
$type = trim(ss($_REQUEST['type']));


$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

$dateStrPrev  = strftime ("%Y-%m-%d", $dateStartStamp - 86400);
$dateStrToday = strftime ("%Y-%m-%d");
$dateStrNext  = strftime ("%Y-%m-%d", $dateStartStamp + 86400);

	if(empty($type)){
		//$userid = 0;
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
			$role_result = $db->fetchAll($sql);
			//$userid = $role_result['role_id'];
		}
	}else{
		if($type = "url"){
			$search_id = trim(SS($_REQUEST['search_id']));
			$search_nickname = trim(SS($_REQUEST['search_nickname']));
			$search_acname = trim(SS($_REQUEST['search_acname']));
			$dateStartStamp = trim(SS($_REQUEST['dateStartStamp']));
			$dateEndStamp = trim(SS($_REQUEST['dateEndStamp']));
		}
		/*
		$get_all = false;
		if ($userid<1)
		{
			$get_all = true;
		}

		*/

		/*if($get_all || $userid>=1)
		{
			$data = getSilverUseStatData($dateStartStamp, $dateEndStamp, $userid, $silver_bind_all, $silver_unbind_all);
		}*/
		

		
		$buy_stat = array();
		$buy_stat = LogSilverClass :: getBuyLogStats($search_id, $dateStartStamp, $dateEndStamp);
		/*if($get_all || $userid>=1)
		{
			$buy_stat = LogSilverClass :: getBuyLogStats($userid, $dateStartStamp, $dateEndStamp);
		}*/
		foreach($buy_stat as $id => $row) {
			$iid = intval($row['itemid']);
			//	$str = str_replace('系统商店购买道具【', '', $row['mdetail']);
			//	$str = str_replace('】', '', $str);
			//	$buy_stat[$id]['item_name'] = $str;
			
			//preg_match("/(\S*【)(\S*)(】)$/", $row['mdetail'], $matches);
			preg_match("/(\S*【)([\S ]*)(】)$/", $row['mdetail'], $matches);
			$buy_stat[$id]['item_name'] = $matches[2];
			
			if ($total_used_silver[0]['silver_bind'] == 0)
			{
				$buy_stat[$id]['silver_bind_per'] = 0;
			}
			else
			{
				if($row['silver_bind'] < 0)
				{
					$buy_stat[$id]['silver_bind_per'] = '';
				}
				else
				{
					$buy_stat[$id]['silver_bind_per'] = round($row['silver_bind']*100/$total_used_silver[0]['silver_bind'], 2);
				}
			}
			
			if ($total_used_silver[0]['silver_unbind'] == 0)
			{
				$buy_stat[$id]['silver_unbind_per'] = 0;
			}
			else
			{
				if($row['silver_unbind'] < 0)
				{
					$buy_stat[$id]['silver_unbind_per'] = '';
				}
				else
				{
					$buy_stat[$id]['silver_unbind_per'] = round($row['silver_unbind']*100/$total_used_silver[0]['silver_unbind'], 2);
				}
			}
		}
	}

$data = getSilverUseStatData($dateStartStamp, $dateEndStamp, $search_id, $silver_bind_all, $silver_unbind_all);
$tlist = LogSilverClass :: GetTypeList();

$smarty->assign("tlist", $tlist);

$smarty->assign("total_used_silver", $total_used_silver);

$smarty->assign("silver_bind_all", $silver_bind_all);
$smarty->assign("silver_unbind_all", $silver_unbind_all);

$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);
$smarty->assign("dateStartStamp", $dateStartStamp);
$smarty->assign("dateEndStamp", $dateEndStamp);

$smarty->assign("dateStrPrev", $dateStrPrev);
$smarty->assign("dateStrNext", $dateStrNext);
$smarty->assign("dateStrToday", $dateStrToday);

$smarty->assign("keywordlist", $data);

$smarty->assign("list", $role_result);
$smarty->assign("search1", $search_id);
$smarty->assign("search2", $search_nickname);
$smarty->assign("role_id", $search_acname);

$smarty->assign("buy_stat", $buy_stat);

$smarty->display("module/analysis/silver_use_stat.html");

//////////////////////////////////////////////////////////////

function getSilverUseStatData($startTime, $endTime,$uid, $silver_bind_all, $silver_unbind_all)
{
	$sql = "SELECT l.`mtype`, count(distinct (l.`user_id`)) as role_num, count( l.`id` ) AS c, sum( l.`amount` ) AS ss ,(sum(l.`silver_bind`)+sum(l.`silver_unbind`)) AS silver , sum(l.`silver_bind`) AS silver_bind ,sum(l.`silver_unbind`) AS silver_unbind FROM `t_log_use_silver` as l"
		 . " WHERE `mtime`>={$startTime} AND `mtime`<={$endTime} " ;
	if($uid)
		$sql .= " AND l.`user_id`={$uid} ";	
	$sql .= " GROUP BY `mtype` " ;	
	$sql .=  " ORDER BY silver DESC, ss DESC, c DESC ";

	$result = GFetchRowSet($sql);
	if(!is_array($result))
		$result = array();

	$tlist = LogSilverClass :: GetTypeList();
	foreach($result as $id => $row) {
		$mtype = intval($row['mtype']);
		$result[$id]['desc'] = $tlist[$mtype];
		
		if ($silver_bind_all == 0)
		{
			$result[$id]['silver_bind_per'] = 0;
		}
		else
		{
			if($row['silver_bind'] < 0)
			{
				$result[$id]['silver_bind_per'] = '';
			}
			else
			{
				$result[$id]['silver_bind_per'] = round($row['silver_bind']*100/$silver_bind_all, 2);
			}
		}
		
		if ($silver_unbind_all == 0)
		{
			$result[$id]['silver_unbind_per'] = 0;
		}
		else
		{
			if($row['silver_unbind'] < 0)
			{
				$result[$id]['silver_unbind_per'] = '';
			}
			else
			{
				$result[$id]['silver_unbind_per'] = round($row['silver_unbind']*100/$silver_unbind_all, 2);
			}
		}
	}

	return $result;
}

function getShopTotal()
{
	$sql = 'SELECT sum( l. `silver_unbind` ) AS silver_unbind, sum( l. `silver_bind` ) AS silver_bind '
         . ' FROM `t_log_use_silver` as l '
         . ' where `mtype` = 1002 ';
	$row = GFetchRowSet($sql);
	return $row;
}