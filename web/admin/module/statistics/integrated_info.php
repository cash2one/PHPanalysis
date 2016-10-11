<?php
/*
 * Author: zengjintong@4399.com
 * 2011-05-05
 * 综合信息报表
 */


define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';


if(isset($_REQUEST['datestart']))
{
	$start = strtotime(trim(SS($_REQUEST['datestart'])));
}
else
{
	$start = strtotime(strftime("%Y-%m-%d"));
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

$ex = SS($_REQUEST['excel']);

$pageno = getUrlParam('page');

$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$sql = "SELECT datetime, total_login, new_account, total_pay, total_gold, gold_cons, pay_num, arpu, ";
$sql .= "hight_online, avg_online, avg_ol_time, active_user FROM daily_report";
$sql .= " WHERE datetime >= ".$start." AND datetime <=".$endtime." ORDER BY datetime DESC ";
$sqlpage = $sql." LIMIT ".$startno." , ".$per_page_record;

$keywordlist	= GFetchRowSet($sqlpage);


$sqlcondition = " datetime>= ".$start." and datetime <=".$endtime;
$count_result = 0;
$count_result = getRecordCount("daily_report",$sqlcondition);

$pagelist	= getPages($pageno, $count_result, $per_page_record );



//输出Excel文件
if(isset($ex) && $ex == true )
{
	$excel = getExcel( $sql );
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


$smarty->assign("start", $start);
$smarty->assign("end", $end);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));
$smarty->display("module/statistics/integrated_info.tpl");

function getExcel( $sql )
{
	$row_all	= GFetchRowSet($sql);
	$excel = array();

	$excel['title'] = '综合信息报表';
	$excel['hd'] =  array('日期','总登陆账号','新增账号','充值金额（元）','充值元宝（元宝）','消耗元宝（元宝）','充值人数',
		'ARPU','峰值在线','平均在线','平均在线时长','活跃用户数');
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($row_all as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d',$v['datetime']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['total_login']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['new_account']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['total_pay']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['total_gold']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['gold_cons']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pay_num']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['arpu']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['hight_online']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['avg_online']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['avg_ol_time']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['active_user']);
	}
	return $excel;
}

