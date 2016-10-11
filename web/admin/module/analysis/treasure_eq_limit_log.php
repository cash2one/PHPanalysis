<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty, $db;
$sum_common = array(
    '1' => $buf_lang['new']['dragon_1'],
	'2' => $buf_lang['new']['dragon_2'],
);
$limit_goods = array(10000017,13000121,10000032,10000035,32400001,32400002,32400003,32400004,32400005,32400006,32400007,32400008,32400009,32400010,13000126,32600001,32600002,32600003,32600004,32600005,32600006,32600007,32600008,32600009,32600010);

$act_type_option = array(
	'0' => $buf_lang['new']['select'],
	'1' => $buf_lang['left']['arena'],
);

if ( isset($_REQUEST['dStartDate'])){
	$dateStart = $_REQUEST['dStartDate'];
}
else
{
	$dateStart = strftime ("%Y-%m-%d", time()-(60*60*24)*3 );
}

if ( isset($_REQUEST['dEndDate']))
{   
    $dateEnd = $_REQUEST['dEndDate'];
}
else
{
	$dateEnd= strftime ("%Y-%m-%d",time());
}
$u_start = strtotime($dateStart.' 00:00:00');
$u_end = strtotime($dateEnd.' 23:59:59');

$act_type = isset($_REQUEST['act_type']) ? $_REQUEST['act_type'] : 0;

if (isset($act_type))
{
	if($act_type == '0') 
	{
		if($u_end - $u_start > 3600*24)
		{
			$u_start = $u_end-3600*24+1;
			$dateStart = strftime('%Y-%m-%d',$u_start);
		}
		$match_sql = "SELECT * FROM `t_log_treasure` WHERE  date>='{$u_start}' AND date<='{$u_end}' ORDER BY date desc";
	}
	else
	{
		$match_sql = "SELECT * FROM `t_log_treasure` WHERE type='{$act_type}' AND date>='{$u_start}' AND date<='{$u_end}' ORDER BY date desc";
	}
	$match_data = GFetchRowSet($match_sql);
}

if(!empty($match_data))
{
	foreach($match_data as $k => $v)
	{
		switch($v['type'])
		{	
			case 1 :
				if(isset($v['goodslist']) && !empty($v['goodslist']))
				{
					$templist = explode('#',$v['goodslist']);
					$goodslist[1]['goodslist'][$k]['list'] = $templist ;
					$goodslist[1]['goodslist'][$k]['date'] =  $v['date'];
				}
				break;
			case 2 :
				if(isset($v['goodslist']) && !empty($v['goodslist']))
				{
					$templist = explode('#',$v['goodslist']);
					$goodslist[2]['goodslist'][$k]['list'] = $templist ;
					$goodslist[2]['goodslist'][$k]['date'] =  $v['date'];
				}
				break;
			default :
				break;
		}	
	}
	
	$co =0;
	foreach($goodslist as $k => $v)
	{
		foreach($v['goodslist'] as $k1 => $v1)
		{
			foreach($v1['list'] as $k2 => $v2)
			{
				if(isset($v2[0]) && !empty($v2[0]))
				{
					$co++;
					$list[$k][$co] = explode('-',$v2);
					$list[$k][$co]['date'] = $v1['date']; 
				}
			}
		}
	}
	//exit(print_r($list));
	$goosql = "select id,name from `t_PGoods` ";
	$tem_name = GFetchRowSet($goosql);
	foreach($tem_name as $v)
	{
		$goods_name[$v['id']] = $v['name'];
	}
	
	
	if($act_type == 0)
	{
		$show =array();
		foreach($list as $k => $v)
		{
			foreach($v as $v1)
			{
				if(!isset($show[$k][$v1[0]]) && !isset($show[$k][$v1[0]]['num']))
				{
					$show[$k][$v1[0]]['num'] = $v1[1];
					$show[$k][$v1[0]]['name'] = $goods_name[$v1[0]];
					$show[$k][$v1[0]]['date'] = $v1['date'];
				}
				else
				{
					$show[$k][$v1[0]]['name'] = $goods_name[$v1[0]];
					$show[$k][$v1[0]]['num'] += $v1[1];
					$show[$k][$v1[0]]['date'] = $v1['date'];
				}
				$show[$k]['sum'] += $v1[1];
			}
		}
	}
	else
	{
		$show =array();
		$strtime1 = strtotime($dateEnd)+60*60*24;
		$strtime2 = strtotime($dateStart);
		for($t=$strtime1-1,$i=0; $t>=$strtime2; ) {
			$rt_date['format'][$i]['date'] = date('Y-m-d',$t);
			$rt_date['format'][$i]['weekday'] = date('l',$t);
			$t -= 60*60*24;
			$i++;
		}
		foreach($rt_date['format'] as $k => $v) {
			$start_temp = strtotime($v['date'].' 00:00:00');
			$end_temp = strtotime($v['date'].' 23:59:59');
			foreach($list as $k1=>$v1) {
				foreach($v1 as $k2 => $v2)
				{	 
					if($v2['date'] >= $start_temp &&  $v2['date'] <= $end_temp )
					{
						if(!isset($show[$k][$v2[0]]) && !isset($show[$k][$v2[0]]['num']))
						{
							$show[$k][$v2[0]]['num'] = $v2[1];
							$show[$k][$v2[0]]['name'] = $goods_name[$v2[0]];
							$show[$k][$v2[0]]['date'] = $v2['date'];
						}
						else
						{
							$show[$k][$v2[0]]['name'] = $goods_name[$v2[0]];
							$show[$k][$v2[0]]['num'] += $v2[1];
							$show[$k][$v2[0]]['date'] = $v2['date'];
						}
						$show[$k]['sum'] += $v2[1];
					}
				}
			}
		}
		
		
	}
}
else
{
	$show = array();
}
//exit(print_r($show));
ksort($show);
foreach ($show as $k => $v) {
	ksort($v);
	$show_data[$k] = $v;
}
$output = output_data($show,$dateStart,$dateEnd,$sum_common,$act_type,$limit_goods);
$smarty->assign("ctype_desc", $sum_common);
$smarty->assign("output", $output);
$smarty->assign("allAgentName", $AGENT_NAME);
$smarty->assign("search_keyword1", $dateStart);
$smarty->assign("search_keyword2", $dateEnd);
$smarty->assign("act_type_option", $act_type_option);
$smarty->assign("act_type", $act_type);
$smarty->display("module/analysis/treasure_eq_limit_log.html");




