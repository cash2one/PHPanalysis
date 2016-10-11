<?php

include "sum_common.php"; 

$date_str = trim($_REQUEST['date_str']);
$time = trim($_REQUEST['time']);
$sign = trim($_REQUEST['sign']);
$key = "FTNN4399payKode";

$token = md5($key . $time);

if($token != $sign) 
{
	echo(json_encode("sign_error"));
	die();
}
else
{
	$date_int= $time;
	$dateStartStamp = strtotime($date_str . ' 0:0:0');
	$dateEndStamp   = strtotime($date_str . ' 23:59:59');
	
	$record_sql = 'select count(distinct(user_id)) as players, mtime , count(id) as do_times , count(id) as succ_n    FROM `'.$dbConfig['dbname'].'`.`t_log_use_silver` where mtime >= \''.$dateStartStamp.'\' and mtime <= \''.$dateEndStamp.'\' and mtype = \'1043\'     GROUP by mtype';
	//exit("--".$record_sql);
	$record_result = $db->fetchAll($record_sql);
	
	//exit(print_r($record_result));
	
	if(is_array($record_result) && !empty($record_result))
	{
		$sql = 'REPLACE INTO `'.$dbConfig['dbname'].'`.`t_sum_enhance` (`mtime`, `do_type`, `players`, `do_times`, `succ_n`) VALUES ' .
			'(' .$date_int.', 
			\' 1043\', 
			\'' .$record_result[0]['players'] .'\', 
			\'' .$record_result[0]['do_times'] .'\', 
			\'' .$record_result[0]['succ_n'].'\'
		);'; 
		if($db->query($sql))
		{
			echo "access do_log_wash success!";
		}
		else
		{
			echo "access do_log_wash failure!";
		}
	}
}
  
?>
