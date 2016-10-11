<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$year = date('Y');
$month = date('m');
$day = date('d');

$role_id = trim(SS($_REQUEST['role_id']));
$nickname = trim(SS($_REQUEST['nickname']));
$acname  = trim(SS($_REQUEST['acname']));


$page = getUrlParam('pid');

if ($page == 0)
{
	$begin = 0;
} else
{
	$begin = ($page - 1) * LIST_PER_PAGE_RECORDS;
}
if (!empty($role_id) || !empty($nickname) || !empty($acname)){
	if(!empty($role_id)){
		$where .= " AND BASE.role_id='{$role_id}'";
	}
	if (!empty($nickname)){
		$where .= " AND BASE.role_name like '%{$nickname}%'";
	}
	else if (!empty($acname)){
		$where .= " AND BASE.account_name like '%{$acname}%' ";
	}
}
//取出当前在线角色,账号信息

$sql = 'SELECT BASE.role_id,BASE.role_name,ACCOUNT.account_name,ACCOUNT.last_login_time,ACCOUNT.last_login_ip FROM '. T_DB_ACCOUNT_P .' ACCOUNT,'. T_DB_ROLE_EXT_P .' EXT ,'. T_DB_ROLE_BASE_P .' BASE WHERE 1 ' .
		'AND BASE.account_name = ACCOUNT.account_name AND BASE.server_id = ACCOUNT.server_id AND BASE.role_id = EXT.role_id AND EXT.is_online = true'. $where;
		
$result = $db->fetchAll($sql);
$maxOnline = count($result);


//分页显示
$sqlPage = 'SELECT BASE.role_id,BASE.role_name,ACCOUNT.account_name,ACCOUNT.last_login_time,ACCOUNT.last_login_ip FROM '. T_DB_ACCOUNT_P .' ACCOUNT,'. T_DB_ROLE_EXT_P .' EXT ,'. T_DB_ROLE_BASE_P .' BASE WHERE 1 ' .
		'AND BASE.account_name = ACCOUNT.account_name AND BASE.server_id = ACCOUNT.server_id AND BASE.role_id = EXT.role_id AND EXT.is_online = true AND EXT.last_login_time > EXT.last_offline_time AND (unix_timestamp(now()) - ACCOUNT.last_login_time) < 86400 '.$where.'  order by BASE.role_id desc limit ' .$begin.','.LIST_PER_PAGE_RECORDS;

$resultPage = $db->fetchAll($sqlPage);

$pagesHTML = getPages($page, $maxOnline, LIST_PER_PAGE_RECORDS);

$smarty->assign(array('onlines' => $resultPage, 'pageHTML'=>$pagesHTML));
$smarty->assign("page_count", ceil($maxOnline/LIST_PER_PAGE_RECORDS));
$smarty->assign('role_id',$role_id);
$smarty->assign('nickname',$nickname);
$smarty->assign('acname',$acname);
$smarty->display("module/online/now_role_list.html");

