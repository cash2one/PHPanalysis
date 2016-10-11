<?php

define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php"; 
include SYSDIR_ADMIN.'/include/global.php';
include SYSDIR_ADMIN.'/class/log_gold_class.php';

$card_type = array(
        0=>$buf_lang['new']['mounts_class_0'],
		1=>$buf_lang['new']['mounts_class_1'],
		2=>$buf_lang['new']['mounts_class_2'],
		3=>$buf_lang['new']['mounts_class_3'],
		4=>$buf_lang['new']['mounts_class_4'],
		5=>$buf_lang['new']['mounts_class_5'],
		6=>$buf_lang['new']['mounts_class_6'],
		7=>$buf_lang['new']['mounts_class_7'],
		8=>$buf_lang['new']['mounts_class_8']
);
foreach($card_type as $k=>$v){
	$sql = "select count(*) as times from `t_log_mounts` where class_level >= ".$k;
	$result = $db->fetchAll($sql);
    $tmp['times'] = $result[0]['times']|0;
    $tmp['name'] = $v;
    $mounts_data[$k] = $tmp;
}
$smarty->assign("data", $mounts_data);

$smarty->display("module/analysis/mounts_level_up.html");
