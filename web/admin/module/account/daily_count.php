<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/class/auth.class.php";
include SYSDIR_ADMIN."/class/db.class.php";
include SYSDIR_ADMIN."/class/user.class.php";

include SYSDIR_ADMIN."/library/smarty/Smarty.class.php";
include SYSDIR_ADMIN."/include/functions.php";
include SYSDIR_ADMIN."/include/db_defines.php";

global $smarty, $auth, $db, $dbConfig;

ob_start();
session_start();

//初始化smarty
$smarty = new Smarty();
$smarty->compile_check = true;
$smarty->force_compile = true;
$smarty->template_dir = SYSDIR_ADMIN."/template/default/";
$smarty->compile_dir = SYSDIR_ADMIN."/template_c";
$smarty->left_delimiter = '<{';
$smarty->right_delimiter = '}>';

//初始化数据库连接
$db = new DBClass();
$db->connect($dbConfig);

if(!isset($_REQUEST['check'])){
	die(0);
}

$nowTime = time();
$oneDay = $nowTime-86400;

$midNight = strtotime(strftime("%Y-%m-%d"))-86400;

$sql = "SELECT * FROM t_account_login_count where date={$midNight} limit 1";
$loginRow = $db->fetchOne($sql);
$login = $loginRow['total_number'];

//搜索新增账号
$sqlNewAccount = "SELECT count(account_name) as count FROM ".T_DB_ACCOUNT_P." where create_time >={$oneDay} AND create_time <={$nowTime}";
$newAccountRow = $db->fetchOne($sqlNewAccount);
$newAccount = $newAccountRow['count'];

//搜索充值记录
$sqlPay = "SELECT role_id ,pay_gold ,pay_money ,pay_ticket FROM `db_pay_log_p` where pay_time >={$oneDay} AND pay_time <={$nowTime}";
$payAll = $db->fetchAll($sqlPay);
$roleCount = 0;
$totalPay = 0;
$totalGold = 0;
$tmpArr = array();
foreach($payAll as $v){
	if(!isset($tmpArr[$v['role_id']])){
		$roleCount++;
		$tmpArr[$v['role_id']]=true;
	}
	$totalPay+=$v['pay_money']+$v['pay_ticket']*10;
	$totalGold+=$v['pay_gold'];
}
if($roleCount==0){
	$arpu=0;
}else{
	$arpu = intval($totalPay/$roleCount);
}

$sqlMoney = "SELECT sum( `gold` ) AS gold, sum( `gold_bind` ) AS gold_bind, sum( `silver` ) AS silver FROM `db_role_attr_p` WHERE 1";
$moneyRow = $db->fetchOne($sqlMoney);
$allGold = $moneyRow['gold'];
$totalBindGold = $moneyRow['gold_bind'];
$totalSilver = $moneyRow['silver'];


//搜索元宝消耗
$sqlCons = "SELECT SUM(`gold_unbind`) as usum ,SUM(gold_bind) as bsum FROM `t_log_use_gold` "
		   ."where gold_unbind>=0 AND gold_bind >=0 and mtime >={$oneDay} AND mtime <={$nowTime} ";
$consRow = $db->fetchOne($sqlCons);
$ucons = $consRow['usum'];
$bcons = $consRow['bsum'];

//搜索元宝获得
$sqlGenCons = "SELECT SUM(`gold_unbind`) as usum ,SUM(gold_bind) as bsum FROM `t_log_use_gold` "
		   ."where gold_unbind<0 OR gold_bind <0 and mtime >={$oneDay} AND mtime <={$nowTime} ";
$consGenRow = $db->fetchOne($sqlGenCons);
$uGen = -$consGenRow['usum'];
$bGen = -$consGenRow['bsum'];

//搜索银两消耗
$sqlsCons = "SELECT SUM(`silver_unbind`) as usum  FROM `t_log_use_silver` "
		   ."where silver_unbind>0 and mtime >={$oneDay} AND mtime <={$nowTime} ";
$conssRow = $db->fetchOne($sqlsCons);
$uscons = $conssRow['usum'];
//搜索银两获得
$sqlsGen = "SELECT SUM(`silver_unbind`) as usum  FROM `t_log_use_silver` "
		   ."where silver_unbind<0 and mtime >={$oneDay} AND mtime <={$nowTime} ";
$sGenRow = $db->fetchOne($sqlsGen);
$sGen = -$sGenRow['usum'];

