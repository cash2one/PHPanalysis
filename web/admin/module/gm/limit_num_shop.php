<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ROOT_CLIENT.'config/config.key.php';
include SYSDIR_ADMIN.'/include/global.php';
global $smarty, $db;

function doQueryGoods()
{
    global $smarty,$erlangWebAdminHost,$db;
    $result = getJson ( $erlangWebAdminHost."gm/get_limit_shop_goods/"); 
    //debug
    //$str = "!!!!!!!!!!! doQueryGoods";
//    foreach($result as $goods)
//    {  
//        //-record(r_panic_goods, {goods_id, remain_num, goods_info}).
//        $gid = $goods['goods_id'];
//        $gnum= $goods['remain_num'];
//        $gname = $goods['gname'];
//        $gnamestr= "";
//        $gname2 = $gname[0] ;
//        foreach($gname as $code)
//        {
//          // $k =  sprintf("%c",$code);
//           $k = chr($k);
//          $gnamestr .= sprintf("%c",$code); 
//        }
//        //$gnamestr = implode('',$gname2);
//        $a = 100;
//       //$str .= "   gid {$gid} gnum {$gnum} "; 
//    }
    //infoExit($str);
    
    $result_time = getJson($erlangWebAdminHost."gm/get_limit_shop_lefttime/");
    $leftT = $result_time[0]['left_time'];
    $leftTStr = sprintf("  剩余时间 [%d:%d:%d]" ,$leftT/3600,$leftT/60%60,$leftT%60);
    $limit_end_time = date('Y-m-d H:i:s',time()+$leftT);
    if($leftT==0)
        $limit_end_time = '';
    $sql = 'select * from limit_buy_goods where num>0';
    $goods_result = $db->fetchAll($sql);
    foreach($goods_result as $value){
        $goods_total[$value['goods_id']] = $value['num'];
    }
    foreach($result as $k => $v){
        $goods_id = $v['goods_id'];
        $goods_num = $v['remain_num'];
        if(isset($goods_total[$v['goods_id']]))
                $result[$k]['sell_num'] = $goods_total[$goods_id]-$goods_num;
        else {
            $result[$k]['sell_num'] = 0;
            $sql = " insert into limit_buy_goods(goods_id,num) value($goods_id,$goods_num)";
            $db->query($sql);
        }
    }
    
    $smarty->assign("shop_left_time",$leftTStr);
    $smarty->assign("limit_end_time", $limit_end_time);
    $smarty->assign("cur_sell_items", $result);
}

if ( !isset($_REQUEST['start_time'])){
	$start_time = strftime("%Y-%m-%d %H:%M:%S",time());
}
else
{
	$start_time  = trim(SS($_REQUEST['start_time']));
}

if ( !isset($_REQUEST['end_time']))
{
	$end_time = strftime ("%Y-%m-%d %H:%M:%S", time()+86400 );
}
else
{
	$end_time = trim(SS($_REQUEST['end_time']));
}

//限量抢购商城道具列表
$need_item_data =  $_REQUEST['item'];
if (empty($need_item_data))
{
	$need_item_data = array();
}


