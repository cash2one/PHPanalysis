<?php
/*
 * Author: zengjintong@4399.com
 * 2011-05-04
 * 充值排行
 */


define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

$tablename = "db_pay_log_p";
$balance_fen = getTotalMoney($tablename);
$balance = floatval($balance_fen/100);

$pageno = getUrlParam('page');
$ex = SS($_REQUEST['excel']);
$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$sql = "SELECT p.role_id, e.role_name, p.account_name, round(sum(p.pay_money)/100+sum(p.pay_ticket)/10,2) as pay_all, round(sum(p.pay_money)/100,2) as pay_money, round(sum(p.pay_ticket)/10,2) as pay_ticket, e.last_offline_time, e.is_online".
	   " FROM db_pay_log_p as p, db_role_ext_p as e WHERE p.role_id = e.role_id group by p.role_id order by pay_all desc";

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
	$second_cnt = time()-$alllist[$startno+$i-1]['last_offline_time']; 
	$keywordlist[$i-1]['left_day'] = intval($second_cnt/3600/24);
	$keywordlist[$i-1]['left_h_m'] = intval(($second_cnt%86400)/3600).'时'.date('i分s秒',$second_cnt);
}

//foreach($alllist as $key=>$value)
//{
//	$keywordlist[$key]['left'] = strftime("%d", (time() - $value['last_offline_time']));
//}

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
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));
$smarty->display("module/pay/pay_list.html");


function getExcel( $alllist )
{
	//$sqlex  = "SELECT account_name,sum(pay_money)/100 pay_all FROM db_pay_log_p group by account_name order by pay_all desc";

	//$row_all = GFetchRowSet($sqlex);
	for($i=1;$i<= count($alllist);$i++ )
	{
		$alllist[$i-1]['id'] = $i;
	}
	$excel = array();

	// 标题
	$excel['title'] = '充值排行';
	// 表头
	$excel['hd'] =  array('排名','角色ID','角色名','账号','总充值金额(元)','Q点金额(元)','代金券金额(元)');
	// 列数
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($alllist as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pay_all']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pay_money']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pay_ticket']);
	}
	return $excel;
}

function getTotalMoney($tablename)
{
	$sql = "select SUM(pay_money)+SUM(pay_ticket)*10 as s from  ".$tablename;
	$row = GFetchRowOne($sql);
	return $row['s'];
}