$sqlActive = "SELECT count(db_role_base_p.role_id) as count FROM `db_role_base_p`  , db_role_ext_p " .
		"WHERE `db_role_base_p`.role_id=db_role_ext_p.role_id " .
		"and `db_role_ext_p`.last_login_time >={$oneDay} and `db_role_ext_p`.last_login_time <={$nowTime}".
		" and `db_role_ext_p`.last_login_time-db_role_base_p.create_time >2592000";
$ActiveRow = $db->fetchOne($sqlActive);
$Active = $ActiveRow['count'];

$maxOnline = get_online_max($oneDay,$nowTime);
$nowTime1 = $nowTime-86400;

$insertSql = "INSERT INTO `{$dbConfig['dbname']}`.`daily_report` (`datetime` ,`total_login` ,`new_account` ,`total_pay` ,`total_gold` ,`gold_cons` ,`pay_num` ,`arpu` ,`hight_online` ,`avg_online` ,`avg_ol_time` ,`active_user`,`all_gold`,`all_bind_gold`,`all_silver`,`bind_gold_cons`,`gold_gen`,`bind_gold_gen`,`silver_cons`,`silver_gen`)" .
		" VALUES (" .
		" '{$nowTime1}', '{$login}', '{$newAccount}', '{$totalPay}', '{$totalGold}', '{$ucons}', '{$roleCount}', '{$arpu}', '{$maxOnline}', '0', '0', '{$Active}','{$allGold}','{$totalBindGold}','{$totalSilver}','{$bcons}','{$uGen}','{$bGen}','{$uscons}','{$sGen}')";


$db->fetchOne($insertSql);

//-----------------------------------------------------------------------------
$sql = "SELECT count(`role_id`) as c   FROM `db_role_attr_p` " . " WHERE `level`>=1 and `level`<=10 " . "  ";
$row = $db->fetchOne($sql);
$Level1=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>10 and `level`<=20 " . "  ";
$row = $db->fetchOne($sql);
$Level2=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>10 and `level`<=20 " . "  ";
$row = $db->fetchOne($sql);
$Level2=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>20 and `level`<=30 " . "  ";
$row = $db->fetchOne($sql);
$Level3=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>30 and `level`<=40 " . "  ";
$row = $db->fetchOne($sql);
$Level4=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>40 and `level`<=50 " . "  ";
$row = $db->fetchOne($sql);
$Level5=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>50 and `level`<=60 " . "  ";
$row = $db->fetchOne($sql);
$Level6=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>60 and `level`<=70 " . "  ";
$row = $db->fetchOne($sql);
$Level7=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>70 and `level`<=80 " . "  ";
$row = $db->fetchOne($sql);
$Level8=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>80 and `level`<=90 " . "  ";
$row = $db->fetchOne($sql);
$Level9=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>90 and `level`<=100 " . "  ";
$row = $db->fetchOne($sql);
$Level10=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>100 and `level`<=110 " . "  ";
$row = $db->fetchOne($sql);
$Level11=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>110 and `level`<=120 " . "  ";
$row = $db->fetchOne($sql);
$Level12=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>120 and `level`<=130 " . "  ";
$row = $db->fetchOne($sql);
$Level13=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>130 and `level`<=140 " . "  ";
$row = $db->fetchOne($sql);
$Level14=$row['c'];

$sql = "SELECT count(`role_id`) as c  FROM `db_role_attr_p` " . " WHERE `level`>140 and `level`<=150 " . "  ";
$row = $db->fetchOne($sql);
$Level15=$row['c'];

$sql = "insert into `t_level_count` (`datetime`,`Level1`,`Level2`,`Level3`,`Level4`,`Level5`,`Level6`,`Level7`,`Level8`,`Level9`,`Level10`,`Level11`,`Level12`,`Level13`,`Level14`,`Level15`) " .
		"values('".$nowTime."','" . $Level1 . "','" . $Level2 . "','" . $Level3 . "','" . $Level4 . "','" . $Level5 . "','" . $Level6 . "','" . $Level7 .
		"','" . $Level8 . "','" . $Level9 . "','" . $Level10 . "','" . $Level11 . "','".$Level12."','".$Level13."','".$Level14."','".$Level15."')";
$db->fetchOne($sql);


//--------------------------------------------------------------------------------------------


function get_online_max($startTime,$overTime){
	global $db;
	$sql= " SELECT max(`online`) as maxonline FROM ".T_LOG_ONLINE." WHERE 1=1 ";
	$sql.=" and dateline>=".$startTime." and dateline<=".$overTime;
	$row = $db->fetchOne($sql);
	return $row['maxonline'];
}
