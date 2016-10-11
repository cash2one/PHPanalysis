<?php
/* act_collect_conf
 * Created on 2011-8-13 by wangxuefeng@4399.com
 */
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty;

$ACT_MONSTER_TYPE = 1;
$ACT_EXP_TYPE = 2;
$ACT_GROW_TYPE = 3;
$ACT_OPEN_SERVER_TYPE = 4;
$ACT_OFFLINE_BAG_TYPE = 13;

//活动类型  
$ACT_TYPE = array(
	1 => $buf_lang['left']['kill_monster_type_activity'],
	2 => $buf_lang['left']['times_experience_activity'],
	3 => $buf_lang['left']['forming_type_activity'],
	4 => $buf_lang['new']['festival_list10'],
	13 => $buf_lang['new']['festival_list13'],

);

//显示
$SHOW_TYPE = array(
	1 => $buf_lang['left']['display_activity_list'],
	0 => $buf_lang['left']['undisplay_activity_list'],
);

//奖励物品类型
$GOODS_TYPE = array(
	1 => $buf_lang['left']['item'],
	2 => $buf_lang['left']['gemstone'],
	3 => $buf_lang['left']['equip'],
	5 => $buf_lang['left']['ride'],
	6 => $buf_lang['left']['ride_equip'],
	3001 => $buf_lang['left']['experience'],
	3002 => $buf_lang['conmon']['silver'],
	3003 => $buf_lang['conmon']['ingot'],
);

//开服活动
$OPEN_SERVER = array(
	'1001' => $buf_lang['new']['top_newer'],
	'1002' => $buf_lang['new']['pet_competition'],
	'1003' => $buf_lang['new']['rid_competition'],
	'1004' => $buf_lang['new']['protect_boss'],
	'1005' => $buf_lang['new']['territory_competition'],
	'1007' => $buf_lang['new']['tower_competition'],
	//'1006' => 'VIP回馈'
);


///  越南专有开服活动
if($AGENT_ID == 15)
{   
	 $OPEN_SERVER['1006'] = 'VIP'.$buf_lang['new']['feedback'];
	 $OPEN_SERVER['1008'] = $buf_lang['new']['ten_top'];
	 $OPEN_SERVER['1009'] = $buf_lang['new']['ten_rich'];
}
//兑换需要的道具
$need_item_data =  $_REQUEST['item'];
if (empty($need_item_data))
{
	$need_item_data = array();
}

$festival_list_data =  $_REQUEST['festival'];
if (empty($festival_list_data))
{
	$festival_list_data = array();
}

$festival_list_data = array_merge($festival_list_data, array());

//奖励物品
$award_goods_data = $_REQUEST['goods'];
if (empty($award_goods_data))
{
	$award_goods_data = array();
}

//兑换方案
$exchange_case_data = $_REQUEST['exchange_case'];
if (empty($exchange_case_data))
{
	$exchange_case_data = array();
}

//怪物信息
$monster_data = $_REQUEST['monster'];
if (empty($monster_data))
{
	$monster_data = array();
}

//养成列表
$grow_data = $_REQUEST['grow'];
if (empty($grow_data))
{
	$grow_data = array();
}

//养成按钮信息
$grow_button_data =  $_REQUEST['grow_button'];
if (empty($grow_button_data))
{
	$grow_button_data = array();
}

//按钮信息
$button_data =  $_REQUEST['button'];
if (empty($button_data))
{
	$button_data = array();
}

$type_id = $_REQUEST['act_type'];
if (empty($type_id))
{
	$type_id = $ACT_EXP_TYPE;
}
$show_type = $_REQUEST['show_type'];
$event_id = $_REQUEST['event_id'];
$festival_event_id = intval(trim($_REQUEST['festival_event_id']));
$event_name = trim($_REQUEST['event_name']);
$event_desc = trim($_REQUEST['event_desc']);
//$event_desc = preg_replace('/\s/', '', $event_desc);
$event_desc = str_replace("\\'", "'", $event_desc); // 还原 '
$event_desc = str_replace("\\\"", "\"", $event_desc);  // 还原 "
$event_desc = str_replace("\\\\", "\\", $event_desc);  // 还原 \
$event_desc = urlencode($event_desc);

