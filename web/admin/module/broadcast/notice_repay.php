<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

if ( !isset($_REQUEST['start_time'])){
	$start_time = strftime("%Y-%m-%d %H:%M:%S",time());
}
else
{
	$start_time  = trim(SS($_REQUEST['start_time']));
}

if ( !isset($_REQUEST['end_time']))
{
	$end_time = strftime ("%Y-%m-%d %H:%M:%S", time()+86400 );
}
else
{
	$end_time = trim(SS($_REQUEST['end_time']));
}

if ( !isset($_REQUEST['notice_end_time']))
{
	$notice_end_time = strftime("%Y-%m-%d %H:%M:%S", time()+60*60 );
}
else
{
	$notice_end_time = trim(SS($_REQUEST['notice_end_time']));
}


$level_max = 150;

$config_goodslist_sql = "SELECT a.*,b.name FROM `t_log_notice_reply` a, `config_goods` b where a.goods_id=b.id order by a.id desc";
$config_goodslist = $db->fetchAll($config_goodslist_sql);

$action = trim($_GET['action']);
if($action=='bulletin'){
	$title = trim($_POST['title']);
	if (empty($title))
	{
		errorExit("公告标题不能为空！");
	}
	$text = trim($_POST['text']);
	
	$dateEndStamp   = intval(strtotime($notice_end_time));
	if($dateEndStamp == 0)
	{
		errorExit("请填写公告过期时间！");
	}
	
	if (empty($text))
	{
		errorExit("公告内容不能为空！");
	}
	$text = str_replace("\\'", "'", $text); // 还原 '
	$text = str_replace("\\\"", "\"", $text);  // 还原 "
	$text = str_replace("\\\\", "\\", $text);  // 还原 \

	$text = urlencode($text);
	$result = getJson($erlangWebAdminHost."bulletin/do_bulletin_publish/?title={$title}&text={$text}&end_time={$dateEndStamp}");

	if ($result['result']=='ok') {
		infoExit("公告发布成功");
	}else{
		errorExit ( "公告发布失败" );
	}
}elseif($action=='compensation_conf'){
	//level_min,start_time,end_time,goods
	//exit(print_r($_REQUEST));
	$level_max = intval(trim(SS($_POST['level_max'])));
	$level_min = intval(trim(SS($_POST['level_min'])));
	if ($level_max <=0)
	{
		errorExit("请输入最高等级限制！");
	}
	if ($level_min <=0)
	{
		errorExit("请输入最低等级限制！");
	}
	if ($level_min > $level_max)
	{
		errorExit("最近等级大于最高等级！");
	}
	
	$goods = intval(SS(trim($_POST['goods'])));
	if ($goods <= 0)
	{
		errorExit("请输入补偿的物品ID！");
	}
	
	$num = intval(SS(trim($_POST['num'])));
	if ($num <= 0)
	{
		errorExit("请输入补偿的数量！");
	}
	
	if ($num >10)
	{
		errorExit("补偿的数量不能大于10！");
	}
	
	$dateStartStamp = strtotime($start_time);
	$dateEndStamp   = strtotime($end_time);
	
	if($dateStartStamp == $dateEndStamp)
	{
		errorExit("开始时间和结束时间不能相等！");
	}
    $url = $erlangWebAdminHost."bulletin/compensation_conf/?level_min={$level_min}&level_max={$level_max}&start_time={$dateStartStamp}&end_time={$dateEndStamp}&goods={$goods}&num={$num}";

	$result = getJson($url);
	
	
	if ($result['result']=='ok') 
	{

		$insert_sql = "INSERT INTO `t_log_notice_reply` ( `start_time` ,`end_time` ,`goods_id` ,`num` ,`level_min` ,`level_max`,`operator`)VALUES ('{$dateStartStamp}', '{$dateEndStamp}', '{$goods}', '{$num}', '{$level_min}', '{$level_max}','{$_SESSION['admin_user_name']}')";
        $db->query($insert_sql);
		infoExit("补偿物品配置成功");
	}else
	{
		errorExit ( "补偿物品配置失败" );
	}
}

$smarty->assign("config_goodslist", $config_goodslist);
$smarty->assign("level_min", $level_min);
$smarty->assign("level_max", $level_max);
$smarty->assign("start_time", $start_time);
$smarty->assign("end_time", $end_time);
$smarty->assign("notice_end_time", $notice_end_time);
$smarty->display ("module/broadcast/notice_repay.html");


#-------------------
function make_request($url, $method = 'GET', $timeout = 5) {
    $ch = curl_init();
    $header = array(
            'Accept-Language: zh-cn',
            'Connection: Keep-Alive',
            'Cache-Control: no-cache'
    );
    if ($method == 'GET') {
        curl_setopt($ch, CURLOPT_HEADER, 0);
    }
    else {
        $i = strpos($url, '?');
        $param_str = substr($url, $i + 1);
        $url = substr($url, 0, $i);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_str);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'WEB.4399.COM API PHP Servert 0.1 (curl) ' . phpversion());
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    if ($timeout > 0) curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
#-----------------------------

