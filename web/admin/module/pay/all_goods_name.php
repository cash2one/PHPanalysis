<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';

$GOODS_TYPE = array(
	5 => '道具',
	6 => '宝石',
	7 => '装备'
);


$q = strtolower($_GET["term"]);
if(!empty($q))
{
	$query=mysql_query("select id, name, type from config_goods where name like '%$q%' order by type asc, id asc limit 0,20");
	
	while ($row=mysql_fetch_array($query)) {
		$result[] = array(
			'id' => $row['id'],
			'label' => $row['id'],
			'name' => $row['name'],
			'type' => $GOODS_TYPE[$row['type']]
		);
	}
}

echo json_encode($result);