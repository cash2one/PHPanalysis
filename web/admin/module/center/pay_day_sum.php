<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

if ( !isset($_REQUEST['dStartTime'])){
	$dStartTime = date("Y-m-01",time());
}
else
{
	$dStartTime  = trim(SS($_REQUEST['dStartTime']));
}

if ( !isset($_REQUEST['dEndTime']))
{
	$dEndTime = strftime ("%Y-%m-%d", time() );
}
else
{
	$dEndTime = trim(SS($_REQUEST['dateEnd']));
}

$lastDay = date( "Y-m-d",(time()-86400));
$lastWeek = date("Y-m-d", (time()-86400*7)); 

//echo $dStartTime;echo "<br>";
//echo $dEndTime;echo "<br>";
//echo $lastDay;echo "<br>";
//echo $lastWeek;echo "<br>";
 
$smarty->assign("dStartTime", $dStartTime);
$smarty->assign("dEndTime", $dEndTime);
$smarty->assign("lastDay", $lastDay);
$smarty->assign("lastWeek", $lastWeek);


$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->display("module/center/pay_day_sum.html");
