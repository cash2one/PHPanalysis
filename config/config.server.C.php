<?php
global $ALL_SERVER_LIST, $AGENT_NAME;

/* 1--开服
 * 2--合服
 * 3--关服
 * 4--未开
 * 5--已排期
 */
 
//(1)内测服务器列表 管理后台专用url
$SERVER_LIST = array(
	'1' => array("server_id"=>"1","url"=>'http://s1.dpsgs.内测.com/', "desc"=>'内测-精英测试双线1区', "stat" => '1', "join" => '()', "open_time"=>strtotime("2013-09-12 11:00:00"),),
	'2' => array("server_id"=>"2","url"=>'http://s1.dpsgs.内测.com/', "desc"=>'内测-精英测试双线2区', "stat" => '1', "join" => '()', "open_time"=>strtotime("2013-09-12 11:00:00"),),
);
$SERVER_LIST_QQ = array(
	'1' => array("server_id"=>"1","url"=>'http://s9.app1101078706.qqopenapp.com/', "desc"=>'腾讯朋友网-测试1服', "stat" => '1', "join" => '()', "open_time"=>strtotime("2013-10-30 11:00:00"),),
);

$AGENT_NAME = array(
	'1' => '内测平台',
	'2' => '腾讯朋友网',
);

//全部服务器
$ALL_SERVER_LIST = array(
	'0' => array('0' => array("url"=>'', "desc"=>'请选择服务器'),),
	'1' => $SERVER_LIST,
	'2' => $SERVER_LIST_QQ,
);
