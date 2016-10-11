<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty;

/* do1:开启竞技场
 * do2：关闭竞技场
 * do3：设置竞技场开启时间
 * do5：开启坐骑竞技
 * do6：关闭坐骑竞技
 * do7：设置坐骑竞技开启时间
 * do8：强制结束比赛
 * do9：开启防沉迷系统
 * do10：关闭防沉迷系统
 * */
 
if ( !isset($_REQUEST['match_start_time'])){
	$open_match_time = '18:00';
}
else
{
	$open_match_time  = trim(SS($_REQUEST['match_start_time']));
}

if ( !isset($_REQUEST['mount_match_start_time'])){
	$open_mount_match_time = '12:00';
}
else
{
	$open_mount_match_time  = trim(SS($_REQUEST['mount_match_start_time']));
}

$action = trim ( $_GET ['action'] );
//echo $action.'<br>';
if ($action == 'do1') 
{
	$result = getJson ( $erlangWebAdminHost."gm/open_match/");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_OPEN_MATCH,'', '','', '', '');
		infoExit("开启竞技场成功");
	} else {
		infoExit("开启竞技场失败");
	}
}
else if ($action == 'do2') 
{
	$result = getJson ( $erlangWebAdminHost."gm/close_match/");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_CLOSE_MATCH,'', '','', '', '');
		infoExit("关闭竞技场成功");
	} else {
		infoExit("关闭竞技场失败");
	}
}
else if ($action == 'do3') 
{
	$dateStartStamp = strtotime($open_match_time);
	$open_hour = date('H', $dateStartStamp);
	$open_minute = date('i', $dateStartStamp);
	$open_time = $open_hour * 3600 + $open_minute * 60;

	$result = getJson ( $erlangWebAdminHost."gm/set_open_time/?open_time={$open_time}");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_SET_MATCH_TIME,'', '','', '', '');
		infoExit("设置竞技场开启时间成功");
	} else {
		infoExit("设置竞技场开启时间失败");
	}
}
else if ($action == 'do5')
{
	$result = getJson ( $erlangWebAdminHost."gm/open_mount_match/");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_OPEN_MOUNT_MATCH,'', '','', '', '');
		infoExit("开启坐骑竞技成功");
	} else {
		infoExit("开启坐骑竞技失败");
	}
}
else if ($action == 'do6')
{
	$result = getJson ( $erlangWebAdminHost."gm/close_mount_match/");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_CLOSE_MOUNT_MATCH,'', '','', '', '');
		infoExit("关闭坐骑竞技成功");
	} else {
		infoExit("关闭坐骑竞技失败");
	}
}
else if ($action == 'do7')
{
	$dateStartStamp = strtotime($open_mount_match_time);
	$open_hour = date('H', $dateStartStamp);
	$open_minute = date('i', $dateStartStamp);
	$open_time = $open_hour * 3600 + $open_minute * 60;

	$result = getJson ( $erlangWebAdminHost."gm/set_open_mount_time/?open_time={$open_time}");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_SET_MOUNT_MATCH_TIME,'', '','', '', '');
		infoExit("设置坐骑竞技开启时间成功");
	} else {
		infoExit("设置坐骑竞技开启时间失败");
	}
}
else if ($action == 'do8')
{
	$result = getJson ( $erlangWebAdminHost."gm/stop_match/");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_STOP_MATCH,'', '','', '', '');
		infoExit("强制结束比赛成功");
	} else {
		infoExit("强制结束比赛失败");
	}
}
else if ($action == 'do9')
{
	//更改配置文件 {is_fcm_open,false}修改为 {is_fcm_open,true}.
	$config_list = file('/data/mccq/server/config/common.config');
	foreach($config_list as $key => $row)
	{
		if(strpos($row, 'is_fcm_open')===false)
		{
			continue;
		}
		else
		{
			$fcm_config = $config_list[$key];
			$new_str = str_replace("false", "true", $fcm_config);
			$config_list[$key] = $new_str;
		}		
	}
	
	$config_file = fopen('/data/mccq/server/config/common.config', 'w');
	foreach($config_list as $key => $row)
	{
		fwrite($config_file, $row);
	}
	fclose($config_file);
	
	$result = getJson ( $erlangWebAdminHost."gm/switch_fcm_sys/");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_OPEN_FCM_SYS,'', '','', '', '');
		infoExit("开启防沉迷系统成功");
	} else {
		infoExit("开启防沉迷系统失败");
	}
}
else if ($action == 'do10')
{
	//更改配置文件 {is_fcm_open,true}修改为 {is_fcm_open,false}.
	$config_list = file('/data/mccq/server/config/common.config');
	foreach($config_list as $key => $row)
	{
		if(strpos($row, 'is_fcm_open')===false)
		{
			continue;
		}
		else
		{
			$fcm_config = $config_list[$key];
			$new_str = str_replace("true", "false", $fcm_config);
			$config_list[$key] = $new_str;
		}		
	}
	
	$config_file = fopen('/data/mccq/server/config/common.config', 'w');
	foreach($config_list as $key => $row)
	{
		fwrite($config_file, $row);
	}
	fclose($config_file);
	
	$result = getJson ( $erlangWebAdminHost."gm/switch_fcm_sys/");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_OPEN_FCM_SYS,'', '','', '', '');
		infoExit("关闭防沉迷系统成功");
	} else {
		infoExit("关闭防沉迷系统失败");
	}
}

$smarty->assign("match_start_time", $open_match_time);
$smarty->assign("mount_match_start_time", $open_mount_match_time);
$smarty->display("module/gm/gm_switch.html");

