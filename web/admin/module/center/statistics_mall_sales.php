<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;


$ttype = isset($_REQUEST['ttype']) ? $_REQUEST['ttype'] :1;
$money_type = isset($_REQUEST['money_type']) ? $_REQUEST['money_type'] :1;
$radio_agent = isset($_REQUEST['radio_agent']) ? $_REQUEST['radio_agent'] :0;
$radio_server = isset($_REQUEST['radio_server'] )?$_REQUEST['radio_server'] :0;


if ( !isset($_REQUEST['dStartDate'])) {
    $dStartTime = date("Y-m-d",time()-2*60*60*24);
}
else {
    $dStartTime  = trim(SS($_REQUEST['dStartDate']));
}
if ( !isset($_REQUEST['dEndDate'])) {
    $dEndTime = strftime ("%Y-%m-%d", time() );
}
else {
    $dEndTime = trim(SS($_REQUEST['dEndDate']));
}

$date_arr = getFormatDate($dStartTime,$dEndTime,$ttype);

$dStartTime = $date_arr['start'];
$dEndTime = $date_arr['end'];


foreach($ALL_SERVER_LIST as $key=>$value) {
    if($key == 0) continue;
    foreach($value as $k=>$v) {
        $serStr = "S".$k;
        if($v['stat'] == 4)//未开
        {
            continue;
        }
        else if($v['stat'] == 2)//合服
        {
            $serStr .= "(合)";
        }
        else if($v['stat'] == 3)//关服
        {
            $serStr .= "(关)";
        }
        $servers[$key][$k] = $serStr;
    }
}

switch($money_type) {
    case 1://元宝
        $money = 'unbind_gold';
        $table = "all_log_use_gold a,config_goods b";
        $money_condiction = '  and unbind_gold!=0 ';
        $mtype=3002;
        break;
    case 2://绑定元宝
        $money = 'bind_gold';
        $table = "all_log_use_gold a,config_goods b";
        $money_condiction = ' and bind_gold!=0 ';
        $mtype=3002;
        break;

/*    case 3://积分
        $money = 'points';
        $table = 'all_log_use_points  a,t_PGoods b';
        $money_condiction = '';
        $mtype=9001;
        break;*/
    default:
        echo 'Error Request';
        die();
}
switch($ttype) {
    case 1://日
        $date = ' date';
        $group_by = " date,itemid";
        $group_by_all = 'date';
        break;
    case 2://周
        $date = ' yearweek(date,7) as yearweek,year(date) as year,week(date,7) as week';
        $group_by = "yearweek,itemid";
        $group_by_all = 'yearweek';
        break;
    case 3://月
        $date = 'year(date) as year,month(date) as month';
        $group_by = "year,month,itemid";
        $group_by_all = 'year,month';
        break;
    default:echo 'Error Request';
        die();
}

if($radio_agent == 0) {
    $agent_condiction = ' ';
} else {
    $agent_condiction = " and agent_id=$radio_agent ";
    if($radio_server != 0 ) {
        $agent_condiction .= " and server_id=$radio_server ";
    }
}

$sql = "select sum($money) as money,sum(customers) as customers,sum(buy_times) as buy_times,b.id,b.name,$date
        from $table where mtype=$mtype  and a.itemid=b.id   and a.date>='$dStartTime' and a.date<='$dEndTime'
        $agent_condiction  $money_condiction  group by $group_by order by a.date,b.id";
$sql_all = "select sum($money) as total,$date from $table where mtype=$mtype  and a.itemid=b.id  and a.date>='$dStartTime'
            and a.date<='$dEndTime' $agent_condiction  group by $group_by_all";

$result = $db->fetchAll($sql);
$result_all = $db->fetchAll($sql_all);

