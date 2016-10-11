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

include_once "checkpoint.api.php";

$sql='SELECT normal_info,server FROM (SELECT * FROM xy_logoutrole ORDER BY logout_time DESC) test WHERE '.$channels.' logout_time BETWEEN '.$begin_time.' AND '.$end_time.' AND logout_time < '.$end_time.' GROUP BY role_id ORDER BY logout_time DESC';
if($data_dbname){
    $get_data=new MySQL($data_host,$data_dbuser,$data_password,$data_dbname,'',$data_coding);
    $results=$get_data->query($sql);
    if($results){
      $arr=get_data($results);
      $dataList=dataList($arr,$server_num);//$num为流失玩家总数 
      $json_data=$dataList['json_data'];
      $json_data=json_encode($json_data);
    }else{
        echo "<script>alert('可能是数据库变更或者找不到对应的数据库导致数据获取失败！');location.href='checkpoint_lost_rate.php';</script>";
    }
}


/*=====================    关卡流失率模块接口       ========================*/
//数据处理  数据格式：数字索引=>'一个玩家的最高关卡ID（pass_id)'
function get_data($limit_result){
    if ($limit_result) {
        $rows = array();
        while (($row = mysql_fetch_assoc($limit_result)) !== false) {
            $row=json_decode($row['normal_info'],true);
            array_push($rows, $row['top_custom_id']);
        }
        return $rows;
    }
    throw new Exception("获取sql执行结果出错，可能尚未执行sql<br>");
}
//格式化 数据格式:array('id'='关卡ID','num'=>该关卡流失总数 ,'rate'=>关卡流失率);
function dataList($arr,$num){
        $row=array();
        $rows=array();
        asort($arr);
        $arr=array_count_values($arr);//统计数组中所有的值出现的次数（每个关卡ID出现的次数)
        $keys=array_keys($arr);//获取$arr所有键名，以数字索引从新排列，关卡ID
        $values=array_values($arr);//获取$arr所有值，以数字索引从新排列，该关卡流失数量
        for($i=0;$i<count($arr);$i++){
            $rate=round(($values[$i]/$num)*100,2);
            $row=array('id'=>$keys[$i],'num'=>$values[$i],'rate'=>$rate);//生成格式数组
            array_push($rows, $row);
        }
        
        $end=end($arr);//将数组的内部指针指向最后一个单元
        $endkey=key($arr);//获得最后一个单元的键
        //将中间可能空缺的键值补上
        $transition=array();
        for($i=0;$i<=$endkey;$i++){
            array_push($transition, 0);
        }//构建一个等长数组，数字索引，值全部为零，为了解决数字数组不连续的情况
        $diff=array_diff_ukey($transition, $arr, 'key_compare_func');//用回调函数 key_compare_func 对键名比较计算数组的差集  
        $diff=array_keys($diff);//获取差集中所有的键
        //$result = array_merge($diff, $arr);
        $diff=array_fill_keys($diff,0);//用差集中的键填充数组，值全部为0
        $arr=$arr+$diff;//合并两个数组
        ksort($arr);//对数组按照键名排序
        $result_array=array('array_data'=>$rows,'json_data'=>$arr);
       return $result_array;

}


/*===============================================================================*/



$data = array(
    'serverlist'    =>$serverlist,
    'dataList'      => $dataList['array_data'],
    'server'       => $server,
    'json_data'     =>$json_data,
    'server_num'    => $server_num,
    'begin_time'    => date('Y/m/d',$begin_time),
    'end_time'      => date('Y/m/d',$end_time),
);
$smarty->assign($data);
$smarty->display("module/checkpoint_lost/checkpoint_lost_rate.html");
?>
