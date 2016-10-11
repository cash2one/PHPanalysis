<?php

/*
 * 银两的使用、获得记录
 */

if (!defined('INCLUDE_CLASS_LOG_SILVER_CLASS_PHP_FILE')) {
	define('INCLUDE_CLASS_LOG_SILVER_CLASS_PHP_FILE', true);

//	if (!defined('INCLUDE_CLASS_DATABASE_PHP_FILE')) {
//		include SYSDIR_ADMIN . "/class/db.class.php";
//	}

	class LogSilverClass {
		
		const TYPE_BUY_ITEM			= 1002;		//系统商店购买道具

		public static function GetTypeList() {
			global $buf_lang;
			return array (
				//消费
				1001=>$buf_lang['log'][1001],
				1002=>$buf_lang['log'][1002],
				1003=>$buf_lang['log'][1003],
				1004=>$buf_lang['log'][1004],
				1005=>$buf_lang['log'][1005],
				1006=>$buf_lang['log'][1006],
				1007=>$buf_lang['log'][1007],
				1008=>$buf_lang['log'][1008],
				1009=>$buf_lang['log'][1009],
				1010=>$buf_lang['log'][1010],
				1011=>$buf_lang['log'][1011],
				1012=>$buf_lang['log'][1012],
				1013=>$buf_lang['log'][1013],
				1014=>$buf_lang['log'][1014],
				1015=>$buf_lang['log'][1015],
				1024=>$buf_lang['log'][1024],
				1025=>$buf_lang['log'][1025],
				1026=>$buf_lang['log'][1026],
				1027=>$buf_lang['log'][1027],

				//获得
				2001=>$buf_lang['log'][2001],
				2002=>$buf_lang['log'][2002],
				2003=>$buf_lang['log'][2003],
				2004=>$buf_lang['log'][2004],
				2005=>$buf_lang['log'][2005],
				2006=>$buf_lang['log'][2006],
				2007=>$buf_lang['log'][2007],
				2008=>$buf_lang['log'][2008],
				2009=>$buf_lang['log'][2009],

				2042=>$buf_lang['log'][2042],
				2043=>$buf_lang['log'][2043],

                3023=>$buf_lang['log'][3023],
                3036=>$buf_lang['log'][3036]
			);
		} 

		public static function GetTypeName($typeid) {
			$arr = self :: GetTypeList();
			if (isset ($arr[$typeid]))
				return $arr[$typeid];
			else
				return '未知';
		}

		/*
		 * 获得所有消耗类型的操作(银两使用日志类型)
		 *
		 * 如果银两使用后，就消失了（系统回收了），则这种操作属于消耗类型
		 * 但是类似玩家之间交易，或者玩家在市场上花银两买东西，则不属于消耗，
		 * 因为银两只是从一个玩家跑到另外一个玩家帐号里去而已。
		 */
		public static function GetConsumeTypeList() {
			
			$data = self :: GetTypeList();
			
			foreach($data as $k=>$v){
				if( intval($k/1000) == 2 ){
					unset($data[$k]);
				}
			}
			
			//删掉流通类型
			unset($data[1003]);
			unset($data[1004]);
			unset($data[1006]);
    		
			return $data;
		}

		/*
		 * 获得所有 非消耗类型的操作
		 */
		public static function GetNotConsumeTypeList() {
			$data = self :: GetConsumeTypeList();
			$all = self :: GetTypeList();

			//根据KEY计算数组差集
			return array_diff_key($all, $data);
		}

		//指定玩家的购买历史记录统计
		public static function getBuyLogStats($userid, $timeStampStart = null, $timeStampEnd = null) {
			if(!$userid){
				$sql = "SELECT `itemid`, `mdetail`, SUM(`amount`) as amount, SUM(`silver_unbind`) as silver_unbind, SUM(`silver_bind`) as silver_bind "
					. " FROM `t_log_use_silver` WHERE `mtype`=" . self::TYPE_BUY_ITEM;
				
				if ($timeStampStart) $sql .= " AND `mtime` >= {$timeStampStart} ";
                if ($timeStampEnd) $sql .= " AND `mtime` <= {$timeStampEnd} ";
                $sql .= " GROUP BY `itemid` ORDER BY `silver_unbind` desc, `amount` desc;";
            } else {
                $sql = "SELECT `itemid`, `mdetail`, SUM(`amount`) as amount, SUM(`silver_unbind`) as silver_unbind, SUM(`silver_bind`) as silver_bind "
                        . " FROM `t_log_use_silver` WHERE `mtype`=" . self::TYPE_BUY_ITEM
                        . " AND `user_id`={$userid} ";

                if ($timeStampStart)$sql .= " AND `mtime` >= {$timeStampStart} ";
                if ($timeStampEnd) $sql .= " AND `mtime` <= {$timeStampEnd} ";

                $sql.= " GROUP BY `itemid` ORDER BY `silver_unbind` desc, `amount` desc;";
            }
            $rs = GFetchRowSet($sql);
			
			return $rs;
		}

	}

}