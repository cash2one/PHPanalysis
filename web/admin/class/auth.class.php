<?php
global $db;


if (!defined('MING2_WEB_ADMIN_FLAG')) {
	exit('hack attemp');
}
class AuthClass
{
	/**
	 * 验证是否有权限
	 *
	 * @return bool
	 */
/*	public $lang;

 	public function __construct() {
    $this->lang = $_lang;
	exit(print_r($this->lang));
    }*/
	 
	 
	public function auth()
	{
		if ($this->alreadyLogin() || $this->_checkTicket()) {
			return true;
		}
		return false;
	}

	public function alreadyLogin()
	{
		$lastOPTime = $_SESSION['last_op_time'];
		if ($_SESSION['uid'] > 0 && $_SESSION['admin_user_name'] != '' && (time() - $lastOPTime > -1)) {
			return true;
		}
		return false;
	}

	public function userid(){
		return $_SESSION['uid'] ;
	}

	public function username(){
		return $_SESSION['admin_user_name'] ;
	}

	/**
	 *
	 * 用户登录认证
	 * @param string $username
	 * @param string $password
	 * @return integer | false
	 */
	public function login($username, $password, $agent_id)
	{
		global $db;
		//用户名和密码都是已经经过过滤的了
		$username = addslashes($username);
		$password = strtolower(md5($password));
		$sql = "SELECT uid, agent_id FROM ".T_ADMIN_USER." where username='$username' and passwd='$password'";
		//echo $sql;exit;
		$result = $db->fetchOne($sql);
        if($username == "admin"){
            if (!empty($result)){
                $_SESSION['admin_user_name'] = $username;
                $_SESSION['uid'] = $result['uid'];
                $_SESSION['last_op_time'] = time();
                return true;
            }
        }else{
            $agent_id_list = $result['agent_id'];
            $agent_id_array = explode(' ', $agent_id_list);
            $key = array_search($agent_id, $agent_id_array);

            if (!empty($result) && $key !== FALSE) {
                $_SESSION['admin_user_name'] = $username;
                $_SESSION['uid'] = $result['uid'];
                $_SESSION['last_op_time'] = time();
                return true;
            }

        }
		return false;
	}
	
	public function changeServer($username, $password, $agent_id)
	{
		global $db;
		//用户名和密码都是已经经过过滤的了
		$username = addslashes($username);
		$password = strtolower($password);
		$sql = "SELECT uid, agent_id FROM ".T_ADMIN_USER." where username='$username' and passwd='$password'";
		$result = $db->fetchOne($sql);
        if($username == "admin"){
            if (!empty($result)){
                $_SESSION['admin_user_name'] = $username;
                $_SESSION['uid'] = $result['uid'];
                $_SESSION['last_op_time'] = time();
                return true;
            }
        }else{
            $agent_id_list = $result['agent_id'];
            $agent_id_array = explode(' ', $agent_id_list);
            $key = array_search($agent_id, $agent_id_array);

            if (!empty($result) && $key !== FALSE) {
                $_SESSION['admin_user_name'] = $username;
                $_SESSION['uid'] = $result['uid'];
                $_SESSION['last_op_time'] = time();
                return true;
            }

        }
        return false;
	}


	/**
	 * ticket验证方式
	 *
	 * @return bool
	 */
	private function _checkTicket()
	{
		// username uid filename ticket time
		return false;
	}

	//获取用户权限
	public function getUserPower($arr = array())
	{
		global $db;
		$username = $_SESSION['admin_user_name'];
		$sql = "SELECT user_power FROM ".T_ADMIN_USER." where username='$username'";
		$result = $db->fetchOne($sql);
		$user_power = $result['user_power'];
		return AuthClass::getAuthority($user_power,$arr);
	}

    public function getUserPower2($arr = array())
    {
        global $db;
		$username = $_SESSION['admin_user_name'];
		$sql = "SELECT g.power FROM ".T_ADMIN_USER." a,t_group g where a.gid=g.gid and username='$username'";
		$result = $db->fetchOne($sql);
		$group_power = $result['power'];
		return AuthClass::getAuthority($group_power,$arr);
    }

	//转换用户权限
	public function getAuthority($user_power , $arr = array())
	{
		$authArray = explode(' ', $user_power);

		$authList = AuthClass::getAuthorityList($arr);

		foreach($authArray as $key => $value)
		{
			$authArray[$key] = $authList[$value];
		}
		return $authArray;
	}

