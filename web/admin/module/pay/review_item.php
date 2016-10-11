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

$op_id = $_REQUEST['op_id'];
if(empty($op_id))$op_id = '0';

$action = trim($_REQUEST['action']);

$id = trim($_REQUEST['sendID']);
if (!empty($id))
{
	$sql = 'SELECT `status` FROM `t_log_review` where `id` = '.$id;
	$rs = $db->FetchAll($sql);
	if ($rs[0]['status'] != UNREVIEW)
	{
		die ( "已审核，请勿重复操作！" );
	}
}

if(!empty($id))
{
	$send_role_info =  $_REQUEST['send']["{$id}"];
	$role_id = $send_role_info['role_id'];
	$role_name = $send_role_info['role_name'];
	$item_type = $send_role_info['item_type'];
	$item_id = $send_role_info['item_id'];
	$bind = $send_role_info['bind'];
	$number = $send_role_info['number'];
	$reason =$send_role_info['reason'];
	
	$reason_log = $reason;
	
	$reason = str_replace("\\'", "'", $reason); // 还原 '
	$reason = str_replace("\\\"", "\"", $reason);  // 还原 "
	$reason = str_replace("\\\\", "\\", $reason);  // 还原 \
	$reason = urlencode($reason);
	
} 

if ($action == 'doAgreeOne')
{	
	$type = $ITEM_TYPE_NUM[$item_type];
	
	//批量赠送道具
	$role_id_array = explode(',', $role_id);
	$role_name_array = explode(',', $role_name);
	$role_cnt = count($role_id_array);
	
	$success_role_id = '';
	$success_role_name = '';
	$fail_role_id = '';
	$fail_role_name = '';
	
	for($i=0;$i<$role_cnt;$i++)
	{
		$role_name_tmp = $role_name_array[$i];
		
		#角色名空格编码
		$role_name_array[$i] = str_replace("\\'", "'", $role_name_array[$i]); // 还原 '
		$role_name_array[$i] = str_replace("\\\"", "\"", $role_name_array[$i]);  // 还原 "
		$role_name_array[$i] = str_replace("\\\\", "\\", $role_name_array[$i]);  // 还原 \
		$role_name_array[$i] = urlencode($role_name_array[$i]);
		$url = $erlangWebAdminHost."goods/send_goods/?role_id={$role_id_array[$i]}&role_name={$role_name_array[$i]}&number={$number}&type={$type}&typeid={$item_id}&bind={$bind}&reason={$reason}";

		$result = getJson($url);

		if ($result ['result'] == 'ok')
		{
			$success_role_id .= ',';
			$success_role_id .= $role_id_array[$i];
			
			$success_role_name .= ',';
			$success_role_name .= $role_name_tmp;
		} 
		else 
		{
			$fail_role_id .= ',';
			$fail_role_id .= $role_id_array[$i];
			
			$fail_role_name .= ',';
			$fail_role_name .= $role_name_tmp;
		}	
	}
	
	if(!empty($success_role_id) && !empty($success_role_name))
	{
		$status = SEND_SUCCESS; 
		$loger1 = new AdminLogClass();   
		$loger1->Log(AdminLogClass::TYPE_REVIEW_AND_SEND_GOODS, $item_id, $number, '', $success_role_id, $success_role_name);  
	}
	else
	{
		$status = SEND_FAIL;
	}
	$loger = new AdminLogClass();
	$loger->updateReviewLog($id, $status);
	
	if(!empty($fail_role_id) && !empty($fail_role_name))
	{
		errorExit("赠送道具给以下玩家：{$fail_role_name} 发生未知错误!");
	}
}
else if($action == 'doDenyOne')
{
	$status = SEND_DENY;
	$loger = new AdminLogClass();
	$loger->updateReviewLog($id, $status);
	
	$loger->Log(AdminLogClass::TYPE_REVIEW_AND_DENY_SEND_GOODS, '拒绝赠送道具', $number, '', $role_id, $role_name);
}
else if ($action == 'doAgreeMany')
{
	$send_role_list = $_REQUEST['Send_check'];
	$id_reviewed = '';
	foreach ($send_role_list as $key => $value)
	{
		if (!empty($value))
		{
			$sql = 'SELECT `status` FROM `t_log_review` where `id` = '.$value;
			$rs = $db->FetchAll($sql);
			if ($rs[0]['status'] != UNREVIEW)
			{
				$id_reviewed .= ',';
				$id_reviewed .= $value;
			}
		}
	}
	if(!empty($id_reviewed))
	{
		errorExit("ID为 {$id_reviewed}的条目已经审核，请勿重复操作！");
	}
	
	$all_fail_name = '';
	foreach ($send_role_list as $key => $value)
	{
		$send_role_info =  $_REQUEST['send']["{$value}"];
		
		$role_id = $send_role_info['role_id'];
		$role_name = $send_role_info['role_name'];
		$item_type = $send_role_info['item_type'];
		$item_id = $send_role_info['item_id'];
		$bind = $send_role_info['bind'];
		$number = $send_role_info['number'];
		$reason =$send_role_info['reason'];
		
		$reason_log = $reason;
		
		$reason = str_replace("\\'", "'", $reason); // 还原 '
		$reason = str_replace("\\\"", "\"", $reason);  // 还原 "
		$reason = str_replace("\\\\", "\\", $reason);  // 还原 \
		$reason = urlencode($reason);
		
		$type = $ITEM_TYPE_NUM[$item_type];
		//批量赠送道具
		$role_id_array = explode(',', $role_id);
		$role_name_array = explode(',', $role_name);
		$role_cnt = count($role_id_array);
		
		$success_role_id = '';
		$success_role_name = '';
		$fail_role_id = '';
		$fail_role_name = '';
		
		for($i=0;$i<$role_cnt;$i++)
		{
			$role_name_tmp = $role_name_array[$i];
			#角色名空格编码
			$role_name_array[$i] = str_replace("\\'", "'", $role_name_array[$i]); // 还原 '
			$role_name_array[$i] = str_replace("\\\"", "\"", $role_name_array[$i]);  // 还原 "
			$role_name_array[$i] = str_replace("\\\\", "\\", $role_name_array[$i]);  // 还原 \
			$role_name_array[$i] = urlencode($role_name_array[$i]);
			
			$result = getJson($erlangWebAdminHost."goods/send_goods/?role_id={$role_id_array[$i]}&role_name={$role_name_array[$i]}&number={$number}&type={$type}&typeid={$item_id}&bind={$bind}&reason={$reason}");
			if ($result ['result'] == 'ok')
			{
				$success_role_id .= ',';
				$success_role_id .= $role_id_array[$i];
				
				$success_role_name .= ',';
				$success_role_name .= $role_name_tmp;
			} 
			else 
			{
				$fail_role_id .= ',';
				$fail_role_id .= $role_id_array[$i];
				
				$fail_role_name .= ',';
				$fail_role_name .= $role_name_tmp;
			}	
		}
		
		if(!empty($success_role_id) && !empty($success_role_name))
		{
			$status = SEND_SUCCESS; 
			$loger1 = new AdminLogClass();   
			$loger1->Log(AdminLogClass::TYPE_REVIEW_AND_SEND_GOODS, $item_id, $number, '', $success_role_id, $success_role_name);  
		}
		else
		{
			$status = SEND_FAIL;
		}
		$loger = new AdminLogClass();
		$loger->updateReviewLog($value, $status);
		
		if(!empty($fail_role_id) && !empty($fail_role_name))
		{
			$all_fail_name .= ',';
			$all_fail_name .= $fail_role_name;
		}
	}
	if(!empty($all_fail_name))
	{
		errorExit("赠送道具给以下玩家：{$all_fail_name} 时发生未知错误!");
	}
}
else if ($action == 'doDenyMany')
{
	$send_role_list = $_REQUEST['Send_check'];
	$id_reviewed = '';
	foreach ($send_role_list as $key => $value)
	{
		if (!empty($value))
		{
			$sql = 'SELECT `status` FROM `t_log_review` where `id` = ' .$value;
			$rs = $db->FetchAll($sql);
			if ($rs[0]['status'] != UNREVIEW)
			{
				$id_reviewed .= ',';
				$id_reviewed .= $value;
			}
		}
	}
	if(!empty($id_reviewed))
	{
		errorExit("ID为 {$id_reviewed}的条目已经审核，请勿重复操作！");
	}
	
	foreach ($send_role_list as $key => $value)
	{
		$send_role_info =  $_REQUEST['send']["{$value}"];
		
		$role_id = $send_role_info['role_id'];
		$role_name = $send_role_info['role_name'];
		$number = $send_role_info['number'];
		
		$status = SEND_DENY;
		$loger = new AdminLogClass();
		$loger->updateReviewLog($value, $status);
		
		$loger->Log(AdminLogClass::TYPE_REVIEW_AND_DENY_SEND_GOODS, '拒绝赠送道具', $number, '', $role_id, $role_name);
	}
}

