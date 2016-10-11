<?php
/**
 * Created by PhpStorm.
 * User: tonyzhang
 * Date: 2015/10/22
 * Time: 10:29
 */

define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db;


//http://www.xxx.com/xx.php?game=ddt&server=s1&time=1272345638200&sign=40CF59575DD14DFFC651C4BABF96D4DA&date=20130116

$game = $_REQUEST['game'];
$server = $_REQUEST['server'];
$time = $_REQUEST['time'];
$sign = $_REQUEST['sign'];
$date = $_REQUEST['date'];
$key = $API_SECURITY_TICKEY_LOGIN;
$newTime = time();
$request = array();

//链接失效
if(($newTime-$time) > 300){
    $request = array(
        'retcode' => -1
    );
    echo json_encode($request);
    die();
}
else
{
    $token = strtoupper(md5($game.$server.$time.$key));

    if($token != $sign){
        $request = array(
            'retcode' => -1
        );
        echo json_encode($request);
        die();
    }
    else
    {
        $startTime = strtotime($date);
        $endTime = $startTime + 86400;

        $sql = "select count(*) as count from db_role_base_p WHERE create_time>" . $startTime ." and create_time<" . $endTime;
        $create = $db->fetchAll($sql);
        $createNum = $create[0]['count'];

        $sql_login = "select count(*) as count from db_role_base_p B left join db_role_ext_p E on B.role_id = E.role_id WHERE E.last_login_time>{$startTime} and E.last_login_time<{$endTime}";

        $login = $db->fetchAll($sql_login);
        $loginNum = $login[0]['count'];

        $dateStartStamp = strtotime($date . ' 0:0:0');
        $year = date('Y', $dateStartStamp);
        $month = date('m', $dateStartStamp);
        $day = date('d', $dateStartStamp);

        //当日最高在线
        $sql = 'SELECT max(online) as maxNum FROM `t_log_online` '
            . ' WHERE year=' .
            $year .
            ' and month=' .
            $month .
            ' and day=' .
            $day;
        $max_online = $db->fetchAll($sql);
        $maxOnline = $max_online[0]['maxNum'];

        $request = array(
            'retcode' => 1,
            'data' => array(
                'roleTotal' => $createNum,
                'loginTotal' => $loginNum,
                'maxOnline' => $maxOnline
            )
        );

        echo json_encode($request);

    }
}