function output_data($data,$dateStart,$dateEnd,$sum_common,$act_type,$limit_goods)  {
	global $buf_lang;
    if(empty($data)) return '<font color="#FF0000" size="+1">'.$buf_lang['new']['no_data_inlimit'].'</font>';
    $html = '';
    $flag = array(1=>'<font color="red"><b>↓</b></font>',2=>'<font color="green"><b>↑</b></font>');
    $table = '<td width="310" valign="top" ><table cellspacing="1" cellpadding="0" border="1" bgcolor="#bbe5e5" width="310" valign="top">';
    $thead = '<tr align="center"><td><b>'.$buf_lang['left']['props_id'].'</b></td><td><b>'.$buf_lang['left']['props_name'].'</b></td><td><b>'.$buf_lang['left']['props_num'].'</b></td><td><b>'.$buf_lang['new']['time'].'</b></td></tr>';
	if($act_type != 0)
	{
		$strtime1 = strtotime($dateEnd)+60*60*24;
		$strtime2 = strtotime($dateStart);
		for($t=$strtime1-1,$i=0; $t>=$strtime2; ) {
			$rt_date['format'][$i]['date'] = date('Y-m-d',$t);
			$rt_date['format'][$i]['weekday'] = date('l',$t);
			$t -= 60*60*24;
			$i++;
		}	
		foreach($rt_date['format'] as $k => $v) {
			$start_temp = strtotime($v['date'].' 00:00:00');
			$end_temp = strtotime($v['date'].' 23:59:59');
			$info = $v['date'].' 00:00:00 ~'.$v['date'].' 23:59:59  <br>'.$sum_common[$act_type].$buf_lang['conmon']['statistics'];
			$head = "<tr align='center'><td colspan='5'><b>$info</b></td></tr>";
			$tr = '';
			foreach($data as $k1=>$v1) {
				foreach($v1 as $k2 => $v2)
				{
					if(in_array($k2,$limit_goods))
					{	 
						if($v2['date'] >= $start_temp &&  $v2['date'] <= $end_temp )
						{
							if($k2 != 'sum')
							{
								$tr .= '<tr><td>'.$k2.'</td><td>'.$v2['name'].'</td><td>'.$v2['num'].'</td><td>'.strftime('%H:%M',$v2['date']).'</td></tr>';//1.95583, 2)
							}
						}
					}
				}

			}
			$tbody .=$tr;
			$html .=$table.$head.$thead.$tbody.'</table></td>';
			$tbody='';
		}
		//exit(print_r($data_day));
	}
	else
	{
		foreach($data as $k => $v) {
			$info = $dateStart.' 00:00:00 ~'.$dateEnd.' 23:59:59  <br>'.$sum_common[$k].$buf_lang['conmon']['statistics'];
			$head = "<tr align='center'><td colspan='5'><b>$info</b></td></tr>";
			$tr = '';
	
			foreach($v as $k1 => $v1) {
				if(in_array($k1,$limit_goods))
				{
					if($k1 != 'sum')
					{			
						$tr .= '<tr><td>'.$k1.'</td><td>'.$v1['name'].'</td><td>'.$v1['num'].'</td><td>'.strftime('%H:%M',$v1['date']).'</td></tr>';
					}
				}
			}
			$tbody .=$tr;
			$html .=$table.$head.$thead.$tbody.'</table></td>';
			$tbody='';
		}
	}
    return $html;
}