$log = new AdminLogClass();
$data = $log->getReviewLog($dateStartStamp, $dateEndStamp, $apply_admin_name, $review_admin_name, $op_id, 'item', '');

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


//分页开始 2012-2-2   数组分页
$whichpage = $_REQUEST['whichpage'];

if(!$whichpage) {
    $notepage=1;
}
else {
    $notepage=$whichpage;
}
$pagesize=10;
$noterecs=($notepage-1)*$pagesize; 
$page_num = count($data);  

$pagecount=ceil($page_num/$pagesize);  

$buf_num = 0;
if( $pagecount == 1)
{
	foreach($data as $v)
	{
			$new_data[] = $v;
	}
}
else
{
	
	foreach($data as $v)
	{   
		$buf_num++;
		if(($buf_num > $noterecs) && ( $buf_num <= ($noterecs+$pagesize)))
		{ 
			$new_data[] = $v;
		}
	}
}

$noterecs=$noterecs+1;
$fisrt=1;
$prev=$whichpage-1;
$next=$whichpage+1;
$last=$pagecount;
if($page_num > 0)
{
	$start = "<a href='review_item.php?whichpage=".$fisrt."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&apply_admin_name=".$apply_admin_name."&review_admin_name=".$review_admin_name."'>首页</a></font>&nbsp;&nbsp";
if($whichpage>1) {
    $start.= "<a href='review_item.php?whichpage=".$prev."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&apply_admin_name=".$apply_admin_name."&review_admin_name=".$review_admin_name."'>上一页</a> ";
}
for($counter=1;$counter<=$pagecount;$counter++) {
    $start.= ("<font size=+1 color=red><a href='review_item.php?whichpage=".$counter."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&apply_admin_name=".$apply_admin_name."&review_admin_name=".$review_admin_name."'>".$pad.$counter."</a></font>&nbsp;&nbsp;");
}
if($whichpage < $pagecount) {
    $start.= "<a href='review_item.php?whichpage=".$next."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&apply_admin_name=".$apply_admin_name."&review_admin_name=".$review_admin_name."'>下一页</a> ";
}
$start.= "<a href='review_item.php?whichpage=".$pagecount."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&apply_admin_name=".$apply_admin_name."&review_admin_name=".$review_admin_name."'>尾页</a> ";
$start.= "总页数（".$pagecount."）";
$start.= "共".$rsnum."条记录";
}




$smarty->assign('whichpage',$whichpage);
$smarty->assign("page",$start);
$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);
$smarty->assign("op_id",$op_id);
$smarty->assign("op_name",$review_rst);
$smarty->assign("keywordlist", $new_data);
$smarty->assign("apply_admin_name", $apply_admin_name);
$smarty->assign("review_admin_name", $review_admin_name);
$smarty->display('module/pay/review_item.html');
