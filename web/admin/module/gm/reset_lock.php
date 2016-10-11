<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty,$buf_lang;

$action = trim($_GET['action']);

$username = $_SESSION['admin_user_name'];

$role_result = array();

if ($action == 'reset'){
	$reset_role_id = trim (SS($_REQUEST ['reset_role_id']));
	if(!empty($reset_role_id)){
		//生成随即密码
		$key = rand(100000,999999999);
		$md5Key = md5($key);
		$result = getJson ($erlangWebAdminHost."gm/reset_lock/?role_id=".$reset_role_id."&pwd=".$md5Key);
		if($result['result']=='ok'){
			infoExit($buf_lang['conmon']['reset_lock_succ'].$key);
		}else{
			errorExit ("重置密码失败");
		}
	}else{
		errorExit ("重置密码失败:参数错误");
	}	
}
else if ($action == 'search') 
{
	$role_id = trim (SS($_REQUEST ['role_id']));
	$role_name = trim (SS($_REQUEST ['role_name']));
	$account_name = trim (SS($_REQUEST ['account_name']));
	if (!empty($role_id) || !empty($role_name) || !empty($account_name))
	{
		$sql = "SELECT b.role_id, b.role_name, b.account_name, a.last_login_ip".
			" FROM db_role_base_p as b, db_account_p as a" .
			" WHERE b.account_name=a.account_name";
		if (!empty($role_id))
		{
			$sql .= " AND b.role_id='{$role_id}'";
		}
		else if (!empty($role_name))
		{
			$sql .= " AND b.role_name='{$role_name}'";
		}
		else if (!empty($account_name))
		{
			$sql .= " AND b.account_name='{$account_name}'";
		}
		$role_result = $db->fetchOne($sql);
	}
	$smarty->assign("role", $role_result);
	$smarty->display("module/gm/reset_lock.html");
}else{
	$smarty->assign("role", array());
	$smarty->display("module/gm/reset_lock.html");
}