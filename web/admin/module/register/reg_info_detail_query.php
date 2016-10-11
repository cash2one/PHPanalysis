<?php
/*
 * Author: zengjintong@4399.com
 * 2011-05-05
 * 注册信息明细查询
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
	$start = strtotime(strftime("%Y-%m-%d",time()-7*86400));
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

$search_sort_1 = SS($_REQUEST['sort_1']);
$search_sort_2 = SS($_REQUEST['sort_2']);
$ex = SS($_REQUEST['excel']);

if (empty($search_sort_1))		$search_sort_1 = "create_time desc";
if (empty($search_sort_2))		$search_sort_2 = "last_login_time desc";

$role_id = SS($_REQUEST['role_id']);
$role_name = SS($_REQUEST['role_name']);
$account_name = SS($_REQUEST['account_name']);

$pageno = getUrlParam('page');
$search_sort .= $search_sort_1.", ".$search_sort_2;

$sqlcondition = " create_time >= ".$start." and create_time <=".$endtime;

$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$sql = "SELECT b.role_id role_id, b.account_name account_name, b.role_name role_name, b.create_time create_time, p.last_login_time last_login_time, p.last_login_ip last_login_ip, a.level level, a.reincarnation zhuanshen FROM db_role_base_p b, db_account_p p, db_role_attr_p a WHERE b.account_name = p.account_name AND b.role_id = a.role_id AND b.agent_id={$AGENT_ID} ";

if(!empty($role_id))
{
	$sql .= " AND b.role_id=$role_id";
	$sqlcondition .= " and role_id=$role_id";
}
else if (!empty($role_name))
{
	$sql .= " AND b.role_name='$role_name'";
	$sqlcondition .= " and role_name='$role_name'";
}
else if (!empty($account_name))
{
	$sql .= " AND b.account_name='$account_name' ";
	$sqlcondition .= " and account_name='$account_name' ";
}

$sql .= " AND b.create_time >= ".$start." AND b.create_time <=".$endtime." ORDER BY ".$search_sort;
if (!empty($role_id) || !empty($role_name) || !empty($account_name))
{
	$sqlpage = $sql;
}
else
	$sqlpage = $sql." LIMIT ".$startno." , ".$per_page_record;

$keywordlist	= GFetchRowSet($sqlpage);

if (!empty($role_id) || !empty($role_name) || !empty($account_name))
{
	$role = array(
                    "role_id" => $keywordlist[0]['role_id'],
                    "role_name" => $keywordlist[0]['role_name'],
                    "account_name" => $keywordlist[0]['account_name']
				   );
}
//增加agent_id筛选项
$sqlcondition .= " AND agent_id=$AGENT_ID ";

$count_result = getRecordCount("db_role_base_p",$sqlcondition);
$pagelist	= getPages($pageno, $count_result);


//输出Excel文件
if(isset($ex) && $ex == true )
{
	$excel		= getExcel( $sql ,$buf_lang);
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

$sortlistopgion  = getSortTypeListOption($buf_lang);
$smarty->assign('sortoption', $sortlistopgion);
$smarty->assign("search_sort_1", $search_sort_1);
$smarty->assign("search_sort_2", $search_sort_2);
$smarty->assign("start", $start);
$smarty->assign("end", $end);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("role", $role);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));
$smarty->display("module/register/reg_info_detail_query.html");

function getExcel( $sql , $arr_lang = array())
{
	$row_all	= GFetchRowSet($sql);
	$excel = array();

	$excel['title'] = $arr_lang['left']['registration_information'];
	$excel['hd'] =  array($arr_lang['conmon']['user_id'],$arr_lang['conmon']['role_name'],$arr_lang['conmon']['user_account'],$arr_lang['conmon']['registered_time'],$arr_lang['conmon']['last_login_time'],$arr_lang['conmon']['last_login_ip'],$arr_lang['conmon']['zhuanshen'],$arr_lang['conmon']['role_level']);
	$excel['hdnum'] = count($excel['hd']);

	$excel['content'] = array();
	foreach($row_all as $k=>$v){
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d G:i:s',$v['create_time']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d G:i:s',$v['last_login_time']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['last_login_ip']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['zhuanshen']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['level']);
	}

	return $excel;
}

function getSortTypeListOption($arr_lang = array())
{
	return array(
			"create_time asc"  => $arr_lang['new']['create_time_asc'],
			"create_time desc" => $arr_lang['new']['create_time_desc'],
			"last_login_time asc"  => $arr_lang['new']['last_login_time_asc'],
			"last_login_time desc" => $arr_lang['new']['last_login_time_desc'],
            "zhuanshen desc" => $arr_lang['new']['zhuanshen_desc'],
            "zhuanshen asc" => $arr_lang['new']['zhuanshen_asc'],
			"level asc" => $arr_lang['new']['level_asc'],
			"level desc" => $arr_lang['new']['level_desc'],
			);
}


