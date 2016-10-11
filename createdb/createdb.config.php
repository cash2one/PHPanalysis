<?php
/*
 * 服务器列表数据库,获取服务器列表，生成对应的数据库列表
 * svr_host:服务器列表数据库的地址
 * svr_username：该数据库用户名
 * svr_password: 用户密码
 * svr_dbname:服务器列表所在的数据库名
 * svr_port:该数据库端口
 */
$svr_host     = "192.168.0.200";
$svr_username = "backend";
$svr_password = "123456";
$svr_dbname   = "xyadmin";
$svr_port     = 3306;

/*
 * 数据入库的目标数据库
 * Host：数据库地址
 * Username：数据库用户名
 * Password：用户密码
 * DBpre:数据库名前缀，格式为前缀加上服务器ID：sanguo1、sanguo1002、sanguo3006
 * Port：数据库端口
 */
$Host = "127.0.0.1"; 
$Username = "root"; 
$Password = "root"; 
$DBpre='backend_';
$Port=3306;


/*
 * 标识位，根据标识位的标识执行对所有库执行对应操作
 * create 创建所有库
 * drop 删除所有库
 * truncate 截断所有数据库(该功能尚未实现)
 */
$tag='create';

?>