<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
include SYSDIR_ADMIN."/class/log_gold_class.php";
global $smarty, $db;


if ( isset($_REQUEST['dStartDate'])){
	$dateStart = $_REQUEST['dStartDate'];
}
else
{
	$dateStart = strftime ("%Y-%m-%d", time()-(60*60*24)*5 );
}

if ( isset($_REQUEST['dEndDate']))
{
    $dateEnd = $_REQUEST['dEndDate'];
}
else
{
	$dateEnd= strftime ("%Y-%m-%d",time());
}
$u_start = strtotime($dateStart.' 00:00:00');
$u_end = strtotime($dateEnd.' 23:59:59');

$ex = SS($_REQUEST['excel']);

/*,
        1=>$buf_lang['new']['family_gift'],
        2=>$buf_lang['new']['telephone_gift']*/

$card_type = array(
        0=>$buf_lang['new']['newman_gift']
);


$sql = "select count(*) as times, `type` from `t_log_card` where dateline>={$u_start} and dateline<={$u_end} group by `type`";
$result = $db->fetchAll($sql);


foreach( $card_type as $k=>$v){
    $tmp['times'] = $result[$k]['times']|0;
    $tmp['card_name'] = $v;
    $card_data[$k] = $tmp;
}




$acname  = trim(SS($_REQUEST['acname']));
$nickname = trim(SS($_REQUEST['nickname']));
$userid  = trim(SS($_REQUEST['userid']));

$cardtype  = isset($_REQUEST['cardtype'])?$_REQUEST['cardtype']:3;


$acname  = trim(SS($acname));
$nickname = trim(SS($nickname));
$userid  = trim(SS($userid));

$pageno = getUrlParam('page');
$where = '1';

if(!empty($userid))
{
	$where .= " AND `role_id` = '{$userid}'";
}
if (!empty($acname))
{
	$where .= " AND `account_name` = '{$acname}'";
}

if (!empty($nickname))
{
	$where .= " AND `role_name` = '{$nickname}'";
}
if($cardtype!=3)
$where .= " and type=$cardtype ";
$search_sort = 'dateline ';

$tablename = "t_log_card";

//	if(count($balance) <1 ){
//		$smarty->assign("warning","抱歉，查询不到该玩家的领取");
//	}

$count_result	= 0;
$keywordlist2	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);

if(!empty($keywordlist2))
{
	foreach($keywordlist2 as $kPay => $vPay)
	{
		$keywordlist2[$kPay]['card_name'] = $card_type[$vPay['type']];
	}
}


$pagelist	= getPages($pageno, $count_result);

//输出Excel文件
if(isset($ex) && $ex == true )
{
        $sql_excel = 'select * from t_log_card where  ';
	$excel = getExcel( $sql_excel,$where." ORDER BY dateline  ",$buf_lang );
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



$smarty->assign("data", $card_data);


$smarty->assign("time_start", $dateStart);
$smarty->assign("time_end", $dateEnd);

$smarty->assign("search_keyword1", $acname);
$smarty->assign("search_keyword2", $nickname);
$smarty->assign("search_keyword3", $userid);
$smarty->assign("search_keyword4", $cardtype);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist2", $keywordlist2);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));
$smarty->assign("warning","抱歉，查询不到该玩家的领取");


$smarty->display("module/analysis/card_log.html");


function getExcel( $sql,$sqlcondition,$buf_lang)
{
        $card_type = array(
        0=>$buf_lang['new']['newman_gift'],
        1=>$buf_lang['new']['family_gift'],
        2=>$buf_lang['new']['telephone_gift']
);
	$row_all	= GFetchRowSet($sql.$sqlcondition);
	$excel = array();

	$excel['title'] = $buf_lang['new']['gift_receive'];
	$excel['hd'] =  array(
                $buf_lang['conmon']['user_id'],
		$buf_lang['conmon']['role_name'],
		$buf_lang['conmon']['user_account'],
		$buf_lang['new']['type_of_bag'],
		$buf_lang['new']['card_num'],
		$buf_lang['new']['get_bag_time']
                );
	$excel['hdnum'] = count($excel['hd']);
        
	$excel['content'] = array();
	foreach($row_all as $k=>$v)
	{
		$excel['content'][$k] = array();	
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_id']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['account_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$card_type[$v['type']]);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['card_num']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d H:i:s',$v['dateline']));
	}
	return $excel;
}