$open_server_id = $_REQUEST['open_server'];

if (!isset($_REQUEST['event_start_time']))
{
	$event_start_time = strftime("%Y-%m-%d %H:%M:%S", time());
}
else
{
	$event_start_time = trim(SS($_REQUEST['event_start_time']));
}

if (!isset($_REQUEST['event_end_time']))
{
	$event_end_time = strftime("%Y-%m-%d %H:%M:%S", time()+86400);
}
else
{
	$event_end_time = trim(SS($_REQUEST['event_end_time']));
}

if (!isset($_REQUEST['exchange_end_time']))
{
	$exchange_end_time = strftime("%Y-%m-%d %H:%M:%S", time()+3*86400);
}
else
{
	$exchange_end_time = trim(SS($_REQUEST['exchange_end_time']));
}

$min_level = $_REQUEST['min_level'];
$max_level = $_REQUEST['max_level'];
$exchange_btn_pos_index = SS($_REQUEST ['exchange_btn_pos_index']);
$exchange_btn_name = trim($_REQUEST['exchange_btn_name']);
$exchange_btn_name = preg_replace('/\s/', '', $exchange_btn_name);
$exchange_btn_key = $_REQUEST['exchange_btn_key'];
$exchange_btn_cd_time = $_REQUEST['exchange_btn_cd_time'];

//经验倍数
$exp_times = $_REQUEST['exp_times'];

//离线天数&领取兄弟礼包最低等级
if (!isset($_REQUEST['offline_days']))
{
	$offline_days = 15;
}
else
{
	$offline_days = $_REQUEST['offline_days'];
}

if (!isset($_REQUEST['offline_level']))
{
	$offline_level = 35;
}
else
{
	$offline_level = $_REQUEST['offline_level'];
}
//echo $offline_days;echo "<br>";
//echo $offline_level;echo "<br>";

$grow_item_id = $_REQUEST['grow_item_id'];
$day_times = $_REQUEST['day_times'];

