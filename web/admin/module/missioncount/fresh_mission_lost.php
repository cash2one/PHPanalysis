<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
include "./config.mission.php";
global $smarty, $db;

$mission_ids = '';
$freshMission = array();
$sql = "SELECT * FROM `config_fresh_mission`";

$freshMission = $db->fetchAll($sql);

$freshMissionArray = array();
foreach($freshMission as $k => $v)
{
    $freshMissionArray[] = $v['mission_id'];
}


if(!empty($freshMissionArray))
{
	$flag = false;
	foreach($freshMissionArray as $k => $v)
	{
		if($flag)
		{
			$mission_ids .= ",";
		}
		$mission_ids .= $v;
		$flag = true;
	}
}

//echo $mission_ids;die();
$sqlCount="SELECT * from ".T_LOG_MISSION." WHERE `mission_id` in ({$mission_ids}) ORDER BY FIELD(`mission_id`, {$mission_ids})";
$resultCount = $db->fetchAll($sqlCount);
/*echo "<pre>";
print_r($resultCount);exit;*/
$arr = array();
foreach($resultCount as $key=>$value)
{
	if($value['accept_num'] == 0)
	{
		$resultCount[$key]['mission_lost_rate'] = 0.00;
	}
	else
	{
		$resultCount[$key]['mission_lost_rate'] = round(($value['accept_num']-$value['complete_num'])*100/$value['accept_num'],2);
	}
}
for($i=1;$i<=127;$i++){
    foreach($resultCount as $val){
        if(preg_replace('/^0+/','',substr($val['mission_id'],3)) == $i){
            $arr[$i][] = $val;
        }
    }
}
$count = array();
foreach($arr as $k => $row){
    foreach($row as $ch){
        $count[$k]['accept_num'] += $ch['accept_num'];
        $count[$k]['complete_num'] += $ch['complete_num'];
    }
}

foreach($count as $ke => $v){
    foreach($resultCount as $k){
        if(preg_replace('/^0+/','',substr($k['mission_id'],3))== $ke){
            $count[$ke]['name'] = $k['name'];
            break;
        }
    }
    $count[$ke]['mission_lost_rate'] =  round(($v['accept_num']-$v['complete_num'])*100/$v['accept_num'],2);
}


$smarty->assign(array(
	'mission'=>$count
));

$smarty->display("module/missioncount/fresh_mission_lost.html");


