<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include "../../../config/config.center.php";
//include SYSDIR_ADMIN.'/include/global.php';


include "/data/sgclient/web/config/config.php";
include "/data/sgclient/web/config/config.center.php";
include "/data/sgclient/web/include/global.php";

echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run day_gold script";
echo "\n";


$keySign = "FTNN4399payKode";

$starttime = strtotime(date('Y-m-d'))-24*60*60;
$endtime = strtotime(date('Y-m-d'))-1;


# $aid:agent_id
# $sid:server_id
$sign = md5($starttime . $keySign . $endtime);
foreach($ALL_SERVER_LIST as $aid => $v) {
    if(!empty($v)) {
        foreach($v as $sid => $vv) {
            if(!empty($vv['url']) && $vv['stat']==1) {
                $link = $vv['url']."web/center/day_gold_statistics.php?starttime={$starttime}&endtime={$endtime}&sign={$sign}";
                $result = make_request($link, 'POST', 5);
                $data = json_decode($result, true);
                if($data != 'sign_error' && !empty($data)) {
                    $date=date('Y-m-d',$starttime);
                    $sql_insert = "insert ignore into t_log_day_gold(left_unbind,left_bind,add_unbind,add_bind,used_unbind,used_bind,send_unbind,send_bind,avg_online,agent_id,server_id,dateline) values(
                            {$data['left_unbind']},{$data['left_bind']},{$data['add_unbind']},{$data['add_bind']},
                            {$data['used_unbind']},{$data['used_bind']},{$data['send_unbind']},{$data['send_bind']},
                            {$data['avg_online']},$aid,$sid,$starttime)";
                    $db->query($sql_insert);
                }
            }
        }
    }
}


echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running day_gold  script";
echo "\n";

die();


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