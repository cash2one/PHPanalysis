<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $db;

$weekday_zn = array(
	1=>"一",
	2=>"二",
	3=>"三",
	4=>"四",
	5=>"五",
	6=>"六",
	7=>"日",
);

//sPlatName:sPlatName,sServerName:sServerName,dStartTime:dStartTime,dEndTime:dEndTime,iFlag:2 
$sPlatName = $_REQUEST['sPlatName'];
$sServerName = $_REQUEST['sServerName'];
$dStartTime = $_REQUEST['dStartTime'];
$dEndTime = $_REQUEST['dEndTime'];
$iFlag = $_REQUEST['iFlag'];

$dStartTimeStamp = strtotime($dStartTime. ' 0:0:0');
$dEndTimeStamp = strtotime($dEndTime. ' 23:59:59');

//{"sPlatName":"allPlat","sServerName":"allServer","dStartTime":"2011-12-01","dEndTime":"2011-12-29","iFlag":"2"}
$dayHtml = "<table valign='top' bgcolor='#bbdde5' border='0' cellpadding='0' cellspacing='1' width='100%'>
	<tbody>
	<tr align='center' class='table_list_head'>
	<td height='25' width='15%'><b>".$buf_lang['conmon']['date_time']."</b></td>
	<td width='8%'><b>".$buf_lang['left']['server_num']."</b></td>
	<td width='8%'><b>".$buf_lang['left']['recharge_num']."</b></td>
	<td width='8%'><b>".$buf_lang['left']['recharge_times']."</b></td>
	<td width='17%'><b>".$buf_lang['left']['recharge_amount']."</b></td>
	<td width='18%'><b>".$buf_lang['left']['recharge_detail']."</b></td>
	<td width='10%'><b>".$buf_lang['left']['single_service_revenue']."</b></td>
	<td width='10%'><b>".$buf_lang['left']['recharge_ingot']."</b></td>
	<td width='6%'><b>".$buf_lang['conmon']['arpu']."</b></td>
	</tr>";

$allResult = array();

# 按天
$sql = "SELECT from_unixtime(pay_time, '%Y-%m-%d') as pay_day_time, count(distinct role_id) as role_cnt, count(role_id) as times_cnt, round(sum(pay_money)/100,2) as pay_day_money, " .
	"sum(pay_gold) as pay_day_gold " .
	" FROM all_source_paylog_rmb " .
	" WHERE pay_time>={$dStartTimeStamp} AND pay_time<={$dEndTimeStamp} ";
$server_flag = 0;

# 代理商id
if($sPlatName == "allPlat")
{
	//所有平台所有服务器！！！
}
else
{
	$sql .= " AND agent_id={$sPlatName}";
        $where = " AND agent_id={$sPlatName} ";
}

# 服务器id
if($sServerName == "allServer")
{
    $server_flag=0;
	//所有服务器
}
else
{
	$sql .= " AND server_id={$sServerName}";
        $server_flag = 1;
}
$sql .= " GROUP BY from_unixtime(pay_time, '%Y-%m-%d') ORDER BY pay_time DESC";
$result = $db->fetchAll($sql);
$sql_server_num = "select sum(open_num) as num ,date from all_server_num where date>='$dStartTime' and date<='$dEndTime'  $where  group by date";