$action = trim($_GET['action']);
if ($action == 'doAddItem')
{
	$item_id = intval (SS($_REQUEST ['item_id']));
	$item_num = intval (SS($_REQUEST ['item_num']));
	if($item_id <= 0)
	{
		errorExit($buf_lang['new']['item_id_empty']);
	}
	if (!empty($need_item_data))
	{
		foreach ($need_item_data as $key => $value)
		{
			if ($key == $item_id)
			{
				errorExit($buf_lang['new']['item_id_repeat']);
			}
		}
	}
	if($item_num <= 0)
	{
		errorExit($buf_lang['new']['item_num_empty']);
	}
	$item_tmp = array(
		$item_id => array('item_id' => $item_id, 'item_num' => $item_num),
	);
	$need_item_data = array_merge($need_item_data, $item_tmp);
}
else if ($action == 'doRemoveItem')
{
	$remove_item_id = intval (SS($_REQUEST ['remove_item_id']));
	unset($need_item_data[$remove_item_id]);
}
else if($action == 'doAddGoods')
{
	$goods_id = intval (SS($_REQUEST ['goods_id']));
	$goods_num = intval (SS($_REQUEST ['goods_num']));
	$goods_type = intval (SS($_REQUEST ['goods_type']));
	$goods_weight = intval (SS($_REQUEST ['goods_weight']));
	$goods_bind = SS($_REQUEST ['goods_bind']);
	if($goods_bind == 1)
	{
		$goods_bind = "true";
	}
	else
	{
		$goods_bind = "false";
	}
//	if($goods_id <= 0)
//	{
//		errorExit("请填写物品ID");
//	}
	if($goods_num <= 0)
	{
		errorExit($buf_lang['new']['goods_num_empty']);
	}
//	if($goods_weight <= 0)
//	{
//		errorExit("请填写权重");
//	}
	if (!empty($award_goods_data))
	{
		foreach ($award_goods_data as $key => $value)
		{
			if ($key == $goods_id)
			{
//				errorExit("物品ID重复！");
			}
		}
	}

	$goods_tmp = array(
		$goods_id => array('goods_id' => $goods_id, 'goods_num' => $goods_num, 'goods_type' => $goods_type, 'goods_weight' => $goods_weight, 'goods_bind' => $goods_bind),
	);
	$award_goods_data = array_merge($award_goods_data, $goods_tmp);
}
else if($action == 'doRemoveGoods')
{
	$remove_goods_id = intval (SS($_REQUEST ['remove_goods_id']));
	unset($award_goods_data[$remove_goods_id]);
}
else if($action == 'doAddExchangeCase')
{		
	if ($min_level <= 0)
	{
		errorExit($buf_lang['new']['lowest_error']);
	}
	if ($max_level <= 0)
	{
		errorExit($buf_lang['new']['topest_error']);
	}
	if ($min_level > $max_level)
	{
		errorExit($buf_lang['new']['low_eq_top']);
	}
	
	if($exchange_btn_pos_index <= 0)
	{
		errorExit($buf_lang['new']['position_id_error']);
	}
	
	if(empty($exchange_btn_name))
	{
		errorExit($buf_lang['new']['empty_buttom_name']);
	}
	if($exchange_btn_key <= 0)
	{
		errorExit($buf_lang['new']['num_lower_0']);
	}
	if($exchange_btn_cd_time < 0)
	{
		errorExit($buf_lang['new']['cd_lower_0']);
	}
	
	if(empty($exchange_case_data))	
	{
		$exchange_data_id = 0;
	}
	else
	{
		$tmp_pop = end($exchange_case_data);
		$exchange_data_id = $tmp_pop['exchange_data_id']+1;
	}
	
	$exchang_data_tmp = array(
		$exchange_data_id => array(
			'exchange_data_id' => $exchange_data_id,
			'level' => array('min_level' => $min_level, 'max_level' => $max_level), 
			'button' => array('exchange_btn_pos_index' => $exchange_btn_pos_index, 'exchange_btn_name'=>$exchange_btn_name, 
							  'exchange_btn_key'=>$exchange_btn_key, 'exchange_btn_cd_time'=>$exchange_btn_cd_time),
			'item' => $need_item_data,
			'goods' => $award_goods_data,
		));
	$exchange_case_data = array_merge($exchange_case_data, $exchang_data_tmp);
	
	$min_level = '';
	$max_level = '';
	$exchange_btn_pos_index = '';
	$exchange_btn_name = '';
	$exchange_btn_key = '';
	$exchange_btn_cd_time = '';
	
	$need_item_data = array();
	$award_goods_data = array();
}
else if($action == 'doClearExchangeCase')
{
	$min_level = '';
	$max_level = '';
	$exchange_btn_pos_index = '';
	$exchange_btn_name = '';
	$exchange_btn_key = '';
	$exchange_btn_cd_time = '';
	
	$need_item_data = array();
	$award_goods_data = array();
}
else if($action == 'doRemoveExchangeCase')
{
	$remove_exchange_case_id = intval ($_REQUEST ['remove_exchange_case_id']);
	unset($exchange_case_data[$remove_exchange_case_id]);
}
else if ($action == 'doAddMonster')
{
	$map_id = intval (SS($_REQUEST ['map_id']));
	$monster_id = intval (SS($_REQUEST ['monster_id']));
	$monster_pos_x = intval (SS($_REQUEST ['monster_pos_x']));
	$monster_pos_y = intval (SS($_REQUEST ['monster_pos_y']));
	$monster_type = intval (SS($_REQUEST ['monster_type']));
	
	if($map_id <= 0)
	{
		errorExit($buf_lang['new']['map_id_empty']);
	}
	if($monster_id <= 0)
	{
		errorExit($buf_lang['new']['monster_id_empty']);
	}
	if($monster_pos_x <= 0)
	{
		errorExit($buf_lang['new']['monster_x_empty']);
	}
	if($monster_pos_y <= 0)
	{
		errorExit($buf_lang['new']['monster_y_empty']);
	}
	
	if(empty($monster_data))
	{
		$monster_key = 0;
	}
	else
	{
		$tmp_pop = end($monster_data);
		$monster_key = $tmp_pop['monster_key']+1;
	}

	$monster_tmp = array(
		$monster_key => array('monster_key'=> $monster_key, 'monster_id' => $monster_id, 'monster_pos_x' => $monster_pos_x, 'monster_pos_y' => $monster_pos_y, 
							  'monster_type' => $monster_type, 'map_id' => $map_id),
	);
	$monster_data = array_merge($monster_data, $monster_tmp);
}
else if($action == 'doRemoveMonster')
{
	$remove_monster_key = intval (SS($_REQUEST ['remove_monster_key']));
	unset($monster_data[$remove_monster_key]);
}
else if($action == 'doAddGrowInfo')
{
	$now_grow_item_id = intval (SS($_REQUEST ['now_grow_item_id']));
	$grow_exp = intval (SS($_REQUEST ['grow_exp']));
	$next_grow_item_id = intval (SS($_REQUEST ['next_grow_item_id']));
	$grow_link = trim(SS($_REQUEST['grow_link']));
	
	if($now_grow_item_id <= 0)
	{
		errorExit($buf_lang['new']['item_id_error']);
	}
	
	if($grow_exp <= 0)
	{
		errorExit($buf_lang['new']['experience_error']);
	}
		
	if(empty($grow_link))
	{
		errorExit($buf_lang['new']['source_link_error']);
	}
	
	$grow_key = count($grow_data);
	$grow_tmp = array(
		$grow_key => array('grow_key'=> $grow_key, 'now_grow_item_id' => $now_grow_item_id, 'grow_exp' => $grow_exp, 
			'next_grow_item_id' => $next_grow_item_id, 'grow_link' => $grow_link),
	);
	$grow_data = array_merge($grow_data, $grow_tmp);	
}
else if($action == 'doRemoveGrowInfo')
{
	$remove_grow_key = intval (SS($_REQUEST ['remove_grow_key']));
	unset($grow_data[$remove_grow_key]);
}
else if($action == 'doAddGrowButton')
{
	$grow_btn_pos_index = intval (SS($_REQUEST ['grow_btn_pos_index']));
	$grow_btn_name = trim($_REQUEST['grow_btn_name']);
	$grow_btn_name = preg_replace('/\s/', '', $grow_btn_name);
	$grow_btn_key = intval($_REQUEST['grow_btn_key']);
	$grow_btn_cd_time = intval($_REQUEST['grow_btn_cd_time']);
	
	if($grow_btn_pos_index <= 0)
	{
		errorExit($buf_lang['new']['position_id_error']);
	}
	
	if(empty($grow_btn_name))
	{
		errorExit($buf_lang['new']['empty_buttom_name']);
	}
	if($grow_btn_key <= 0)
	{
		errorExit($buf_lang['new']['num_lower_0']);
	}
	if($grow_btn_cd_time < 0)
	{
		errorExit($buf_lang['new']['cd_lower_0']);
	}
	
	if (!empty($grow_button_data))
	{
		foreach ($grow_button_data as $key => $value)
		{
			if ($value['grow_btn_pos_index'] == $grow_btn_pos_index)
			{
				errorExit($buf_lang['new']['buttom_po_id_repeat']);
			}
		}
	}
	
	$grow_button_id = count($grow_button_data);
	$grow_button_tmp = array(
		$grow_button_id => array('grow_button_id'=> $grow_button_id, 'grow_btn_pos_index' => $grow_btn_pos_index, 
			'grow_btn_name' => $grow_btn_name, 'grow_btn_key' => $grow_btn_key, 'grow_btn_cd_time' => $grow_btn_cd_time),
	);
	$grow_button_data = array_merge($grow_button_data, $grow_button_tmp);
}
else if($action == 'doRemoveGrowButton')
{
	$remove_grow_button_id = intval (SS($_REQUEST ['remove_grow_button_id']));
	unset($grow_button_data[$remove_grow_button_id]);
}
else if($action == 'doAddButton')
{
	$btn_pos_index = intval (SS($_REQUEST ['btn_pos_index']));
	$btn_name = trim($_REQUEST['btn_name']);
	$btn_name = preg_replace('/\s/', '', $btn_name);
	$btn_key = intval($_REQUEST['btn_key']);
	
	if($btn_pos_index <= 0)
	{
		errorExit($buf_lang['new']['position_id_error']);
	}
	
	if(empty($btn_name))
	{
		errorExit($buf_lang['new']['empty_buttom_name']);
	}
	if($btn_key <= 0)
	{
		errorExit($buf_lang['new']['num_lower_0']);
	}
	
	if (!empty($button_data))
	{
		foreach ($button_data as $key => $value)
		{
			if ($value['btn_pos_index'] == $btn_pos_index)
			{
				errorExit($buf_lang['new']['buttom_po_id_repeat']);
			}
		}
	}
	
	$button_id = count($button_data);
	$button_tmp = array(
		$button_id => array('button_id'=> $button_id, 'btn_pos_index' => $btn_pos_index, 
							'btn_name' => $btn_name, 'btn_key' => $btn_key, 'btn_cd_time' => '0'),
	);
	$button_data = array_merge($button_data, $button_tmp);
	
}
else if($action == 'doRemoveButton')
{
	$remove_button_id = intval (SS($_REQUEST ['remove_button_id']));
	unset($button_data[$remove_button_id]);
}
else if($action == 'doAddEvent')
{
	$event_start_time_stamp = strtotime($event_start_time);
	$event_end_time_stamp = strtotime($event_end_time);
	$exchange_end_time_stamp = strtotime($exchange_end_time);
	
	if( $event_end_time_stamp > $exchange_end_time_stamp )
	{
		errorExit($buf_lang['new']['exchange_time_lower_end'],"act_collect_conf.php");
	}
	//开服活动
	if ($type_id == $ACT_OPEN_SERVER_TYPE)
	{
		$result = getJson($erlangWebAdminHost."gm/act_open_server/?open_event_id={$open_server_id}&start_time={$event_start_time_stamp}&end_time={$event_end_time_stamp}&award_time={$exchange_end_time_stamp}");
		if ($result ['result'] == 'ok') 
		{
			infoExit ($buf_lang['new']['starting_ac_sussecc'],"act_collect_conf.php" );
		}
		else
		{
			//echo "why error!";
			errorExit($buf_lang['new']['starting_ac_fail']);
		}
	}
	else //非开服活动，1,2,3
	{
		if (empty($event_id))
		{
			errorExit($buf_lang['new']['activity_id_empty']);
		}
		if ($event_id <= 2000)
		{
			if ($event_id != 1)
			{
				errorExit($buf_lang['new']['activity_id_mast_bigger2000']);
			}
		}
		if (empty($event_name))
		{
			errorExit($buf_lang['new']['activity_name_empty']);
		}
		$event_name = preg_replace('/\s/', '', $event_name);
		if (empty($event_desc))
		{
			errorExit($buf_lang['new']['activity_descrit_empty']);
		}
		
		//$event_desc = preg_replace('/\s/', '', $event_desc);
		
		if($type_id == $ACT_MONSTER_TYPE)
		{
		}
		else if($type_id == $ACT_EXP_TYPE)
		{
			if (intval($exp_times) <= 0)
			{
				errorExit($buf_lang['new']['experience_times_error']);
			}
		}
		else if($type_id == $ACT_OFFLINE_BAG_TYPE)
		{
			if (intval($offline_days) < 7) //不能少于7天，以免配置错误
			{
				errorExit("不能少于7天");
			}
			if (intval($offline_level) < 30) //不能低于30级
			{
				errorExit("不能低于30级");
			}
			if ($event_id < 40212000 || $event_id > 40212005)
			{
				errorExit("活动id错误");
			}
		}
		else if($type_id == $ACT_GROW_TYPE)
		{
			if(intval($grow_item_id) <= 0)
			{
				errorExit($buf_lang['new']['y_item_id_error']);
			}
			if(intval($day_times) <= 0)
			{
				errorExit($buf_lang['new']['day_times_error']);
			}
		}
		
		$send_data = array();
		
		$start_str = "{start,1}";
		//开始发送数据
		$result = getJson ( $erlangWebAdminHost."gm/act_conf/?str={$start_str}" );
		if ($result ['result'] == 'ok') 
		{
			//nothing
		}
		else
		{
			errorExit($buf_lang['new']['ac_fail']);
		}
		
		$event_type_str = "{type_id,".$type_id."}";
		$send_data[] = $event_type_str;
		
		$show_type_str = "{show_type,".$show_type."}";
		$send_data[] = $show_type_str;
		
		$event_id_str = "{event_id,".$event_id."}";
		$send_data[] = $event_id_str;
		
		$event_start_time_str = "{start_time,".$event_start_time_stamp."}";
		$send_data[] = $event_start_time_str;
		
		$event_end_time_str = "{end_time,".$event_end_time_stamp."}";
		$send_data[] = $event_end_time_str;
		
		$exchange_end_time_str = "{exchange_e_time,".$exchange_end_time_stamp."}";
		$send_data[] = $exchange_end_time_str;
		
		//构造*********************************************
		if(!empty($exchange_case_data))
		{
			foreach($exchange_case_data as $key => $value)
			{
				//兑换需要的道具列表
				$item_str = '';
				if(!empty($value['item']))
				{
					$comma_flag = false;
					foreach($value['item'] as $key1 => $value1)
					{
						if ($comma_flag)
						{
							$item_str .= ",";
						}
						$item_str .= "{".$value1['item_id'].",".$value1['item_num']."}";
						$comma_flag = true;
					}
				}
				
				//奖励道具列表
				$goods_str = '';
				if(!empty($value['goods']))
				{
					$comma_flag = false;
					foreach($value['goods'] as $key1 => $value1)
					{
						if($comma_flag)
						{
							$goods_str .= ",";
						}
						$goods_str .= "{r_gen_config,".$value1['goods_type'].",".$value1['goods_id'].",".$value1['goods_num'].",".$value1['goods_bind'].",".$value1['goods_weight']."}";
						$comma_flag = true;
					}
				}
				
				$item_goods_value2 = "{".$value['level']['min_level'].",".$value['level']['max_level']."},[".$item_str."],[".$goods_str."]";
				$item_goods_value = "{".$item_goods_value2."}";		
				$tmp_str = $erlangWebAdminHost."gm/exchange_item_goods_btn/" .
					"?pos_index={$value['button']['exchange_btn_pos_index']}&name={$value['button']['exchange_btn_name']}" .
					"&key={$value['button']['exchange_btn_key']}&cd_time={$value['button']['exchange_btn_cd_time']}&item_goods={$item_goods_value}";
				//			echo $tmp_str;
				$result = getJson($erlangWebAdminHost."gm/exchange_item_goods_btn/" .
					"?pos_index={$value['button']['exchange_btn_pos_index']}&name={$value['button']['exchange_btn_name']}" .
				"&key={$value['button']['exchange_btn_key']}&cd_time={$value['button']['exchange_btn_cd_time']}&item_goods={$item_goods_value}");	
			}
		}
		//构造*********************************************
		/*
		 $item_str = '';
		 if(!empty($need_item_data))
		 {
		 $comma_flag = false;
		 foreach($need_item_data as $key => $value)
		 {
		 if ($comma_flag)
		 {
		 $item_str .= ",";
		 }
		 $item_str .= "{".$value['item_id'].",".$value['item_num']."}";
		 $comma_flag = true;
		 }
		 }
		 
		 $goods_str = '';
		 if(!empty($award_goods_data))
		 {
		 $comma_flag = false;
		 foreach($award_goods_data as $key => $value)
		 {
		 if($comma_flag)
		 {
		 $goods_str .= ",";
		 }
		 $goods_str .= "{r_gen_config,".$value['goods_type'].",".$value['goods_id'].",".$value['goods_num'].",".$value['goods_bind'].",".$value['goods_weight']."}";
		 $comma_flag = true;
		 }
		 }
		 $exchange_info_value = "{p_festival_excchange_info,{".$min_level.",".$max_level."},[".$item_str."],[".$goods_str."]}";
		 $exchange_info_str = "{exchange_info,".$exchange_info_value."}";
		 $send_data[] = $exchange_info_str;
		 */
		//构造*********************************************
		
		
		if($type_id == $ACT_MONSTER_TYPE)
		{
			$monster_str = '';
			if (!empty($monster_data))
			{
				$comma_flag = false;
				foreach($monster_data as $key => $value)
				{
					if($comma_flag)
					{
						$monster_str .= ",";
					}
					$monster_str .= "{".$value['map_id'].",{".$value['monster_id'].",".$value['monster_pos_x'].",".$value['monster_pos_y'].",".$value['monster_type']."}}";
					$comma_flag = true;
				}
			}
			$event_info_value = "[".$monster_str."]";
			$event_info_str = "{event_info,".$event_info_value."}";
			$send_data[] = $event_info_str;
		}
		else if ($type_id == $ACT_EXP_TYPE)
		{
			$event_info_str = "{event_info,".$exp_times."}";
			$send_data[] = $event_info_str;
		}
		else if ($type_id == $ACT_OFFLINE_BAG_TYPE)
		{
			$event_info_str = "{event_info,{".$offline_days.",".$offline_level."}}";
			$send_data[] = $event_info_str;
		}
		else if ($type_id == $ACT_GROW_TYPE)
		{
			$grow_type_id = $_REQUEST['grow_goods_type'];
			$event_info_grow_str1 = "{event_info_grow1,{".$day_times.",{".$grow_item_id.",".$grow_type_id."}}}";
			//echo $event_info_grow_str1.'<br>';
			$send_data[] = $event_info_grow_str1;
			
			$event_info_grow_data = '';
			if (!empty($grow_data))
			{
				$comma_flag = false;
				foreach($grow_data as $key => $value)
				{
					if($comma_flag)
					{
						$event_info_grow_data .= ",";
					}
					$event_info_grow_data .= "{".$value['now_grow_item_id'].",".$value['grow_exp'].",".$value['next_grow_item_id'].",'".$value['grow_link']."'}";
					$comma_flag = true;
				}
			}
			$event_info_grow_value3 = "[".$event_info_grow_data."]";
			$event_info_grow_str3 = "{event_info_grow3,".$event_info_grow_value3."}";
			$send_data[] = $event_info_grow_str3;	 
		}
		
		//活动描述包含中文字符单独发送,活动名和活动描述包含中文字符单独发送
		$result = getJson($erlangWebAdminHost."gm/act_conf_event_ch/?event_name={$event_name}&event_desc={$event_desc}");
		
		if ($result ['result'] == 'ok') 
		{
			//nothing
		}
		else
		{
			errorExit($buf_lang['new']['ac_fail']);
		}
		
		foreach($send_data as $key => $value)
		{
			//发送数据到游戏服
			$result = getJson ( $erlangWebAdminHost."gm/act_conf/?str={$value}" );
			if ($result ['result'] == 'ok') 
			{
				//nothing
			}
			else
			{
				errorExit($buf_lang['new']['ac_fail']);
			}
		}
		
		//发送养成按钮信息，按钮名包含中文，必须单独发送
		foreach($grow_button_data as $key => $value)
		{
			$result = getJson($erlangWebAdminHost."gm/act_conf_grow_button/" .
			"?pos_index={$value['grow_btn_pos_index']}&name={$value['grow_btn_name']}&key={$value['grow_btn_key']}&cd_time={$value['grow_btn_cd_time']}");
			
			if ($result ['result'] == 'ok') 
			{
				//nothing
			}
			else
			{
				errorExit($buf_lang['new']['y_buttom_ac_fail']);
			}
		}
		
		//发送活动按钮信息，按钮名包含中文，必须单独发送
		foreach($button_data as $key => $value)
		{
			$result = getJson($erlangWebAdminHost."gm/act_conf_button/" .
			"?pos_index={$value['btn_pos_index']}&name={$value['btn_name']}&key={$value['btn_key']}&cd_time={$value['btn_cd_time']}");
			
			if ($result ['result'] == 'ok') 
			{
				//nothing
			}
			else
			{
				errorExit($buf_lang['new']['activity_buttom_ac_fail']);
			}
		}
		
		$end_str = "{stop,1}";
		//发送完毕
		$result = getJson ( $erlangWebAdminHost."gm/act_conf/?str={$end_str}" );
		//print_r($result);echo "<br>";
		if ($result ['result'] == 'ok') 
		{
			infoExit ( $buf_lang['new']['ac_sussecc'],"act_collect_conf.php" );
		}
		else
		{
			//echo "why error!";
			errorExit($buf_lang['new']['ac_error']);
		}
	}
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
	
	$open_server_id = '';
}
else if($action == 'doDelFestivalEvent')
{
	//print_r($festival_event_id);
	if($festival_event_id != 0)
	{
		doDelEvent($festival_event_id);
	}
}

