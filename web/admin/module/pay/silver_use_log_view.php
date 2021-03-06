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
if (empty($search_sort_1))		$search_sort_1 = "mtime desc";	
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
	$role_result = $db->fetchAll($sql);

	//make bowen 20150508
	$silverList = array();
	foreach($role_result as $k => $v){
		$silverList[] = $v['role_id'];
	}
	/*echo "<pre>";
	print_r($silverList);exit;*/
	if (!empty($silverList))
	{
		$array = array();
		foreach($silverList as $k => $val){
			$where = " `user_id` = ".$val. " AND mtime>={$dateStartStamp} AND mtime<={$dateEndStamp} ";
            $order = " order by ".$search_sort_1.",".$search_sort_2;
			$tablename = "t_log_use_silver";
			$sql = "select a.*,b.role_name,b.account_name from " . $tablename . " as a left join db_role_base_p as b on role_id=user_id where " . $where.$order;
			$return = $db->fetchAll($sql);
			if(!empty($return)){
                foreach($return as $v){
                    $array[] = $v;
                }
			}
		}

		//满足搜索条件的银两求和。
		$balance = getBanlance($tablename, $where);
		$count_result	= 0;
		$typename = LogSilverClass::GetTypeList();
		$excel		= getExcel($tablename, $where, $search_sort, $typename,$AGENT_ID,$buf_lang);
		$pagelist	= getPages($pageno, $count_result);
		for($i=0;$i<count($array);$i++)
		{
			$array[$i]['mtype_name'] = $typename[$array[$i]['mtype']];
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
$smarty->assign("balance", $balance);
$smarty->assign("time_start", $dateStartStr);
$smarty->assign("time_end", $dateEndStr);
$smarty->assign("search_sort_1", $search_sort_1);
$smarty->assign("search_sort_2", $search_sort_2);
$smarty->assign("account_name", $acname);
$smarty->assign("role_name", $nickname);
$smarty->assign("role_id", $role_id);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $array);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));
$smarty->assign('sortoption', $sortlistopgion);
$smarty->display("module/pay/silver_use_log_view.html");

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
		$sql2 = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE role_id=".$row_all[0]['user_id'] ." AND agent_id=$AGENT_ID ";
		$role_data = GFetchRowSet($sql2);
	}
	$excel = array();

	// 标题
	$excel['title'] = $lang['left']['silver_use_records'];
	// 表头
	$excel['hd'] =  array(
			'id',
			$lang['conmon']['user_id'],
			$lang['conmon']['role_name'],
			$lang['conmon']['user_account'],
			$lang['left']['use_time'],
			$lang['left']['unbind_silver'],
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
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$role_data[0]['role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$role_data[0]['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d G:i:s',$v['mtime']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['silver_unbind']);
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
			"silver_bind asc"  => $arr_lang['new']['silver_bind_asc'],
			"silver_bind desc" => $arr_lang['new']['silver_bind_desc'],
			"silver_unbind asc"  => $arr_lang['new']['silver_unbind_asc'],
			"silver_unbind desc" => $arr_lang['new']['silver_unbind_desc'],	
			"mtype asc"  => $arr_lang['conmon']['mtype_asc'],
			"mtype desc" => $arr_lang['conmon']['mtype_desc'],
			"mdetail asc"  => $arr_lang['conmon']['mdetail_asc'],
			"mdetail desc" => $arr_lang['conmon']['mdetail_desc'],	
			"user_id asc"  => $arr_lang['conmon']['user_id_asc'],
			"user_id desc" => $arr_lang['conmon']['user_id_desc'],
			);
}


