<?php
define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

if(isset($_REQUEST['datestart']))
{
	$start = strtotime(trim(SS($_REQUEST['datestart'])));
}
else
{
	$start = strtotime("2011-01-01 0:0:0");
}

if(isset($_REQUEST['dateend']))
{
	if(strtotime(trim(SS($_REQUEST['dateend']))) < strtotime("2012-02-02 23:59:59"))    //strtotime("2012-02-0323:59:59")
	{
		$end = strtotime("2012-02-02 23:59:59");
	}
	else
	{
		$end = strtotime("2012-02-02 23:59:59");//$end = strtotime(trim(SS($_REQUEST['dateend'])));
	}
}
else
{
	$end = strtotime("2012-02-02 23:59:59");
	
}


$server_id_tag = 'S'.$GAME_SERVER;

$sql = 'select count(distinct(`account_name`)) as event_cnt, event ' .
	   'FROM `t_log_game_event` ' .
	   'where event in (\'pageload\', \'beforeloadflash\', \'flashloaded\', \'createplayer\', \'playercreated\', \'entergame\', \'mission0\', \'mission1\', \'mission2\', \'mission3\', \'mission4\', \'mission5\') and datetime >= ' .
	   $start .
	   ' and datetime < ' .
	   $end .
	   ' and server_name=\'' .
	   $server_id_tag .
	   '\' ' .
	   'group by event ' .
	   'order by field(`event`, \'pageload\', \'beforeloadflash\', \'flashloaded\', \'createplayer\', \'playercreated\', \'entergame\', \'mission0\', \'mission1\', \'mission2\', \'mission3\', \'mission4\', \'mission5\') asc'; 
$result = GFetchRowSet($sql);

$game_event_arr = array();
foreach($result as $key => $value)
{
	$game_event_arr[$value['event']] = $value['event_cnt'];
}

//$sql_exp = 'select a.account_name from (select distinct(account_name) from t_log_game_event where event=\'load_complete\') as a, (select distinct(account_name) from t_log_game_event where event=\'playercreated\') as b'
//        . ' where a.account_name=b.account_name';
//$result_exp =  GFetchRowSet($sql_exp);

/*
 * page_load 游戏页面连接数
 * before_load_flash 连接成功，开始预加载flash数
 * flash_loaded 加载成功，进入创建角色页数
 * player_created 创建角色人数
 * load_complete 客戶端資源加載完畢（不统计）
 * enter_game 进入游戏场景数
 * mission0 接任務1
 * mission1 完成任务1
 * mission2
 * mission3
 * mission4
 * mission5
 */
$page_load = intval($game_event_arr['pageload']);
$before_load_flash = intval($game_event_arr['beforeloadflash']);
$flash_loaded = intval($game_event_arr['flashloaded']);
$create_player = intval($game_event_arr['createplayer']);
$player_created = intval($game_event_arr['playercreated']);
//$load_complete = intval($game_event_arr['load_complete']);
//$load_complete = intval(count($result_exp));
$enter_game = intval($game_event_arr['entergame']);

$mission0 = intval($game_event_arr['mission0']);
$mission1 = intval($game_event_arr['mission1']);
$mission2 = intval($game_event_arr['mission2']);
$mission3 = intval($game_event_arr['mission3']);
$mission4 = intval($game_event_arr['mission4']);
$mission5 = intval($game_event_arr['mission5']);

if($page_load==0)
	$page_load_rate = 0;
else
	$page_load_rate = round(($page_load-$before_load_flash)*100/$page_load,2);
	
if($before_load_flash==0)
	$before_load_flash_rate = 0;
else
	$before_load_flash_rate = round(($before_load_flash-$flash_loaded)*100/$before_load_flash,2);
	
if($flash_loaded==0)
	$flash_loaded_rate = 0;
else
	$flash_loaded_rate = round(($flash_loaded-$create_player)*100/$flash_loaded,2);

if($create_player==0)
	$create_player_rate = 0;
else
	$create_player_rate = round(($create_player-$player_created)*100/$create_player,2);

if($player_created==0)
	$player_created_rate = 0;
else
	$player_created_rate = round(($player_created-$enter_game)*100/$player_created,2);

//if($load_complete==0)
//	$load_complete_rate = 0;
//else
//	$load_complete_rate = round(($load_complete-$enter_game)*100/$load_complete,2);
	
if($enter_game==0)
	$enter_game_rate = 0;
else
	$enter_game_rate = round(($enter_game-$mission0)*100/$enter_game,2);

	
if($mission0==0)
	$mission0_rate = 0;
else
	$mission0_rate = round(($mission0-$mission1)*100/$mission0,2);

if($mission1==0)
	$mission1_rate = 0;
else
	$mission1_rate = round(($mission1-$mission2)*100/$mission1,2);

if($mission2==0)
	$mission2_rate = 0;
else
	$mission2_rate = round(($mission2-$mission3)*100/$mission2,2);

if($mission3==0)
	$mission3_rate = 0;
else
	$mission3_rate = round(($mission3-$mission4)*100/$mission3,2);
	
if($mission4==0)
	$mission4_rate = 0;
else
	$mission4_rate = round(($mission4-$mission5)*100/$mission4,2);

$event_data = array(
	'page_load' => $page_load,
	'page_load_rate' => $page_load_rate,
	
	'before_load_flash' => $before_load_flash,
	'before_load_flash_rate' => $before_load_flash_rate,
	
	'flash_loaded' => $flash_loaded,
	'flash_loaded_rate' => $flash_loaded_rate,
	
	'create_player' => $create_player,
	'create_player_rate' => $create_player_rate,
	
	'player_created' => $player_created,
	'player_created_rate' => $player_created_rate,
	
	'load_complete' => $load_complete,
	'load_complete_rate' => $load_complete_rate,
	
	'enter_game' => $enter_game,
	'enter_game_rate' => $enter_game_rate,
	
	'mission0' => $mission0,
	'mission0_rate' => $mission0_rate,
	
	'mission1' => $mission1,
	'mission1_rate' => $mission1_rate,
	
	'mission2' => $mission2,
	'mission2_rate' => $mission2_rate,
	
	'mission3' => $mission3,
	'mission3_rate' => $mission3_rate,
	
	'mission4' => $mission4,
	'mission4_rate' => $mission4_rate,
	
	'mission5' => $mission5,
);



$smarty->assign("start", $start);
$smarty->assign("end", $end);
$smarty->assign("event_data", $event_data);
$smarty->display("module/register/old_role_reg_lost_stat.html");



