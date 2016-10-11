<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

if(isset($_REQUEST['datestart']))
{
	$start = strtotime(trim(SS($_REQUEST['datestart'])));
}
else
{
	$start = strtotime(strftime("%Y-%m-%d",time()-7*86400));
}
if(isset($_REQUEST['dateend']))
{
	$end = strtotime(trim(SS($_REQUEST['dateend'])));
}
else
{
	$end = strtotime(strftime("%Y-%m-%d"));
}
$endtime = $end+86400;
if( $_REQUEST['datestart'] > $_REQUEST['dateend'] )
{
echo "<script type=\"text/javascript\">alert(\"统计开始时间大于结束时间，请认真选择统计时间！\")</script>";
exit();
}
$sql_total_user = "SELECT COUNT(`role_id`) as total FROM `db_role_base_p` WHERE 1";
$total_result = $db->fetchOne($sql_total_user);
$total_user = $total_result['total'];

$one_day = getOneDay();

$one_day_result = array();



$sql_all = "SELECT e.last_offline_time, b.create_time , b.role_id FROM db_role_base_p as b, db_role_ext_p as e"
            . " WHERE b.role_id = e.role_id "
            . " AND b.create_time >={$start} AND b.create_time <= {$endtime}";
$all_user_login_info = GFetchRowSet($sql_all);
$count_all_user = count($all_user_login_info);

//echo '<pre>';print_r($all_user_login_info);exit;
//echo $count_all_user;exit;


//1小时内的流失数据
foreach($one_day as $key=>$value)
{
	$time_begin = $value['time_begin']*60;
	$time_end = $value['time_end']*60;
	
	/*$sql = "SELECT COUNT(b.role_id) as num FROM db_role_base_p as b, db_role_ext_p as e"
	. " WHERE b.role_id = e.role_id AND e.last_offline_time-b.create_time > ".$time_begin
	. " AND e.last_offline_time-b.create_time <= ".$time_end
	. " AND b.create_time >={$start} AND b.create_time <= {$endtime}";
	$result = $db->fetchOne($sql);*/
	$num = 0;
	foreach($all_user_login_info as $u_key => $u_value )
	{
		if(
            ($u_value['last_offline_time'] - $u_value['create_time']) > $time_begin
            &&
            ($u_value['last_offline_time'] - $u_value['create_time']) <= $time_end
        )
		$num++;
	}
		$one_day_result[$key]['desc'] = $value['desc'];
		$one_day_result[$key]['num'] = $num;
		$one_day_result[$key]['rate'] = round(intval($num)*100/$count_all_user, 2);
		
	
}
//echo '<pre>';print_r($one_day_result);exit;
//1个月内的流失数据
$one_month = getOneMonth();
$one_month_result = array();
foreach($one_month as $key=>$value)
{
	$time_begin = $value['time_begin']*86400;
	$time_end = $value['time_end']*86400;
	$num = 0;
	foreach($all_user_login_info as $u_key => $u_value )
	{
		if(($u_value['last_offline_time'] - $u_value['create_time']) > $time_begin && ($u_value['last_offline_time'] - $u_value['create_time']) <= $time_end )
		$num++;
	}
	$one_month_result[$key]['desc'] = $value['desc'];
	$one_month_result[$key]['num'] = $num;
	$one_month_result[$key]['rate'] = round(intval($num)*100/$count_all_user, 2);
}

$time_thirty_one = 31 * 86400;
$sql_one = "SELECT COUNT(b.role_id) as num FROM db_role_base_p as b, db_role_ext_p as e"
	. " WHERE b.role_id = e.role_id AND e.last_offline_time-b.create_time >= ".$time_thirty_one
	. " AND b.create_time >={$start} AND b.create_time <= {$endtime}";
