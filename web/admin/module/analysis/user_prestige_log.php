<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty;

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

$role_id = trim(SS($_REQUEST['role_id']));
$rolename = trim(SS($_REQUEST['role_name']));
$account_name = trim(SS($_REQUEST['account_name']));

$pageno = getUrlParam('page');

$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$sql = 'select * from t_log_prestige ';
$sqlcondition = "";
$sqlcount = "";

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

	$roleid = GFetchRowSet($sql_role);
	if (empty($roleid))
	{
		errorExit ( "玩家不存在！" );
	}

	$sqlcondition = " WHERE ( role_id = {$roleid[0]['role_id']})";
	$sqlcount = " (role_id = {$roleid[0]['role_id']}) ";

    if( $start>0 && $end > 0 )
	{
		$endtime = $end+86400;
		if( $sqlcondition == "" )
		{
			$sqlcondition .= " WHERE ";
		}
		else
		{
			$sqlcondition .= " AND ";
			$sqlcount .= " AND ";
		}
		$sqlcondition .= " dateline >= ".$start." AND dateline <=".$endtime;
		$sqlcount .= " dateline >= ".$start." AND dateline <=".$endtime;
	}

	$sqlpage = $sql.$sqlcondition." ORDER BY dateline DESC LIMIT ".$startno." , ".$per_page_record;
	$keywordlist = GFetchRowSet($sqlpage);
	$count_result = getRecordCount("t_log_prestige",$sqlcount);
	$pagelist = getPages($pageno, $count_result, $per_page_record );
	$listcount = count($keywordlist);
}






$smarty->assign("end", $end);
$smarty->assign("start", $start);
$smarty->assign("role_id", $roleid[0]['role_id']);
$smarty->assign("role_name", $roleid[0]['role_name']);
$smarty->assign("account_name", $roleid[0]['account_name']);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));
$smarty->display("module/analysis/user_prestige_log.html");