if(!empty($result)){
switch($ttype) {
    case 1:
        $format_data = format_day_mall($result,$result_all,$date_arr['format']);
        break;
    case 2:
        $format_data = format_week_mall($result,$result_all,$date_arr['format']);
        break;
    case 3:
        $format_data = format_month_mall($result,$result_all,$date_arr['format']);
        break;
}
$output = output_data_mall($format_data,$ttype);
}
else $output = '<p align="center"><b>没有数据显示</b></p>';



$smarty->assign('output',$output);
$smarty->assign('ttype',$ttype);
$smarty->assign('money_type',$money_type);
$smarty->assign('agent_id',$radio_agent);
$smarty->assign('server_id',$radio_server);
$smarty->assign('servers',json_encode($servers));
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("dStartTime", $dStartTime);
$smarty->assign("dEndTime", $dEndTime);
$smarty->display('module/center/statistics_mall_sales.html');



function getFormatDate($start,$end,$flag=1) {
    if($flag == 2) {

        //生成某一天所在星期的星期一的日期
        $weekday = date('N',strtotime($start));
        $startday = date('Y-m-d',strtotime($start)-($weekday-1)*60*60*24);
        $rt['start'] = $startday;

        //生成某一天所在星期的星期天的日期
        $weekday= date('N',strtotime($end));
        $endday = date('Y-m-d',strtotime($end)+(7-$weekday)*60*60*24);
        $rt['end'] = $endday;

        $stamp = strtotime($startday);
        $etamp = strtotime($endday);
        for($i=0,$t=$stamp;$t<$etamp;$t += 60*60*24,$i++) {
            $rt_date[$i]['yearweek'] = date('YW',$t);
            $rt_date[$i]['week'] = date('W',$t);
            $rt_date[$i]['start'] = date('m/d',$t);
            $t += 6*24*60*60;
            $rt_date[$i]['end'] =date('m/d',$t);
        }
        $rt_date['format'] = array_reverse($rt_date);


    } else if($flag == 3) {

        //生成某一天所在月份的第一天的日期
        $date_arr= getdate(strtotime($start));
        $day = $date_arr['year'].'-'.$date_arr['mon'].'-1';
        $startday =date('Y-m-d',strtotime($day));
        $rt['start'] = $startday;
        //生成某一天所在月份的最后一天的日期
        $date_arr = getdate(strtotime($end));
        $day = $date_arr['year'].'-'.($date_arr['mon']+1).'-1';
        $endday =date('Y-m-d',strtotime($day)-1);
        $rt['end'] = $endday;

        $stamp = strtotime($startday);
        $etamp = strtotime($endday);
        for($i=0,$t=$stamp; $t<$etamp; $t += 60*60*24,$i++) {

            $rt_date[$i]['yearmonth'] = date('Y-n',$t);
            $rt_date[$i]['start'] = date('Y-m-d',$t);
            $date_arr = getdate($t);
            $rt_date[$i]['month'] = $date_arr['mon'];
            if($date_arr['mon']<12)
                $day = $date_arr['year'].'-'.($date_arr['mon']+1).'-1';
            else $day = ($date_arr['year']+1).'-1-1';
            $rt_date[$i]['end']  = date('Y-m-d',strtotime($day)-1);
            $t = strtotime($rt_date[$i]['end']);
        }
        $rt_date['format'] = array_reverse($rt_date);
    } else {

        $rt['start'] = $start;
        $rt['end'] = $end;

        $strtime1 = strtotime($end)+60*60*24;
        $strtime2 = strtotime($start);
        for($t=$strtime1-1,$i=0; $t>=$strtime2; ) {
            $rt_date['format'][$i]['date'] = date('Y-m-d',$t);
            $rt_date['format'][$i]['weekday'] = date('l',$t);
            $t -= 60*60*24;
            $i++;
        }
    }
    $rt_date['start'] = $rt['start'];
    $rt_date['end'] = $rt['end'];
return $rt_date;
}


