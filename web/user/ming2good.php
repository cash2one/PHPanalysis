<?php
session_start();
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
@include "../config/game.php";
include SYSDIR_INCLUDE."/global.php";
include "./user_auth.php";

global $smarty;

$accountName = $_SESSION['account_name'];
$tstamp = $_SESSION['timestamp'];
$agentID = $_SESSION['agent_id'];
$serverID = $_SESSION['server_id'];
$ticket = $_SESSION['ticket'];
$fcm = !$_SESSION['fcm'] ? 0 : 1;

if($tstamp <= 0 || (time() - $tstamp) > 3600) {
	header('location:'.OFFICIAL_WEBSITE);   
	exit('Access Denied.');
}

//弹出收藏夹处理
if(isset($_COOKIE['ming2_fav'])) {
  if($_COOKIE['ming2_fav'] >= 2) {
    $favStr = ''; 
  } else {
    $favStr = ' onunload="bookmarkit()"';
    setcookie("ming2_fav",$_COOKIE['ming2_fav']+1, time()+99999999);
  }   
} else {
  $favStr = ' onunload="bookmarkit()"';
  setcookie("ming2_fav",1, time()+99999999);
}

$payAPIUrl = str_replace('{ACCOUNT}', $accountName, $payAPIUrl);
$smarty->assign('payAPIUrl', $payAPIUrl);
$smarty->assign('bbsUrl', $bbsUrl);
$smarty->assign('account', $accountName);
$smarty->assign('tstamp', $tstamp);
$smarty->assign('agentid', $agentID);
$smarty->assign('serverid', $serverID);
$smarty->assign('ticket', $ticket);
$smarty->assign('fcm', $fcm);
$smarty->assign('favStr', $favStr);
$smarty->assign('serverVersion', SERVER_VERSION);
$smarty->assign('clientVersion', CLIENT_VERSION);
$smarty->assign('clientRootUrl', CLIENT_ROOT_URL);
$smarty->assign('fcmApiUrl', FCM_API_URL);
$smarty->assign('loginServer', HOST);
$smarty->assign('chatServer', HOST);
$smarty->assign('portForwardServer', HOST);
$smarty->assign('loginServerPort', '6222');
$smarty->assign('chatServerPort', '4398');
$smarty->assign('portForwardServerPort', '1111');
$smarty->assign('officialWebSite', OFFICIAL_WEBSITE);
$smarty->display("game.html");