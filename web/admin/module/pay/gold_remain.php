<?php

define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

$pageno = getUrlParam('page');
$ex = SS($_REQUEST['excel']);
$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$sql = "SELECT p.role_id, p.role_name, b.account_name, p.level, e.last_offline_time, e.is_online," .
	   " p.gold_bind, p.gold, (p.gold_bind+p.gold) as gold_sum, p.reincarnation".
	   " FROM db_role_attr_p as p, db_role_ext_p as e, db_role_base_p as b" .
	   " WHERE p.role_id = e.role_id AND p.role_id=b.role_id ORDER by p.gold desc LIMIT 0,200";

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

$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));
$smarty->display("module/pay/gold_remain.html");


function getExcel( $alllist )
{
	for($i=1;$i<= count($alllist);$i++ )
	{
		$alllist[$i-1]['id'] = $i;
	}
	$excel = array();

	// 标题
	$excel['title'] = '剩余元宝排行';
	// 表头
	$excel['hd'] =  array(
			'排名',
			'角色ID',
			'角色名',
			'账号',
			'等级',
			'剩余绑定元宝',
			'剩余不绑定元宝',
			'剩余总元宝',
			);
	// 列数
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($alllist as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['gold_bind']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['gold']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['gold_sum']);
	}
	return $excel;
}




