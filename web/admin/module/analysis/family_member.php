<?php
define('IN_DATANG_SYSTEM', true);

global $smarty; 
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';

$family_office = array(1=>$buf_lang['new']['family_master'],2=>$buf_lang['new']['family_second_master'],3=>$buf_lang['new']['family_elders'],
					   4=>$buf_lang['new']['family_manager'],5=>$buf_lang['new']['family_masses']);
						
$family_sql = "SELECT distinct family_id, family_name FROM `db_role_base_p` where family_id != 0 group by family_id order by family_id asc";
$family_result = GFetchRowSet($family_sql);

$family_option = array();
$family_option[] = $buf_lang['new']['select_family'];
foreach($family_result as $key=>$value)
{
	$family_option[] = $value['family_name'];
}

$family1 = $_REQUEST['family'];
$family2 = $_REQUEST['family_fill'];
$action = trim($_GET['action']);
if ($action == 'search')
{
	if($family1 == 0 && empty($family2))
	{
		errorExit("请选择或者填写要查询的帮会！");
	}
	
	if ($family1 != 0)
	{
		$family = $family1;
	}
	else if(!empty($family2))
	{
		$no_family = true;
		foreach($family_option as $key=>$value)
		{
			if($value == $family2)
			{
				$no_family = false;
				$family = $key;
				break;
			}
		}
		if($no_family)
		{
			errorExit("你填写的帮派不存在！");
		}
	}
		
	$family_id = $family_result[$family-1]['family_id'];
	$mem_sql = "SELECT b.role_id, b.role_name, b.account_name, b.family_name, b.faction_id, b.sex, b.create_time, a.level, a.gold_bind, a.gold, a.silver, e.last_offline_time, e.is_online, a.reincarnation" .
			   " FROM db_role_base_p as b, db_role_attr_p as a, db_role_ext_p as e WHERE b.family_id='{$family_id}' AND a.role_id=b.role_id AND b.role_id=e.role_id";
	$family_mem_result_tem = GFetchRowSet($mem_sql);
	$family_roletype_sql = "SELECT * from t_log_family_office WHERE family_id='{$family_id}'";
	$family_roletype = GFetchRowSet($family_roletype_sql);
	foreach($family_roletype as $v)
	{
		$arr_type[$v['role_id']] = $v['type'];
	}
	foreach($family_mem_result_tem as $v)
	{
		if(isset($arr_type[$v['role_id']]))
		{
			$v['type'] = $family_office[$arr_type[$v['role_id']]];
		}
		else
		{
			$v['type'] = $family_office[5];
		}
		$family_mem_result[] = $v;
	}
	foreach($family_mem_result as $key=>$value)
	{
		$second_cnt = time()-$value['last_offline_time']; 
		$family_mem_result[$key]['left_day'] = intval($second_cnt/3600/24);
		$family_mem_result[$key]['left_h_m'] = intval(($second_cnt%86400)/3600).'时'.date('i分s秒',$second_cnt);
	}
}


$smarty->assign("family_option", $family_option);
$smarty->assign("family_fill_name", $family2);
$smarty->assign("family", $family);
$smarty->assign("keywordlist", $family_mem_result);
$smarty->display("module/analysis/family_member.html");