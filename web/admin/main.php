<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty;

$json = getJson($erlangWebAdminHost. "server");
$smarty->assign('erlang_version', $json['erlang_version']);
$smarty->display("main.html");