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
        $begin_time=$end_time-2592000;//默认统计开始时间为30天前
    }

    //生成要显示的时段时间
    $days=round(($end_time-$begin_time)/86400);
    $date=array();
    for($i=0;$i<=$days;$i++){
        $thedate=$begin_time+86400*$i;
        $test=date('m-d',$thedate);
        array_push($date,$test);
    }
    $date_m_d=json_encode($date);
    //print_r($date_m_d);
    $dates = array_flip($date);
    
    $sql_new="SELECT create_time FROM xy_loginrole WHERE $channels create_time BETWEEN $begin_time AND $end_time GROUP BY account_id";
    $sql_active="SELECT login_time FROM xy_loginrole WHERE $channels login_time BETWEEN $begin_time AND $end_time GROUP BY account_id";
    
    if($data_dbname){
        $get_data=new MySQL($data_host,$data_dbuser,$data_password,$data_dbname,'',$data_coding);
        $new_results=$get_data->query($sql_new);
        $active_results=$get_data->query($sql_active);
        if(isset($new_results) || isset($active_results)){
            /*====== 新增用户数据  ========*/
            $new_data = array();
            while (($row = mysql_fetch_assoc($new_results)) !== false) {
                $row['create_time']=date('m-d',$row['create_time']);
                array_push($new_data, $row['create_time']);
            }     
            $new_data=array_count_values($new_data);
            $new_diff=array_diff_ukey($dates, $new_data, 'key_compare_func');//用回调函数 key_compare_func 对键名比较计算数组的差集  
            $new_diff=array_keys($new_diff);//获取差集中所有的键
            $new_diff=array_fill_keys($new_diff,0);//用差集中的键填充数组，值全部为0
            $new_data=$new_data+$new_diff;
            ksort($new_data);
            $new_data=array_values($new_data);
            $json_new_data=json_encode($new_data);
            
            /*====== 活跃用户数据  ==========*/
            $active_data=array();
            while (($data = mysql_fetch_assoc($active_results)) !== false) {
               $data['login_time']=date('m-d',$data['login_time']);
                array_push($active_data, $data['login_time']);
            }
            $active_data=array_count_values($active_data);
            $active_diff=array_diff_ukey($dates, $active_data, 'key_compare_func');//用回调函数 key_compare_func 对键名比较计算数组的差集  
            $active_diff=array_keys($active_diff);//获取差集中所有的键
            $active_diff=array_fill_keys($active_diff,0);//用差集中的键填充数组，值全部为0
            $active_data=$active_data+$active_diff;
            ksort($active_data);
            $active_data=array_values($active_data);
            $json_active_data=json_encode($active_data);
            

        }else{
            echo "<script>alert('可能是数据库变更或者找不到对应的数据库导致数据获取失败！');</script>";
        }
    }else{
        echo "<script>alert('请选择服务器！');</script>";
    }
    //print_r($sql_data);
}else{
    $end_time=strtotime(date('Y-m-d H:i:s'));
    $begin_time=$end_time-2592000;//默认统计开始时间为30天前
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
    'json_new_data'    =>$json_new_data,
    'json_active_data' =>$json_active_data,
    'date_m_d'         =>$date_m_d,
    'serverlist'       =>$serverlist,
    'dataList'         => $dataList,
    'server'           => $server_id,
    'server_role_num'  =>$server_role_num,
    'begin_time'       => date('Y/m/d',$begin_time),
    'end_time'         => date('Y/m/d',$end_time),
);
$smarty->assign($data);
$smarty->display("module/keep_active/new_active.html");

?>