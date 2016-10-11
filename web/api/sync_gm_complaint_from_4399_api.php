<?php
  /**
 * 合作平台请求同步gm投诉数据
 * @author huangzan@4399.com
 * @date 2011.12.08
 * http://xxx.my4399.com/sync_gm_complaint_from_4399_api.php?time=xxx&flag=xxx&lastid=xxxx   (xxx.my4399.com为游戏服域名)
 * 传入参数:
 *       time= UNIX时间戳
 *       flag=md5(latid+time+key)
 *       lastid 上一次同步的最后一条记录id，如果从没有同步过，那么必须传-1而不是0（防止误填空参数） 
 * 返回JSON格式，其中字段
* id        GM信件id
* type      GM信件类型，中文
* username  用户账号
* title     GM信件标题  
* content   GM信件内容
* server_id  服务器id,平台下次回复gm投诉邮件时候需要对应填入此参数
* 
* 错误时
* -1 缺少参数
* -2 验证不通过
* -4 lastid之后，没有新的数据
*/
define('IN_DATANG_SYSTEM', true);
include "../config/config.php"; 
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db ,$GAME_SERVER;

global $A_DEBUG;
 
//-1:参数不全 -2:验证失败
$lastid = trim($_REQUEST['lastid']);
$time   = trim($_REQUEST['time']);
$flag   = trim($_REQUEST['flag']);

//debug 
if($A_DEBUG)
{
    $lastid = "5" ;
    $time   = time();
    $flag   = md5($lastid . $time .$API_SECURITY_TICKET_DATA  );   
}

if (empty($lastid) || empty($time) || empty($flag))
{
    echo(json_encode(-1));
    die();
}
else
{
    $token = md5($lastid . $time . $API_SECURITY_TICKET_DATA);
   //  echo $API_SECURITY_TICKET_DATA . $lastid . $time .'<br>';
    if($token != $flag) 
    {
        echo(json_encode(-2));
        die();
    }
}


$sql = "SELECT id, type, account_name, title, content,{$GAME_SERVER} as server_id FROM t_GM_Complaint where id> {$lastid} " ;
//$keynames = array("id","type", "account_name", "title", "content")  ;   
//$sql = "SELECT ";
//foreach($keynames as $k)
//   $sql = $sql .  $k .",";
//$sql .= "{$GAME_SERVER} as server_id FROM t_GM_Complaint where id> {$lastid} "; 

$result = GFetchRowSet($sql);
if(count($result) == 0)
{
   echo(json_encode(-4));
   die();
}

echo json_encode($result);   

?>
