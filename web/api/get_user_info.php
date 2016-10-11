<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/10/21
 * Time: 13:43
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;

$agentId = $AGENT_ID;

//内侧
if($agentId == 1){

}
elseif($agentId == 2) //多玩
{
    $arr = array();
    $account = $_REQUEST['account'];
    $time = $_REQUEST['time'];
    $game = $_REQUEST['game'];
    $server = $_REQUEST['server'];
    $sign = $_REQUEST['sign'];
    $key = $API_SECURITY_TICKEY_LOGIN;

    if(empty($account) || empty($game)|| empty($time) || empty($sign) || empty($server))
    {
        $arr = array(
            "retcode" => -1
        );
        echo json_encode($arr);
        exit;
    }
    else
    {
        $token = strtoupper(md5($account.$game.$server.$time.$key));
        if($token != $sign )
        {
            $arr = array(
                "retcode" => -2
            );
            echo json_encode($arr);
            exit;
        }
    }

    $sql = "select A.role_id from db_role_attr_p A left join db_role_base_p B on A.role_id=B.role_id where B.account_name={$account}";
    $data = $db->fetchOne($sql);
    $role_id = $data['role_id'];
    $url = $erlangWebAdminHost."usermsg/get_user_msg_simple/?role_id={$role_id}";
    $result = getJsonErlang($url);

    $sql_mag = "SELECT A.sex, A.role_name as nickname, A.class_id as profession, FROM_UNIXTIME(A.create_time, '%Y-%m-%d %H:%i:%S') as createTime, A.role_id as roleId ".
        "FROM  db_role_base_p A, db_role_ext_p B, db_role_attr_p C ".
        "WHERE A.role_id = B.role_id AND A.role_id = C.role_id";

    if ($account == '') {
        $sql_mag = $sql_mag . " order by A.account_name ";
    }else{
        $sql_mag = $sql_mag . " AND A.account_name = '" . $account . "'" . " AND A.server_id='{$GAME_SERVER}'";
    }

    $accountInfo = GFetchRowSet($sql_mag);

    if(empty($accountInfo)){
        $arr = array(
            "retcode" => -2
        );
        echo json_encode($arr);
        exit;
    }
    $request = array();
    if($accountInfo[0]['sex']== 1){
        $request[0]['sex']= 'm';
    }else{
        $request[0]['sex'] = 'f';
    }
    if($accountInfo[0]['profession'] == 2){
        $accountInfo[0]['profession'] = '谋士';
    }elseif($accountInfo[0]['profession'] == 1){
        $accountInfo[0]['profession'] = '战士';
    }elseif($accountInfo[0]['profession'] == 3){
        $accountInfo[0]['profession'] = '方士';
    }
    $level = $result[0]['level'];
    $reincarnation = $result[0]['reincarnation'];
    $request[0]['nickname'] = urlencode($accountInfo[0]['nickname']);
    $request[0]['profession'] = urlencode($accountInfo[0]['profession']);
    $request[0]['createTime'] = $accountInfo[0]['createTime'];
    $request[0]['roleId'] = $accountInfo[0]['roleId'];
    $request[0]['grade'] = $level + $reincarnation*10000;

    $arr['retcode'] = 0;
    $arr['roleinfo'] = $request;
    $json_result = json_encode($arr);

    echo $json_result;
}
elseif($agentId == 5)
{
    //sign=8233981F757CE608539E972E52FF6D91, timestamp=2015-10-28 16:17:09, server_id=s1, api_key=50945ab501509b5572d300b4a2b97ca7, user_id=123
    $sign = $_REQUEST['sign'];
    $timestamp = $_REQUEST['timestamp'];
    $serverId = $_REQUEST['server_id'];
    $apiKey = $_REQUEST['api_key'];
    $userId = $_REQUEST['user_id'];
    $secret_key = $API_SECURITY_TICKEY_LOGIN;
    $str = $secret_key."api_key".$apiKey."server_id".$serverId."timestamp".$timestamp."user_id".$userId;
    $token = strtoupper(md5($str));
    $request = array();
    if($token != $sign){
        $request = array(
            "errCode" => 'ERROR_-100',
            "errMsg"  => '传入参数不符合规则'
        );
        echo json_encode(url_encode($request));
        die();
    }
    else
    {
        $sql = "select A.role_id,B.role_name from db_role_attr_p A left join db_role_base_p B on A.role_id=B.role_id where B.account_name={$userId}";
        $data = $db->fetchOne($sql);
        if(empty($data)){
            $request = array(
                'errCode' => "ERROR_-1406",
                "errMsg"  => "角色不存在"
            );
            echo json_encode(url_encode($request));
            die();
        }
        $role_id = $data['role_id'];
        $url = $erlangWebAdminHost."usermsg/get_user_msg_simple/?role_id={$role_id}";
        $result = getJsonErlang($url);

        $sql_ext = "select last_login_time,last_offline_time from db_role_ext_p where role_id = {$role_id}";
        $ext = $db->fetchOne($sql_ext);
        $lastLoginTime = $ext['last_login_time'];
        $lastOfflineTime = $ext['last_offline_time'];

        if($lastLoginTime > $lastOfflineTime){

            $level = $result[0]['level'];
            $onlineTime = floor((time() - $lastLoginTime)/60);
            $role_name = $data['role_name'];
            $request = array(
                "userInfo" => array(
                    0 => array(
                        'roleName' => $role_name,
                        'roleLevel' => $level,
                        'onlineTime' => $onlineTime
                    )
                )
            );
            echo json_encode(url_encode($request));
        }
        else
        {
            $request = array(
                "errCode" => 'ERROR_-100',
                "errMsg"  => '传入参数不符合规则'
            );
            echo json_encode(url_encode($request));
            die();
        }
    }

}




// ====================================================== 华丽分割线 ======================================================

function getJsonErlang($url) {
    $result = @ file_get_contents($url);
    if ($result) {
        return json_decode($result, true);
    }
    die();
}


//递归实现数组内所有元素urlencode
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
