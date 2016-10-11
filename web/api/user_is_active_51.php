<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

# http://xx.com?areasign=当前区服发货标志&user=当前用户账号
$areasign = trim($_REQUEST['areasign']);
$account = trim($_REQUEST['user']);
if(empty($areasign) || empty($account))
{
	//{"sign":1}
	echo json_encode(array('sign' => 1));
	die();
}

if($areasign == $GAME_SERVER)
{
	$sql = "SELECT b.`role_name`, a.`level` FROM `db_role_base_p` as b, `db_role_attr_p` as a " .
		   "WHERE b.account_name='{$account}' and b.server_id='{$GAME_SERVER}' and a.role_id=b.role_id";
	$result = $db->fetchOne($sql);
	if(empty($result))
	{
		//{"sign":1}
		echo json_encode(array('sign' => 1));
		die();
	}
	else
	{
		//{"sign":2,"data":{"rolekey1":"角色名称1"}}
		echo json_encode( array(
								'sign' => 2,
								'data' => array('rolekey1' => $result['role_name']),
								'level' => array('rolekey1' => $result['level'])
								) );
		die();
	}
}
else
{
	$url = $ALL_SERVER_LIST[$AGENT_ID][$areasign]['url'];
	if(empty($url))
	{
		//{"sign":1}
		echo json_encode(array('sign' => 1));
		die();
	}
	else
	{
		$url_str = $url."web/api/user_is_active_51.php?areasign=".$areasign."&user=".$account;
		echo make_request($url_str, 'GET', 5);
	}	
}


function make_request($url, $method = 'GET', $timeout = 5)
{
	$ch = curl_init();
	$header = array(
		'Accept-Language: zh-cn',
		'Connection: Keep-Alive',
		'Cache-Control: no-cache'
	);
	if ($method == 'GET')
	{
		curl_setopt($ch, CURLOPT_HEADER, 0);
	}
	else
	{
		$i = strpos($url, '?');
		$param_str = substr($url, $i + 1);
		$url = substr($url, 0, $i);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param_str);
	}
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, 'WEB.4399.COM API PHP Servert 0.1 (curl) ' . phpversion());
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	if ($timeout > 0) curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$result = curl_exec($ch);
	//$errno = curl_errno($ch);
	curl_close($ch);
	return $result;
}





