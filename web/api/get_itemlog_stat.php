<?php
  /**
 * 3.20    道具消耗记录接口 
 * @author neelkey@4399.com
 * @date 2011.06.04
 * 传入参数:date=YYYY-MM-DD
 *       time= UNIX时间戳
 *       flag=md5(date+time+key)
 * 返回：json数组
 * 道具ID ：itemID,
 * 道具名称，name,
 * 今天购买消耗的元宝：todaycostyb 
 * 今天消耗个数，todayuse ，
 * 总消耗元宝 ,totalcostyb, 
 * 总消耗道具数，totaluse,
 * 当前商场的该道具单价, price
 * 
 *  错误：
 *  -1 缺少参数
 * -2 验证不通过
 */
define('IN_DATANG_SYSTEM', true);
include "../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';

include SYSDIR_ADMIN.'/include/erlang_config_loader.php';   

global $db;

//-1:参数不全 -2:验证失败
$date = trim($_REQUEST['date']);
$time = trim($_REQUEST['time']);
$flag = trim($_REQUEST['flag']);



if($A_DEBUG)
{
   $date = '2011-12-14'; 
   $time = time();
   $flag = md5($date . $time . $API_SECURITY_TICKET_DATA);
}

$today = strtotime($date . ' 0:0:0');      

if (empty($date) || empty($time) || empty($flag) )
{
    echo(json_encode(-1));
    die();
}
else
{
    $token =md5($date . $time . $API_SECURITY_TICKET_DATA); 
   //  echo $API_SECURITY_TICKET_DATA . $lastid . $time .'<br>';
    if($token != $flag) 
    {
        echo(json_encode(-2));
        die();
    }
}

$sql = "select mtime ,itemID ,(case when mtime={$today} then buycount*price else 0 end) as todaycostyb ,"
       ." (case when mtime={$today} then usecount else 0 end) as todayuse, "
       ." sum(buycount*price) as totalcostyb, sum(usecount) as totaluse,name "
       ." from (t_stat_yb_item left join t_PGoods on t_PGoods.id = itemID)"
       ." where itemID <>0 and mtime<={$today} group by itemID" ;
       
$result = GFetchRowSet($sql);   
 
 //现在物品日志
//$ItemBase = loadItemcfg_Base(); 
//$StoneBase = loadStoneCfg_Base();
//$AllBase = array_merge($ItemBase,$StoneBase);

//$a = count($ItemBase);
//$b = count($StoneBase);
//$c = count($AllBase);
foreach($result as $key => $val)
{
//   $val['name'] = $ItemBase[(int)$val['itemID']]['name'];
  //  $result[$key] = $val;
    if ($val['name'] == NULL)
    {
        $val['name'] = "UnknownItem";
        $result[$key] = $val;
    }
}  
 
 echo json_encode($result);  
?>
