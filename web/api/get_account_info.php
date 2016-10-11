<?php
/**
 * 玩家信息查询接口 
 * @author 林浩然
 * @date 2011.06.02
 * 传入参数：账号（默认为空的时候返回全部）
 * 返回：账号，游戏角色名称，角色id，在线状态，所属帮派，职业，等级，元宝，绑定元宝，银两余额
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$datetime    = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);
$accountname = trim($_REQUEST['username']);

if(empty($accountname) || empty($datetime)|| empty($time) || empty($flag) )
{
	echo json_encode("-1");
	exit;
}
else
{
	$token = md5($datetime.$time.$API_SECURITY_TICKEY_LOGIN);

	if($token != $flag )
	{
		echo json_encode("-2");
		exit;
	}
}

$sql = "select A.role_id from db_role_attr_p A left join db_role_base_p B on A.role_id=B.role_id where B.account_name='{$accountname}'";
$data = $db->fetchOne($sql);
if(empty($data)){
    echo json_encode("-3");
    exit;
}
$role_id = $data['role_id'];
$url = $erlangWebAdminHost."usermsg/get_user_msg_simple/?role_id={$role_id}";
$result = getJsonErlang($url);

//$sqlCount="SELECT `account_name` FROM `".db_account_p."` ";
$sql = "SELECT A.account_name, A.role_name, A.role_id, B.is_online, A.family_name, C.gold, C.gold_bind, C.silver ".
        "FROM  db_role_base_p A, db_role_ext_p B, db_role_attr_p C ".
        "WHERE A.role_id = B.role_id AND A.role_id = C.role_id";
if ($accountname == '') {
    $sql = $sql . " order by A.account_name ";
}else{
    $sql = $sql . " AND A.account_name = '" . $accountname . "'" . " AND A.server_id='{$GAME_SERVER}'";
}

$level = $result[0]['level'];
$reincarnation = $result[0]['reincarnation'];
$accountInfo = GFetchRowSet($sql);
$accountInfo[0]['level'] = $level;
$accountInfo[0]['reincarnation'] = $reincarnation;

$result = json_encode($accountInfo);

echo($result);




// ====================================================== 华丽分割线 ======================================================

function getJsonErlang($url) {
    $result = @ file_get_contents($url);
    if ($result) {
        return json_decode($result, true);
    }
    die();
}


