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
if(isset($_POST['tag'])){
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
    for($i=1;$i<=$days-1;$i++){
        $thedate=$begin_time+86400*$i;
        $test=date('m-d',$thedate);
        array_push($date,$test);
    }
    $date_m_d=json_encode($date);
    //print_r($date_m_d);
    $dates = array_flip($date);
    
    $begin_time_end=$begin_time+86400;//统计新增时不超过当天，统计留存时不包含当天
    $new_sql="SELECT DISTINCT account_id FROM xy_loginrole WHERE $channels create_time > $begin_time AND create_time < $begin_time_end";//新增用户数
    //echo $new_sql;
    if($data_dbname){
        $get_data=new MySQL($data_host,$data_dbuser,$data_password,$data_dbname,'',$data_coding);
        $new_users=$get_data->query($new_sql);
        if($new_users){
            $account_ids=get_account_ids($new_users);//新增用户的账号集
            $new_num=mysql_num_rows($new_users);//当天新增用户总数
            if($new_num!=0){
                $sql="SELECT login_time FROM xy_loginrole WHERE $channels create_time > $begin_time AND create_time < $begin_time_end AND login_time BETWEEN $begin_time_end AND $end_time AND account_id IN $account_ids GROUP BY account_id";//留存用户数
                $results=$get_data->query($sql);
                if(isset($results)){
                    $data = array();
                    while (($row = mysql_fetch_assoc($results)) !== false) {
                        $row['login_time']=date('m-d',$row['login_time']);
                        array_push($data, $row['login_time']);
                    }     
                    $data=array_count_values($data);
                    $diff=array_diff_ukey($dates, $data, 'key_compare_func');//用回调函数 key_compare_func 对键名比较计算数组的差集(没有数据的日期)
                    $diff=array_keys($diff);//获取差集中所有的键（日期）
                    $diff=array_fill_keys($diff,0);//用差集中的键填充数组，值全部为0
                    $data=$data+$diff;
                    ksort($data);
                    $data=array_values($data);
                    //将留存数与当日新增数换算成比率
                    for($i=0;$i<count($data);$i++){
                        $data[$i]=$data[$i]/$new_num*100;
                    }
                    $json_data=json_encode($data);
                }
            }else{
                $json_data='[0]';//新增用户为0
            }
        }else{
            echo "<script>alert('可能是数据库变更或者找不到对应的数据库导致数据获取失败！');</script>";
        }
    }else{
        echo "<script>alert('请选择服务器！');</script>";
    }
}else{
    $end_time=strtotime(date('Y-m-d H:i:s'));
    $begin_time=$end_time-2592000;//默认统计开始时间为30天前
}
//print_r($json_data);

function get_account_ids($results){
    $left='(';
    $right=')';
    while (($row = mysql_fetch_assoc($results)) !== false) {
        $data .="'".$row['account_id']."'".",";
    } 
    $data=$left.trim($data,',').$right;
    return $data;
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
    'json_data'        =>$json_data,
    'date_m_d'         =>$date_m_d,
    'serverlist'       =>$serverlist,
    'dataList'         => $dataList,
    'server'           => $server_id,
    'server_role_num'  =>$server_role_num,
    'begin_time'       => date('Y/m/d',$begin_time),
    'end_time'         => date('Y/m/d',$end_time),
);
$smarty->assign($data);
$smarty->display("module/keep_active/keep_user.html");

?>