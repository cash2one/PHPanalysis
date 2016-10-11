<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty;

$now_time = time();
$key = "getAllonline4399Test";
$token = md5($date_str . $now_time . $key . $AGENT_ID . $GAME_SERVER);

$cnt = 0;	
if ( isset($_REQUEST['dStartDate']))
{   
    
	$dStartDate = trim(SS($_REQUEST['dStartDate']));
}
else
{
	$dStartDate = strftime ("%Y-%m-%d", time() );
}

foreach($ALL_SERVER_LIST[$AGENT_ID] as $k => $v)
{
	if($v['stat'] == 1)
	{
		$cnt ++;
	}
}

if($cnt != 0)
{
	$url = "http://dtzl2.center.my4399.com/web/api/getAllOnline2.php?date={$dStartDate}&time={$now_time}&agent_id={$AGENT_ID}&game_id={$GAME_SERVER}&cnt={$cnt}&flag={$token}";	
	$result = make_request($url, 'POST', 7);
	$all_json = json_decode($result, true);
	
	//$all_json =$json;
	$all_online_info = $all_json[0];
	
	$all_detail_info = $all_json[1];
	
	
	$id_buf =array();
	foreach($all_online_info as $v)
	{
	   $id_buf[] = $v['now_online_id'];
	}
	
	
	
	$get_now = array();
	foreach($all_detail_info as $v)
	{
		$get_now[$v['id']] =  $v['online'];
	}

	foreach($all_online_info as $k => $v)
	{
        if(isset($get_now[$v['now_online_id']]))
		{
			$all_online_info[$k]['now_online'] = $get_now[$v['now_online_id']];
		}
	}
	
	
	
	
	
	
	
    $buf = array();
	foreach($all_detail_info as $v)
	{
		$hour = ($v['hour'] >= 10) ? $v['hour']: '0'.$v['hour'];
		$min = ($v['min'] >= 10) ? $v['min']: '0'.$v['min'];
		$v['strtime'] = $v['date'].' '.$hour.':'.$min;
		$v['time'] = strtotime($v['strtime']);
		$buf[] = $v;
	}
$flag = false;
foreach($buf as $row)
{

	//$tmp = '[Date.UTC('. strftime("%Y, %m-1, %d, %H, %M, %S", $row['dateline']) . '),' .$row['online'].']';	
	if($row['server_id'])
	{
		$tmp = '';
		$tmp = '[Date.UTC( '. strftime("%Y, %m, %d, %H, %M", $row['time']) . '),' .$row['online'].'],';
		$today_data[$row['server_id']]['data'] .= $tmp;
		$today_data[$row['server_id']]['time'] = $row['date'];
		$today_data[$row['server_id']]['desc'] = $ALL_SERVER_LIST[$row['agent_id']][$row['server_id']]['desc'];
		$flag = true;
	}
	

}
	
	$online_buf = array();
	if(!empty($all_online_info))
	{
		foreach($all_online_info as $k => $v)
		{
			  $v['desc'] = $ALL_SERVER_LIST[$v['agent_id']][$v['server_id']]['desc'];
			  $online_buf[] = $v;
		}
	}

}

#url请求
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
	curl_close($ch);
	return $result;
	}

$x_data = '';
$now_data = '';
$max_data = '';
$mix_data = '';

$flag = false;
foreach($all_online_info as $key=>$row)
{
	if($flag)
	{
		$x_data .= ',';
		$now_data .= ',';
		$max_data .= ',';
		$min_data .= ',';
	}
	$tmp_x = '';
	$tmp_x = "'{$row['desc']}'";
	$x_data .= $tmp_x;
	
	$tmp_now = '';
	$tmp_now = "{$row['now_online']}";
	$now_data .= $tmp_now;
	
	$tmp_max = '';
	$tmp_max = "{$row['max_online']}";
	$max_data .= $tmp_max;
	
	$tmp_min = '';
	$tmp_min = "{$row['min_online']}";
	$min_data .= $tmp_min;
	
	$flag = true;
}



$today_str = strftime("%Y-%m-%d", time());
$yest_str = strftime("%Y-%m-%d", time()-86400);

$smarty->assign("dStartDate", $dStartDate);
$smarty->assign("today_str", $today_str);
$smarty->assign("yest_str", $yest_str);
$smarty->assign("today_data", $today_data);

$smarty->assign("x_data", $x_data);
$smarty->assign("now_data", $now_data);
$smarty->assign("max_data", $max_data);
$smarty->assign("min_data", $min_data);

$smarty->assign("all_online_info", $online_buf);

$smarty->display("module/online/all_online.html");