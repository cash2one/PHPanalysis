<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include SYSDIR_ADMIN."/include/global.php";
include "../../../admin/class/admin_log_class.php";
global $smarty, $db;
$is_depot = array(5,6,7,8);
$role_id = trim (SS($_REQUEST ['role_id']));
$role_name = trim (SS($_REQUEST ['role_name']));
$username = $role_name;
$account_name = trim (SS($_REQUEST ['account_name']));
$action = trim($_GET['action']);
$type = trim($_REQUEST['type']);

if ($action == 'doBan'&& $role_id) {
    $action = 'search';
    $operate_user = $_SESSION['admin_user_name'];
    $ban_role_id = trim (SS($_REQUEST ['role_id']));
    $ban_role_info =  $_REQUEST;

    $start_time = time();
    $ban_time_cnt = getBanTime($ban_role_info['ban_time']);
    $end_time = time() + $ban_time_cnt;

    $is_online = $_REQUEST['is_online'];
    //发送账号到游戏服进行封禁
    $admin_id = 0;

    $account_name_log = $ban_role_info['account_name'];

    $ban_role_info['account_name'] = str_replace("\\'", "'", $ban_role_info['account_name']); // 还原 '
    $ban_role_info['account_name'] = str_replace("\\\"", "\"", $ban_role_info['account_name']);  // 还原 "
    $ban_role_info['account_name'] = str_replace("\\\\", "\\", $ban_role_info['account_name']);  // 还原 \
    $ban_role_info['account_name'] = urlencode($ban_role_info['account_name']);
    
    //禁言
    if($is_online)
        $result = getJson($erlangWebAdminHost."killuser/stop_chat/?role_id={$ban_role_info['role_id']}&chat_time={$ban_time_cnt}");

    $result_ban_role = getJson ($erlangWebAdminHost."gm/ban_role/?role_name={$ban_role_info['account_name']}&role_id={$ban_role_info['role_id']}&ban_time={$ban_time_cnt}&admin_id={$admin_id}");

    if ($result_ban_role['result']=='ok') {
        $loger = new AdminLogClass();
        $loger->Log( AdminLogClass::TYPE_BAN_USER, $ban_role_info['ban_reason'], '','', $ban_role_info['role_id'], $account_name_log);

        //插入封禁信息到MySQL
        $insert_sql = "INSERT INTO `t_ban_account` ( `id`,`role_id`,`role_name`,`account_name`,`last_login_ip` ,`level`, `pay_all`, `start_time` ,`end_time` ,`ban_reason` ,`admin`) " .
                " VALUES ('', '{$ban_role_info['role_id']}', '{$ban_role_info['role_name']}', '{$account_name_log}', " .
                " '{$ban_role_info['last_login_ip']}', '{$ban_role_info['level']}', '{$ban_role_info['pay_all']}', '{$start_time}', " .
                "'{$end_time}', '{$ban_role_info['ban_reason']}', '{$operate_user}')";
        $db->query($insert_sql);
/*//        echo '<script language="javascript">window.alert("封禁成功！");</script>';
        //infoExit("封玩家角色帐号成功");*/
    }
/*//    else {
//        echo '<script language="javascript">window.alert("封禁失败！");</script>';
//        //errorExit ("封禁失败");
//    }*/
}else if ($action == 'doUnBan' && $role_id) {
    $action = 'search';
    $now_time = time();
    $unban_role_id = trim (SS($_REQUEST ['role_id']));
    $unban_role_info =  $_REQUEST;

    //发送到游戏服解封账号


    $unban_acc_log = $unban_role_info['account_name'];

    $unban_role_info['account_name'] = str_replace("\\'", "'", $unban_role_info['account_name']); // 还原 '
    $unban_role_info['account_name'] = str_replace("\\\"", "\"", $unban_role_info['account_name']);  // 还原 "
    $unban_role_info['account_name'] = str_replace("\\\\", "\\", $unban_role_info['account_name']);  // 还原 \
    $unban_role_info['account_name'] = urlencode($unban_role_info['account_name']);

    $result_dis_ban_role = getJson ($erlangWebAdminHost."gm/dis_ban_role/?role_name={$unban_role_info['account_name']}");


    if ($result_dis_ban_role['result']=='ok') {
        $loger = new AdminLogClass();
        $loger->Log( AdminLogClass::TYPE_UNBAN_USER,'', '','', $unban_role_id, $unban_acc_log);

        //修改结束时间为当前时间
        $sql_update = "UPDATE `{$dbConfig['dbname']}`.`t_ban_account` SET `end_time` = '{$now_time}' WHERE `t_ban_account`.`role_id` ='{$unban_role_id}';";
        $db->query($sql_update);
/*//        echo '<script language="javascript">window.alert("解封成功！");</script>';
        //infoExit("解封玩家角色帐号成功");*/
    }
/*//    else {
//        echo '<script language="javascript">window.alert("解封失败 ！");</script>';
//        //errorExit ("解封玩家角色帐号失败");
//    }*/
}
if ($action=='search') {
    if(empty($type)){


        if ($role_id == '' && $role_name == '' && $account_name == '') {
            errorExit ( $buf_lang['new']['user_info_can_not_null']);
        }

        $sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1 ";
        if (!empty($role_id)) {
            $sql .= " AND role_id='{$role_id}'";
            $search_role_id = $role_id;
        }
        else if (!empty($role_name)) {
            $sql .= " AND BINARY role_name='{$role_name}'";
            $search_role_name = $role_name;
        }
        else if (!empty($account_name)) {
            //$sql .= " AND account_name='{$account_name}' AND server_id='{$GAME_SERVER}' AND agent_id='{$AGENT_ID}'";
            $sql .= " AND account_name='{$account_name}' AND agent_id='{$AGENT_ID}'";
           
            $search_account_name = $account_name; 
        }


        $role_result = $db->fetchAll($sql);
        
        if (empty($role_result)) {
            errorExit ($buf_lang['new']['user_no_exist']);
        }
    }else{
        $get_role_id = $_REQUEST['search_role_id'];
        $get_role_name = $_REQUEST['search_role_name'];
        $get_account_name = $_REQUEST['search_account_name'];
        $sql = "SELECT role_id, role_name, account_name FROM db_role_base_p WHERE 1 ";
        if (!empty($get_role_id)) {
            $sql .= " AND role_id='{$get_role_id}'";
            $search_role_id = $get_role_id;
        }
        else if (!empty($get_role_name)) {
            $sql .= " AND BINARY role_name='{$get_role_name}'";
            $search_role_name = $get_role_name;
        }
        else if (!empty($get_account_name)) {
            $sql .= " AND account_name='{$get_account_name}' AND server_id='{$GAME_SERVER}' AND agent_id='{$AGENT_ID}'";
            $search_account_name = $get_account_name; 
        }

        $role_result = $db->fetchAll($sql);


        $username=$role_name;

        #角色名空格编码
        $username = str_replace("\\'", "'", $username); // 还原 '

        $username = str_replace("\\\"", "\"", $username);  // 还原 "

        $username = str_replace("\\\\", "\\", $username);  // 还原 \

        $username = urlencode($username);
        //$erlangWebAdminHost = "http://".RES_SITE.":".WEB_PORT."/";
        //获取角色的装备信息
        $result = getJson($erlangWebAdminHost."usermsg/get_user_msg/?role_id={$role_id}&username={$username}");
        //echo '<pre>';
        //print_r($result);exit;

        if (is_array($result)) {   
            //根据角色名取出帐号
            //根据帐号名取出所有角色数据
            $sql2="SELECT b.role_id, b.role_name, b.agent_id, b.server_id, b.account_name,b.pk_points,b.class_id,FROM_UNIXTIME(b.create_time, '%Y-%m-%d %H:%i:%S') as create_time ,".
                    "a.gongxun,b.sex, b.faction_id, a.level,a.gold,a.gold_bind,a.silver,a.silver_bind,a.vitality,a.soul,a.jungong,a.exploit,a.honor,a.exp,a.next_level_exp, a.vip_level, a.reincarnation,a.militaryranks, e.is_online, b.family_name,e.last_offline_time,e.last_login_time ".
                    "FROM ".T_DB_ROLE_BASE_P." b , ".T_DB_ROLE_ATTR_P." a, " .T_DB_ROLE_EXT_P. " e ".
                    " WHERE b.role_id = a.role_id and b.role_id = e.role_id and b.role_id='{$role_id}';";
            //echo $sql2;exit;
            $AllRoles = $db->fetchAll($sql2);
            /*echo '<pre>';
            print_r($AllRoles);exit;*/
            $sql = "SELECT last_login_ip FROM db_account_p where account_name='".$AllRoles[0]['account_name']."' and agent_id = ".$AllRoles[0]['agent_id']." and server_id = ".$AllRoles[0]['server_id'];
            $ipRow=$db->fetchOne($sql);
            $AllRoles[0]['last_login_ip']=$ipRow['last_login_ip'];
            $second_cnt = time()-$AllRoles[0]['last_offline_time'];
            $AllRoles[0]['left_day'] = intval($second_cnt/3600/24);
            $AllRoles[0]['left_h_m'] = intval(($second_cnt%86400)/3600).'时'.date('i分s秒',$second_cnt);
            $sql = "SELECT sum(pay_gold) as golds FROM db_pay_log_p WHERE role_id = ".$role_id;
            $golds = $db->fetchOne($sql);
            $AllRoles[0]['pay_gold'] = $golds['golds'];
            /*
            //充值统计 start
            $sql = "SELECT SUM(pay_gold) FROM db_pay_log_p WHERE role_id = ".$AllRoles[0]['role_id'];
            $pay_gold = $db -> query($sql);
            $AllRoles[0]['pay_gold'] = $pay_gold;
            //end
            */
            $now_time = time();
            $sql_ban = "select * from t_ban_account where role_id={$role_id} and end_time>'{$now_time}'";
            $ban_account = $db->fetchOne($sql_ban);

            if(empty($ban_account)) {
                $sql_money = "select round(sum(pay_money)/100,2) as money  from db_pay_log_p  where role_id=".$role_id;

                $ban_money = $db->fetchOne($sql_money);
                $ban=$AllRoles[0];
                $ban['pay'] = $ban_money['money']|0;
            }

            $goodslist_e=array(); //装备
            $goodslist_b=array(); //背包
    		$goodslist_m=array(); //坐骑 type = mounts
            /*
            foreach($result as $v) {
    			if($v['type']=="mounts"){
    				if($v["cur_endu"] != 0)
    					$v["end_time"] = date("Y-m-d H:i:s",$v["end_time"]);
    				$goodslist_m[]=$v;
    			}
                if($v['type'] == 7) {
                    $goodslist_e[] = $v;
                }elseif($v['type'] == 6) {
                    $goodslist_b[] = $v;
                }else{
                    $goodslist_d[] = $v;
                }
            }*/

            foreach($result as $k => $v){
                if($k == 0){
                    $goodslist_m = $v;
                }
                if($k == 1){
                    foreach($v as $val){
                        if(in_array($val['bagid'],$is_depot)){
                            $goodslist_d[] = $val;
                        }else{
                            $goodslist_b[] = $val;
                        }
                    }
                }
                if($k == 2){
                    $goodslist_e = $v;
                }
                if($k == 3){
                    $mad_id = $v;
                }
            }
            $AllRoles[0]['map'] = $mad_id;

            $smarty->assign(array(
                    'role'=>$AllRoles,
                    'equips'=>$goodslist_e,
                    'goods'=>$goodslist_b,
                    'depot' => $goodslist_d,
    				'mounts'=>$goodslist_m,
                    'role_name'=>$username
            ));

        } else {
            infoExit($buf_lang['new']['data_error'], "get_user_msg.php");
        }
    }

}
elseif($action=='kill' && trim($_POST['action_type'])=='kill_role') {
    if($username=="") {
        errorExit ( $buf_lang['new']['role_name_no_null'] );
    }
    $sqlCount="SELECT `role_id` FROM `".T_DB_ROLE_BASE_P."` WHERE `role_name` = '{$username}' ";
    $accounttemp = $db->fetchOne($sqlCount);
    $role_id=$accounttemp['role_id'];
    if(!isset($accounttemp['role_id'])) {
        errorExit ( $buf_lang['new']['role_name_no_exist'] );
    }
    $result = getJson($erlangWebAdminHost."killuser/kill_user_role/"
            ."?role_id={$role_id}");
    if ($result['result']=='ok') {
        infoExit($buf_lang['new']['kick_role_off_success'], "get_user_msg.php");
    }else {
        errorExit (  $buf_lang['new']['kick_role_off_failure'] );
    }
}elseif($action=='kill' && trim($_POST['action_type'])=='kill_role_utill') {
    if(isset($_REQUEST['ban_time'])) {
        $banTime = $_REQUEST['ban_time']*60;
    }else {
        $banTime = 9999999;
    }
    $sqlCount="SELECT `role_id` FROM `".T_DB_ROLE_BASE_P."` WHERE `role_name` = '{$username}' ";
    $accounttemp = $db->fetchOne($sqlCount);
    if($accounttemp['role_id']=="") {
        errorExit ( $buf_lang['new']['role_name_no_exist']);
    }
    $role_id=$accounttemp['role_id'];
    $result = getJson($erlangWebAdminHost."killuser/kill_role_utill/"
            ."?role_id={$role_id}&ban_time={$banTime}");

    if ($result['result']=='ok') {
        infoExit($buf_lang['new']['shield_role_success'], "get_user_msg.php");
    }else {
        errorExit ( $buf_lang['new']['shield_role_failure']);
    }
}elseif($action=='kill' && trim($_POST['action_type'])=='stop_chat') {
    if(isset($_REQUEST['chat_time'])) {
        $chatTime = intval($_REQUEST['chat_time'])*60;
    //		if ($chatTime == 0)
    //		{
    //			errorExit("请输入禁言时限");
    //		}
    }else {
        $chatTime = 9999999;
    }

    $sqlCount="SELECT `role_id` FROM `".T_DB_ROLE_BASE_P."` WHERE `role_name` = '{$username}' ";
    $accounttemp = $db->fetchOne($sqlCount);
    $role_id=$accounttemp['role_id'];
    if(!isset($accounttemp['role_id'])) {
        errorExit ($buf_lang['new']['role_name_no_exist'] );
    }
    $result = getJson($erlangWebAdminHost."killuser/stop_chat/"
            ."?role_id={$role_id}&chat_time={$chatTime}");

    if ($result['result']=='ok') {
        infoExit($buf_lang['new']['gag_success'], "get_user_msg.php");
    }else {
        errorExit ( $buf_lang['new']['gag_failure']);
    }
}


