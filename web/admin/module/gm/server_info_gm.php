<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

$action = $_REQUEST['action'];
$server_id = $GAME_SERVER;
$type = $_REQUEST['serverType'];
$stat = $_REQUEST['serverStatus'];
$domain_name = $_REQUEST['domainName'];

$open_time = !empty($_REQUEST['openTime'])?strtotime($_REQUEST['openTime']):0;
$combine_time = !empty($_REQUEST['combineTime'])?strtotime($_REQUEST['combineTime']):0;
$close_time = !empty($_REQUEST['closeTime'])?strtotime($_REQUEST['closeTime']):0;
$desc = trim($_REQUEST['sDesc']);

$keySign = "FTNN4399payKode";
$sign = md5($AGENT_ID.$keySign.$GAME_SERVER);

$center_url = 'http://dtzl2.center.my4399.com/';
$link = $center_url."web/api/server_info.php?agent_id={$AGENT_ID}&server_id={$GAME_SERVER}&sign={$sign}";
if($action == 'save')
    $link .= "&action=save&type={$type}&stat={$stat}&domain_name={$domain_name}&open_time={$open_time}&combine_time={$combine_time}&close_time={$close_time}&desc={$desc}";

$result = make_request($link, 'POST', 5);
$server = json_decode($result, true);

$open_time =  $server['open_time']>0?date('Y-m-d H:i:s',$server['open_time']):'';
$combine_time =  $server['combine_time']>0?date('Y-m-d H:i:s',$server['combine_time']):'';
$close_time =  $server['close_time']>0?date('Y-m-d H:i:s', $server['close_time']):'';

$smarty ->assign('open_time',$open_time);
$smarty ->assign('combine_time',$combine_time);
$smarty ->assign('close_time',$close_time);
$smarty ->assign('info',$server);
$smarty->display('module/gm/server_info_gm.html');


#-------------------
function make_request($url, $method = 'GET', $timeout = 5) {
    $ch = curl_init();
    $header = array(
            'Accept-Language: zh-cn',
           'Connection: Keep-Alive',
            'Cache-Control: no-cache'
    );
    if ($method == 'GET') {
        curl_setopt($ch, CURLOPT_HEADER, 0);
    }
    else {
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
#-----------------------------
