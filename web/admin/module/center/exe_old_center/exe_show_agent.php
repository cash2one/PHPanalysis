<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

$action = $_REQUEST['action'];
echo $action."<br>";

if($action == "doDelete")
{
	echo "test delete";
}
else if($action == "doAdd")
{
	echo "test add";
}

$sql = "SELECT * from t_sum_agent order by id asc";
$result = $db->FetchAll($sql);
//print_r($result);

$smarty->assign("all_agent", $result);
$smarty->display("module/center/exe_show_agent.html");
