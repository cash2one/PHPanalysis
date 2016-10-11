<?php
header('Content-type: text/html; charset=utf-8');
define('IN_DATANG_SYSTEM', true);
include_once "../../../config/config.php";
include_once SYSDIR_ADMIN.'/include/global.php';
include_once "../../../admin/class/mysql.class.php";
include_once "../../../admin/class/page.php";

global $smarty,$data_host,$data_dbuser,$data_password,$data_coding,$host,$dbuser,$password,$dbname,$coding,$dbpre;
//获得服务器列表
$get_server_list=new MySQL($host,$dbuser,$password,$dbname,'',$coding);
$sql_serlist='SELECT svr_id,clt_vsn,name FROM serverlists';//获取服务器列表
$result=$get_server_list->query($sql_serlist); 
if($result){
    $serverlist = array();
    while (($row = mysql_fetch_assoc($result)) !== false) {
        array_push($serverlist, $row);
    }
}

if(isset($_POST['server']) and $_POST['server']<>''){
    $server=trim($_POST['server']);
    $data_dbname=$dbpre.trim($_POST['server']);
}
if(isset($_POST['channels']) and $_POST['channels']<>''){
    $channels=" app_channel='".trim($_POST['channels'])."' AND ";
}else{
    $channels='';
}
if($_POST['begin_time']<>''){
    $begin_time=strtotime(trim($_POST['begin_time']).' 00:00:00');
    if($_POST['end_time']<>''){
        $end_time=strtotime(trim($_POST['end_time']).' 23:59:59');
    }else{
        $end_time=strtotime(date('Y-m-d H:i:s'));
    }
}else{
    $end_time=strtotime(date('Y-m-d H:i:s'));
    $begin_time=$end_time-2592000;//默认统计开始时间为30天前
}

include_once "level.api.php";
$sql='SELECT role_level FROM (SELECT * FROM xy_logoutrole ORDER BY logout_time DESC) test WHERE '.$channels.' logout_time BETWEEN '.$begin_time.' AND '.$end_time.' AND logout_time < '.$lost_end_time.' GROUP BY role_id ORDER BY logout_time DESC ';
if($data_dbname){
    $get_data=new MySQL($data_host,$data_dbuser,$data_password,$data_dbname,'',$data_coding);
    $results=$get_data->query($sql);
    if($results){
        $dataList=data_get($results);//数据以数组形式提取  
        $json_data=$dataList['json_data'];
        $json_data=json_encode($json_data);
    }else{
        echo "<script>alert('可能是数据库变更或者找不到对应的数据库导致数据获取失败！');location.href='role_highest_level.php';</script>";
    }
}




$data = array(
    'serverlist'    =>$serverlist,
    'dataList'      => $dataList['array_data'],
     'server'       => $server,
    'json_data'     =>$json_data,
    'begin_time'    => date('Y/m/d',$begin_time),
    'end_time'      => date('Y/m/d',$end_time),
);
$smarty->assign($data);
$smarty->display("module/level_lost/role_lost_level.html");
?>
