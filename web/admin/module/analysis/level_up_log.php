<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$role_id = trim (SS($_REQUEST ['role_id']));
$role_name = trim (SS($_REQUEST ['role_name']));
$account_name = trim (SS($_REQUEST ['account_name']));
$type = trim(SS($_REQUEST['type']));

$action = trim($_GET['action']);
if ($action == 'search') 
{
	if ($role_id == '' && $role_name == '' && $account_name == '') 
	{
		errorExit ( "角色id，角色名和账号不能同时为空" );
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
		$sql .= " AND account_name='{$account_name}' AND agent_id='{$AGENT_ID}'";
	}
	$role_result = $db->fetchAll($sql);
	if (empty($role_result))
	{
		errorExit ( "玩家不存在！" );
	}
	if($type == "continue"){
		$level_sql = "SELECT * FROM `t_log_levelup` WHERE role_id='{$role_id}' ORDER BY id DESC LIMIT 0, 100";
		$level_data = GFetchRowSet($level_sql);
		$smarty->assign("level_data", $level_data);
	}
	
}
//列出升级有问题的玩家 升级就是一次升一级,写的时候是不是意味着角色每升一级就写一次数据库
$wrong_sql = "SELECT * FROM `t_log_levelup` WHERE (new_level-old_level)>1 ORDER BY role_id ASC, id DESC LIMIT 0, 100";
$wrong_level = GFetchRowSet($wrong_sql);


$smarty->assign("role", $role_result);
$smarty->assign("wrong_level", $wrong_level);
$smarty->display("module/analysis/level_up_log.html");
