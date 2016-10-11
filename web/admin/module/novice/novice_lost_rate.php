<?php
header('Content-type: text/html; charset=utf-8');
define('IN_DATANG_SYSTEM', true);
include_once "../../../config/config.php";
include_once SYSDIR_ADMIN.'/include/global.php';
include_once "../../../admin/class/db.class.php";
include_once "../../../admin/class/page.php";
global $smarty, $db, $auth,$dbarray;

//所有需要使用的数据库名
//$dbarray=array('sanguo2002','sanguo2003','sanguo2007','sanguo3001');

if(isset($_POST['server']) and $_POST['server']!=='all'){
 $server='sanguo'.$_POST['server'];
 $server_id=$_POST['server'];
}else{
    $server='all';
    $server_id='all';
}

//API引入位置很重要，这样既能继承以上的变量，该API的变量也能被以下继承
include_once "novice.api.php";

 $end_time=strtotime(date('Y-m-d H:i:s'));
//流失计算:此时时间 - 上次离线时间 > 2天
$sql='SELECT guide.condition_guide_ids FROM guide,player WHERE  guide.uid=player.id AND '.$end_time.' - player.logout_time > 86400';
$getdata=new DBClass();
if($server!=='all'){
    $result=$getdata->query_s($server,$sql);
    $arr=data_get($result);//将从数据库提取出来的数据进行处理
    $dataList=dataList($arr,$server_num);//将经过第一步处理的数据进行格式化，方便前端输出。$server_num为该服流失玩家总数，属于模块API：novice.api.php文件
    $num=get_num($arr);//新手流程流失总数 
}else{
    $rows = array();
    for($i=0;$i<count($dbarray);$i++){
        $sql='SELECT guide.condition_guide_ids FROM '.$dbarray[$i].'.guide,'.$dbarray[$i].'.player WHERE  guide.uid=player.id AND '.$end_time.' - player.logout_time > 86400';
        $result=$getdata->query_s($dbarray[$i],$sql);
        $arr[$i]=all_data_get($result);
        $rows=array_merge($rows,$arr[$i]);
    } 
    $result=array_count_values($rows);
    $num=get_num($result);
    ksort($result);
    $dataList=dataList($result,$all_server_num);
}



/*=====================    新手引导流失率模块接口       ========================*/
//全服数据处理成 array('流程ID'=>'该流程流失总数')
function all_data_get($arr){
    if ($arr) {
        $rows = array();
        while (($row = mysql_fetch_assoc($arr)) !== false) {
            $row=json_decode($row['condition_guide_ids'],true);
            if(is_array($row)){
                $row=array_pop($row);
                if($row==''){
                  $row=0;  
                 } 
             }
            array_push($rows, $row);
        }
        sort($rows);
        return $rows;
    }
    throw new Exception("获取sql执行结果出错，可能尚未执行sql<br>");
}

//数据处理成 array('流程ID'=>'该流程流失总数')
function data_get($limit_result){
    if ($limit_result) {
        $rows = array();
        while (($row = mysql_fetch_assoc($limit_result)) !== false) {
            $row=json_decode($row['condition_guide_ids'],true);
            if(is_array($row)){
                $row=array_pop($row);
                if($row==''){
                  $row=0;  
                 } 
             }
            array_push($rows, $row);
        }
        sort($rows);
        return array_count_values($rows);
    }
    throw new Exception("获取sql执行结果出错，可能尚未执行sql<br>");
}
//格式化 数据处理成 array('id'=>'流失流程ID’，'num'=>'该流程流失数','rate'=>'该流程流失率')
function dataList($arr,$num){
    if($arr){
        $row=array();
        $rows=array();
        $test=array_keys($arr);
        $arr=array_values($arr);
        for($i=0;$i<count($arr);$i++){
            $rate=round(($arr[$i]/$num)*100,2);
            $row=array('id'=>$test[$i],'num'=>$arr[$i],'rate'=>$rate);
            array_push($rows, $row);
        }
        return $rows;
    }
    throw new Exception("获取sql执行结果出错，可能尚未执行sql<br>");
}

//获取流程流失总数
function get_num($arr){
    $num=array_sum($arr);
    return $num;
}
/*===========================================================================*/



$data = array(
    'dataList'      => $dataList,
    'server'        => $server_id,
    'allserver'     => $allserver,
    'flow_num'      => $num,
    'server_num'    => $server_num,
    'all_server_num'=> $all_server_num,
);
$smarty->assign($data);
$smarty->display("module/novice/novice_lost_rate.html");
?>
