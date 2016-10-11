<?php
/**
 * Created by PhpStorm.
 * User: Tonyzhang
 * Date: 2015/10/27
 * Time: 16:27
 */


define('IN_DATANG_SYSTEM', true);
include "../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


$name = $_REQUEST['guid'];
$sign = $_REQUEST['sign'];
$key = '123456';
$serverHOST = $_SERVER['HTTP_HOST'];

$token = md5($name.$serverHOST.$key);
$request = array();
if($token != $sign){
    $request = array(
        'status' => 1,
        'msg' => "签名错误"
    );
    echo json_encode(url_encode($request));
}
else
{
    $sql = "select A.vip_level from db_role_attr_p A left join db_role_base_p B on A.role_id = B.role_id where B.account_name=".$name;
    $role = $db->fetchOne($sql);
    $vipLevel = $role['vip_level'];
    $request = array(
        'status' => 0,
        'memberVip' => $vipLevel
    );
    echo json_encode($request);
}





//=============================华丽分割线==================================


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





