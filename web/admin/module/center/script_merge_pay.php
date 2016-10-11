<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../config/config.center.php";
include SYSDIR_ADMIN.'/include/global.php';

echo "finish merging!";
die();

$agent_id = 6;

$server_id = 3;
$tablename = "m_pay_966_s".$server_id;

//echo $tablename;die();


$sql = "select * from {$tablename} order by id asc";
$result = $db->fetchAll($sql);

$sql_add = 'INSERT INTO `'.$dbConfig['dbname'].'`.`all_source_paylog` (`id`, `order_id`, `role_id`, `role_name`, `account_name`, `pay_time`, `pay_gold`, `pay_money`, `agent_id`, `server_id`) VALUES '; 
$comma_flag = false;


foreach($result as $key2 => $value2)
{
	if($comma_flag)
	{
		$sql_add .= ', ';
	}
	$sql_add .= '(NULL, \'' .
		$value2['order_id'] .
		'\', \'' .
		$value2['role_id'] .
		'\', \'' .
		$value2['role_name'] .
		'\', \'' .
		$value2['account_name'] .
		'\', \'' .
		$value2['pay_time'] .
		'\', \'' .
		$value2['pay_gold'] .
		'\', \'' .
		$value2['pay_money'] .
		'\', \'' .
		$agent_id .
		'\', \'' .
		$server_id .
		'\')';
	$comma_flag = true;	
}

$sql_add .= ';';

$db->query($sql_add);
echo "well done*".$agent_id."*".$server_id;
