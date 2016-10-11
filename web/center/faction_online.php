<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

/* 
 * time	当前时间戳	使签名每次不同，无其他用途
 * sign	身份验证签名	加密规则：md5($id.$key.$time)
 * $key 为双方约定的私鈅
 */

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
	$sql = "SELECT b.role_id,b.faction_id,e.last_login_time,e.last_offline_time" .
			" FROM db_role_base_p b, db_role_ext_p e  WHERE b.role_id=e.role_id ";
	$result = $db->FetchAll($sql);
	$all = count($result);
	$online = $t_online = $s_num = $t_num = $off_line =  0;
	foreach($result as $v)
	{
		if($v['last_login_time']>$v['last_offline_time'])
		{
			$online++;
			if($v['faction_id'] == 1)
			{
				$t_online++;
			}
			elseif($v['faction_id'] == 2)
			{
				$s_online++;
			}
		}
		else
		{
			$off_line++;
		}

		if($v['faction_id'] == 2)
		{
			$s_num++;
		}
		elseif($v['faction_id'] == 1)
		{
			$t_num++;
		}
	}
   
     $insert_sql = "replace into `t_log_faction_online` (" .
			" `mtime`,`t_role_num`,`s_role_num`,`tonline`,`sonline`) " .
			" VALUES ('{$time}', '{$t_num}','{$s_num}','{$t_online}','{$s_online}')";
	 $db->query($insert_sql);	


}

