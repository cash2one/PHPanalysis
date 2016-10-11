<?php
/**
 * 官职管理
 * @author QingliangCn
 */

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
include SYSDIR_ADMIN.'/include/functions.php';
global $smarty;

$action = trim($_GET['action']);

if ($action == 'set_king') {
	$roleName = trim($_POST['role_name']);
	if ($roleName == '' ) {
		errorExit("角色名不能为空");
	}
	if (validUsername($roleName) !== true) {
		errorExit("角色名格式非法");
	}
	
	$roleName = str_replace("\\'", "'", $roleName); // 还原 '
	$roleName = str_replace("\\\"", "\"", $roleName);  // 还原 "
	$roleName = str_replace("\\\\", "\\", $roleName);  // 还原 \
	$roleName = urlencode($roleName);
	
	$result = getJson($erlangWebAdminHost."event/office/set_king/?role_name={$roleName}");
	if ($result['result'] == 'ok') {
		$msg = "成功设置角色 {$roleName} 为国王";
	} else {
		$msg = "设置失败，请检查角色名称";
	}
	
	succExit($msg, null);
}

//当前状态
$smarty->display("module/event/office.html");

