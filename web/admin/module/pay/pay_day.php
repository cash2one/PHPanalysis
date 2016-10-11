<?php
/*
 * Author: wangxuefeng@4399.com
 * 充值分天统计
 */


define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

$tablename = "db_pay_log_p";
$balance_fen = getTotalMoney($tablename);
$balance = floatval($balance_fen/100);

if ( !isset($_REQUEST['dateStart'])){
	$start_day = GetTime_Today0() - 7*86400;
	$dateStart = strftime("%Y-%m-%d",$start_day);
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}

if ( !isset($_REQUEST['dateEnd']))
{
	$dateEnd = strftime ("%Y-%m-%d", time() );
}
else
{
	$dateEnd = trim(SS($_REQUEST['dateEnd']));
}

$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);


$pageno = getUrlParam('page');
$ex = SS($_REQUEST['excel']);
$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$sql = 'SELECT pay_time, from_unixtime(pay_time, \'%Y\') as year , from_unixtime(pay_time, \'%m\') as month , from_unixtime(pay_time, \'%d\') as day ,'.
		' round(sum(pay_money)/100+sum(pay_ticket)/10,2) as pay_day_total, round(sum(pay_money)/100,2) as pay_day_qq, round(sum(pay_ticket)/10,2) as pay_day_ticket, count(distinct role_id) as role_cnt,' .
		' count(role_id) as times_cnt, round((sum(pay_money)/100+sum(pay_ticket)/10)/(count(distinct role_id)), 2) as arpu' .
		' FROM `db_pay_log_p` where `pay_time` >= '.$dateStartStamp .' and pay_time <= ' .$dateEndStamp
        //. ' group by year , month , day order by year desc, month desc, day desc'; 
        . ' group by from_unixtime(pay_time, \'%Y\') , from_unixtime(pay_time, \'%m\') , from_unixtime(pay_time, \'%d\') order by year desc, month desc, day desc';
$alllist = GFetchRowSet($sql);
//print_r($alllist);
$count_result = count($alllist);

for($i=1;$i<= $per_page_record;$i++)
{
	if( $i+$startno > $count_result )
	{
		break;
	}
	$keywordlist[$i-1] = $alllist[$startno+$i-1];
	$keywordlist[$i-1]['id'] = $startno+$i;
	
	//test
	$week_str = date('w', $alllist[$startno+$i-1]['pay_time']);
	$keywordlist[$i-1]['week'] = $week_str;
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
	$pay_data_total .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].'),' .$row['pay_day_total'].']';

	$pay_data_qq .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].'),' .$row['pay_day_qq'].']';
	
	$pay_data_ticket .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].'),' .$row['pay_day_ticket'].']';

	$times_cnt_data .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].'),' .$row['times_cnt'].']';

	$role_cnt_data .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].'),' .$row['role_cnt'].']';

	$arpu_data .= '[Date.UTC('.$row['year'].','.$row['month'].'-1,'.$row['day'].'),' .$row['arpu'].']';
	
	$flag = true;
}

$pagelist	= getPages($pageno, $count_result, $per_page_record);

if(isset($ex) && $ex == true )
{
	$excel = getExcel($alllist);
    $smarty->assign('title', $excel['title']); // 标题
    $smarty->assign('hd', $excel['hd']);       // 表头
    $smarty->assign('num',$excel['hdnum']);    // 列数
    $smarty->assign('ct', $excel['content']);  // 内容

    // 输出文件头，表明是要输出 excel 文件
    header('Content-type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename='.$excel['title'].date('_Ymd_Gi').'.xls');
    $smarty->display('module/pay/pay_excel.tpl');
    exit;
}

$smarty->assign("balance", $balance);
$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);
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

$smarty->display("module/pay/pay_day.html");

function getExcel( $alllist )
{
	$excel = array();

	// 标题
	$excel['title'] = '充值分天统计';
	// 表头
	$excel['hd'] = array('日期','总金额(元)','Q点金额(元)','代金券金额(元)','人次','人数','ARPU值');

	// 列数
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($alllist as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['year'].'年'.$v['month'].'月'.$v['day'].'日');
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pay_day_total']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pay_day_qq']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pay_day_ticket']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['times_cnt']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_cnt']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['arpu']);
	}
	return $excel;
}

function getTotalMoney($tablename)
{
	$sql = "select SUM(pay_money)+SUM(pay_ticket)*10 as s from  ".$tablename;
	$row = GFetchRowOne($sql);
	return $row['s'];
}