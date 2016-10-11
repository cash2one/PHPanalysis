<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include SYSDIR_ROOT_CLIENT.'config/config.key.php';
//include SYSDIR_ADMIN.'/include/global.php';
//global $smarty;

include "/data/mge_center/client/web/config/config.php";
include "/data/mge_center/client/web/include/global.php";

//include "/data/mge/client/web/config/config.php";
//include "/data/mge/client/web/include/global.php";

$now_time = time();
$date_str = strftime("%Y-%m-%d",$now_time);
$key_flag = md5('center4399server');
$token = md5($date_str . $now_time . $key_flag);

echo "start exe_run_get_pay_day.php==".strftime("%Y-%m-%d %H:%M:%S",$now_time);
echo "\n";

$url_list = array();
foreach($ALL_SERVER_LIST as $k => $v)
{
	foreach($v as $kk => $vv)
	{
		if(!empty($vv['url']))
		{
			$url_list[] = $vv['url']."web/api/sh_run_get_pay_day.php?date={$date_str}&time={$now_time}&flag={$token}";
		}
	}
}
//$url_list[] = "http://dtz7c.my4399.com/"."web/api/sh_run_get_pay_day.php?date={$date_str}&time={$now_time}&flag={$token}";

//print_r($url_list);//die();

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

if(!empty($all_online_info))
{
	$sql = 'REPLACE INTO `'.$dbConfig['dbname'].'`.`t_log_pay_day_all` (`id`, `pay_day`, `role_cnt`, `times_cnt`, `arpu`, ' .
	   '`year`, `month`, `day`, `agent_id`, `game_server_id`) VALUES ';
	$comma_flag = false;
	foreach($all_online_info as $kkk => $vvv)
	{
		if($comma_flag)
		{
			$sql .= ', ';
		}
		$sql .= '(\'' .
			$vvv['id'] .
			'\', \'' .
			$vvv['pay_day'] .
			'\', \'' .
			$vvv['role_cnt'] .
			'\', \'' .
			$vvv['times_cnt'] .
			'\', \'' .
			$vvv['arpu'] .
			'\', \'' .
			$vvv['year'] .
			'\', \'' .
			$vvv['month'] .
			'\', \'' .
			$vvv['day'] .
			'\', \'' .
			$vvv['agent_id'] .
			'\', \'' .
			$vvv['game_server_id'] .
			'\')';
		$comma_flag = true;	
	}
	$sql .= ';';
	$db->query($sql);
}	   

echo "end exe_run_get_pay_day.php==".strftime("%Y-%m-%d %H:%M:%S",time());
echo "\n";
die();
