<?php
define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

/*
 public static var LOAD_CREAD_ROLE:int=1; //加载创建角色
 public static var LOAD_VERSION:int=2; //加载版本文件
 public static var PARSE_VERSION:int=3; //解析版本文件
 public static var LOAD_CONFIG:int=4; //加载总配置文件
 public static var PARSE_CONFIG:int=5; //解析总配置文件
 public static var LOAD_MAIN_APP:int=6; //加载主程序
 public static var HANDLE_CREAD_ROLE:int=7; //加载创建角色完成
 public static var HANDLE_LOGIN:int=8; //处理登陆
 public static var INIT_MODEL:int=9; //初始化模块
 public static var INIT_CONFIG:int=10; //初始化配置文件
 public static var PARSE_FIRST_CONFIG:int=11; //解析first配置文件
 public static var PARSE_SECOND_CONFIG:int=12; //解析second配置文件
 public static var AUTH_KEY_FALSE:int=13; //验证接口返回为false
 public static var LINE_CLOSE:int=14; //玩家掉线
 public static var LOAD_ZIP_FILE:int=15; //加载ZIP文件发生安全错误
 public static var HEART_BEAT_TIME_OUT:int=16; //发送心跳超时
 public static var CALL_LOGIN_CHOSE:int=17;//请求角色信息人数
 public static var CALL_LOGIN_CHOSE_ERROR:int=18;//请求角色信息报错
 public static var HANDLE_LOGIN_CHOSE_ERROR:int=19;//处理登陆返回错误
 public static var CONECT_SUCCESS:int=20; //连接成功人数
 public static var SEND_AUTH_KEY:int=21; //发送验证包人数
 public static var SEND_AUTH_KEY_ERROR:int=22; //发送验证包报错
 public static var AUTH_KEY_BACK:int=23; //返回验证包人数
 public static var HANDLE_AUTH_KEY_ERROR:int=24; //处理验证包报错
 public static var MAP_ENTER_BACK:int=25; //进入地图人数
 public static var HANDLE_MAP_ENTER_ERROR:int=26; //处理进入地图报错
 public static var MAP_ENTER_BACK_FALSE:int=27; //MAP_ENTER返回false
 public static var HEAR_BEAT_START:int=28; //心跳开启人数
 public static var ENCODE_MAP_DATA_ERROR:int = 29; //解析地图配置出错
 public static var AUTO_CONNECT_LINE:int = 30;//BGP连线LINE
 public static var AUTO_CONNECT_CHAT:int = 31;//BGP连线CHAT
 public static var LOAD_MAP_DATA_ERROR:int = 32; // 加载地图配置报错
 public static var HANDLE_ROLE_ENTER:int=33; //处理进入地图报错
 public static var SOCKET_CLOSE:int = 34; //SOCKET 断开
 public static var SOCKET_IO_ERROR:int = 35;//SOCKET_IO_ERROR
 public static var SOCKET_NETWORK_ERROR:int = 36;//SOCKET_NETWORK_ERROR
 public static var SOCKET_SECURITY_ERROR:int = 37; // SOCKET_SECURITY_ERROR
 public static var CLIENT_CLOSE_SOCKET:int=38; //前端主动断开socket
 */

$error_desc = array(
	'1' => "加载创建角色",
	'2' => "加载版本文件",
	'3' => "解析版本文件",
	'4' => "加载总配置文件",
	'5' => "解析总配置文件",
	'6' => "加载主程序",
	'7' => "加载创建角色完成",
	'8' => "处理登陆",
	'9' => "初始化模块",
	'10' => "初始化配置文件",
	'11' => "解析first配置文件",
	'12' => "解析second配置文件",
	'13' => "验证接口返回为false",
	'14' => "玩家掉线",
	'15' => "加载ZIP文件发生安全错误",
	'16' => "发送心跳超时",
	'17' => "请求角色信息人数",
	'18' => "请求角色信息报错",
	'19' => "处理登陆返回错误",
	'20' => "连接成功人数",
	'21' => "发送验证包人数",
	'22' => "发送验证包报错",
	'23' => "返回验证包人数",
	'24' => "处理验证包报错",
	'25' => "进入地图人数",
	'26' => "处理进入地图报错",
	'27' => "MAP_ENTER返回false",
	'28' => "心跳开启人数",
	'29' => "解析地图配置出错",
	'30' => "BGP连线LINE",
	'31' => "BGP连线CHAT",
	'32' => "加载地图配置报错",
	'33' => "处理进入地图报错",
	'34' => "SOCKET断开",
	'35' => "SOCKET_IO_ERROR",
	'36' => "SOCKET_NETWORK_ERROR",
	'37' => "SOCKET_SECURITY_ERROR",
	'38' => "前端主动断开socket",
);

$sql = 'SELECT error_step , error_id , count( distinct ( account_name ) ) as error_cnt FROM `t_log_login_error` '
        . ' group by error_step , error_id '; 
$result = GFetchRowSet($sql);
foreach($result as $key => $value)
{
	$result[$key]['error_desc'] = $error_desc[$value['error_step']];
}
//print_r($result);

$smarty->assign("error_data", $result);
$smarty->display("module/register/login_error.html");