<?php
define('IN_DATANG_SYSTEM', true);
include_once "../../../config/config.php";
include_once SYSDIR_ADMIN.'/include/global.php';
include_once SYSDIR_ADMIN.'/include/config_item_type.php';
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
if(isset($_POST['begin_time'])){
    if(isset($_POST['server']) and $_POST['server']<>''){
        $server=trim($_POST['server']);
        $data_dbname=$dbpre.trim($_POST['server']);
    }
    if(isset($_POST['channels']) and $_POST['channels']<>''){
        $channels=" app_channel='".trim($_POST['channels'])."' AND ";
    }else{
        $channels='';
    }
    if($_POST['role_id']<>''){
        $role_id=" role_id='".trim($_POST['role_id'])."' AND ";
        $role_id_show=trim($_POST['role_id']);
    }else{
        $role_id="";
        $role_id_show='';
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
        $begin_time=$end_time-604800;//默认统计开始时间为7天前
    }

    $sql="SELECT role_id,cash,pay_time FROM xy_prepaid WHERE $role_id $channels pay_time BETWEEN $begin_time AND $end_time ORDER BY role_id";

    if($data_dbname){
        $get_data=new MySQL($data_host,$data_dbuser,$data_password,$data_dbname,'',$data_coding);
        $results=$get_data->query($sql);
        if($results){
            $recordCnt=mysql_num_rows($results);//结果集总行数
            $pageNo = get_page_no('page');//当前页码，即第几页
            $recordPerPage = get_record_per_page();//自定义每页多少行
            $pageCnt = ceil($recordCnt / $recordPerPage);//总页数
            $pageList = get_page_list($pageNo, $pageCnt);//分页列表的自动调整
            $limit_sql =getDataList($sql, $pageNo, $recordPerPage);//获取相应的分页数据
            $limit_result=$get_data->query($limit_sql);
            $dataList=getresults($limit_result);
        }else{
            echo "<script>alert('可能是数据库变更或者找不到对应的数据库导致数据获取失败！');</script>";
        }
    }else{
        echo "<script>alert('请先选择服务器！');</script>";
    }
}else{
        $end_time=strtotime(date('Y-m-d H:i:s'));
        $begin_time=$end_time-604800;//默认统计开始时间为7天前
}


//处理数据库结果集 html中的表格数据处理  
function getresults($query_result){
    if ($query_result) {
        $rows = array();
        while (($row = mysql_fetch_assoc($query_result)) !== false) {
            array_push($rows, $row);
        }
        return $rows;
    }
    throw new Exception("获取sql执行结果出错，可能尚未执行sql<br>");
}




$data = array(
    'serverlist'    =>$serverlist,
    'dataList'      =>$dataList,
    'recordCnt'     => $recordCnt,
    'pageCnt'       => $pageCnt,
    'recordPerPage' => $recordPerPage,
    'pageNo'        => $pageNo,
    'pageList'      => $pageList,
    'account_id'    => $account_id_show,
    'role_name'     => $role_name_show,
    'role_id'       => $role_id_show,
    'server'        => $server,
    'begin_time'    => date('Y/m/d',$begin_time),
    'end_time'      => date('Y/m/d',$end_time),
);
$smarty->assign($data);
$smarty->display("module/user_pay/pay_record.html");
?>