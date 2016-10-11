<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$date1=trim(SS($_REQUEST['date1']));
$date2=trim(SS($_REQUEST['date2']));
$viewtype=trim(SS($_REQUEST['viewtype']));


if ( !isset($_REQUEST['date1']))
$date1 = strftime ("%Y-%m", time()) . '-01';
else
$date1  = trim(SS($_REQUEST['date1']));
if ( !isset($_REQUEST['date2']))
$date2 = strftime ("%Y-%m-%d", time()) ;
else
$date2  = trim(SS($_REQUEST['date2']));
$date1Stamp = strtotime($date1 . ' 0:0:0');
$date2Stamp   = strtotime($date2 . ' 23:59:59');
if ( !isset($_REQUEST['viewtype']))
$viewtype = 1;

if($viewtype==1){
	$datalist = get_online_hourlist($date1Stamp,$date2Stamp);
	$maxdatalist = get_online_hourmaxlist($date1Stamp,$date2Stamp);
}
elseif($viewtype==2){
	$datalist = get_online_daylist($date1Stamp,$date2Stamp);
	$maxdatalist = get_online_daymaxlist($date1Stamp,$date2Stamp);
}
elseif($viewtype==3){
	$where = '';
	if($_REQUEST['min']){
		$min = $_REQUEST['min'] ;
		$where .= " and min = {$min}" ;
	}
	if($_REQUEST['hour']){
		$hour = $_REQUEST['hour'];
		$where .= " and hour = {$hour}" ;
	}
	$datalist = get_online_5minlist($date1Stamp,$date2Stamp,$where);
	$maxdatalist = get_online_5minmaxlist($date1Stamp,$date2Stamp,$where);
}
elseif($viewtype==4){
	$datalist = get_online_avg($date1Stamp,$date2Stamp);
	$maxdatalist = get_online_max($date1Stamp,$date2Stamp);
	
}


$maxOnline=0;
$avgOnline=0;
$maxDistinctIp=0;
$avgDistinctIp=0;
if(Count($datalist)>0)
{
	foreach($datalist as $id=>$row)
	{
		if($datalist[$id]['avgonline']>$maxOnline)
		{
			$maxOnline=$datalist[$id]['avgonline'];
		}
		$avgOnline+=$datalist[$id]['avgonline'];

		if($datalist[$id]['avg_distinct_ip']>$maxDistinctIp)
		{
			$maxDistinctIp=$datalist[$id]['avg_distinct_ip'];
		}
		$avgDistinctIp+=$datalist[$id]['avg_distinct_ip'];
	}

	$avgOnline=intval($avgOnline/count($datalist));
    //echo $avgOnline/count($datalist);exit;
	$avgDistinctIp = intval($avgDistinctIp/count($datalist));

	foreach($datalist as $id=>$row)
	{
		$rate=1;
		if($maxOnline>150)
		{
			$rate=150/$maxOnline;
		}
		$datalist[$id]['height']=intval($datalist[$id]['avgonline']*$rate);
		$datalist[$id]['distinctIpheight']=intval($datalist[$id]['avg_distinct_ip']*$rate);
		$datalist[$id]['week'] = date('w',strtotime($datalist[$id]['mtime']));
	}
}




$smarty->assign("viewtype", $viewtype);
$smarty->assign("date1", $date1);
$smarty->assign("date2", $date2);
$smarty->assign("maxonline", $maxOnline);
$smarty->assign("avgonline", $avgOnline);
$smarty->assign("datalist", $datalist);
$smarty->assign("maxdatalist", $maxdatalist);
$smarty->assign("hour",$hour);
$smarty->assign("min",$min);
$smarty->display("module/online/online_stat.html");

//取一天的样本计算平均在线
function get_online_daylist($startTime,$overTime){
	global $db;
	$sql= " SELECT floor(avg(`online`)) as avgonline, floor(avg(`distinct_ip`)) as avg_distinct_ip ,`year`,`month`,`day` FROM ".T_LOG_ONLINE." WHERE 1=1 ";
	$sql.=" and dateline>=".$startTime." and dateline<=".$overTime;
	$sql.=" group by year,month,day";
        $sql.=" limit 1000";
	$row = $db->fetchAll($sql);
	return $row;
}