$need_item_data = array_merge($need_item_data, array());



$award_goods_data = array_merge($award_goods_data, array());

$exchange_case_data = array_merge($exchange_case_data, array());

$monster_data = array_merge($monster_data, array());
if(!empty($monster_data)){
	foreach ($monster_data as $key => $value)
	{
		$order_map[] = $value['map_id'];
		$order_monster[] = $value['monster_id'];
	}
	//按地图id排序
	array_multisort($order_map, SORT_ASC, $order_monster, SORT_ASC, $monster_data); 
}

$grow_data = array_merge($grow_data, array());

$button_data = array_merge($button_data, array());



function doGetFestialList()
{
    global $smarty,$erlangWebAdminHost;
    $result = getJson ( $erlangWebAdminHost."gm/get_festival_list/"); 
	$smarty->assign("festival_list", $result);
}

function doDelEvent($festival_event_id)
{
    global $smarty,$erlangWebAdminHost;
    $result = getJson ( $erlangWebAdminHost."gm/del_festival/?festival_event_id={$festival_event_id}"); 
	if($result[result] != 'ok')
	{
		errorExit($buf_lang['new']['delect_activity_error']);
	}
}


if($action != 'doClear')
{
	doGetFestialList();
}else
{
	$smarty->assign("festival_list", $festival_list_data);
}