if(!empty($result)) {
//------------每日-----------------
    if($server_flag!=1) {
        $result_server_num = $db->fetchAll($sql_server_num);
        foreach($result_server_num as $v) {
            $format_server_num[$v['date']] .= $v['num'];
        }
    }
    foreach ($result as $key=>$value) {
        if(isset($format_server_num[$value['pay_day_time']]) || $server_flag) {
            $result[$key]['num'] = $server_flag!=1? $format_server_num[$value['pay_day_time']]:1;
            $result[$key]['singal_pay'] = round($value['pay_day_money']/$result[$key]['num'],2);
        } else {
            $result[$key]['num'] = '*';
            $result[$key]['singal_pay'] = '*';
        }
    }
//-----------------每日---------------

	# 按天充值统计结果
	$allResult = array_merge($allResult, $result);
	
	# 小结
	$sql2 = "SELECT count(distinct role_id) as role_cnt, count(role_id) as times_cnt, round(sum(pay_money)/100,2) as pay_day_money, " .
		"sum(pay_gold) as pay_day_gold" .
		" FROM all_source_paylog_rmb " .
		" WHERE pay_time>={$dStartTimeStamp} AND pay_time<={$dEndTimeStamp}";
       $sql2_server_num = "select max(a.num) as num from (select sum(open_num) as num ,date from all_server_num where date>='$dStartTime' and date<='$dEndTime'  $where  group by date) a ";
	# 代理商id
	if($sPlatName == "allPlat")
	{
		//所有平台所有服务器！！！
	}
	else
	{
		$sql2 .= " AND agent_id={$sPlatName}";
	}
	
	# 服务器id
	if($sServerName == "allServer")
	{
		//所有服务器
	}
	else
	{
		$sql2 .= " AND server_id={$sServerName}";
	}
	
	$result2 = $db->fetchAll($sql2);
	$result2[0]['pay_day_time'] = "小结";
       //-------------小结----------------------
        if($server_flag) {
            $result2[0]['num'] = 1;
            $result2[0]['singal_pay'] = $result2[0]['pay_day_money'];
        }
        else {
            $result2_server_num = $db->fetchOne($sql2_server_num);
            $result2[0]['num'] =$result2_server_num['num']? $result2_server_num['num']:'*';
            $result2[0]['singal_pay'] = $result2_server_num['num']?round($result2[0]['pay_day_money']/$result2[0]['num'],2):'*';

        }
 //-------------------------小结---------------
        $allResult = array_merge($allResult, $result2);
    }

#月结
$sqlMonth = "SELECT from_unixtime(pay_time, '%Y-%m(月结)') as pay_day_time,from_unixtime(pay_time, '%Y%m') as pay_month,count(distinct role_id) as role_cnt, count(role_id) as times_cnt, round(sum(pay_money)/100,2) as pay_day_money, " .
	"sum(pay_gold) as pay_day_gold" .
	" FROM all_source_paylog_rmb WHERE pay_time <> 0";
# 代理商id
if($sPlatName == "allPlat")
{
	//所有平台所有服务器！！！
}
else
{
	$sqlMonth .= " AND agent_id={$sPlatName}";
}

# 服务器id
if($sServerName == "allServer")
{
	//所有服务器
}
else
{
	$sqlMonth .= " AND server_id={$sServerName}";
}
$sqlMonth .= " group by from_unixtime(pay_time, '%Y-%m') ORDER BY pay_time desc";
$resultMonth = $db->fetchAll($sqlMonth);
if(!empty($resultMonth)) {
    //----------每月--------------
    $sql_month = "select max(a.num) AS num  ,EXTRACT(YEAR_MONTH FROM a.date)  as month  from (select sum(open_num) as num ,date from all_server_num where 1 $where  group by date) a group by month ";
  
    if($server_flag!=1) {
        $result_month = $db->fetchAll($sql_month);
        foreach($result_month as $v) {
            $format_month[$v['month']] .= $v['num'];
        }
    }
    foreach ($resultMonth as $key=>$value) {
        if(isset($format_month[$value['pay_month']]) || $server_flag) {
            $resultMonth[$key]['num'] = $server_flag!=1? $format_month[$value['pay_month']]:1;
            $resultMonth[$key]['singal_pay'] = round($value['pay_day_money']/$resultMonth[$key]['num'],2);
        } else {
            $resultMonth[$key]['num'] = '*';
            $resultMonth[$key]['singal_pay'] = '*';
        }
    }
    //----------每月--------------
    # 分月统计结果
    $allResult = array_merge($allResult, $resultMonth);
}

