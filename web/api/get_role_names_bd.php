<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

/* 百度游戏
 * 2.2 实时查询角色
 * 参考文档《百度游戏接入指南 v1.3(网页游戏)》 
 */

#http://mall.com/somepath?api_key=a001&user_id=110&server_id=s1&timestamp=2010-04-22 12:12:12&sign= WEWET8FDDAFAFGFGHDFH 
$api_key = trim($_REQUEST['api_key']);
$user_id = trim($_REQUEST['user_id']);
$server_id = trim($_REQUEST['server_id']);
$timestamp = trim($_REQUEST['timestamp']);
$sign = trim($_REQUEST['sign']);

$para = array();
$para[] = "api_key". $api_key;
$para[] = "user_id". $user_id;
$para[] = "server_id". $server_id;
$para[] = "timestamp". $timestamp;

asort($para);

$bd_sign = build_bd_sign($BD_APP_SECRET, $para);
//echo $bd_sign;die();

if($sign != $bd_sign)  #验证失败，ERROR_-100	传入参数不符合规则
{
	echo "ERROR_-100";
	die();	
}
else
{
	$sql = "SELECT role_name FROM db_role_base_p WHERE account_name={$user_id} AND server_id={$GAME_SERVER} LIMIT 1";
	$result = $db->fetchOne($sql);
	if (empty($result)) #ERROR_-1406	角色不存在无角色
	{
		echo "ERROR_-1406";
		die();
	}
	else
	{
		echo urlencode($result['role_name']);
		die();
	}
//	echo "<br>";
//	print_r($result);die();
}



#-------------------#
function build_bd_sign($app_secret, $para)
{
	asort($para);
	$bd_str = $app_secret;
	foreach ($para as $key => $value)
	{
		$bd_str .= $value;
	}
	return strtoupper(md5($bd_str));
}