$tmp_result = $db->fetchOne($sql_one);
$thirty_one = array( "31"=>
	array(
	"desc"=>'30'.$buf_lang['conmon']['day'].$buf_lang['conmon']['more_than'],
	"num"=> $tmp_result['num'],
	"rate"=> round(intval($tmp_result['num'])*100/$total_user, 2),
	)
);
$smarty->assign("count_all_user", $count_all_user);
$smarty->assign("start", $start);
$smarty->assign("end", $end);
$smarty->assign("total_user", $total_user);
$smarty->assign("one_day_result", $one_day_result);
$smarty->assign("one_month_result", array_merge($one_month_result, $thirty_one));
$smarty->display("module/register/time_lost_rate.html");

function getOneDay()
{
	global $buf_lang;
	return array(
		array("time_begin"=>0, "time_end"=>1, "desc"=>$buf_lang['left']['not_enough'].'1'.$buf_lang['conmon']['minute']),
		array("time_begin"=>1, "time_end"=>2, "desc"=>'1-2'.$buf_lang['conmon']['minute']),
		array("time_begin"=>2, "time_end"=>3, "desc"=>'2-3'.$buf_lang['conmon']['minute']),
		array("time_begin"=>3, "time_end"=>4, "desc"=>'3-4'.$buf_lang['conmon']['minute']),
		array("time_begin"=>4, "time_end"=>5, "desc"=>'4-5'.$buf_lang['conmon']['minute']),
		array("time_begin"=>5, "time_end"=>6, "desc"=>'5-6'.$buf_lang['conmon']['minute']),
		array("time_begin"=>6, "time_end"=>7, "desc"=>'6-7'.$buf_lang['conmon']['minute']),
		array("time_begin"=>7, "time_end"=>8, "desc"=>'7-8'.$buf_lang['conmon']['minute']),
		array("time_begin"=>8, "time_end"=>9, "desc"=>'8-9'.$buf_lang['conmon']['minute']),
		array("time_begin"=>9, "time_end"=>10, "desc"=>'9-10'.$buf_lang['conmon']['minute']),
		array("time_begin"=>10, "time_end"=>11, "desc"=>'10-11'.$buf_lang['conmon']['minute']),
		array("time_begin"=>11, "time_end"=>12, "desc"=>'11-12'.$buf_lang['conmon']['minute']),
		array("time_begin"=>12, "time_end"=>13, "desc"=>'12-13'.$buf_lang['conmon']['minute']),
		array("time_begin"=>13, "time_end"=>14, "desc"=>'13-14'.$buf_lang['conmon']['minute']),
		array("time_begin"=>14, "time_end"=>15, "desc"=>'14-15'.$buf_lang['conmon']['minute']),
		array("time_begin"=>15, "time_end"=>20, "desc"=>'15-20'.$buf_lang['conmon']['minute']),
		array("time_begin"=>20, "time_end"=>25, "desc"=>'20-25'.$buf_lang['conmon']['minute']),
		array("time_begin"=>25, "time_end"=>30, "desc"=>'25-30'.$buf_lang['conmon']['minute']),
		array("time_begin"=>30, "time_end"=>35, "desc"=>'30-35'.$buf_lang['conmon']['minute']),
		array("time_begin"=>35, "time_end"=>40, "desc"=>'35-40'.$buf_lang['conmon']['minute']),
		array("time_begin"=>40, "time_end"=>45, "desc"=>'40-45'.$buf_lang['conmon']['minute']),
		array("time_begin"=>45, "time_end"=>50, "desc"=>'45-50'.$buf_lang['conmon']['minute']),
		array("time_begin"=>50, "time_end"=>55, "desc"=>'50-55'.$buf_lang['conmon']['minute']),
		array("time_begin"=>55, "time_end"=>60, "desc"=>'55-60'.$buf_lang['conmon']['minute']),
		array("time_begin"=>60, "time_end"=>120, "desc"=>'1-2'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>120, "time_end"=>180, "desc"=>'2-3'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>180, "time_end"=>240, "desc"=>'3-4'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>240, "time_end"=>300, "desc"=>'4-5'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>300, "time_end"=>360, "desc"=>'5-6'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>360, "time_end"=>420, "desc"=>'6-7'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>420, "time_end"=>480, "desc"=>'7-8'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>480, "time_end"=>540, "desc"=>'8-9'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>540, "time_end"=>600, "desc"=>'9-10'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>600, "time_end"=>900, "desc"=>'10-15'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>900, "time_end"=>1200, "desc"=>'15-20'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>1200, "time_end"=>1440, "desc"=>'20-24'.$buf_lang['conmon']['one_hour']),
	);
}