#年结
$sqlYear = "SELECT from_unixtime(pay_time, '%Y(年结)') as pay_day_time, from_unixtime(pay_time, '%Y') as pay_year,count(distinct role_id) as role_cnt, count(role_id) as times_cnt, round(sum(pay_money)/100,2) as pay_day_money, " .
	"sum(pay_gold) as pay_day_gold" .
	" FROM all_source_paylog_rmb WHERE pay_time <> 0";
# 代理商id
if($sPlatName == "allPlat")
{
	//所有平台所有服务器！！！
}
else
{
	$sqlYear .= " AND agent_id={$sPlatName}";
}

# 服务器id
if($sServerName == "allServer")
{
	//所有服务器
}
else
{
	$sqlYear .= " AND server_id={$sServerName}";
}
$sqlYear .=	" group by from_unixtime(pay_time, '%Y') ORDER BY pay_time desc";
$resultYear = $db->fetchAll($sqlYear);
if(!empty($resultYear))
{

       //----------年--------------
    $sql_year = "select max(a.num) as num,year(a.date) as y  from (select sum(open_num) as num ,date from all_server_num where 1 $where  group by date) a group by year(a.date) ";

    if($server_flag!=1) {
        $result_year = $db->fetchAll($sql_year);
        foreach($result_year as $v) {
            $format_year[$v['y']] .= $v['num'];
        }
    }
    foreach ($resultYear as $key=>$value) {
        if(isset($format_year[$value['pay_year']]) || $server_flag) {
            $resultYear[$key]['num'] = $server_flag!=1? $format_year[$value['pay_year']]:1;
            $resultYear[$key]['singal_pay'] = round($value['pay_day_money']/$resultYear[$key]['num'],2);
        } else {
            $resultYear[$key]['num'] = '*';
            $resultYear[$key]['singal_pay'] = '*';
        }
    }
    //----------年--------------
	# 分年统计结果
	$allResult = array_merge($allResult, $resultYear);
}

$sql_server_num = "select sum(open_num) as num,date from all_server_num where date>='$dStartTime' and date<='$dEndTime' group by date ";

$result = $db->fetchAll($sql_server_num);
foreach($result as $value){
    $date = $value['date'];
    $server_num['date'] = $value['num'];
}




foreach($allResult as $key => $value)
{
	
	$not_all_flag = true;	//非小结、月结、年结
	
	if($value['pay_day_time'] == "小结")
	{
		$tmpStr = "<tr align='center' bgcolor='#D7E4F5'>";
		$not_all_flag = false;
	}
	else if(preg_match("/.*年结.*/",$value['pay_day_time']))
	{
		$tmpStr = "<tr align='center' bgcolor='#D7E4F5'>";
		$not_all_flag = false;
	}
	else if($key % 2 == 0)
	{
		$tmpStr = "<tr align='center' bgcolor='#EDF2F7'>";
	}
	else if($key % 2 == 1)
	{
		$tmpStr = "<tr align='center' bgcolor='#E0F0F0'>";
	}
	
	if(preg_match("/.*月结.*/",$value['pay_day_time']))
	{
		$not_all_flag = false;
	}
	
	$time = $value['pay_day_time'];
	
	$week_str = "";           //(一)
	if($not_all_flag)
	{
		$weekday_stamp = strtotime($value['pay_day_time']);
		$weekday_num = strftime("%u",$weekday_stamp);
		
		
		if($weekday_num == 6 || $weekday_num == 7)
		{
			$week_str .= "<font color='red'>({$weekday_zn[$weekday_num]})</font>";
		}
		else
		{
			$week_str .= "({$weekday_zn[$weekday_num]})";
		}	
	} 
	
	$tmpStr .= "<td height='25'><a href='javascript:void(0)' title='点击查看当天充值情况' onclick=GetDatePay({$value['pay_day_time']});>{$value['pay_day_time']}{$week_str}</a></td>";
	$tmpStr .= "<td>{$value['num']}</td>";    //服务器个数
	$tmpStr .= "<td>{$value['role_cnt']}</td>";
	$tmpStr .= "<td>{$value['times_cnt']}</td>";
	$tmpStr .= "<td>￥{$value['pay_day_money']}</td>";
	$tmpStr .= "<td>{$value['pay_day_money']} CNY</td>";	//充值明细
	$tmpStr .= "<td>{$value['singal_pay']}</td>";	//单服收入
	$tmpStr .= "<td>{$value['pay_day_gold']}</td>";
	$arpu_day = round($value['pay_day_money']/$value['role_cnt'], 2);
	$tmpStr .= "<td>{$arpu_day}</td>";
	$tmpStr .= "</tr>";
	
	$dayHtml .= $tmpStr;	
}	

