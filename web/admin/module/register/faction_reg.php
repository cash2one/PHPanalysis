<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$year = date('Y');
$month = date('m');
$day = date('d');

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

$faction=trim($_POST['faction']);
if (empty($faction))
{
	$faction = "wei";
}

if($faction=="wei"){
	/*$sqlAllAccount = "SELECT * FROM ".T_DB_ROLE_FACTION_P." WHERE faction_id='1'";
    $result = $db->fetchOne($sqlAllAccount);
    $number = $result['number'];*/
    $sqlAll = "select * FROM `".T_DB_ROLE_BASE_P."` where faction_id='1'";
    $num = $db->fetchAll($sqlAll);
    $number = count($num);


    $sql = "SELECT YEAR( FROM_UNIXTIME( create_time ) ) as `year`, "
		 . " MONTH( FROM_UNIXTIME( create_time ) ) as `month`, "
		 . " DAY( FROM_UNIXTIME( create_time ) ) as `day`,"
		 . " HOUR( FROM_UNIXTIME( create_time ) ) as `hour`,"
		 . " COUNT(role_name) as c FROM `".T_DB_ROLE_BASE_P."` "
		 . " WHERE create_time>={$startTime} AND create_time<={$endTime} and faction_id='1' "
		 . " GROUP BY `year`,`month`,`day`,`hour` WITH ROLLUP " ;
		 //用了 WITH ROLLUP 就不能再用ORDER BY

    $result = $db->fetchAll($sql);

}

if($faction=="shu"){
    $sqlAll = "select * FROM `".T_DB_ROLE_BASE_P."` where faction_id='2'";
    $num = $db->fetchAll($sqlAll);
    $number = count($num);
    $sql = "SELECT YEAR( FROM_UNIXTIME( create_time ) ) as `year`, "
		 . " MONTH( FROM_UNIXTIME( create_time ) ) as `month`, "
		 . " DAY( FROM_UNIXTIME( create_time ) ) as `day`,"
		 . " HOUR( FROM_UNIXTIME( create_time ) ) as `hour`,"
		 . " COUNT(role_name) as c FROM `".T_DB_ROLE_BASE_P."` "
		 . " WHERE create_time>={$startTime} AND create_time<={$endTime} and faction_id='2' "
		 . " GROUP BY `year`,`month`,`day`,`hour` WITH ROLLUP " ;
		 //用了 WITH ROLLUP 就不能再用ORDER BY
    $result = $db->fetchAll($sql);
}

if($faction=="wu"){
    $sqlAll = "select * FROM `".T_DB_ROLE_BASE_P."` where faction_id='3'";
    $num = $db->fetchAll($sqlAll);
    $number = count($num);
    $sql = "SELECT YEAR( FROM_UNIXTIME( create_time ) ) as `year`, "
		 . " MONTH( FROM_UNIXTIME( create_time ) ) as `month`, "
		 . " DAY( FROM_UNIXTIME( create_time ) ) as `day`,"
		 . " HOUR( FROM_UNIXTIME( create_time ) ) as `hour`,"
		 . " COUNT(role_name) as c FROM `".T_DB_ROLE_BASE_P."` "
		 . " WHERE create_time>={$startTime} AND create_time<={$endTime} and faction_id='3' "
		 . " GROUP BY `year`,`month`,`day`,`hour` WITH ROLLUP " ;
		 //用了 WITH ROLLUP 就不能再用ORDER BY
    $result = $db->fetchAll($sql);
}

if($faction=="no"){
    $sqlAll = "select * FROM `".T_DB_ROLE_BASE_P."` where faction_id='0'";
    $num = $db->fetchAll($sqlAll);
    $number = count($num);
    $sql = "SELECT YEAR( FROM_UNIXTIME( create_time ) ) as `year`, "
		 . " MONTH( FROM_UNIXTIME( create_time ) ) as `month`, "
		 . " DAY( FROM_UNIXTIME( create_time ) ) as `day`,"
		 . " HOUR( FROM_UNIXTIME( create_time ) ) as `hour`,"
		 . " COUNT(role_name) as c FROM `".T_DB_ROLE_BASE_P."` "
		 . " WHERE create_time>={$startTime} AND create_time<={$endTime} and faction_id='0' "
		 . " GROUP BY `year`,`month`,`day`,`hour` WITH ROLLUP " ;
		 //用了 WITH ROLLUP 就不能再用ORDER BY
    $result = $db->fetchAll($sql);
}

$smarty->assign(array(
    'faction'=>$faction,
    'number'=>$number,
	'start'=>$startTimeStr,
	'end'=>$endTimeStr,
	'keywordlist'=>$result,
));

$smarty->display("module/register/faction_reg.html");

