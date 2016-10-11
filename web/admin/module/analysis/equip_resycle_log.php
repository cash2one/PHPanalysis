<?php 
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

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

$role_id = trim(SS($_REQUEST['role_id']));
$nickname = trim(SS($_REQUEST['nickname']));
$acname  = trim(SS($_REQUEST['acname']));

$search_sort_1 = SS($_REQUEST['sort_1']);
$search_sort_2 = SS($_REQUEST['sort_2']);
if (empty($search_sort_1))		$search_sort_1 = "id desc";	
if (empty($search_sort_2))		$search_sort_2 = "equip_id desc";

//$ex = SS($_REQUEST['excel']);
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
	if ($userid > 0)
	{
		$pageno = getUrlParam('page');
		$search_sort .= $search_sort_1 . ", ". $search_sort_2;
		$where = " `role_id` = ".$userid." AND mtime>={$dateStartStamp} AND mtime<={$dateEndStamp} ";
		$tablename = "t_log_resycle";

		$count_result	= 0;
		$keywordlist	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);
//		$excel		= getExcel($tablename, $where, $search_sort, $typename,$AGENT_ID);
		$pagelist	= getPages($pageno, $count_result);
		for($i=0;$i<count($keywordlist);$i++)
		{
			$keywordlist[$i]['mtype_name'] = $typename[$keywordlist[$i]['mtype']];
			$keywordlist[$i]['role_name'] = $role_result['role_name'];
			$keywordlist[$i]['account_name'] = $role_result['account_name'];	
		}
	}
}

//排序的
$sortlistopgion  = getSortTypeListOption();
$smarty->assign("time_start", $dateStartStr);
$smarty->assign("time_end", $dateEndStr);
$smarty->assign("search_sort_1", $search_sort_1);
$smarty->assign("search_sort_2", $search_sort_2);
$smarty->assign("search_keyword1", $role_result['account_name']);
$smarty->assign("search_keyword2", $role_result['role_name']);
$smarty->assign("role_id", $role_result['role_id']);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));
$smarty->assign('sortoption', $sortlistopgion);
$smarty->display("module/analysis/equip_resycle_log.html");


function getSortTypeListOption()
{
	global $buf_lang;
	return array(
			"id asc"  => $buf_lang['new']['id_asc'],
			"id desc" => $buf_lang['new']['id_desc'],	
			"equip_id asc"  => $buf_lang['new']['equip_id_asc'],
			"equip_id desc" => $buf_lang['new']['equip_id_desc'],	
			"current_colour asc"  => $buf_lang['new']['current_colour_asc'],
			"current_colour desc" => $buf_lang['new']['current_colour_desc'],		
			"reinforce_result asc"  => $buf_lang['new']['reinforce_result_asc'],
			"reinforce_result desc" => $buf_lang['new']['reinforce_result_desc'],
			"punch_num asc"  => $buf_lang['new']['punch_num_asc'],
			"punch_num desc" => $buf_lang['new']['punch_num_desc'],	
			);
}


