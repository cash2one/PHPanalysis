<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty;


$action = trim($_GET['action']);
if ($action == 'do') {
	$role_name = trim ( $_POST ['role_name']);
	
	$role_name_log = $role_name;
	$role_name = str_replace("\\'", "'", $role_name); // 还原 '
	$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
	$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \
	$role_name = urlencode($role_name);
	
	if ($role_id == '' && $role_name == '') {
		errorExit ( "角色名不能为空" );
	}
	$type = trim($_GET['type']);
	if ($type == 'init_props')
	{
		$result = getJson ( $erlangWebAdminHost."gm/init_props/?role_name={$role_name}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_INIT_PROPS,'', '','', '', $role_name_log);
			infoExit("初始化玩家属性成功");
		} else {
			infoExit("初始化玩家属性失败");
		}
	}
	else if ($type == 'change_body')
	{	
		$result = getJson ( $erlangWebAdminHost."gm/change_body/?role_name={$role_name}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_CHANGE_BODY,'', '','', '', $role_name_log);
			infoExit("清除变身状态成功");
		} else {
			infoExit("清除变身状态失败");
		}
	}
	else if ($type == 'init_mission')
	{
		$result = getJson ( $erlangWebAdminHost."gm/init_mission/?role_name={$role_name}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_INIT_MISSION,'', '','', '', $role_name_log);
			infoExit("初始化玩家任务成功");
		} else {
			infoExit("初始化玩家任务失败");
		}
	}
}

$smarty->display("module/gm/gm_exception.html");

