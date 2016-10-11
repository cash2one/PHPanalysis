<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;

if(!isset($_REQUEST['minlevel'])){
	$minLevel = 0;
}else{
	$minLevel = $_REQUEST['minlevel'];
}
if(!isset($_REQUEST['maxlevel'])){
	$maxLevel = 150;
}else{
	$maxLevel = $_REQUEST['maxlevel'];
}

if ( !isset($_REQUEST['dStartTime'])) {
    $dStartTime = date("Y-m-d",time()-13*60*60*24);
}
else {
    $dStartTime  = trim(SS($_REQUEST['dStartTime']));
}
if ( !isset($_REQUEST['dEndTime'])) {
    $dEndTime = strftime ("%Y-%m-%d", time() );
}
else {
    $dEndTime = trim(SS($_REQUEST['dEndTime']));
}
$start_time = strtotime($dStartTime.' 00:00:00');
$end_time = strtotime($dEndTime.' 23:59:59');


$sqlAllRole = "SELECT COUNT(role_id) AS count FROM ".T_DB_ROLE_ATTR_P. " WHERE 1";
$result = $db->fetchOne($sqlAllRole); //统计所有玩家的数量
$countOfRole = $result['count'];
/*echo '<pre>';
print_r($result);exit;*/
$now = time();
$day = $now - 86400;		//24小时没登陆

//统计所有等级区间人数
$sqlCount = "SELECT a.level as level, a.reincarnation as reincarnation, COUNT(a.role_id) as count FROM ".T_DB_ROLE_ATTR_P." as a, ".T_DB_ROLE_EXT_P." as b, ".T_DB_ROLE_BASE_P." as c WHERE a.role_id=b.role_id AND a.role_id=c.role_id AND a.level >=".$minLevel." AND a.level <=".$maxLevel." AND c.create_time>=".$start_time." AND c.create_time<=".$end_time." GROUP BY `level` WITH ROLLUP ";
//统计流失数量
$sqlLoss = "SELECT a.level as level,a.reincarnation as reincarnation, COUNT(a.role_id) as loss FROM ".T_DB_ROLE_ATTR_P." as a,".T_DB_ROLE_EXT_P." as b,".T_DB_ROLE_BASE_P." as c WHERE a.role_id=b.role_id  AND a.role_id=c.role_id AND a.level >=".$minLevel." AND a.level <=".$maxLevel." AND b.last_login_time <= b.last_offline_time AND b.last_offline_time <=".$day." AND c.create_time>=".$start_time." AND c.create_time<=".$end_time." GROUP BY `level` WITH ROLLUP " ;

$resultCount = $db->fetchAll($sqlCount);

$resultLoss = $db->fetchAll($sqlLoss);
//生成等级=>流失数组
/*echo '<pre>';
print_r($resultLoss);exit;*/
$lossArr = array();
foreach($resultLoss as $v){
	$lossArr[$v['level']] = intval($v['loss']);
}

//生成最终数据
$dataArr = array();
foreach($resultCount as $k=>$v){
    $loss = $lossArr[$v['level']];
	$v['loss'] = intval($loss);
	$v['level_rate'] = intval($v['count']/$countOfRole*10000/100);
	$v['level_loss_rate'] = intval($v['loss']/$v['count']*10000/100);
	$v['lossrate'] = intval($loss/$countOfRole*10000)/100;
	$dataArr[$k]= $v;
}
/*echo '<pre>';
print_r($dataArr);exit;*/
$smarty->assign(array(
	'minlevel'=>$minLevel,
	'maxlevel'=>$maxLevel,
	'keywordlist'=>$dataArr,
    'dStartTime'=>$dStartTime,
    'dEndTime'=>$dEndTime
));
$smarty->display("module/levelcount/levelloss.html");


