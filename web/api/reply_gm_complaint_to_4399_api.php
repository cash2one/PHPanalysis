<?php
/**
 * 合作平台回应gm投诉数据
 * @author huangzan@4399.com
 * @date 2011.12.08
 * http://xxxxxxxxx/api/reply_gm_complaint_to_4399_api.php?id=xxx&server_id=xxx&account_name=xxxx&sender=GM001&time=xxx&reply=xxxxxx&sign=xxxxx    
 * 传入参数:

* id:         游戏服传过去的gm投诉信件id
* server_id:  区服id
* account_name： 投诉的玩家帐号？（需要么）
* sender：      GM回复人
* time：         回复时unix时间戳
* reply：   回复内容
* sign：      签名 md5(GM回复人 + 回复时间戳 +key)
* 
* 
*   返回： 
*  0 成功
* -1 缺少参数
* -2 验证不通过
* -3 server_id不对
* -4 信件id无效
*/

define('IN_DATANG_SYSTEM', true);
include "../config/config.php"; 
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';
global $db ,$GAME_SERVER;

global $A_DEBUG;

$id = trim($_REQUEST['id']);
$server_id = trim($_REQUEST['server_id']);
$account_name_encode = trim($_REQUEST['account_name']);
$sender   = trim($_REQUEST['sender']);
$reply_encode = trim($_REQUEST['reply']); 
$flag   = trim($_REQUEST['sign']);
$time   = trim($_REQUEST['time']);    

$use_test_gbk = false; //true 使用测试gbk，false使用utf8
if($A_DEBUG)
{
    $id = 1;
    $time   = time();    
    $account_name = "abc";
    $account_name_encode = "abc";
    $sender = "GM001";
    $server_id = 1000;
    
    if($use_test_gbk)
        $reply_encode = "%CE%D2%CA%C7%D6%D0%B9%FA%C8%CB"; //gbk 测试中文  我是中国人
    else
        $reply_encode = "%E6%88%91%E6%98%AF%E4%B8%AD%E5%9B%BD%E4%BA%BA"; //utf 测试中文 我是中国人  
    //$reply_encode = "AAAAAAAbbbbbbbbbAAAAAAAAA";
    $flag   = md5($sender . $time .$API_SECURITY_TICKET_DATA);            
}

//中文部分用了urlencode处理
$account_name = urldecode($account_name_encode);
$reply = urldecode($reply_encode);

if (empty($id) || empty($time) || empty($flag) || empty($reply) || empty($sender) || empty($server_id)
// || empty($account_name)
  )
{
    echo(json_encode(-1));
    die();
}
else if ((int)$server_id != $GAME_SERVER )
{
    echo(json_encode(-3));   
    die(); 
}
else
{
    $token = md5($sender . $time . $API_SECURITY_TICKET_DATA);
   //  echo $API_SECURITY_TICKET_DATA . $lastid . $time .'<br>';
    if($token != $flag) 
    {
        echo(json_encode(-2));
        die();
    }
}
$sql = "select roleid,account_name from t_GM_Complaint where id={$id}" ;
$result = $db->fetchAll($sql);
$role = $result[0];
$rid =  (int)$role['roleid'];
$rname = $role['role_name'];
$accname =  $role['account_name']; 
//$oldcon =  $role['content'];     

if(empty($rid) )
{
    echo(json_encode(-4));
    die();
}

//发送信件
$result = getJson ( $erlangWebAdminHost . "email/send_email/" .
    "?role_id={$rid}&role_name=''&content={$reply_encode}" );

$reply = str_replace("'", "\\'", $reply); // 过滤 '
$reply = str_replace("\"", "\\\"", $reply);  // 过滤 "
$reply = str_replace("\\", "\\\\", $reply);  // 过滤 \
   
//调试模式用的是一串gbk的测试中文
if($A_DEBUG && $use_test_gbk)
{  
    $sql = "set names gbk";
    $db->query($sql);  
}


$sql = "update {$dbConfig['dbname']}.t_GM_Complaint set reply='{$reply}',state=1 where id={$id}" ;

$db->query($sql);


//以为可以直接调用reply.php不过不合适，放弃了
/*$url =  "../admin/module/gm/reply.php";
$args = "id={$id}&rold_id={$rid}&role_name={$rname}&content={$reply}";

function request_by_curl($remote_server,$post_string)
{  
    $ch = curl_init();  
    curl_setopt($ch,CURLOPT_URL,$remote_server);  
    curl_setopt($ch,CURLOPT_POSTFIELDS,'mypost='.$post_string); 
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);  
    curl_setopt($ch,CURLOPT_USERAGENT,"Example beta");  
    $data = curl_exec($ch);  
    curl_close($ch);  
    return $data;  
}    */


echo(json_encode(1));      
?>
