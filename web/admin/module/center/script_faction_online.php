<?php
define('IN_DATANG_SYSTEM', true);
/*include "../../../config/config.php";
include "../../../config/config.center.php";
include SYSDIR_ADMIN.'/include/global.php';*/


include "/data/sgclient/web/config/config.php";
include "/data/sgclient/web/config/config.center.php";
include "/data/sgclient/web/include/global.php";

echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run pay log script";
echo "\n";

$keySign = "FTNN4399payKode";
$now_time_buf =  strftime("%Y-%m-%d %H",time()).':00';
$now_time = strtotime($now_time_buf);

# $k:agent_id
# $kk:server_id
foreach($ALL_SERVER_LIST as $k => $v)
{
	if(!empty($v))
	{
		foreach($v as $kk => $vv)
		{
			if(!empty($vv['url']) && $vv['stat']==1)
			{
				$id = $PAY_LOG_ID[$k][$kk];
				if(!isset($PAY_LOG_ID[$k][$kk]) || !is_numeric($id))
				{
					continue;
				}
				$sign = md5($keySign . $now_time);
				$link = $vv['url']."web/center/faction_online.php?time={$now_time}&sign={$sign}";
				sleep(1);
				$pay_result = make_request($link, 'POST', 5);
				$pay_log = json_decode($pay_result, true);
			}
		}
	}
}



echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running pay log script";
echo "\n";

die();

#-------------------
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
#-----------------------------