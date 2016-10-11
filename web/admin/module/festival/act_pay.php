<?php

define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';

$act_pay_desc = array(
1 => '首充礼包(1次)',
2 => '99礼包(1次)',
3 => '200礼包(洗练套餐)',
4 => '200礼包(锻造套餐)',
5 => '200礼包(镶嵌套餐)',
6 => '200礼包(宠物套餐)',
7 => '500礼包(1次)',
8 => '1000礼包(1次)',
9 => '2000礼包(1次)',
10 => '5000礼包(1次)',
);

$action = $_REQUEST['action'];

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
{
	$dateEnd = trim(SS($_REQUEST['dateEnd']));
}

$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

//内置充值活动
$act_type = 3009;
$tablename = "t_log_festival_pay";
$act_pay_sql = "SELECT sub_event_id, count(distinct(role_id)) as role_cnt, count(id) as bag_cnt, detail " .
		"FROM `t_log_festival_pay` where event_id={$act_type} and mtime>={$dateStartStamp} and mtime<={$dateEndStamp} " .
		"group by event_id, sub_event_id";
$act_pay_result = GFetchRowSet($act_pay_sql);

$goosql = "select id,name from `t_PGoods` ";
$tem_name = GFetchRowSet($goosql);
foreach($tem_name as $v)
{
	$goods_name[$v['id']] = $v['name'];
}

if(!empty($act_pay_result))
{
	foreach($act_pay_result as $kPay => $vPay)
	{
		$act_pay_result[$kPay]['type_detail'] = $act_pay_desc[$vPay['sub_event_id']];
		$item_list = explode('#',$vPay['detail']);
		
		$bag_detail = "";
		if(!empty($item_list))
		{
			foreach($item_list as $kItem => $vItem)
			{
				$item_detail = explode("-", $vItem);
				if(!empty($item_detail[0]))
				{
					$bag_detail .= $goods_name[$item_detail[0]];
					$bag_detail .= "*".$item_detail[1].";";
				}
			}
		}
		$act_pay_result[$kPay]['bag_detail'] = $bag_detail;
	}
}


$acname  = trim(SS($_REQUEST['acname']));
$nickname = trim(SS($_REQUEST['nickname']));
$userid  = trim(SS($_REQUEST['userid']));
$sub_event_id = trim(SS($_REQUEST['act_type']));

$acname  = trim(SS($acname));
$nickname = trim(SS($nickname));
$userid  = trim(SS($userid));
$pageno = getUrlParam('page');
$where = '1';

if(!empty($userid))
{
	$where .= " AND `role_id` = '{$userid}'";
}
if (!empty($acname)) 
{	
	$where .= " AND `account_name` = '{$acname}'";	
}

if (!empty($nickname)) 
{
	$where .= " AND `user_name` = '{$nickname}'";
}
$where .= " AND event_id={$act_type} ";

if($sub_event_id != 0)
{
	$where .= " AND sub_event_id={$sub_event_id}";
}



$tablename = "t_log_festival_pay";

//	if(count($balance) <1 ){
//		$smarty->assign("warning","抱歉，查询不到该玩家的领取");
//	}

$count_result	= 0;
$keywordlist2	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);
if(!empty($keywordlist2))
{
	foreach($keywordlist2 as $kPay => $vPay)
	{
		$keywordlist2[$kPay]['type_detail'] = $act_pay_desc[$vPay['sub_event_id']];
		$item_list = explode('#',$vPay['detail']);
		
		$bag_detail = "";
		if(!empty($item_list))
		{
			foreach($item_list as $kItem => $vItem)
			{
				$item_detail = explode("-", $vItem);
				if(!empty($item_detail[0]))
				{
					$bag_detail .= $goods_name[$item_detail[0]];
					$bag_detail .= "*".$item_detail[1].";";
				}
			}
		}
		$keywordlist2[$kPay]['bag_detail'] = $bag_detail;
	}
}
//$excel		= getExcel($tablename, $where, $search_sort, $typename,$buf_lang);
$pagelist	= getPages($pageno, $count_result);



$smarty->assign("time_start", $dateStartStr);
$smarty->assign("time_end", $dateEndStr);
$smarty->assign("search_keyword1", $acname);
$smarty->assign("search_keyword2", $nickname);
$smarty->assign("search_keyword3", $userid);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $act_pay_result);
$smarty->assign("keywordlist2", $keywordlist2);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));
$smarty->assign("warning","抱歉，查询不到该玩家的领取");
$smarty->assign("act_pay_desc",$act_pay_desc);
$smarty->display("module/festival/act_pay.html");
