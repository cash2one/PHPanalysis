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
 * DBpre:数据库名前缀，格式为前缀加上服务器ID：backend_1、backend_1002、backend_3006
 * Port：数据库端口
 */
$Host = "127.0.0.1"; 
$Username = "root"; 
$Password = "root"; 
$DBpre='backend_';
$Port=3306;


/*
 * 日志文件目录
 * filedir:日志文件产生的目录
 * err_aimUrl：入库出错时将日志文件移动到此目录
 * right_aimUrl：入库正常是日志文件移动到此目录
 * now_file_name：当前正产生的日志文件，用于对比，如果时当前产生的则先不入库
 * 注意：php.ini中对对PHP使用内存的配置要大于文件大小。否则执行时将会报错
 */
$filedir='E:/phpStudy/WWW/ruku/logs';
$err_aimUrl='E:/phpStudy/WWW/test/err_logs';
$right_aimUrl='E:/phpStudy/WWW/test/right_logs';
$now_file_name=date('Y-m-d-H').'.log';

?>