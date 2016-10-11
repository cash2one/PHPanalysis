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

if(isset($_POST['search'])){
    if(isset($_POST['server']) and $_POST['server']<>''){
        $server=trim($_POST['server']);
        $data_dbname=$dbpre.trim($_POST['server']);
    }
    if(isset($_POST['channels']) and $_POST['channels']<>''){
        $channels=" app_channel='".trim($_POST['channels'])."' AND ";
    }else{
        $channels='';
    }
    if(isset($_POST['role_id']) and $_POST['role_id']<>''){
        $role_id=" role_id='".trim($_POST['role_id'])."' AND ";
    }else{
        $role_id='';
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
        $begin_time=$end_time;//默认统计开始时间为30天前
    }
    

    $sql="SELECT role_id,logout_time-login_time AS online_time FROM xy_logoutrole WHERE $role_id $channels login_time BETWEEN $begin_time AND $end_time ORDER BY role_id";
    if($data_dbname){
        $get_data=new MySQL($data_host,$data_dbuser,$data_password,$data_dbname,'',$data_coding);
        $results=$get_data->query($sql);
        if(isset($results)){
            $rows = array();
            while (($row = mysql_fetch_assoc($results)) !== false) {
                array_push($rows, $row);
            }   
            $count=count($rows);
            $dataList=array();
            $j=1;
            for($i=0;$i<$count;$i++){
                if($rows[$i]['role_id']==$rows[$i+1]['role_id']){
                    $j++;
                    $rows[$i+1]['online_time']=(int)$rows[$i]['online_time'] + (int)$rows[$i+1]['online_time'];
                }else{
                    $rows[$i]['online_time']=round($rows[$i]['online_time']/($j*60));
                    array_push($dataList,$rows[$i]);
                    $j=1;
                }    
            }
        }else{
            echo "<script>alert('可能是数据库变更或者找不到对应的数据库导致数据获取失败！');</script>";
        }
    }else{
        echo "<script>alert('请选择服务器！');</script>";
    }
}else{
    $end_time=strtotime(date('Y-m-d H:i:s'));
    $begin_time=$end_time;//默认统计开始时间为30天前
}



$data = array(
    'serverlist'       =>$serverlist,
    'dataList'         =>$dataList,
    'server'           => $server_id,
    'server_role_num'  =>$server_role_num,
    'begin_time'       => date('Y/m/d',$begin_time),
    'end_time'         => date('Y/m/d',$end_time),
);
$smarty->assign($data);
$smarty->display("module/keep_active/use_duration.html");

?>