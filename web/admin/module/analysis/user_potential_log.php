<?php

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

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);

$role_id = trim(SS($_REQUEST['role_id']));
$nickname = trim(SS($_REQUEST['nickname']));
$acname  = trim(SS($_REQUEST['acname']));




$search_sort_1 = SS($_REQUEST['sort_1']);
$search_sort_2 = SS($_REQUEST['sort_2']);
$staue_sort = SS($_REQUEST['sort_statu']);

if (empty($search_sort_1))		$search_sort_1 = "datetime desc";	
if (empty($search_sort_2))		$search_sort_2 = "id desc";
 
$ex = SS($_REQUEST['excel']);
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
	$role_result = $db->fetchOne($sql);
	$role_id = $role_result['role_id'];
	if ($role_id > 0)
	{
		$pageno = getUrlParam('page');
		$search_sort .= $search_sort_1 . ", ". $search_sort_2;
		$where = " `role_id` = ".$role_id. " AND datetime>={$dateStartStamp} AND datetime<={$dateEndStamp} ";
		if($staue_sort){
			$where .= " and mtype = {$staue_sort}";
		}

		$tablename = "t_log_potential";
		//满足搜索条件的银两求和。
		//$balance = getBanlance($tablename, $where);
		//$typename = LogSilverClass::GetTypeList();
		$count_result	= 0;

		$keywordlist	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);
		//exit(print_r($keywordlist));
		$excel		= getExcel($tablename, $where, $search_sort, $typename,$AGENT_ID,$buf_lang);
		$pagelist	= getPages($pageno, $count_result);
		for($i=0;$i<count($keywordlist);$i++)
		{
			$keywordlist[$i]['mtype_name'] = $typename[$keywordlist[$i]['mtype']];
			$keywordlist[$i]['role_name'] = $role_result['role_name'];
			$keywordlist[$i]['account_name'] = $role_result['account_name'];
			switch ($keywordlist[$i]['mtype']) {
					case '1':
						$keywordlist[$i]['mtype'] = '获得';
						break;
					case '2':
						$keywordlist[$i]['mtype'] = '被融合';
				}
			switch($keywordlist[$i]['pcolor']){
					case '1':
						$keywordlist[$i]['pcolor'] = '#c5eaf3';
						break;
					case '2':
						$keywordlist[$i]['pcolor'] = '#00FF00';
						break;
					case '3':
						$keywordlist[$i]['pcolor'] = '#0070dd';
						break;
					case '4':
						$keywordlist[$i]['pcolor'] = '#e100ff';
						break;
					case '5':
						$keywordlist[$i]['pcolor'] = '#ff7800';
						break;
			}	
		}
	}
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

$staue = getStatuTypeListOption($buf_lang);


$smarty->assign("time_start", $dateStartStr);
$smarty->assign("time_end", $dateEndStr);
$smarty->assign("search_sort_1", $search_sort_1);
$smarty->assign("search_sort_2", $search_sort_2);
$smarty->assign("staue_sort",$staue_sort);
$smarty->assign("search_keyword1", $role_result['account_name']);
$smarty->assign("search_keyword2", $role_result['role_name']);
$smarty->assign("role_id", $role_result['role_id']);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));

$smarty->assign('sortoption', $sortlistopgion);
$smarty->assign('statuoption',$staue);

$smarty->display("module/analysis/user_potential_log.html");

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
	$excel['title'] = $lang['left']['user_potential_record'];
	// 表头
	$excel['hd'] =  array(
			'id',
			$lang['conmon']['user_id'],
			$lang['conmon']['role_name'],
			$lang['conmon']['user_account'],
			$lang['left']['use_time'],
			$lang['left']['props_name'],
			$lang['left']['statu'],
			$lang['left']['mountsment_color'], 
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
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d G:i:s',$v['datetime']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pname']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['mtype']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['pcolor']);
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

function getStatuTypeListOption($arr_lang = array())
{
	return array(
		'1' => $arr_lang['new']['reserve'],
		'2'  => $arr_lang['new']['remove'],
	);
}


