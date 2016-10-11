<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;
$ctype_desc = array(
//副本
 2=>'英雄殿',
 4=>'机关洞',
 6=>'东溟派',
 7=>'水下地宫',
 8=>'铁骑会',
 9=>'深渊地穴',
 100=>'命运之间',
 152=>'宠物岛',
 999=>'皇陵秘境',
 9998=>'轮回殿',
 9999=>'净念禅院',

//活动
 107=>'演武' ,
 102=>'征战' ,
 109=>'运镖' ,
 2005=>'沉船寻宝' ,
 2006=>'英雄帖' ,
 11916=>'无双战场' ,
 11023=>'守关' ,
 106=>'答题' ,
 5=>'龙泉山庄',
 111=>'帮会副本' ,
 12001=>'魔幻迷宫', 
 11=>'灵虚幻境' ,
 151=>'突厥攻城' ,
 108=>'坐骑竞技' ,
 104=>'竞技场' ,
 11917=>'奴隶抓捕' ,
 12=>'阵营战' ,
 110251=>'长安争夺战',
 110252=>'荥阳争夺战',
 110253=>'洛阳争夺战',
 150=>'镜像挑战',  //(没实际用到)
 15001=>'单人镜像-简单',
 15002=>'单人镜像-普通',
 15003=>'单人镜像-困难',
 15011=>'组队镜像-简单',
 15012=>'组队镜像-普通',
 15013=>'组队镜像-困难',
 
 20201=>'接普通刺探', 
 20202=>'完成普通刺探', 
 20203=>'接国探', 
 20204=>'完成国探', 
 888888=>'登陆', 
);

$note_arr = array(
//副本
 2=>'35级',
 4=>'60级',
 6=>'25级',
 7=>'47级',
 8=>'45级',
 9=>'35级',
 100=>'40级',
 152=>'41级',
 999=>'75级',
 9998=>'65级',
 9999=>'50级',

//活动
 107=>'28级' ,
 102=>'29级' ,
 109=>'30级' ,
 2005=>'30级' ,
 2006=>'30级' ,
 11916=>'无双战场' ,
 11023=>'31级' ,
 106=>'38级' ,
 5=>'32级',
 111=>'30级' ,
 12001=>'35级', 
 11=>'35级' ,
 151=>'40级' ,
 108=>'21级' ,
 104=>'30级' ,
 11917=>'奴隶抓捕' ,
 12=>'30级' ,
 110251=>'35级',
 110252=>'35级',
 110253=>'35级',
 150=>'50级',  //(没实际用到)
 15001=>'50级',
 15002=>'50级',
 15003=>'50级',
 15011=>'50级',
 15012=>'50级',
 15013=>'50级',
 
 20201=>'31级', 
 20202=>'31级', 
 20203=>'31级', 
 20204=>'31级', 
 888888=>'1级', 
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
	$date_start_temp = strftime ("%Y-%m-%d", time()-(60*60*24)*2 );
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
	$date_end_temp= strftime ("%Y-%m-%d",time());
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
				     " FROM `t_log_routine` " .
				     " WHERE  mtime>='{$dateStart}' AND mtime<='{$dateEnd}' " .
				     " ORDER BY mtime desc";
		$match_data = GFetchRowSet($match_sql);
	}
	else
	{
		$match_sql = "SELECT * " .
				     " FROM `t_log_routine` " .
				     " WHERE r_id='{$act_type}' AND mtime>='{$dateStart}' AND mtime<='{$dateEnd}' " .
				     " ORDER BY mtime desc";
		$match_data = GFetchRowSet($match_sql);
	}
}
//exit($dateStart.'--'.$dateEnd);
//exit(print_r($match_data));

$ttype = isset($_REQUEST['ttype']) ? $_REQUEST['ttype'] :1;
$date_arr = array();
$date_arr = getFormatDate($date_start_temp,$date_end_temp,$ttype);

//if($ttype == 3){exit(print_r($date_arr));};
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
//if($ttype == 2 ){exit(print_r($data_per));}
$log_all = array();
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
}
//if($ttype == 2 ){exit(print_r($log_all));}

