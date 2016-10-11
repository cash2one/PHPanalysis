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

$ITEM_TYPE_NUM = array(
    'send_item' => 5,
    'send_stone' => 6,
    'send_equip' => 7
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

$action = trim($_GET['action']);

$id = $_POST['id'];
$role_id = trim ($_POST ['role_id']);
$role_name = trim ( $_POST ['role_name']);
$item_type = $_POST['item_type'];
$item_id = $_POST['item_id'];
$bind = $_POST['bind'];
$number = $_POST['number'];
$reason = trim ( $_POST ['reason'] );

$reason_log = $reason;

$reason = str_replace("\\'", "'", $reason); // 还原 '
$reason = str_replace("\\\"", "\"", $reason);  // 还原 "
$reason = str_replace("\\\\", "\\", $reason);  // 还原 \
$reason = urlencode($reason);

$role_name_log = $role_name;

$role_name = str_replace("\\'", "'", $role_name); // 还原 '
$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \

if (!empty($id))
{
	$sql = 'SELECT `status` FROM `t_log_review` where `id` = '.$id;
	$rs = $db->FetchAll($sql);
	if ($rs[0]['status'] != UNREVIEW)
	{
		die ( "已审核，请勿重复操作！" );
	}
} 
        
if ($action == 'do1')
{	
	//批量赠送元宝
	$role_id_array = explode(',', $role_id);
	$role_name_array = explode(',', $role_name);
	$role_cnt = count($role_id_array);
	
	for($i=0;$i<$role_cnt;$i++)
	{
		$r_id = $role_id_array[$i];
		$r_name = urlencode($role_name_array[$i]);
		if ($item_type == 'send_gold')
		{
			$result = getJson($erlangWebAdminHost."pay/send_gold/?reason={$reason}&role_id={$r_id}&role_name={$r_name}&number={$number}&type=account&bind={$bind}");
			if ($result['result'] == 'ok') 
			{
				$status = SEND_SUCCESS; 
				$loger1 = new AdminLogClass();   
				$loger1->Log(AdminLogClass::TYPE_REVIEW_AND_SEND_GOLD, '赠送元宝', $number, '', $role_id, $role_name_log);  
			} 
			else 
			{
				$status = SEND_FAIL;          
			}
			$loger = new AdminLogClass();
			$loger->updateReviewLog($id, $status);
		}
		else if ($item_type == 'send_silver')
		{
			$result = getJson($erlangWebAdminHost."pay/send_silver/?reason={$reason}&role_id={$r_id}&role_name={$r_name}&number={$number}&type=account");
			if ($result['result'] == 'ok') {
				$status = SEND_SUCCESS; 
				
				$loger1 = new AdminLogClass();   
				$loger1->Log(AdminLogClass::TYPE_REVIEW_AND_SEND_SILVER, '赠送银两', $number, '', $role_id, $role_name_log);  
			} 
			else 
			{
				$status = SEND_FAIL;   
			}
			$loger = new AdminLogClass();
			$loger->updateReviewLog($id, $status);
		}
		else if ($item_type == 'clear_gold_unbind')
		{
			$result = getJson($erlangWebAdminHost."pay/send_gold/?reason={$reason}&role_id={$r_id}&role_name={$r_name}&number={$CLEAR_WEALTH_NUM}&type=account&bind=0");
			if ($result['result'] == 'ok') 
			{
				$status = SEND_SUCCESS; 
				$loger1 = new AdminLogClass();   
				$loger1->Log(AdminLogClass::TYPE_REVIEW_AND_CLEAR_UNBIND_GOLD, '清零不绑定元宝', '', '', $role_id, $role_name_log);  
			} 
			else 
			{
				$status = SEND_FAIL;   
			}
			$loger = new AdminLogClass();
			$loger->updateReviewLog($id, $status);
		}
		else if ($item_type == 'clear_gold_bind')
		{
			$result = getJson($erlangWebAdminHost."pay/send_gold/?reason={$reason}&role_id={$r_id}&role_name={$r_name}&number={$CLEAR_WEALTH_NUM}&type=account&bind=1");
			if ($result['result'] == 'ok') 
			{
				$status = SEND_SUCCESS; 
				$loger1 = new AdminLogClass();   
				$loger1->Log(AdminLogClass::TYPE_REVIEW_AND_CLEAR_BIND_GOLD, '清零绑定元宝', '', '', $role_id, $role_name_log);  
			} 
			else 
			{
				$status = SEND_FAIL;  
			}
			$loger = new AdminLogClass();
			$loger->updateReviewLog($id, $status);
		}
		else if ($item_type == 'clear_silver')
		{
			$result = getJson($erlangWebAdminHost."pay/send_silver/?reason={$reason}&role_id={$r_id}&role_name={$r_name}&number={$CLEAR_WEALTH_NUM}&type=account");
			if ($result['result'] == 'ok') 
			{
				$status = SEND_SUCCESS; 
				$loger1 = new AdminLogClass();   
				$loger1->Log(AdminLogClass::TYPE_REVIEW_AND_CLEAR_SILVER, '清零银两', '', '', $role_id, $role_name_log);  
			} 
			else 
			{
				$status = SEND_FAIL;  
			}
			$loger = new AdminLogClass();
			$loger->updateReviewLog($id, $status);
		}
		else
		{
			$type = $ITEM_TYPE_NUM[$item_type];
            $url = $erlangWebAdminHost."goods/send_goods/?&role_id={$r_id}&role_name={$r_name}&number={$number}&type={$type}&typeid={$item_id}&bind={$bind}&reason={$reason}";
            $result = getJson($url);

			if ($result ['result'] == 'ok')
			{
				$status = SEND_SUCCESS; 
				$loger1 = new AdminLogClass();   
				$loger1->Log(AdminLogClass::TYPE_REVIEW_AND_SEND_GOODS, $item_id, $number, '', $role_id, $role_name_log);  
			} 
			else 
			{
				$status = SEND_FAIL; 
			}
			$loger = new AdminLogClass();
			$loger->updateReviewLog($id, $status);
		}
	}
}
else if($action == 'do2')
{
	$status = SEND_DENY;
	$loger = new AdminLogClass();
	$loger->updateReviewLog($id, $status);
	if ($item_type == 'gold')
	{
		$loger->Log(AdminLogClass::TYPE_REVIEW_AND_DENY_SEND_GOLD, '拒绝赠送元宝', $number, '', $role_id, $role_name_log);	
	}
	else if ($item_type == 'silver')
	{
		$loger->Log(AdminLogClass::TYPE_REVIEW_AND_DENY_SEND_SILVER, '拒绝赠送银两', $number, '', $role_id, $role_name_log);	
	}
	else
	{
		$loger->Log(AdminLogClass::TYPE_REVIEW_AND_DENY_SEND_GOODS, '拒绝赠送道具', $number, '', $role_id, $role_name_log);
	}
}
else if ($action == 'do3')
{
	//$log = new AdminLogClass();
	//$data = $log->getReviewLog($dateStartStamp, $dateEndStamp, $apply_admin_name, $review_admin_name, $op_id);
}

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
$smarty->display('module/pay/review_all.html');

