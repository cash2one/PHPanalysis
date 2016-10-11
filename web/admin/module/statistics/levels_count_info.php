<?php
/*
 * Author: zengjintong@4399.com
 * 2011-05-06
 * 等级分布
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

$sql = "SELECT datetime, level1, level2, level3, level4, level5, level6, level7, level8, level9, level10,";
$sql .= "level11, level12, level13, level14, level15 FROM t_level_count";
$sql .= " WHERE datetime >= ".$start." AND datetime <=".$endtime." ORDER BY datetime DESC ";
$sqlpage = $sql." LIMIT ".$startno." , ".$per_page_record;

$keywordlist	= GFetchRowSet($sqlpage);

$sqlcondition = " datetime>= ".$start." and datetime <=".$endtime;
$count_result = 0;
$count_result = getRecordCount("t_level_count",$sqlcondition);

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
$smarty->display("module/statistics/levels_count_info.tpl");

function getExcel( $sql )
{
	$row_all	= GFetchRowSet($sql);
	$excel = array();

	$excel['title'] = '综合信息报表';
	$excel['hd'] =  array('日期','1-10级','11-20级','21-30级','31-40级','41-50级','51-60级',
		'61-70级','71-80级','81-90级','91-100级','101-110级','111-120级','121-130级','131-140级','141-150级');
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($row_all as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d',$v['datetime']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level1']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level2']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level3']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level4']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level5']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level6']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level7']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level8']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level9']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level10']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level11']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level12']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level13']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level14']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level15']);
	}
	return $excel;
}

