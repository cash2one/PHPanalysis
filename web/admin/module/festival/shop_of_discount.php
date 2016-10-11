<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
include SYSDIR_ADMIN."/class/log_gold_class.php";
global $smarty, $db;


if ( isset($_REQUEST['dStartDate'])){
	$dateStart = $_REQUEST['dStartDate'];
}
else
{
	$dateStart = strftime ("%Y-%m-%d", time()-(60*60*24)*5 );
}

if ( isset($_REQUEST['dEndDate']))
{
    $dateEnd = $_REQUEST['dEndDate'];
}
else
{
	$dateEnd= strftime ("%Y-%m-%d",time());
}
$u_start = strtotime($dateStart.' 00:00:00');
$u_end = strtotime($dateEnd.' 23:59:59');

$item_name = array(
        10800183=>'九折锻造小礼包',
        10800187=>'九折锻造大礼包',
        10800207=>'坐骑进阶折扣包',
        10800195=>'洗炼折扣包',
        10800203=>'镶嵌折扣小礼包',
        10800199=>'镶嵌折扣大礼包',
        10800191=>'宠物折扣包'
);
$item_list = '10800183,10800187,10800191,10800195,10800199,10800203,10800207';

$expend_type = LogGoldClass::getSpendTypeList();
$flag=0;
foreach($expend_type as $k=>$v){
    if($flag) $expend_list .=',';
    $expend_list .= $k;
    $flag=1;
}

$sql_all = "select sum(gold_unbind) as money from t_log_use_gold where mtype in($expend_list) and `mtime`>={$u_start} and `mtime`<={$u_end} ";
$all_gold = $db->fetchOne($sql_all);
$all_gold = $all_gold['money'];


$sql = "select count(*) as operate_times,count(distinct user_id) as role_times,sum(gold_unbind) as gold,itemid
        from t_log_use_gold where itemid in($item_list)  and `mtime`>={$u_start} and `mtime`<={$u_end}  group by itemid order by itemid asc";
$result = $db->fetchAll($sql);


foreach( $result as $k=>$v){
    $tmp['operate_times']  = $v['operate_times'];
    $tmp['role_times'] = $v['role_times'];
    $tmp['gold'] = $v['gold'];
    $tmp['item_name'] = $item_name[$v['itemid']];
    $tmp['total'] = $all_gold;
    $tmp['percent'] = round($v['gold']/$all_gold*100,2);
    $total['operate_times']  += $v['operate_times'];
    $total['role_times'] += $v['role_times'];
    $total['gold'] += $v['gold'];
    $total['percent'] += $tmp['percent'];
    
    $tmp['percent'] .= '%';
    $format[] = $tmp;
}
$total['total'] = $all_gold;
$total['item_name'] ='<font color="red">Total</font>';
$total['percent'] .= '%';
if($total['percent']>0)
    $format[] = $total;




$acname  = trim(SS($_REQUEST['acname']));
$nickname = trim(SS($_REQUEST['nickname']));
$userid  = trim(SS($_REQUEST['userid']));


$acname  = trim(SS($acname));
$nickname = trim(SS($nickname));
$userid  = trim(SS($userid));
$pageno = getUrlParam('page');
$where = '1';

if(!empty($userid))
{
	$where .= " AND `user_id` = '{$userid}'";
}
if (!empty($acname))
{
	$where .= " AND `account_name` = '{$acname}'";
}

if (!empty($nickname))
{
	$where .= " AND `user_name` = '{$nickname}'";
}
$where .= " AND itemid in($item_list) ";
$search_sort = 'mtime desc ';

$tablename = "t_log_use_gold";

//	if(count($balance) <1 ){
//		$smarty->assign("warning","抱歉，查询不到该玩家的领取");
//	}

$count_result	= 0;
$keywordlist2	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);

if(!empty($keywordlist2))
{
	foreach($keywordlist2 as $kPay => $vPay)
	{
		$keywordlist2[$kPay]['item_name'] = $item_name[$vPay['itemid']];
	}
}

//$excel		= getExcel($tablename, $where, $search_sort, $typename,$buf_lang);
$pagelist	= getPages($pageno, $count_result);








$smarty->assign("total", $format);
$smarty->assign("output", $output);

$smarty->assign("time_start", $dateStart);
$smarty->assign("time_end", $dateEnd);

$smarty->assign("search_keyword1", $acname);
$smarty->assign("search_keyword2", $nickname);
$smarty->assign("search_keyword3", $userid);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist2", $keywordlist2);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));
$smarty->assign("warning","抱歉，查询不到该玩家的领取");


$smarty->display("module/festival/shop_of_discount.html");