<?php
include SYSDIR_ROOT."class/db.class.php";
include SYSDIR_ROOT."admin/library/smarty/Smarty.class.php";

global $smarty, $auth, $db, $dbConfig;

ob_start();
session_start();

//初始化smarty
$smarty = new Smarty();
$smarty->compile_check = true;
$smarty->force_compile = true;
$smarty->template_dir = SYSDIR_ROOT."template/default/";
$smarty->compile_dir = SYSDIR_ROOT."template_c";
$smarty->left_delimiter = '<{';
$smarty->right_delimiter = '}>';

//初始化数据库连接
$db = new DBClass();
$db->connect($dbConfig);

//更新最后操作时间
$_SESSION['last_op_time'] = time();
//页面显示的定义
header('Content-Type: text/html; charset=UTF-8');
define(LIST_PER_PAGE_RECORDS, 20); //Search page show ... records per page
define(LIST_SHOW_PREV_NEXT_PAGES, 7); //First Prev 1 2 3 4 5 6 7 8 9 10... Next Last