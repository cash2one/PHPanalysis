<?php
/**
 * 元宝消费统计接口 
 * @author wangxuefeng@4399.com
 * @date 2011.06.04
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：各个消费类型当日消耗的元宝数，总消耗的元宝数
 *     {mtype, mdetail, today_gold_unbind,today_gold_bind,all_gold_unbind,all_gold_bind}
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


if($A_DEBUG)
{
   $date = '2011-12-6'; 
   $time = time();
   $flag = md5($date . $time . $API_SECURITY_TICKET_DATA);
}

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


//各个类型当天消耗的元宝
$dateStartStamp = strtotime($date . ' 0:0:0');
$dateEndStamp   = strtotime($date . ' 23:59:59');


 /*
$sql = 'SELECT mtype, mdetail, sum( gold_unbind ) as today_gold_unbind, sum(gold_bind) as today_gold_bind'
        . ' FROM `t_log_use_gold`'
        . ' where mtime >' .
        $dateStartStamp.
        ' and mtime<' .
        $dateEndStamp
        . ' GROUP BY mtype'
        . ' order by mtype asc'; 
$result = GFetchRowSet($sql);

//各个类型总消耗元宝
foreach($result as $key => $row)
{
	$sql2 = 'SELECT sum( gold_unbind ) as all_gold_unbind, sum(gold_bind) as all_gold_bind FROM `t_log_use_gold` '
        . ' WHERE mtype = ' .
        $row['mtype']
        . ' group by mtype '
        . ' order by mtype asc '; 
    $total_gold = GFetchRowSet($sql2);  
    $result[$key]['all_gold_unbind'] = $total_gold[0]['all_gold_unbind'];
    $result[$key]['all_gold_bind'] = $total_gold[0]['all_gold_bind'];
}   */

//优化方案A：减少全表检索次数为2次，
/*$sql = "select * from ((SELECT mtype, mdetail, sum( gold_unbind ) as today_gold_unbind, sum(gold_bind) as today_gold_bind "
        ."FROM t_log_use_gold where mtime between {$dateStartStamp} and {$dateEndStamp} GROUP BY mtype order by mtype asc) as A "
        ."left join (select mtype,sum(gold_unbind) as all_gold_unbind ,sum(gold_bind) as all_gold_bind "
        ."from t_log_use_gold GROUP BY mtype) as B on A.mtype = B.mtype)" ;
 $result = GFetchRowSet($sql); */
 
 //方案A不足 1使用了filesort，2.遍历了2此表 3.mtime索引在group mtype后无用
 
 
 //进一步优化，优化方案B ，减少全表检索次数为1次， 
 $sql = "SELECT mtype, mdetail, "
        ."sum(case when mtime between {$dateStartStamp} and {$dateEndStamp} then gold_unbind else 0 end) as today_gold_unbind, "
        ."sum(case  when mtime between {$dateStartStamp} and {$dateEndStamp} then gold_bind else 0 end ) as today_gold_bind ,"
        ."sum(gold_unbind) as all_gold_unbind ,sum(gold_bind) as all_gold_bind FROM t_log_use_gold force index(mtime) "
        ." where mtime<= {$dateEndStamp} GROUP BY mtype";
 $result = GFetchRowSet($sql);
 
 
 //方案B不足： 1使用了filesort 2.mtime索引在group mtype后无用
 //上述不足 暂时没有办法解决
 
//TODO：未来进一步优化策略，如果对历史查询频繁 创建每日的统计表，缓存一下统计

echo json_encode($result);


