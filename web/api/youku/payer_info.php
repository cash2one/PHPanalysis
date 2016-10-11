<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/11/10
 * Time: 12:00
 */

define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

//http://S1.XXX.g.1360.com/player_info?server_id=S1&users=28318249,116369412&time=1323327195&sign=70741b2cf50d803ef550ca81300947f2
//-1:参数不全 -2:验证失败
$levels = array(
    1 => 80,
    2 => 90,
    3 => 100,
    4 => 110,
    5 => 120,
    6 => 130,
    7 => 140,
    8 => 150,
    9 => 160,
    10 => 170,
);
$server_id = trim($_REQUEST['server_id']);
$users = trim($_REQUEST['users']);
$time = trim($_REQUEST['time']);
$sign = trim($_REQUEST['sign']);
$key = $API_SECURITY_TICKEY_LOGIN;
$final_out = array();
if (empty($server_id) || empty($users) || empty($time) || empty($sign))
{
    $final_out = array(
        'errno' => -4,
        'errmsg' => "param is wrong",
        "data" => ""
    );
    echo json_encode($final_out);
    die();
}
else
{
    $token = md5("get_player_info".$time.$key);
    if($token != $sign)
    {
        $final_out = array(
            'errno' => -3,
            'errmsg' => "sign is wrong",
            "data" => ""
        );
        echo json_encode($final_out);
        die();
    }

}

$users_arr = explode(',', $users);
if(count($users_arr)>20){
    $final_out = array(
        'errno' => -6,
        'errmsg' => "request to much",
        "data" => ""
    );
    echo json_encode($final_out);
    die();
}
if(!empty($users_arr))
{

    $arr = array();
    foreach($users_arr as $k => $u)
    {
        $sql = "select A.role_id,B.role_name from db_role_attr_p A left join db_role_base_p B on A.role_id=B.role_id where B.account_name={$u}";
        $role = $db->fetchOne($sql);

        $role_id = $role['role_id'];
        $url = $erlangWebAdminHost."usermsg/get_user_msg_simple/?role_id={$role_id}";
        $result = getJsonErlang($url);

        if(!empty($result))
        {
            $level = $result[0]['level'];
            $reincarnation = $result[0]['reincarnation'];
            $levelIn = 0;
            if($reincarnation == 0){
                $levelIn = $level;
            }else{
                for($i=0;$i <= $reincarnation; $i++){
                    $levelIn += $levels[$i];
                }
                $levelIn = $level + $levelIn;
            }
            $arr[$u][0] = array(
                'level' => $levelIn,
                'name' => $role['role_name']
            );
        }

    }

    if(!empty($arr)){
        $final_out['errno'] = 0;
        $final_out['errmsg'] = "";
        $final_out['data'] = url_encode($arr);
        echo urldecode(json_encode($final_out));
    }else{
        $final_out = array(
            'errno' => -5,
            'errmsg' => "not user",
            'data' => ""
        );
        echo json_encode($final_out);
    }

}


/**
 * @param $url
 * @return mixed
 */
function getJsonErlang($url) {
    $result = @ file_get_contents($url);
    if ($result) {
        return json_decode($result, true);
    }
    die();
}


function encode($array){
    $str = urldecode(json_encode(url_encode($array)));
    return $str;
}

function url_encode($str) {
    if(is_array($str)) {
        foreach($str as $key=>$value) {
            $str[urlencode($key)] = url_encode($value);
        }
    } else {
        $str = urlencode($str);
    }
    return $str;
}






















