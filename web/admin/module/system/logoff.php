<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db, $auth;


session_destroy();
unset($_SESSION);
echo "<script>top.location.href='../../login.php';</script>";

