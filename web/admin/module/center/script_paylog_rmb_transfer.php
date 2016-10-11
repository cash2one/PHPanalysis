<?php
define('IN_DATANG_SYSTEM', true);
//include "../../../config/config.php";
//include "../../../config/config.center.php";
//include SYSDIR_ADMIN.'/include/global.php';

include "/data/sgclient/web/config/config.php";
include "/data/sgclient/web/config/config.center.php";
include "/data/sgclient/web/include/global.php";

echo "error,dont run this script, pls!";
die();

$sql_all_paylog = "SELECT * FROM all_source_paylog WHERE agent_id=2";
$result_all_paylog = $db->fetchAll($sql_all_paylog);

foreach($result_all_paylog as $key => $value)
{
	//台币对人民币的汇率为：4.75
	if($value['agent_id'] == 2)
	{
		$tmp_money = round($value['pay_money']/4.75, 2);
	}
	else
	{
		$tmp_money = $value['pay_money'];
	}
	
	$sql_rmb_transfer = 'REPLACE INTO `'.$dbConfig['dbname'].'`.`all_source_paylog_rmb` (`id`, `order_id`, `role_id`, `role_name`, `account_name`, `pay_time`, `pay_gold`, `pay_money`, `agent_id`, `server_id`) VALUES (' .
			$value['id'] .
			', \'' .
			$value['order_id'] .
			'\', \'' .
			$value['role_id'] .
			'\', \'' .
			$value['role_name'] .
			'\', \'' .
			$value['account_name'] .
			'\', \'' .
			$value['pay_time'] .
			'\', \'' .
			$value['pay_gold'] .
			'\', \'' .
			$tmp_money .
			'\', \'' .
			$value['agent_id'] .
			'\', \'' .
			$value['server_id'] .
			'\');'; 
	$db->query($sql_rmb_transfer);
}