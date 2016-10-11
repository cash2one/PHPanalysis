<?php
define('IN_DATANG_SYSTEM', true);

global $smarty; 
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
$rank_type_option = array(
	'0' => $buf_lang['new']['select'],
	'1' => $buf_lang['left']['level_rank'],
	'2' => $buf_lang['left']['rich_rank'],
	'3' => $buf_lang['left']['ask_rank'],
//	'4' => '守关排行',
	'5' => $buf_lang['new']['mount_rank'],
//	'6' => '征战排行',
//	'7' => '内功排行',
//	'8' => '送花排行',
//	'9' => '收花排行',
	'10' => $buf_lang['new']['fightpower_rank'],
	'11' => $buf_lang['new']['jade_rank'],
	'12' => $buf_lang['new']['ranking_athletics'],
	'13' => $buf_lang['new']['ranking_camp_battle'],
	'14' => $buf_lang['new']['meet_fight_rank'],
	'15' => $buf_lang['new']['monsterattack_rank'],

);

$rank_type = $_REQUEST['rank_type'];

if ( !isset($_REQUEST['dateStart'])){
	$start_day = strtotime("Monday");
	$dateStart = strftime("%Y-%m-%d %H:%M:%S",$start_day);
}
else
{
	$dateStart  = trim(SS($_REQUEST['dateStart']));
}

if ( !isset($_REQUEST['dateEnd']))
{
	$dateEnd = strftime ("%Y-%m-%d", time() )." 23:59:59";
}
else
{
	$dateEnd = trim(SS($_REQUEST['dateEnd']));
}

$dateStartStamp = strtotime($dateStart);
$dateEndStamp   = strtotime($dateEnd);

$dateStartStr = strftime ("%Y-%m-%d %H:%M:%S", $dateStartStamp);
$dateEndStr   = strftime ("%Y-%m-%d %H:%M:%S", $dateEndStamp);

$now_date = strftime ("%Y-%m-%d", time()) ;
$start = strtotime($now_date)-3600*24;
$start1 = strtotime($now_date)-3600*48;
$end = strtotime($now_date)-1;
$meet_time = $start+3600*12;

