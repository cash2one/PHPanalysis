<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;
$sum_common = array(
    '1' => '精炼',
	'2' => '装备打孔',
	'3' => '宝石镶嵌',
	'4' =>	'灵石合成',
	'5'	=>	'装备刻印',
	'6'	=>	'装备升级',
	'7' =>	'正常拆卸宝石',
	1043=>' 装备洗练',
	1046=>' 装备回炉',
);


$act_type_option = array(
	'0' => $buf_lang['new']['select'],
	'1' => $buf_lang['left']['arena'],
);



if ( isset($_REQUEST['dStartDate'])){
	$date_start1 = explode("-",$_REQUEST['dStartDate']);
    $date_start1[1] = (strlen($date_start1[1]) >= 2) ?  $date_start1[1] : '0'.$date_start1[1];
    $date_start1[2] = (strlen($date_start1[2]) >= 2) ?  $date_start1[2] : '0'.$date_start1[2];
	$date_start_temp = $date_start1[0].'-'.$date_start1[1].'-'.$date_start1[2];
	$dateStart = $date_start1[0].$date_start1[1].$date_start1[2];
}
else
{
	$date_start_temp = strftime ("%Y-%m-%d", time()-(60*60*24)*3 );
	$dateStart = str_replace('-','',$date_start_temp);
}

if ( isset($_REQUEST['dEndDate']))
{   
    $date_end1 = explode("-",$_REQUEST['dEndDate']);
    $date_end1[1] = (strlen($date_end1[1]) >= 2) ?  $date_end1[1] : '0'.$date_end1[1];
    $date_end1[2] = (strlen($date_end1[2]) >= 2) ?  $date_end1[2] : '0'.$date_end1[2];
	$date_end_temp = $date_end1[0].'-'.$date_end1[1].'-'.$date_end1[2];
	$dateEnd = $date_end1[0].$date_end1[1].$date_end1[2];
}
else
{
	$date_end_temp= strftime ("%Y-%m-%d",time()-(60*60*24));
	$dateEnd = str_replace('-','',$date_end_temp);
}
$u_date_start = strtotime($date_start_temp);
$u_end_start = strtotime($date_end_temp);

$act_type = isset($_REQUEST['act_type']) ? $_REQUEST['act_type'] : 0;
if (isset($act_type))
{
	if($act_type == '0') 
	{
		$match_sql = "SELECT * " .
				     " FROM `t_sum_enhance` " .
				     " WHERE  mtime>='{$dateStart}' AND mtime<='{$dateEnd}' " .
				     " ORDER BY mtime desc";
		$match_data = GFetchRowSet($match_sql);
	}
	else
	{
		$match_sql = "SELECT * " .
				     " FROM `t_sum_enhance` " .
				     " WHERE do_type='{$act_type}' AND mtime>='{$dateStart}' AND mtime<='{$dateEnd}' " .
				     " ORDER BY mtime desc";
		$match_data = GFetchRowSet($match_sql);
	}
}
//exit($dateStart.'--'.$dateEnd);
//exit(print_r($match_data));
$ttype = isset($_REQUEST['ttype']) ? $_REQUEST['ttype'] :1;
$date_arr = array();
$date_arr = getFormatDate($date_start_temp,$date_end_temp,$ttype);

//if($ttype == 2){exit(print_r($date_arr));}


if(isset($match_data))
{
	if(isset($date_arr['format']))
	{
	    foreach($date_arr['format'] as $k => $v)
		{
			$data_per[$k] = array();
			$v['start'] = isset($v['start']) ? str_replace('-','',$v['start']) : '';
			$v['end'] = isset($v['end']) ? str_replace('-','',$v['end']) : '';
			$v['date'] = isset($v['date']) ? str_replace('-','',$v['date']) : '';
			
			if($v['date'] != '')
			{
				$start1 = $v['date'];
				$end1 = $v['date'];
			}
			else
			{
				$start1 = $v['start'];
				$end1 = $v['end'];
			}
			foreach($match_data as $data)
			{
				if($data['mtime'] >= $start1 &&  $data['mtime'] <= $end1 )
				{
					$data_per[$k][] = $data;
				}
			}
		}
	}
	
}
//if($ttype == 1){exit(print_r($data_per));}
$data10 = array();
$rid_arr = array();
foreach($data_per as $v)
{
	if(is_array($v) && !empty($v))
	{
		foreach($v as $v1)
		{
			if($ttype != 1)
			{
				if(!isset($rid_arr[$v1['do_type']]))
				{
					$rid_arr[$v1['do_type']] = $v1;
				}
				else
				{
					$rid_arr[$v1['do_type']]['mtime'] = $v1['mtime'];
					$rid_arr[$v1['do_type']]['do_type'] = $v1['do_type'];
					$rid_arr[$v1['do_type']]['players'] = $rid_arr[$v1['do_type']]['players'] + $v1['players'];
					$rid_arr[$v1['do_type']]['do_times'] = $rid_arr[$v1['do_type']]['do_times'] + $v1['do_times'];
					$rid_arr[$v1['do_type']]['succ_n'] = $rid_arr[$v1['do_type']]['succ_n'] + $v1['succ_n'];
				}
			}
			else
			{
				$rid_arr = $v;
			}
			//if($ttype == 2){print_r($rid_arr[$v1['do_type']]);echo "<br>";}
		}
		$v = NULL;
		$v = $rid_arr;
	}
	$data10[] = $v;
	
}

