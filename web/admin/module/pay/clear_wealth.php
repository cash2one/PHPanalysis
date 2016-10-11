<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$role_id = trim (SS($_REQUEST ['role_id']));
$role_name = trim (SS($_REQUEST ['role_name']));
$account_name = trim (SS($_REQUEST ['account_name']));

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
		$sql .= " AND role_name='{$role_name}'";
	}
	else if (!empty($account_name))
	{
		$sql .= " AND account_name='{$account_name}' AND server_id='{$GAME_SERVER}'  AND agent_id='{$AGENT_ID}'";
	}
	$role_result = $db->fetchOne($sql);
	if (empty($role_result))
	{
		errorExit ( "玩家不存在！" );
	}
}
else if ($action == 'clear')
{
	if ($role_id == '' || $role_name == '' || $account_name == '') 
	{
		errorExit ( "请先搜索确认玩家是否存在！" );
	}
	
	$sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1  ";
	if (!empty($role_id))
	{
		$sql .= " AND role_id='{$role_id}'";
	}
	else if (!empty($role_name))
	{
		$sql .= " AND role_name='{$role_name}'";
	}
	else if (!empty($account_name))
	{
		$sql .= " AND account_name='{$account_name}' AND server_id='{$GAME_SERVER}'  AND agent_id='{$AGENT_ID}'";
	}
	$role_result = $db->fetchOne($sql);
	if (empty($role_result))
	{
		errorExit ( "玩家不存在！" );
	}
	
	$reason = trim ( $_POST ['reason'] );
	if (mb_strlen ( $reason ) < 5) {
		errorExit ( "清零原因长度必须大于等于5" );
	}
	
	$clear_type_1 = SS($_REQUEST['clear_1']);
	if ($clear_type_1 == 'clear_null')
	{
		errorExit("请选择要清零的类型");
	}
	if ($clear_type_1 == 'clear_gold_unbind')
	{
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_CLEAR_UNBIND_GOLD,'', '','', $role_id, $role_name);
		$loger->ReviewLog(AdminLogClass::TYPE_CLEAR_UNBIND_GOLD, '', '', '', $role_id, $role_name, $clear_type_1, '0', '', '0', $reason);
		infoExit("已提交清除元宝请求，请耐心等待审核！", "clear_wealth.php");
	}
	else if ($clear_type_1 == 'clear_gold_bind')
	{
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_CLEAR_BIND_GOLD,'', '','', $role_id, $role_name);
		$loger->ReviewLog(AdminLogClass::TYPE_CLEAR_BIND_GOLD, '', '', '', $role_id, $role_name, $clear_type_1, '0', '', '1', $reason);
		infoExit("已提交清除礼金请求，请耐心等待审核！", "clear_wealth.php");
	}
	else if ($clear_type_1 == 'clear_silver')
	{
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_CLEAR_SILVER,'', '','', $role_id, $role_name);
		$loger->ReviewLog(AdminLogClass::TYPE_CLEAR_SILVER, '', '', '', $role_id, $role_name, $clear_type_1, '0', '', '0', $reason);
		infoExit("已提交清除银两请求，请耐心等待审核！", "clear_wealth.php");
	}
}
$smarty->assign("role", $role_result);
$clear_type  = getClearType();
$smarty->assign('clear_type', $clear_type);
$smarty->display('module/pay/clear_wealth.html');

function getClearType()
{
	global $buf_lang;
	return array(
		"clear_null" => $buf_lang['new']['please_select'],
		"clear_gold_unbind" => $buf_lang['new']['unbind_gold'],
		"clear_gold_bind"  => $buf_lang['new']['bind_gold'],
		"clear_silver" => $buf_lang['new']['unbind_silver'],
	);
}
