<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";



//获取管理员代理权限
$sql_user_agents = "select agent_id from ".T_ADMIN_USER." where uid=".$_SESSION['uid'];
$result = $db->fetchOne($sql_user_agents);
$admin_user_agents = explode(' ', $result['agent_id']);
foreach($admin_user_agents as $v) {
    $ADMIN_AGENT_NAME[$v] = $AGENT_NAME[$v];
}
$agent_list = implode(',', $admin_user_agents);

foreach($ALL_SERVER_LIST as $key=>$value) {
    if($key == 0) continue;
    foreach($value as $k=>$v) {
        $serStr = "S".$k;
        if($v['stat']==1)
            $servers[$key][$k] = $serStr;
    }
}
$action_agent = isset($_REQUEST['radio_agent'])?$_REQUEST['radio_agent']:0;
$server_ids = isset($_REQUEST['server_ids'])?$_REQUEST['server_ids']:array(0);
$action = $_REQUEST['action'];

$flag = 0;
foreach($server_ids as $k=>$v) {
    if($flag) $server_list .=',';
    $server_list .= $k;
    $flag = 1;
}
if ( !isset($_REQUEST['dStartDate'])) {
    $dStartTime = date("Y-m-d",time()-60*60*24);
}
else {
    $dStartTime  = trim(SS($_REQUEST['dStartDate']));
}
if ( !isset($_REQUEST['dEndDate'])) {
    $dEndTime = strftime ("%Y-%m-%d", time());
}
else {
    $dEndTime = trim(SS($_REQUEST['dEndDate']));
}
$start_time = strtotime($dStartTime);
$end_time = strtotime($dEndTime.'23:59:59');

if($_REQUEST['urlflag']) {
    $server_list=$_REQUEST['search_servers']?$_REQUEST['search_servers']:0;
    $temp = explode(',', $server_list);
    $server_ids=array();
    foreach ($temp as $v) {
        $server_ids[$v] = 1;
    }
}

if ( !isset($_REQUEST['start_time'])) {
    $reply_start_time = strftime("%Y-%m-%d %H:%M:%S",time());
}
else {
    $reply_start_time  = trim(SS($_REQUEST['start_time']));
}

if ( !isset($_REQUEST['end_time'])) {
    $reply_end_time = strftime ("%Y-%m-%d %H:%M:%S", time()+86400 );
}
else {
    $reply_end_time = trim(SS($_REQUEST['end_time']));
}
if ( !isset($_REQUEST['notice_end_time'])) {
    $notice_end_time = strftime("%Y-%m-%d %H:%M:%S", time()+7*86400 );
}
else {
    $notice_end_time = trim(SS($_REQUEST['notice_end_time']));
}
$keySign = "FTNN4399payKode";
$level_max = 150;
$sign=md5($keySign.$action);
if($action=='bulletin') {

    $title = trim($_REQUEST['title']);
    if (empty($title)) {
        errorExit("公告标题不能为空！");
    }
    $text = trim($_REQUEST['text']);

    $dateEndStamp   = intval(strtotime($notice_end_time));
    if($dateEndStamp == 0) {
        errorExit("请填写公告过期时间！");
    }
    if (empty($text)) {
        errorExit("公告内容不能为空！");
    }
    $text = str_replace("\\'", "'", $text); // 还原 '
    $text = str_replace("\\\"", "\"", $text);  // 还原 "
    $text = str_replace("\\\\", "\\", $text);  // 还原 \
    $text = base64_encode(urlencode($text));
    $flag_m=0;
    if($action_agent==0) {
        foreach($ADMIN_AGENT_NAME as $aid=>$value) {
            $message .=','. $value;
            foreach ($ALL_SERVER_LIST[$aid] as $sid=>$v) {
                if($v['stat']!=1) continue;
                $url = $v['url'];
                $link = $url."web/center/notice_repay.php?action=bulletin&time={$dateEndStamp}&title={$title}&text={$text}&sign={$sign}";
                $result = make_request($link,'POST',3);
                $data = json_decode($result, true);
                if($data!='ok') {
                    $message .= ' S'.$sid;
                    $flag_m = 1;
                }
            }
        }
    }else {
        $message = $ADMIN_AGENT_NAME[$action_agent];
        foreach($server_ids as $sid=>$v) {
            if($sid==0)continue;
            $url = $ALL_SERVER_LIST[$action_agent][$sid]['url'];
            $link = $url."web/center/notice_repay.php?action=bulletin&time={$dateEndStamp}&title={$title}&text={$text}&sign={$sign}";
            $result = make_request($link,'POST',3);
            $data = json_decode($result, true);
            if($data!='ok') {
                    $message .= ' S'.$sid;
                    $flag_m = 1;
                }
        }
    }
    if($flag_m) {
        errorExit($message."发布失败！");
    }else {
        infoExit("公告发布成功");
    }
}elseif($action=='compensation_conf') {

    $level_max = intval(trim(SS($_REQUEST['level_max'])));
    $level_min = intval(trim(SS($_REQUEST['level_min'])));
    if ($level_max <=0) {
        errorExit("请输入最高等级限制！");
    }
    if ($level_min <=0) {
        errorExit("请输入最低等级限制！");
    }
    if ($level_min > $level_max) {
        errorExit("最近等级大于最高等级！");
    }

    $goods = intval(SS(trim($_REQUEST['goods'])));
    if ($goods <= 0) {
        errorExit("请输入补偿的物品ID！");
    }

    $num = intval(SS(trim($_REQUEST['num'])));
    if ($num <= 0) {
        errorExit("请输入补偿的数量！");
    }

    if ($num >5) {
        errorExit("补偿的数量不能大于5！");
    }

    $dateStartStamp = strtotime($reply_start_time);
    $dateEndStamp   = strtotime($reply_end_time);

    if($dateStartStamp == $dateEndStamp) {
        errorExit("开始时间和结束时间不能相等！");
    }

    if($action_agent==0) {
        foreach($ADMIN_AGENT_NAME as $aid=>$value) {
            $message .=','. $value;
            foreach ($ALL_SERVER_LIST[$aid] as $sid=>$v) {
                if($v['stat']!=1) continue;
                $url = $v['url'];
                $link = $url."web/center/notice_repay.php?level_min={$level_min}&level_max={$level_max}"
                        ."&start_time={$dateStartStamp}&end_time={$dateEndStamp}"
                        ."&goods={$goods}&num={$num}&admin={$_SESSION['admin_user_name']}&sign={$sign}&action=compensation_conf";
                $result = make_request($link,'POST',3);
                $data = json_decode($result, true);
                if ($data =='ok') {
                    $insert_sql = "INSERT INTO `all_notice_reply` (`id` ,`start_time` ,`end_time` ,`goods_id` ,`num` ,`level_min` ,`level_max`,`operator`,`agent_id`,`server_id`)VALUES ('','{$dateStartStamp}', '{$dateEndStamp}', '{$goods}', '{$num}', '{$level_min}', '{$level_max}','{$_SESSION['admin_user_name']}',{$aid},{$sid})";
                    $db->query($insert_sql);
                }else {
                    $message .= ' S'.$sid;
                    $flag_m = 1;
                }
            }
        }
    }else {
        $message = $ADMIN_AGENT_NAME[$action_agent];
        foreach($server_ids as $sid=>$v){
            if($sid==0)continue;
            $url = $ALL_SERVER_LIST[$action_agent][$sid]['url'];
            $link = $url."web/center/notice_repay.php?level_min={$level_min}&level_max={$level_max}"
                    ."&start_time={$dateStartStamp}&end_time={$dateEndStamp}"
                    ."&goods={$goods}&num={$num}&admin={$_SESSION['admin_user_name']}&sign={$sign}&action=compensation_conf";
            $result = make_request($link,'POST',3);
            $data = json_decode($result, true);
            if ($data =='ok') {
                $insert_sql = "INSERT INTO `all_notice_reply` (`id` ,`start_time` ,`end_time` ,`goods_id` ,`num` ,`level_min` ,`level_max`,`operator`,`agent_id`,`server_id`)VALUES ('','{$dateStartStamp}', '{$dateEndStamp}', '{$goods}', '{$num}', '{$level_min}', '{$level_max}','{$_SESSION['admin_user_name']}',{$action_agent},{$sid})";
                $db->query($insert_sql);
            }else {
                    $message .= ' S'.$sid;
                    $flag_m = 1;
                }
        }
    }
    if($flag_m) {
        errorExit($message."发布失败！");
    }else {
        infoExit("发布成功");
    }
}


