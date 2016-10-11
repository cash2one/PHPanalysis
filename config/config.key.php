<?php

//session_id(SID);

session_start();

if (!defined('IN_DATANG_SYSTEM')) {

	exit('hack attemp!');

}

if(!empty($_SESSION['username']) && $_SESSION['username']!=''){

	$accountName = $_SESSION['username'];

}

global $GAME_SERVER;



//服务器编号：初始化为当前服务器的id

$GAME_SERVER = '1';

//代理商ID：初始化为联运平台id

/* 1---内测

 * 2---腾讯朋友网

 */

$AGENT_ID = '4';



//腾讯平台信息

define('QQ_APPID','1101078706');

define('QQ_APPKEY','DozJY2wRqpEy1JFV');

define('QQ_SERVER_NAME','openapi.tencentyun.com');

define('CHECK_SYSTEM','false');//版署检查开关true为检查状态 false为正常状态

define('CLOSE_SWIMMING','false');//关闭采金莲开关true为关闭 false为打开



define('OPEN_TIME','2013-12-11');//开服时间

define('MERGER_IS_OPEN','false');//合服活动是否开启

define('MERGER_END_TIME','2014-3-11');//合服活动持续时间



define('DEBUG_PAY', true);   //测试充值开关 true 开启  false 关闭

define('WEB_SITE',$_SERVER['SERVER_NAME']);

define('BBS_SITE','');

define('HOME_SITE','');

define('OFF_URL','');

define('PAY_URL','');

define('LOGIN_SITE',$_SERVER['SERVER_NAME']);

define('CHAT_SITE',$_SERVER['SERVER_NAME']);

define('RES_SITE','192.168.26.128');

define('RES_SITE2','192.168.26.128');

define('SOURCE','192.168.26.128:81');



define('DATANG_VERSION','ver.2013-10-31');

define('TITLE','精英测试双线1区－笑傲天下－2015年百变国战网页游戏！');

define('IS_DEBUG',"false");

define('IS_OPEN',"true");

define('LANG_TYPE',1);

define('COMM_URL','http://115.238.101.80:8000/');

define('GAME_SERVER',$_SERVER['SERVER_NAME']);

define('REG_URL','http://'.$_SERVER['SERVER_NAME'].'/reg.api.php');

define('FCM_URL','http://'.$_SERVER['SERVER_NAME'].'/fcm.php');

define('SOCKET_URL','http://'.$_SERVER['SERVER_NAME'].'/statistics.php');

define('GM_BUG_LINK','');

define('IS_CLIENT','1');

define('CLIENT_URL','');



define('CENTER_URL','');//中央服务器




define('GM_LINK','');

define('XSK_URL','');



define('CONTENT1','玩家交流群1：176443931');

define('CONTENT2','玩家交流群2：205440179');//SLG_GAME玩家交流群（2）

define('CONTENT3','');//SLG_GAME玩家交流群（3）



//API

define('PLATFORM_WEBSITE_CHECK','');

define('PLATFORM_WEBSITE_REG','');

define('PLATFORM_WEBSITE_FCM','');

define('GAME','dtzl2');

define('CID','3000');



define('OPEN_WHITE_ROLE','false');



define('WHITE_ROLE',"5596B8B7B913859779A9C3F335A4EC87");



define('LOGIN_PORT','8080');

define('PHP_LOGIN_PORT','80');

define('WEB_PORT','8000');



//一机多服分发数据如购买道具

$serverUrl = array("1"=>"http://s13.app1101078706.qqopenapp.com/",

				   "2"=>"http://s9.app1101078706.qqopenapp.com/",

				   "3"=>"http://s15.app1101078706.qqopenapp.com/",

				   

				   "9"=>"http://mm.webgame.com/",

				   

				   "1000"=>"http://s11.app1101078706.qqopenapp.com/");

define('BGP_FLAG','false');

define('BGP_URL','');

define('BGP_LINE_PORT','');

define('BGP_CHAT_PORT','');



//客户端跨服战是否开启配置

define('IS_INTER_OPEN','true');



//端口转发代理地址

define('PROXY_URL','');



$API_SECURITY_TICKET_CLIENT    = '123456';

$API_SECURITY_TICKEY_LOGIN     = '123456';

$API_SECURITY_TICKET_DATA      = '123456';

$API_SECURITY_TICKET_PAY       = '123456';

$API_SECURITY_TICKEY_REG		= '123456';

