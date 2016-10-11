<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
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



$sql_total = "select count(*) as operate_times,count(distinct role_id) as role_times,sum(oldgold) as oldgold,sum(newgold) as newgold ,type
from t_log_wish where `date`>={$u_start} and `date`<={$u_end} group by type order by type asc";
$type_total = $db->fetchAll($sql_total);
$desc = array(1=>'免费许愿',2=>'许愿5次',3=>'许愿10次',4=>'TOTAL');
foreach($type_total as $k=>$v){
    $tmp['operate_times']  = $v['operate_times'];
    $tmp['role_times'] = $v['role_times'];
    $tmp['gold'] = $v['oldgold'] - $v['newgold'];
    $tmp['desc'] = $desc[$v['type']];
    $total['operate_times']  += $v['operate_times'];
    $total['role_times'] += $v['role_times'];
    $total['gold'] += $tmp['gold'];
    $format_total[]=$tmp;
}

$total['desc'] = '<font color="red">'.$desc[4].'</font>';
if($total['operate_times'])
    $format_total[] = $total;

$sql_type = "select goodslist,type from t_log_wish where `date`>={$u_start} and `date`<={$u_end}";
$goods_list = $db->fetchAll($sql_type);


$goosql = "select id,name from `t_PGoods` ";
$tem_name = GFetchRowSet($goosql);
foreach($tem_name as $v) {
    $goods_name[$v['id']] = $v['name'];
}

foreach($goods_list as $value){
    $a = explode("#", $value['goodslist']);
    foreach($a as $v){
        $b = explode('-',$v);
        if($b[0]){
            $format_type[$value['type']][$b[0]]['num'] += $b[1];
            $format_type[$value['type']][$b[0]]['name'] = $goods_name[$b[0]];
            $format_type[$value['type']]['sum'] +=$b[1];
        }
    }    
}
if($format_type)
foreach($format_type as $k=>$v){
    if($v)
        ksort($format_type[$k]);
}
if($format_type)
    ksort($format_type);



//$acname  = trim(SS($_REQUEST['acname']));
//$nickname = trim(SS($_REQUEST['nickname']));
//$userid  = trim(SS($_REQUEST['userid']));
//
//
//$acname  = trim(SS($acname));
//$nickname = trim(SS($nickname));
//$userid  = trim(SS($userid));
//$pageno = getUrlParam('page');
//$where = '1';
//
//if(!empty($userid))
//{
//	$where .= " AND `user_id` = '{$userid}'";
//}
//if (!empty($acname))
//{
//	$where .= " AND `account_name` = '{$acname}'";
//}
//
//if (!empty($nickname))
//{
//	$where .= " AND `user_name` = '{$nickname}'";
//}
//
//$search_sort = 'date desc ';
//
//$tablename = "t_log_wish";
//
////	if(count($balance) <1 ){
////		$smarty->assign("warning","抱歉，查询不到该玩家的领取");
////	}
//
//$count_result	= 0;
//$keywordlist2	= getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);
//
//if(!empty($keywordlist2))
//{
//	foreach($keywordlist2 as $kPay => $vPay)
//	{
//		//$keywordlist2[$kPay]['item_name'] = $item_name[$vPay['itemid']];
//		//$item_list = explode('#',$vPay['detail']);
//
//		$bag_detail = "";
//		if(!empty($item_list))
//		{
//			foreach($item_list as $kItem => $vItem)
//			{
//				$item_detail = explode("-", $vItem);
//				if(!empty($item_detail[0]))
//				{
//					$bag_detail .= $goods_name[$item_detail[0]];
//					$bag_detail .= "*".$item_detail[1].";";
//				}
//			}
//		}
//		$keywordlist2[$kPay]['bag_detail'] = $bag_detail;
//	}
//}
//
////$excel		= getExcel($tablename, $where, $search_sort, $typename,$buf_lang);
//$pagelist	= getPages($pageno, $count_result);






$output = output_data($format_type,$dateStart,$dateEnd);

$smarty->assign("total", $format_total);
$smarty->assign("output", $output);
$smarty->assign("time_start", $dateStart);
$smarty->assign("time_end", $dateEnd);

//$smarty->assign("search_keyword1", $acname);
//$smarty->assign("search_keyword2", $nickname);
//$smarty->assign("search_keyword3", $userid);
//$smarty->assign("record_count", $count_result);
//$smarty->assign("keywordlist2", $keywordlist2);
//$smarty->assign("page_list", $pagelist);
//$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));
//$smarty->assign("warning","抱歉，查询不到该玩家的领取");
$smarty->display("module/festival/log_wish.html");




function output_data($data,$dateStart,$dateEnd) {
    global $buf_lang;
    if(empty($data)) return '<font color="#FF0000" size="+1">'.$buf_lang['new']['no_data_inlimit'].'</font>';
    $html = '';
    $flag = array(1=>'<font color="red"><b>↓</b></font>',2=>'<font color="green"><b>↑</b></font>');
    $table = '<td width="310" valign="top" ><table cellspacing="1" cellpadding="0" border="1" bgcolor="#bbe5e5" width="310" valign="top">';
    $thead = '<tr align="center"><td><b>'.$buf_lang['left']['props_id'].'</b></td><td><b>'.$buf_lang['left']['props_name'].'</b></td><td><b>'.$buf_lang['left']['props_num'].'</b></td><td><b>'.$buf_lang['new']['treasure_goods_rate'].'</b></td></tr>';

    foreach($data as $k => $v) {
        $info = $dateStart.' 00:00:00 ~'.$dateEnd.' 23:59:59  <br>'."许愿池".$buf_lang['conmon']['statistics'];
        $head = "<tr align='center'><td colspan='5'><b>$info</b></td></tr>";
        $tr = '';

        foreach($v as $k1 => $v1) {
            if($k1 != 'sum') {
               $tr .= '<tr><td>'.$k1.'</td><td>'.$v1['name'].'</td><td>'.$v1['num'].'</td><td>'.round($v1['num']/$v['sum'],3)*100 .'%</td></tr>';
            }
        }
        $tbody .=$tr;
        $html .=$table.$head.$thead.$tbody.'</table></td>';
        $tbody='';
    }

    return $html;
}
