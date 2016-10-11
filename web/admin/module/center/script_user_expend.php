<?php
define('IN_DATANG_SYSTEM', true);

include "../../../config/config.php";
include "../../../config/config.center.expend.php";
include SYSDIR_ADMIN.'/include/api_global.php';


$keySign = "FTNN4399payKode";
$now_time = time();
$start_time = $PLAY_EXPEND_TIME["time"];

echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run player pay rank script";
echo "\n";



//1=>'GM后台，
//2=>'交易',
//3=>'消耗',
//4=>'装备相关',
//5=>'坐骑宠物',
//6=>'商店消费'
//

//$silver_spend = array(1001,1002,1003,1004,1005,1006,1007,1008,1009,1010,1011,1012,1013,1014,1015,1016,1017,1018,1019,1020,1021,1022,
//        1030,1031,1032,1033,1034,1035,1036,1037,1038,1039,1040,1041,1042,1043,1044,1045,1046,
//        1050,1051,1052,1053,1055,1056,1057,1058,1059,1060,1061,1062,1070,1071,1072,1080,1091,1092, 1093
//);

$silver_spend = array(
    1001=>1,

    1003=>2,

    1004=>3,
    1005=>3,
    1006=>3,
    1007=>3,
    1008=>3,
    1009=>3,
    1010=>3,
    1011=>3,
    1025=>3,
    1026=>3,
    1027=>3,

    1012=>4,
    1013=>4,
    1014=>4,
    1015=>4,
    1024=>4,

    1002=>6
);



/*
3001=>'GM后台扣除元宝', 1
3002=>系统商店购买道具, 2
3003=>复活失去元宝,3
3004=>委托任务消耗元宝,4
3005=>立即完成委托任务消耗元宝,5
3012=>开通仓库消耗元宝, 6
3013=>自由传送扣元宝, 7
3014=>装备传承消耗元宝, 8
3015=>国家捐赠消耗元宝, 9
3017=>创建家族扣除元宝, 10
3018=>帮助捐款的扣元宝, 11
3019=>刷新日常任务消耗元宝, 12
3020=>立即完成日常任务消耗元宝, 13
3021=>车夫扣除金币, 14
3022=>资源找回消耗元宝, 15
3023=>每日任务, 16
3024=>坐骑升星, 17
3025=>经验副本, 18
3026=>交易, 19
3027=>刷新镖车, 20
3028=>寻宝, 21
3029=>石头升级, 22
3030=>膜拜刷新橙色奖励, 23
3031=>开服活动元宝领取奖励, 24
1012=>装备强化, 25
3032 => '升级武将星级', 26
3033 => '经验副本领取经验消耗元宝', 27
3034 => '使用道具消耗元宝', 28
3035 => '每日签到补签消耗元宝', 29
3036 => '宝石开孔', 30
3037 => '领取离线经验消耗元宝', 31
3038 => '摇钱树花费元宝获取宝石', 32
3039 => '摇钱树花费元宝获取礼金', 33
3040 => '摇钱树花费元宝获取银两', 34
10025 => '投资计划', 35
10026 => '国运转盘', 36
10016 => '坐骑升星', 37
10017 => '坐骑升阶', 38

 */




$points_spend = array(9001=>1);
$gold_spend = array(
    3001 => 1,
    3002 => 2,
    3003 => 3,
    3004 => 4,
    3005 => 5,
    3012 => 6,
    3013 => 7,
    3014 => 8,
    3015 => 9,
    3017 => 10,
    3018 => 11,
    3019 => 12,
    3020 => 13,
    3021 => 14,
    3022 => 15,
    3023 => 16,
    3024 => 17,
    3025 => 18,
    3026 => 19,
    3027 => 20,
    3028 => 21,
    3029 => 22,
    3030 => 23,
    3031 => 24,
    1012 => 25,
    3032 => 26,
    3033 => 27,
    3034 => 28,
    3035 => 29,
    3036 => 30,
    3037 => 31,
    3038 => 32,
    10025 => 33,
    10026 => 34,
    10016 => 35,
    10017 => 36,
);