function format_day_mall($data,$total,$date_arr) {
    foreach ($total as $value) {
        $date = $value['date'];
        $data_total[$date] = $value['total'];
    }

    foreach($data as $value) {
        $date = $value['date'];
        $customers = $value['customers'];
        $buy_times = $value['buy_times'];
        $money = $value['money'];
        $id = $value['id'];
        $d_total = $data_total[$date];
        
        $format['name'] = $value['name'];
        $format['customers']['value'] = $customers;
        $format['customers']['flag'] = 0;
        $format['buy_times']['value'] = $buy_times;
        $format['buy_times']['flag'] = 0;
        $format['money']['value'] = $money;
        $format['money']['flag'] = 0;
        $format['percent']['value'] = round($money/$d_total*100,2);
        $format['percent']['flag'] = 0;
        $temp_data[$date][$id] =$format;
    }
    $temp_data = multi_array_sort($temp_data);
    foreach($date_arr as $key=>$value){
        $return_data[$key]['date'] = $value['date'];
        $return_data[$key]['weekday'] = $value['weekday'];
        $return_data[$key]['data'] = $temp_data[$value['date']]?$temp_data[$value['date']]:0;
    }
    foreach($return_data as $key=>$value){
        $next = isset($return_data[$key+1])?$return_data[$key+1]['data']:0;
        if($value['data']!=0){
            if($next!=0){
                foreach($value['data'] as $k=>&$v){
                   
                    foreach($v as $i=>&$t){
                      if($i=='name') continue;
                        $t['flag'] = $t['value']-$next[$k][$i]['value'];
                        $return_data[$key]['data'][$k][$i]['flag'] = $t['flag'];
                    }
                }
            }
        }
    }
    return $return_data;
}

function format_week_mall($data,$total,$date_arr) {
    foreach ($total as $value) {
        $yearweek = $value['yearweek'];
        $data_total[$yearweek] = $value['total'];
    }

    foreach($data as $value) {
        $yearweek = $value['yearweek'];
        $customers = $value['customers'];
        $buy_times = $value['buy_times'];
        $money = $value['money'];
        $id = $value['id'];
        $d_total = $data_total[$yearweek];

        $format['name'] = $value['name'];
        $format['customers']['value'] = $customers;
        $format['customers']['flag'] = 0;
        $format['buy_times']['value'] = $buy_times;
        $format['buy_times']['flag'] = 0;
        $format['money']['value'] = $money;
        $format['money']['flag'] = 0;
        $format['percent']['value'] = round($money/$d_total*100,2);
        $format['percent']['flag'] = 0;
        $temp_data[$yearweek][$id] =$format;
    }
    $temp_data = multi_array_sort($temp_data);
    foreach($date_arr as $key=>$value){
        $return_data[$key]['yearweek'] = $value['yearweek'];
        $return_data[$key]['week'] = $value['week'];
        $return_data[$key]['start'] = $value['start'];
        $return_data[$key]['end'] = $value['end'];
        $return_data[$key]['data'] = $temp_data[$value['yearweek']]?$temp_data[$value['yearweek']]:0;
    }
    foreach($return_data as $key=>$value){
        $next = isset($return_data[$key+1])?$return_data[$key+1]['data']:0;
        if($value['data']!=0){
            if($next!=0){
                foreach($value['data'] as $k=>&$v){
                    foreach($v as $i=>&$t){
                        if($i=='name') continue;
                        $t['flag'] = $t['value']-$next[$k][$i]['value'];
                        $return_data[$key]['data'][$k][$i]['flag'] = $t['flag'];
                    }
                }
            }
        }
    }
    return $return_data;
}



