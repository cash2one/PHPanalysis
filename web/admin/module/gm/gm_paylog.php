<?php

define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty;


$smarty->display("module/gm/gm_paylog.html");