$dayHtml .= "</tbody></table>";

#------------------------------------

# 今天&昨天充值明细

$todayHtml = "<table valign='top' bgcolor='#bbdde5' border='0' cellpadding='0' cellspacing='1' width='100%'>
	<tbody>
	<tr bgcolor='#ffffff' class='table_list_head'>
	<td colspan='7' height='25'><b>&nbsp;".$buf_lang['left']['arpu']."今日充值情况 </b></td>
	</tr>
	<tr align='center' class='table_list_head'>
	<td height='25' width='10%'><b>".$buf_lang['new']['agents']."</b></td>
	<td width='18%'><b>".$buf_lang['conmon']['today'].'此时'.$buf_lang['new']['all_money']."</b></td>
	<td width='18%'><b>".$buf_lang['conmon']['yesterday'].'此时'.$buf_lang['new']['all_money']."</b></td>
	<td width='12%'><b>".$buf_lang['conmon']['today'].'此时'.$buf_lang['left']['recharge_num']."</b></td>
	<td width='12%'><b>".$buf_lang['conmon']['yesterday'].'此时'.$buf_lang['left']['recharge_num']."</b></td>
	<td width='15%'><b>".$buf_lang['conmon']['today'].'此时'.$buf_lang['conmon']['arpu']."</b></td>
	<td width='15%'><b>".$buf_lang['conmon']['yesterday'].'此时'.$buf_lang['conmon']['arpu']."</b></td>
	</tr>";

$allResultTwoDay = array();

# 今天&昨天
$todayStartStamp = strtotime(date("Y-m-d")." 0.0.0");
#$todayEndStamp = strtotime(date("Y-m-d")." 23.59.59");
$todayEndStamp = time();

$yStartStamp = $todayStartStamp - 86400;
$yEndStamp = $todayEndStamp - 86400;


# 代理商id
# 今天充值情况
if($sPlatName == "allPlat")
{
	$sqlThisDay = "SELECT pay_time, agent_id, round(sum(pay_money)/100,2) as pay_day_money, count(distinct role_id) as role_cnt" .
		" FROM all_source_paylog_rmb " .
		" WHERE pay_time>={$todayStartStamp} and pay_time<={$todayEndStamp} " .
		" GROUP BY from_unixtime(pay_time, '%Y-%m-%d'), agent_id " .
		" ORDER BY pay_day_money desc";
}
else
{
	$sqlThisDay = "SELECT pay_time, agent_id, server_id, round(sum(pay_money)/100,2) as pay_day_money, count(distinct role_id) as role_cnt" .
		" FROM all_source_paylog_rmb " .
		" WHERE pay_time>={$todayStartStamp} and pay_time<={$todayEndStamp}  AND agent_id={$sPlatName}" .
		" GROUP BY from_unixtime(pay_time, '%Y-%m-%d'), server_id " .
		" ORDER BY pay_day_money desc";
}
$resultThisDay = $db->fetchAll($sqlThisDay);

