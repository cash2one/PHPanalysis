<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include "../../../config/config.center.php";
//include SYSDIR_ADMIN.'/include/global.php';


include "/data/sgclient/web/config/config.php";
include "/data/sgclient/web/config/config.center.php";
include "/data/sgclient/web/include/global.php";

echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run activity_type script";
echo "\n";

$keySign = "FTNN4399payKode";
$now_time = time();
$start_time = $now_time-60*60*3; //3小时一次

# $aid:agent_id
# $sid:server_id

foreach($ALL_SERVER_LIST as $aid => $v) {
    if(!empty($v)) {
        foreach($v as $sid => $vv) {
            if(!empty($vv['url']) && $vv['stat']==1) {
                $sign = md5($start_time . $keySign . $now_time);
                $link = $vv['url']."web/center/activity_type.php?starttime={$start_time}&endtime={$now_time}&sign={$sign}";
                $result = make_request($link, 'POST', 5);
                $data = json_decode($result, true);
                if($data != 'sign_error' && !empty($data)) {
                    foreach($data as $value) {
                        if(!empty($value)) {
                            $mtime = $value['mtime'];
                            $r_id   = $value['r_id'];
                            $players   = $value['players'];
                            $do_times    = $value['do_times'];
                            $sql = "insert into all_routine_log(mtime,r_id,players,do_times,agent_id,server_id) values($mtime,$r_id,$players,$do_times,$aid,$sid)
                            on duplicate key update players=$players,do_times=$do_times";
                        }
                        $db->query($sql);
                    }
                }
            }
        }
    }
}

echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running activity_type script";
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