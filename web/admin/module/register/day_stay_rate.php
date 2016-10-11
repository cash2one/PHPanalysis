<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

$server_id_tag = 'S'.$GAME_SERVER;

$zhuce_list = array();

//登陆请求
$sqldlqq = "SELECT DATE(FROM_UNIXTIME(`create_time`)) AS `date`, COUNT(account_name) AS `count` FROM db_account_p where agent_id = ".$AGENT_ID." and server_id = ".$GAME_SERVER." GROUP BY DATE(FROM_UNIXTIME(`create_time`)) DESC";
$resdlqq = $db->fetchAll($sqldlqq);
/*echo '<pre>';
print_r($resdlqq);exit;*/
//点击创建角色数
$sqlcjjs = "SELECT DATE(FROM_UNIXTIME(`datetime`)) AS `date`,COUNT(event) AS `count` FROM `t_log_game_event2` WHERE event IN ('playercreated', 'entergame', 'mission0', 'mission1', 'mission2', 'mission3', 'mission4', 'mission5') AND server_name='".$server_id_tag."' GROUP BY DATE(FROM_UNIXTIME(`datetime`)) DESC";
$rescjjs = $db->fetchAll($sqlcjjs);
/*echo '<pre>';
print_r($rescjjs);exit;*/
//进入游戏场景数
$sqljrcj = "SELECT DATE(FROM_UNIXTIME(`datetime`)) AS `date`,COUNT(event) AS `count` FROM `t_log_game_event2` WHERE event IN ('entergame', 'mission0', 'mission1', 'mission2', 'mission3', 'mission4', 'mission5') AND server_name='".$server_id_tag."' GROUP BY DATE(FROM_UNIXTIME(`datetime`)) DESC";
$resjrcj = $db->fetchAll($sqljrcj);
/*echo '<pre>';
print_r($resjrcj);exit;*/

foreach($resdlqq as $v){
	$array = array();
	$array["zcrq"] = $v["date"];
	
	$array["dlqq"] = $v["count"];
	//点击创建角色数
	foreach($rescjjs as $v1){
		if($v1["date"] == $v["date"]){
			$array["cjjs"] = $v1["count"];
		}
	}
	//进入游戏场景数
	foreach($resjrcj as $v1){
		if($v1["date"] == $v["date"]){
			$array["jrcj"] = $v1["count"];
		}
	}

	$time = strtotime($v["date"]);
	for($i=1;$i<30;$i++){
		$sqlday = "SELECT COUNT(DISTINCT b.role_id) as nums FROM t_log_day_stay AS d
                  INNER JOIN db_role_base_p AS b ON d.role_id=b.role_id
                  INNER JOIN db_account_p AS a ON a.account_name=b.account_name
                  WHERE a.create_time >= ".$time." AND a.create_time <= ".($time+60*60*24)." and
                   b.agent_id = ".$AGENT_ID." and b.server_id = ".$GAME_SERVER." and a.agent_id = ".$AGENT_ID." and
                    a.server_id = ".$GAME_SERVER." and
                     d.login_time >= ".($time+($i*60*60*24))." and d.login_time < ".($time+(($i+1)*60*60*24));
		$resday = $db->fetchOne($sqlday);

		$array[$i."day"] = $resday["nums"];
		if($array["jrcj"] > 0){
			$array[$i."rate"] = sprintf("%.2f", ($resday["nums"]/$array["jrcj"]*100))."%";
		}
		else{
			$array[$i."rate"] = 0;
		}

	}

	$zhuce_list[] = $array;
}

/*echo '<pre>';
print_r($zhuce_list);exit;*/
$smarty->assign('zhuce_list',$zhuce_list);
$smarty->display("module/register/day_stay_rate.html");

?>

