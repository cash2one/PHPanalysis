<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$year = date('Y');
$month = date('m');
$day = date('d');

//取出总注册账号的数量、取出总的角色数量
$sqlAllAccount = "SELECT COUNT(account_name) AS count FROM ".T_DB_ACCOUNT_P." WHERE 1";
$result = $db->fetchOne($sqlAllAccount);
$countOfAccount = $result['count'];

$sqlAllRole = "SELECT COUNT(role_id) AS count FROM ".T_DB_ROLE_ATTR_P. " WHERE 1";
$result = $db->fetchOne($sqlAllRole);
$countOfRole = $result['count'];

/*$sqlFactionRole = "SELECT faction_id ,number FROM ".T_DB_ROLE_FACTION_P." WHERE 1 GROUP BY faction_id";
$result = $db->fetchAll($sqlFactionRole);

foreach ($result as $v) {
	if ($v['faction_id'] == 1) {
		$role_count_of_wei = $v['number'];
	} else if ($v['faction_id'] == 2) {
		$role_count_of_shu = $v['number'];
	} else if ($v['faction_id'] == 3) {
		$role_count_of_wu = $v['number'];
	} else if ($v['faction_id'] == 0) {
		$role_count_of_no = $v['number'];
	}
}*/
/*$sql_wei = "select COUNT(faction_id) as count FROM ".T_DB_ROLE_BASE_P." WHERE faction_id=1";
$result1 = $db->fetchOne($sql_wei);

$countWei = $result1['count'];*/
$role_count_of_wei = countryCount(1,$db);
$role_count_of_shu = countryCount(2,$db);
$role_count_of_wu = countryCount(3,$db);
$role_count_of_no = countryCount(0,$db);


//已创建角色的账号
$sqlAllHaveRoleAccount = "SELECT account_name FROM ".T_DB_ROLE_BASE_P.";";
$result = $db->fetchAll($sqlAllHaveRoleAccount);
$countHaveRoleAccountTemp=array();
$countHaveRoleAccount = 0;
foreach ($result as $v) {
	if (!isset($countHaveRoleAccountTemp[$v['account_name']])) {
		$countHaveRoleAccountTemp[$v['account_name']] = true;
		$countHaveRoleAccount++;
	}
}
//SELECT COUNT(a.account_name) AS count FROM db_account_p a ,db_role_base_p b  WHERE a.account_name in (b.account_name);
//
$smarty->assign(array(
	'role_count_of_wei' => $role_count_of_wei,
	'role_count_of_shu' => $role_count_of_shu,
	'role_count_of_wu' => $role_count_of_wu,
	'role_count_of_no'=> $role_count_of_no
));
if(!isset($_REQUEST['dateStart'])){
	$startTimeStr = strftime ("%Y-%m-%d");
}else{
	$startTimeStr = $_REQUEST['dateStart'];
}
if(!isset($_REQUEST['dateEnd'])){
	$endTimeStr = strftime ("%Y-%m-%d");
}else{
	$endTimeStr = $_REQUEST['dateEnd'];
}
$startTime = strtotime($startTimeStr);
$endTime = strtotime($endTimeStr)+86400;
//分时显示
$sql = "SELECT YEAR( FROM_UNIXTIME( create_time ) ) as `year`, MONTH( FROM_UNIXTIME( create_time ) ) as `month`, DAY( FROM_UNIXTIME( create_time ) ) as `day`,"
		 . " HOUR( FROM_UNIXTIME( create_time ) ) as `hour`, COUNT(`account_name`) as c FROM `".T_DB_ACCOUNT_P."` WHERE create_time>={$startTime} AND create_time<={$endTime} "
		 . " GROUP BY `year`,`month`,`day`,`hour` WITH ROLLUP " ;
		 //用了 WITH ROLLUP 就不能再用ORDER BY

$result = $db->fetchAll($sql);
$smarty->assign(array(
	'start'=>$startTimeStr,
	'end'=>$endTimeStr,
	'keywordlist'=>$result,
	'account_count' => $countOfAccount,
	'role_count' => $countOfRole,
	'HaveRoleAccount'=>$countHaveRoleAccount,
	'HaveRoleAccountload'=>($countOfAccount-$countHaveRoleAccount)/$countOfAccount
));
$smarty->display("module/register/today.html");

function countryCount($country,$db){
    $sql_wei = "select COUNT(faction_id) as count FROM ".T_DB_ROLE_BASE_P." WHERE faction_id= ".$country;
    $result1 = $db->fetchOne($sql_wei);

    return $result1['count'];
}