if(!empty($resultThisDay))
{
	foreach($resultThisDay as $kThisDay => $vThisDay)
	{
		if($sPlatName == "allPlat")
		{
			//所有服务器，显示平台名
			$agentId = $vThisDay['agent_id'];
			$allResultTwoDay[$agentId]['desc'] = $AGENT_NAME[$agentId];
		}
		else
		{
			# 单平台所有服，显示区名
			$agentId = $vThisDay['server_id'];
			$allResultTwoDay[$agentId]['desc'] = "S".$vThisDay['server_id'];
		} 
		
		if($vThisDay['pay_time'] >= $yStartStamp && $vThisDay['pay_time'] <= $yEndStamp)
		{
			$allResultTwoDay[$agentId]['yAllMoney'] = floatval($vThisDay['pay_day_money']);
			$allResultTwoDay[$agentId]['yPayCnt'] = intval($vThisDay['role_cnt']);
			$allResultTwoDay[$agentId]['yArpu'] = floatval(round($vThisDay['pay_day_money']/$vThisDay['role_cnt'], 2));
		}
		else if($vThisDay['pay_time'] >= $todayStartStamp && $vThisDay['pay_time'] <= $todayEndStamp)	
		{
			$allResultTwoDay[$agentId]['tAllMoney'] = floatval($vThisDay['pay_day_money']);
			$allResultTwoDay[$agentId]['tPayCnt'] = intval($vThisDay['role_cnt']);
			$allResultTwoDay[$agentId]['tArpu'] = floatval(round($vThisDay['pay_day_money']/$vThisDay['role_cnt'], 2));			
		}
	}
}

# 代理商id
# 昨天充值情况
if($sPlatName == "allPlat")
{
	$sqlTwoDay = "SELECT pay_time, agent_id, round(sum(pay_money)/100,2) as pay_day_money, count(distinct role_id) as role_cnt" .
		" FROM all_source_paylog_rmb " .
		" WHERE pay_time>={$yStartStamp} and pay_time<={$yEndStamp} " .
		" GROUP BY from_unixtime(pay_time, '%Y-%m-%d'), agent_id " .
		" ORDER BY pay_day_money desc";
}
else
{
	$sqlTwoDay = "SELECT pay_time, agent_id, server_id, round(sum(pay_money)/100,2) as pay_day_money, count(distinct role_id) as role_cnt" .
		" FROM all_source_paylog_rmb " .
		" WHERE pay_time>={$yStartStamp} and pay_time<={$yEndStamp}  AND agent_id={$sPlatName}" .
		" GROUP BY from_unixtime(pay_time, '%Y-%m-%d'), server_id " .
		" ORDER BY pay_day_money desc";
}
$resultTwoDay = $db->fetchAll($sqlTwoDay);

if(!empty($resultTwoDay))
{
	foreach($resultTwoDay as $kTwoDay => $vTwoDay)
	{
		if($sPlatName == "allPlat")
		{
			//所有服务器，显示平台名
			$agentId = $vTwoDay['agent_id'];
			$allResultTwoDay[$agentId]['desc'] = $AGENT_NAME[$agentId];
		}
		else
		{
			# 单平台所有服，显示区名
			$agentId = $vTwoDay['server_id'];
			$allResultTwoDay[$agentId]['desc'] = "S".$vTwoDay['server_id'];
		} 
		
		if($vTwoDay['pay_time'] >= $yStartStamp && $vTwoDay['pay_time'] <= $yEndStamp)
		{
			$allResultTwoDay[$agentId]['yAllMoney'] = floatval($vTwoDay['pay_day_money']);
			$allResultTwoDay[$agentId]['yPayCnt'] = intval($vTwoDay['role_cnt']);
			$allResultTwoDay[$agentId]['yArpu'] = floatval(round($vTwoDay['pay_day_money']/$vTwoDay['role_cnt'], 2));
		}
		else if($vTwoDay['pay_time'] >= $todayStartStamp && $vTwoDay['pay_time'] <= $todayEndStamp)	
		{
			$allResultTwoDay[$agentId]['tAllMoney'] = floatval($vTwoDay['pay_day_money']);
			$allResultTwoDay[$agentId]['tPayCnt'] = intval($vTwoDay['role_cnt']);
			$allResultTwoDay[$agentId]['tArpu'] = floatval(round($vTwoDay['pay_day_money']/$vTwoDay['role_cnt'], 2));			
		}
	}
}


