<?php
/*
 * Author: wangxuefeng@4399.com
 * 充值统计
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
$sql = 'SELECT year , month , day , round(sum(pay_money)/100,2) as pay_day FROM `db_pay_log_p` '
        . ' where `pay_time` >= ' .
        $dateStartStamp .
        ' and pay_time <= ' .
        $dateEndStamp
        . ' group by year , month , day order by year, month, day desc'; 
$alllist = GFetchRowSet($sql);
$count_result = count($alllist);

for($i=1;$i<= $per_page_record;$i++)
{
	if( $i+$startno > $count_result )
	{
		break;
	}
	$keywordlist[$i-1] = $alllist[$startno+$i-1];
	$keywordlist[$i-1]['id'] = $startno+$i;
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
$smarty->display("module/pay/pay_statistic.html");

function getExcel( $alllist )
{
	$excel = array();

	// 标题
	$excel['title'] = '充值排行';
	// 表头
	$excel['hd'] =  array(
			'账号',
			'充值金额'
			);
	// 列数
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($alllist as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['year'].'年'.$v['month'].'月'.$v['day'].'日');
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pay_day']);
	}
	return $excel;
}

function getTotalMoney($tablename)
{
	$sql = "select SUM(pay_money) as s from  ".$tablename;
	$row = GFetchRowOne($sql);
	return $row['s'];
}