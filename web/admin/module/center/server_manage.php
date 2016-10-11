<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;


$action = $_REQUEST['action'];
$id = $_REQUEST['id'];

$sql_agent = 'select agent_id,agent_name from agent_info';
$agent = $db->fetchAll($sql_agent);
foreach($agent as $value){
    $agent_id = $value['agent_id'];
    $agent_name = $value['agent_name'];
    $format_agent[$agent_id] = $agent_name;
}

switch($action) {
    case 'save':
        $agent = $_REQUEST['agentID'];
        $stat = $_REQUEST['serverStatus'];
        $type = $_REQUEST['serverType'];
        $server_id = $_REQUEST['serverID'];
        $domain_name = $_REQUEST['domainName'];
        $ip = $_REQUEST['ip'];
        $desc = $_REQUEST['sDesc'];
        $open_time = $_REQUEST['openTime'];
        $combine_time = $_REQUEST['combineTime'];
        $close_time = $_REQUEST['closeTime'];
        if(empty($_REQUEST['serverID'])||empty($_REQUEST['domainName'])||empty($_REQUEST['ip'])){
            $message = 'ERRRO:*必填选项为空';
            break;
        }
        if($id == 0) {
            $sql_query = "select * from all_server_info where agent_id=$agent and server_id=$server_id";
            $r = $db->fetchAll($sql_query);
            if(count($r)>0) {
                $message = 'ERROR:服务器已存在';
                break;
            }
        }
            
        save_server($id,$agent,$stat,$type,$server_id,$domain_name,$ip,$desc,$open_time,$combine_time,$close_time);
        break;
    case 'update':
        
        $info = update_server($id);
        
        $id = $info['id'];
        $agent = $info['agent_id'];
        $stat = $info['stat'];
        $type = $info['s_type'];
        $server_id = $info['server_id'];
        $domain_name = $info['domain_name'];
        $ip = $info['ip'];
        $desc = $info['s_desc'];
        $open_time=$info['open_time']>0?date('Y-m-d H:i:s',$info['open_time']):'';
        $combine_time = $info['combine_time']>0?date('Y-m-d H:i:s',$info['combine_time']):'';
        $close_time = $info['close_time']>0?date('Y-m-d H:i:s',$info['close_time']):'';
        break;
    case 'new':
        break;
}



$sql = "";

if(!isset($id)||$id<1) $id=0;

$smarty->assign('message',$message);
$smarty->assign('id',$id);
$smarty->assign('agent',$agent);
$smarty->assign('stat',$stat);
$smarty->assign('type',$type);
$smarty->assign('server_id',$server_id);
$smarty->assign('domain_name',$domain_name);
$smarty->assign('ip',$ip);
$smarty->assign('desc',$desc);
$smarty->assign('open_time',$open_time);
$smarty->assign('combine_time',$combine_time);
$smarty->assign('close_time',$close_time);


$smarty->assign('agent',$action);
$smarty->assign("allAgentName", $format_agent);
$smarty->display('module/center/server_manage.html');


function save_server($id,$agent,$stat,$type,$server_id,$domain_name,$ip,$desc,$open_time,$combine_time,$close_time){
    global  $db;
    $update = '';
  
    $open_time = empty($open_time)? 0:strtotime($open_time);
    $combine_time = empty($combine_time)? 0:strtotime($combine_time);
    $close_time = empty($close_time)? 0:strtotime($close_time);
    if(empty($desc)) $desc='';

if($id==0){
    $sql = "insert into all_server_info (`agent_id`,`server_id`,`s_type`,`ip`,`domain_name`,`stat`,`open_time`,`combine_time`,`close_time`,`s_desc`)
        values($agent,$server_id,$type,'$ip','$domain_name',$stat,$open_time,$combine_time,$close_time,'$desc')";
        }
else
    $sql = "update  all_server_info set
        `s_type`=$type,ip='$ip',domain_name='$domain_name',stat=$stat ,open_time=$open_time,combine_time=$combine_time,close_time=$close_time,`s_desc`='$desc' where id=$id";

//
//    $sql = "insert into all_server_info (`agent_id`,`server_id`,`s_type`,`ip`,`domain_name`,`stat`,`open_time`,`combine_time`,`close_time`,`s_desc`)
//        values($agent,$server_id,$type,'$ip','$domain_name',$stat,'$open_time','$combine_time','$close_time','$desc')
//         on duplicate key update s_type=$type,ip='$ip',domain_name='$domain_name',stat=$stat $update";
    $db->query($sql);
        echo "<meta http-equiv=refresh content='1; url=all_server_info.php'>";
        exit();

}


function update_server($id){
    global $db;
    $sql = "select * from all_server_info where id=$id";
    $rt = $db->fetchAll($sql);
    return $rt[0];
}