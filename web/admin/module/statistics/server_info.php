<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty;
$action = trim($_GET['action']);

$nodes = getJson ( $erlangWebAdminHost."nodes" );
foreach ( $nodes as $k => $v ) {
	if (strpos ( $v, 'behavior' ) !== false) {
		$type = $buf_lang['new']['behave_log_service'];
	} else if (strpos ( $v, 'chat' ) !== false) {
		$type = $buf_lang['new']['chat_service'];
	} else if (strpos ( $v, 'map' ) !== false || strpos ( $v, 'mgeem' ) !== false) {
		$type = $buf_lang['new']['map_service'];
	} else if (strpos ( $v, 'login' ) !== false) {
		$type = $buf_lang['new']['login_service'];
	} else if (strpos ( $v, 'world' ) !== false) {
		$type = $buf_lang['new']['world_service'];
	} else if (strpos ( $v, 'mgee_line' ) !== false) {
		$type = $buf_lang['new']['sub_line_service'];
	} else if (strpos ( $v, 'db' ) !== false) {
		$type = $buf_lang['new']['data_service'];
	}
	$nodes [$k] = array ('mem' => 0, 'name' => $v, 'type' => $type );
}
$smarty->assign ( array ('nodes' => $nodes ) );
$smarty->display ( "module/statistics/server_info.html" );
if ($action == 'release_server_config_add_start') {
	echo "========================================================";
	
	$result_ban_role = getJson ($erlangWebAdminHost."gm/re_start_server/");
	
	if ($result_ban_role['result']=='ok') {
		echo "等待重启，大概1分钟";
	}
}
if ($action == 'release_server_config') {
	echo "========================================================";
	
	$result_ban_role = getJson ($erlangWebAdminHost."gm/release_server_config/");
	
	if ($result_ban_role['result']=='ok') {
		echo "发布服务端配置文件成功";
	}
}
if ($action == 'release_client_config') {
	echo "========================================================";
	
	$result_ban_role = getJson ($erlangWebAdminHost."gm/release_client_config/");
	
	if ($result_ban_role['result']=='ok') {
		echo "发布客户端配置文件成功";
	}
}

