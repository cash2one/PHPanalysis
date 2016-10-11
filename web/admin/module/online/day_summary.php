<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include "../../../admin/class/log_gold_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty;

if(!isset($_REQUEST['dateStart'])){
	$dateStart = strftime ("%Y-%m-%d", time()-7*86400);
}else{
	$dateStart = $_REQUEST['dateStart'];
}
if(!isset($_REQUEST['dateEnd'])){
	$dateEnd = strftime("%Y-%m-%d");
}else{
	$dateEnd = $_REQUEST['dateEnd'];
}

$dateStartTime = strtotime($dateStart);
$dateEndTime = strtotime($dateEnd)+86400;

//注册人数查询
$sql_reg = "SELECT DATE( from_unixtime(create_time, '%Y-%m-%d')) as date_time, count( account_name ) reg_cnt FROM `db_account_p` WHERE create_time>=".$dateStartTime ." and create_time <=" .$dateEndTime." and agent_id = ".$AGENT_ID." and server_id = ".$GAME_SERVER." group by date_time order by date_time desc";
$result_reg = GFetchRowSet($sql_reg);
//echo '<pre>';print_r($result_reg);exit;
foreach($result_reg as $key => $value)
{
    $tag = $value['date_time'];
    $result[$tag]['reg_cnt'] = $value['reg_cnt'];
    $result[$tag]['date_time'] = $value['date_time'];
}

/*//注册汇总
$sql = "SELECT count(account_name) AS reg_cnt FROM `db_account_p` WHERE create_time>=".$dateStartTime ." and create_time <=" .$dateEndTime." and agent_id = ".$AGENT_ID." and server_id = ".$GAME_SERVER;
$collect = GFetchRowSet($sql);
echo '<pre>';print_r($back);exit;

foreach($collect as $k=>$v){

}
*/

$server_id_tag = 'S'.$GAME_SERVER;

//进入场景数
$sql_reg = "SELECT DATE(FROM_UNIXTIME(`datetime`)) AS `date_time`,COUNT(event) AS `reg_cnt` FROM `t_log_game_event2` WHERE datetime>=".$dateStartTime ." and datetime <=" .$dateEndTime." and event IN ('playercreated', 'entergame', 'mission0', 'mission1', 'mission2', 'mission3', 'mission4', 'mission5') AND server_name='".$server_id_tag."' GROUP BY `date_time` DESC order by `date_time` desc";
$result_reg = GFetchRowSet($sql_reg);

//echo '<pre>';print_r($result_reg);exit;
foreach($result_reg as $key => $value)
{
	$tag = $value['date_time'];
	$result[$tag]['cjjs'] = $value['reg_cnt'];
	$result[$tag]['date_time'] = $value['date_time'];
}

/*//进入场景创建角色汇总
$sql = "SELECT COUNT(event) AS `reg_cnt` FROM `t_log_game_event2` WHERE datetime>=".$dateStartTime ." and datetime <=" .$dateEndTime." and event IN ('playercreated', 'entergame', 'mission0', 'mission1', 'mission2', 'mission3', 'mission4', 'mission5') AND server_name='".$server_id_tag."'";
$collect = GFetchRowSet($sql);
//echo '<pre>';print_r($collect);exit;

foreach($collect as $a => $b){

}*/



$sql_login = "SELECT DATE( from_unixtime(date, '%Y-%m-%d')) as date_time, total_number, once_number FROM ".T_ACCOUNT_LOGIN_COUNT." WHERE date >={$dateStartTime} AND date <={$dateEndTime}" ;
$result_login = GFetchRowSet($sql_login);


foreach($result_login as $key_login => $value_login)
{
	$tag = $value_login['date_time'];
	$result[$tag]['total_login'] = $value_login['total_number'];
	$result[$tag]['once_login'] = $value_login['once_number'];
	$result[$tag]['date_time'] = $value_login['date_time'];
}

/*
$sql = "SELECT sum(total_number) as total_number, sum(once_number) as once_number FROM ".T_ACCOUNT_LOGIN_COUNT." WHERE date >={$dateStartTime} AND date <={$dateEndTime} " ;
$collect = GFetchRowSet($sql);
//echo '<pre>';print_r($collect);exit;

foreach($collect as $d => $c){

}*/

