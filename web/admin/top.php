<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
global $smarty;

$this_agent_servers = $ALL_SERVER_LIST[$AGENT_ID];
$game_server_id = $GAME_SERVER;
$game_server_name = $this_agent_servers[$game_server_id]['desc'];

$username = $_SESSION['admin_user_name'];
$uid = $_SESSION['uid'];
$sql = "SELECT passwd, agent_id FROM ".T_ADMIN_USER." where username='$username' and uid='$uid'";
$result = $db->fetchOne($sql);
$password = $result['passwd'];

$agent_id_list = $result['agent_id'];
$agent_id_array = explode(' ', $agent_id_list);

$auth_cnt = count($agent_id_array);

//$this_agent_name = array('0' => '请选择平台');
//foreach($agent_id_array as $kk => $vv)
//{
//	$this_agent_name[] = $AGENT_NAME[$vv];
//}

//$this_agent_name = array('0' => array('agnetid' => 0, 'agentname' => '请选择平台'));
foreach($agent_id_array as $kk => $vv)
{
	$tmp = array('agentid' => $vv, 'agentname' => $AGENT_NAME[$vv]);
	$this_agent_name[] = $tmp;
}


//print_r($this_agent_name);

$action = trim($_GET['action']);
$server_url = $_REQUEST['servername'];

if ($action == 'do')
{
	
	if(!empty($server_url))
	{
		$server_url .= "web/admin/login.php";
		
		$server_url .= "?action2=change_server&username={$username}&password={$password}&LANG={$lang_type}";
		echo "<script>window.parent.location='$server_url';</script>";
		exit();
	}
}

$today_time_str = strftime("%Y年%m月%d日");
$week = date("w", time());

$smarty->assign("game_server_name", $game_server_name);
$smarty->assign("auth_cnt", $auth_cnt);

$smarty->assign("server_id", $ALL_SERVER_LIST[$AGENT_ID][$GAME_SERVER]['url']);

$smarty->assign("agent_name_select", $AGENT_ID);
$smarty->assign("agent_name_option", $this_agent_name);

$smarty->assign("username", $username);
$smarty->assign("today_time", $today_time_str);
$smarty->assign("week", $week);

$smarty->display("top.html");
