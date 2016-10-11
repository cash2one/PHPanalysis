<?php
error_reporting(1);
include('createdb.config.php');
header('Content-type: text/html; charset=utf-8');
set_time_limit(0);//设置一个脚本的执行时间为无限长

/*============== 获取服务器列表 =====================*/
$sql_serlist='SELECT svr_id FROM serverlists';//获取服务器列表
$conn=mysqli_connect($svr_host,$svr_username,$svr_password,$svr_dbname,$svr_port) or die('服务器列表数据库连接失败');//连接对应数据库
mysqli_set_charset($conn,'utf8');
$result=mysqli_query($conn,$sql_serlist);
$row=array();
$rows=array();
while($row=mysqli_fetch_array($result)){
   array_push($rows,$row[0]);
}
//print_r($rows);

$local_db_conn=mysql_connect($Host,$Username,$Password) or die('本地数据库连接失败');//连接对应数据库
mysql_set_charset($local_db_conn,'utf8');

//获取本地所有数据库
$db_list = mysql_list_dbs($local_db_conn);
$dbs=array();
while ($row = mysql_fetch_object($db_list)) {
    array_push($dbs,$row->Database);
}

/*===================   加载sql语句并执行  ====================*/
//创建所有库
if($tag=='create'){
    for($i=0;$i<count($rows);$i++){
        $dbname=$DBpre.$rows[$i];
        //服务器列表新增的服但本地没有相应数据库，则建立，若本地已有该数据库，则忽略
        if(!in_array($dbname,$dbs)){
            $sql=file_get_contents('./createdb.sql');
            $arr = array("CREATE DATABASE `{$dbname}`;","USE `{$dbname}`;");
            $arr += explode(';',$sql);
            foreach ($arr as $arr_sql){
                //echo $arr_sql.'<br>';
                if(!mysql_query($local_db_conn,$arr_sql)){
                    echo $dbname.'操作失败<br>'.mysql_error();
                }
            }
        }
    }
}
//删除所有库
if($tag=='drop'){
    for($i=0;$i<count($rows);$i++){
        $dbname=$DBpre.$rows[$i];
        $arr_sql= "DROP DATABASE `{$dbname}`;";
        if(mysql_query($local_db_conn,$arr_sql)){
            //echo '删除成功！';
        }
    } 
}
//截位所有库
if($tag=='truncate'){
    
}
if($tag==''){
    
}

?>