$sql_pay = 'SELECT DATE( from_unixtime(pay_time, \'%Y-%m-%d\')) as date_time, round(sum(pay_money)/100+sum(pay_ticket)/10,2) as pay_day, round(sum(pay_money)/100,2) as pay_qq_day, round(sum(pay_ticket)/10,2) as pay_ticket_day,' .
		' count(distinct role_id) as role_cnt, count(role_id) as times_cnt, round((sum(pay_money)/100+sum(pay_ticket)/10)/(count(distinct role_id)), 2) as arpu' .
		' FROM `db_pay_log_p` where `pay_time` >= '.$dateStartTime.' and pay_time <= '.$dateEndTime.' and agent_id = '.$AGENT_ID.' and server_id = '.$GAME_SERVER.' group by date_time order by date_time desc'; 
$result_pay = GFetchRowSet($sql_pay);
//echo '<pre>';print_r($result_pay);exit;

foreach ($result_pay as $key_pay => $value_pay)
{
	$tag = $value_pay['date_time'];
	$result[$tag]['date_time'] = $value_pay['date_time'];
	$result[$tag]['pay_day'] = $value_pay['pay_day'];
	$result[$tag]['pay_qq_day'] = $value_pay['pay_qq_day'];
	$result[$tag]['pay_ticket_day'] = $value_pay['pay_ticket_day'];
	$result[$tag]['role_cnt'] = $value_pay['role_cnt'];
	$result[$tag]['times_cnt'] = $value_pay['times_cnt'];
	$result[$tag]['arpu'] = $value_pay['arpu'];
}

/*
$sql = 'SELECT round(sum(pay_money)/100+sum(pay_ticket)/10,2) as pay_day, round(sum(pay_money)/100,2) as pay_qq_day, round(sum(pay_ticket)/10,2) as pay_ticket_day,' .
    ' count(distinct role_id) as role_cnt, count(role_id) as times_cnt, round((sum(pay_money)/100+sum(pay_ticket)/10)/(count(distinct role_id)), 2) as arpu' .
    ' FROM `db_pay_log_p` where `pay_time` >= '.$dateStartTime.' and pay_time <= '.$dateEndTime.' and agent_id = '.$AGENT_ID.' and server_id = '.$GAME_SERVER;
$collect = GFetchRowSet($sql);

foreach ($collect as $e => $f){

}*/



$sql_gold = "SELECT DATE( from_unixtime(mtime, '%Y-%m-%d')) as date_time, SUM(`gold_unbind`) AS `gold_spent` FROM `t_log_use_gold` WHERE `mtime`>=" . $dateStartTime  ." AND `mtime`<=" . $dateEndTime . " AND ";
$loger = new LogGoldClass();
if($types = $loger->getSpendTypeList()) {
	$sql_gold .= "(";
	foreach($types as $mtype => $_desc) {
		$sql_gold .= "`mtype`=$mtype or ";
	}
	$sql_gold = trim($sql_gold, " or ");
	$sql_gold .= ") ";
	$sql_gold .= "GROUP BY date_time";
	$result_gold = GFetchRowSet($sql_gold);
}
foreach($result_gold as $key_gold => $value_gold)
{
	$tag = $value_gold['date_time'];
	$result[$tag]['date_time'] = $value_gold['date_time'];
	$result[$tag]['gold_spent'] = $value_gold['gold_spent'];
}


$sql_max_online = 'SELECT DATE( from_unixtime(dateline, "%Y-%m-%d")) as date_time,MAX(online) as max_online FROM `t_log_online` WHERE dateline>='.$dateStartTime. ' AND dateline<='.$dateEndTime.' GROUP BY year,month,day';
$result_max_online = GFetchRowSet($sql_max_online);
//echo '<pre>';print_r($result_max_online);exit;
foreach($result_max_online as $key=>$value)
{
    $tag = $value['date_time'];
    $result[$tag]['max_online'] = $value['max_online'];
}
//echo '<pre>';print_r($result);exit;
if(!empty($result))
{
	krsort($result);
}

//汇总 除arpu date_time max_online
$arr = array();
$str = array();
foreach($result as $k => $v){
    foreach ($v as $key => $val){
        if($key != 'date_time'&& $key != 'max_online'&& $key != 'arpu'){
            $arr[$key] += $val;
        }else if($key == 'max_online'){
            $str[$k] = $val;
        }
    }
}
//取最大值 max_online
$pos = array_search(max($str), $str);
$arr['max_online'] = $str[$pos];

//求玩家ARPU Arpu = 充值总额/充值人数
if(!empty($arr['pay_day'])){
    $arr['arpu'] = $arr['pay_day']/$arr['role_cnt'];
}

$smarty->assign(array(
	'dateStart'=>$dateStart,
	'dateEnd'=>$dateEnd,
	'result' =>$result,
    'arr' => $arr,
));
$smarty->display("module/online/day_summary.html");

