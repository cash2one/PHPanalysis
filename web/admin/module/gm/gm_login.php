<?php
define('IN_DATANG_SYSTEM',true);
include "../../../config/config.php";
include SYSDIR_ADMIN . "/include/global.php";

global $smarty , $API_SECURITY_TICKEY_LOGIN, $GAME_SERVER;

$action = trim ( $_GET ['action'] );
if ($action == 'do') {
	$username = trim($_POST['username']);
    $serverId = trim($_POST['serverId']);
	if ($username == '') {
		errorExit ( "玩家账号不能为空" );
	}
	$time = time();
	$cm = 1;
	$flag = md5($username.$time.$API_SECURITY_TICKEY_LOGIN.$cm);
	//echo $flag;
	header("Location:http://".WEB_SITE."/start.php?username=".urlencode($username)."&time=".$time."&cm=".$cm."&flag=".$flag."&test=true&serverId=".$serverId);
}

$smarty->display ( 'module/gm/gm_login.html' );

