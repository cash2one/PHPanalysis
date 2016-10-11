<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

if ( !isset($_REQUEST['dateStart'])){
	
	$dateStart = strftime("%Y-%m-%d", GetTime_Today0()-1*24*3600);
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}


$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateStart . ' 23:59:59');

$sql = "select type, num_type, date from `t_log_treasure` where date >= '{$dateStartStamp}' and date <= '{$dateEndStamp}'  order by date asc";
$result = $db->fetchAll($sql);

foreach($result as $v)
{
	for($i = 1 ; $i <=24 ;$i++)
	{
		if($v['date'] >= ($dateStartStamp+3600*($i-1)) && $v['date'] <= ($dateStartStamp+3600*$i-1) )
		{
			if($v['type'] == 1)
			{
				$times[$v['type']][$i]['times'] += $v['num_type'];
				$times[$v['type']][$i]['time'] = $dateStartStamp+3600*$i;
			}
			else if ($v['type'] == 2)
			{
				$times[$v['type']][$i]['times'] += $v['num_type'];
				$times[$v['type']][$i]['time'] = $dateStartStamp+3600*$i;
			}
		}
	}
}

$data = '';
$flag = false;
if(isset($times[1]) && !empty($times[1]))
{
	foreach($times[1] as $key=>$row)
	{
		if($flag)
		{
			$data .= ',';
		}
		$tmp = '';
		$tmp = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['time']) . '),' .$row['times'].']';
		$data .= $tmp;
		$flag = true;
	}
}
$data2 = '';
$flag2 = false;
if(isset($times[2]) && !empty($times[2]))
{
	foreach($times[2] as $key=>$row)
	{
		if($flag2)
		{
			$data2 .= ',';
		}
		$tmp = '';
		$tmp = '[Date.UTC(2011, 07, 01, '. strftime("%H, %M, %S", $row['time']) . '),' .$row['times'].']';
		$data2 .= $tmp;
		$flag2 = true;
	}
}
//lucky 幸运值触发次数	lucky_clear 幸运值清零次数

$time_sql = "select count(distinct(role_id)) as role_num , type ,SUM(num_type) as times from `t_log_treasure` where date >= '{$dateStartStamp}' and date <= '{$dateEndStamp}' group by type order by date asc";
$re_times = $db->fetchAll($time_sql);
$all_role = $all_times =0;
foreach($re_times as $v)
{
	$all_role += $v['role_num'];
	$all_times += $v['times'];
}
$sql_2 = "select count(distinct(role_id)) as role_num , type, SUM(num_type) as times, sum(lucky) as lucky_num,  sum(lucky_clear) as lucky_clear_num  from `t_log_treasure` where date >= '{$dateStartStamp}' and date <= '{$dateEndStamp}' group by type  order by date asc";

$result_2 = $db->fetchAll($sql_2);

$show = array();
foreach($result_2 as $v)
{
	switch($v['type'])
	{
		case 1:
		   $v['name'] = $buf_lang['new']['dragon_1'];
		   break;
		case 2:
		   $v['name'] =$buf_lang['new']['dragon_2'];
		   break;	   
	 	default:
		   break;  
	}
	$show[] = $v;
}
/*print_r($data);
echo "<br>";
print_r($data2);*/
//exit;
$smarty->assign("dateStart", $dateStart);
$smarty->assign("all_role", $all_role);
$smarty->assign("all_times", $all_times);
$smarty->assign("show", $show);
$smarty->assign("data", $data);
$smarty->assign("data2", $data2);
$smarty->assign(array('onlines' => $result));
$smarty->display("module/analysis/treasure_log.html");