function get_online_daymaxlist($startTime,$overTime){
	global $db;
	$sql= " SELECT max(`online`) as avgonline, max(`distinct_ip`) as avg_distinct_ip ,`year`,`month`,`day` FROM ".T_LOG_ONLINE." WHERE 1=1 ";
	$sql.=" and dateline>=".$startTime." and dateline<=".$overTime;
	$sql.=" group by year,month,day";
        $sql.=" limit 1000";
	$row = $db->fetchAll($sql);
//echo $sql;die;
	return $row;
}

//取一小时的样本计算平均在线
function get_online_hourlist($startTime,$overTime){
	global $db;
	$sql= " SELECT floor(avg(`online`)) as avgonline, floor(avg(`distinct_ip`)) as avg_distinct_ip , `year`,`month`,`day`,`hour` FROM ".T_LOG_ONLINE." WHERE 1=1 ";
	$sql.=" and dateline>=".$startTime." and dateline<=".$overTime;
	$sql.=" group by year,month,day,hour";
        $sql.=" limit 1000";
	$row = $db->fetchAll($sql);
	return $row;
}

function get_online_hourmaxlist($startTime,$overTime){
	global $db;
	$sql= " SELECT max(`online`) as avgonline, max(`distinct_ip`) as avg_distinct_ip , `year`,`month`,`day`,`hour` FROM ".T_LOG_ONLINE." WHERE 1=1 ";
	$sql.=" and dateline>=".$startTime." and dateline<=".$overTime;
	$sql.=" group by year,month,day,hour";
        $sql.=" limit 1000";
	$row = $db->fetchAll($sql);
	return $row;
}

//取5分钟的样本计算平均在线
function get_online_5minlist($startTime,$overTime,$where){
	global $db;
	$sql= " SELECT floor(avg(`online`)) as avgonline, floor(avg(`distinct_ip`)) as avg_distinct_ip , `year`,`month`,`day`,`hour`,`min` FROM ".T_LOG_ONLINE." WHERE 1=1 ";
	$sql.=" and dateline>=".$startTime." and dateline<=".$overTime. $where;
	$sql.=" group by year,month,day,hour,min";
        $sql.=" limit 1000";
	$row = $db->fetchAll($sql);
	return $row;
}

function get_online_5minmaxlist($startTime,$overTime,$where){
	global $db;
	$sql= " SELECT max(`online`) as avgonline, max(`distinct_ip`) as avg_distinct_ip , `year`,`month`,`day`,`hour`,`min` FROM ".T_LOG_ONLINE." WHERE 1=1 ";
	$sql.=" and dateline>=".$startTime." and dateline<=".$overTime. $where;
	$sql.=" group by year,month,day,hour,min";
        $sql.=" limit 1000";
	$row = $db->fetchAll($sql);
	return $row;
}

//取每天最大的 数量
function get_online_max($startTime,$overTime){
	global $db;
	$sql= " SELECT max(`online`) as avgonline, max(`distinct_ip`) as avg_distinct_ip , `year`,`month`,`day`,`hour`,`min` FROM ".T_LOG_ONLINE." WHERE 1=1 ";
	$sql.=" and dateline>=".$startTime." and dateline<=".$overTime;
	$sql.=" group by year,month,day";
        $sql.=" limit 1000";
	$row = $db->fetchAll($sql);
	return $row;
}

function get_online_avg($startTime,$overTime){
	global $db;
	$sql= " SELECT floor(avg(`online`)) as avgonline, floor(avg(`distinct_ip`)) as avg_distinct_ip , `year`,`month`,`day`,`hour`,`min` FROM ".T_LOG_ONLINE." WHERE 1=1 ";
	$sql.=" and dateline>=".$startTime." and dateline<=".$overTime;
	$sql.=" group by year,month,day";
        $sql.=" limit 1000";
	$row = $db->fetchAll($sql);
	return $row;
}

