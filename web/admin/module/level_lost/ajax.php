<?php
header('Content-type: text/html; charset=utf-8');
define('IN_DATANG_SYSTEM', true);
include_once "../../../config/config.php";
include_once SYSDIR_ADMIN.'/include/global.php';
include_once "../../../admin/class/mysql.class.php";

global $host,$dbuser,$password,$dbname,$coding;
$getdata=new MySQL($host,$dbuser,$password,$dbname,'',$coding);

 //get the q parameter from URL
 $svr_id=trim($_GET["svr_id"]);
 
$sql="SELECT clt_vsn,channels FROM serverlists WHERE svr_id=$svr_id";
$result=$getdata->query($sql); 
if($result){
    $serverlist=server_list($result); 
}

if($serverlist){
    $channels_id = implode(",", $serverlist[0]['channels']);
    $channels_id="($channels_id)";
    $sql_cha="SELECT name,tag FROM channels WHERE id in $channels_id";
    $result_cha=$getdata->query($sql_cha); 
    $channelslist=channels_list($result_cha);
}else{
    $response= "no suggestion";
}


function server_list($result){
        $rows = array();
        while (($row = mysql_fetch_assoc($result)) !== false) {
            $row['channels']=json_decode($row['channels'],true);
            array_push($rows, $row);
        }
        return $rows;
}
function channels_list($result){
        $rows = array();
        while (($row = mysql_fetch_assoc($result)) !== false) {
            array_push($rows, $row);
        }
        return $rows;
}

 if($channelslist)
{
    $response="<select name='channels' style='width:100px;' >
        <option value=''>选择渠道</option>";
        for($i=0;$i<count($channelslist);$i++){
             $response .="<option value='".$channelslist[$i]['tag']."' >".$channelslist[$i]['name']."</option>";
        }
    $response .="</select>";
}else{
   $response="无法获取渠道列表";
}
 echo $response;
 ?>