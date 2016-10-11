<?php
/**
 * 道具购买统计接口 
 * @author wangxuefeng@4399.com
 * @date 2011.06.04
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：道具id，今天购买数量，今天绑定元宝，今天不绑定元宝，今天总元宝，总数量，总绑定元宝，总不绑定元宝，总数量，价格，名称
 * 	   {itemid, amount, gold_bind, gold_unbind, gold, 
 * 		total_amount, total_gold_bind, total_gold_unbind, total_gold,
 * 		item_price, name}
 */
define('IN_DATANG_SYSTEM', true);
include "../config/config.php"; 
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';

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
	//echo $token;
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}


$item_price_list = file('/data/mccq/server/config/item_price.config');
$price_result = array();
foreach($item_price_list as $key => $line)
{
	$line = trim($line);
	if ($line == "")continue;
	$price_msg = explode(',', $line);
	$price_result[$key]['id'] = $price_msg[0];
	$price_result[$key]['price'] = $price_msg[1];
	$price_result[$key]['name'] = $price_msg[2];
}

//道具总消耗记录
$item_total_stat = array();
$item_total_stat = LogGoldClass::getBuyLogStats("", "", "", null, null);

//当天的道具消费记录
$dateStartStamp = strtotime($date . ' 0:0:0');
$dateEndStamp   = strtotime($date . ' 23:59:59');

$item_buy_stat = array(); 
$item_buy_stat = LogGoldClass :: getBuyLogStats("", "", "", $dateStartStamp, $dateEndStamp);

foreach($item_buy_stat as $key => $rw)
{
	$item = getItemMsg($rw['itemid'], $price_result);
	$total_item = getTotalItemMsg($rw['itemid'], $item_total_stat);
	
	$item_buy_stat[$key]['total_amount'] = $total_item['amount'];
	$item_buy_stat[$key]['total_gold_bind'] = $total_item['gold_bind'];
	$item_buy_stat[$key]['total_gold_unbind'] = $total_item['gold_unbind'];
	$item_buy_stat[$key]['total_gold'] = $total_item['gold'];
	
	$item_buy_stat[$key]['item_price'] = $item['price'];
	$item_buy_stat[$key]['name'] = $item['name'];
}
//print_r($item_buy_stat);
echo json_encode($item_buy_stat);





function getItemMsg($item_id, $price_result)
{
	$item_msg = array();
	foreach($price_result as $key => $row)
	{
		if ($row['id'] == $item_id)
		{
			$item_msg = $price_result[$key];
			break;
		}
	}
	return $item_msg;
}

function getTotalItemMsg($item_id, $item_total_stat)
{
	$total_item_msg = array();
	foreach($item_total_stat as $key => $row)
	{
		if ($row['itemid'] == $item_id)
		{
			$total_item_msg = $item_total_stat[$key];
			break;
		}
	}
	return $total_item_msg;
}
