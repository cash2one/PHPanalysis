<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include SYSDIR_ROOT_CLIENT.'config/config.key.php';
//include SYSDIR_ADMIN.'/include/global.php';
//global $smarty;

include "/data/mge_center/client/web/config/config.php";
include "/data/mge_center/client/web/include/global.php";

$now_time = time();
$date_str = strftime("%Y-%m-%d",$now_time);
$key_flag = md5('center4399server');
$token = md5($date_str . $now_time . $key_flag);

echo "start exe_run_online.php==".strftime("%Y-%m-%d %H:%M:%S",$now_time);
echo "\n";

$url_list = array();
foreach($ALL_SERVER_LIST as $k => $v)
{
	foreach($v as $kk => $vv)
	{
		if(!empty($vv['url']))
		{
			$url_list[] = $vv['url']."web/api/sh_run_online.php?date={$date_str}&time={$now_time}&flag={$token}";
		}
	}
}
//$url_list[] = "http://s1.dt2.yogame.com.tw/"."web/api/sh_run_online.php?date={$date_str}&time={$now_time}&flag={$token}";
//print_r($url_list);die();

$all_online_info = array();
foreach($url_list as $key=>$value)
{
	// 创建一个cURL资源
	$ch = curl_init();
	
	// 设置URL和相应的选项
	curl_setopt($ch,  CURLOPT_URL, $value);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
	
	$result = curl_exec ($ch);
	curl_close ($ch); 
	
	$tmp_data = json_decode($result, true);
	if (empty($tmp_data))continue;
	$all_online_info[] = $tmp_data;
}
//print_r($all_online_info);

echo "end exe_run_online.php==".strftime("%Y-%m-%d %H:%M:%S",time());
echo "\n";
die();
