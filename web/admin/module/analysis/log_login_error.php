<?php
/*
 * Author: wuzesen@mingchao.com
 * 2012-3-1
 * 角色退出异常记录
 */
 
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_silver_class.php';
global $smarty, $db;

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

if(($dateEndStamp-$dateStartStamp+1 ) > 8*86400)
{
	$dateStartStamp = $dateEndStamp+1-8*86400;
}

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);



$server_name = trim(SS($_REQUEST['server_name']));
$error_step = trim(SS($_REQUEST['error_step']));
$acname  = trim(SS($_REQUEST['acname']));
$error_id  = trim(SS($_REQUEST['error_id']));
$error_detail  = trim(SS($_REQUEST['error_detail']));

$state =array(
1 =>$buf_lang['new']['error_logout_reason1'],
2 =>$buf_lang['new']['error_logout_reason2'],
3 =>$buf_lang['new']['error_logout_reason3'],
4 =>$buf_lang['new']['error_logout_reason4'],
5 =>$buf_lang['new']['error_logout_reason5'],
6 =>$buf_lang['new']['error_logout_reason6'],
);

$search_sort_1 = SS($_REQUEST['sort_1']);
$search_sort_2 = SS($_REQUEST['sort_2']);
if (empty($search_sort_1))		$search_sort_1 = "datetime desc";	
if (empty($search_sort_2))		$search_sort_2 = "id desc";

$ex = SS($_REQUEST['excel']);

/*if(isset($_REQUEST['ip']) && $_REQUEST['ip'] !='' && empty($role_id))
{
	$t_data_sql = "SELECT role_id from t_log_exit where ip='{$_REQUEST['ip']}'";
	$role_result = GFetchRowSet($t_data_sql);
	exit(print_r($role_result));
	$role_id = $role_result['role_id'];
}*/


$where = " datetime>={$dateStartStamp} AND datetime<={$dateEndStamp} ";	
if (!empty($server_name))
{
	$where .= " AND server_name='{$server_name}'";
}
else if (!empty($error_step))
{
	$where .= " AND error_step='{$error_step}'";
}
else if (!empty($acname))
{
	$where .= " AND account_name='{$acname}'";
}
else if (!empty($error_id))
{
	$where .= " AND error_id='{$error_id}' ";
}
else if (!empty($error_detail))
{
	$where .= " AND error_msg like '%{$error_detail}%' ";
}
	$pageno = getUrlParam('page');
	$search_sort .= $search_sort_1 . ", ". $search_sort_2;
	$tablename = "t_log_login_error";
	//满足搜索条件的银两求和。
	//$balance = getBanlance($tablename, $where);
	//$typename = LogSilverClass::GetTypeList();
	$count_result	= 0;
	$keywordlist_buf	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);
	$keywordlist =array();
	foreach($keywordlist_buf as $k => $v)
	{
		$keywordlist[$k] = $v;
		$keywordlist[$k]['state_view'] =  $state[$v['state']];
	}
	
	$pagelist	= getPages($pageno, $count_result);


//输出Excel文件
if(isset($ex) && $ex == true ){
    $excel		= getExcel($tablename, $where, $search_sort, $typename,$buf_lang,$state);
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

$smarty->assign("server_name", $server_name);
$smarty->assign("error_id", $error_id);
$smarty->assign("time_start", $dateStartStr);
$smarty->assign("time_end", $dateEndStr);
$smarty->assign("search_sort_1", $search_sort_1);
$smarty->assign("search_sort_2", $search_sort_2);
$smarty->assign("search_keyword1", $acname);
$smarty->assign("error_step", $error_step);
$smarty->assign("role_id", $role_result['role_id']);
$smarty->assign("error_detail", $error_detail);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));

$smarty->assign('sortoption', $sortlistopgion);

$smarty->display("module/analysis/log_login_error.html");



function getExcel($tablename, $where, $search_sort, $typename,$lang = array(),$state = array()){
	if($search_sort != '')
		$search_sort = "ORDER BY " . $search_sort; 
	$sql		= "SELECT * FROM $tablename WHERE $where $search_sort";
	$row_all	= GFetchRowSet($sql);
	
	$excel = array();

	// 标题
	$excel['title'] = $lang['new']['error_logout'];
	// 表头
	$excel['hd'] =  array(
			'id',
			$lang['conmon']['user_account'],
			$lang['left']['use_time'],
			$lang['conmon']['server'], 
			$lang['left']['error_place'], 
			$lang['new']['error'], 
			$lang['new']['error_msg'], 
			);
	// 列数
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($row_all as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['server_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['error_step']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d G:i:s',$v['datetime']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['error_id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['error_msg']);
	}
	return $excel;
}

function getSortTypeListOption($arr_lang = array())
{
	return array(
			"id asc"  => $arr_lang['new']['id_asc'],
			"id desc" => $arr_lang['new']['id_desc'],
			"datetime asc"  => $arr_lang['new']['time_asc'],
			"datetime desc" => $arr_lang['new']['time_desc'],
			);
}


