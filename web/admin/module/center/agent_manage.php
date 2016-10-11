<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;



$action = $_REQUEST['action'];
$id = $_REQUEST['id'];
$agent_id = $_REQUEST['agentID'];
$agent_name = $_REQUEST['agentName'];
$server_num = $_REQUEST['serverNum'];
$website = $_REQUEST['website'];
$bbs = $_REQUEST['bbs'];
$first_open_time= $_REQUEST['openTime'];
$agent_system = $_REQUEST['agentSystem'];



switch($action) {
    case 'save':
        if(empty($_REQUEST['agentID'])||empty($_REQUEST['agentName'])||empty($_REQUEST['serverNum'])||empty($_REQUEST['openTime'])) {
            $message = 'ERRRO:*必填选项为空';
            break;
        }

        if($id == 0) {
            $sql_query = "select * from agent_info where agent_id=$agent_id or agent_name='$agent_name'";
            $r = $db->fetchAll($sql_query);
            if(count($r)>0) {
                $message = 'ERROR:代理ID或代理名已存在';
                break;
            }
        }

        $agent_id = $_REQUEST['agentID'];
        $agent_name = $_REQUEST['agentName'];
        $server_num = $_REQUEST['serverNum'];
        $website = $_REQUEST['website'];
        $bbs = $_REQUEST['bbs'];
        $first_open_time= $_REQUEST['openTime'];
        $agent_system = $_REQUEST['agentSystem'];
        $sql = "insert into agent_info(agent_id,agent_name,official_website,agent_system,bbs,first_open_time,server_num)
            values($agent_id,'$agent_name','$website','$agent_system','$bbs','$first_open_time',$server_num)
            on duplicate key update official_website='$website',agent_system='$agent_system',bbs='$bbs',first_open_time='$first_open_time',server_num=$server_num";

        $db->query($sql);
        echo "<meta http-equiv=refresh content='1; url=agent_list.php'>";
        exit();
        break;
}




if($id>0) {
    $sql = "select * from agent_info where id=$id";
    $result = $db->fetchOne($sql);

}

if(!isset($result['id'])) $result['id']=0;

$smarty->assign('message',$message);
$smarty->assign('data',$result);

$smarty->display('module/center/agent_manage.html');