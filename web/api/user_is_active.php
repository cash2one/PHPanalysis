<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$account = trim($_REQUEST['qid']);
$sql = "SELECT `role_name` FROM `db_role_base_p` WHERE account_name='{$account}' and server_id='{$GAME_SERVER}'";
$result = $db->fetchOne($sql);
if(empty($result))
{
	echo(0);
	die();
}
else
{
	echo (1);
	die();
}