<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include "../../../config/config.center.php";
//include SYSDIR_ADMIN.'/include/global.php';


include "/data/sgclient/web/config/config.php";
include "/data/sgclient/web/config/config.center.php";
include "/data/sgclient/web/include/global.php";

echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run day broadcast_list script";
echo "\n";
$action = 'list';
$id = 0;
$keySign = "dt2BroadcastKode";

$sign = md5($action.$id.$keySign);
# $aid:agent_id
# $sid:server_id

$sql_delete = 'delete from all_log_broadcast where 1';
$db->query($sql_delete);

foreach($ALL_SERVER_LIST as $aid => $v) {
    if(!empty($v)) {
        foreach($v as $sid => $vv) {
            if(!empty($vv['url']) && $vv['stat']==1) {
                $url = $vv['url'];
                $link = $url."web/center/broadcast_message.php?action={$action}&id=$id&sign={$sign}";
                $result = make_request($link, 'POST', 5);
                $data = json_decode($result, true);
                if($data != 'sign_error' && !empty($data)) {
                    foreach($data as $value) {
                        $mid = $value['id'];
                        $foreign_id = $value['foreign_id'];
                        $type = $value['type'];
                        $send_strategy = $value['send_strategy'];
                        $start_date = $value['start_date'];
                        $end_date = $value['end_date'];
                        $start_time = $value['start_time'];
                        $end_time = $value['start_date'];
                        $interval = $value['interval'];
                        $con_rev = addslashes(base64_decode($value['content']));
                        $sql_insert = "insert into all_log_broadcast(mid,foreign_id,type,send_strategy,start_date,end_date,start_time,end_time,`interval`,`content`,agent_id,server_id)
                                values($mid,$foreign_id,$type,$send_strategy,'$start_date','$end_date','$start_time','$end_time',$interval,'$con_rev',$aid,$sid)
                                on duplicate key update foreign_id=$foreign_id,type=$type,send_strategy=$send_strategy,start_date='$start_date',
                                end_date='$end_date',start_time='$start_time',end_time='$end_time',`interval`=$interval,content='$con_rev'";
                        $db->query($sql_insert);
                    }
                }

            }
        }
    }
}


echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running broadcast_list  script";
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