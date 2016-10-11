<?php
/*
 * 付费追踪统计
 */
define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

if (!isset($_REQUEST['dateStart'])){
	$dateStart = date("Y-m-")."1";
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}
if (!isset($_REQUEST['dateEnd'])){
	$dateEnd = date("Y-m-d");
}
else
{
	$dateEnd  = trim(SS($_REQUEST['dateEnd']));
}

$dateStartStamp = strtotime($dateStart . ' 0:0:0');
$dateEndStamp   = strtotime($dateEnd . ' 23:59:59');

$dateStartStr = strftime ("%Y-%m-%d", $dateStartStamp);
$dateEndStr = strftime ("%Y-%m-%d", $dateEndStamp);

$sql = "SELECT COUNT(`account_name`) as total FROM `db_account_p` WHERE create_time >= ".$dateStartStamp." AND create_time <= ".$dateEndStamp." and agent_id = ".$AGENT_ID." and server_id = ".$GAME_SERVER;
$row = GFetchRowOne($sql);
$zcrs = $row['total'];

//新玩家数据
$sql_new = "SELECT DATE(FROM_UNIXTIME(pay_time)) AS `date`,ROUND(SUM(pay_gold),0) AS pay_day_total, COUNT(DISTINCT role_id) AS role_cnt FROM `db_pay_log_p` AS p INNER JOIN db_account_p AS a ON a.account_name = p.account_name AND a.is_new_role != 1 WHERE a.create_time >= ".$dateStartStamp." AND a.create_time <= ".$dateEndStamp." and p.agent_id = ".$AGENT_ID." and p.server_id = ".$GAME_SERVER." and a.agent_id = ".$AGENT_ID." and a.server_id = ".$GAME_SERVER." GROUP BY DATE(FROM_UNIXTIME(pay_time)) ASC";
$newlist = GFetchRowSet($sql_new);

//老玩家数据
$sql_old = "SELECT DATE(FROM_UNIXTIME(pay_time)) AS `date`,ROUND(SUM(pay_gold),0) AS pay_day_total, COUNT(DISTINCT role_id) AS role_cnt FROM `db_pay_log_p` AS p INNER JOIN db_account_p AS a ON a.account_name = p.account_name AND a.is_new_role = 1 WHERE a.create_time >= ".$dateStartStamp." AND a.create_time <= ".$dateEndStamp." and p.agent_id = ".$AGENT_ID." and p.server_id = ".$GAME_SERVER." and a.agent_id = ".$AGENT_ID." and a.server_id = ".$GAME_SERVER." GROUP BY DATE(FROM_UNIXTIME(pay_time)) DESC";
$oldlist = GFetchRowSet($sql_old);

//老玩家登陆数据
$sql_dl_old = "SELECT DATE(FROM_UNIXTIME(d.login_time)) AS `date`,COUNT(DISTINCT d.role_id) as nums FROM t_log_day_stay AS d INNER JOIN db_role_base_p AS b ON d.role_id=b.role_id INNER JOIN db_account_p AS a ON a.account_name=b.account_name WHERE  a.create_time >= ".$dateStartStamp." AND a.create_time <= ".$dateEndStamp."  AND a.is_new_role = 1 and a.agent_id = ".$AGENT_ID." and a.server_id = ".$GAME_SERVER." and b.agent_id = ".$AGENT_ID." and b.server_id = ".$GAME_SERVER." GROUP BY DATE(FROM_UNIXTIME(d.login_time)) DESC";
$dloldlist = GFetchRowSet($sql_dl_old);

//新玩家登陆数据
$sql_dl_new = "SELECT DATE(FROM_UNIXTIME(d.login_time)) AS `date`,COUNT(DISTINCT d.role_id) as nums FROM t_log_day_stay AS d INNER JOIN db_role_base_p AS b ON d.role_id=b.role_id INNER JOIN db_account_p AS a ON a.account_name=b.account_name WHERE  a.create_time >= ".$dateStartStamp." AND a.create_time <= ".$dateEndStamp."  AND a.is_new_role != 1 and a.agent_id = ".$AGENT_ID." and a.server_id = ".$GAME_SERVER." and b.agent_id = ".$AGENT_ID." and b.server_id = ".$GAME_SERVER." GROUP BY DATE(FROM_UNIXTIME(d.login_time)) DESC";
$dlnewlist = GFetchRowSet($sql_dl_new);

$alllist = array();
foreach($newlist as $v){
	$array = array();
	$array["date"] = $v["date"];
	//老玩家登陆角色数
	foreach($dloldlist as $v1){
		if($v1["date"] == $v["date"]){
			$array["old_dljs"] = $v1["nums"];
		}
	}
	//新玩家登陆角色数
	foreach($dlnewlist as $v1){
		if($v1["date"] == $v["date"]){
			$array["new_dljs"] = $v1["nums"];
		}
	}
	//老玩家充值
	foreach($oldlist as $v1){
		if($v1["date"] == $v["date"]){
			$array["old_czje"] = $v1["pay_day_total"];
			$array["old_czrs"] = $v1["role_cnt"];
		}
	}
	//新玩家充值
	foreach($newlist as $v1){
		if($v1["date"] == $v["date"]){
			$array["new_czje"] = $v1["pay_day_total"];
			$array["new_czrs"] = $v1["role_cnt"];
		}
	}
	if($array["old_czrs"] > 0){
		$array["old_arpu"] = sprintf("%.2f",$array["old_czje"]/10/$array["old_czrs"]); 
	}
	if($array["new_czrs"] > 0){
		$array["new_arpu"] = sprintf("%.2f",$array["new_czje"]/10/$array["new_czrs"]);
	}

	$array["sum_dljs"] = $array["new_dljs"]+$array["old_dljs"];
	$array["sum_czje"] = $array["new_czje"]+$array["old_czje"];
	$array["sum_czrs"] = $array["new_czrs"]+$array["old_czrs"];
	
	if($array["sum_czrs"] > 0){
		$array["sum_arpu"] = sprintf("%.2f",$array["sum_czje"]/$array["sum_czrs"]/10);
	}
	else{
		$array["sum_arpu"] = 0;
	}
	
	$alllist[] = $array;
}

$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);
$smarty->assign("zcrs", $zcrs);
$smarty->assign("keywordlist", $alllist);
$smarty->assign("length", count($alllist));

$smarty->display("module/pay/pay_track_log.html");
