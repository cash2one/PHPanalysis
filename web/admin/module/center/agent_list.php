<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;


//if($_REQUEST['AgentAction'] == 'new'){
//    $agent_name = $_REQUEST['agentName'];
//    $sql = "insert into agent_info(agent_name) values('$agent_name')";
//    $db->query($sql);
//}
if($_REQUEST['AgentAction'] == 'delete'){
    $id = $_REQUEST['id'];
    $sql = "delete from agent_info where id=$id";
    $db->query($sql);
}

$sql = "select * from agent_info ";
$result = $db->fetchAll($sql);
//print_r($result);
$smarty->assign('data',$result);
$smarty->display('module/center/agent_list.html');