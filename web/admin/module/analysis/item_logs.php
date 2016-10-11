<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_silver_class.php';
include SYSDIR_ADMIN.'/include/config_item_type.php';
include SYSDIR_ADMIN.'/include/page.php';
global $smarty, $db;
/*
$_url = $_SERVER['REQUEST_URL'];
var_dump($_SERVER);exit;
$_par = parse_url($_url);
if(isset($_par['query'])){
    parse_str($_par['query'],$_query);
    unset($_query['page']);
    $_url = $_par['path'].'?'.http_build_query($_query);
}
var_dump($_url);exit;*/

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
//echo $dateEndStamp;exit;

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d", $dateEndStamp);//2015-09-6 00:00:00
$role_id = trim(SS($_REQUEST['role_id']));
$nickname = trim(SS($_REQUEST['nickname']));
$acname  = trim(SS($_REQUEST['acname']));
$goodsId  = trim(SS($_REQUEST['goods_id']));
$search_sort_1 = SS($_REQUEST['sort_1']);
$search_sort_2 = SS($_REQUEST['sort_2']);
$search_type = SS($_REQUEST['search_type']);
$action = SS($_REQUEST['action']);


if (empty($search_sort_1))		$search_sort_1 = "mtime desc";	
if (empty($search_sort_2))		$search_sort_2 = "id desc";


$ex = SS($_REQUEST['excel']);
if($action == 'do'){
	//echo $acname;exit;
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
	}else{
        $where = '';
        if(!empty($goodsId)){
            $where .= 'item_id='.$goodsId;
            $where .= " AND mtime>=".$dateStartStamp;
            $where .= " AND mtime<=".$dateEndStamp;
        }
        $pagesize = 20;
        $sql = "select count(*) as total from t_log_item where ".$where;
        //echo $sql;exit;
        $num = $db->fetchOne($sql);
        if(empty($num['total'])){
            echo "该时间段木有数据";exit;
        }
        $total = $num['total'];
        $page = new pages($total, $pagesize);
        $show = $page->showpage();
        $list_sql = "select a.*,b.account_name from t_log_item a left join db_role_base_p b on a.role_id=b.role_id where ".$where." order by mtime desc ".$page->getLimit();
        $list = $db->fetchAll($list_sql);
        $typename = $item_type;
        for($i=0;$i<count($list);$i++)
        {
            $list[$i]['mtype_name'] = $typename[$list[$i]['mtype']];
        }
    }

}else if($action == "continue"){
        $userid = $_REQUEST['role_id'];
        $pagesize = 20;
        $where = '';
        $where .= " AND mtime>=".$dateStartStamp;
        $where .= " AND mtime<=".$dateEndStamp;
        $sql = "select count(*) as total from t_log_item where role_id=".$userid.$where;
        $num = $db->fetchOne($sql);

        if(empty($num['total'])){
            echo "该时间段木有数据";exit;
        }
        $total = $num['total'];
        $page = new pages($total, $pagesize);
        $show = $page->showpage();
        $list_sql = "select * from t_log_item where role_id=".$userid.$where." order by mtime desc ".$page->getLimit();
        $list = $db->fetchAll($list_sql);
        $typename = $item_type;
        for($i=0;$i<count($list);$i++)
        {
            $list[$i]['mtype_name'] = $typename[$list[$i]['mtype']];
            $list[$i]['account_name'] = $_REQUEST['account_name'];
            $list[$i]['role_name'] = $_REQUEST['role_name'];
        }
}

//print_r($keywordlist);

//排序的
//$sortlistopgion  = getSortTypeListOption($buf_lang);
//var_dump($role_result);exit;
$smarty->assign("time_start", $dateStartStr);
$smarty->assign("role_result", $role_result);
$smarty->assign("time_end", $dateEndStr);
$smarty->assign("search_sort_1", $search_sort_1);
$smarty->assign("search_sort_2", $search_sort_2);
$smarty->assign("goods_id", $goodsId);
$smarty->assign("search_type", $search_type);
$smarty->assign("role_name", $nickname);
$smarty->assign("account_name", $acname);
$smarty->assign("role_id", $role_id);
$smarty->assign("record_count", $count_result);
//$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("list", $list);
$smarty->assign("show", $show);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));
$smarty->assign('sortoption', $sortlistopgion);
$smarty->display("module/analysis/item_logs.html");


function getSortTypeListOption($arr_lang = array())
{
	return array(
			"id asc"  => $arr_lang['new']['id_asc'],
			"id desc" => $arr_lang['new']['id_desc'],
			"mtime asc"  => $arr_lang['new']['mtime_asc'],
			"mtime desc" => $arr_lang['new']['mtime_desc'],
			"mdetail asc"  => $arr_lang['conmon']['mdetail_asc'],
			"mdetail desc" => $arr_lang['conmon']['mdetail_desc'],
			"user_id asc"  => $arr_lang['conmon']['user_id_asc'],
			"user_id desc" => $arr_lang['conmon']['user_id_desc'],
			);
}


