<?php
header('Content-type: text/html; charset=utf-8');
$end_time=strtotime(date('Y-m-d H:i:s'));//此时时刻
$getdata=new DBClass();

//获取单服角色总数
$sql_num='SELECT DISTINCT id FROM player';

//获取单服流失玩家总数
 $lost_num_sql='SELECT count(*) FROM player WHERE  '.$end_time.' - player.logout_time > 86400';
if($server !=='all'){
    $result=$getdata->query_s($server,$lost_num_sql);
    $server_num=mysql_fetch_row($result);
    $server_num=$server_num[0];//单服流失总数
    
    $server_role_num_result=$getdata->query_s($server,$sql_num);
    $server_role_num=mysql_num_rows($server_role_num_result);//单服角色总数
}

//获取所有服流失玩家总数
$all_server_num=0;
for($i=0;$i<count($dbarray);$i++){
    $lost_num_sql='SELECT count(*) FROM '.$dbarray[$i].'.player WHERE  '.$end_time.' - player.logout_time > 86400';
    $result=$getdata->query_s($dbarray[$i],$lost_num_sql);
    $server_lost=mysql_fetch_row($result);
    $all_server_num +=$server_lost[0];
}
