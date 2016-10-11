<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../config/config.center.php";
include SYSDIR_ADMIN.'/include/api_global.php';


echo strftime("%Y-%m-%d %H:%M:%S",time())." start to run pay log script";
echo "\n";

$keySign = "FTNN4399payKode";
$now_time = time();
# $k:agent_id
# $kk:server_id
foreach($ALL_SERVER_LIST as $k => $v)
{
	if(!empty($v))
	{
		foreach($v as $kk => $vv)
		{
			if(!empty($vv['url']) && $vv['stat']==1)
			{
				$id = $PAY_LOG_ID[$k][$kk];

				if(!isset($PAY_LOG_ID[$k][$kk]) || !is_numeric($id))
				{
					continue;
				}
				$sign = md5($id . $keySign . $now_time);
				$link = $vv['url']."web/center/paylog.php?id={$id}&time={$now_time}&sign={$sign}";
				$pay_result = make_request($link, 'POST', 5);
				$pay_log = json_decode($pay_result, true);

				if(empty($pay_log))
				{
                    //echo 11;exit;
					# 没有大于当前id的充值记录
				}
				else if($pay_log == 'sign_error')
				{
					# 验证错误
				}
				else if($pay_log == 'merge_error')
				{
					$PAY_LOG_ID[$k][$kk] = $pay_log;
				}
				else
				{
					foreach($pay_log as $key => $value)
					{
						$PAY_LOG_ID[$k][$kk] = $key;
                        //var_dump($PAY_LOG_ID);exit;
						if(!empty($value))
						{
							// 原始记录$sql
							$sql = "REPLACE INTO `".$dbConfig['dbname']."`.`all_source_paylog` (`id`, `order_id`, `role_id`, `role_name`, `account_name`, `pay_time`, `pay_gold`, `pay_money`, `agent_id`, `server_id`) VALUES ";
							
							// 转化为人民币的记录							// 原始记录$sql
							$sql_rmb = "REPLACE INTO `".$dbConfig['dbname']."`.`all_source_paylog_rmb` (`id`, `order_id`, `role_id`, `role_name`, `account_name`, `pay_time`, `pay_gold`, `pay_money`, `agent_id`, `server_id`) VALUES ";
							
							$comma_flag = false;
							
							foreach($value as $key2 => $value2)
							{
								if($comma_flag)
								{
									$sql .= ', ';   //原始记录
									$sql_rmb .= ', ';     //人民币记录
								}
								
								//原始记录
								$sql .= '(NULL, \'' .
									$value2['order_id'] .
									'\', \'' .
									$value2['role_id'] .
									'\', \'' .
									$value2['role_name'] .
									'\', \'' .
									$value2['account_name'] .
									'\', \'' .
									$value2['pay_time'] .
									'\', \'' .
									$value2['pay_gold'] .
									'\', \'' .
									$value2['pay_money'] .
									'\', \'' .
									$value2['agent_id'] .
									'\', \'' .
									$value2['server_id'] .
									'\')';
								
								//台币对人民币的汇率为：4.75	台湾游家&台湾337
								if($value2['agent_id'] == 2 || $value2['agent_id'] == 35)
								{
									$tmp_money = round($value2['pay_money']/4.75, 2);
								}
								//充值金额=越南的充值额*1000/汇率(3315)
								else if($value2['agent_id'] == 15)
								{
									$tmp_money = round($value2['pay_money']*1000/3315, 2);
								}
								else
								{
									$tmp_money = $value2['pay_money'];
								}
								
								 
								//人民币记录
								$sql_rmb .= '(NULL, \'' .
									$value2['order_id'] .
									'\', \'' .
									$value2['role_id'] .
									'\', \'' .
									$value2['role_name'] .
									'\', \'' .
									$value2['account_name'] .
									'\', \'' .
									$value2['pay_time'] .
									'\', \'' .
									$value2['pay_gold'] .
									'\', \'' .
									$tmp_money .
									'\', \'' .
									$value2['agent_id'] .
									'\', \'' .
									$value2['server_id'] .
									'\')';
								$comma_flag = true;	
							}
						}
						$sql .= ';';
						$sql_rmb .= ';';
						$db->query($sql);
						$db->query($sql_rmb);
					}
				}
			}
		}
	}
}


$filename = '../../../config/config.center.php';
$word = "<?php\n\$PAY_LOG_ID = " . var_export($PAY_LOG_ID, TRUE) . ";\n";
if (is_writable($filename)) {
    //打开文件
    if (!$fh = fopen($filename, 'wb')) {
        echo "不能打开文件 $filename";
        exit;
    }
    // 写入内容
    if (fwrite($fh, $word) === FALSE) {
        echo "不能写入到文件 $filename";
        exit;
    }
    fclose($fh);
} else {
    echo "文件 $filename 不可写";
}

echo strftime("%Y-%m-%d %H:%M:%S",time())." finish running pay log script";
echo "\n";

die();

#-------------------
function make_request($url, $method = 'GET', $timeout = 5)
{
	$ch = curl_init();
	$header = array(
		'Accept-Language: zh-cn',
		'Connection: Keep-Alive',
		'Cache-Control: no-cache'
	);
	if ($method == 'GET')
	{
		curl_setopt($ch, CURLOPT_HEADER, 0);
	}
	else
	{
		$i = strpos($url, '?');
		$param_str = substr($url, $i + 1);
		$url = substr($url, 0, $i);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param_str);
	}
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, ' API PHP Servert 0.1 (curl) ' . phpversion());
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	if ($timeout > 0) curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
#-----------------------------