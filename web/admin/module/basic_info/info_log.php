<?php
define('IN_DATANG_SYSTEM', true);
include_once "../../../config/config.php";
include_once SYSDIR_ADMIN.'/include/global.php';
include_once "../../../admin/class/mysql.class.php";
include_once "../../../admin/class/page.php";
include_once "basic_info.api.php";

global $auth,$smarty,$data_host,$data_dbuser,$data_password,$data_coding,$host,$dbuser,$password,$dbname,$coding,$dbpre;
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
    $action=$_POST['action'];
    if($_POST['server']<>''){
        $server=$_POST['server'];
    }else{
        echo "<script>alert('未选择服务器！请刷新重试！');history.go(-1);</script>";
    }
    $account_id=$_POST['account_id'];
    $role_id=$_POST['role_id'];
    $role_name=$_POST['role_name'];
    
    $ser_sql='SELECT ip,gm_port FROM serverlists WHERE svr_id='.$server;
    $ser_result=$get_server_list->query($ser_sql);
    $ser_data=server_list($ser_result);
    
    $url='http://'.$ser_data[0]['ip'].':'.$ser_data[0]['gm_port'];
    //echo $url;
    
    $data = array('action'=>trim($action), 'account_id'=>trim($account_id), 'role_id'=>trim($role_id), 'role_name'=>trim($role_name));
    $data=json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER,0);
    curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);// CURLOPT_RETURNTRANSFER选项被设置，函数执行成功时会返回执行的结果，失败时返回 FALSE 。 
    $json_data=curl_exec($ch);
    curl_close($ch);

    $row=json_decode($json_data,true);
    $dataList=array();
    array_push($dataList,$row);
}


function server_list($result){
    if ($result) {
        $rows = array();
        while (($row = mysql_fetch_assoc($result)) !== false) {
            array_push($rows, $row);
        }
        return $rows;
    }
    throw new Exception("获取sql执行结果出错，可能尚未执行sql<br>");
}



$data = array(
    'serverlist'=>$serverlist,
    'dataList'  => $dataList
);
$smarty->assign($data);
$smarty->display("module/basic_info/info_log.html");
?>