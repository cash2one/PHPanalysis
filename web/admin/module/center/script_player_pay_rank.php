<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include "../../../config/config.center.php";
//include SYSDIR_ADMIN.'/include/global.php';


include "/data/mge_test/client/web/config/config.php";
include "/data/mge_test/client/web/config/config.center.php";
include "/data/mge_test/client/web/include/global.php";

echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run player pay rank script";
echo "\n";

$keySign = "FTNN4399payKode";
$now_time = time();
$start_time = strtotime(date('Y-m-d'))-60*60*24*2;

$sql = "SELECT a.account_name, t.role_id,t.role_name, sum( t.pay_money /100 ) AS money,sum(t.pay_gold) as gold_total, t.agent_id, t.server_id,from_unixtime( max( t.`pay_time` ) , '%Y-%m-%d %H:%i:%s' ) AS time
    FROM (SELECT `account_name` , sum( pay_money /100 ) AS mon FROM `all_source_paylog_rmb`  GROUP BY `account_name`)a,`all_source_paylog_rmb` t
    WHERE a.account_name = t.account_name  AND a.mon>500 and role_id>0  GROUP BY t.account_name, t.role_id  order by money desc";

$result = $db->fetchAll($sql);
//print_r($result);
$sql_delete = 'delete from player_pay_ranking ';

$db->fetchAll($sql_delete);
 
 $comma_flag = false;
foreach($result as $value){
//   if($comma_flag)
//       $sql_insert.=',';
   $sql_insert = 'insert into player_pay_ranking(account_name,role_id,role_name,money,gold_total,agent_id,server_id,last_pay_time,last_login_time) values';
    $sql_insert .='("'.$value['account_name'].'",'
                .$value['role_id'].',"'
                .$value['role_name'].'",'
                .$value['money'].','
                .$value['gold_total'].','
                .$value['agent_id'].','
                .$value['server_id'].',"'
                .$value['time'].'","'
                .$value['time'].'")';
//    $comma_flag=true;
    $role_id_array[$value['agent_id']][$value['server_id']][]=$value['role_id'];$db->query($sql_insert);
}




//# $aid:agent_id
//# $sid:server_id

foreach($ALL_SERVER_LIST as $aid => $v) {
    if(!empty($v)) {
        foreach($v as $sid => $vv) {
            if(!empty($vv['url']) && $vv['stat']==1) {
                unset($result);

                if(!empty($role_id_array[$aid][$sid]))
                    $role_id_list = implode(',', $role_id_array[$aid][$sid]);
                else continue;
                
                $sign = md5($start_time . $keySign . $now_time);
                $link = $vv['url']."web/center/player_pay_info.php?starttime={$start_time}&endtime={$now_time}&sign={$sign}&role_id_list={$role_id_list}";
                
                $result = make_request($link, 'POST', 5);
//                echo $link;
                $result = json_decode($result, true);
                if($result != 'sign_error' && !empty($result)) {
                    foreach($result as $value) {
                        if(!empty($value)) {
                            $role_id = $value['role_id'];
                            $level   = $value['level'];
                            $gold    = $value['gold'];
                            $last_login_time = $value['last_login_time'];
                            $sql = "update player_pay_ranking set last_login_time='$last_login_time',level=$level,gold=$gold where agent_id=$aid and server_id=$sid and role_id=$role_id ";
                        }
                        $db->query($sql);
                    }
                }
            }
        }
    }
}


echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running player pay rank script";
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
//#-----------------------------