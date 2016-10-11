<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;
$ctype_desc = array(
//副本
 14=>'避祸师门1',
 15=>'避祸师门2',
 16=>'避祸师门3',
 17=>'避祸师门4',
 18=>'领袖气概1',
 19=>'领袖气概2',
 20=>'交锋宇文',
 21=>'一灯大师',
 22=>'玄慈方丈',
 24=>'虚竹和尚',
 25=>'无名老僧',
// 0 => '英雄出世2',
//1
//2   数据库里面有但是配置文件没有对应的name

);


$act_type_option = array(
	'0' => $buf_lang['new']['select'],
	'1' => $buf_lang['left']['arena'],
);

if ( isset($_REQUEST['dStartDate'])){
	$date_start = $_REQUEST['dStartDate'];
	$dateStart = strtotime($date_start);
}
else
{
	$date_start= strftime ("%Y-%m-%d", time()-(60*60*24)*2 );
	$dateStart = strtotime($date_start);
}

if ( isset($_REQUEST['dEndDate']))
{   
    $date_end = $_REQUEST['dEndDate'];
	$dateEnd = strtotime($date_end)+60*60*24-1;
}
else
{
	$date_end= strftime ("%Y-%m-%d",time());
	$dateEnd = strtotime($date_end)+60*60*24-1;
}


$act_type = isset($_REQUEST['act_type']) ? $_REQUEST['act_type'] : 0;
if (isset($act_type))
{
	if($act_type == '0') 
	{
		$match_sql = "SELECT * " .
				     " FROM `t_log_drama` " .
				     " WHERE  time>='{$dateStart}' AND time<='{$dateEnd}' " .
				     " ORDER BY id desc";
		$match_data = GFetchRowSet($match_sql);
	}
	else
	{
		$match_sql = "SELECT * " .
				     " FROM `t_log_drama` " .
				     " WHERE drama_id='{$act_type}' AND time>='{$dateStart}' AND time<='{$dateEnd}' " .
				     " ORDER BY time desc";
		$match_data = GFetchRowSet($match_sql);
	}
}
//exit($dateStart.'--'.$dateEnd);
//exit(print_r($match_data));

$ttype = isset($_REQUEST['ttype']) ? $_REQUEST['ttype'] :1;
$date_arr = array();
$date_arr = getFormatDate($date_start,$date_end,$ttype);
//if($ttype == 1){exit(print_r($date_arr['format']));};


if(isset($match_data))
{
	if(isset($date_arr['format']))
	{
	    foreach($date_arr['format'] as $k => $v)
		{
			$data_per[$k] = array();
			$v['start'] = isset($v['start']) ? strtotime($v['start']) : '';
			$v['end'] = isset($v['end']) ? strtotime($v['end']) : '';
			$v['date'] = isset($v['date']) ? strtotime($v['date']) : '';
			
			if($v['date'] != '')
			{
				$start1 = $v['date'];
				$end1 = $v['date']+60*60*24-1;
			}
			else
			{
				$start1 = $v['start'];
				$end1 = $v['end'];
			}
			
			foreach($match_data as $data)
			{
				//echo strftime ("%Y-%m-%d %H:%M ",$start1).'-'.strftime ("%Y-%m-%d %H:%M",$end1).'-'.strftime ("%Y-%m-%d %H:%M",$data['time']).'<br>';
				if($data['time'] >= $start1 &&  $data['time'] <= $end1 )
				{
					$data_per[$k][] = $data;
				}
			}
		}
	}
}
//if($ttype == 1 ){exit(print_r($data_per));}
/*$log_all = array();
foreach($data_per as $k => $v)
{
	if(is_array($v) && !empty($v))
	{
		foreach($v as $v1)
		{
			if(isset($v1['r_id']) && $v1['r_id'] == 888888)
			{
				$log_all[$k]['all_players'] +=  $v1['players'];
				$log_all[$k]['all_do_times'] +=  $v1['do_times'];
			}
		}
	}     
}*/
//if($ttype == 2 ){exit(print_r($log_all));}

$data10 = array();
$rid_arr = array();
foreach($data_per as $k => $v)
{
	if(is_array($v) && !empty($v))
	{
		foreach($v as $v1)
		{
			if($ttype != 1)
			{
				if(!isset($rid_arr[$k][$v1['drama_id']]))
				{
					$rid_arr[$k][$v1['drama_id']] = $v1;
				}
				else
				{
					$rid_arr[$k][$v1['drama_id']]['time'] = $v1['time'];
					$rid_arr[$k][$v1['drama_id']]['drama_id'] = $v1['drama_id'];
					$rid_arr[$k][$v1['drama_id']]['start_cnt'] = $rid_arr[$k][$v1['r_id']]['start_cnt'] + $v1['start_cnt'];
					$rid_arr[$k][$v1['drama_id']]['finish_cnt'] = $rid_arr[$k][$v1['r_id']]['finish_cnt'] + $v1['finish_cnt'];
					$rid_arr[$k][$v1['drama_id']]['skip_cnt'] = $rid_arr[$k][$v1['r_id']]['skip_cnt'] + $v1['skip_cnt'];
				}
			}
			else
			{
				$rid_arr[$k][$v1['drama_id']]['time'] = $v1['time'];
				$rid_arr[$k][$v1['drama_id']]['drama_id'] = $v1['drama_id'];
				$rid_arr[$k][$v1['drama_id']]['start_cnt'] = $v1['start_cnt'];
				$rid_arr[$k][$v1['drama_id']]['finish_cnt'] = $v1['finish_cnt'];
				$rid_arr[$k][$v1['drama_id']]['skip_cnt'] = $v1['skip_cnt'];
			}
		}
		$v = array();
		$v = $rid_arr[$k];
	}
	$data10[] = $v;
	
}
//if($ttype == 1 ){exit(print_r($data10));}

