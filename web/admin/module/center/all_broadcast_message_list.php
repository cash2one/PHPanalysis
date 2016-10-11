<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";

include SYSDIR_ADMIN."/include/global.php";
include SYSDIR_ADMIN."/class/broadcast.class.php";
global $smarty,$db;
$keySign = "dt2BroadcastKode";

//获取管理员代理权限
$sql_user_agents = "select agent_id from ".T_ADMIN_USER." where uid=".$_SESSION['uid'];
$result = $db->fetchOne($sql_user_agents);
$admin_user_agents = explode(' ', $result['agent_id']);
foreach($admin_user_agents as $v) {
    $ADMIN_AGENT_NAME[$v] = $AGENT_NAME[$v];
}
$agent_list = implode(',', $admin_user_agents);

$agent = isset($_REQUEST['radio_agent'])?$_REQUEST['radio_agent']:0;
$server_ids = isset($_REQUEST['server_ids'])?$_REQUEST['server_ids']:array(0);
$key_word = isset($_REQUEST['keyword'])?$_REQUEST['keyword']:'';

$flag = 0;
foreach($server_ids as $k=>$v) {
    if($flag) $server_list .=',';
    $server_list .= $k;
    $flag = 1;
}

foreach($ALL_SERVER_LIST as $key=>$value) {
    if($key == 0 ) continue;
    if(!$ADMIN_AGENT_NAME[$key]) continue;
    foreach($value as $k=>$v) {
        $serStr = "S".$k;
        if($v['stat']==1)
            $servers[$key][$k] = $serStr;
    }
}

$smarty->assign("allAgentName", $ADMIN_AGENT_NAME);
$smarty->assign('agent_id',$agent);
$smarty->assign('servers',json_encode($servers));
$smarty->assign('server_id',json_encode($server_ids));


$action = trim($_GET['action']);

