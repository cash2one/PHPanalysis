<?php
/**
 * 道具、装备全部列表 
 * @author wangxuefeng@4399.com
 * @date 2011.06.04
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：道具id，道具/装备名称，类型（1：道具，2：装备），时效（0:一次性，-1:永久，>0几天），颜色
 *     {item_id,name,type,time, colour}
 */
define('IN_DATANG_SYSTEM', true);
include("../config/config.php");
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global  $db;

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

//全部道具列表
$item_list = file('/data/mccq/server/config/world/item.config');
$item_result = array();
foreach($item_list as $key => $line)
{
	$line = trim($line);
    if($line=="") continue;
	$item_msg = explode(',', $line);
	$item_result[$key]['item_id'] = $item_msg[1];
	$name = str_replace('<<"', '', $item_msg[2]);
	$name1 = str_replace('">>', '', $name);
	$item_result[$key]['name'] = $name1;
	$item_result[$key]['type'] = 1;
	$item_result[$key]['time'] = 0;    //0代表一次性
	$item_result[$key]['colour'] = $item_msg[6];
}
//print_r($item_result);

//echo json_encode($item_result);

//全部装备列表
$equip_list = file('/data/mccq/server/config/world/equip.config');
$equip_result = array();
foreach($equip_list as $key => $line)
{
	$line = trim($line);
    if($line=="") continue;
	$equip_msg = explode(',', $line);
	$equip_result[$key]['item_id'] = $equip_msg[1];
	$name = str_replace('<<"', '', $equip_msg[2]);
	$name1 = str_replace('">>', '', $name);
	$equip_result[$key]['name'] = $name1;
	$equip_result[$key]['type'] = 2;
	$equip_result[$key]['time'] = -1;    //-1代表永久
	$equip_result[$key]['colour'] = $equip_msg[5];
}
//print_r($equip_result);
//echo json_encode($equip_result);

$final_out = array('item' => $item_result, 'equip' => $equip_result);
echo json_encode($final_out);