$output = output_data($data10,$u_date_start,$ctype_desc,$ttype,$date_arr);
$smarty->assign("ctype_desc", $ctype_desc);
$smarty->assign("output", $output);
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("search_keyword1", $date_start);
$smarty->assign("search_keyword2", $date_end);
$smarty->assign("act_type_option", $act_type_option);
$smarty->assign("act_type", $act_type);

$smarty->display("module/analysis/drama_type_log.html");
function output_data($data,$u_date_start,$ctype_desc,$t_type,$date) {
    if(empty($data)) return FALSE;
    $html = '';
    $flag = array(1=>'<font color="red"><b>↓</b></font>',2=>'<font color="green"><b>↑</b></font>');
    $table = '<td width="310" valign="top" ><table cellspacing="1" cellpadding="0" border="1" bgcolor="#bbe5e5" width="310" valign="top">';
    $thead = '<tr align="center"><td width="50"><b>剧情类型</b></td><td width="30"><b>开始个数</b></td><td width="30"><b>完成个数</b></td><td width="30"><b>跳过个数</b></td></tr>';
    for($i = 0; $i < count($data);$i++) {
	if($t_type == 1)
	{	
    	$info = $date['format'][$i]['date'].'  剧情类型统计';
	}
	elseif($t_type == 2)
	{
		$info = '第'.$date['format'][$i]['yearweek'].'周'.$date['format'][$i]['start'].'~'.$date['format'][$i]['end'].'剧情类型统计';
	}
	else
	{
		$info = '第'.$date['format'][$i]['yearmonth'].'月'.$date['format'][$i]['start'].'~'.$date['format'][$i]['end'].'剧情类型统计';
	}
    $head = "<tr align='center'><td colspan='5'><b>$info</b></td></tr>";
	
    $tr = '';

	foreach($data[$i] as $k1=>$v1) {
//start_cnt  finish_cnt  skip_cnt
			$before_start_cnt = 0;
			$before_finish_cnt = 0;	
			$before_skip_cnt = 0;	
			if($i >= 0 && $i < count($data) && isset($data[$i+1]))
			{
			   foreach($data[$i+1] as $before)
				{
					if($before['drama_id'] == $v1['drama_id'])
					{
							$before_start_cnt = $before['start_cnt'];
							$before_finish_cnt = $before['finish_cnt'];
							$before_skip_cnt = $before['skip_cnt'];
					}

				}
				$is_start_cnt = (($v1['start_cnt'] - $before_start_cnt)>=0)? $flag[2] : $flag[1];
				$is_finish_cnt = (($v1['finish_cnt'] - $before_finish_cnt)>=0)? $flag[2] : $flag[1];
				$is_skip_cnt = (($v1['skip_cnt'] - $before_skip_cnt)>=0)? $flag[2] : $flag[1];
				$tr .= '<tr><td>'.$ctype_desc[$v1['drama_id']].'</td><td>'.$v1['start_cnt'].$is_start_cnt.'</td><td>'.$v1['finish_cnt'].$is_finish_cnt.'</td><td>'.$v1['skip_cnt'].$is_skip_cnt.'</td></tr>';
			}
			else
			{
				$tr .= '<tr><td>'.$ctype_desc[$v1['drama_id']].'</td><td>'.$v1['start_cnt'].'</td><td>'.$v1['finish_cnt'].'</td><td>'.$v1['skip_cnt'].'</td></tr>';
			}
	}
	$tbody .=$tr;
	$html .=$table.$head.$thead.$tbody.'</table></td>';
	$tbody='';
    }
    return $html;
}

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
            $rt_date[$i]['yearweek'] = date('Y-W',$t);
            $rt_date[$i]['week'] = date('W',$t);
            $rt_date[$i]['start'] = date('Y-m-d',$t);
            $t += 6*24*60*60;
            $rt_date[$i]['end'] =date('Y-m-d',$t);
        }
        $rt_date['format'] = array_reverse($rt_date);
        

    } else if($flag == 3) {

        //生成某一天所在月份的第一天的日期
        $date_arr= getdate(strtotime($start));
        $day = $date_arr['year'].'-'.$date_arr['mon'].'-1';
        $startday =date('Y-m-d',strtotime($day));
        $rt['start'] = $startday;
        print_r($data_arr);
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
    $rt_date['start'] = $rt['start']; 			//str_replace('-','',$rt['start']);
    $rt_date['end'] = $rt['end'];				//str_replace('-','',$rt['end']);
return $rt_date;
}