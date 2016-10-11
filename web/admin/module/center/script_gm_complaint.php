<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include "../../../config/config.center.php";
//include SYSDIR_ADMIN.'/include/global.php';


include "/data/sgclient/web/config/config.php";
include "/data/sgclient/web/config/config.center.php";
include "/data/sgclient/web/include/global.php";

echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run gm_complaint script";
echo "\n";


$keySign = "FTNN4399payKode";

$starttime = strtotime(date('Y-m-d'))-24*60*60;
$endtime = strtotime(date('Y-m-d').' 23:59:59');

# $aid:agent_id
# $sid:server_id
$sign = md5($starttime . $keySign . $endtime);
foreach($ALL_SERVER_LIST as $aid => $v) {
    if(!empty($v)) {
        foreach($v as $sid => $vv) {
            if(!empty($vv['url']) && $vv['stat']==1) {
                $link = $vv['url']."web/center/gm_complaint.php?starttime={$starttime}&endtime={$endtime}&sign={$sign}&action=list";
                $result = make_request($link, 'POST', 5);
                $data = json_decode($result, true);
                if($data != 'sign_error' && !empty($data)) {
                    foreach($data as $value) {
                        $sql = "insert into all_GM_Complaint(`bug_id`,`roleid`,`account_name`,`role_name`,`level`,`time`,`type`,`title`,`content`,`reply`,`state`,`agent_id`,`server_id`)
                             values({$value['id']},{$value['roleid']},'{$value['account_name']}','{$value['role_name']}',{$value['level']},{$value['time']},{$value['type']},'{$value['title']}','{$value['content']}','{$value['reply']}',{$value['state']},{$aid},{$sid})
                                on duplicate key update `state`={$value['state']},`reply`='{$value['reply']}'";
                        $db->query($sql);
                    }
                }
            }
        }
    }
}


echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running gm_complaint  script";
echo "\n";

die();


#-------------------
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
#-----------------------------