function getOneMonth()
{
	global $buf_lang;
	return array(
		array("time_begin"=>0, "time_end"=>1, "desc"=>$buf_lang['left']['not_enough'].'24'.$buf_lang['conmon']['one_hour']),
		array("time_begin"=>1, "time_end"=>2, "desc"=>'1'.$buf_lang['conmon']['day']),
		array("time_begin"=>2, "time_end"=>3, "desc"=>'2'.$buf_lang['conmon']['day']),
		array("time_begin"=>3, "time_end"=>4, "desc"=>'3'.$buf_lang['conmon']['day']),
		array("time_begin"=>4, "time_end"=>5, "desc"=>'4'.$buf_lang['conmon']['day']),
		array("time_begin"=>5, "time_end"=>6, "desc"=>'5'.$buf_lang['conmon']['day']),
		array("time_begin"=>6, "time_end"=>7, "desc"=>'6'.$buf_lang['conmon']['day']),
		array("time_begin"=>7, "time_end"=>8, "desc"=>'7'.$buf_lang['conmon']['day']),
		array("time_begin"=>8, "time_end"=>9, "desc"=>'8'.$buf_lang['conmon']['day']),
		array("time_begin"=>9, "time_end"=>10, "desc"=>'9'.$buf_lang['conmon']['day']),
		array("time_begin"=>10, "time_end"=>11, "desc"=>'10'.$buf_lang['conmon']['day']),
		array("time_begin"=>11, "time_end"=>12, "desc"=>'11'.$buf_lang['conmon']['day']),
		array("time_begin"=>12, "time_end"=>13, "desc"=>'12'.$buf_lang['conmon']['day']),
		array("time_begin"=>13, "time_end"=>14, "desc"=>'13'.$buf_lang['conmon']['day']),
		array("time_begin"=>14, "time_end"=>15, "desc"=>'14'.$buf_lang['conmon']['day']),
		array("time_begin"=>15, "time_end"=>16, "desc"=>'15'.$buf_lang['conmon']['day']),
		array("time_begin"=>16, "time_end"=>17, "desc"=>'16'.$buf_lang['conmon']['day']),
		array("time_begin"=>17, "time_end"=>18, "desc"=>'17'.$buf_lang['conmon']['day']),
		array("time_begin"=>18, "time_end"=>19, "desc"=>'18'.$buf_lang['conmon']['day']),
		array("time_begin"=>19, "time_end"=>20, "desc"=>'19'.$buf_lang['conmon']['day']),
		array("time_begin"=>20, "time_end"=>21, "desc"=>'20'.$buf_lang['conmon']['day']),
		array("time_begin"=>21, "time_end"=>22, "desc"=>'21'.$buf_lang['conmon']['day']),
		array("time_begin"=>22, "time_end"=>23, "desc"=>'22'.$buf_lang['conmon']['day']),
		array("time_begin"=>23, "time_end"=>24, "desc"=>'23'.$buf_lang['conmon']['day']),
		array("time_begin"=>24, "time_end"=>25, "desc"=>'24'.$buf_lang['conmon']['day']),
		array("time_begin"=>25, "time_end"=>26, "desc"=>'25'.$buf_lang['conmon']['day']),
		array("time_begin"=>26, "time_end"=>27, "desc"=>'26'.$buf_lang['conmon']['day']),
		array("time_begin"=>27, "time_end"=>28, "desc"=>'27'.$buf_lang['conmon']['day']),
		array("time_begin"=>28, "time_end"=>29, "desc"=>'28'.$buf_lang['conmon']['day']),
		array("time_begin"=>29, "time_end"=>30, "desc"=>'29'.$buf_lang['conmon']['day']),
		array("time_begin"=>30, "time_end"=>31, "desc"=>'30'.$buf_lang['conmon']['day']),
	);
}



