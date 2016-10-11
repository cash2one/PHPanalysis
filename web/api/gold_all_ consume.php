  <?php
/**
 *  3.22    元宝/金币消耗记录接口
 * @author huangzan@4399.com
 * @date 2011.06.04
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 *
 *  返回数据：
 * 时间 ：mtime（unix时间戳，需要什么样的日期格式自己转）
 * 服务器id ：server_id
 * 当日消费元宝: used_gold
 * 当日新增元宝: new_gold
 * 当日赠送赠送元宝 :mail_gold
 * 剩余总元宝 : remain_gold
 * 
 *  返回
 * -1 缺少参数
 * -2 验证不通过
 */
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';

global $db ,$GAME_SERVER;  

//-1:参数不全 -2:验证失败
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);

if($A_DEBUG)
{
   $date = '2011-12-15'; 
   $time = time();
   $flag = md5($date . $time . $API_SECURITY_TICKET_DATA);
}

if (empty($date) || empty($time) || empty($flag) )
{
    echo(json_encode(-1));
    die();
}
{
    $token = md5($date . $time . $API_SECURITY_TICKET_DATA);
   //  echo $API_SECURITY_TICKET_DATA . $lastid . $time .'<br>';
    if($token != $flag) 
    {
        echo(json_encode(-2));
        die();
    }
}

$start_time = strtotime($date . ' 0:0:0');  
$end_time = $start_time + 86400;

$sql = "select {$GAME_SERVER} as serverid,mtime,used_gold,new_gold,mail_gold,remain_gold from t_stat_yb "
        . " where mtime = {$start_time}";
  
$result = $db->fetchOne($sql); 

echo json_encode($result);   
 
?>
