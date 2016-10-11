<?php
header('Content-type: text/html; charset=utf-8');
define('IN_DATANG_SYSTEM', true);
include_once "../../../config/config.php";
include_once SYSDIR_ADMIN.'/include/global.php';
include_once "../../../admin/class/db.class.php";
include_once "../../../admin/class/page.php";
global $smarty,$dbarray;

if($_POST['server']<>''){
    $server='sanguo'.$_POST['server'];
    $server_show=$_POST['server'];
}else{
    $server="sanguo2002";
    $server_show='2002';
}

if($_POST['begin_time']<>''){
    $begin_time=strtotime(trim($_POST['begin_time']).' 00:00:00');
    if($_POST['end_time']<>''){
        $end_time=strtotime(trim($_POST['end_time']).' 23:59:59');
    }else{
        $end_time=strtotime(date('Y-m-d H:i:s'));
    }
}else{
    $begin_time=strtotime('2016-01-01 00:00:00');
    $end_time=strtotime(date('Y-m-d H:i:s'));
}

include_once "novice.api.php";
$sql='SELECT guide.uid,guide.condition_guide_ids,player.nick FROM guide,player WHERE  guide.uid=player.id AND player.logout_time BETWEEN '.$begin_time.' AND '.$end_time.' AND player.logout_time - player.reg_time < 86400';


$getdata=new DBClass();
$result=$getdata->query_s($server,$sql);
if($result){
    //分页
    $recordCnt=mysql_num_rows($result);//结果集总行数
    $pageNo = get_page_no('page');//当前页码，即第几页
    $recordPerPage = get_record_per_page();//自定义每页多少行
    $pageCnt = ceil($recordCnt / $recordPerPage);//总页数
    $pageList = get_page_list($pageNo, $pageCnt);//分页列表的自动调整
    $limit_sql =getDataList($sql, $pageNo, $recordPerPage);//获取相应的分页数据
    $limit_result=$getdata->query($limit_sql);
    $dataList=data_get($limit_result);//数据以数组形式提取  
}

//数据处理:array()=([0]=array('id'=>'角色ID','nick'=>'角色名称','condition_guide_ids'=>'最高新手引导流程id'))
function data_get($limit_result){
    if ($limit_result) {
        $rows = array();
        while (($row = mysql_fetch_assoc($limit_result)) !== false) {
            $id=json_decode($row['condition_guide_ids'],true);
            if(is_array($row)){
                $id=array_pop($id);//获取新手引导最高流程ID
                if($id==''){
                  $id=0;  
                 } 
                 $row['condition_guide_ids']=$id;
             }
            array_push($rows, $row);
        }
        return $rows;
    }
    throw new Exception("获取sql执行结果出错，可能尚未执行sql<br>");
}


$data = array(
    'dataList'      => $dataList,
    'recordCnt'     => $recordCnt,
    'pageCnt'       => $pageCnt,
    'recordPerPage' => $recordPerPage,
    'pageNo'        => $pageNo,
    'pageList'      => $pageList,
    'server_show'   => $server_show,
    'server_role_num' =>$server_role_num,
    'begin_time'    => date('Y/m/d',$begin_time),
    'end_time'      => date('Y/m/d',$end_time),
);
$smarty->assign($data);
$smarty->display("module/novice/new_role_highest_flow.html");
?>
