<?php

//include SYSDIR_ADMIN."/class/auth.class.php";
include SYSDIR_ADMIN."/class/db.class.php";
include SYSDIR_ADMIN."/class/user.class.php";

//include SYSDIR_ADMIN."/library/smarty/Smarty.class.php";
include SYSDIR_ADMIN."/include/functions.php";


global $db, $dbConfig;

ob_start();
//session_start();

////初始化smarty
//$smarty = new Smarty();
//$smarty->compile_check = true;
//$smarty->force_compile = true;
//$smarty->template_dir = SYSDIR_ADMIN."/template/default/";
//$smarty->compile_dir = SYSDIR_ADMIN."/template_c";
//$smarty->left_delimiter = '<{';
//$smarty->right_delimiter = '}>';

//初始化数据库连接
$db = new DBClass();
$db->connect($dbConfig);

//$auth = new AuthClass();
//if (basename($_SERVER['SCRIPT_FILENAME']) != 'login.php') {
//	if (!$auth->auth()) {
//		header("Location:/admin/login.php");
//		exit();
//	} 
//	//更新最后操作时间
//	$_SESSION['last_op_time'] = time();
//}

//获取开服日期
define("SERVER_ONLINE_DATE", getServerOnlineDate());

/**
 * 获取开服日期（字符串）
 * TODO:需要读取公共配置common.config文件，临时返回一个日期
 */
function getServerOnlineDate(){
	return "2015-10-11";
}


//页面显示的定义
header('Content-Type: text/html; charset=UTF-8');
define(LIST_PER_PAGE_RECORDS, 20); //Search page show ... records per page
define(LIST_SHOW_PREV_NEXT_PAGES, 7); //First Prev 1 2 3 4 5 6 7 8 9 10... Next Last


