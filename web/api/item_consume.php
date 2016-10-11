<?php
/**
 * 道具消耗接口 
 * @author wangxuefeng@4399.com
 * @date 2011.06.04
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：道具id，名称，总消耗数量，价格，总元宝
 * 	   {item_id, item_name， sum_item， item_price， total_gold}
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

//当天的道具消费记录
$dateStartStamp = strtotime($date . ' 0:0:0');
$dateEndStamp   = strtotime($date . ' 23:59:59');

$sql = 'select item_id , item_name , sum( ABS(item_num) ) as sum_item '
        . ' from t_log_item '
        . ' where mtime >= ' .
        $dateStartStamp .
        ' and mtime <= ' .
        $dateEndStamp .
        ' and mtype=4002' 
        . ' group by item_id '
        . ' order by sum_item desc';
$result = GFetchRowSet($sql);
foreach($result as $key => $rw)
{
	$price = getItemPrice($rw['item_id'], $price_result);
	$result[$key]['item_price'] = $price;
	$result[$key]['total_gold'] = $price * $rw['sum_item'];
}
//print_r($result);
echo json_encode($result);




function getItemPrice($item_id, $price_result)
{
	$item_price = 0;
	foreach($price_result as $key => $row)
	{
		if ($row['id'] == $item_id)
		{
			$item_price = $row['price'];
			break;
		}
	}
	return $item_price;
}
