<?php
define('IN_DATANG_SYSTEM', true);

global $smarty; 
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';

//元宝总使用量（含绑定与不绑定）
$total_used_gold = getShopTotal();
/*echo '<pre>';
print_r($total_used_gold);exit;*/
//绑定元宝总使用情况
$sql_bind = "SELECT sum(gold_bind) as gold_bind_all FROM t_log_use_gold WHERE gold_bind > 0";
$gold_bind_all_result = GFetchRowOne($sql_bind);
$gold_bind_all = empty($gold_bind_all_result['gold_bind_all']) ? 0 : $gold_bind_all_result['gold_bind_all'];

//不绑定元宝使用情况
$sql_unbind = "SELECT sum(gold_unbind) as gold_unbind_all FROM t_log_use_gold WHERE gold_unbind > 0";
$gold_unbind_all_result = GFetchRowOne($sql_unbind);
$gold_unbind_all = empty($gold_unbind_all_result['gold_unbind_all']) ? 0 : $gold_unbind_all_result['gold_unbind_all'];

if ( !isset($_REQUEST['dateStart'])){
	$start_day = GetTime_Today0() - 7*86400;
	$dateStart = strftime("%Y-%m-%d",$start_day);
}elseif ( $_REQUEST['dateStart'] == 'ALL') {
    $dateStart  = SERVER_ONLINE_DATE;
}else{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}

if ( !isset($_REQUEST['dateEnd']))
	$dateEnd = strftime ("%Y-%m-%d", time() );
elseif ( $_REQUEST['dateStart'] == 'ALL') {
    $dateEnd = strftime ("%Y-%m-%d", time() );
}else{
	$dateEnd = trim(SS($_REQUEST['dateEnd']));
}

$role_id = trim(SS($_REQUEST['role_id']));
$nickname = trim(SS($_REQUEST['nickname']));
$acname = trim(SS($_REQUEST['acname']));
$type = trim(ss($_REQUEST['type']));

$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

//前天
$dateStrPrev  = strftime ("%Y-%m-%d", $dateStartStamp - 86400);
$dateStrToday = strftime ("%Y-%m-%d"); //今天
//后一天
$dateStrNext  = strftime ("%Y-%m-%d", $dateStartStamp + 86400);


if(empty($type)){
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
	}
}else if($type = "url"){

	$search_id = trim(SS($_REQUEST['search_id']));
	$search_nickname = trim(SS($_REQUEST['search_nickname']));
	$search_acname = trim(SS($_REQUEST['search_acname']));
	$dateEndStamp = trim(SS($_REQUEST['dateEndStamp']));
	$dateStartStamp = trim(SS($_REQUEST['dateStartStamp']));

}
	$buy_stat = array(); 
	$buy_stat = LogGoldClass :: getBuyLogStats($search_acname, $search_nickname, $search_id, $dateStartStamp, $dateEndStamp);
	foreach($buy_stat as $id => $row)
	{
		$iid = intval($row['itemid']);
		//	$str = str_replace('系统商店2购买道具【', '', $row['mdetail']);
		//	$str = str_replace('】', '', $str);
		//	$buy_stat[$id]['item_name'] = $str;
		//	preg_match("/(\S*【)(\S*)(】)$/", $row['mdetail'], $matches);
		
		preg_match("/(\S*【)([\S ]*)(】)$/", $row['mdetail'], $matches);
		$buy_stat[$id]['item_name'] = $matches[2];
        $buy_stat[$i]['mtype_name'] = $typename[$buy_stat[$i]['mtype']];
		if ($total_used_gold[0]['gbd'] == 0)
        {
            $buy_stat[$id]['gold_bind_per'] = 0;
        }
        else
        {
            if($row['gold_bind'] < 0)
            {
                $buy_stat[$id]['gold_bind_per'] = '';
            }
            else
            {
                $buy_stat[$id]['gold_bind_per'] = round($row['gold_bind']*100/$total_used_gold[0]['gbd'], 2);
            }
        }

        if ($total_used_gold[0]['gud'] == 0)
        {
            $buy_stat[$id]['gold_unbind_per'] = 0;
        }
        else
        {
            if($row['gold_unbind'] < 0)
            {
                $buy_stat[$id]['gold_unbind_per'] = '';
            }
            else
            {
                $buy_stat[$id]['gold_unbind_per'] = round($row['gold_unbind']*100/$total_used_gold[0]['gud'], 2);
            }
        }
	}


