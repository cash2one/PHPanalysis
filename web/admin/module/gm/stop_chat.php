<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/9/26
 * Time: 10:19
 */

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty;

$role_id = trim (SS($_REQUEST ['role_id']));
$role_name = trim (SS($_REQUEST ['role_name']));
$account_name = trim (SS($_REQUEST ['account_name']));
$now_time = time();
$username = $_SESSION['admin_user_name'];






$smarty->display("module/gm/stop_chat.html");
