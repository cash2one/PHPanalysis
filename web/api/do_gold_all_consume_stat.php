<?php
  
 /**
 * 定时执行的 统计数据接口
 * @author neelkey@4399.com

 * 功能：每天定时执行，然后统计当日的道具使用情况，写入统计表
 */
  
define('IN_DATANG_SYSTEM', true);
include "../config/config.php"; 
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/api_global.php';

include SYSDIR_ADMIN.'/include/erlang_config_loader.php';  

global $db ,$GAME_SERVER;

global $A_DEBUG;

//今天
//$date = date("y-m-d");
  
//昨天
$date = date("Y-m-d",strtotime(date("Y-m-d"))-86400);

if( $A_DEBUG) 
{
    $date = "2011-12-15";   
}

$dateStartStamp = strtotime($date . ' 0:0:0');
$dateEndStamp   = strtotime($date . ' 23:59:59');

function QueryOneDay($tStart,$tEnd)
{
    //注意写法， 1.注意join的两表可能为空表返回null，因此表要确保有非null和默认值   
    //            2. 索引无法决定必须force index
    
    $sql = " insert into t_stat_yb (mtime,used_gold,new_gold,mail_gold,remain_gold) "
        ." select * from ((select {$tStart},sum(case  when gold_unbind>0 then gold_unbind else 0 end) as used_gold ,"
        ."-sum(case  when mtype = 4004 then gold_unbind else 0 end) as new_gold , "
        ."-sum(case  when mtype = 4001 then gold_unbind else 0 end) as mail_gold "
        ."from t_log_use_gold force index(mtime) "
        ." where mtype in (3003,3005,3007,3009,3010,3014,3015,3019,3020,4001,4004,4008,4017,4018,4019) "
        . " and mtime >= {$tStart} and mtime <= {$tEnd} )"
        ." as A join  (select sum(gold) as remain_gold from db_role_attr_p) as B)";
        
     global $db;
     $result = $db->query($sql); 
     
     return $result;
}

function bindExtra($result,$priceArray, $date)
{
     foreach ($result as  $key => $value )
     {
        $value['date'] = $date;
        
        $itemid = (int)$value['itemid'];
        $price = $priceArray[$itemid]!= NULL ? $priceArray[$itemid] : 0;
        
        $value['price'] = $price;
        
        $result[$key] = $value;
     }
     return $result;
}

//确保只执行一次
function run_only_once($dateStartStamp)
{
    global $db;
    $sql = "delete from t_stat_yb where mtime = {$dateStartStamp} ";
   
    $db->query($sql);
}

run_only_once($dateStartStamp);

QueryOneDay($dateStartStamp,$dateEndStamp);


//只统计下列情况（剔除掉玩家间流通，和已经废弃掉的系统的消费类型）
/*
-define(CONSUME_TYPE_GOLD_BUY_ITEM_FROM_SHOP,3003). %%系统商店购买道具
-define(CONSUME_TYPE_GOLD_RELIVE,3005).             %%复活失去元宝
-define(CONSUME_TYPE_GOLD_ALCHEMY,3007).             %%炼丹加速扣元宝
-define(CONSUME_TYPE_GOLD_ENTRUST_MISSION,3009).    %%委托任务消耗元宝 
-define(CONSUME_TYPE_GOLD_ENTRUST_MISSION_FINISH,3010).    %%立即完成委托任务消耗元宝
-define(CONSUME_TYPE_GOLD_OFFLINE_EXP, 3014).       %%获取离线经验扣除元宝
-define(CONSUME_TYPE_GOLD_TREASURE,3015).            %%寻宝消耗元宝
-define(CONSUME_TYPE_GOLD_ADD_DEPOT,3019).            %%开通仓库消耗元宝
-define(CONSUME_TYPE_GOLD_SLOT_GOLD_REFRESH,3020).    %%礼包刷新消耗元宝
-define(GAIN_TYPE_GOLD_GIVE_FROM_GM,4001).          %%GM后台赠送元宝 
-define(GAIN_TYPE_GOLD_FROM_PAY,4004).              %%通过充值获得元宝
-define(GAIN_TYPE_GOLD_ANSWER_EXPDOUBLE_USE,4008).              %%答题经验加倍使用元宝
-define(CONSUME_TYPE_GOLD_TREASURE_WASH_POINT,4017).    %%宝物技能洗点消耗元宝
-define(CONSUME_TYPE_GOLD_JADE_EXP_START,4018).    %%宠物历练扣除元宝
-define(CONSUME_TYPE_GOLD_JADE_EXP_SPEED,4019).    %%宠物历练加速扣除元宝
*/
  
?>
