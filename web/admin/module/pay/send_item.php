<?php
define ( 'IN_DATANG_SYSTEM', true );
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN . "/include/global.php";
global $smarty, $db;

$ITEM_TYPE = array(
	5 => 'send_item',
	6 => 'send_stone',
	7 => 'send_equip'
);



//赠送物品
$send_goods_data = $_REQUEST['goods'];
if (empty($send_goods_data))
{
	$send_goods_data = array();
}

$role_id = trim (SS($_REQUEST ['role_id']));
$role_name = trim (SS($_REQUEST ['role_name']));

//echo $role_name;die();
$account_name = trim (SS($_REQUEST ['account_name']));

$role_name_list = trim($_REQUEST['role_name_list']);
$role_count = 0;
if(!empty($role_name_list))
{
	$role_count = count(explode(',', $role_name_list));
}

$action = trim ( $_GET ['action'] );

if ($action == 'search') 
{
	if ($role_id == '' && $role_name == '' && $account_name == '')
	{
		errorExit ( "角色id，角色名和账号不能同时为空" );
	}
	
	$sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1  ";
	if (!empty($role_id))
	{
		$sql .= " AND role_id='{$role_id}'";
	}
	else if (!empty($role_name))
	{
		$sql .= " AND BINARY role_name='{$role_name}'";
	}
	else if (!empty($account_name))
	{
		$sql .= " AND account_name='{$account_name}' AND agent_id='{$AGENT_ID}'";
	}
	$role_result = $db->fetchAll($sql);
	if (empty($role_result))
	{
		errorExit ( "玩家不存在！" );
	}
	
}
else if($action == 'doAddGoods')
{

	$goods_id = intval (SS($_REQUEST ['goods_id']));
	$goods_name = intval (SS($_REQUEST ['goods_name']));
	$goods_num = intval (SS($_REQUEST ['goods_num']));
	$goods_bind = SS($_REQUEST ['goods_bind']);
	
	if($goods_id <= 0 && $goods_name <= 0)
	{
		errorExit("请填写物品ID或者物品名称");
	}
	
	if($goods_id > 0){
		$sql_goods = "select id, name, type from config_goods where id={$goods_id} limit 1";
		$goods_result = $db->FetchOne($sql_goods);
	}else if($goods_name > 0){
		$sql_goods = "select id, name, type from config_goods where id='{$goods_name}' limit 1";
		$goods_result = $db->FetchOne($sql_goods);
	}
	
	if($goods_num <= 0)
	{
		errorExit("请填写物品数量");
	}
	if ($number > 50) {
		errorExit ( "最多赠送50个！" );
	}
	if ($goods_result['type'] != 5 && $goods_result['type'] != 6){
		$goods_num = 1;
	}
	//var_dump($send_goods_data);exit;
	if (!empty($send_goods_data))
	{
		foreach ($send_goods_data as $key => $value)
		{
			if ($key == $goods_result['id'])
			{
				errorExit("物品ID重复！");
			}
		}
	}

	if(empty($goods_result))
	{
		errorExit("物品不存在！");
	}

	$goods_tmp = array(
			$goods_id => array(
			'goods_id' => $goods_result['id'], 
			'goods_name' => $goods_result['name'], 
			'goods_num' => $goods_num,
			'goods_type' => $goods_result['type'], 
			'goods_bind' => $goods_bind
			)
	);

	$send_goods_data = array_merge($send_goods_data, $goods_tmp);
    //var_dump($send_goods_data);exit;
}
else if($action == 'doRemoveGoods')
{
	$remove_goods_id = intval (SS($_REQUEST ['remove_goods_id']));
	unset($send_goods_data[$remove_goods_id]);
}
else if ($action == 'doSendGoods')
{	
	if(empty($role_name_list))
	{
		errorExit ( "请输入至少一个玩家角色名" );
	}
	
	$role_name_array = explode(',', $role_name_list);
	$role_id_array = array();
	$no_role_list = '';
	$role_id_list = '';
	$space_flag = false;
	foreach($role_name_array as $key=>$value)
	{
		$one_sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE BINARY role_name='{$value}' ";
		$one_role_result = $db->fetchOne($one_sql);
		if(empty($one_role_result))
		{
			$no_role_list .= ',';
			$no_role_list .= $value;
		}
		else
		{
			$role_id_array[$key] = $one_role_result['role_id'];
			if($space_flag) $role_id_list .= ',';
			$role_id_list .= $one_role_result['role_id'];
			$space_flag = true;
		}
	}
	
	if(!empty($no_role_list))
	{
		errorExit("角色名为：{$no_role_list} 的玩家不存在！");
	}
	//print_r($send_goods_data);exit;
	if(empty($send_goods_data))
	{
		errorExit ( "请添加赠送的物品" );
	}
		
	$reason = trim ( $_POST ['reason'] );
	if (mb_strlen ( $reason ) < 5) {
		errorExit ( "赠送原因长度必须大于等于5" );
	}
	
    foreach($send_goods_data as $kk => $vv)
	{
	  	$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_SEND_GOODS,'send_item', $vv['goods_num'],'', $role_id_list, $role_name_list);
		$loger->ReviewLog(AdminLogClass::TYPE_SEND_GOODS, '', $vv['goods_num'], '', $role_id_list, $role_name_list, $ITEM_TYPE[$vv['goods_type']], $vv['goods_id'], $vv['goods_name'], $vv['goods_bind'], $reason);  
	}
	infoExit("已提交请求，请耐心等待审核！", "send_item.php");
}
else if($action == 'doClear')
{
	$event_id = '';
	$event_name = '';
	$event_desc = '';
	$min_level = '';
	$max_level = '';
	
	$exp_times = '';
	
	$grow_item_id = '';
	$day_times = '';
	
	$need_item_data = array();
	$monster_data = array();
	$award_goods_data = array();
	$button_data = array();
}

$role_name_list = trim($role_name_list);
$send_goods_data = array_merge($send_goods_data, array());

$smarty->assign("role", $role_result);
$smarty->assign("role_count", $role_count);
$smarty->assign("role_name_list", $role_name_list);
$smarty->assign("send_goods_data", $send_goods_data);
$smarty->display ( 'module/pay/send_item.html' );


