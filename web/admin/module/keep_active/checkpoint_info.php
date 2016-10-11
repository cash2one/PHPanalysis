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


//角色最高关卡
$sql='SELECT task_id,pro_star,is_sweep,end_state,use_time FROM  xy_dungeon WHERE end_time BETWEEN '.$channels.$begin_time.' AND '.$end_time.' ORDER BY task_id';
//echo $sql;
if($data_dbname){
    $get_data=new MySQL($data_host,$data_dbuser,$data_password,$data_dbname,'',$data_coding);
    $results=$get_data->query($sql);
    if($results){
        $recordCnt=mysql_num_rows($results);//结果集总行数
        $dataList=data_get($results);//数据以数组形式提取
    }
}

//数据处理
function data_get($limit_result){
    if ($limit_result) {
        $rows = array();
        $arr=array();
        $task_id_num=array();
        while (($row = mysql_fetch_assoc($limit_result)) !== false) {
            array_push($task_id_num,$row['task_id']);//取出所有task_id
            array_push($rows, $row);
        }
        
        $task_id_count=array_count_values($task_id_num);//task_id=>该ID行数
        
        foreach ($task_id_count as $task_id=>$count){
            for($i=0;$i<=count($rows);$i++){
                if($rows[$i]['task_id']==$task_id){
                    //array_push($arr[$task_id][],$rows[$i]);
                    $arr[$task_id][]=$rows[$i];//$arr=array(task_id=>array(0=>array(),1=>array()...),...)
                }
            }
        }
        
        foreach($arr as $key_task_id=>$value_rows){
            $num=0;
            $all_num=0;
            $pass_rate=0;
            $arg_use_time=0;
            $is_sweep=array();
            $pro_star=array();
            $use_time=array();
            $pro_star_count=array();
            $is_sweep_count=array();
            for($j=0;$j<count($value_rows);$j++){
                $is_sweep[]=(int)$value_rows[$j]['is_sweep'];//数据库取出的is_sweep 的值是string类型，需转为int类型才能用array_count_values()统计
                if($value_rows[$j]['end_state']==1){//挑战胜利情况下
                    $pro_star[]=$value_rows[$j]['pro_star'];
                    $use_time[]=$value_rows[$j]['use_time'];
                    $num++;//挑战胜利次数
                }
                $all_num++;
            }
            $pass_rate=round($num/$all_num*100,2);//挑战胜率
            $pro_star_count=array_count_values($pro_star);//pro_star=>该值出现的次数数（星级=>该星级数）
            if(!$pro_star_count[1]){$pro_star_count[1]=0;}
            if(!$pro_star_count[2]){$pro_star_count[2]=0;}
            if(!$pro_star_count[3]){$pro_star_count[3]=0;}
            $is_sweep_count=array_count_values($is_sweep);//is_sweep=>该值出现的次数数(0=>0的次数，1=>1的次数），1为扫荡次数。
            if(!$is_sweep_count[1]){$is_sweep_count[1]=0;}
            if($num>0){
                $arg_use_time=round(array_sum($use_time)/$num,2);//平均通关时间
            }
            $reslut_arr[]=array('task_id'=>$key_task_id,'challenge_num'=>$all_num,'pass_num'=>$num,'pass_rate'=>$pass_rate,'one_star_pass_num'=>$pro_star_count[1],'two_star_pass_num'=>$pro_star_count[2],'three_star_pass_num'=>$pro_star_count[3],'sweep_num'=>$is_sweep_count[1],'arg_use_time'=>$arg_use_time);
        }
        
        return $reslut_arr;
    }
    throw new Exception("获取sql执行结果出错，可能尚未执行sql<br>");
}




$data = array(
    'serverlist'    =>$serverlist,
    'dataList'      => $dataList,
    'recordCnt'     => $recordCnt,
    'server_role_num' =>$server_role_num,
    'begin_time'    => date('Y/m/d',$begin_time),
    'end_time'      => date('Y/m/d',$end_time),
);
$smarty->assign($data);
$smarty->display("module/keep_active/checkpoint_info.html");
?>
