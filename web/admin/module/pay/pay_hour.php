<?php
/*
 * Author: wangxuefeng@4399.com
 * 充值分时统计
 */

define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

$tablename = "db_pay_log_p";
$balance_fen = getTotalMoney($tablename);
$balance = floatval($balance_fen/100);

if ( !isset($_REQUEST['dateStart'])){
	$start_day = GetTime_Today0();
	$dateStart = strftime("%Y-%m-%d",$start_day);
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}

$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateStart . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);

$pageno = getUrlParam('page');
$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$sql = 'SELECT id, year , month , day , hour, round(sum(pay_money)/100+sum(pay_ticket)/10,2) as pay_day_total, round(sum(pay_money)/100,2) as pay_day_qq, round(sum(pay_ticket)/10,2) as pay_day_ticket, count(distinct role_id) as role_cnt,' .
		' count(role_id) as times_cnt, round((sum(pay_money)/100+sum(pay_ticket)/10)/(count(distinct role_id)), 2) as arpu' .
		' FROM `db_pay_log_p` where `pay_time` >= '.$dateStartStamp.' and pay_time <= '.$dateEndStamp
        . ' group by year , month , day, hour order by year desc, month desc, day desc, hour desc'; 
$alllist = GFetchRowSet($sql);
$count_result = count($alllist);

$day_sum = 0.00;
$day_qq = 0.00;
$day_ticket = 0.00;
$day_role_cnt = 0;
$day_times_cnt = 0;
$day_arpu = 0.00;

for($i=0;$i<$count_result;$i++)
{
	$day_sum += round($alllist[$i]['pay_day_total'], 2);
	$day_qq += round($alllist[$i]['pay_day_qq'], 2);
	$day_ticket += round($alllist[$i]['pay_day_ticket'], 2);
	$day_role_cnt += $alllist[$i]['role_cnt'];
	$day_times_cnt += $alllist[$i]['times_cnt'];
}

if ($day_sum != 0 && $day_role_cnt != 0)
{
	$day_arpu = round($day_sum/$day_role_cnt, 2);
}

for($i=1;$i<= $per_page_record;$i++)
{
	if( $i+$startno > $count_result )
	{
		break;
	}
	$keywordlist[$i-1] = $alllist[$startno+$i-1];
	$keywordlist[$i-1]['id'] = $startno+$i;
}

$pay_data_total = '';
$pay_data_qq = '';
$pay_data_ticket = '';
$times_cnt_data = '';
$role_cnt_data = '';
$arpu_data = '';

$flag = false;
foreach($alllist as $key=>$row)
{
	if($flag)
	{
		$pay_data_total .= ',';
		$pay_data_qq .= ',';
		$pay_data_ticket .= ',';
		$times_cnt_data .= ',';
		$role_cnt_data .= ',';
		$arpu_data .= ',';
	}
	$pay_data_total .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].','.$row['hour'].'),' .$row['pay_day_total'].']';

	$pay_data_qq .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].','.$row['hour'].'),' .$row['pay_day_qq'].']';
	
	$pay_data_ticket .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].','.$row['hour'].'),' .$row['pay_day_ticket'].']';

	$times_cnt_data .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].','.$row['hour'].'),' .$row['times_cnt'].']';
	
	$role_cnt_data .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].','.$row['hour'].'),' .$row['role_cnt'].']';

	$arpu_data .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].','.$row['hour'].'),' .$row['arpu'].']';
	
	$flag = true;
}

$pagelist	= getPages($pageno, $count_result, $per_page_record);

$smarty->assign("balance", $balance);
$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("time_stamp", $dateStartStamp);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));

$smarty->assign("pay_data_total", $pay_data_total);
$smarty->assign("pay_data_qq", $pay_data_qq);
$smarty->assign("pay_data_ticket", $pay_data_ticket);
$smarty->assign("times_cnt_data", $times_cnt_data);
$smarty->assign("role_cnt_data", $role_cnt_data);
$smarty->assign("arpu_data", $arpu_data);

$smarty->assign("day_sum", $day_sum);
$smarty->assign("day_qq", $day_qq);
$smarty->assign("day_ticket", $day_ticket);
$smarty->assign("day_role_cnt", $day_role_cnt);
$smarty->assign("day_times_cnt", $day_times_cnt);
$smarty->assign("day_arpu", $day_arpu);

$smarty->display("module/pay/pay_hour.html");


function getTotalMoney($tablename)
{
	$sql = "select SUM(pay_money)+SUM(pay_ticket)*10 as s from  ".$tablename;
	$row = GFetchRowOne($sql);
	return $row['s'];
}