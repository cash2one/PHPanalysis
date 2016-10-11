<?php
/**
 * 充值按天查询 
 * @author wangxuefeng@4399.com
 * @date 2011.08.20
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：时间，充值金额，人次，人数，ARPU值
 * 	   {date, pay_day, role_cnt, times_cnt,arpu}
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

$dateStartStamp = strtotime($date . ' 0:0:0');
$dateEndStamp   = strtotime($date . ' 23:59:59');

$sql = 'SELECT from_unixtime(pay_time,\'%Y-%m-%d\') as date, round(sum(pay_money)/100,2) as pay_day, count(distinct role_id) as role_cnt,' .
		' count(role_id) as times_cnt, round(sum(pay_money)/100/(count(distinct role_id)), 2) as arpu' .
		' FROM `db_pay_log_p` '
        . ' where `pay_time` >= ' .
        $dateStartStamp .
        ' and pay_time <= ' .
        $dateEndStamp
        . ' group by year , month , day order by year desc, month desc, day desc'; 
$result = GFetchRowSet($sql);

echo json_encode($result);
        


