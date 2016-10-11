<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

$sql = "select * from agent_info ";
$result = $db->fetchAll($sql);
//print_r($result);
$smarty->assign('data',$result);
$smarty->display('module/center/link_agent_info.html');