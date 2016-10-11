<?php
define('IN_DATANG_SYSTEM', true);
include "../../config/config.php"; 
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include SYSDIR_ADMIN.'/include/erlang_config_loader.php';  

global $db ,$GAME_SERVER;

$date = date("Y-m-d",strtotime(date("Y-m-d"))-86400);

$dateStartStamp = strtotime($date . ' 0:0:0');
$dateEndStamp   = strtotime($date . ' 23:59:59');

$sum_common = array(
    '1' => array('name' => '装备锻造', 'url' => 'web/center/sum_enhance/t_log_forge.php'),
	'2' =>  array('name' => '装备打孔', 'url' => 'web/center/sum_enhance/t_log_punch.php'),
	'3' =>  array('name' => '宝石镶嵌', 'url' => 'web/center/sum_enhance/t_log_inlay.php'),
	'4' =>	 array('name' => '灵石合成', 'url' => 'web/center/sum_enhance/t_log_comp_stone.php'),
	'5'	=>	 array('name' => '装备刻印', 'url' => 'web/center/sum_enhance/t_log_carve.php'),
	'6'	=>	 array('name' => '装备升级', 'url' => 'web/center/sum_enhance/t_log_eq_up.php'),
	'7' =>	 array('name' => '正常拆卸宝石', 'url' => 'web/center/sum_enhance/t_log_unload_stone.php'),
	1043=>  array('name' => '装备洗练', 'url' => 'web/center/sum_enhance/t_log_unload_wash.php'),
	1046=>  array('name' => '装备回炉', 'url' => 'web/center/sum_enhance/do_log_recycle.php'),
);

$keySign = "FTNN4399payKode";
$date_str = date("Y-m-d",time()-86400);
$date_int = str_replace('-','',$date_str);

foreach($ALL_SERVER_LIST as $k => $v)
{
	
	if(!empty($v))
	{		
		foreach($v as $kk => $vv)
		{
			if(!empty($vv['url']) && $vv['stat']==1)
			{
				foreach($sum_common as $kkk => $vvv )
				{
					$sign = md5($keySign . $date_int);
					$link[$kkk] = $vv['url'].$vvv['url']."?time={$date_int}&sign={$sign}&date_str={$date_str}";
					$result[$kkk] = make_request($link[$kkk], 'POST', 5);
					$log[$kkk] = json_decode($result[$kkk], true);
				}
			}
		}
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
  
?>
