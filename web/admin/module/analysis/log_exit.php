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
	$start_day = GetTime_Today0() - 2*86400;
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

if(($dateEndStamp-$dateStartStamp+1 ) > 3*86400)
{
	$dateStartStamp = $dateEndStamp+1-3*86400;
}

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

$role_id = trim(SS($_REQUEST['role_id']));
$nickname = trim(SS($_REQUEST['nickname']));
$acname  = trim(SS($_REQUEST['acname']));
$ip  = trim(SS($_REQUEST['ip']));

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
if (empty($search_sort_1))		$search_sort_1 = "mtime desc";	
if (empty($search_sort_2))		$search_sort_2 = "id desc";

$ex = SS($_REQUEST['excel']);

$where = " mtime>={$dateStartStamp} AND mtime<={$dateEndStamp} ";	
if (!empty($role_id))
{
	$where .= " AND role_id='{$role_id}'";
}
else if (!empty($nickname))
{
	$where .= " AND role_name='{$nickname}'";
}
else if (!empty($acname))
{
	$where .= " AND account_name='{$acname}'";
}
else if (!empty($ip))
{
	$where .= " AND ip='{$ip}' ";
}
	$pageno = getUrlParam('page');
	$search_sort .= $search_sort_1 . ", ". $search_sort_2;
	$tablename = "t_log_exit";
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
		$excel	= getExcel($tablename, $where, $search_sort, $typename,$AGENT_ID,$buf_lang,$state);
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

$smarty->assign("ip", $_REQUEST['ip']);
$smarty->assign("time_start", $dateStartStr);
$smarty->assign("time_end", $dateEndStr);
$smarty->assign("search_sort_1", $search_sort_1);
$smarty->assign("search_sort_2", $search_sort_2);
$smarty->assign("search_keyword1", $role_result['account_name']);
$smarty->assign("search_keyword2", $role_result['role_name']);
$smarty->assign("role_id", $role_result['role_id']);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));

$smarty->assign('sortoption', $sortlistopgion);

$smarty->display("module/analysis/log_exit.html");



function getExcel($tablename, $where, $search_sort, $typename,$AGENT_ID,$lang = array(),$state = array()){
	if($search_sort != '')
		$search_sort = "ORDER BY " . $search_sort; 
	$sql		= "SELECT * FROM $tablename WHERE $where $search_sort";
	$row_all_buf	= GFetchRowSet($sql);
	$row_all =array();
	foreach($row_all_buf as $k => $v)
	{
		$row_all[$k] = $v;
		$row_all[$k]['state_view'] =  $state[$v['state']];
	}
	if(!empty($row_all))
	{
		$sql2 = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE role_id=".$row_all[0]['role_id'] ." AND agent_id=$AGENT_ID ";
		$role_data = GFetchRowSet($sql2);
	}
	$excel = array();

	// 标题
	$excel['title'] = $lang['new']['error_logout'];
	// 表头
	$excel['hd'] =  array(
			'id',
			$lang['conmon']['user_id'],
			$lang['conmon']['role_name'],
			$lang['conmon']['user_account'],
			$lang['left']['use_time'],
			'ip',
			$lang['new']['reason'], 
			$lang['new']['before_state'], 
			);
	// 列数
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($row_all as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d G:i:s',$v['mtime']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['ip']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['reason']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['state_view']);
	}
	return $excel;
}

function getSortTypeListOption($arr_lang = array())
{
	return array(
			"id asc"  => $arr_lang['new']['id_asc'],
			"id desc" => $arr_lang['new']['id_desc'],
			"mtime asc"  => $arr_lang['new']['time_asc'],
			"mtime desc" => $arr_lang['new']['time_desc'],
			);
}