if ($action == 'add') {
    $smarty->assign('agent_id',1);
    $smarty->assign('action', $action);
    $smarty->display ( "module/center/all_broadcast_message_edit.html" );
} else if ($action == 'edit') {
    $id = trim($_GET['id']);
    $sql = "select * from all_log_broadcast where id=$id ";
    $broadcastVo = $db->fetchOne($sql);
    $smarty->assign('action', $action);
    $broadcastVo['agent_name'] = $AGENT_NAME[ $broadcastVo['agent_id']];
    $smarty->assign('broadcastVo', $broadcastVo);
    $smarty->assign('agent_id', $broadcastVo['agent_id']);
    $smarty->assign('server_id', json_encode(array($broadcastVo['server_id']=>1)));
    $smarty->display ( "module/center/all_broadcast_message_edit.html" );

} else if ($action == 'show') {
    $id = trim($_GET['id']);
    $sql = "select * from all_log_broadcast where id=$id ";
    $broadcastVo = $db->fetchOne($sql);
    $smarty->assign('action', $action);
    $broadcastVo['agent_name'] = $AGENT_NAME[ $broadcastVo['agent_id']];
    $smarty->assign('broadcastVo', $broadcastVo);
    $smarty->assign('agent_id', $broadcastVo['agent_id']);
    $smarty->assign('server_id', json_encode(array($broadcastVo['server_id']=>1)));
    $smarty->display ( "module/center/all_broadcast_message_edit.html" );
} else if($action == 'del') {
    $ids = trim($_GET['ids']);
    $sql_del = "delete from all_log_broadcast where id in ($ids) ";
    $sql_select = "select mid,agent_id,server_id from all_log_broadcast where id in ($ids)";

    $result = $db->fetchAll($sql_select);
    foreach($result as $value) {
        if(!$del_id[$value['agent_id']][$value['server_id']])
            $del_id[$value['agent_id']][$value['server_id']] = $value['mid'];
        else
            $del_id[$value['agent_id']][$value['server_id']] .= ','.$value['mid'];
    }
    foreach($del_id as $aid=>$v1) {
        foreach($v1 as $sid=>$v2) {
            $url = $ALL_SERVER_LIST[$aid][$sid]['url'];
            $id = $value['mid'];
            $sign = md5($action.$v2.$keySign);
            $link = $url."web/center/broadcast_message.php?action={$action}&id={$v2}&sign={$sign}";
            $result = make_request($link, 'POST', 5);
        }
    }
    $db->query($sql_del);
}else if($action == 'save') {
    $id = trim($_GET['id']);
    $mid = trim($_GET['mid'])|0;
    $foreign_id = trim($_GET['foreign_id'])|0;
    $type = trim($_GET['type']);
    $send_strategy = trim(SS($_GET['send_strategy']));
    $start_date = trim(SS($_GET['start_date']));
    $end_date = trim(SS($_GET['end_date']));
    $start_time = trim(SS($_GET['start_time']));
    $end_time = trim(SS($_GET['end_time']));
    $interval = trim(SS($_GET['interval']));
    $sql_content = trim(SS($_GET['content']));//mysql保存

    $content = urlencode(base64_encode(stripslashes(trim($_GET['content']))));//发送至游戏
//        $con_rev = addslashes(base64_decode(urldecode($content)));//游戏返回信息解析


    $sign = md5($action.$mid.$keySign);
    $agent = $_GET['agent'];
    $server_ids = $_GET['servers'];
    if(!$mid) {
        if($agent!=0) {
            unset($servers);
            $servers_arr = explode(',',$server_ids);
            foreach($servers_arr as $value) {
                if($value==0) continue;
                $servers[$agent][$value] = 1;
            }
        }
        foreach($servers as $aid=>$value) {
            foreach ($value as $sid=>$v) {
                $url = $ALL_SERVER_LIST[$aid][$sid]['url'];
                $link = $url."web/center/broadcast_message.php?action={$action}&sign={$sign}&id=".$mid."&foreign_id=".$foreign_id.
                        "&type=".$type."&send_strategy=".$send_strategy."&start_date=".urlencode($start_date).
                "&end_date=".urlencode($end_date)."&start_time=".urlencode($start_time)."&end_time=".urlencode($end_time).
                        "&interval=".$interval."&content=".$content;

                $result = make_request($link, 'GET', 5);
                $data = json_decode($result, true);
                $sql_insert = "insert into all_log_broadcast(mid,foreign_id,`type`,send_strategy,start_date,end_date,start_time,end_time,`interval`,`content`,agent_id,server_id)
                    values({$data['ResultData']['id']},$foreign_id,$type,$send_strategy,'$start_date','$end_date','$start_time','$end_time',$interval,'$sql_content',$aid,$sid)
                    on duplicate key update foreign_id=$foreign_id,`type`=$type,send_strategy=$send_strategy,start_date='$start_date',
                    end_date='$end_date',start_time='$start_time',end_time='$end_time',`interval`=$interval,content='$sql_content'";
                $db->query($sql_insert);
            }
        }
    }
    else {
        $url = $ALL_SERVER_LIST[$agent][$server_ids]['url'];
        $link = $url."web/center/broadcast_message.php?action={$action}&id=".$mid."&foreign_id=".$foreign_id.
                "&type=".$type."&send_strategy=".$send_strategy."&start_date=".urlencode($start_date).
                "&end_date=".urlencode($end_date)."&start_time=".urlencode($start_time)."&end_time=".urlencode($end_time).
                "&interval=".$interval."&content=".$content;
        $result = make_request($link, 'GET', 5);
        $data = json_decode($result, true);
        $sql_update = "update all_log_broadcast set foreign_id=$foreign_id,`type`=$type,send_strategy=$send_strategy,start_date='$start_date',
                    end_date='$end_date',start_time='$start_time',end_time='$end_time',`interval`=$interval,content='$sql_content'
                    where id=$id and agent_id=$agent and server_id=$server_ids";
        $db->query($sql_update);
    }
}


if($action!='edit'&&$action!='show'&&$action!='add') {
    $pageno = getUrlParam('page');

    if($pageno>1){
        $server_list = $_REQUEST['server_list'];
        $tmp = explode(',', $server_list);
        foreach($tmp as $v){
            if($v==0) continue;
            $server_ids[$v] = 1;
        }
    }
    $where = '1 ';
    if($agent) {
        $where .= " and agent_id=$agent  and server_id in($server_list) ";
    }else{
        $where .= " and agent_id in($agent_list) ";
    }
    if($key_word)
        $where .= " and content like '%$key_word%'";

    $search_sort = " agent_id,server_id";
    $tablename = "all_log_broadcast";
    $count_result	= 0;
    $rt	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);

    if(!empty($rt)) {
        foreach($rt as $kPay => $vPay) {
            $rt[$kPay]['agent_name'] = $AGENT_NAME[$vPay['agent_id']];
        }
    }
    $pagelist	= getPages($pageno, $count_result);

    $smarty->assign('server_id',json_encode($server_ids));
    $smarty->assign('server_list',$server_list);
    $smarty->assign('keyword',$key_word);
    $smarty->assign('page_list',$pagelist);
    $smarty->assign (array('dataResultSet' => $rt));
    $smarty->display ( "module/center/all_broadcast_message_list.html" );
}






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
