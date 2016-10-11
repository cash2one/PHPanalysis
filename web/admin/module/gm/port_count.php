<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db; 

$port = trim($_POST['port']);

$tablename = "t_account_port";
$where = '1';
$pageno = getUrlParam('page');
$search_sort = "port desc";
$count_result = 0;

if (!empty($port))
{
	$where .= " AND `port` = '{$port}'";
}

$keywordlist = getList($tablename, $where, $pageno, $search_sort, LIST_PER_PAGE_RECORDS, $count_result);
$pagelist	= getPages($pageno, $count_result,LIST_PER_PAGE_RECORDS);


$sql = 'SELECT `port` , count( `port` ) as port_count '
     . ' FROM `t_account_port` ';
if(!empty($port))
{
	$sql .= ' WHERE `port`=' .$port;
	
	$sql .= ' group by `port` ';
	$sql .= ' order by port_count desc';
	
	$result = GFetchRowSet($sql);
}

$smarty->assign("keywordlist", $keywordlist);
$smarty->assign("port_count", $result);

$smarty->assign("search1", $port);
$smarty->assign("record_count", $count_result);
$smarty->assign("page_list", $pagelist);
$smarty->assign("page_count", ceil($count_result/LIST_PER_PAGE_RECORDS));

$smarty->display("module/gm/port_count.html");

