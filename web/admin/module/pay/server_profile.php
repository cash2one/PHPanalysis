<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

if ( !isset($_REQUEST['dStartTime'])) {
    $dStartTime = date("Y-m-d",time()-13*60*60*24);
}
else {
    $dStartTime  = trim(SS($_REQUEST['dStartTime']));
}
if ( !isset($_REQUEST['dEndTime'])) {
    $dEndTime = strftime ("%Y-%m-%d", time() );
}
else {
    $dEndTime = trim(SS($_REQUEST['dEndTime']));
}
$start_time = strtotime($dStartTime.' 00:00:00');
$end_time = strtotime($dEndTime.' 23:59:59');

//服务器信息
/*$keySign = "FTNN4399payKode";
$sign = md5($AGENT_ID.$keySign.$GAME_SERVER);
$center_url = 'http://dtzl2.center.my4399.com/';
$link = $center_url."web/api/server_info.php?agent_id={$AGENT_ID}&server_id={$GAME_SERVER}&sign={$sign}";
$result = make_request($link, 'POST', 5);
$server = json_decode($result, true);*/

$server = $ALL_SERVER_LIST[$AGENT_ID][$GAME_SERVER];

$i = 24*60*60;
if($server['open_time']==0 || !isset($server['open_time']))
    $message = '<font color="red">服务器信息错误，请联系技术人员</font>';
$length =  round(($end_time-$start_time)/$i);
$server['date'] = round((time()-$server['open_time'])/$i);
$server['open_time'] = date('Y-m-d',$server['open_time']);
//总注册人数
$sql_register_total = "select count(*) as num from db_account_p where agent_id = ".$AGENT_ID." and server_id = ".$GAME_SERVER;
//总充值金额，总充值人数
$sql_pay_total = "select count(distinct role_id) as pay_num,sum(pay_money/100)+sum(pay_ticket/10) as money from db_pay_log_p where agent_id=$AGENT_ID";
//最高在线
$sql_max_online = " select max(online ) as online from t_log_online  where 1 ";
//单日最高充值
$sql_max_pay = "select max(a.money) as max_pay from (select sum(pay_money/100)+sum(pay_ticket/10) as money from db_pay_log_p
                where agent_id=$AGENT_ID group by year,month,day ) a";
//每日峰值在线
$sql_online = " select max(online ) as online ,from_unixtime(dateline,'%Y-%m-%d') as date,from_unixtime(dateline,'%w') as week from t_log_online
                where dateline>=$start_time and dateline<=$end_time group by year,month,day order by date desc";
//每日充值金额
$sql_pay = " select sum(pay_money/100)+sum(pay_ticket/10) as money,from_unixtime(pay_time,'%Y-%m-%d') as date ,from_unixtime(pay_time,'%w') as week from db_pay_log_p
                where  agent_id=$AGENT_ID AND pay_time>=$start_time and pay_time<=$end_time  group by date order by date desc ";

$sql_max_level = "select max(level) as max_level from db_role_attr_p";


for($tmp=$end_time,$i=24*60*60;$start_time<=$tmp;){
    $format_date[] = date('Y-m-d',$tmp);
    $tmp -= $i;
}
//$length = count($format_date);
//echo $length;

$register_total = $db->fetchOne($sql_register_total);
$pay_total = $db->fetchOne($sql_pay_total);
$max_all_online = $db->fetchOne($sql_max_online);
$max_all_pay = $db->fetchOne($sql_max_pay);
$rt_online = $db->fetchAll($sql_online);
$rt_pay = $db->fetchAll($sql_pay);
$max_level = $db->fetchOne($sql_max_level);



$maxOnline=0;
$avgOnline=0;

foreach($rt_online as $value){
    $format_online[$value['date']]['online'] = $value['online'];
    $format_online[$value['date']]['week'] = $value['week'];
}

foreach ($rt_pay as $value){
    $format_pay[$value['date']]['money'] = $value['money'];
    $format_pay[$value['date']]['week'] = $value['week'];
}