# $aid:agent_id
# $sid:server_id
foreach($ALL_SERVER_LIST as $aid => $v) {
    if(!empty($v)) {

        foreach($v as $sid => $vv) {
            if(!empty($vv['url']) && $vv['stat']==1) {
                unset($pay_result,$result);

                $sign = md5($start_time . $keySign . $now_time);
                $link = $vv['url']."web/center/day_expend.php?starttime={$start_time}&endtime={$now_time}&sign={$sign}";
                //echo $link;exit;
                $result = make_request($link, 'POST', 5);
                $pay_result = json_decode($result, true);

                if($pay_result != 'sign_error' && !empty($pay_result)) {

                    foreach($pay_result['silver'] as $value) {
                        if(!empty($value)) {
                            $unbind_silver = $value['silver_unbind'];
                            $bind_silver = $value['silver_bind'];
                            $customers = $value['customers'];
                            $buy_times = $value['buy_times'];
                            $mtype = $value['mtype'];
                            $date = $value['date'];
                            $sql = "insert into all_log_use_silver(unbind_silver,bind_silver,customers,buy_times,mtype,ctype,date,agent_id,server_id)
                            values($unbind_silver,$bind_silver,$customers,$buy_times,$mtype,$silver_spend[$mtype],'$date',$aid,$sid)
                            on duplicate key update unbind_silver=$unbind_silver,bind_silver=$bind_silver ,customers=$customers,buy_times=$buy_times ";
                        }
                        $db->query($sql);
                    }
                    foreach($pay_result['gold'] as $value) {
                        if(!empty($v)) {
                            $unbind_gold = $value['gold_unbind'];
                            $bind_gold = $value['gold_bind'];
                            $customers = $value['customers'];
                            $buy_times = $value['buy_times'];
                            $mtype = $value['mtype'];
                            $itemid = $value['itemid'];
                            $date = $value['date'];
                            $ctype = isset($gold_spend[$mtype])?$gold_spend[$mtype]:50;
                            $sql = "insert into all_log_use_gold(unbind_gold,bind_gold,customers,buy_times,mtype,ctype,itemid,date,agent_id,server_id)
                            values($unbind_gold,$bind_gold,$customers,$buy_times,$mtype,$ctype,$itemid,'$date',$aid,$sid)
                            on duplicate key update unbind_gold=$unbind_gold,bind_gold=$bind_gold,customers=$customers,buy_times=$buy_times,ctype=$ctype ";
                        }
                        $db->query($sql);
                    }
                    foreach($pay_result['points'] as $value) {
                        if(!empty($v)) {
                            $points = $value['points'];
                            $customers = $value['customers'];
                            $buy_times = $value['buy_times'];
                            $mtype = $value['mtype'];
                            $itemid = $value['itemid'];
                            $date = $value['date'];
                            $sql = "insert into all_log_use_points(points,customers,buy_times,mtype,ctype,itemid,date,agent_id,server_id)
                            values($points,$customers,$buy_times,$mtype,$points_spend[$mtype],$itemid,'$date',$aid,$sid)
                            on duplicate key update points=$points,customers=$customers,buy_times=$buy_times ";
                        }
                        $db->query($sql);
                    }
                }
            }
        }
    }
}
$PLAY_EXPEND_TIME["time"] = $now_time;
/*$config_file = fopen('/mnt/hgfs/sg_php/web/config/config.center.expend.php', 'wb');
echo fwrite($config_file, "<?php\n\$PLAY_EXPEND_TIME = " . var_export($PLAY_EXPEND_TIME,true) . ";\n");exit;
fclose($config_file);*/
$filename = '../../../config/config.center.expend.php';
$word = "<?php\n\$PLAY_EXPEND_TIME = " . var_export($PLAY_EXPEND_TIME,true) . ";\n?>";
if (is_writable($filename)) {
    //打开文件
    if (!$fh = fopen($filename, 'wb')) {
        echo "不能打开文件 $filename";
        exit;
    }
    // 写入内容
    if (fwrite($fh, $word) === FALSE) {
        echo "不能写入到文件 $filename";
        exit;
    }
    //echo "成功地将 ",$word ,"写入到文件", $filename;
    fclose($fh);
} else {
    echo "文件 $filename 不可写";
}

echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running player pay rank script";
echo "\n";

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



