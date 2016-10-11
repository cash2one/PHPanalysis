<?php
/*
 * Author: zengjintong@4399.com
 * 2011-05-10
 * 交易查询
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
	$start = strtotime(strftime("%Y-%m-%d", time()-7*86400));
}

if(isset($_REQUEST['dateend']))
{
	$end = strtotime(trim(SS($_REQUEST['dateend'])));
}
else
{
	$end = strtotime(strftime("%Y-%m-%d"));
}

$ex = SS($_REQUEST['excel']);

$role_id = trim(SS($_REQUEST['role_id']));
$rolename = trim(SS($_REQUEST['role_name']));
$account_name = trim(SS($_REQUEST['account_name']));

$pageno = getUrlParam('page');

$per_page_record = LIST_PER_PAGE_RECORDS;
$startno = ($pageno-1)*$per_page_record;
$sql = "SELECT datetime, role_id, role_name, silver, gold, goods, goodsinfo, ";
$sql .= " other_role_id, other_role_name, other_silver, other_gold, other_goods, other_goodsinfo FROM t_role_exchange ";
$sqlcondition = "";
$sqlcount = "";

if (!empty($role_id) || !empty($rolename) || !empty($account_name))
{
	$sql_role = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1 ";
	if (!empty($role_id))
	{
		$sql_role .= " AND role_id='{$role_id}'";
	}
	else if (!empty($rolename))
	{
		$sql_role .= " AND role_name='{$rolename}'";
	}
	else if (!empty($account_name))
	{
		$sql_role .= " AND account_name='{$account_name}' AND server_id='{$GAME_SERVER}' AND agent_id='{$AGENT_ID}'";
	}
	
	$roleid = GFetchRowSet($sql_role);
	if (empty($roleid))
	{
		errorExit ( "玩家不存在！" );
	}
	
	$sqlcondition = " WHERE ( role_id = ".$roleid[0]['role_id']." or other_role_id = ".$roleid[0]['role_id']." ) ";
	$sqlcount = " ( role_id = ".$roleid[0]['role_id']." or other_role_id = ".$roleid[0]['role_id']." ) ";	
}


if( $start>0 && $end > 0 )
{
	$endtime = $end+86400;
	if( $sqlcondition == "" )
	{
		$sqlcondition .= " WHERE ";
	}
	else
	{
		$sqlcondition .= " AND ";
		$sqlcount .= " AND ";
	}
	$sqlcondition .= " datetime >= ".$start." AND datetime <=".$endtime;
	$sqlcount .= " datetime >= ".$start." AND datetime <=".$endtime;
}

$sqlpage = $sql.$sqlcondition." ORDER BY datetime DESC LIMIT ".$startno." , ".$per_page_record;
$keywordlist = GFetchRowSet($sqlpage);
$count_result = getRecordCount("t_role_exchange",$sqlcount);
$pagelist = getPages($pageno, $count_result, $per_page_record );

$listcount = count($keywordlist);
for($i=0;$i<$listcount;$i++)
{
	if( $keywordlist[$i]['goodsinfo'] != "" )
	{
		$goodsinfolist = $keywordlist[$i]['goodsinfo'];
		$goodsinfoarray = explode(";",$goodsinfolist );
		$goods = "";
		$goodsinfo = "";
		for( $j=0;$j<count($goodsinfoarray);$j++ )
		{
			if( $goodsinfoarray[$j] == "")
			{
				continue;
			}
			$goodinfo = explode( ",",$goodsinfoarray[$j] );
			$goods .=" 物品：".$goodinfo[1]."，数量：".$goodinfo[2].";<br>";
			$goodsinfo.=" 物品：".$goodinfo[1]."，数量：".$goodinfo[2].";";
		}
		$keywordlist[$i]['goods'] = $goods;
		$keywordlist[$i]['goodsinfo'] = $goodsinfo;
	}
	
	if( $keywordlist[$i]['other_goodsinfo'] != "" )
	{
		$goodsinfolist = $keywordlist[$i]['other_goodsinfo'];
		$goodsinfoarray = explode(";",$goodsinfolist );
		$goods = "";
		$goodsinfo = "";
		for( $j=0;$j<count($goodsinfoarray);$j++ )
		{
			if( $goodsinfoarray[$j] == "")
			{
				continue;
			}
			$goodinfo = explode( ",",$goodsinfoarray[$j] );
			$goods .=" 物品：".$goodinfo[1]."，数量：".$goodinfo[2].";<br>";
			$goodsinfo.=" 物品：".$goodinfo[1]."，数量：".$goodinfo[2].";";
		}
		$keywordlist[$i]['other_goods'] = $goods;
		$keywordlist[$i]['other_goodsinfo'] = $goodsinfo;
	}
}

//输出Excel文件
if(isset($ex) && $ex == true )
{
	$excel = getExcel( $sql,$sqlcondition." ORDER BY datetime DESC " );
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

$smarty->assign("end", $end);
$smarty->assign("start", $start);
$smarty->assign("role_id", $roleid[0]['role_id']);
$smarty->assign("role_name", $roleid[0]['role_name']);
$smarty->assign("account_name", $roleid[0]['account_name']);
$smarty->assign("record_count", $count_result);
$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/$per_page_record));
$smarty->display("module/exchange/exchange_info.html");

function getExcel( $sql,$sqlcondition )
{
	$row_all	= GFetchRowSet($sql.$sqlcondition);
	$excel = array();
	
	$excel['title'] = '交易查询';
	$excel['hd'] =  array('日期','交易A','交易A付出银两','交易A付出元宝','交易A付出道具','消交易B','交易B付出银两',
		'交易B付出元宝','交易B付出道具',);
	$excel['hdnum'] = count($excel['hd']);
	
	$excel['content'] = array();
	foreach($row_all as $k=>$v)
	{
		$excel['content'][$k] = array();
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>date('Y-m-d H-M-S',$v['datetime']));
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['silver']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['gold']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['goodsinfo']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['other_role_name']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['other_silver']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['other_gold']);
		$excel['content'][$k][] = array('StyleID'=>'s29', 'Type'=>'String', 'content'=>$v['other_goodsinfo']);
	}
	return $excel;
}

