<?php
global $ALL_SERVER_LIST, $AGENT_NAME;

/* 1--开服
 * 2--合服
 * 3--关服
 * 4--未开
 * 5--已排期
 */
 
//(1)内测服务器列表 管理后台专用url
/*$SERVER_LIST = array(
	'1' => array(
        "server_id" =>"1",
        "url"       =>'http://192.168.8.40/',
        "desc"      =>'内测-精英测试双线1区',
        "stat"      => '1',
        "join"      => '()',
        "open_time" =>strtotime("2013-09-12 11:00:00"),
    ),
	'2' => array(
        "server_id" =>"2",
        "url"       =>'http://192.168.8.195/',
        "desc"      =>'内测-精英测试双线2区',
        "stat"      => '1',
        "join"      => '()',
        "open_time" =>strtotime("2013-09-12 11:00:00"),
    ),
);
$SERVER_LIST_QQ = array(
        '9' => array(
        "server_id" =>"9",
        "url"       =>'http://s9.app1101078706.qqopenapp.com/',
        "desc"      =>'腾讯朋友网-测试1服',
        "stat"      => '1',
        "join"      => '()',
        "open_time" =>strtotime("2013-10-30 11:00:00"),
    ),
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
*/
/*$SERVER_LIST = array(
    '1' => array(
        "server_id" =>"1",
        "url"       =>'http://s1.7280.sgcq.1010g.cn',
        "desc"      =>'1010g',
        "stat"      => '1',
        "join"      => '()',
        "open_time" =>strtotime("2015-09-09 11:00:00"),
    ),
    '2' => array(
        "server_id" => '2',
        "url"       => 'http://s2.7280.sgcq.1010g.cn',
        "desc"      => '7280平台2服',
        "stat"      => '1',
        'join'      => '(2服)',
        'open_time' => strtotime("2015-10-15 15:00:00")
    )
);*/

$AGENT_NAME = array(
	//'1' => '1010g'
    '4' => '7280平台'
);

//全部服务器
$ALL_SERVER_LIST = array(
	//'0' => array('0' => array("url"=>'', "desc"=>'请选择服务器'),),
	'4' => array(
        '1' => array(
            "server_id" =>"1",
            "url"       =>'http://s1.7280.sgcq.1010g.cn/',
            "desc"      =>'7280平台1服',
            "stat"      => '1',
            "join"      => '(1服)',
            "open_time" =>strtotime("2015-09-09 11:00:00"),
        ),
        '2' => array(
            "server_id" => '2',
            "url"       => 'http://s2.7280.sgcq.1010g.cn/',
            "desc"      => '7280平台2服',
            "stat"      => '1',
            'join'      => '(2服)',
            'open_time' => strtotime("2015-10-15 15:00:00")
        )
    )
);
