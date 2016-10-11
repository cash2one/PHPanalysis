<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

//$server_stat = array(1=>'开服',2=>'合服',3=>'关服',4=>'未开服');
//$server_type = array(1=>'简体服',2=>'繁体服',3=>'越南服',4=>'测试服',5=>'其他用途');


//installize  mysql
//$sql_agent = "select agent_id,agent_name  from agent_info ";
//$agent = $db->fetchAll($sql_agent);
//if(count($agent<1)){
//        foreach($AGENT_NAME as $k=>$v) {
//        $sql = "insert ignore into agent_info(agent_id,agent_name) values($k,'$v')";
//        $db->query($sql);
//
//        $agent = $ALL_SERVER_LIST[$k];
//        $sql_server = 'INSERT ignore INTO `ming2_game`.`all_server_info` (`agent_id` ,`server_id` ,`s_type` ,`ip` ,`domain_name` ,`stat` ,`open_time` ,`combine_time` ,`close_time` ,`s_desc`)VALUES ';
//        $flag = 0;
//        foreach($agent as $key=>$value) {
//            $url = $value['url'];
//            $desc = $value['desc'];
//            $stat = $value['stat'];
//            $rs = parse_url($value['url']);
//            $url = $rs['host'];
//            $ip = gethostbyname($url);
//
//            $open_time = $stat!=4?strtotime('2011-1-1 00:00:00'):0;
//            $close_time = $stat==3?$open_time:'';
//            $combine_time = $stat==2?$open_time:'';
//            if($flag) $sql_server .=',';
//            $sql_server .= "($k,$key,1,'$ip','$url',$stat,'$open_time','$combine_time','$close_time','$desc')";
//            $flag = 1;
//        }
//
//        $db->query($sql_server);
//    }
//}

$action = isset($_REQUEST['radio_agent'])?$_REQUEST['radio_agent']:0;

if(!empty($_REQUEST['radio_agent'])){
    $agent_id = $_REQUEST['radio_agent'];
    $where .= " and agent_id=$agent_id";
    $condition .= "radio_agent=$agent_id&";
}
if(!empty($_REQUEST['domainName'])){
    $domain_name = $_REQUEST['domainName'];
    $where .= " and domain_name='$domain_name'";
    $condition .= "domain_name='$domain_name'&";
}
if(!empty($_REQUEST['serverID'])){
    $server_id = $_REQUEST['serverID'];
    $where .= " and server_id=$server_id ";
    $condition .= "domainName=$server_id&";
}
if(!empty($_REQUEST['ip'])){
    $ip = $_REQUEST['ip'];
    $where .= " and ip='$ip' ";
    $condition .= "ip='$ip'&";
}
if(!empty($_REQUEST['serverStatus'])){
    $stat = $_REQUEST['serverStatus'];
    $where .= " and stat=$stat ";
    $condition .= "serverStatus=$stat&";
}
if(!empty($_REQUEST['serverType'])){
    $type = $_REQUEST['serverType'];
    $where .= " and s_type=$type ";
    $condition .= "serverType=$type&";
}


$whichpage = $_REQUEST['whichpage'];
if(!$whichpage) {
    $whichpage=$notepage=1;
}
else {
    $notepage=$whichpage;
}
$pagesize=15;
$noterecs=($notepage-1)*$pagesize;



$sql_agent = "select agent_id,agent_name  from agent_info ";
$agent = $db->fetchAll($sql_agent);
foreach($agent as $value){
    $agent_id = $value['agent_id'];
    $agent_name = $value['agent_name'];
    $format_agent[$agent_id] = $agent_name;
}


$sql_server="select * from all_server_info where 1  $where";
$result=$db->fetchAll($sql_server);
$rsnum=count($result);
$pagecount=ceil($rsnum/$pagesize);

$sql_rt = "select * from all_server_info where 1  $where  order by agent_id,server_id  limit $noterecs,$pagesize";

$result = $db->fetchAll($sql_rt);

if($action == 0) {
    $chart_name = $AGENT_NAME;
    $chart_name[0] = $buf_lang['left']['all_agents'];
} else {
    foreach($ALL_SERVER_LIST[$action] as $key=>$value) {
        $chart_name[$key] = $value['desc'];
    }
    $chart_name[0] = $AGENT_NAME[$action];
}


$server_stat = array(1=>'开服',2=>'合服',3=>'关服',4=>'未开服');
$server_type = array(1=>'简体服',2=>'繁体服',3=>'越南服',4=>'测试服',5=>'其他用途');

$html = '';
$i = $noterecs+1;

