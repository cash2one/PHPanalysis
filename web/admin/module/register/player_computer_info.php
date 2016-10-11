<?php
define('IN_DATANG_SYSTEM', true);
global $smarty;
include "../../../config/config.php";
include SYSDIR_ADMIN.'/include/global.php';

$info_type_option = array(
	'0' => $buf_lang['new']['please_select'],
	'version' => $buf_lang['new']['version'],
	'resolution' => $buf_lang['new']['resolution'],
	'brower' => $buf_lang['new']['brower'],
);

$info_type = $_REQUEST['info_type'];
$action = trim($_GET['action']);
if ($action == 'search')
{
	if($info_type == '0') 
	{
		errorExit("请选择信息类型！");
	}
	else
	{
		$sql2 = 'SELECT '.$info_type.' as version_name, count(distinct(`account_name`)) as version_cnt FROM `t_log_game_event` where event=\'beforeloadflash\' and ' .
				$info_type ." != '' group by ".$info_type .' order by version_cnt desc';
		$result2 = GFetchRowSet($sql2);
	}	
}

$smarty->assign("info_type_option", $info_type_option);
$smarty->assign("info_type", $info_type);
$smarty->assign("version_data", $result2);
$smarty->display("module/register/player_computer_info.html");

