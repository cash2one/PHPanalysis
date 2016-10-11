<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/8/31
 * Time: 9:51
 */

/**
 * 斗殴三国充值接口
 * @author yanjiajun
 * @date 2013.11.19
 * 传入参数:pay_num 充值订单号 为年月日时分秒+随机4位数字，总共18位，例如：201012071137233478
 * 	  pay_to_user  充值账号
 *       pay_to_role_id  充值角色id
 * 	  pay_money  充值额，人民币，单位：元
 * 	  pay_ticket  代金券，单位：Q点
 * 	  pay_gold 元宝数
 * 	  pay_time UNIX时间戳
 *       flag=md5(pay_num+pay_to_user+pay_money+pay_ticket+pay_gold+pay_time+key)
 * 返回：1：成功，2：订单重复，-1：参数不全，-2：验证失败，-3：用户不存在 -4：超时，-5:充值失败
 *
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
//include SYSDIR_ROOT_CLIENT.'config/config.pay.ip.limit.php';
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_INCLUDE."/functions.php";

//1:成功，2:订单重复      -1:参数不全 -2:验证失败 -3:用户不存在 -4:超时 -5:充值失败

$order_id    = trim($_REQUEST['pay_num']);           //订单号
$ac_name     = trim($_REQUEST['pay_to_user']);       //充值的平台帐号  uid
$pay_role_id = $_REQUEST['role_id'];                //充值角色
$pay_money_yuan   = $_REQUEST['pay_money'];     //充值金额，人民币
$pay_ticket   = $_REQUEST['pay_ticket'];     //消耗代金券，Q点
$pay_money = intval(floatval($pay_money_yuan) * 100);     //单元转换成分
$pay_gold    = intval($_REQUEST['pay_gold']);        //充值元宝
$pay_time    = intval($_REQUEST['pay_time']);        //充值时间

$url_host = $_SERVER['HTTP_HOST'];
$url = "http://" .$url_host. "/";
#$server_id = -1;
$server_id = $GAME_SERVER;

//根据域名来判断玩家对应的服务器id

/*foreach($ALL_SERVER_LIST[$AGENT_ID] as $key => $value)
{
	if($value['url'] == $url)
	{
		$server_id = $key;
		break;
	}
}*/
$debug_pay = DEBUG_PAY;
if(!$debug_pay){
    echo(-4);
    die();
}

/*
if($server_id == -1){
    echo(-3);      //服务器id不正确，角色不存在，请检查配置文件
    die();
}

if(empty($order_id) || empty($ac_name) || empty($pay_gold) || $pay_gold < 0 || empty($pay_time) || empty($_REQUEST['flag'])){
    echo(-1);      //提交的参数不全
    die();
}
else{
    $token = md5($order_id . $ac_name . $pay_money_yuan . $pay_ticket . $pay_gold . $pay_time . $API_SECURITY_TICKET_PAY);
    if($token != $_REQUEST['flag']){
        echo(-2);    //验证失败
        die();
    }
}*/

$year = date('Y', $pay_time);
$month = date('m', $pay_time);
$day = date('d', $pay_time);
$hour = date('H', $pay_time);

//充值的具体逻辑由游戏服完成，返回 array('pay_result' => $result);
$url = "api/pay/?order_id={$order_id}&ac_name={$ac_name}&role_id={$pay_role_id}&pay_gold={$pay_gold}&pay_time={$pay_time}&pay_money={$pay_money}&pay_ticket={$pay_ticket}&year={$year}&month={$month}&day={$day}&hour={$hour}&server_id={$server_id}&agent_id={$AGENT_ID}";
//echo $url;exit;
$result = getWebJson($url);

//充值进程没启动，world节点down了
if($result['result'] == 'error')
{
    echo (-5);
    die();
}
else
{
    echo json_encode($result['pay_result']);
}


