<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

//获取管理员代理权限
$sql_user_agents = "select agent_id from ".T_ADMIN_USER." where uid=".$_SESSION['uid'];
$result = $db->fetchOne($sql_user_agents);
$admin_user_agents = explode(' ', $result['agent_id']);
foreach($admin_user_agents as $v){
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
$key_word = isset($_REQUEST['keyword'])?$_REQUEST['keyword']:'';
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


if($_REQUEST['urlflag']){
    $server_list=$_REQUEST['search_servers']?$_REQUEST['search_servers']:0;
    $temp = explode(',', $server_list);
    $server_ids=array();
    foreach ($temp as $v){       
        $server_ids[$v] = 1;
    }
}

if('info'==$action) {
    $id=$_GET['id'];
    $query_st="select * from "."all_GM_Complaint"." where id='$id'";
    $result=mysql_query($query_st);
    $rs = mysql_fetch_array($result);
}

//处理标记
$keySign = "FTNN4399payKode";
if('ignore'== $action) {

    $id=$_REQUEST['id'];
    $bug_id = $_REQUEST ['bug_id'];
    $aid = trim ($_REQUEST ['agent_id']);
    $sid = trim ($_REQUEST ['server_id']);
    $url = $ALL_SERVER_LIST[$aid][$sid]['url'];
    $sign=md5($action.$bug_id.$keySign);
    $link = $url."web/center/gm_complaint.php?id={$bug_id}&sign={$sign}&action={$action}";
    $result = make_request($link, 'POST', 5);
    $data = json_decode($result, true);
    if($data == 'ok') {
        $update = "UPDATE `all_GM_Complaint` SET `state` = '1' WHERE `id` ='{$id}' LIMIT 1 ";
        $db->query($update);
    }
}

$msgTypeArr = array(1=>"提交BUG",2=>"投诉",3=>"游戏建议",4=>"其他",);
$rs['msgType'] = $msgTypeArr[$rs['type']];

$pageno = (int)$_REQUEST['page'];
if ($pageno <=0 )
	$pageno = 1;

$where = '1 and ';
$where .= " `time`>={$start_time} and `time`<={$end_time} ";
$search_agents = $action_agent?$action_agent:$agent_list;
$search_servers = '';
$where .= ' and agent_id in (' . $search_agents.')  ';


if($server_list!='0'){
    $where .= ' and server_id in('.$server_list.') ';
    $search_servers = $server_list;
    }
 if(trim($key_word))
        $where .= " and content like '%$key_word%'";


$resultCount = getRecordCount("all_GM_Complaint",$where);
$count_result = $resultCount;

$pagelist = getPages($pageno, $count_result,LIST_PER_PAGE_RECORDS);
$start = ($pageno - 1) * LIST_PER_PAGE_RECORDS;
$count = LIST_PER_PAGE_RECORDS;
$sql = "SELECT * FROM "."all_GM_Complaint";
$sql .= ' where '.$where;
$sql .= " ORDER BY time desc" ;
$sql .= " LIMIT {$start},{$count}";
$result = $db->fetchAll($sql);
foreach ($result as $key => $row)
{
        $result[$key]['agent_name'] = $AGENT_NAME[$row['agent_id']];
	$result[$key]['msgType'] = $msgTypeArr[$row['type']];
}

$smarty->assign(array(
	'page'=>$pageno,
	'rs'=>$result,
	'page_list' => $pagelist,
	'page_count'=> ceil($count_result/LIST_PER_PAGE_RECORDS),
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

$smarty->assign("one_msg", $rs);
$smarty->display("module/center/all_gm_complaint.html");




function ignore_bugs($action,$keySign) {

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
