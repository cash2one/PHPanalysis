<?php
define('IN_DATANG_SYSTEM', true);

include "../../../config/config.php";
include "../../../config/config.center.online.php";
include SYSDIR_ADMIN.'/include/api_global.php';


echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run day online script";
echo "\n";

$keySign = "FTNN4399payKode";
$now_time = time();
$start_time = $PLAY_ONLINE_TIME["time"];

# $aid:agent_id
# $sid:server_id
/*echo '<pre>';
print_r($ALL_SERVER_LIST);exit;*/
foreach($ALL_SERVER_LIST as $aid => $v) {
    if(!empty($v)) {

        foreach($v as $sid => $vv) {
            if(!empty($vv['url']) && $vv['stat']==1) {

                unset($online_result,$result);
                $sign = md5($start_time . $keySign . $now_time);
                $link = $vv['url']."web/center/day_online.php?starttime={$start_time}&endtime={$now_time}&sign={$sign}";
                //echo $link;exit;
                $result = make_request($link, 'POST', 5);
                $online_result = json_decode($result, true);
                if($online_result != 'sign_error' && !empty($online_result)) {


                    foreach($online_result['max'] as $value) {
                        if(!empty($value)) {
                            $online = $value['online'];
                            $date   = $value['date'];
                            $hour   = $value['hour'];
                            $min    = $value['min'];
                            $sql = "insert into all_server_online(online,date,hour,min,agent_id,server_id) values($online,'$date',$hour,$min,$aid,$sid) on duplicate key update online=$online";
                        }
                        $db->query($sql);
                    }
                    foreach($online_result['avg'] as $v) {
                        if(!empty($v)) {
                            $online = $v['online'];
                            $date   = $v['date'];
                            $sql = "insert into all_avg_online(online,date,agent_id,server_id) values($online,'$date',$aid,$sid) on duplicate key update online=$online";
                        }
                        $db->query($sql);
                    }
                    foreach($online_result['register'] as $v) {
                        if(!empty($v)) {
                            $account = $v['account'];
                            $date   = $v['date'];
                            $sql = "insert into all_register_db (account,date,agent_id,server_id) values($account,'$date',$aid,$sid) on duplicate key update account=$account";
                        }
                        $db->query($sql);
                    }
                }
            }
        }
    }
}

$PLAY_ONLINE_TIME["time"] = $now_time;
$config_file = fopen('../../../config/config.center.online.php', 'wb');
fwrite($config_file, "<?php\n\$PLAY_ONLINE_TIME = " . var_export($PLAY_ONLINE_TIME, TRUE) . ";\n");
fclose($config_file);
echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running pay log script";
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