$ban_time_option = getBanTimeOption();
$smarty->assign("search_role_id", $search_role_id);
$smarty->assign("search_role_name", $search_role_name);
$smarty->assign("search_account_name",$search_account_name);
$smarty->assign("search_type", $search_type);
$smarty->assign("ban_time_option", $ban_time_option);
$smarty->assign("ban_account", $ban_account);
$smarty->assign("account", $ban);
$smarty->assign("role_result", $role_result);
$smarty->display('module/account/get_user_mge.html');


function getBanTimeOption() {
    return array(
            "null" 			    => '请选择',
            "one_hour"          => '1小时',
            "three_hour"        => '3小时',
            "five_hour"         => '5小时',
            "twenty_four_hour"  => '24小时',
            "seventy_two_hour"  => '72小时',
            "one_week"          => '1周',
            "one_month"         => '1个月',
            "forever"           => '永久'
    );
}

function getBanTime($str) {
    $BanTimeCnt = 0;
    switch ($str) {
        case "one_hour":
            $BanTimeCnt = 3600;
            break;
        case "three_hour":
            $BanTimeCnt = 10800;
            break;
        case "five_hour":
            $BanTimeCnt = 18000;
            break;
        case "twenty_four_hour":
            $BanTimeCnt = 86400;
            break;
        case "seventy_two_hour":
            $BanTimeCnt = 259200;
            break;
        case "one_week":
            $BanTimeCnt = 604800;
            break;
        case "one_month":
            $BanTimeCnt = 2592000;
            break;
        case "forever":
            $BanTimeCnt = 3153600000;   //100年
            break;
        default:
            break;
    }
    return $BanTimeCnt;
}