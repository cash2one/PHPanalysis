<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty;

$maps = getJson ( $erlangWebAdminHost."map_members" );
$rating=array();
$total = 0;
foreach ($maps as $key => $value) {
	$rating[$key] = $value['count'];
	$total += $value['count'];
}
array_multisort($rating,SORT_DESC,$maps);
$smarty->assign ( array ('maps' => $maps ,'total' => $total) );
$smarty->display ( "module/statistics/map_members.html" );