function format_month_mall($data, $total,$date_arr) {
    foreach ($total as $value) {
        $yearmonth = $value['year'].'-'.$value['month'];
        $data_total[$yearmonth] = $value['total'];
    }

    foreach($data as $value) {
        $yearmonth = $value['year'].'-'.$value['month'];
        $customers = $value['customers'];
        $buy_times = $value['buy_times'];
        $money = $value['money'];
         $id = $value['id'];
        $d_total = $data_total[$yearmonth];
        
        $format['name'] = $value['name'];
        $format['customers']['value'] = $customers;
        $format['customers']['flag'] = 0;
        $format['buy_times']['value'] = $buy_times;
        $format['buy_times']['flag'] = 0;
        $format['money']['value'] = $money;
        $format['money']['flag'] = 0;
        $format['percent']['value'] = round($money/$d_total*100,2);
        $format['percent']['flag'] = 0;
        $temp_data[$yearmonth][$id] =$format;
    }
    $temp_data = multi_array_sort($temp_data);
     foreach($date_arr as $key=>$value){
        $return_data[$key]['yearmonth'] = $value['yearmonth'];
        $return_data[$key]['start'] = $value['start'];
        $return_data[$key]['end'] = $value['end'];
        $return_data[$key]['month'] = $value['month'];
        $return_data[$key]['data'] = $temp_data[$value['yearmonth']]?$temp_data[$value['yearmonth']]:0;
    }
    foreach($return_data as $key=>$value){
        $next = isset($return_data[$key+1])?$return_data[$key+1]['data']:0;
        if($value['data']!=0){
            if($next!=0){
                foreach($value['data'] as $k=>&$v){
                    foreach($v as $i=>&$t){
                        if($i=='name') continue;
                        $t['flag'] = $t['value']-$next[$k][$i]['value'];
                        $return_data[$key]['data'][$k][$i]['flag'] = $t['flag'];
                    }
                }
            }
        }
    }
    return $return_data;
}



function output_data_mall($data,$type) {
    if(empty($data)) return FALSE;
    $html = '';
//print_r($data);
    $flag = array(1=>'<font color="red"><b>↓</b></font>',2=>'<font color="green"><b>↑</b></font>');

    $table = '<td width="315" valign="top" ><table cellspacing="1" cellpadding="0" border="1" bgcolor="#bbe5e5" width="315" valign="top">';
    $thead = '<tr align="center"><td><b>消费项目</b></td><td><b>消费人数</b></td><td><b>消费次数</b></td><td><b>消费货币</b></td><td><b>消费比例</b></td></tr>';
    foreach($data as $value) {
        switch ($type) {
            case 1:
                $info = $value['date'].'  '.$value['weekday'] .'  消费项目统计';
                break;
            case 2:
                $info = $value['start'].'-'.$value['end'].'(第'.$value['week'].'周)  消费项目统计';
                break;
            case 3:
                $info = $value['yearmonth'].'  消费项目统计';
                break;
            default:
                break;
        }

        $head = "<tr align='center'><td colspan='5'><b>$info</b></td></tr>";
        if($value['data']!=0) {
            foreach($value['data'] as $k=>$v) {
                $tr = "<tr align='center'><td>{$v['name']}</td>";
                foreach($v as  $t=>$i) {
                    if($t=='name') continue;
                    $tr .= '<td>'.$i['value'];
                    if($i['flag']>0)
                        $tr .= $flag[2];
                    else if($i['flag']<0)
                        $tr .= $flag[1];
                    $tr .= '</td>';
                }
                $tr .= '</tr>';
                $tbody .=$tr;
            }
        $html .=$table.$head.$thead.$tbody.'</table></td>';
        $tbody='';
        }
    }
    return $html;
}
function multi_array_sort($multi_array,$sort=SORT_DESC){
	if(is_array($multi_array)){
		foreach ($multi_array as $id =>$first_array){
			if(is_array($first_array)){
				$key_array = array();
				foreach ($first_array as $row_array){
				 if(is_array($row_array)){
						$key_array[] = $row_array['money']['value'];
				 }
				}
				array_multisort($key_array,$sort,$first_array);
				$new_array[$id]=$first_array;
			}else{
				return false;
			}
		}
	}else{
		return false;
	}
	return $new_array;
} 