$data = getGoldUseStatData($dateStartStamp, $dateEndStamp, $search_acname, $search_nickname, $search_id, $gold_bind_all, $gold_unbind_all);


$tlist = LogGoldClass :: GetTypeList();

$smarty->assign("total_used_gold", $total_used_gold);

$smarty->assign("gold_bind_all", $gold_bind_all);
$smarty->assign("gold_unbind_all", $gold_unbind_all);


$smarty->assign("tlist", $tlist);
$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);
$smarty->assign("dateStartStamp", $dateStartStamp);
$smarty->assign("dateEndStamp", $dateEndStamp);

$smarty->assign("dateStrPrev", $dateStrPrev);
$smarty->assign("dateStrNext", $dateStrNext);
$smarty->assign("dateStrToday", $dateStrToday);

$smarty->assign("order", $order);

$smarty->assign("keywordlist", $data);
$smarty->assign("list", $role_result);
$smarty->assign("search1", $search_acname);
$smarty->assign("search2", $search_nickname);
$smarty->assign("role_id", $search_id);

$smarty->assign("buy_stat", $buy_stat);

$smarty->display("module/analysis/gold_use_stat.html");

//////////////////////////////////////////////////////////////

function getGoldUseStatData($startTime, $endTime, $acname, $nickname, $role_id, $gold_bind_all, $gold_unbind_all)
{
	$sql = "SELECT l.`mtype`,`mdetail`, count(distinct (l.`user_name`)) as role_num, count( l.`id` ) AS c, sum( l.`amount` ) AS ss ,(sum(l.`gold_bind`)+sum(l.`gold_unbind`)) AS gold , sum(l.`gold_bind`) AS gold_bind ,sum(l.`gold_unbind`) AS gold_unbind FROM `t_log_use_gold` as l WHERE `mtime`>={$startTime} AND `mtime`<={$endTime} " ;

	if(!empty($acname))
	{
		$sql .= " AND l.`account_name`='{$acname}' ";
	}
	if(!empty($nickname))
	{
		$sql .= " AND l.`user_name`='{$nickname}' ";
	}
	if(!empty($role_id))
	{
		$sql .= " AND l.`user_id`='{$role_id}' ";
	}
	$sql .= " GROUP BY `mtype` " ;
	$sql .=  " ORDER BY gold_unbind DESC, ss DESC, c DESC ";

	$result = GFetchRowSet($sql);
	if(!is_array($result))
		$result = array();

	$tlist = LogGoldClass :: GetTypeList();
	foreach($result as $id => $row) 
	{
		$mtype = intval($row['mtype']);
		$result[$id]['desc'] = $tlist[$mtype];
		
		if ($gold_bind_all == 0)
		{
			$result[$id]['gold_bind_per'] = 0;
		}
		else
		{
			if($row['gold_bind'] < 0)
			{
				$result[$id]['gold_bind_per'] = '';
			}
			else
			{
				$result[$id]['gold_bind_per'] = round($row['gold_bind']*100/$gold_bind_all, 2);
			}
		}
		
		if ($gold_unbind_all == 0)
		{
			$result[$id]['gold_unbind_per'] = 0;
		}
		else
		{
			if($row['gold_unbind'] < 0)
			{
				$result[$id]['gold_unbind_per'] = '';
			}
			else
			{
				$result[$id]['gold_unbind_per'] = round($row['gold_unbind']*100/$gold_unbind_all, 2);
			}
		}
	}

	return $result;
}

function getShopTotal()
{
	$sql = 'SELECT ( sum( l. `gold_bind` ) + sum( l. `gold_unbind` ) ) AS tg , sum( l. `gold_bind` ) AS gbd , sum( l. `gold_unbind` ) AS gud FROM `t_log_use_gold` as l where `mtype` = 3002 ';
	$row = GFetchRowSet($sql);
	return $row;
}


