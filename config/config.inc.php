<?php
//include 'config.server.php';
include 'config.key.php';
global $dbConfig,$data_host,$data_dbuser,$data_password,$data_coding,$host,$dbuser,$password,$dbname,$coding,$dbpre;

/*
 * 数据库名前缀
 * 数据库名由前缀+服务器ID组成 例如：backend_1、backend_1002
 */
$dbpre='backend_';//数据库名前缀


 /*
  * 日志数据库
  * 使用数据库类：mysql.class.php
  * 一服多库统一管理，也可一服多库分别管理
  */
$data_host='192.168.0.200';
$data_dbuser='backend';
$data_password='123456';
$data_coding='utf8';
 
 
 
 /*
  * 服务器列表所在数据库
  * 用于获取服务器列表
  */
$host='192.168.0.200';
$dbuser='backend';
$password='123456';
$dbname='xyadmin';
$coding='utf8';


//系统数据库
$dbConfig = array(
	'user' => $dbuser,
	'passwd' => $password,//dk49%%90yusw@ldk123
	'host' => $host,
	'dbname' => 'db_log'
);


//$erlangWebHost变量未使用，使用client/web/config/config.php文件中的$erlangWebAdminHost
//$erlangWebHost = "http://127.0.0.1:".WEB_PORT."/"; 

$payAPIUrl = '';
$bbsUrl = '';
 
?>