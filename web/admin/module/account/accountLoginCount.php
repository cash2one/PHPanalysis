<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

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


//搜索日期区间的登陆数据
$sqlCountNum = "SELECT date, sum(total_number) total_number, sum(once_number) once_number FROM ".T_ACCOUNT_LOGIN_COUNT." WHERE date >={$dateStartTime} AND date <={$dateEndTime} GROUP BY FROM_UNIXTIME(date, '%Y-%m-%d' ) " ;

$sqlCount = "SELECT c.date date, c.total_number total_number, c.once_number once_number, d.new_count new_count, l.lost_count/c.total_number*100 lost"
		 ." FROM ($sqlCountNum) c,(SELECT FROM_UNIXTIME( create_time, '%Y-%m-%d' ) time, count( 1 ) new_count FROM db_account_p where agent_id = ".$AGENT_ID." and server_id = ".$GAME_SERVER." GROUP BY FROM_UNIXTIME( create_time, '%Y-%m-%d' ) ) d,"
		 ."( SELECT FROM_UNIXTIME( create_time, '%Y-%m-%d' ) time, count( 1 ) lost_count FROM db_account_p WHERE agent_id = ".$AGENT_ID." and server_id = ".$GAME_SERVER." and last_login_time <= sysdate( ) -259200 GROUP BY FROM_UNIXTIME( create_time, '%Y-%m-%d' ) ) l WHERE FROM_UNIXTIME( c.date ) = d.time AND d.time = l.time ";

$resultCount = $db->fetchAll($sqlCount);

//生成最终数据
$dataArr = array();
$count = array(
				1=>0,
			   	2=>0,
			   	3=>0,
			   	4=>0,
			   	5=>0,
			   	6=>0,
			   	);

foreach($resultCount as $v)
{
	//格式化时间显示
	$v['date'] = strftime("%Y-%m-%d",$v['date']);

	//统计
	if($v['total_number']>$count[3]){
		$count[3] = $v['total_number'];
	}
	if($v['once_number']>$count[4]){
		$count[4] = $v['once_number'];
	}
	if($v['new_count']>$count[6]){
		$count[6] = $v['new_count'];
	}
	$count[1] += $v['total_number'];
	$count[2] += $v['once_number'];
	$count[5] += $v['new_count'];

	$dataArr[]=$v;
}
$smarty->assign(array(
	'dateStart'=>$dateStart,
	'dateEnd'=>$dateEnd,
	'keywordlist'=>$dataArr,
	'count' => $count
));
$smarty->display("module/account/accountLoginCount.html");
