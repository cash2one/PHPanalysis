<?php
define('IN_DATANG_SYSTEM', true);

global $smarty; 
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
$act_type_option = array(
	'0' => $buf_lang['new']['select'],
	'1' => $buf_lang['left']['arena'],
);

if ( !isset($_REQUEST['dateStart'])){
	$start_day = GetTime_Today0() - 7*86400;
	$dateStart = strftime("%Y-%m-%d",$start_day);
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}

if ( !isset($_REQUEST['dateEnd']))
{
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

$act_type = $_REQUEST['act_type'];
$action = trim($_GET['action']);
if ($action == 'search')
{
	if($act_type == '0') 
	{
		errorExit("请选择活动类型！");
	}
	else if($act_type == '1') //竞技场
	{
		$match_sql = "SELECT from_unixtime(mtime,'%Y年%m月%d日') as time, sign_up_cnt, attend_cnt, other " .
				     " FROM `t_log_attendance` " .
				     " WHERE type='{$act_type}' AND mtime>='{$dateStartStamp}' AND mtime<='{$dateEndStamp}' " .
				     " ORDER BY id desc";
		$match_data = GFetchRowSet($match_sql);
		$smarty->assign("match_data", $match_data);
	}
}

$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);
$smarty->assign("act_type_option", $act_type_option);
$smarty->assign("act_type", $act_type);

$smarty->display("module/analysis/activity_attendance.html");