$smarty->assign("type_id", $type_id);
$smarty->assign("show_id", $show_type);
$smarty->assign("event_id", $event_id);
$smarty->assign("event_name", $event_name);
$smarty->assign("event_start_time", $event_start_time);
$smarty->assign("event_end_time", $event_end_time);
$smarty->assign("event_desc", $event_desc);
$smarty->assign("exchange_end_time", $exchange_end_time);

$smarty->assign("min_level", $min_level);
$smarty->assign("max_level", $max_level);
$smarty->assign("exchange_btn_pos_index", $exchange_btn_pos_index);
$smarty->assign("exchange_btn_name", $exchange_btn_name);
$smarty->assign("exchange_btn_key", $exchange_btn_key);
$smarty->assign("exchange_btn_cd_time", $exchange_btn_cd_time);

$smarty->assign("exp_times", $exp_times);

$smarty->assign("offline_days", $offline_days);
$smarty->assign("offline_level", $offline_level);

$smarty->assign("grow_item_id", $grow_item_id);
$smarty->assign("day_times", $day_times);


$smarty->assign("need_item", $need_item_data);
$smarty->assign("award_goods_data", $award_goods_data);

$smarty->assign("exchange_case_data", $exchange_case_data);

$smarty->assign("monster_data", $monster_data);

$smarty->assign("grow_data", $grow_data);
$smarty->assign("grow_button_data", $grow_button_data);

$smarty->assign("button_data", $button_data);

$smarty->assign("goods_type_option", $GOODS_TYPE);
$smarty->assign("act_type_option", $ACT_TYPE);
$smarty->assign("show_type_option", $SHOW_TYPE);

$smarty->assign("open_server_option", $OPEN_SERVER);



$smarty->display("module/gm/act_collect_conf.html");