$action = trim($_GET['action']);
if ($action == 'search')
{
	if($rank_type == '0') 
	{
		errorExit("请选择排行类型！");
	}
	else if($rank_type == '1') //等级
	{
		$level_sql = "SELECT b.role_id, b.role_name, b.account_name, b.family_name, b.category, b.sex, a.level," .
			" e.last_offline_time, e.is_online" .
			" FROM db_role_attr_p as a, db_role_base_p as b, db_role_ext_p as e" .
			" WHERE a.role_id = b.role_id AND a.role_id=e.role_id" .
			" ORDER BY a.level desc, a.exp desc, b.role_id desc LIMIT 0, 100";
		$level_rank = GFetchRowSet($level_sql);
		foreach($level_rank as $key=>$value)
		{
			$second_cnt = time()-$value['last_offline_time']; 
			$level_rank[$key]['left_day'] = intval($second_cnt/3600/24);
			$level_rank[$key]['left_h_m'] = intval(($second_cnt%86400)/3600).'时'.date('i分s秒',$second_cnt);
		}
		$smarty->assign("level_rank", $level_rank);
	}
	else if($rank_type == '2') //财富
	{
		$wealth_sql = "SELECT b.role_id, b.role_name, b.account_name, b.family_name, b.category, b.sex, a.silver," .
			" e.last_offline_time, e.is_online" .
			" FROM db_role_attr_p as a, db_role_base_p as b, db_role_ext_p as e" .
			" WHERE a.role_id = b.role_id AND a.role_id=e.role_id" .
			" ORDER BY a.silver desc, a.level desc, b.role_id desc LIMIT 0, 100";
		$wealth_rank = GFetchRowSet($wealth_sql);
		foreach($wealth_rank as $key=>$value)
		{
			$second_cnt = time()-$value['last_offline_time']; 
			$wealth_rank[$key]['left_day'] = intval($second_cnt/3600/24);
			$wealth_rank[$key]['left_h_m'] = intval(($second_cnt%86400)/3600).'时'.date('i分s秒',$second_cnt);
		}
		$smarty->assign("wealth_rank", $wealth_rank);
	}
	else if($rank_type == '3') //答题
	{
		$answer_sql = "SELECT b.role_id, b.role_name, b.account_name, a.family_name, a.category, a.sex, a.score," .
			" a.list, e.last_offline_time, e.is_online" .
			" FROM db_role_base_p as b, db_role_ext_p as e, db_role_answer_p as a" .
			" WHERE a.time>= {$dateStartStamp} and a.time<={$dateEndStamp} and a.roleid = b.role_id AND a.roleid=e.role_id" .
			" ORDER BY a.score desc, a.list asc LIMIT 0, 100";
		$answer_rank = GFetchRowSet($answer_sql);
		foreach($answer_rank as $key=>$value)
		{
			$second_cnt = time()-$value['last_offline_time']; 
			$answer_rank[$key]['left_day'] = intval($second_cnt/3600/24);
			$answer_rank[$key]['left_h_m'] = intval(($second_cnt%86400)/3600).'时'.date('i分s秒',$second_cnt);
			
			$answer_rank[$key]['answer_h_m'] = intval($value['list']/3600).'时'.date('i分s秒', $value['list']);
		}
		
		$smarty->assign("answer_rank", $answer_rank);
	}
	else if($rank_type == '4') //守关
	{
		$smarty->assign("defense_rank", $defense_rank);
	}
	else if($rank_type == '5') //坐骑
	{
		$mount_sql = "SELECT *" .
			" FROM t_ranking_mounts_quality" .
			" ORDER BY rank asc LIMIT 0, 100";
		$mount_rank = GFetchRowSet($mount_sql);
		$smarty->assign("mount_rank", $mount_rank);
	}
	else if($rank_type == '6') //征战
	{
		$smarty->assign("fight_rank", $fight_rank);
	}
	else if($rank_type == '7') //内功
	{
		$smarty->assign("intern_rank", $intern_rank);
	}
	else if($rank_type == '8') //送花
	{
		$smarty->assign("send_flower_rank", $send_flower_rank);
	}
	else if($rank_type == '9') //收花
	{
		$smarty->assign("receive_flower_rank", $receive_flower_rank);
	}
/*	'10' => '战斗力排行',
	'11' => '宠物排行',
	'12' => '竞技场排行',
	'13' => '阵营战排行',
	'14' => '遭遇战排行',
	'15' => '突厥攻城排行',*/
	else if($rank_type == '10') //战斗力排行
	{
		$fightpower_rank_sql = "SELECT a.level,r.sex,r.role_id,r.role_name,r.fighting_power,r.faction_id,r.family_name,r.category,r.max_phy_attack,r.phy_defence" .
			" FROM db_role_base_p as r , db_role_attr_p as a" .
			" WHERE r.role_id = a.role_id " .
			" ORDER BY r.fighting_power desc LIMIT 0, 100";
		$fightpower_rank = GFetchRowSet($fightpower_rank_sql);
		$smarty->assign("fightpower_rank", $fightpower_rank);
	}
	else if($rank_type == '11') //宠物排行
	{
		$jade_rank_sql = "SELECT *" .
			" FROM t_ranking_jade" .
			" ORDER BY rank asc LIMIT 0, 100";
		$jade_rank = GFetchRowSet($jade_rank_sql);
		$smarty->assign("jade_rank", $jade_rank);
	}
	else if($rank_type == '12') //竞技场排行
	{
		$ranking_athletics_sql = 'SELECT a.date,a.role_id,a.role_name,a.role_score,b.category,b.family_name,b.faction_id,b.sex,b.fighting_power '.
			' FROM `t_ranking_athletics` as a,`db_role_base_p` as b '.
			' where date>'.$start.' and date<='.$end.' and b.role_id = a.role_id'.
			' order by a.role_score desc limit 0, 100'; 
		$ranking_athletics_tem = GFetchRowSet($ranking_athletics_sql);
		if(empty($ranking_athletics_tem))
		{
			$level_sql = 'SELECT a.date,a.role_id,a.role_name,a.role_score,b.category,b.family_name,b.faction_id,b.sex,b.fighting_power '
				. ' FROM `t_ranking_athletics` as a,`db_role_base_p` as b '
				. ' where date>'.$start1.' and date<='.$end.' and b.role_id = a.role_id'
				. ' order by a.role_score desc limit 0, 100'; 
			$ranking_athletics = GFetchRowSet($level_sql);
		}
		else
		{
			$ranking_athletics = $ranking_athletics_tem;
		}
		$smarty->assign("ranking_athletics", $ranking_athletics);
	}
	else if($rank_type == '13') //阵营战排行
	{
		$camp_battle_sql = 'SELECT * FROM `t_ranking_camp_battle`'
			. ' where date>'.$start.' and date<='.$end.''
			. ' order by add_honor desc limit 0, 100'; 
		$camp_battle_tem = GFetchRowSet($camp_battle_sql);
		if(empty($camp_battle_tem))
		{
			$camp_battle_sql = 'SELECT * FROM `t_ranking_camp_battle`'
				. ' where date>'.$start1.' and date<='.$end.''
				. ' order by add_honor desc limit 0, 100'; 
			$camp_battle = GFetchRowSet($camp_battle_sql);
		}
		else
		{
			$camp_battle = $camp_battle_tem;
		}
		$smarty->assign("camp_battle", $camp_battle);
	}	
	else if($rank_type == '14') //遭遇战排行
	{
		$meet_fight11_sql = 'SELECT * FROM `t_ranking_meet_fight`'
			. ' where date>'.$start.' and date<='.$meet_time.''
			. ' order by rank asc limit 0, 100'; 
		$meet_fight11 = GFetchRowSet($meet_fight11_sql);

		$meet_fight21_sql = 'SELECT * FROM `t_ranking_meet_fight`'
				. ' where date>'.$meet_time.' and date<='.$end.''
				. ' order by rank asc limit 0, 100'; 
		$meet_fight21 = GFetchRowSet($meet_fight21_sql);
		$meet_fight = array('meet_fight11'=>$meet_fight11,'meet_fight21'=>$meet_fight21);
		//exit(print_r($meet_fight));
		$smarty->assign("meet_fight", $meet_fight);
	}	
	
	else if($rank_type == '15') //突厥攻城排行
	{
		$wk_day=date("N");
		if($wk_day>3)
		{
			$start_monsterattack = strtotime($now_date)-($wk_day - 3)*24*3600;
		}
		else
		{
			$start_monsterattack = strtotime($now_date)-($wk_day)*24*3600;
		}
		$end_monsterattack = $start_monsterattack+24*3600-1;
		$monster_attack_sql = 'SELECT a.date,a.role_id,a.role_name,a.kill,b.category,b.family_name,b.faction_id,b.sex,b.fighting_power  FROM `t_ranking_monster_attack` as a ,`db_role_base_p` as b '
				. ' where date>'.$start_monsterattack.' and date<='.$end_monsterattack.' and b.role_id = a.role_id'
				. ' order by `kill` desc limit 0, 100'; 
		$monster_attack = GFetchRowSet($monster_attack_sql);
		$smarty->assign("monster_attack", $monster_attack);
	}		
}


$smarty->assign("rank_type_option", $rank_type_option);
$smarty->assign("rank_type", $rank_type);
$smarty->assign("search_keyword1", $dateStartStr);
$smarty->assign("search_keyword2", $dateEndStr);

$smarty->display("module/analysis/rank_list.html");
