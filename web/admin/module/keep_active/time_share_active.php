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
    if($_POST['begin_time']<>''){
        $begin_time=strtotime(trim($_POST['begin_time']).' 00:00:00');
        if($_POST['end_time']<>''){
            $end_time=strtotime(trim($_POST['end_time']).' 23:59:59');
        }else{
            $end_time=strtotime(date('Y-m-d H:i:s'));
        }
    }else{
        $end_time=strtotime(date('Y-m-d H:i:s'));
        $begin_time=$end_time;//默认统计开始时间为1天前
    }

    //生成要显示的时段时间 每段15分钟
    $days=round(($end_time-$begin_time)/900);//15分钟的段数
    $date=array();
    for($i=0;$i<=$days-1;$i++){
        $thedate=$begin_time+900*$i;
        $test=date('H:i',$thedate);
        array_push($date,$test);
    }
    $date_H_i=json_encode($date);

    
    $sql="SELECT online,online_time FROM xy_onlinerolenum WHERE $channels online_time >= $begin_time AND online_time < $end_time GROUP BY online_time";
    if($data_dbname){
        $get_data=new MySQL($data_host,$data_dbuser,$data_password,$data_dbname,'',$data_coding);
        $active_results=$get_data->query($sql);
        if(isset($active_results)){
            /*====== 活跃用户数据  ==========*/
            $active_data=array();
            while (($row = mysql_fetch_assoc($active_results)) !== false) {
              // 1以15分钟为单位分组
                if($row['online_time']%900==0 || $row['online_time']==$begin_time){
                    //$row['online_time']=date('H:i',$row['online_time']);
                    array_push($active_data, (int)$row['online']);
                } 
            }
            $json_active_data=json_encode($active_data);
            //print_r($json_active_data);
        }else{
            echo "<script>alert('可能是数据库变更或者找不到对应的数据库导致数据获取失败！');</script>";
        }
    }else{
        echo "<script>alert('请选择服务器！');</script>";
    }
    //print_r($sql_data);
}else{
    $end_time=strtotime(date('Y-m-d H:i:s'));
    $begin_time=$end_time;//默认统计开始时间为1天前
}

function key_compare_func($key1, $key2)
{
    if ($key1 == $key2)
        return 0;
    else if ($key1 > $key2)
        return 1;
    else
        return -1;
}  


$data = array(
    'json_active_data' =>$json_active_data,
    'date_m_d'         =>$date_H_i,
    'serverlist'       =>$serverlist,
    'dataList'         => $dataList,
    'server'           => $server_id,
    'server_role_num'  =>$server_role_num,
    'begin_time'       => date('Y/m/d',$begin_time),
    'end_time'         => date('Y/m/d',$end_time),
);
$smarty->assign($data);
$smarty->display("module/keep_active/time_share_active.html");

?>