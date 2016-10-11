<?php
/**
 * 道具发放记录接口 
 * @author wangxuefeng@4399.com
 * @date 2011.09.15
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：申请发放物品者，申请时间，玩家角色名，玩家账号，物品id, 物品名，物品数量，是否绑定(1->绑定，0->不绑定)，发放理由，审核人，审核发放时间
 * 	   {apply_admin_name, apply_time， role_name, account_name, item_id, item_name, item_num, bind, reason, review_admin_name, review_time}
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
if (empty($date) || empty($time) || empty($flag))
{
	echo(json_encode(-1));
	die();
}
else
{
	$token = md5($date . $time . $API_SECURITY_TICKET_DATA);
	//echo $token.'<br>';
	if($token != $flag) 
	{
		echo(json_encode(-2));
		die();
	}
}

$start_time = strtotime($date);
$end_time = $start_time + 86400;
$sql = "SELECT r.admin_name as apply_admin_name, from_unixtime(r.mtime) as apply_time, r.user_name as role_name," .
		" b.account_name, r.item_id, r.goods_name, r.number as item_num, r.bind, r.reason, r.review_admin_name, from_unixtime(r.review_mtime) as review_time" .
		" FROM t_log_review as r, db_role_base_p as b" .
		" WHERE r.user_id=b.role_id AND r.review_mtime>='{$start_time}' AND r.review_mtime<'{$end_time}'" .
		" AND (r.item_name='send_item' OR r.item_name='send_equip') AND r.status='4' ORDER BY r.id ASC";
$result = $db->fetchAll($sql);
print_r($result);echo "<br>";
echo json_encode($result);
