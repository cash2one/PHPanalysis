<?php

if ( ! defined('INCLUDE_CLASS_LOG_GOLD_CLASS_PHP_FILE') )
{
    define('INCLUDE_CLASS_LOG_GOLD_CLASS_PHP_FILE', 1);
	

class LogGoldClass
{
	const TYPE_BUY_ITEM			= 3002;		//系统商店购买道具

	public static function GetTypeName($typeid)
	{
		$arr = LogGoldClass::GetTypeList();
		if (isset($arr[$typeid]))
			return $arr[$typeid];
		else
			return '未知';
	}

        //添加类型后，如果是消费类型请在getSpendTypeList()函数中也一起添加
	public static function GetTypeList(){
		global $buf_lang;
		return 	array(
			1011=>$buf_lang['log'][1011],
			2016=>$buf_lang['log'][2016],
			2018=>$buf_lang['log'][2018],

            //===3000开始为 消费类型,元宝消耗    ===
			3001=>$buf_lang['log'][3001],
			3002=>$buf_lang['log'][3002],
			3003=>$buf_lang['log'][3003],
			3004=>$buf_lang['log'][3004],
			3005=>$buf_lang['log'][3005],
			3012=>$buf_lang['log'][3012],
			3013=>$buf_lang['log'][3013],
			3014=>$buf_lang['log'][3014],
			3015=>$buf_lang['log'][3015],
			3017=>$buf_lang['log'][3017],
			3018=>$buf_lang['log'][3018],
			3019=>$buf_lang['log'][3019],
			3020=>$buf_lang['log'][3020],
			3021=>$buf_lang['log'][3021],
			3022=>$buf_lang['log'][3022],
			3023=>$buf_lang['log'][3023],
			3024=>$buf_lang['log'][3024],
			3025=>$buf_lang['log'][3025],
			3026=>$buf_lang['log'][3026],
			3027=>$buf_lang['log'][3027],
			3028=>$buf_lang['log'][3028],
            3029=>$buf_lang['log'][3029],
            3030=>$buf_lang['log'][3030],
            3031=>$buf_lang['log'][3031],
            1012=>$buf_lang['log'][1012],


			//====4000 开始为元宝获取    ====
			4001 => $buf_lang['log'][4001],
			4003 => $buf_lang['log'][4003],
			4004 => $buf_lang['log'][4004],
			4005 => $buf_lang['log'][4005],
            4006 => $buf_lang['log'][4006],
            4007 => $buf_lang['log'][4007],

			7001=>$buf_lang['log'][7001],
			10001=>$buf_lang['log'][10001],
			10002=>$buf_lang['log'][10002],
			12001=>$buf_lang['log'][12001],
			13001=>$buf_lang['log'][13001],
			14001=>$buf_lang['log'][14001],	
			14002=>$buf_lang['log'][14002],	
		);
	}			
	
	/**
	 * 哪些元宝开支被算入"消费"统计
	 * 用于消费统计
         * 增加新的消费类型请在群组里说一声
	 */
	public static function getSpendTypeList() {
		return 	array(

			//消费		
            3001=>'GM后台扣除元宝',
            3002=>'系统商店购买道具',
            3003=>'复活失去元宝',
            3004=>'委托任务扣除元宝',
            3005=>'立即完成委托任务扣除元宝',
            3012=>'开通仓库消耗元宝',
            3013=>'自由传送扣元宝',
            3014 => '装备传承消耗元宝',
            3015 => '国家捐赠消耗元宝',
            3017 => '创建家族扣除元宝',
            3018 => '家族捐款的扣元宝',
            3019 => '刷新日常任务消耗元宝',
            3020 => '立即完成日常任务消耗元宝',
            3021 => '车夫扣除金币',
            3022 => '资源找回消耗元宝',
            3023 => '每日任务',
            3024 => '坐骑升星',
            3025 => '经验副本',
            //3026 => '交易失去元宝',
            3027 => '刷新镖车',
            3028 => '寻宝',
            3029 => '宝石升级',
            3030 => '膜拜刷新橙色奖励',
            3031 => '开服活动元宝领取奖励',
            3032 => '升级武将星级',
            3033 => '经验副本领取经验消耗元宝',
            3034 => '使用道具消耗元宝',
            3035 => '每日签到补签消耗元宝',
            3036 => '宝石开孔',
            3037 => '领取离线经验消耗元宝',
            3038 => '摇钱树花费元宝获取宝石',
            3039 => '摇钱树花费元宝获取礼金',
            3040 => '摇钱树花费元宝获取银两',
            10025 => '投资计划',
            10026 => '国运转盘',
            10016 => '坐骑升星',
            10017 => '坐骑升阶',
            1012 => '装备强化',

            //4001 =>'GM后台赠送元宝',
            //4003 =>'通过充值获得元宝',
            //4004 =>'把物品出售给npc商店',
            //4005 =>'使用道具获得元宝',
            //4006 =>'答题经验加倍使用元宝',
            //4007 => '交易',

			//7001=>'竞技场挑战消耗元宝',
			//10001=>'刷新日常任务消耗元宝',
			//10002=>'立即完成日常任务消耗元宝',
			//12001=>'过关斩将翻牌消耗元宝',
			//13001=>'祭拜消耗金币',
			//14001=>'阵法强化买参阅值消耗元宝',
			//14002=>'阵法强化锁定属性消耗元宝',
		);
	}
	
    /*
     * 获得所有消耗类型的操作(元宝使用日志类型)
     *
     * 如果元宝使用后，就消失了（系统回收了），则这种操作属于消耗类型
     * 但是类似玩家之间交易，或者玩家在市场上花元宝买东西，则这种属于流通类型
     * 					因为元宝只是从一个玩家跑到另外一个玩家帐号里去而已。
     * 如果元宝是从充值，或者GM后台赠送等，则这种属于新增类型。
     */
    public static function GetConsumeTypeList()
    {
    	$all = self::GetTypeList();
		$gain = self::GetGainTypeList();
    	$circulated = self::GetCirculatedTypeList();

    	foreach($gain as $k=>$v)
    		unset($all[$k]);
    	foreach($circulated as $k=>$v)
    		unset($all[$k]);

    	//根据KEY计算数组差集
    	// 消耗类型 = 所有类型  - 新增类型 - 流通类型
    	return $all;

//		unset($data[self::TYPE_MARKET_BUY_ITEM]);
//		unset($data[self::TYPE_HERO_TRAINING_REFUND]);
//		unset($data[self::TYPE_GAIN_PAY_GOLD]);
//		unset($data[self::TYPE_GAIN_EXCHANGE]);
//		unset($data[self::TYPE_LOSE_EXCHANGE]);
//		unset($data[self::TYPE_GAIN_MARKET_SELL]);
//		unset($data[self::TYPE_GAIN_USE_ITEM]);
//		unset($data[self::TYPE_GAIN_GM_GIVE]);
//		unset($data[self::TYPE_SELL_ITEM]);
//
//		return $data;
    }

    /*
     * 获得所有新增类型的操作(元宝使用日志类型)
     */
    public static function GetGainTypeList()
    {
    	$data = array(
    			2016,
    			2018,
    			4001,
    			4002,
    			4004,
    			4005
    			);
    	return array_flip($data);	//返回的数组下标是各个类型的ID值，而数组项的值，请忽略

    }

    /*
     * 获得所有 流通类型的操作
     */
    public static function GetCirculatedTypeList()
    {
    	$data = array(
    			3002,
    			4003
    			);
    	return array_flip($data);   //返回的数组下标是各个类型的ID值，而数组项的值，请忽略
    }

	/**
	 * 查询[start, end]期间"消费量"达到sum值的玩家的数量
	 * @return array((`user_id`=>UserID, `gold_spent`=>GoldSpent), ...)
	 */
	public static function filterSpentSumInTimespan($start, $end, $sum) {
		$_uid_arr = array();
		$sql = "SELECT `user_id`, SUM(`use_gold`) AS `gold_spent` FROM `t_log_use_gold` WHERE `mtime`>=" . $start  ." AND `mtime`<=" . $end . " AND ";
		if($types = self::getSpendTypeList()) {
			$sql .= "(";
			foreach($types as $mtype => $_desc) {
				$sql .= "`mtype`=$mtype or ";
			}
			$sql = trim($sql, " or ");
			$sql .= ") ";
			$sql .= "GROUP BY `user_id` HAVING SUM(`use_gold`)>=" . $sum;
			$_uid_arr = GFetchRowSet($sql);
		}
		return $_uid_arr;
	}


	/**
	 * 查询[start, end]期间玩家充值元宝量
	 */
	public function getPaySumInTimespan($start, $end) {
		$sql = "select sum(`pay_gold`) as G from `tlog_pay` where `user_id`=" . $this->userid . " and ";
		if($start)
			$sql .= " `mtime`>=$start and ";
		if($end)
			$sql .= " `mtime`<=$end ";
		$sql = trim($sql, "and ");
		$rs = GFetchRowOne($sql);
		return intval($rs['G']);
	}

	/**
	 * 查询[start, end]期间玩家充值和被给予的元宝量
	 */
	public function getPayAndGivenSumInTimespan($start, $end) {
		$sql = "select sum(`pay_gold`) as G1, sum(`give_gold`) as G2 from `tlog_pay` where `user_id`=" . $this->userid . " and ";
		if($start)
			$sql .= " `mtime`>=$start and ";
		if($end)
			$sql .= " `mtime`<=$end ";
		$sql = trim($sql, "and ");
		$rs = GFetchRowOne($sql);
		return intval($rs['G1'] + $rs['G2']);
	}
	
	/**
	 * 查询[start, end]期间玩家消费的元宝量
	 */
	public function getSpentSumInTimespan($start, $end) {
		global $cache;
		$cache_key = GUserGoldSpentInTimespan . $this->userid;
		$rs = $cache->fetch($cache_key);
		if(!is_array($rs))
			$rs = array();
		if($rs['start'] != $start || $rs['end'] != $end) {
			$sum = array();
			if($types = self::getSpendTypeList()) {
				$sql = "select sum(`use_gold`) as g from `t_log_use_gold` where `user_id`=" . $this->userid . " and ";
				if($start)
					$sql .= " `mtime`>=$start and ";
				if($end)
					$sql .= " `mtime`<=$end and ";
				$sql .= "(";
				foreach($types as $mtype => $_desc) {
					$sql .= "`mtype`=$mtype or ";
				}
				$sql = trim($sql, " or ");
				$sql .= ") ";
				$sum = GFetchRowOne($sql);
			}
			$rs = array('start' => $start, 'end' => $end, 'sum' => intval($sum['g']));
			$cache->store($cache_key, $rs);
		}
		return $rs['sum'];
	}
	
	/**
	 * 清空消费量缓存
	 */
//	public static function clearSpentSumCache($userid, $for_time = 0) {
//		global $cache;
//		$cache_key = GUserGoldSpentInTimespan . $userid;
//		$rs = $cache->fetch($cache_key);
//		if($rs['start'] <= $for_time && $rs['end'] >= $for_time)
//			$cache->delete($cache_key);
//	}
	
	/*
	 * 计算玩家 累积总共充值RMB金额在多少元以下，默认为0表示非RMB玩家
	 * 暂时分3个区间，[0,50]  (50,200]   (200, 很大的不可能的一个数:9个9]
	 */
	public function CalcPayMoneyLevel()
	{
		$sql = "SELECT SUM(`pay_money`) AS `s` FROM `tlog_pay` WHERE `user_id`='{$this->userid}' ";

		$dbW = getDbConnWrite();
		$row = GFetchRowOne($sql, $dbW);
		$sum = intval($row['s']);

		$f = array();
		$f['id'] = $this->userid;
		if ($sum <= 50)
		{
			$f['pay_money_level'] = 50;
		}
		else if ($sum <= 200)
		{
			$f['pay_money_level'] = 200;
		}
		else if ($sum <= 999999999)
		{
			$f['pay_money_level'] = 999999999;
		}
		else
		{
			$f['pay_money_level'] = -1;
		}

		$sqlUpdate = makeUpdateSqlFromArray($f, TBL_USER, 'id');
		$dbW->sql_query($sqlUpdate);

	}


	/**
	 * 是否已经记录有该订单
	 * 无事务处理
	 */
	public function isExistPayOrderId($order_id)
	{
		$sql = "SELECT count(id) as c FROM `tlog_pay` WHERE pay_num='{$order_id}'";
		$rs = GFetchRowOne($sql, getDbConnWrite());
		if (! isset($rs['c']) )
			return true;  //数据库查询出错时，当做该订单已经记录

		return ($rs['c']>0);
	} 
	
	//指定玩家的购买历史记录统计
	public static function getBuyLogStats($acname, $nickname, $role_id, $timeStampStart = null, $timeStampEnd = null) 
	{
		$sql = "SELECT `itemid`, `mdetail`, SUM(`amount`) as amount, SUM(`gold_bind`) as gold_bind, SUM(`gold_unbind`) as gold_unbind,".
			   " (SUM(`gold_bind`)+SUM(`gold_unbind`)) AS gold, COUNT(DISTINCT user_id) AS role_count FROM `t_log_use_gold` WHERE `mtype`=" . self::TYPE_BUY_ITEM;
		
		if(!empty($acname))
		{
			$sql .= " AND `account_name` = '{$acname}' ";
			
		}
		if(!empty($nickname))
		{
			$sql .= " AND `user_name` = '{$nickname}' ";
		}
		if(!empty($role_id))
		{
			$sql .= " AND `user_id` = '{$role_id}' ";
		}
		
		if ($timeStampStart)
		{
			$sql .= " AND `mtime` >= {$timeStampStart} ";
		}
		
		if ($timeStampEnd)
		{
			$sql .= " AND `mtime` <= {$timeStampEnd} ";
		}
		
		$sql .= " GROUP BY `itemid` ORDER BY `gold_unbind` desc, `amount` desc;";
		
		$rs = GFetchRowSet($sql);
		
		return $rs;
	}
}

}