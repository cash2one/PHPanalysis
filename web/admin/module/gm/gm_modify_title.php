<?php
define ( 'IN_DATANG_SYSTEM', true );
include "../../../config/config.php";
include SYSDIR_ADMIN . "/include/global.php";
global $smarty;

$all_titles = array(
	'0'      => '请选择称号',
	'天下第一'    => '天下第一',
	'万人敌'    => '万人敌',
	'百人斩'    => '百人斩',
	'GM'    => 'GM',
	'指导员'    => '指导员',
	'不败战神' =>'不败战神',
	'挟天子以令诸侯' =>'挟天子以令诸侯',
	'横扫千军' =>'横扫千军',
);

$role_id = trim (SS($_REQUEST ['role_id']));
$role_name = trim (SS($_REQUEST ['role_name']));
$account_name = trim (SS($_REQUEST ['account_name']));
$del_title_list = trim($_REQUEST['del_title_list']);

$action = trim ( $_GET ['action'] );
if ($action == 'search') 
{
	if ($role_id == '' && $role_name == '' && $account_name == '') 
	{
		errorExit ( "角色id，角色名和账号不能同时为空" );
	}
	
	$sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1";
	if (!empty($role_id))
	{
		$sql .= " AND role_id='{$role_id}'";
	}
	else if (!empty($role_name))
	{
		$sql .= " AND role_name='{$role_name}'";
	}
	else if (!empty($account_name))
	{
		$sql .= " AND account_name='{$account_name}'";
	}
	$role_result = $db->fetchOne($sql);
	if (empty($role_result))
	{
		errorExit ( "玩家不存在！" );
	}
}
else if ($action == 'do') {
	$role_id = trim ($_POST ['role_id']);	
	if (empty($role_id)) 
	{
		errorExit ( "请先搜索确认玩家是否存在！" );
	}
	$title_name = trim ( $_POST ['title_name'] );
	
	
	$role_name = str_replace("\\'", "'", $role_name); // 还原 '
	$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
	$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \
	$role_name = urlencode($role_name);
	//修改称号
	$result = getJson ( $erlangWebAdminHost."gm/gm_modify_title/?role_id={$role_id}&role_name={$role_name}&title_name={$title_name}" );
	if ($result ['result'] == 'ok') {
		infoExit ( "修改称号成功", "gm_modify_title.php" );
	} else {
		infoExit ( "修改称号失败", "gm_modify_title.php" );
	}
}
else if ($action == 'do2'){
	$role_id = trim ($_POST ['role_id']);
	if (empty($role_id)) 
	{
		errorExit ( "请先搜索确认玩家是否存在！" );
	}
			
	$achieve_id = trim ( $_POST ['achieve_id'] );
	if ($achieve_id == '') {
		errorExit ( "玩家成就ID不能为空" );
	}
	$achieve_id = intval($achieve_id);
	
	$role_name = str_replace("\\'", "'", $role_name); // 还原 '
	$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
	$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \
	$role_name = urlencode($role_name);
	//修改成就
	$result = getJson ( $erlangWebAdminHost."gm/gm_modify_achieve/?role_id={$role_id}&role_name={$role_name}&achieve_id={$achieve_id}" );
	if ($result ['result'] == 'ok') {
		infoExit ( "修改成就成功", "gm_modify_title.php" );
	} else {
		infoExit ( "修改成就失败", "gm_modify_title.php" );
	}
}
else if($action == 'do3')
{
	if(empty($del_title_list))
	{
		errorExit("请输入要删除的称号列表！");
	}
	
	$del_title_array = explode(' ', $del_title_list);
		
	$start_str = 'begin';
	$result = getJson ( $erlangWebAdminHost."gm/gm_delete_title/?title_list={$start_str}" );
		
	if ($result ['result'] == 'ok') {
		//nothing
	} else {
		errorExit ( "删除称号失败" );
	}
		
	foreach($del_title_array as $key => $value)
	{
		if(empty($value))
		{
			continue;
		}
		$result = getJson ( $erlangWebAdminHost."gm/gm_delete_title/?title_list={$value}" );	
		
		if ($result ['result'] == 'ok') {
			//nothing
		} else {
			errorExit ( "删除称号失败" );
		}
	}
	
	$stop_str = 'stop';
	$result = getJson ( $erlangWebAdminHost."gm/gm_delete_title/?title_list={$stop_str}" );
		
	if ($result ['result'] == 'ok') {
		infoExit ( "删除称号成功", "gm_modify_title.php" );
	} else {
		infoExit ( "删除称号失败", "gm_modify_title.php" );
	}
}
else if ($action == 'do4') {
	$role_id = trim ($_POST ['role_id']);
	$role_name = trim ($_POST ['role_name']);	
	if (empty($role_id)) 
	{
		errorExit ( "请先搜索确认玩家是否存在！" );
	}
	$title_name = trim ( $_POST ['title_name'] );
	
	
	$role_name = str_replace("\\'", "'", $role_name); // 还原 '
	$role_name = str_replace("\\\"", "\"", $role_name);  // 还原 "
	$role_name = str_replace("\\\\", "\\", $role_name);  // 还原 \
	$role_name = urlencode($role_name);
	//修改称号
	$result = getJson ( $erlangWebAdminHost."gm/gm_del_personal_title/?role_id={$role_id}&role_name={$role_name}&title_name={$title_name}" );
	if ($result ['result'] == 'ok') {
		infoExit ( "删除称号成功", "gm_modify_title.php" );
	} else {
		infoExit ( "删除称号失败", "gm_modify_title.php" );
	}
}

$smarty->assign("role", $role_result);
$smarty->assign("title_name_option", $all_titles);
$smarty->display ( 'module/gm/gm_modify_title.html' );