$flag = array(1=>'<font color="red"><b>↓</b></font>',2=>'<font color="green"><b>↑</b></font>');

//$flag['up'] = "↑";
//$flag['down'] = "↓";

if(!empty($allResultTwoDay))
{
	foreach($allResultTwoDay as $kk2 => $vv2)
	{
		$all_money_flag = (($vv2['tAllMoney'] - $vv2['yAllMoney'])>=0)? $flag[2] : $flag[1];
		$pay_cnt_flag = (($vv2['tPayCnt'] - $vv2['yPayCnt'])>=0)? $flag[2] : $flag[1];
		$arpu_flag = (($vv2['tArpu'] - $vv2['yArpu'])>=0)? $flag[2] : $flag[1];
		
		$todayHtml .= "<tr align='center' bgcolor='#ffffff'>
			<td height='25'>{$vv2['desc']}</td>
			<td>{$vv2['tAllMoney']}{$all_money_flag}</td>
			<td>{$vv2['yAllMoney']}</td>
			<td>{$vv2['tPayCnt']}{$pay_cnt_flag}</td>
			<td>{$vv2['yPayCnt']}</td>
			<td>{$vv2['tArpu']}{$arpu_flag}</td>
			<td width='15%'>{$vv2['yArpu']}</td>
			</tr>";
	}
}


$todayHtml .= "</tbody></table>";

# 昨日&上周统计&上月此时总结
$lastDay = date( "Y-m-d",(time()-86400));
$lastDayStartStamp = strtotime($lastDay.' 0.0.0');
$lastDayEndStamp = strtotime($lastDay.' 23.59.59');
$lastDayEndStamp2 = time() - 86400;

$lastWeek = date("Y-m-d", (time()-86400*7));
$lastWeekStartStmp = strtotime($lastWeek.' 0.0.0');
$lastWeekEndStmp = strtotime($lastWeek.' 23.59.59');
$lastWeekEndStmp2 = time() - 86400*7;

$now_time = time();
$lastMonthNow = last_month_today($now_time);
$lastMonthStartStamp = strtotime( date("Y-m-01", strtotime($lastMonthNow) ).' 0.0.0');
$lastMonthEndStamp = strtotime($lastMonthNow);
$lastMonthStr = date("Y-m", $lastMonthStartStamp);


# 昨天同期
$sqlLastDay = "SELECT count(distinct role_id) as role_cnt, count(role_id) as times_cnt, round(sum(pay_money)/100,2) as pay_day_money" .
		" FROM all_source_paylog_rmb " .
		" WHERE pay_time>={$lastDayStartStamp} and pay_time<={$lastDayEndStamp2} ";
# 上周同期
$sqlLastWeek = "SELECT count(distinct role_id) as role_cnt, count(role_id) as times_cnt, round(sum(pay_money)/100,2) as pay_day_money" .
		" FROM all_source_paylog_rmb " .
		" WHERE pay_time>={$lastWeekStartStmp} and pay_time<={$lastWeekEndStmp2} ";

# 上月此时总结
$sqlLastMonth = "SELECT count(distinct role_id) as role_cnt, count(role_id) as times_cnt, round(sum(pay_money)/100,2) as pay_day_money" .
		" FROM all_source_paylog_rmb " .
		" WHERE pay_time>={$lastMonthStartStamp} and pay_time<={$lastMonthEndStamp} ";

# 代理商id
if($sPlatName == "allPlat")
{
	//所有平台所有服务器！！！
}
else
{
	$sqlLastDay .= " AND agent_id={$sPlatName}";
	$sqlLastWeek .= " AND agent_id={$sPlatName}";
	$sqlLastMonth .= " AND agent_id={$sPlatName}";
}

