<?php
/*
 * Author: dqj
 * 2010-1-6
 *
 */
$_DCACHE = null;
define('IN_DATANG_SYSTEM', true);

global $smarty;
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';

if ( !isset($_REQUEST['dateStart']))
	$dateStart = strftime ("%Y-%m-%d", time()-7*86400);
else if ( $_REQUEST['dateStart'] == 'ALL') {
    $dateStart  = SERVER_ONLINE_DATE;
}
else
	$dateStart  = trim(SS($_REQUEST['dateStart']));

if ( !isset($_REQUEST['dateEnd']))
	$dateEnd = strftime ("%Y-%m-%d", time() );
else if ( $_REQUEST['dateStart'] == 'ALL') {
    $dateEnd = strftime ("%Y-%m-%d", time() );
}
else
	$dateEnd = trim(SS($_REQUEST['dateEnd']));

$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

$dateStrPrev  = strftime ("%Y-%m-%d", $dateStartStamp - 86400);
$dateStrToday = strftime ("%Y-%m-%d");
$dateStrNext  = strftime ("%Y-%m-%d", $dateStartStamp + 86400);

$where_or = makeOrSqlFromArray('mtype' , LogGoldClass::getSpendTypeList());

$sql = "SELECT g.`user_id`, g.`user_name`, g.`account_name`,SUM(g.`gold_bind`)+SUM(g.`gold_unbind`) as ug, SUM(g.`gold_bind`) as gb, SUM(g.`gold_unbind`) as gub, e.last_offline_time, e.is_online".
		" FROM `t_log_use_gold` as g, `db_role_ext_p` as e" .
		" WHERE g.`user_id`=e.`role_id` AND g.gold_unbind>=0 AND g.`mtime` >={$dateStartStamp} AND g.`mtime` <= {$dateEndStamp} AND " .
		$where_or.
		" GROUP BY user_id ORDER BY gub DESC LIMIT 0, 100";
$rs = GFetchRowSet($sql);
foreach ($rs as $key=>$value)
{
	$second_cnt = time()-$value['last_offline_time']; 
	$rs[$key]['left_day'] = intval($second_cnt/3600/24);
	$rs[$key]['left_h_m'] = intval(($second_cnt%86400)/3600).'时'.date('i分s秒',$second_cnt);
}

//var_export($rs);

$smarty->assign("rs",$rs);

$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);

$smarty->assign("dateStrPrev", $dateStrPrev);
$smarty->assign("dateStrNext", $dateStrNext);
$smarty->assign("dateStrToday", $dateStrToday);

$smarty->display("module/pay/gold_use_list.html");