$pageno = (int)$_REQUEST['page'];
if ($pageno <=0 )
    $pageno = 1;
$table = '`all_notice_reply`';
$where = '1 and';
$where .= " ($table.`start_time`<={$end_time} and $table.`end_time`>={$start_time})  ";
$search_agents = $action_agent?$action_agent:$agent_list;
$search_servers = '';
$where .= " and $table.agent_id in ( $search_agents)  ";


if($server_list!='0') {
    $where .= " and $table.server_id in($server_list) ";
    $search_servers = $server_list;
}

$resultCount = getRecordCount("all_notice_reply",$where);
$count_result = $resultCount;


$pagelist = getPages($pageno, $count_result,LIST_PER_PAGE_RECORDS);
$start = ($pageno - 1) * LIST_PER_PAGE_RECORDS;
$count = LIST_PER_PAGE_RECORDS;
$sql = "SELECT all_notice_reply.*,t_PGoods.name FROM  all_notice_reply , `t_PGoods`  ";
$sql .= ' where '.$where;
$sql .= ' and all_notice_reply.goods_id=`t_PGoods`.id ';
$sql .= " ORDER BY all_notice_reply.id desc" ;
$sql .= " LIMIT {$start},{$count}";
$result = $db->fetchAll($sql);

foreach($result as $key=>$value) {
    $result[$key]['agent_name'] = $ADMIN_AGENT_NAME[$value['agent_id']];
}

$smarty->assign(array(
        'page'=>$pageno,
        'data'=>$result,
        'page_list' => $pagelist,
        'page_count'=> ceil($count_result/LIST_PER_PAGE_RECORDS),
));


$smarty->assign(array(
        'reply_start_time'=>$reply_start_time,
        'reply_end_time'=>$reply_end_time,
        'notice_end_time'=>$notice_end_time,
        'level_max'=>$level_max,
));
$smarty->assign(array("dStartTime"=>$dStartTime,
        "dEndTime"=>$dEndTime,
        'agent_id'=>$action_agent,
        'server_id'=>json_encode($server_ids),
        'servers'=>json_encode($servers),
        "allAgentName"=>$ADMIN_AGENT_NAME,
        'keyword'=>$key_word,
        'search_agents'=>$search_agents,
        'search_servers'=>$search_servers
));
$smarty->display("module/center/all_notice_repay.html");



#-------------------------------------------------------------------------------
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
#-------------------------------------------------------------------------------