foreach($format_date as $key=>$value){
    $date = $value;
    $week = date('w',strtotime($value));
    $tmp_money = isset($format_pay[$value]['money'])?$format_pay[$value]['money']:0;
    $tmp_online = isset($format_online[$value]['online'])?$format_online[$value]['online']:0;
    $result_online[$key]['online'] = $tmp_online;
    $result_pay[$key]['money'] = $tmp_money;
    $result_online[$key]['date'] = $result_pay[$key]['date'] = $value;
    $result_online[$key]['week'] = $result_pay[$key]['week'] = $week;
}

if(Count($result_online)>0)
{
	foreach($result_online as $id=>$row)
	{
            
		if($result_online[$id]['online']>$maxOnline)
		{
			$maxOnline=$result_online[$id]['online'];
		}
		$avgOnline+=$result_online[$id]['online'];
	}

	$avgOnline=intval($avgOnline/$length);

	foreach($result_online as $id=>$row)
	{
		$rate=1;
		if($maxOnline>150)
		{
			$rate=150/$maxOnline;
		}
		$result_online[$id]['height']=intval($result_online[$id]['online']*$rate);
		$result_online[$id]['date'] = date('m/d',strtotime($result_online[$id]['date']));
	}
}


$max_pay=0;
$avg_pay=0;
if(Count($result_pay)>0)
{
	foreach($result_pay as $id=>$row)
	{
        $result_pay[$id]['money'] = round($result_pay[$id]['money'],2);
		if($result_pay[$id]['money']>$max_pay)
		{
			$max_pay=$result_pay[$id]['money'];
		}
		$all_pay+=$result_pay[$id]['money'];
	}

	$avg_pay=round($all_pay/$length,2);

	foreach($result_pay as $id=>$row)
	{
		$rate=1;
		if($max_pay>150)
		{
			$rate=150/$max_pay;
		}
		$result_pay[$id]['height']=intval($result_pay[$id]['money']*$rate);
		$result_pay[$id]['date'] = date('m/d',strtotime($result_pay[$id]['date']));
	}
}
$pay_num = $pay_total['pay_num']>0 ? $pay_total['pay_num'] : 1;
$arpu = round($pay_total['money']/$pay_num,2);
//游戏程序信息
$json = getJson($erlangWebAdminHost. "server");

$smarty->assign('dStartTime',$dStartTime);
$smarty->assign('dEndTime',$dEndTime);


$smarty->assign('message',$message);
$smarty->assign('agent_name',$AGENT_NAME[$AGENT_ID]);
$smarty->assign('server',$server);
$smarty->assign('max_level',$max_level['max_level']);
$smarty->assign('register',$register_total['num']);
$smarty->assign('pay_num',$pay_total['pay_num']);
$smarty->assign('pay_money',round($pay_total['money'],2));
$smarty->assign('arpu',$arpu);
$smarty->assign('max_all_online',$max_all_online['online']);
$smarty->assign('max_all_pay',round($max_all_pay['max_pay'],2));
$smarty->assign('register',$register_total['num']);

$smarty->assign('online',$result_online);
$smarty->assign('max_online',$maxOnline);
$smarty->assign('avg_online',$avgOnline);

$smarty->assign('pay',$result_pay);
$smarty->assign('max_pay',$max_pay);
$smarty->assign('avg_pay',$avg_pay);





$smarty->assign('erlang_version', $json['erlang_version']);
$smarty->display("module/pay/server_profile.html");



#-------------------
function make_request($url, $method = 'GET', $timeout = 5) {
    $ch = curl_init();
    $header = array(
            'Accept-Language: zh-cn',
           'Connection: Keep-Alive',
            'Cache-Control: no-cache'
    );
    if ($method == 'GET') {
        curl_setopt($ch, CURLOPT_HEADER, 0);
    }
    else {
        $i = strpos($url, '?');
        $param_str = substr($url, $i + 1);
        $url = substr($url, 0, $i);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_str);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'WEB.4399.COM API PHP Servert 0.1 (curl) ' . phpversion());
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    if ($timeout > 0) curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
#-----------------------------