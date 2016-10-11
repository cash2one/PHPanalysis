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

//$cfgName = '/data/mccq/server/config//world/shop_shops.config';

//今天
//$date = date("y-m-d");
  
//昨天
$date = date("Y-m-d",strtotime(date("Y-m-d"))-86400);

if( $A_DEBUG) 
{
    //本地测试路径
    //$cfgName = 'E:/datang2/mge/config/world/shop_shops.config';
    
    $date = "2011-12-4";   
}


$dateStartStamp = strtotime($date . ' 0:0:0');
$dateEndStamp   = strtotime($date . ' 23:59:59');


function QueryOneDay($tStart,$tEnd)
{
    //这种写法是兼容 比如某类道具只有人用，没有人买
  $sql = "select * from ((select item_id ,-sum(item_num) as totaluse from t_log_item "
         ." where mtime between {$tStart} and {$tEnd} and mtype in(4002,4010) "
         ." group by item_id ) as A "
         ." left join ("
         ." select itemid,sum(amount) as totalbuy from t_log_use_gold "
         ." where mtime between {$tStart} and {$tEnd} and itemid >0 and gold_unbind>0 "
         ." group by itemid) as B "
         ." on item_id = itemid) "
         ." union "
         ." select * from ((select item_id ,-sum(item_num) as totaluse from t_log_item "
         ." where mtime between {$tStart} and {$tEnd} and mtype in(4002,4010) "
         ." group by item_id ) as A "
         ." right join ("
         ." select itemid,sum(amount) as totalbuy from t_log_use_gold "
         ." where mtime between {$tStart} and {$tEnd} and itemid >0 and gold_unbind>0 "
         ." group by itemid) as B"
         ." on item_id = itemid) "
         ;
    
     $result = GFetchRowSet($sql); 
     
     //make all key valid
     foreach ($result as $key => $value)
     {
         if($value['itemid'] == NULL)
            $value['itemid'] = $value['item_id'];
         if($value['totaluse'] == NULL)
            $value['totaluse'] = 0;
         if($value['totalbuy'] == NULL)
            $value['totalbuy'] = 0;
            
         $result[$key] = $value;
     }
     
     
     
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

function dumpToDayStatTable($result,$dateStartStamp)
{
    global $db;
    $sql =  "insert into t_stat_yb_item (mtime,itemID,price,buycount,usecount) values ";
    foreach ($result as  $key => $value )
    {
        //$str = sprintf("%d ,%d, %d,%s,%s" ,$value['date'],$value['itemid'],$value['price'],$value['totalbuy'],$value['totaluse']); 
       // $sql .= $str;
        $sql .= "({$value['date']},{$value['itemid']},{$value['price']},{$value['totalbuy']} ,{$value['totaluse']} ),";
    }
     
    //加一条结束dummy记录，确保只要执行过的都有至少都有1条数据，防止反复插入
    $sql .= "($dateStartStamp,0,0,0,0)";
     
    $db->query($sql);   

}

//确保只执行一次
function run_only_once($dateStartStamp)
{
    global $db; 
    $sql = "select count(itemid) as c from t_stat_yb_item where mtime = {$dateStartStamp} ";
   
    $result = $db->fetchOne($sql);
    if($result['c'] > 0)
    {
       die(); 
    }
}

run_only_once($dateStartStamp);

//$priceArray = loadShopCfg($cfgName) ;  
$priceArray = loadShopCfg() ;  


$result =  QueryOneDay($dateStartStamp,$dateEndStamp);

$result = bindExtra($result,$priceArray,$dateStartStamp);

dumpToDayStatTable($result,$dateStartStamp);
//insert into day table
  
?>