# 服务器id
if($sServerName == "allServer")
{
	//所有服务器
}
else
{
	$sqlLastDay .= " AND server_id={$sServerName}";
	$sqlLastWeek .= " AND server_id={$sServerName}";
	$sqlLastMonth .= " AND server_id={$sServerName}";
}

$resultLastDay = $db->fetchOne($sqlLastDay);
$resultLastWeek = $db->fetchOne($sqlLastWeek);
$resultLastMonth = $db->fetchOne($sqlLastMonth);

if(empty($resultLastDay['role_cnt']))
{
	$lastDayArpu = 0;
}
else
{
	$lastDayArpu = round($resultLastDay['pay_day_money']/$resultLastDay['role_cnt'],2);
}

if(empty($resultLastWeek['role_cnt']))
{
	$lastWeekArpu = 0;
}
else
{
	$lastWeekArpu = round($resultLastWeek['pay_day_money']/$resultLastWeek['role_cnt'],2);
}

if(empty($resultLastMonth['role_cnt']))
{
	$lastMonthArpu = 0;
}
else
{
	$lastMonthArpu = round($resultLastMonth['pay_day_money']/$resultLastMonth['role_cnt'],2);
}


$yestodayHtml = "<b>&nbsp;".$buf_lang['conmon']['yesterday']."($lastDay)".$buf_lang['left']['current_recharge_num']."：{$resultLastDay['role_cnt']}，".$buf_lang['left']['recharge_times']."：{$resultLastDay['times_cnt']}，".$buf_lang['left']['recharge_total_amount']."：￥{$resultLastDay['pay_day_money']}，".$buf_lang['conmon']['arpu']."：{$lastDayArpu}
<br>&nbsp;".$buf_lang['conmon']['last_week']."($lastWeek)".$buf_lang['left']['current_recharge_num']."：{$resultLastWeek['role_cnt']}，".$buf_lang['left']['recharge_times']."：{$resultLastWeek['times_cnt']}，".$buf_lang['left']['recharge_total_amount']."：￥{$resultLastWeek['pay_day_money']}，".$buf_lang['conmon']['arpu']."：{$lastWeekArpu}" .
"<br>&nbsp;上月({$lastMonthStr})此时小结的充值人数：{$resultLastMonth['role_cnt']}，充值次数：{$resultLastMonth['times_cnt']}，充值总额(元)：￥{$resultLastMonth['pay_day_money']}，ARPU：{$lastMonthArpu}";

echo json_encode(
				 array("sSearchInfo" => $dayHtml,
					 "iSearchToday" => $todayHtml,
					 "sYestodayInfo" => $yestodayHtml,
				 )
);	

die();


# test！！！
echo json_encode(array("sYestodayInfo" => 
	"<b>&nbsp;".$buf_lang['conmon']['yesterday']."($lastDay)".$buf_lang['left']['current_recharge_num']."：111，".$buf_lang['left']['recharge_times']."：111，".$buf_lang['left']['recharge_total_amount']."：￥111，".$buf_lang['conmon']['arpu']."：111
<br>&nbsp;".$buf_lang['conmon']['last_week']."($lastWeek)".$buf_lang['left']['current_recharge_num']."：111，".$buf_lang['left']['recharge_times']."：111，".$buf_lang['left']['recharge_total_amount']."：￥111.7，arpu值：111</b>"));


//================================
/** 
 * 计算上一个月的今天，如果上个月没有今天，则返回上一个月的最后一天 
 * @param type $time 
 * @return type 
 */  
function last_month_today($time){  
    $last_month_time = mktime(date("G", $time), date("i", $time),  
                date("s", $time), date("n", $time), 0, date("Y", $time));  
    $last_month_t =  date("t", $last_month_time);  
    if ($last_month_t < date("j", $time)) {  
        return date("Y-m-t H:i:s", $last_month_time);  
    }  
    return date(date("Y-m", $last_month_time) . "-d H:i:s", $time);  
}
