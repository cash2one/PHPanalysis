<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

try
{
	//login_error.php?game=dtzl2&server=S1000&qid=for444&time=1321067014&error_step=1&error_id=2
	$server_name = trim($_REQUEST['server']);
	$account_name = trim($_REQUEST['qid']);
	$time = trim($_REQUEST['time']);
	$error_step = trim($_REQUEST['error_step']);
	$error_id = trim($_REQUEST['error_id']);
	$error_msg = trim($_REQUEST['error_msg']);
	
	
	$sql = 'INSERT INTO `'.$dbConfig['dbname'].'`.`t_log_login_error` (`id`, `account_name`, `datetime`, `server_name`, `error_step`, `error_id`, `error_msg`) VALUES ' .
		'(NULL, \'' .
		$account_name .
		'\', \'' .
		$time .
		'\', \'' .
		$server_name .
		'\', \'' .
		$error_step .
		'\', \'' .
		$error_id .
		'\', \'' .
		$error_msg .
		'\');'; 
	
	//2013-9-27ÆÁ±Î´íÎóÈÕÖ¾
	//$db->query($sql);
}
catch(Exception $e)
{
}

echo 1;
die();