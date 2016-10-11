<?php
/*
 * Author: wuzesen@mingchao.com
 * 2010-10-26
 * 查询用户元宝使用记录
 */

define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';

if ( !isset($_REQUEST['dateStart'])){
	$start_day = GetTime_Today0() - 7*86400;
	$dateStart = strftime("%Y-%m-%d",$start_day);
}
elseif ( $_REQUEST['dateStart'] == 'ALL') {
    $dateStart  = SERVER_ONLINE_DATE;
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}

if ( !isset($_REQUEST['dateEnd']))
	$dateEnd = strftime ("%Y-%m-%d", time() );
elseif ( $_REQUEST['dateStart'] == 'ALL') {
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

$acname  = trim(SS($_REQUEST['acname']));
$nickname = trim(SS($_REQUEST['nickname']));
$userid  = trim(SS($_REQUEST['userid']));
$search_sort_1 = SS($_REQUEST['sort_1']);
$search_sort_2 = SS($_REQUEST['sort_2']);
$ex = SS($_REQUEST['excel']);

if (empty($search_sort_1))		$search_sort_1 = "mtime desc";	
if (empty($search_sort_2))		$search_sort_2 = "id desc";

$forceFlag = 1;

if ((!empty($acname)) || (!empty($nickname)) ||(!empty($userid)))
{
	$acname  = trim(SS($acname));
	$nickname = trim(SS($nickname));
	$userid  = trim(SS($userid));
	$pageno = getUrlParam('page');
	$search_sort .= $search_sort_1 . ", ". $search_sort_2;
	$where = '1';

	if(!empty($userid))
	{
		$where .= " AND `user_id` = '{$userid}'";
	}
	if (!empty($acname)) 
	{	
		if($forceFlag == 1)
		{
			$where .= " AND `account_name` = '{$acname}'";
		}else{
			$where .= " AND `account_name` like '%{$acname}%'";
		}
	}

	if (!empty($nickname)) 
	{
		if($forceFlag == 1)
		{
			$where .= " AND `user_name` = '{$nickname}'";
		}else{
			$where .= " AND `user_name` like '%{$nickname}%'";
		}
	}
	$where .= " AND mtime>={$dateStartStamp} AND mtime<={$dateEndStamp}";
        
        
	$tablename = "t_log_use_gold";
	//满足搜索条件的元宝求和。
	$balance = getBanlance($tablename, $where);
	if(count($balance) <1 ){
		$smarty->assign("warning","对应记录的数目为0");
	}

	$typename = LogGoldClass::GetTypeList();

	$count_result	= 0;
	$keywordlist	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);
	$pagelist	= getPages($pageno, $count_result);

	for($i=0;$i<count($keywordlist);$i++)
	{
		$keywordlist[$i]['mtype_name'] = $typename[$keywordlist[$i]['mtype']];
	}
}

//输出Excel文件
if(isset($ex) && $ex == true ){
		$excel	= getExcel($tablename, $where, $search_sort, $typename,$buf_lang);
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

//排序的
$sortlistopgion  = getSortTypeListOption($buf_lang);
$smarty->assign("balance", $balance);
$smarty->assign("time_start", $dateStartStr);
$smarty->assign("time_end", $dateEndStr);
$smarty->assign("search_sort_1", $search_sort_1);
$smarty->assign("search_sort_2", $search_sort_2);
$smarty->assign("search_keyword1", $acname);
$smarty->assign("search_keyword2", $nickname);
$smarty->assign("search_keyword3", $userid);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));
$smarty->assign('sortoption', $sortlistopgion);
$smarty->display("module/pay/gold_use_log_view.html");

function getBanlance($tablename, $where)
{
	$sql = "select SUM(gold_bind) as s, SUM(gold_unbind) as su from  ".$tablename."  where ".$where;
	$row = GFetchRowOne($sql);
	return $row;
}

function getExcel($tablename, $where, $search_sort, $typename,$lang = array()){
	if($search_sort != '')
		$search_sort = "ORDER BY " . $search_sort; 
	$sql		= "SELECT * FROM $tablename WHERE $where $search_sort";
	$row_all	= GFetchRowSet($sql);
	$excel = array();

	// 标题
	$excel['title'] = '元宝使用记录';
	// 表头
	$excel['hd'] =  array(
			'ID',
			$lang['conmon']['user_id'],
			$lang['conmon']['role_name'],
			$lang['conmon']['user_account'], 
			$lang['left']['use_time'],
			$lang['left']['bind_gold'],
			$lang['left']['unbind_gold'],
			$lang['conmon']['operation_type'], 
			$lang['conmon']['operation_content'], 
			);
	// 列数
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($row_all as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['user_id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['user_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d G:i:s',$v['mtime']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['gold_bind']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['gold_unbind']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$typename[$v['mtype']]);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['mdetail']);	
	}
	return $excel;
}




function getSortTypeListOption($arr_lang = array())
{
	return array(
			"id asc"  => $arr_lang['new']['id_asc'],
			"id desc" => $arr_lang['new']['id_desc'],
			"mtime asc"  => $arr_lang['new']['mtime_asc'],
			"mtime desc" => $arr_lang['new']['mtime_desc'],
			"gold_bind asc"  => $arr_lang['new']['gold_bind_asc'],
			"gold_bind desc" => $arr_lang['new']['gold_bind_desc'],	
			"gold_unbind asc"  => $arr_lang['new']['gold_unbind_asc'],
			"gold_unbind desc" => $arr_lang['new']['gold_unbind_desc'],
			"mtype asc"  => $arr_lang['conmon']['mtype_asc'],
			"mtype desc" => $arr_lang['conmon']['mtype_desc'],
			"mdetail asc"  => $arr_lang['conmon']['mdetail_asc'],
			"mdetail desc" => $arr_lang['conmon']['mdetail_desc'],	
			"user_id asc"  => $arr_lang['conmon']['user_id_asc'],
			"user_id desc" => $arr_lang['conmon']['user_id_desc'],

		    );
}
