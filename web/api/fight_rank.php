<?php
/**
 * 战斗排行榜接口 
 * @author wangxuefeng@4399.com
 * @date 2011.06.04
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：
 
*上一次数据
*遭遇站有战功排名，   每天11：30-11：50.  21：10-21：30

*竞技场进行时有排名   周二、四、六       19：30-19：55

*突厥攻城战有排名     星期三，日         20：10-20：40

*阵营站有排名	      周一，三，五，七   19：30-19：55


 *竞技场排行：id,date,role_id,role_name,  role_score 角色得分-排行条件
 *阵营战排行：
 id 	date 时间	role_id 角色id	role_name 角色名	account_name 账号	sex 性别	faction_id 阵营id	family_name 帮派	camp_job 阵营官职	category 门派	add_honor 增加的荣誉-排行条件
 
 
 meet_fight11  11点数据    meet_fight21  21点数据
 *遭遇战排行：rank 排名	role_id 角色id	role_name 角色名	role_level 等级	family_name 称号名	faction_id 阵营id	kill 杀人数	killed 被杀次数	date 	id
 
 *怪物攻城排行： 	id 	date 时间	role_id 角色id	role_name 角色名	kill 战斗分数--排行条件
 */
 
define('IN_DATANG_SYSTEM', true);
include "../config/config.php"; 
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//-1:参数不全 -2:验证失败
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);




if (empty($date) || empty($time) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($date . $time . $API_SECURITY_TICKET_DATA);
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

$now_date = strftime ("%Y-%m-%d", time()) ;
$start = strtotime($now_date)-3600*24;
$start1 = strtotime($now_date)-3600*48;
$end = strtotime($now_date)-1;
$meet_time = $start+3600*12;

$ranking_athletics_sql = 'SELECT id,date,role_id,role_name,role_score FROM `t_ranking_athletics`'
        . ' where date>'.$start.' and date<='.$end.''
        . ' order by role_score desc limit 0, 100'; 
$ranking_athletics_tem = GFetchRowSet($ranking_athletics_sql);
if(empty($ranking_athletics_tem))
{
	$level_sql = 'SELECT id,date,role_id,role_name FROM `t_ranking_athletics`'
        . ' where date>'.$start1.' and date<='.$end.''
        . ' order by role_score desc limit 0, 100'; 
	$ranking_athletics = GFetchRowSet($level_sql);
}
else
{
	$ranking_athletics = $ranking_athletics_tem;
}



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




$meet_fight11_sql = 'SELECT * FROM `t_ranking_meet_fight`'
        . ' where date>'.$start.' and date<='.$meet_time.''
        . ' order by rank asc limit 0, 100'; 
$meet_fight11 = GFetchRowSet($meet_fight11_sql);

$meet_fight21_sql = 'SELECT * FROM `t_ranking_meet_fight`'
        . ' where date>'.$meet_time.' and date<='.$end.''
        . ' order by rank asc limit 0, 100'; 
$meet_fight21 = GFetchRowSet($meet_fight21_sql);


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
$monster_attack_sql = 'SELECT * FROM `t_ranking_monster_attack`'
        . ' where date>'.$start_monsterattack.' and date<='.$end_monsterattack.''
        . ' order by `kill` desc limit 0, 100'; 
$monster_attack = GFetchRowSet($monster_attack_sql);






$final_out = array('ranking_athletics' => $ranking_athletics,'camp_battle' => $camp_battle,'meet_fight11'=>$meet_fight11,'meet_fight21'=>$meet_fight21,'monster_attack'=>$monster_attack);
echo json_encode($final_out);

