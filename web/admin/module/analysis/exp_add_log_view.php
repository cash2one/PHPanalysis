<?php
/*
 * Author: wuzesen@mingchao.com
 * 2010-10-26
 * 查询用户银两使用记录
 */
 
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_silver_class.php';
include SYSDIR_ADMIN.'/include/page.php';
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

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

$role_id = trim(SS($_REQUEST['role_id']));
$nickname = trim(SS($_REQUEST['nickname']));
$acname  = trim(SS($_REQUEST['acname']));
$action = SS($_REQUEST['action']);




$search_sort_1 = SS($_REQUEST['sort_1']);
$search_sort_2 = SS($_REQUEST['sort_2']);
if (empty($search_sort_1))		$search_sort_1 = "mtime desc";	
if (empty($search_sort_2))		$search_sort_2 = "id desc";

$ex = SS($_REQUEST['excel']);

if($action == 'do'){
	/*echo "<pre>";
	print_r($acname);exit;*/
	if (!empty($role_id) || !empty($nickname) || !empty($acname))
	{
		$sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1 ";
		if (!empty($role_id))
		{
			$sql .= " AND role_id='{$role_id}'";
		}
		else if (!empty($nickname))
		{
			$sql .= " AND role_name='{$nickname}'";
		}
		else if (!empty($acname))
		{
			$sql .= " AND account_name='{$acname}' AND agent_id='{$AGENT_ID}'";
		}
		//$role_result = $db->fetchOne($sql);
		//$role_id = $role_result['role_id'];
		$role_result = $db->fetchAll($sql);
		//var_dump($role_result);exit;
		//if ($role_id > 0)
		if(empty($role_result)){
			errorExit ($buf_lang['new']['user_no_exist']);
		}

	}
}else if($action == "continue"){
	$role_name = SS($_REQUEST['role_name']);
	$account_name = SS($_REQUEST['account_name']);
    $role_id = $_REQUEST['role_id'];

    $pagesize = 20;

    $sql = 'select count(*) num from `t_log_add_exp` where role_id='.$role_id;
    $num = $db->fetchOne($sql);
    $numTotal = $num['num'];
    $page = new pages($numTotal, $pagesize);
    $show = $page->showpage();

    $list_sql = "select * from t_log_add_exp where role_id=".$role_id." ".$page->getLimit();
    $list = $db->fetchAll($list_sql);

    /*$keywordlist	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);

    //exit(print_r($keywordlist));

    $pagelist	= getPages($pageno, $count_result);
    for($i=0;$i<count($keywordlist);$i++)
    {
        $keywordlist[$i]['mtype_name'] = $typename[$keywordlist[$i]['mtype']];
        $keywordlist[$i]['role_name'] = $role_name;
        $keywordlist[$i]['account_name'] = $account_name;
    }*/

   // $excel		= getExcel($tablename, $where, $search_sort, $typename,$AGENT_ID,$buf_lang);
}


//输出Excel文件
if(isset($ex) && $ex == true ){
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
$smarty->assign("role", $role_result);
$smarty->assign("search_keyword1", $role_result['account_name']);
$smarty->assign("search_keyword2", $role_result['role_name']);
$smarty->assign("role_id", $role_result['role_id']);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("list", $list);
$smarty->assign("show", $show);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));

$smarty->assign('sortoption', $sortlistopgion);

$smarty->display("module/analysis/exp_add_log_view.html");

function getBanlance($tablename, $where)
{
	$sql = "select SUM(silver_unbind) as s from  ".$tablename."  where ".$where;
	$row = GFetchRowOne($sql);
	return $row['s'];
}

function getExcel($tablename, $where, $search_sort, $typename,$AGENT_ID,$lang = array()){
	if($search_sort != '')
		$search_sort = "ORDER BY " . $search_sort; 
	$sql		= "SELECT * FROM $tablename WHERE $where $search_sort";
	$row_all	= GFetchRowSet($sql);
	if(!empty($row_all))
	{
		$sql2 = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE role_id=".$row_all[0]['role_id'] ." AND agent_id=$AGENT_ID ";
		$role_data = GFetchRowSet($sql2);
	}
	$excel = array();

	// 标题
	$excel['title'] = $lang['new']['role_add_exp'];
	// 表头
	$excel['hd'] =  array(
			'id',
			$lang['conmon']['user_id'],
			$lang['conmon']['role_name'],
			$lang['conmon']['user_account'],
			$lang['left']['use_time'],
			$lang['new']['level_after_add'],
			$lang['new']['old_exp'],
			$lang['new']['now_exp'], 
			$lang['new']['add_exp'],
			);
	// 列数
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($row_all as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$role_data[0]['role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$role_data[0]['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d G:i:s',$v['mtime']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['old_exp']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['now_exp']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['add_exp']);
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


