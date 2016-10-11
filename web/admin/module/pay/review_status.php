<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

define('UNREVIEW', '1');       //未审核
define('SEND_FAIL', '2');       //失败
define('SEND_DENY', '3');       //拒绝
define('SEND_SUCCESS', '4');    //成功

$review_rst = array(
	'0' => $buf_lang['left']['show_all'],
	'1' => $buf_lang['left']['wait_review'],
	'2' => $buf_lang['left']['failure'],
	'3' => $buf_lang['left']['refuse'],
	'4' => $buf_lang['left']['success'],
	);

$apply_admin_name = trim($_REQUEST['apply_admin_name']);
$review_admin_name = trim($_REQUEST['review_admin_name']);


if ( !isset($_REQUEST['dateStart']))
	$dateStart = strftime ("%Y-%m-%d", time() - 86400*7 );
else
	$dateStart  = trim(SS($_REQUEST['dateStart']));
	
if ( !isset($_REQUEST['dateEnd']))
	$dateEnd = strftime ("%Y-%m-%d", time() );
else
	$dateEnd = trim(SS($_REQUEST['dateEnd']));
	
$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

//$op_type = trim(SS($_REQUEST['op_type']));
//if(empty($op_type))$op_type = '0';

$op_id = $_REQUEST['op_id'];
if(empty($op_id))$op_id = '0';

$log = new AdminLogClass();
$data = $log->getReviewLog($dateStartStamp, $dateEndStamp, $apply_admin_name, $review_admin_name, $op_id);

foreach($data as $key => $row)
{
	if($row['status'] == UNREVIEW)
	{
		$data[$key]['status_desc'] = $buf_lang['left']['wait_review'];
	}
	else if ($row['status'] == SEND_SUCCESS)
	{
		$data[$key]['status_desc'] = $buf_lang['left']['success'];
	}
	else if ($row['status'] == SEND_FAIL)
	{
		$data[$key]['status_desc'] = $buf_lang['left']['failure'];
	}
		else if ($row['status'] == SEND_DENY)
	{
		$data[$key]['status_desc'] = $buf_lang['left']['refuse'];
	}

	if ($row['bind'] == '0')
	{
		$data[$key]['bind_cn'] = $buf_lang['new']['no'];
	}
	else if ($row['bind'] == '1')
	{
		$data[$key]['bind_cn'] = $buf_lang['new']['yes'];
	}
}

$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);
$smarty->assign("op_id",$op_id);
$smarty->assign("op_name",$review_rst);
$smarty->assign("keywordlist", $data);
$smarty->assign("apply_admin_name", $apply_admin_name);
$smarty->assign("review_admin_name", $review_admin_name);
$smarty->display('module/pay/review_status.html');