$action = trim($_GET['action']);
if ($action == 'doAddItem')
{
	$item_id = intval (SS($_REQUEST ['item_id']));
	$item_num = intval (SS($_REQUEST ['item_num']));
	if($item_id <= 0)
	{
		errorExit("请填写道具ID！");
	}
	if($item_num <= 0)
	{
		errorExit("道具数量必须大于0");
	}
	if (!empty($need_item_data))
	{
		foreach ($need_item_data as $key => $value)
		{
			if ($key == $item_id)
			{
				errorExit("道具ID重复！");
			}
		}
	}
	$item_tmp = array(
		$item_id => array('item_id' => $item_id, 'item_num' => $item_num),
	);
	$need_item_data = array_merge($need_item_data, $item_tmp);
}
else if ($action == 'doRemoveItem')
{
	$remove_item_id = intval (SS($_REQUEST ['remove_item_id']));
	unset($need_item_data[$remove_item_id]);
}
else if ($action == 'doOpenLimitShop')
{
	$dateStartStamp = strtotime($start_time);
	$dateEndStamp   = strtotime($end_time);
	$result = getJson ( $erlangWebAdminHost."gm/set_limit_shop_time/?start_time={$dateStartStamp}&end_time={$dateEndStamp}");
	if ($result['result']=='ok') 
	{
		infoExit("开启限量抢购商城成功");
	}
	else
	{
		errorExit ( "开启限量抢购商城失败" );
	}
}
else if ($action == 'doCloseLimitShop')
{
	$dateStartStamp = time() - 86400;
	$dateEndStamp   = time() - 86400;
	$result = getJson ( $erlangWebAdminHost."gm/set_limit_shop_time/?start_time={$dateStartStamp}&end_time={$dateEndStamp}");
	if ($result['result']=='ok') 
	{
		infoExit("关闭限量抢购商城成功");
	}
	else
	{
		errorExit ("关闭限量抢购商城失败" );
	}
}
else if ($action == 'doClearLimitShop')
{
	$result = getJson ( $erlangWebAdminHost."gm/clear_limit_shop/");
	if ($result['result']=='ok') 
	{
            $sql = 'delete from limit_buy_goods ';
            $db->query($sql);
		infoExit("清空限量抢购商城的商品成功");
	}
	else
	{
		errorExit ("清空限量抢购商城的商品失败" );
	}
}
else if ($action == 'doAddGoods')
{
	$item_str = '';
	if(!empty($need_item_data))
	{
		$comma_flag = false;
		foreach($need_item_data as $key => $value)
		{
			if ($comma_flag)
			{
				$item_str .= ",";
			}
			$item_str .= "{".$value['item_id'].",".$value['item_num']."}";
			$comma_flag = true;
		}
	}
	else
	{
		errorExit ("请添加道具" );
	}
        
	$goods_str = "[".$item_str."]";
	$result = getJson ( $erlangWebAdminHost."gm/add_limit_shop/?good_list={$goods_str}");
       
	if ($result['result']=='ok') 
	{

            foreach($need_item_data as $key => $value){
                $item_id = $value['item_id'];
                $item_num = $value['item_num'];
                $sql =  "insert into limit_buy_goods (goods_id,num) values($item_id,$item_num) on duplicate key update  num=num+$item_num";
                $db->query($sql);
            }
		infoExit("添加商品到限量抢购商城成功", "limit_num_shop.php");
	}
	else
	{
		errorExit ("添加商品到限量抢购商城失败" );
	}
}
else if ($action == 'doDeleteGoods')
{
	$item_str = '';
	if(!empty($need_item_data))
	{
		$comma_flag = false;
		foreach($need_item_data as $key => $value)
		{
			if ($comma_flag)
			{
				$item_str .= ",";
			}
			$item_str .= "{".$value['item_id'].",".$value['item_num']."}";
			$comma_flag = true;
		}
	}
	else
	{
		errorExit ("请添加道具" );
	}
	$goods_str = "[".$item_str."]";
	$result = getJson ( $erlangWebAdminHost."gm/delete_limit_shop/?good_list={$goods_str}");
	if ($result['result']=='ok') 
	{
            foreach($need_item_data as $key => $value){
                $item_id = $value['item_id'];
                $item_num = $value['item_num'];
                $sql =  "update limit_buy_goods set num=num-$item_num where goods_id=$item_id";
                $db->query($sql);
            }
            $db->query('delete from limit_buy_goods where num<=0');
            
		infoExit("删除限量抢购商城的商品成功", "limit_num_shop.php");
	}
	else
	{
		errorExit ("删除限量抢购商城的商品失败" );
	}
}
//debug codes
//else if ($action == 'doQueryGoods') 
//{
   // $result = getJson ( $erlangWebAdminHost."gm/get_limit_shop_goods/"); 
   // foreach($result as $goods) {  $gid = $goods['goods_id']; $gnum= $goods['remain_num'];}
   // $smarty->assign("cur_sell_items", $result);    
//}
doQueryGoods();  

$need_item_data = array_merge($need_item_data, array());
$smarty->assign("start_time", $start_time);
$smarty->assign("end_time", $end_time);
$smarty->assign("need_item", $need_item_data);
$smarty->display("module/gm/limit_num_shop.html");

