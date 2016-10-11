<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$id=$_GET['id'];
$query_st="select * from ".T_GM_COMPLAINT." where id='$id'";
$result=mysql_query($query_st);
$rs = mysql_fetch_array($result);

$msgTypeArr = array(1=>"提交BUG",2=>"投诉",3=>"游戏建议",4=>"其他",);
$rs['msgType'] = $msgTypeArr[$rs['type']];

$roleid=$rs['roleid'];
$role_name=$rs['role_name'];
$title=$rs['title'];
$content=$rs['content'];

if(isset($_REQUEST['action']))
{
	$id = (int)$_REQUEST['action'];
	$update = "UPDATE `".T_GM_COMPLAINT."` SET `state` = '1' WHERE `id` ='{$id}' LIMIT 1 ";
	$db->query($update);
}

$pageno = (int)$_REQUEST['page'];
if ($pageno <=0 )
	$pageno = 1;

$resultCount = getRecordCount(T_GM_COMPLAINT);

$count_result = $resultCount;

$pagelist = getPages($pageno, $count_result,LIST_PER_PAGE_RECORDS);
$start = ($pageno - 1) * LIST_PER_PAGE_RECORDS;
$count = LIST_PER_PAGE_RECORDS;
$sql = "SELECT * FROM ".T_GM_COMPLAINT;
$sql .= " ORDER BY id desc" ;
$sql .= " LIMIT {$start},{$count}";
$result = $db->fetchAll($sql);
foreach ($result as $key => $row)
{
	$result[$key]['msgType'] = $msgTypeArr[$row['type']];
}

$smarty->assign(array(
	'page'=>$pageno,
	'rs'=>$result,
	'page_list' => $pagelist,
	'page_count'=> ceil($count_result/LIST_PER_PAGE_RECORDS),
));

$smarty->assign("one_msg", $rs);
$smarty->assign("id",$id);
$smarty->assign("roleid",$roleid);
$smarty->assign("role_name",$role_name);
$smarty->assign("title",$title);
$smarty->assign("content",$content);
$smarty->assign("reply",$reply);
$smarty->display("module/gm/gm_complaint.html");



