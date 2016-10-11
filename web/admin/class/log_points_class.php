<?php

/*
 * 积分的使用、获得记录
 */

if (!defined('INCLUDE_CLASS_LOG_SILVER_CLASS_PHP_FILE')) {
	define('INCLUDE_CLASS_LOG_SILVER_CLASS_PHP_FILE', true);

//	if (!defined('INCLUDE_CLASS_DATABASE_PHP_FILE')) {
//		include SYSDIR_ADMIN . "/class/db.class.php";
//	}

	class LogPointsClass {
		
		const TYPE_BUY_ITEM			= 9001;		//系统商店购买道具
        var $item_list = array();

       

       function __construct()
      {
		    $sql = "SELECT `id` , `name` FROM `t_PGoods` ";
		    $arr = GFetchRowSet($sql);
			$arrnew = array();
			foreach ($arr as $v1){
                $arrnew[$v1[id]] = $v1[name];
			}
           $this->item_list = $arrnew;
     }



		public static function GetTypeList() {
			return array (
				8001=>'充值获得积分',
				8002=>'使用道具获得积分',
				9001=>'商城消费',
			);
		} 

		//指定玩家的购买历史记录统计
		public static function getBuyLogStats($userid, $timeStampStart = null, $timeStampEnd = null) {
			if(!$userid){
				$sql = "SELECT `itemid`, `mdetail`, SUM(`amount`) as amount, SUM(`points`) as points "
					. " FROM `t_log_use_points` WHERE `mtype`=" . self::TYPE_BUY_ITEM;
				
				if ($timeStampStart)
					$sql .= " AND `mtime` >= {$timeStampStart} ";
				if ($timeStampEnd)
					$sql .= " AND `mtime` <= {$timeStampEnd} ";
				
				$sql .= " GROUP BY `itemid` ORDER BY `points` desc, `amount` desc;";
			
			} else {
				$sql = "SELECT `itemid`, `mdetail`, SUM(`amount`) as amount, SUM(`points`) as points "
					. " FROM `t_log_use_points` WHERE `mtype`=" . self::TYPE_BUY_ITEM
					. " AND `user_id`={$userid} "
					. " GROUP BY `itemid` ORDER BY `points` desc, `amount` desc;";
			}
			$rs = GFetchRowSet($sql);
			
			return $rs;
		}
		

		
	
		
		
		
		
		

	}

}