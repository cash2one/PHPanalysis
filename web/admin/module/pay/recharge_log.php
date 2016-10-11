<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db; 

$tablename = "db_pay_log_p";
$balance_fen = getTotalMoney($tablename,$AGENT_ID);
$balance = floatval($balance_fen/100);

$pay_roles = getTotalRoles($tablename,$AGENT_ID);

if ( !isset($_REQUEST['dateStart'])){
	$start_day = GetTime_Today0() - 7*86400;
	$dateStart = strftime("%Y-%m-%d",$start_day);
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}

if ( !isset($_REQUEST['dateEnd']))
	$dateEnd = strftime ("%Y-%m-%d", time());
else
{
	$dateEnd = trim(SS($_REQUEST['dateEnd']));
}

$order_id = trim(SS($_REQUEST['order_id']));
$role_id = trim(SS($_REQUEST['role_id']));
$nickname = trim(SS($_REQUEST['nickname']));




$acname = trim(SS($_REQUEST['acname']));
$search_sort_1 = SS($_REQUEST['sort_1']);
if (empty($search_sort_1)) $search_sort_1 = "pay_time desc";
$ex = SS($_REQUEST['excel']);

$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

$pageno = getUrlParam('page');
$search_sort .= $search_sort_1;
$where = '1';

if (!empty($order_id))
{
	$where .= " AND `order_id` = '{$order_id}'";
}
if (!empty($role_id))
{
	$where .= " AND `role_id` = '{$role_id}'";
}
if (!empty($nickname))
{
    $sql = "select role_id from db_role_base_p where role_name = '".$nickname."'";
    $rowset = $db->fetchOne($sql);
    $role_id= $rowset['role_id'];
	$where .= " AND `role_id` = '{$role_id}'";
}
else if (!empty($acname))
{
	$where .= " AND `account_name` = '{$acname}'";
}

$where .= " AND `pay_time`>={$dateStartStamp}";
$where .= " AND `pay_time`<={$dateEndStamp}";

$where .= " AND `agent_id`= {$AGENT_ID}";

$count_result	= 0;
if(!empty($order_id) || !empty($role_id) || !empty($nickname) || !empty($acname))
{
	$keywordlist1 = getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);
    $keywordlist = array();
    foreach($keywordlist1 as $v){
        $sql = "select role_name from db_role_base_p where role_id = ".$v['role_id'];
        $rowname = $db->fetchOne($sql);
        $v['role_name'] = $rowname['role_name'];
        $keywordlist[] = $v;
    }
}
else
{
    $keywordlist1 = getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);
    $keywordlist = array();
    foreach($keywordlist1 as $v){
        $sql = "select role_name from db_role_base_p where role_id = ".$v['role_id'];
        $rowname = $db->fetchOne($sql);
        $v['role_name'] = $rowname['role_name'];
        $keywordlist[] = $v;
    }
}

$pagelist	= getPages($pageno, $count_result);


if(!empty($role_id) || !empty($acname) || !empty($nickname))
{
	$one_status = getRoleMoney($role_id, $acname, $nickname, $dateStartStamp, $dateEndStamp);
}
else
{
	$one_status = array();
}


//输出Excel文件


if(isset($ex) && $ex == true ){
		$excel = getExcel($tablename, $where, $search_sort,$buf_lang);
        $smarty->assign('title', $excel['title']); // 标题
        $smarty->assign('hd', $excel['hd']);       // 表头
        $smarty->assign('num',$excel['hdnum']);    // 列数
        $smarty->assign('ct', $excel['content']);  // 内容

        // 输出文件头，表明是要输出 excel 文件
		$excel['title'] = str_replace(' ','_',$excel['title']);
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$excel['title'].date('_Ymd_Gi').'.xls');
        $smarty->display('module/pay/pay_excel.tpl');
        exit;
}

$sortlistopgion  = getSortTypeListOption($buf_lang);
$smarty->assign('sortoption', $sortlistopgion);
$smarty->assign("search_sort_1", $search_sort_1);
$smarty->assign("balance", $balance);
$smarty->assign("pay_roles", $pay_roles);
$smarty->assign("search1", $acname);
$smarty->assign("search2", $nickname);
$smarty->assign("role_id", $role_id);
$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);

$smarty->assign("keywordlist", $keywordlist);


$smarty->assign("record_count", $count_result);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));
$smarty->assign("one_status", $one_status);

$smarty->display("module/pay/recharge_log.html");

function getSortTypeListOption($arr_lan = array())
{
	return array(
			"pay_time desc" => $arr_lan['new']['pay_time_desc'],
			"pay_time asc"  => $arr_lan['new']['pay_time_asc'],
			"pay_money desc" => $arr_lan['new']['pay_money_desc'],
			"pay_money asc"  => $arr_lan['new']['pay_money_asc'],
			);
}

function getTotalMoney($tablename,$agent_id)
{
	$sql = "select SUM(pay_money)+SUM(pay_ticket*10) as s from ".$tablename." WHERE `agent_id`= {$agent_id}";
	$row = GFetchRowOne($sql);
	return $row['s'];
}

function getTotalRoles($tablename,$agent_id)
{
	$sql = "select count(distinct role_id) as role_cnt from ".$tablename." WHERE `agent_id`= {$agent_id};";
	$row = GFetchRowOne($sql);
	return $row['role_cnt'];
}

function getRoleMoney($role_id, $acname, $nickname, $dateStartStamp, $dateEndStamp)
{
	$sql = "SELECT round(sum(l.`pay_money`)/100, 2) AS pm, count( l.`id` ) AS c, sum( l.`pay_gold` ) AS pg FROM `db_pay_log_p` as l"
		 . " WHERE `pay_time`>={$dateStartStamp} AND `pay_time`<={$dateEndStamp} " ;
	
	if(!empty($role_id))
	{
		$sql .= " AND l.`role_id`='{$role_id}' ";
	}
	if(!empty($acname))
	{
		$sql .= " AND l.`account_name`='{$acname}' ";
	}
	if(!empty($nickname))
	{
		$sql .= " AND l.`role_name`='{$nickname}' ";
	}
	$result = GFetchRowSet($sql);
	
	return $result;
}

function getExcel($tablename, $where, $search_sort, $arr_lang = array())
{
	if($search_sort != '')
		$search_sort = "ORDER BY " . $search_sort; 
	$sql		= "SELECT * FROM $tablename WHERE $where $search_sort";
	$row_all	= GFetchRowSet($sql);
	
	$excel = array();

	// 标题
	$excel['title'] = $arr_lang['left']['recharge_record'];
	// 表头
	$excel['hd'] =  array(
			$arr_lang['conmon']['user_id'],
			$arr_lang['conmon']['role_name'],
			$arr_lang['conmon']['user_account'],
			$arr_lang['left']['recharge_amount'],
			$arr_lang['left']['recharge_qq_amount'],
			$arr_lang['left']['recharge_ticket_amount'],
			$arr_lang['left']['recharge_ingot'],
			$arr_lang['left']['recharge_time']
			);
	// 列数
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($row_all as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>round($v['pay_money']/100+$v['pay_ticket']/10, 2));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>round($v['pay_money']/100, 2));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>round($v['pay_ticket']/10, 2));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pay_gold']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d G:i:s',$v['pay_time']));
	}
	return $excel;
}



