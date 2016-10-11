<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty;

$action = trim($_GET['action']);

if ($action == 'begin_now') {
	//立刻开始
	getJson($erlangWebAdminHost."event/warofking/begin_now");
} else if ($action == 'end_now') {
	//立刻结束
	getJson($erlangWebAdminHost."event/warofking/end_now");
} else if ($action == 'reset') {
	//设置为默认值
	getNothing($erlangWebAdminHost."event/warofking/reset");
} else if ($action == 'begin_after_60s') {
	getNothing($erlangWebAdminHost."event/warofking/begin_after_60s");
}

//当前状态
$result = getJson($erlangWebAdminHost."event/warofking/get_info");
$smarty->assign('nextBeginTime', date('Y-m-d H:i:s', $result['begin_time']));
$smarty->assign('nextEndTime', date('Y-m-d H:i:s', $result['end_time']));
$smarty->display("module/event/warofking.html");


