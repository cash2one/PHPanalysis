<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$role_id = trim (SS($_REQUEST ['role_id']));
$role_name = trim (SS($_REQUEST ['role_name']));
$account_name = trim (SS($_REQUEST ['account_name']));

$role_name_list = trim($_REQUEST['role_name_list']);

$action = trim($_GET['action']);
if ($action == 'search') 
{
	if ($role_id == '' && $role_name == '' && $account_name == '') 
	{
		errorExit ( "角色id，角色名和账号不能同时为空" );
	}
	
	$sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1 ";
	if (!empty($role_id))
	{
		$sql .= " AND role_id='{$role_id}'";
	}
	else if (!empty($role_name))
	{
		$sql .= " AND BINARY role_name='{$role_name}'";
	}
	else if (!empty($account_name))
	{
		$sql .= " AND account_name='{$account_name}' AND agent_id='{$AGENT_ID}'";
	}
	$role_result = $db->fetchAll($sql);
	if (empty($role_result))
	{
		errorExit ( "玩家不存在！" );
	}

}
else if ($action == 'send_silver')
{
//	if ($role_id == '' || $role_name == '' || $account_name == '') 
//	{
//		errorExit ( "请先搜索确认玩家是否存在！" );
//	}
//		
//	$sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1";
//	if (!empty($role_id))
//	{
//		$sql .= " AND role_id='{$role_id}'";
//	}
//	else if (!empty($role_name))
//	{
//		$sql .= " AND role_name='{$role_name}'";
//	}
//	else if (!empty($account_name))
//	{
//		$sql .= " AND account_name='{$account_name}' AND server_id='{$GAME_SERVER}'";
//	}
//	$role_result = $db->fetchOne($sql);
//	if (empty($role_result))
//	{
//		errorExit ( "玩家不存在！" );
//	}

	if(empty($role_name_list))
	{
		errorExit ( "请输入至少一个玩家角色名" );
	}
	
	$role_name_array = explode(',', $role_name_list);
	$role_id_array = array();
	$no_role_list = '';
	$role_id_list = '';
	$space_flag = false;
	foreach($role_name_array as $key=>$value)
	{
		$one_sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE BINARY role_name='{$value}' ";
		$one_role_result = $db->fetchOne($one_sql);
		if(empty($one_role_result))
		{
			$no_role_list .= ' ';
			$no_role_list .= $value;
		}
		else
		{
			$role_id_array[$key] = $one_role_result['role_id'];
			if($space_flag) $role_id_list .= ',';
			$role_id_list .= $one_role_result['role_id'];
			$space_flag = true;
		}
	}
		
	if(!empty($no_role_list))
	{
		errorExit("角色名为：{$no_role_list} 的玩家不存在！");
	}
	
	$reason = trim ( $_POST ['reason'] );
	if (mb_strlen ( $reason ) < 5) {
		errorExit ( "赠送原因长度必须大于等于5" );
	}
	$number = intval ( $_POST ['number'] );
	if ($number > 1000000) {
		errorExit ( "赠送银两数量超过100万，赠送失败" );
	}
	if ($number <= 0)
	{
		errorExit( "赠送银两必须大于0");
	}
	
	$loger = new AdminLogClass();
	$loger->Log( AdminLogClass::TYPE_SEND_SILVER,'', $number,'', $role_id_list, $role_name_list);
	$loger->ReviewLog(AdminLogClass::TYPE_SEND_SILVER, '', $number, '', $role_id_list, $role_name_list, 'send_silver', '0', '', '0', $reason);
	infoExit("已提交赠送银两请求，请耐心等待审核！", "send_silver.php");
}

$role_name_list = trim($role_name_list);

$smarty->assign("role", $role_result);
$smarty->assign("role_name_list", $role_name_list);
$smarty->assign("list", $role_result);
$smarty->display('module/pay/send_silver.html');