//if($ttype == 1){exit(print_r($data10));}
$output = output_data($data10,$u_date_start,$sum_common,$ttype,$date_arr);
$smarty->assign("ctype_desc", $sum_common);
$smarty->assign("output", $output);
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("search_keyword1", $date_start_temp);
$smarty->assign("search_keyword2", $date_end_temp);
$smarty->assign("act_type_option", $act_type_option);
$smarty->assign("act_type", $act_type);
$smarty->display("module/analysis/sum_enhance_log.html");




function output_data($data,$u_date_start,$ctype_desc,$t_type,$date)  {
    if(empty($data)) return FALSE;
    $html = '';
    $flag = array(1=>'<font color="red"><b>↓</b></font>',2=>'<font color="green"><b>↑</b></font>');
    $table = '<td width="310" valign="top" ><table cellspacing="1" cellpadding="0" border="1" bgcolor="#bbe5e5" width="310" valign="top">';
    $thead = '<tr align="center"><td><b>强化类型</b></td><td><b>参加人数</b></td><td><b>参加次数</b></td><td><b>成功次数</b></td></tr>';

   
	//exit(print_r($data[-1]));
    for($i = 0; $i < count($data);$i++) {
	if($t_type == 1)
	{	
    	$info = $date['format'][$i]['date'].'  强化类型统计';
	}
	elseif($t_type == 2)
	{
		$info = '第'.$date['format'][$i]['yearweek'].'周'.$date['format'][$i]['start'].'~'.$date['format'][$i]['end'].'强化类型统计';
	}
	else
	{
		$info = '第'.$date['format'][$i]['yearmonth'].'月'.$date['format'][$i]['start'].'~'.$date['format'][$i]['end'].'强化类型统计';
	}			
    $head = "<tr align='center'><td colspan='5'><b>$info</b></td></tr>";
	
    $tr = '';

	foreach($data[$i] as $k1=>$v1) {
	  		$before_suc = 0;	
			$before_players = 0;
			$before_do_times = 0;			
			if($i >= 0 && $i < count($data) && isset($data[$i+1]))
			{
			   foreach($data[$i+1] as $before)
				{
					if($before['do_type'] == $v1['do_type'])
					{
							$before_players = $before['players'];
							$before_do_times = $before['do_times'];
							$before_suc = $before['succ_n'];
					}
				}
				//echo $v1['r_id'].'--'.$v1['players'].'-'.$v1['do_times'].'-+++'.$before_id.'-'.$before_players.'---'.$before_do_times.'<br>';		
				$is_players = (($v1['players'] - $before_players)>=0)? $flag[2] : $flag[1];
				$is_do_times = (($v1['do_times'] - $before_do_times)>=0)? $flag[2] : $flag[1];
				$is_suc = (($v1['succ_n'] - $before_suc)>=0)? $flag[2] : $flag[1];
				$tr .= '<tr><td>'.$ctype_desc[$v1['do_type']].'</td><td>'.$v1['players'].$is_players.'</td><td>'.$v1['do_times'].$is_do_times.'</td><td>'.$v1['succ_n'].$is_suc.'</td></tr>';
			}
			else
			{
				$tr .= '<tr><td>'.$ctype_desc[$v1['do_type']].'</td><td>'.$v1['players'].'</td><td>'.$v1['do_times'].'</td><td>'.$v1['succ_n'].'</td></tr>';
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
