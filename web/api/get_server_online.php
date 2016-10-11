<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/9/29
 * Time: 13:35
 */
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


$server_id = $GAME_SERVER;
$key = $API_SECURITY_TICKEY_LOGIN;
$time = $_REQUEST['time'];
$gkey = trim($_REQUEST['gkey']);
$sign = trim($_REQUEST['sign']);

if (empty($time) || empty($gkey) || empty($sign))
{
    echo -4;
    die();
}
else
{
    $token = md5($time . $key);
    if($token != $sign)
    {
        echo -3;
        die();
    }
}

$sql = "select count(t.is_online) as online from db_role_base_p as b left join db_role_ext_p as t on b.role_id = t.role_id where t.is_online = 1";
$list = $db->fetchOne($sql);
echo $list['online'];

