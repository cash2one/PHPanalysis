<?php
/*
 * Author: zengjintong@4399.com
 * 2011-05-10
 * 交易查询
 */

define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';


if(isset($_REQUEST['dateStart']))
{
	$dateStart = trim(SS($_REQUEST['dateStart']));
	$start = strtotime($dateStart);
}
else
{
	$dateStart = strftime("%Y-%m-%d", time()-1*86400);
	$start = strtotime($dateStart);
}

if(isset($_REQUEST['dateEnd']))
{
	$dateEnd = trim(SS($_REQUEST['dateEnd']));
	$end = strtotime($dateEnd);
}
else
{
	$dateEnd = strftime("%Y-%m-%d") ;
	$end = strtotime($dateEnd);
}



$post_data = isset($_REQUEST['dateEnd']) ? $_REQUEST : array();

$boss_name = trim(SS($_REQUEST['boss_name']));
$map_name = trim(SS($_REQUEST['map_name']));
$map_id = trim(SS($_REQUEST['map_id']));
$type_id = trim(SS($_REQUEST['type_id']));

$pageno = getUrlParam('page');


$sql = "SELECT * FROM t_log_boss_refresh ";
$sqlcondition = "";
$sqlcount = "";

if (!empty($boss_name) || !empty($map_name) || !empty($map_id) || !empty($type_id))
{
	//$sql_role = "SELECT * FROM db_role_base_p WHERE 1 ";
	$sql_map = '';
	if (!empty($boss_name))
	{
		$sql_map .= "  boss_name='{$boss_name}'";
	}
	else if (!empty($map_name))
	{
		$sql_map .= "  map_name='{$map_name}'";
	}
	else if (!empty($map_id))
	{
		$sql_map .= "  map_id='{$map_id}'";
	}
	if($sql_map == '')
	{
		if(!empty($type_id)){
			$sql_map .= " type_id='{$type_id}'";
		}
	}
	else
	{
	   if(!empty($type_id)){
			$sql_map .= " AND  type_id='{$type_id}'";
		}
	}
	$sqlcondition = " WHERE ".$sql_map;
}


if( $start>0 && $end > 0 )
{
	$endtime = $end+86400;
	if( $sqlcondition == "" )
	{
		$sqlcondition .= " WHERE ";
	}
	else
	{
		$sqlcondition .= " AND ";
		$sqlcount .= " AND ";
	}
	$sqlcondition .= " mtime >= ".$start." AND mtime <=".$endtime;
	$sqlcount .= " mtime >= ".$start." AND mtime <=".$endtime;
}

//exit('111111');
$count_result_sql = $sql.$sqlcondition;
$count_result = count(GFetchRowSet($count_result_sql));

$whichpage = isset($_REQUEST['whichpage']) ? $_REQUEST['whichpage'] : 1;
if(!$whichpage) {
    $notepage=1;
}
else {
    $notepage=$whichpage;
}
$pagesize=10;
$noterecs=($notepage-1)*$pagesize;
$pagecount=ceil($count_result/$pagesize);

$sqlpage = $sql.$sqlcondition." ORDER BY mtime DESC LIMIT ".$noterecs." , ".$pagesize;

$keywordlist = GFetchRowSet($sqlpage);
$noterecs=$noterecs+1;
$fisrt=1;
$prev=$whichpage-1;
$next=$whichpage+1;
$last=$pagecount;
if($count_result > 0)
{
	$page = "<a href='boss_refresh.php?whichpage=".$fisrt."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&boss_name=".$boss_name."&map_name=".$map_id."&map_name=".$map_id."&role_id=".$role_id."'>".$buf_lang['conmon']['home_page']."

</a></font>&nbsp;&nbsp";
if($whichpage>1) {
    $page.= "<a href='boss_refresh.php?whichpage=".$prev."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&boss_name=".$boss_name."&map_name=".$map_id."&map_name=".$map_id."&role_id=".$role_id."'>".$buf_lang['conmon']['previous_page']."</a> ";
}
for($counter=1;$counter<=$pagecount;$counter++) {
    $page.= ("<font size=+1 color=red><a href='boss_refresh.php?

whichpage=".$counter."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&boss_name=".$boss_name."&map_name=".$map_id."&map_name=".$map_id."&role_id=".$role_id."'>".$pad.$counter."</a></font>&nbsp;&nbsp;");
}
if($whichpage < $pagecount) {
    $page.= "<a href='boss_refresh.php?whichpage=".$next."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&boss_name=".$boss_name."&map_name=".$map_id."&map_name=".$map_id."&type_id=".$type_id."'>".$buf_lang['conmon']['next_page']."</a> ";
}
$page.= "<a href='boss_refresh.php?whichpage=".$pagecount."&dateStart=".$dateStart."&dateEnd=".$dateEnd."&boss_name=".$boss_name."&map_name=".$map_id."&map_name=".$map_id."&type_id=".$type_id."'>".$buf_lang['conmon']['last_page']."</a> ";
$page.= "".$buf_lang['conmon']['all_page']."（".$pagecount."）";
$page.= "".$buf_lang['conmon']['total'].$rsnum.$buf_lang['conmon']['records']."";
}



$smarty->assign('post1',$_POST);
$smarty->assign('whichpage',$whichpage);
$smarty->assign("page",$page);
$smarty->assign("end", $dateEnd);
$smarty->assign("start", $dateStart);
$smarty->assign("keywordlist", $keywordlist);


$smarty->display("module/analysis/boss_refresh.html");


