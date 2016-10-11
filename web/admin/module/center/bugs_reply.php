<?php
define ( 'IN_DATANG_SYSTEM', true );
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN . "/include/global.php";
global $smarty, $db;

$keySign = "FTNN4399payKode";
$action = $_REQUEST['action'];
$id=trim ($_REQUEST ['id']);
$bug_id=$_REQUEST ['bug_id'];
$keyword = trim ( $_REQUEST ['keyword']);
$radio_agent=   $_REQUEST ['radio_agent'];
$search_servers = trim ( $_REQUEST ['search_servers']);
$dStartTime  = trim($_REQUEST['dStartDate']);
$dEndTime = trim($_REQUEST['dEndDate']);
$page = $_REQUEST ['page'];
$aid = trim ($_REQUEST ['agent_id']);
$sid = trim ($_REQUEST ['server_id']);

$role_id = trim ($_REQUEST ['roleid']);
$role_name = trim ( $_REQUEST ['role_name']);

if ($role_id == '' && $role_name == '') {
    errorExit ( "角色id和角色名不能同时为空" );
}
//清除空格
$role_id = preg_replace('/\s/', '', $role_id);

//将中文逗号替换成英文逗号
$role_id = str_replace("，", ",", $role_id);

$content = trim ( $_POST ['content'] );
if ($content == '') {
    errorExit ( "信件内容不能为空" );
}
$role_name_log = $role_name;
$role_name = str_replace("\\'", "'", $role_name); // 还原 '
$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \
$role_name = urlencode($role_name);

$content_log = $content;
$content = str_replace("\\'", "'", $content); // 还原 '
$content = str_replace("\\\"", "\"", $content);  // 还原 "
$content = str_replace("\\\\", "\\", $content);  // 还原 \
$content = urlencode($content);

$url = $ALL_SERVER_LIST[$aid][$sid]['url'];
$sign=md5($action.$bug_id.$keySign);
$link = $url."web/center/gm_complaint.php?id={$bug_id}&sign={$sign}&action={$action}&content={$content}&role_id={$role_id}&role_name={$role_name}";
$result = make_request($link, 'GET', 5);
$data = json_decode($result, true);
if($data=='ok'){
    $loger = new AdminLogClass();
    $loger->Log( AdminLogClass::TYPE_REPLY_COMPLAINT, $content_log, '', '', $role_id, $role_name_log);
    $update = 'UPDATE  `all_GM_Complaint` SET `state` = 1, reply =  \'' .
            urldecode($content) .
            '\' where id='.$id;
     $db->query($update);
    echo "<script language='javascript'> alert('回复成功');location.href='all_gm_complaint.php?page={$page}&urlflag=1&radio_agent={$radio_agent}&search_servers={$search_servers}&keyword={$keyword}&dStartDate={$dStartTime}&dEndDate={$dEndTime}' </script>";
} else{
    echo "<script language='javascript'> alert('回复失败');location.href='all_gm_complaint.php?page={$page}&urlflag=1&radio_agent={$radio_agent}&search_servers={$search_servers}&keyword={$keyword}&dStartDate={$dStartTime}&dEndDate={$dEndTime}' </script>";
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