$data10 = array();
$rid_arr = array();
foreach($data_per as $k => $v)
{
	if(is_array($v) && !empty($v))
	{
		$all_players = (isset($log_all[$k]) && !empty($log_all[$k])) ? $log_all[$k]['all_players'] : 0;
		foreach($v as $v1)
		{
			if($ttype != 1)
			{
				//echo $k.":".$all_players."--".$v1['players']."--".$v1['players'] / $all_players."<br>";
				if(!isset($rid_arr[$k][$v1['r_id']]))
				{
					if($all_players != 0)
					{
						$v1['all_players'] = $all_players;
						$v1['players_rate'] = number_format($v1['players'] / $all_players , 2);
						$v1['do_times_rate'] = number_format( $v1['do_times'] / $all_players ,2);
					}
					else
					{
						$v1['all_players'] = 0;
						$v1['players_rate'] = 0;
						$v1['do_times_rate'] = 0;
					}
					
					$rid_arr[$k][$v1['r_id']] = $v1;
				}
				else
				{
					if($all_players != 0)
					{
						$rid_arr[$k][$v1['r_id']]['all_players'] = $all_players;
						$rid_arr[$k][$v1['r_id']]['players_rate'] +=  number_format($v1['players'] / $all_players , 2);
						$rid_arr[$k][$v1['r_id']]['do_times_rate'] +=  number_format($v1['do_times'] / $all_players , 2);
					}
					else{
						$rid_arr[$k][$v1['r_id']]['all_players'] = 0;
						$rid_arr[$k][$v1['r_id']]['players_rate'] =0;
						$rid_arr[$k][$v1['r_id']]['do_times_rate'] = 0;
					}
					$rid_arr[$k][$v1['r_id']]['mtime'] = $v1['mtime'];
					$rid_arr[$k][$v1['r_id']]['r_id'] = $v1['r_id'];
					$rid_arr[$k][$v1['r_id']]['players'] = $rid_arr[$k][$v1['r_id']]['players'] + $v1['players'];
					$rid_arr[$k][$v1['r_id']]['do_times'] = $rid_arr[$k][$v1['r_id']]['do_times'] + $v1['do_times'];
				}
			}
			else
			{
				$rid_arr[$k][$v1['r_id']]['mtime'] = $v1['mtime'];
				$rid_arr[$k][$v1['r_id']]['r_id'] = $v1['r_id'];
				$rid_arr[$k][$v1['r_id']]['players'] = $v1['players'];
				$rid_arr[$k][$v1['r_id']]['do_times'] = $v1['do_times'];
				$rid_arr[$k][$v1['r_id']]['all_players'] = $all_players;
				
				if($all_players != 0)
				{
					$rid_arr[$k][$v1['r_id']]['players_rate'] = number_format($v1['players'] / $all_players ,2);   ///number_format("1000000",2);
					$rid_arr[$k][$v1['r_id']]['do_times_rate'] =  number_format($v1['do_times'] / $all_players ,2);
					
				}
				else
				{
					$rid_arr[$k][$v1['r_id']]['players_rate'] = 0;
					$rid_arr[$k][$v1['r_id']]['do_times_rate'] = 0;
				}
			}
		}
		$v = array();
		$v = $rid_arr[$k];
	}
	$data10[] = $v;
	
}

foreach ($data10 as $k => $v) {
	ksort($v);
	$hhh[$k] = $v;
}

//if($ttype == 2 ){exit(print_r($hhh));}

//$data_final =ksort($data10);//ksort($data10);

//if($ttype == 2 ){exit(print_r($data_final));}



$output = output_data($hhh,$u_date_start,$ctype_desc,$ttype,$date_arr,$note_arr);
$smarty->assign("ctype_desc", $ctype_desc);
$smarty->assign("output", $output);
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("search_keyword1", $date_start_temp);
$smarty->assign("search_keyword2", $date_end_temp);
$smarty->assign("act_type_option", $act_type_option);
$smarty->assign("act_type", $act_type);

$smarty->display("module/analysis/activity_type_log.html");
function output_data($data,$u_date_start,$ctype_desc,$t_type,$date,$note_arr) {
    if(empty($data)) return FALSE;
    $html = '';
    $flag = array(1=>'<font color="red"><b>↓</b></font>',2=>'<font color="green"><b>↑</b></font>');
    $table = '<td width="310" valign="top" ><table cellspacing="1" cellpadding="0" border="1" bgcolor="#bbe5e5" width="310" valign="top">';
    $thead = '<tr align="center"><td width="50"><b>活动类型</b></td><td width="30"><b>人数</b></td><td width="30"><b>参加率</b></td><td width="30"><b>次数</b></td><td width="30"><b>操作率</b></td><td width="30"><b>说明</b></td></tr>';
    for($i = 0; $i < count($data);$i++) {
	if($t_type == 1)
	{	
    	$info = $date['format'][$i]['date'].'  活动类型统计';
	}
	elseif($t_type == 2)
	{
		$info = '第'.$date['format'][$i]['yearweek'].'周'.$date['format'][$i]['start'].'~'.$date['format'][$i]['end'].'活动类型统计';
	}
	else
	{
		$info = '第'.$date['format'][$i]['yearmonth'].'月'.$date['format'][$i]['start'].'~'.$date['format'][$i]['end'].'活动类型统计';
	}
    $head = "<tr align='center'><td colspan='6'><b>$info</b></td></tr>";
	
    $tr = '';

	foreach($data[$i] as $k1=>$v1) {

			$before_players = 0;
			$before_do_times = 0;	
			if($i >= 0 && $i < count($data) && isset($data[$i+1]))
			{
			   foreach($data[$i+1] as $before)
				{
					if($before['r_id'] == $v1['r_id'])
					{
							$before_players = $before['players'];
							$before_do_times = $before['do_times'];
					}

				}
				$is_players = (($v1['players'] - $before_players)>=0)? $flag[2] : $flag[1];
				$is_do_times = (($v1['do_times'] - $before_do_times)>=0)? $flag[2] : $flag[1];
				$tr .= '<tr><td>'.$ctype_desc[$v1['r_id']].'</td><td>'.$v1['players'].$is_players.'</td><td>'.$v1['players_rate']*100 .'%'.$is_players.'</td><td>'.$v1['do_times'].$is_do_times.'</td><td>'.$v1['do_times_rate']*100 .'%'.$is_do_times.'</td><td>'.$note_arr[$v1['r_id']].'</td></tr>';
			}
			else
			{
				$tr .= '<tr><td>'.$ctype_desc[$v1['r_id']].'</td><td>'.$v1['players'].'</td><td>'.$v1['players_rate']*100 .'%</td><td>'.$v1['do_times'].'</td><td>'.$v1['do_times_rate']*100 .'%</td><td>'.$note_arr[$v1['r_id']].'</td></tr>';
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