foreach($result as $key=>$value){
    $id = $value['id'];
    $agent_name= $format_agent[$value['agent_id']];
    $agent_id = $value['agent_id'];
    $server_id = $value['server_id'];
    $url = $value['domain_name'];
    $ip = $value['ip'];
    $type = $value['s_type'];
    $stat = $value['stat'];
    $desc = $value['s_desc'];
    $open_time =  $value['open_time']>0?date('Y-m-d H:i:s',$value['open_time']):'';
    $combine_time =  $value['combine_time']>0?date('Y-m-d H:i:s',$value['combine_time']):'';
    $close_time =  $value['close_time']>0?date('Y-m-d H:i:s',$value['close_time']):'';
    $time = '开服:' . $open_time. '<br>'.'合服:' .$combine_time.'<br>'.'关服:' .$close_time .'<br>';
    if($i%2==0) $tr = "<tr class='trEven' align='center'>";
    else
        $tr = "<tr class='trOdd' align='center'>";
    $tr .= "
            <td>$i</td><td>$agent_name</td><td>S$server_id</td><td><a target='blank' href='http://$url/game.php' >$url</a>
    </td>
            <td>$ip</td><td>$server_type[$type]</td><td>$server_stat[$stat]</td>
            <td>$desc</td><td align='left'>$time</td><td><a href='server_manage.php?id=$id&action=update'>修改</a>|<a  href='all_server_info.php?id=$id&action=delete'>删除</a></td>
             </tr>  ";

$html .=$tr;
    $i++;
}


$noterecs=$noterecs+1;
$fisrt=1;
$prev=$whichpage-1;
$next=$whichpage+1;
$last=$pagecount;
$start = "<a href='all_server_info.php?$condition"."whichpage=".$fisrt."'>首页</a></font>&nbsp;&nbsp";
if($whichpage>=1) {
    $start.= "<a href='all_server_info.php?$condition"."whichpage=".$prev."'>上一页</a> ";
}
$first = -3;
if($whichpage+$first>0)
        $page = $whichpage+$first;
for($counter=1;$counter<=5;$counter++) {
    
    $page_num=$page+$counter;
    if($page_num>$pagecount)
        break;
    if($page_num==$whichpage) $page_num = '<font color="red"><b>'.$page_num.'</b></font>';
    $start.= ("<font size=+1 color=red><a href='all_server_info.php?$condition"."whichpage=$page_num'>".$page_num."</a></font>&nbsp;&nbsp;");
}
if($whichpage < $pagecount) {
    $start.= "<a href='all_server_info.php?$condition"."whichpage=".$next."'>下一页</a> ";
}
$start.= "<a href='all_server_info.php?$condition"."whichpage=".$pagecount."'>尾页</a> ";
$start.= "总页数（".$pagecount."）";
$start.= "共".$rsnum."条记录";




$smarty->assign('agent',$_REQUEST['radio_agent']);
$smarty->assign('stat',$_REQUEST['serverStatus']);
$smarty->assign('type',$_REQUEST['serverType']);
$smarty->assign('server_id',$_REQUEST['serverID']);
$smarty->assign('domain_name',$_REQUEST['domainName']);
$smarty->assign('ip',$_REQUEST['ip']);

$smarty->assign('whichpage',$whichpage);
$smarty->assign("page",$start);
$smarty->assign('html',$html);
$smarty->assign("allAgentName", $format_agent);
$smarty->display('module/center/all_server_info.html');




function install_info($AGENT_NAME,$ALL_SERVER_LIST) {
    global $db;
    // print_r($AGENT_NAME);
    // print_r($ALL_SERVER_LIST);

    foreach($AGENT_NAME as $k=>$v) {
        $sql = "insert ignore into agent_info(agent_id,agent_name) values($k,'$v')";
        $db->query($sql);

        $agent = $ALL_SERVER_LIST[$k];
        $sql_server = 'INSERT ignore INTO `ming2_game`.`all_server_info` (`agent_id` ,`server_id` ,`s_type` ,`ip` ,`domain_name` ,`stat` ,`open_time` ,`combine_time` ,`close_time` ,`s_desc`)VALUES ';
        $flag = 0;
        foreach($agent as $key=>$value) {
            $url = $value['url'];
            $desc = $value['desc'];
            $stat = $value['stat'];
            $rs = parse_url($value['url']);
            $url = $rs['host'];
            $ip = gethostbyname($url);

            $open_time = $stat!=4?strtotime('2011-1-1 00:00:00'):0;
            $close_time = $stat==3?$open_time:'';
            $combine_time = $stat==2?$open_time:'';
            if($flag) $sql_server .=',';
            $sql_server .= "($k,$key,1,'$ip','$url',$stat,'$open_time','$combine_time','$close_time','$desc')";
            $flag = 1;
        }

        $db->query($sql_server);
    }

}