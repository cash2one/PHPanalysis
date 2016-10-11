<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty;


$user_power = $auth->getUserPower2($buf_lang);
//echo '<pre>';print_r($user_power);die();
$smarty->assign("user_power", $user_power);
$smarty->display("left.html");