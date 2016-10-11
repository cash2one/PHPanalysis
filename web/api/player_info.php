<?php
define('IN_DATANG_SYSTEM', true);
include "../config/config.php"; 
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//http://S1.XXX.g.1360.com/player_info?server_id=S1&users=28318249,116369412&time=1323327195&sign=70741b2cf50d803ef550ca81300947f2
//-1:参数不全 -2:验证失败
$server_id = trim($_REQUEST['server_id']);
$users = trim($_REQUEST['users']);
$time = trim($_REQUEST['time']);
$sign = trim($_REQUEST['sign']);
$key = $API_SECURITY_TICKEY_LOGIN;

if (empty($server_id) || empty($users) || empty($time) || empty($sign))
{
	echo -4;
	die();
}
else
{
	$token = md5("get_player_info_".$time."_".$key);
	if($token != $sign) 
	{
		echo -3;
		die();
	}
	if($time - time() >600)
	{
		echo(json_encode(0));
		die();
	}
}

$users_arr = explode(',', $users);
if(!empty($users_arr))
{
	$final_out = array();
    $arr = array();
	foreach($users_arr as $k => $u)
	{
		$sql = "SELECT a.level, b.role_name as name, a.reincarnation  FROM db_role_base_p as b, db_role_attr_p as a " .
				"WHERE b.role_id = a.role_id AND b.account_name = {$u} AND b.server_id = {$GAME_SERVER}";
		$result = GFetchRowSet($sql);
       // print_r($result);exit;
		if(!empty($result))
		{
			if(preg_match("/^\[[0-9]*\]/", $result[0]['name']))
			{
				$result[0]['name'] = preg_replace("/^\[[0-9]*\]/", "", $result[0]['name']);
			}
            $arr[0]['name'] = $result[0]['name'];
            if($result[0]['reincarnation'] == 0){
                $arr[0]['level'] = $result[0]['level'].'级';
            }else{
                $arr[0]['level'] = $result[0]['reincarnation'].'转生'.$result[0]['level'].'级';
            }
            foreach($arr[0] as $k =>$v){
                $arr[0][$k] = urlencode($v);
            }
            $final_out[$u] = $arr;
		}

	}

    if(!empty($final_out)){
        echo urldecode(json_encode($final_out));
    }else{
        echo -5;die();
    }

}
























