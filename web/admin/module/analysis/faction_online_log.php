<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include "../../../admin/class/log_gold_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty;

if(!isset($_REQUEST['dateStart'])){
	$dateStart = strftime ("%Y-%m-%d", time()-2*86400);
}else{
	$dateStart = $_REQUEST['dateStart'];
}
if(!isset($_REQUEST['dateEnd'])){
	$dateEnd = strftime("%Y-%m-%d");
}else{
	$dateEnd = $_REQUEST['dateEnd'];
}
$u_start_time = strtotime($dateStart.' 00:00');
$u_end_time = strtotime($dateEnd.' 23:59');



$sql_count = "SELECT * FROM `t_log_faction_online` WHERE mtime>=" .
          $u_start_time .
          " and mtime <=" .
          $u_end_time ;
$count_result = count(GFetchRowSet($sql_count));

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

$sql = "SELECT * FROM `t_log_faction_online` WHERE mtime>=" .
          $u_start_time .
          " and mtime <=" .
          $u_end_time
        . " order by mtime desc LIMIT ".$noterecs." , ".$pagesize;
$result_buf = GFetchRowSet($sql);
$result =array();
foreach($result_buf as $k => $v)
{
	$result[$k] = $v;
	if($v['tonline'] != 0 && $v['sonline'] != 0)
	{
		$result[$k]['t_online_rate'] = round($v['tonline']/($v['tonline'] + $v['sonline']),3) *100;
		$result[$k]['s_online_rate'] = round($v['sonline']/($v['tonline'] + $v['sonline']),3) *100;
	}
	else
	{
		$result[$k]['t_online_rate'] = 0;
		$result[$k]['s_online_rate'] = 0;
	}
}

$noterecs=$noterecs+1;
$fisrt=1;
$prev=$whichpage-1;
$next=$whichpage+1;
$last=$pagecount;

if($count_result > 0)
{
	$page = "<a href='faction_online_log.php?whichpage=".$fisrt."&dateStart=".$dateStart."&dateEnd=".$dateEnd."'>".$buf_lang['conmon']['home_page']."

</a></font>&nbsp;&nbsp";
if($whichpage>1) {
    $page.= "<a href='faction_online_log.php?whichpage=".$prev."&dateStart=".$dateStart."&dateEnd=".$dateEnd."'>".$buf_lang['conmon']['previous_page']."</a> ";
}
for($counter=1;$counter<=$pagecount;$counter++) {
    $page.= ("<font size=+1 color=red><a href='faction_online_log.php?

whichpage=".$counter."&dateStart=".$dateStart."&dateEnd=".$dateEnd."'>".$pad.$counter."</a></font>&nbsp;&nbsp;");
}
if($whichpage < $pagecount) {
    $page.= "<a href='faction_online_log.php?whichpage=".$next."&dateStart=".$dateStart."&dateEnd=".$dateEnd."'>".$buf_lang['conmon']['next_page']."</a> ";
}
$page.= "<a href='faction_online_log.php?whichpage=".$pagecount."&dateStart=".$dateStart."&dateEnd=".$dateEnd."'>".$buf_lang['conmon']['last_page']."</a> ";
$page.= "".$buf_lang['conmon']['all_page']."（".$pagecount."）";
$page.= "".$buf_lang['conmon']['total'].$rsnum.$buf_lang['conmon']['records']."";
}



$smarty->assign("page",$page);
$smarty->assign('whichpage',$whichpage);
$smarty->assign("dateStart", $dateStart);
$smarty->assign("dateEnd", $dateEnd);
$smarty->assign("result", $result);
$smarty->display("module/analysis/faction_online_log.html");
