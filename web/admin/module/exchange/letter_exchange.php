<?php

define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

if(isset($_REQUEST['datestart']))
{
	$start = strtotime(trim(SS($_REQUEST['datestart'])));
}
else
{
	$start = strtotime(strftime("%Y-%m-%d", time()-7*86400));
}

if(isset($_REQUEST['dateend']))
{
	$end = strtotime(trim(SS($_REQUEST['dateend'])));
}
else
{
	$end = strtotime(strftime("%Y-%m-%d"));
}
$end += 86399;

$ex = SS($_REQUEST['excel']);

$role_id = trim(SS($_REQUEST['role_id']));
$rolename = trim(SS($_REQUEST['role_name']));
$account_name = trim(SS($_REQUEST['account_name']));

$pageno = getUrlParam('page');
$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$count_result = -1;

if (!empty($role_id) || !empty($rolename) || !empty($account_name))
{
	$sql_role = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1 ";
	if (!empty($role_id))
	{
		$sql_role .= " AND role_id='{$role_id}'";
	}
	else if (!empty($rolename))
	{
		$sql_role .= " AND role_name='{$rolename}'";
	}
	else if (!empty($account_name))
	{
		$sql_role .= " AND account_name='{$account_name}' AND server_id='{$GAME_SERVER}' AND agent_id='{$AGENT_ID}'";
	}
	
	$role_info = $db->fetchOne($sql_role);
	if (empty($role_info))
	{
		errorExit ( "玩家不存在！" );
	}
		
	$sql_cnt = "SELECT COUNT(*) as sum FROM t_log_item " .
		   " WHERE mtype=4010 AND (role_name = '{$role_info['role_name']}' or src_role_name = '{$role_info['role_name']}')" .
		   " AND mtime>='{$start}' AND mtime<='{$end}'";
	$row= $db->fetchOne($sql_cnt);
	$count_result = $row['sum'];
	$pagelist = getPages($pageno, $count_result, $per_page_record );
	
	$sql = "SELECT * FROM t_log_item " .
		   " WHERE mtype=4010 AND (role_name = '{$role_info['role_name']}' or src_role_name = '{$role_info['role_name']}')" .
		   " AND mtime>='{$start}' AND mtime<='{$end}' ORDER BY id DESC LIMIT {$startno}, {$per_page_record}";
	$keywordlist = $db->fetchAll($sql);

	foreach($keywordlist as $key => $value)
	{
		$keywordlist[$key]['item_num'] = abs($value['item_num']);
		$sql_src = "SELECT role_id, account_name FROM db_role_base_p WHERE role_name='{$value['src_role_name']}' AND agent_id=$AGENT_ID ";
		$src_result = $db->fetchOne($sql_src);
		$keywordlist[$key]['src_role_id'] = $src_result['role_id'];
		$keywordlist[$key]['src_account_name'] = $src_result['account_name'];

		$keywordlist[$key]['account_name'] = $role_info['account_name'];
	}
}


$smarty->assign("end", $end);
$smarty->assign("start", $start);

$smarty->assign("role_id", $role_info['role_id']);
$smarty->assign("role_name", $role_info['role_name']);
$smarty->assign("account_name", $role_info['account_name']);

$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("record_count", $count_result);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));

$smarty->display("module/exchange/letter_exchange.html");
