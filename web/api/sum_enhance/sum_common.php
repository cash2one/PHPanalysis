<?php
define('IN_DATANG_SYSTEM', true);
include "../../config/config.php"; 
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include SYSDIR_ADMIN.'/include/erlang_config_loader.php';  

global $db ,$GAME_SERVER;

global $A_DEBUG;

//今天
//$date = date("y-m-d");
  
//昨天
$date = date("Y-m-d",strtotime(date("Y-m-d"))-86400);

$dateStartStamp = strtotime($date . ' 0:0:0');
$dateEndStamp   = strtotime($date . ' 23:59:59');

$sum_common = array(
    '1' => array('name' => '装备锻造', 'url' => 'web/center/sum_enhance/t_log_forge.php'),
	'2' =>  array('name' => '装备打孔', 'url' => 'web/center/sum_enhance/t_log_punch.php'),
	'3' =>  array('name' => '宝石镶嵌', 'url' => 'web/center/sum_enhance/t_log_inlay.php'),
	'4' =>	 array('name' => '灵石合成', 'url' => 'web/center/sum_enhance/t_log_comp_stone.php'),
	'5'	=>	 array('name' => '装备刻印', 'url' => 'web/center/sum_enhance/t_log_carve.php'),
	'6'	=>	 array('name' => '装备升级', 'url' => 'web/center/sum_enhance/t_log_eq_up.php'),
	'7' =>	 array('name' => '正常拆卸宝石', 'url' => 'web/center/sum_enhance/t_log_unload_stone.php'),
	1043=>  array('name' => '装备洗练', 'url' => 'web/center/sum_enhance/t_log_unload_wash.php'),
	1046=>  array('name' => '装备回炉', 'url' => 'web/center/sum_enhance/do_log_recycle.php'),
);


//只统计下列情况（剔除掉玩家间流通，和已经废弃掉的系统的消费类型）
/*
drop table if exists t_log_forge;       ###精炼
drop table if exists t_log_punch;  		###装备打孔
drop table if exists t_log_inlay;		###宝石镶嵌
drop table if exists t_log_comp_stone;	###灵石合成
drop table if exists t_log_carve;		###装备刻印
drop table if exists t_log_eq_up;		###装备升级
drop table if exists t_log_unload_stone;	###正常拆卸宝石
*/
  
?>
