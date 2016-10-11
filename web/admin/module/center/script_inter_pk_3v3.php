<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include "../../../config/config.center.php";
//include SYSDIR_ADMIN.'/include/global.php';


include "/data/sgclient/web/config/config.php";
include "/data/sgclient/web/config/config.center.php";
include "/data/sgclient/web/include/global.php";

echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run day inter_pk script";
echo "\n";

$keySign = "FTNN4399payKode";
$now_time = time();
$dateline = strtotime(date('Y-m-d'))+8*60*60;

# $aid:agent_id
# $sid:server_id
$sign = md5($now_time . $keySign . $dateline);
foreach($ALL_SERVER_LIST as $aid => $v) {
    if(!empty($v)) {
        foreach($v as $sid => $vv) {
            if(!empty($vv['url']) && $vv['stat']==1) {
                $link = $vv['url']."web/center/inter_pk.php?nowtime={$now_time}&dateline={$dateline}&sign={$sign}";
                $result = make_request($link, 'POST', 5);
                $data = json_decode($result, true);
               
                if($data != 'sign_error' && !empty($data)) {
                    $all_players = $data['all_players'];
                    if(!$all_players) continue;
                    $accept_players = $data['accept_players'];
                    $accept_teams = $data['accept_teams'];
                    $login_players = $data['login_players'];
                    $login_teams = $data['login_teams'];
                    $date = date('Y-m-d');
                    $sql = "insert into all_inter_pk_3v3(all_players,accept_players,accept_teams,login_players,login_teams,date,agent_id,server_id)
                        values($all_players,$accept_players,$accept_teams,$login_players,$login_teams,'$date',$aid,$sid)
                    ON DUPLICATE KEY UPDATE all_players=$all_players,accept_players=$accept_players,accept_teams=$accept_teams,login_players=$login_players,login_teams=$login_teams";
                    $db->query($sql);
                }

            }
        }
    }
}


echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running inter_pk  script";
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