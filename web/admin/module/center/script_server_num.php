<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include "../../../config/config.center.php";
//include SYSDIR_ADMIN.'/include/global.php';



include "/data/sgclient/web/config/config.php";
include "/data/sgclient/web/config/config.center.php";
include "/data/sgclient/web/include/global.php";

global $db;

echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run day online script";
echo "\n";


foreach ($ALL_SERVER_LIST as $aid =>$value) {
    if($aid==0) continue;
    foreach($value as $sid=>$v) {
        $stat = $v['stat'];
        if($stat==1||$stat==2) {
            $sql_update = "update all_server_info set stat={$stat} where agent_id={$aid} and server_id={$sid}";
            $db->query($sql_update);
        }
    }
}


$sql = "select count(*) as num,agent_id,stat from all_server_info where stat=1 or stat=2  group by agent_id,stat";
$result = $db->fetchAll($sql);

foreach($result as $value){
    $agent_id = $value['agent_id'];
    $format[$agent_id]['total_num'] += $value['num'];
    $value['stat'] == 1?$format[$agent_id]['open_num'] = $value['num']:'';
}

foreach($format as $aid=>$v){
    $sql_insert ="insert into all_server_num (agent_id,date,total_num,open_num) values($aid,curdate(),{$v['total_num']},{$v['open_num']})
    ON DUPLICATE KEY UPDATE  total_num={$v['total_num']},open_num={$v['open_num']}";
    $db->query($sql_insert);
}


echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running player pay rank script";
echo "\n";