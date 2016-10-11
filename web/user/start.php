<?php
ob_start();
session_start();
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';

//屏蔽IP登录

//检查URL是否合法
$accountName = urldecode($_GET['account']);
$timestamp = intval($_GET['tstamp']);
$agentID = intval($_GET['agentid']);
$serverID = intval($_GET['serverid']);
$ticket = trim($_GET['ticket']);
//是否通过防沉迷验证了
$fcmFlag = trim($_GET['fcm']);

$ticketValid = gene_ticket($accountName, $timestamp, $agentID, $serverID, $fcmFlag);
if (strtolower($ticket) == strtolower($ticketValid))
{
	$_SESSION['account_name'] = $accountName;
	$_SESSION['timestamp'] = $timestamp;
	$_SESSION['agent_id'] = $agentID;
	$_SESSION['server_id'] = $serverID;
	$_SESSION['ticket'] = $ticket;
	$_SESSION['fcm'] = $fcmFlag;
	
	// 这里应该记录IP地址，账号登录日志
	
	header('location:./game.php');
}
else 
{
	header('location:'.OFFICIAL_WEBSITE);
	exit('Access Denied.');
}

function gene_ticket($accountName, $timestamp, $agentID, $serverID, $fcmFlag)
{
	global $API_SECURITY_TICKET_LOGIN;
	echo $API_SECURITY_TICKET_LOGIN;
	return md5($API_SECURITY_TICKET_LOGIN.$accountName.$timestamp.$agentID.$serverID.$fcmFlag);
}
