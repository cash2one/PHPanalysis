<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;


if(isset($_GET['action'])){
    $uid = $_GET['uid'];
    $user_name = $_GET['username'];
    $sql_delete = 'delete from '.T_ADMIN_USER.' where uid='.$uid;
    $db->query($sql_delete);
    $loger = new AdminLogClass();
    $loger->Log( AdminLogClass::TYPE_SYS_DELETE_ADMIN,'', '','', $uid, $user_name);
    echo '<script language="javascript">window.alert("删除成功！");</script>';
}



$whichpage = $_GET['whichpage'];
if(!$whichpage) {
    $notepage=1;
}
else {
    $notepage=$whichpage;
}
$pagesize=25;
$noterecs=($notepage-1)*$pagesize;


$sql_group = 'select gid, name from t_group ';
$result_group = $db->fetchAll($sql_group);
$group = array();
foreach($result_group as $v){
    $group[$v['gid']] = $v['name'];
}

$query_st="select *  from ".T_ADMIN_USER." ORDER BY uid asc";
$result=mysql_query($query_st);
$rsnum=mysql_num_rows($result);
$pagecount=ceil($rsnum/$pagesize);
mysql_data_seek($result,($notepage-1)*15);
$query_st="select * from ".T_ADMIN_USER." limit $noterecs,$pagesize";
$result=mysql_query($query_st);
while($rs = mysql_fetch_array($result)){
    $agent_name = $AGENT_NAME;
    $agent_auth_array = explode(' ', $rs['agent_id']);
    $agent_auth = '';
    if(is_array($agent_auth_array)){
    	foreach($agent_auth_array as $v){
            $agent_auth .= $agent_name[$v]. ' ';
    	}
    }
    $rs['agent_auth'] = $agent_auth;
    $rs['gname'] = $group[$rs['gid']];
    $data[] = $rs;
}

$noterecs=$noterecs+1;
$fisrt=1;
$prev=$whichpage-1;
$next=$whichpage+1;
$last=$pagecount;
$start = "<a href='admin_list2.php?whichpage=".$fisrt."'>首页</a></font>&nbsp;&nbsp";
if($whichpage>1) {
    $start.= "<a href='admin_list2.php?whichpage=".$prev."'>上一页</a> ";
}
for($counter=1;$counter<=$pagecount;$counter++) {
    $start.= ("<font size=+1 color=red><a href='admin_list2.php?whichpage=$counter'>".$pad.$counter."</a></font>&nbsp;&nbsp;");
}
if($whichpage < $pagecount) {
    $start.= "<a href='admin_list2.php?whichpage=".$next."'>下一页</a> ";
}
$start.= "<a href='admin_list2.php?whichpage=".$pagecount."'>尾页</a> ";
$start.= "总页数（".$pagecount."）";
$start.= "共".$rsnum."条记录";

$smarty->assign('whichpage',$whichpage);
$smarty->assign('group',$group);
$smarty->assign('test',$test);
$smarty->assign("page",$start);
$smarty->assign("data",$data);
$smarty->display('module/backstat/admin_list2.html');