<?php
define('IN_DATANG_SYSTEM', true);
//include "../config/config.php";
//include SYSDIR_ROOT_CLIENT.'config/config.key.php';
//include SYSDIR_ADMIN.'/include/api_global.php';

include "/data/mge/client/web/config/config.php";
include "/data/mge/client/web/include/global.php";
global $db;

# 百度 2.4	每日新建角色记录文件
# 每晚00:15分获取昨天的新建角色
$start_time_stamp = strtotime(strftime("%Y-%m-%d", strtotime("-1 day"))." 0:0:0");
$end_time_stamp = strtotime(strftime("%Y-%m-%d", strtotime("-1 day"))." 23:59:59");
//$end_time_stamp =time();

# serverId userId roleName createTime lastLoginTime
$sql = "SELECT b.account_name as userId, b.role_name as roleName, " .
	   "from_unixtime(b.create_time) as createTime, from_unixtime(e.last_login_time) as lastLoginTime" .
	   " FROM db_role_base_p as b, db_role_ext_p as e" .
	   " WHERE b.role_id=e.role_id AND b.create_time>={$start_time_stamp} AND b.create_time<={$end_time_stamp}";
$result = $db->fetchAll($sql);
foreach ($result as $key => $value)
{
	echo $GAME_SERVER." ".$value['userId']." ".$value['roleName']." ".$value['createTime']." ".$value['lastLoginTime']."<br>";
}
die();