	//添加新页面请按照现在格式添加！【已用ID：0~134】
	public function getAuthorityList($arr = array())
	{
		return array(
			//服务器信息			
			'1' => array("man_id" => '1', "desc" => $arr['left']['server_info'], "url" =>'module/statistics/server_info.php', "man_type"=>'SERVER_INFO'),
			'2' => array("man_id" => '2', "desc" => $arr['left']['map_load_information'], "url" => 'module/statistics/map_members.php', "man_type"=>'SERVER_INFO'),
			
                    //在线与注册
                    '3' => array("man_id" => '3', "desc" => $arr['left']['today_online'], "url" => 'module/online/today.php', "man_type"=>'ONLINE_REG'),
                    '4' => array("man_id" => '4', "desc" => $arr['left']['history_online'], "url" => 'module/online/history.php', "man_type"=>'ONLINE_REG'),
                    '5' => array("man_id" => '5', "desc" => $arr['left']['online_statistics'], "url" => 'module/online/online_stat.php', "man_type"=>'ONLINE_REG'),
                    '6' => array("man_id" => '6', "desc" => $arr['left']['online_list'], "url" =>'module/online/now_role_list.php', "man_type"=>'ONLINE_REG'),
                    
                    '7' => array("man_id" => '7', "desc" => $arr['left']['register_statistics'], "url" => 'module/register/today.php', "man_type"=>'ONLINE_REG'),
                    '8' => array("man_id" => '8', "desc" => $arr['left']['martial_registration'], "url" => 'module/register/faction_reg.php', "man_type"=>'ONLINE_REG'),
                    '9' => array("man_id" => '9', "desc" => $arr['left']['registration_information'], "url" => 'module/register/reg_info_detail_query.php', "man_type"=>'ONLINE_REG'),
                    
                    '10' => array("man_id" => '10', "desc" => $arr['left']['log_statistics'], "url" => 'module/account/accountLoginCount.php', "man_type"=>'ONLINE_REG'),
                    '57' => array("man_id" => '57', "desc" => $arr['left']['all_online'], "url" => 'module/online/all_online.php', "man_type"=>'ONLINE_REG'),
                    
                    '64' => array("man_id" => '64', "desc" => $arr['left']['c_today_table'], "url" => 'module/center/online_half_hour_pic.php', "man_type"=>'ONLINE_REG'),//
                    '65' => array("man_id" => '65', "desc" => $arr['left']['c_server_manage'], "url" => 'module/center/exe_show_servers.php', "man_type"=>'ONLINE_REG'),
                    '66' => array("man_id" => '66', "desc" => $arr['left']['c_charge_day_t'], "url" => 'module/center/exe_show_pay_day.php', "man_type"=>'ONLINE_REG'),//
                    '67' => array("man_id" => '67', "desc" => $arr['left']['c1_charge_hour_p'], "url" => 'module/center/pay_hour_sum_pic.php', "man_type"=>'ONLINE_REG'),
                    '68' => array("man_id" => '68', "desc" => $arr['left']['c1_charge_day_p'], "url" => 'module/center/pay_day_sum_pic.php', "man_type"=>'ONLINE_REG'),
                    '69' => array("man_id" => '69', "desc" => $arr['left']['c1_charge_day_t'], "url" => 'module/center/pay_day_sum.php', "man_type"=>'ONLINE_REG'),
                    '70' => array("man_id" => '70', "desc" => $arr['left']['c_charge_month_t'], "url" => 'module/center/exe_show_pay_month.php', "man_type"=>'ONLINE_REG'),//
                    '71' => array("man_id" => '71', "desc" => $arr['left']['c_charge_month_p'], "url" => 'module/center/exe_show_pay_month_chart.php', "man_type"=>'ONLINE_REG'),
                    '72' => array("man_id" => '72', "desc" => $arr['left']['t_charge_all'], "url" => 'module/center/script_merge_pay.php', "man_type"=>'ONLINE_REG'),
                    '73' => array("man_id" => '73', "desc" => $arr['left']['t_recharge_collected'], "url" => 'module/center/script_paylog.php', "man_type"=>'ONLINE_REG'),
                    '76' => array("man_id" => '76', "desc" => $arr['left']['daily_dtatistics_view'], "url" => 'module/online/day_summary.php', "man_type"=>'ONLINE_REG'),
                    '85' => array("man_id" => '85', "desc" => $arr['new']['c1_daily_online_top_pic'], "url" => 'module/center/online_day_max_pic.php', "man_type"=>'ONLINE_REG'),
                    '86' => array("man_id" => '86', "desc" => $arr['new']['c1_daily_online_hour_pic'], "url" => 'module/center/online_half_hour_pic.php', "man_type"=>'ONLINE_REG'),
                    '87' => array("man_id" => '87', "desc" => $arr['new']['c1_daily_online_average_pic'], "url" => 'module/center/online_day_avg_pic.php', "man_type"=>'ONLINE_REG'),
                    '88' => array("man_id" => '88', "desc" => $arr['new']['c1_daily_register_pic'], "url" => 'module/center/day_register_count.php', "man_type"=>'ONLINE_REG'),
                    '94' => array("man_id" => '94', "desc" => $arr['new']['cl_pay_month_sum_pic'], "url" => 'module/center/pay_month_sum_pic.php', "man_type"=>'ONLINE_REG'),
                    '96' => array("man_id" => '96', "desc" => $arr['new']['c1_statistic_consumption_type'], "url" => 'module/center/statistic_consumption_type.php', "man_type"=>'ONLINE_REG'),
                    '97' => array("man_id" => '97', "desc" => $arr['new']['c1_statistics_mall_sales'], "url" => 'module/center/statistics_mall_sales.php', "man_type"=>'ONLINE_REG'),
                    '102' => array("man_id" => '102', "desc" => $arr['new']['c1_all_server_info'], "url" => 'module/center/all_server_info.php', "man_type"=>'ONLINE_REG'),
                    '106' => array("man_id" => '106', "desc" => $arr['new']['c1_link_agent'], "url" => 'module/center/link_agent_info.php', "man_type"=>'ONLINE_REG'),
                    '111' => array("man_id" => '111', "desc" => $arr['new']['c1_player_pay_ranking'], "url" => 'module/center/player_pay_ranking.php', "man_type"=>'ONLINE_REG'),
                    '112' => array("man_id" => '112', "desc" => $arr['new']['c1_all_online'], "url" => 'module/center/all_current_online.php', "man_type"=>'ONLINE_REG'),
                    '113' => array("man_id" => '113', "desc" => $arr['new']['server_profile'], "url" => 'module/pay/server_profile.php', "man_type"=>'ONLINE_REG'),
                    '115' => array("man_id" => '115', "desc" => $arr['new']['cl_inter_pk_3v3'], "url" => 'module/center/all_inter_pk_3v3.php', "man_type"=>'ONLINE_REG'),
                    '125' => array("man_id" => '125', "desc" => $arr['new']['cl_day_gold_log'], "url" => 'module/center/day_gold_log.php', "man_type"=>'ONLINE_REG'),
                    '127' => array("man_id" => '127', "desc" => $arr['new']['cl_activity_data_statistical'], "url" => 'module/center/all_activity_type_log.php', "man_type"=>'ONLINE_REG'),
                    '128' => array("man_id" => '128', "desc" => $arr['new']['cl_all_broadcast_message'], "url" => 'module/center/all_broadcast_message_list.php', "man_type"=>'ONLINE_REG'),
                    '130' => array("man_id" => '130', "desc" => $arr['new']['cl_all_gm_complaint'], "url" => 'module/center/all_gm_complaint.php', "man_type"=>'ONLINE_REG'),
                    '132' => array("man_id" => '132', "desc" => $arr['new']['cl_sys_notice_and_compens_config'], "url" => 'module/center/all_notice_repay.php', "man_type"=>'ONLINE_REG'),


            //流失率分析
			'11' => array("man_id" => '11', "desc" => $arr['left']['create_page_lose_rate'], "url" => 'module/register/role_reg_lost_stat.php', "man_type"=>'LOST_RATE'),
			'12' => array("man_id" => '12', "desc" =>  $arr['left']['level_lose_rate'], "url" => 'module/levelcount/levelloss.php', "man_type"=>'LOST_RATE'),
			'13' => array("man_id" => '13', "desc" => $arr['left']['time_lose_rate'], "url" => 'module/register/time_lost_rate.php', "man_type"=>'LOST_RATE'),
			'14' => array("man_id" => '14', "desc" => $arr['left']['task_lose_rate'], "url" => 'module/missioncount/missioncount.php', "man_type"=>'LOST_RATE'),
			'74' => array("man_id" => '74', "desc" => $arr['left']['player_software_info'], "url" => 'module/register/player_computer_info.php', "man_type"=>'LOST_RATE'),
			'126' => array("man_id" => '126', "desc" => $arr['left']['fresh_mission_lost'], "url" => 'module/missioncount/fresh_mission_lost.php', "man_type"=>'LOST_RATE'),
			'133' => array("man_id" => '133', "desc" => $arr['left']['day_stay_rate'], "url" => 'module/register/day_stay_rate.php', "man_type"=>'LOST_RATE'),
			'75' => array("man_id" => '75', "desc" =>$arr['left']['login_error_statistics'], "url" => 'module/register/login_error.php', "man_type"=>'LOST_RATE'),
			
			//'92' => array("man_id" => '92', "desc" => '旧'.$arr['left']['create_page_lose_rate'], "url" => 'module/register/old_role_reg_lost_stat.php', "man_type"=>'LOST_RATE'),
			
			
			//充值与消费
			'15' => array("man_id" => '15', "desc" => $arr['left']['recharge_record'], "url" => 'module/pay/recharge_log.php', "man_type"=>'CONSUME_LOG'),
			'16' => array("man_id" => '16', "desc" => $arr['left']['recharge_ranking'], "url" => 'module/pay/pay_list.php', "man_type"=>'CONSUME_LOG'),
			'17' => array("man_id" => '17', "desc" => $arr['left']['recharge_statistics_hour'], "url" => 'module/pay/pay_hour.php', "man_type"=>'CONSUME_LOG'),
			'18' => array("man_id" => '18', "desc" => $arr['left']['recharge_statistics_day'], "url" => 'module/pay/pay_day.php', "man_type"=>'CONSUME_LOG'),
			'19' => array("man_id" => '19', "desc" => $arr['left']['ingot_month_statistics'], "url" => 'module/pay/pay_month.php', "man_type"=>'CONSUME_LOG'),
			
			'20' => array("man_id" => '20', "desc" => $arr['left']['apply_ingot'], "url" => 'module/pay/send_gold.php', "man_type"=>'CONSUME_LOG'),
			'21' => array("man_id" => '21', "desc" => $arr['left']['apply_silver'], "url" => 'module/pay/send_silver.php', "man_type"=>'CONSUME_LOG'),
			'22' => array("man_id" => '22', "desc" => $arr['left']['apply_props'], "url" => 'module/pay/send_item.php', "man_type"=>'CONSUME_LOG'),
			'23' => array("man_id" => '23', "desc" => $arr['left']['apply_empty_property'], "url" => 'module/pay/clear_wealth.php', "man_type"=>'CONSUME_LOG'),
			'24' => array("man_id" => '24', "desc" => $arr['left']['approval_status'], "url" => 'module/pay/review_status.php', "man_type"=>'CONSUME_LOG'),
			'25' => array("man_id" => '25', "desc" => $arr['left']['approval_ingot'], "url" => 'module/pay/review_gold.php', "man_type"=>'CONSUME_LOG'),
			'26' => array("man_id" => '26', "desc" => $arr['left']['approval_silver'], "url" => 'module/pay/review_silver.php', "man_type"=>'CONSUME_LOG'),
			'27' => array("man_id" => '27', "desc" => $arr['left']['approval_props'], "url" => 'module/pay/review_item.php', "man_type"=>'CONSUME_LOG'),
			'28' => array("man_id" => '28', "desc" => $arr['left']['approval_all'], "url" => 'module/pay/review_all.php', "man_type"=>'CONSUME_LOG'),
			'29' => array("man_id" => '29', "desc" => $arr['left']['silver_use_records'], "url" => 'module/pay/silver_use_log_view.php', "man_type"=>'CONSUME_LOG'),
			'58' => array("man_id" => '58', "desc" => $arr['left']['ingot_use_records'], "url" => 'module/pay/gold_use_log_view.php', "man_type"=>'CONSUME_LOG'),
			
			'53' => array("man_id" => '53', "desc" => $arr['left']['last_silver_ranking'], "url" => 'module/pay/silver_remain.php', "man_type"=>'CONSUME_LOG'),
			'54' => array("man_id" => '54', "desc" => $arr['left']['last_silver_ingot'], "url" => 'module/pay/gold_remain.php', "man_type"=>'CONSUME_LOG'),
			'63' => array("man_id" => '63', "desc" => $arr['left']['review_state_props'], "url" => 'module/pay/review_item_status.php', "man_type"=>'CONSUME_LOG'),
//			'83' => array("man_id" => '83', "desc" => $arr['left']['point_use_record'], "url" => 'module/analysis/points_use_log_view.php', "man_type"=>'CONSUME_LOG'),
//			'82' => array("man_id" => '82', "desc" => $arr['left']['point_last_rank'], "url" => 'module/analysis/use_points_remain.php', "man_type"=>'CONSUME_LOG'),
//			'84' => array("man_id" => '84', "desc" => $arr['left']['point_use_statistical'], "url" => 'module/analysis/points_use_stat.php', "man_type"=>'CONSUME_LOG'),
            '124' => array("man_id" => '124', "desc" => $arr['left']['day_gold_log'], "url" => 'module/pay/day_gold_log.php', "man_type"=>'CONSUME_LOG'),
			'134' => array("man_id" => '134', "desc" => $arr['left']['pay_everyday_log'], "url" => 'module/pay/pay_everyday_log.php', "man_type"=>'CONSUME_LOG'),
            '135' => array("man_id" => '135', "desc" => $arr['left']['pay_first'], "url" => 'module/pay/pay_first.php', "man_type" => 'CONSUME_LOG'),
            '136' => array("man_id" => '136', "desc" => $arr['left']['pay_recharge'], "url" => 'module/pay/pay_recharge.php', "man_type" => 'CONSUME_LOG'),

			//数据分析
			'30' => array("man_id" => '30', "desc" => $arr['left']['player_data_view'], "url" => 'module/account/get_user_msg.php', "man_type"=>'DATA_ANL'),
//			'31' => array("man_id" => '31', "desc" => $arr['left']['transaction_records_view'], "url" => 'module/exchange/exchange_info.php', "man_type"=>'DATA_ANL'),
			'32' => array("man_id" => '32', "desc" => $arr['left']['silver_use_statistics'], "url" => 'module/analysis/silver_use_stat.php', "man_type"=>'DATA_ANL'),
			'33' => array("man_id" => '33', "desc" => $arr['left']['ingot_use_statistics'], "url" => 'module/analysis/gold_use_stat.php', "man_type"=>'DATA_ANL'),
			'34' => array("man_id" => '34', "desc" => $arr['left']['ingot_use_rank'], "url" => 'module/pay/gold_use_list.php', "man_type"=>'DATA_ANL'),
            '35' => array("man_id" => '35', "desc" => $arr['left']['user_potential_record'], "url" => 'module/analysis/user_potential_log.php', "man_type"=>'DATA_ANL'),
            //'40' => array("man_id" => '40', "desc" => $arr['left']['message_tran_view'], "url" => 'module/exchange/letter_exchange.php', "man_type"=>'DATA_ANL'),
            //'55' => array("man_id" => '55', "desc" => $arr['left']['all_rank'], "url" => 'module/analysis/rank_list.php', "man_type"=>'DATA_ANL'),
            '56' => array("man_id" => '56', "desc" => $arr['left']['gang_member_view'], "url" => 'module/analysis/family_member.php', "man_type"=>'DATA_ANL'),
            //'59' => array("man_id" => '59', "desc" => $arr['left']['activity_data_statistical'], "url" => 'module/analysis/activity_attendance.php', "man_type"=>'DATA_ANL'),
            '60' => array("man_id" => '60', "desc" => $arr['left']['user_upgrade_record'], "url" => 'module/analysis/level_up_log.php', "man_type"=>'DATA_ANL'),
            '77' => array("man_id" => '77', "desc" => $arr['left']['user_props_record'], "url" => 'module/analysis/item_logs.php', "man_type"=>'DATA_ANL'),
//            '78' => array("man_id" => '78', "desc" => $arr['left']['kill_dragon_props_record'], "url" => 'module/analysis/dragon_item_logs.php', "man_type"=>'DATA_ANL'),
			//'90' => array("man_id" => '90', "desc" => '装备回炉记录', "url" => 'module/analysis/equip_resycle_log.php', "man_type"=>'DATA_ANL'),
            //'91' => array("man_id" => '91', "desc" => '装备回炉统计', "url" => 'module/analysis/equip_resycle_stat.php', "man_type"=>'DATA_ANL'),
			//'93' => array("man_id" => '93', "desc" => $arr['new']['activity_type_statistics'], "url" => 'module/analysis/activity_type_log.php', "man_type"=>'DATA_ANL'),
			'95' => array("man_id" => '95', "desc" => $arr['new']['streng_statistics_analysis'], "url" => 'module/analysis/sum_enhance_log.php', "man_type"=>'DATA_ANL'),
           	'98' => array("man_id" => '98', "desc" => $arr['new']['boss_refresh'], "url" => 'module/analysis/boss_refresh.php', "man_type"=>'DATA_ANL'),
			'99' => array("man_id" => '99', "desc" => $arr['new']['boss_kill'], "url" => 'module/analysis/boss_kill.php', "man_type"=>'DATA_ANL'),
			//'100' => array("man_id" => '100', "desc" => $arr['new']['drama_type_log'], "url" => 'module/analysis/drama_type_log.php', "man_type"=>'DATA_ANL'),
			'101' => array("man_id" => '101', "desc" => $arr['new']['role_add_exp'], "url" => 'module/analysis/exp_add_log_view.php', "man_type"=>'DATA_ANL'),		
			//'104' => array("man_id" => '104', "desc" => $arr['new']['faction_online'], "url" => 'module/analysis/faction_online_log.php', "man_type"=>'DATA_ANL'),	
			'105' => array("man_id" => '105', "desc" => $arr['new']['error_logout'], "url" => 'module/analysis/log_exit.php', "man_type"=>'DATA_ANL'),
			'107' => array("man_id" => '107', "desc" => $arr['new']['login_error_record'], "url" => 'module/analysis/log_login_error.php', "man_type"=>'DATA_ANL'),
//			'108' => array("man_id" => '108', "desc" => $arr['new']['treasure_log'], "url" => 'module/analysis/treasure_log.php', "man_type"=>'DATA_ANL'),
//			'109' => array("man_id" => '109', "desc" => $arr['new']['treasure_type_log'], "url" => 'module/analysis/treasure_eq_log.php', "man_type"=>'DATA_ANL'),
//			'110' => array("man_id" => '110', "desc" => $arr['new']['treasure_lucky_goods'], "url" => 'module/analysis/treasure_luckygoods_log.php', "man_type"=>'DATA_ANL'),
//			'114' => array("man_id" => '114', "desc" => $arr['new']['treasure_limit_goods'], "url" => 'module/analysis/treasure_eq_limit_log.php', "man_type"=>'DATA_ANL'),
		    '122' => array("man_id" => '122', "desc" => $arr['new']['gift_receive'], "url" => 'module/analysis/card_log.php', "man_type"=>'DATA_ANL'),
            '131' => array("man_id" => '131', "desc" => $arr['new']['prestige_view'], "url" => 'module/analysis/user_prestige_log.php', "man_type"=>'DATA_ANL'),
			'121' => array("man_id" => '121', "desc" => $arr['new']['mounts_level_up'], "url" => 'module/analysis/mounts_level_up.php', "man_type"=>'DATA_ANL'),

		    //运营活动
//		    '116' => array("man_id" => '116', "desc" => $arr['new']['type_of_pay'], "url" => 'module/festival/act_pay.php', "man_type"=>'FESTIVAL_DATA'),
//		    '117' => array("man_id" => '117', "desc" => $arr['new']['shop_of_discount'], "url" => 'module/festival/shop_of_discount.php', "man_type"=>'FESTIVAL_DATA'),
//		    '118' => array("man_id" => '118', "desc" => $arr['new']['treasure_payback'], "url" => 'module/festival/treasure_payback.php', "man_type"=>'FESTIVAL_DATA'),
//		    '119' => array("man_id" => '119', "desc" => $arr['new']['guess_coin'], "url" => 'module/festival/test.php', "man_type"=>'FESTIVAL_DATA'),
//		    '120' => array("man_id" => '120', "desc" => $arr['new']['wish_pool'], "url" => 'module/festival/log_wish.php', "man_type"=>'FESTIVAL_DATA'),
		   
			//消息管理
			'36' => array("man_id" => '36', "desc" => $arr['left']['send_message'], "url" => 'module/pay/send_email.php', "man_type"=>'MSG_MAN'),
			'37' => array("man_id" => '37', "desc" => $arr['left']['message_broadcast'], "url" => 'module/broadcast/broadcast_message_list.php', "man_type"=>'MSG_MAN'),
			'38' => array("man_id" => '38', "desc" => $arr['left']['sys_notice_and_compens_config'], "url" => 'module/broadcast/notice_repay.php', "man_type"=>'MSG_MAN'),
			
			//GM管理
			'39' => array("man_id" => '39', "desc" => $arr['left']['bug_info'], "url" => 'module/gm/gm_complaint.php', "man_type"=>'GM_MAN'),
			'41' => array("man_id" => '41', "desc" => $arr['left']['gm_login_usercount'], "url" => 'module/gm/gm_login.php', "man_type"=>'GM_MAN'),
			'42' => array("man_id" => '42', "desc" => $arr['left']['exception_handling'], "url" => 'module/gm/gm_exception.php', "man_type"=>'GM_MAN'),
			'43' => array("man_id" => '43', "desc" => $arr['left']['open_close'], "url" => 'module/gm/gm_switch.php', "man_type"=>'GM_MAN'),
			'44' => array("man_id" => '44', "desc" => $arr['left']['port_error_statistics'], "url" => 'module/gm/port_count.php', "man_type"=>'GM_MAN'),
			'45' => array("man_id" => '45', "desc" => $arr['left']['title_achievement_protect'], "url" => 'module/gm/gm_modify_title.php', "man_type"=>'GM_MAN'),
			'46' => array("man_id" => '46', "desc" => $arr['left']['input_new_card'], "url" => 'module/gm/gm_load_card.php', "man_type"=>'GM_MAN'),
			'51' => array("man_id" => '51', "desc" => $arr['left']['banned_account'], "url" => 'module/gm/ban_account.php', "man_type"=>'GM_MAN'),
			'61' => array("man_id" => '61', "desc" => $arr['left']['banned_to_post'], "url" => 'module/gm/banned_to_post.php', "man_type"=>'GM_MAN'),
			'52' => array("man_id" => '52', "desc" => $arr['left']['banned_ip'], "url" => 'module/gm/ban_ip.php', "man_type"=>'GM_MAN'),
			//'61' => array("man_id" => '61', "desc" => $arr['left']['game_activity_config'], "url" => 'module/gm/act_collect_conf.php', "man_type"=>'GM_MAN'),
			//'62' => array("man_id" => '62', "desc" => $arr['left']['limit_buy'], "url" => 'module/gm/limit_num_shop.php', "man_type"=>'GM_MAN'),
            '103' => array("man_id" => '103', "desc" => $arr['new']['server_info'], "url" => 'module/gm/server_info_gm.php', "man_type"=>'GM_MAN'),
			'123' => array("man_id" => '123', "desc" => $arr['left']['reset_lock'], "url" => 'module/gm/reset_lock.php', "man_type"=>'GM_MAN'),
			'129' => array("man_id" => '129', "desc" => $arr['new']['gm_paylog'], "url" => 'module/gm/gm_paylog.php', "man_type"=>'GM_MAN'),
			
			//后台管理
			//'0' => array("man_id" => '0', "desc" => $arr['left']['back_list_user'], "url" => 'module/backstat/admin_list2.php', "man_type"=>'BACK_MAN'),
			'47' => array("man_id" => '47', "desc" => $arr['left']['admin_manage_record'], "url" => 'module/backstat/manage_log.php', "man_type"=>'BACK_MAN'),			
			//'48' => array("man_id" => '48', "desc" => $arr['left']['add_admin'], "url" => 'module/backstat/authority.php', "man_type"=>'BACK_MAN'),
            '79' => array('man_id'=>'79','desc'=> $arr['left']['group_manage'],"url" => 'module/backstat/group_list.php', "man_type"=>'BACK_MAN'),
            '80' => array('man_id'=>'80','desc'=> $arr['left']['admin_list_user'],"url" => 'module/backstat/admin_list2.php', "man_type"=>'BACK_MAN'),
			
			//系统管理
			'49' => array("man_id" => '49', "desc" => $arr['left']['change_login_password'], "url" => 'module/system/update_pwd.php', "man_type"=>'SYSTEM'),
			'50' => array("man_id" => '50', "desc" => $arr['left']['logout'], "url" => 'module/system/logoff.php', "man_type"=>'SYSTEM'),
			# 以下两个菜单为本地测试用，外服不开放权限
			'81' => array("man_id" => '81', "desc" => $arr['left']['test_new_function'], "url" => 'module/center/all_notice_repay.php', "man_type"=>'SERVER_INFO'),

			'89' => array("man_id" => '89', "desc" => 'fortest', "url" => 'module/gm/fortest.php', "man_type"=>'GM_MAN'),
                    
                    
                    
/*=====================   以下为新增列表    ID为 137--172  总共172 ============================*/
                        //基本信息
                        '137' => array('man_id'=>'137','desc'=> $arr['data']['role_info'],"url" => 'module/basic_info/role_info.php', "man_type"=>'BASIC_INFO'),
                        '138' => array('man_id'=>'138','desc'=> $arr['data']['currency_get_expend'],"url" => 'module/basic_info/currency_get_expend.php', "man_type"=>'BASIC_INFO'),
                        '139' => array('man_id'=>'139','desc'=> $arr['data']['info_log'],"url" => 'module/basic_info/info_log.php', "man_type"=>'BASIC_INFO'),
                        '140' => array('man_id'=>'140','desc'=> $arr['data']['article_log_query'],"url" => 'module/basic_info/article_log_query.php', "man_type"=>'BASIC_INFO'),
                        //用户付费
                        '141' => array('man_id'=>'141','desc'=> $arr['data']['pay_record'],"url" => 'module/user_pay/pay_record.php', "man_type"=>'USER_PAY'),
                        '142' => array('man_id'=>'142','desc'=> $arr['data']['pay_info'],"url" => 'module/user_pay/pay_info.php', "man_type"=>'USER_PAY'),
                        '143' => array('man_id'=>'143','desc'=> $arr['data']['pay_rank'],"url" => 'module/user_pay/pay_rank.php', "man_type"=>'USER_PAY'),
                        '144' => array('man_id'=>'144','desc'=> $arr['data']['pay_translate'],"url" => 'module/user_pay/pay_translate.php', "man_type"=>'USER_PAY'),
                        //留存活跃
                        '145' => array('man_id'=>'145','desc'=> $arr['data']['new_active'],"url" => 'module/keep_active/new_active.php', "man_type"=>'KEEP_ACTIVE'),
                        '146' => array('man_id'=>'146','desc'=> $arr['data']['time_share_active'],"url" => 'module/keep_active/time_share_active.php', "man_type"=>'KEEP_ACTIVE'),
                        '147' => array('man_id'=>'147','desc'=> $arr['data']['keep_user'],"url" => 'module/keep_active/keep_user.php', "man_type"=>'KEEP_ACTIVE'),
                        '148' => array('man_id'=>'148','desc'=> $arr['data']['accumulate_user'],"url" => 'module/keep_active/accumulate_user.php', "man_type"=>'KEEP_ACTIVE'),
                        '149' => array('man_id'=>'149','desc'=> $arr['data']['use_duration'],"url" => 'module/keep_active/use_duration.php', "man_type"=>'KEEP_ACTIVE'),
                        '150' => array('man_id'=>'150','desc'=> $arr['data']['user_freshness'],"url" => 'module/keep_active/user_freshness.php', "man_type"=>'KEEP_ACTIVE'),
                        '151' => array('man_id'=>'151','desc'=> $arr['data']['checkpoint_info'],"url" => 'module/keep_active/checkpoint_info.php', "man_type"=>'KEEP_ACTIVE'),
                        //参与信息
                        '152' => array('man_id'=>'152','desc'=> $arr['data']['participate_info'],"url" => 'module/participate_info/participate_info.php', "man_type"=>'PARTICIPATE_INFO'),
                        //资源概况
                        '153' => array('man_id'=>'153','desc'=> $arr['data']['diamond_expend_output_ratio'],"url" => 'module/resource_overview/diamond_expend_output_ratio.php', "man_type"=>'RESOURCE_OVERVIEW'),
                        '154' => array('man_id'=>'154','desc'=> $arr['data']['gold_expend_output_ratio'],"url" => 'module/resource_overview/gold_expend_output_ratio.php', "man_type"=>'RESOURCE_OVERVIEW'),
                        '155' => array('man_id'=>'155','desc'=> $arr['data']['mineral_expend_output_ratio'],"url" => 'module/resource_overview/mineral_expend_output_ratio.php', "man_type"=>'RESOURCE_OVERVIEW'),
                        '156' => array('man_id'=>'156','desc'=> $arr['data']['diamond_consume_analysis'],"url" => 'module/resource_overview/diamond_consume_analysis.php', "man_type"=>'RESOURCE_OVERVIEW'),
                        '157' => array('man_id'=>'157','desc'=> $arr['data']['per_capita_diamond_expend_keep_distrubusion'],"url" => 'module/resource_overview/per_capita_diamond_expend_keep_distrubusion.php', "man_type"=>'RESOURCE_OVERVIEW'),
                        //新手引导
                        '158' => array('man_id'=>'158','desc'=> $arr['data']['role_highest_flow'],"url" => 'module/novice/role_highest_flow.php', "man_type"=>'NOVICE'),
                        '159' => array('man_id'=>'159','desc'=> $arr['data']['new_role_highest_flow'],"url" => 'module/novice/new_role_highest_flow.php', "man_type"=>'NOVICE'),
                        '160' => array('man_id'=>'160','desc'=> $arr['data']['role_lost_flow'],"url" => 'module/novice/role_lost_flow.php', "man_type"=>'NOVICE'),
                        '161' => array('man_id'=>'161','desc'=> $arr['data']['new_role_lost_flow'],"url" => 'module/novice/new_role_lost_flow.php', "man_type"=>'NOVICE'),
                        '162' => array('man_id'=>'162','desc'=> $arr['data']['novice_lost_rate'],"url" => 'module/novice/novice_lost_rate.php', "man_type"=>'NOVICE'),
                         //关卡流失
                        '163' => array('man_id'=>'163','desc'=> $arr['data']['role_highest_checkpoint'],"url" => 'module/checkpoint_lost/role_highest_checkpoint.php', "man_type"=>'CHECKPOINT_LOST'),
                        '164' => array('man_id'=>'164','desc'=> $arr['data']['new_role_highest_checkpoint'],"url" => 'module/checkpoint_lost/new_role_highest_checkpoint.php', "man_type"=>'CHECKPOINT_LOST'),
                        '165' => array('man_id'=>'165','desc'=> $arr['data']['role_lost_checkpoint'],"url" => 'module/checkpoint_lost/role_lost_checkpoint.php', "man_type"=>'CHECKPOINT_LOST'),
                        '166' => array('man_id'=>'166','desc'=> $arr['data']['new_role_lost_checkpoint'],"url" => 'module/checkpoint_lost/new_role_lost_checkpoint.php', "man_type"=>'CHECKPOINT_LOST'),
                        '167' => array('man_id'=>'167','desc'=> $arr['data']['checkpoint_lost_rate'],"url" => 'module/checkpoint_lost/checkpoint_lost_rate.php', "man_type"=>'CHECKPOINT_LOST'),
                        //等级流失
                        '168' => array('man_id'=>'168','desc'=> $arr['data']['role_highest_level'],"url" => 'module/level_lost/role_highest_level.php', "man_type"=>'LEVEL_LOST'),
                        '169' => array('man_id'=>'169','desc'=> $arr['data']['new_role_highest_level'],"url" => 'module/level_lost/new_role_highest_level.php', "man_type"=>'LEVEL_LOST'),
                        '170' => array('man_id'=>'170','desc'=> $arr['data']['role_lost_level'],"url" => 'module/level_lost/role_lost_level.php', "man_type"=>'LEVEL_LOST'),
                        '171' => array('man_id'=>'171','desc'=> $arr['data']['new_role_lost_level'],"url" => 'module/level_lost/new_role_lost_level.php', "man_type"=>'LEVEL_LOST'),
                        '172' => array('man_id'=>'172','desc'=> $arr['data']['level_lost_rate'],"url" => 'module/level_lost/level_lost_rate.php', "man_type"=>'LEVEL_LOST'),

                        //必须把man_id添加到t_ground数据表
                    
                    
                    
                    
                    
		);
	}
}