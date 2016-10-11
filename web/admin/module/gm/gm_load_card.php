<?php
define('IN_DATANG_SYSTEM', true);
include "../../../config/config.php";
include "../../../admin/class/admin_log_class.php";
include SYSDIR_ADMIN."/include/global.php";
include "./card_info.php";
//include "../../include/functions.php";
define('CL', "\n");
global $smarty, $cardInfo;
/*
echo '<pre>';
print_r($_REQUEST);exit;*/

$allCardInfo = $cardInfo[$AGENT_ID];

//媒体卡
$start_id = 1;
$end_id = $allCardInfo['freshCard']['num'];
$agent_flag = $allCardInfo['freshCard']['flag'];

//是否显示
if($agent_flag != "error")
{
	$show_fresh_card = true;
}
else
{
	$show_fresh_card = false;
}

$server_flag = $GAME_SERVER;
$create_fresh_sh = "php /data/sgserver/server/script/create_media_card.php ".$end_id." ".$agent_flag.$server_flag;


//独家卡
$start_id_family = 1;
$end_id_family = $allCardInfo['familyCard']['num'];
$agent_flag_family = $allCardInfo['familyCard']['flag'];

//是否显示
if($agent_flag_family != "error")
{
	$show_family_card = true;
}
else
{
	$show_family_card = false;
}

$server_flag_family = $GAME_SERVER;
$create_family_sh = "php /data/sgserver/server/script/create_dujia_card.php ".$end_id_family." ".$agent_flag_family.$server_flag_family;

//特权卡
$start_id_phone = 1;
$end_id_phone = $allCardInfo['phoneCard']['num'];
$agent_flag_phone = $allCardInfo['phoneCard']['flag'];

//是否显示
if($agent_flag_phone != "error")
{
	$show_phone_card = true;
}
else
{
	$show_phone_card = false;
}

$server_flag_phone = $GAME_SERVER;
$create_phone_sh = "php /data/sgserver/server/script/create_tequan_card.php ".$end_id_phone." ".$agent_flag_phone.$server_flag_phone;

//贡献卡
$start_id_gx = 1;
$end_id_gx = $allCardInfo['gongxianCard']['num'];
$agent_flag_gx = $allCardInfo['gongxianCard']['flag'];

//是否显示
if($agent_flag_gx != "error")
{
	$show_gx_card = true;
}
else
{
	$show_gx_card = false;
}

$server_flag_gx = $GAME_SERVER;
$create_gx_sh = "php /data/sgserver/server/script/create_gongxian_card.php ".$end_id_gx." ".$agent_flag_gx.$server_flag_gx;




//QQ群卡
$start_id_qq = 1;
$end_id_qq = $allCardInfo['qqCard']['num'];
$agent_flag_qq = $allCardInfo['qqCard']['flag'];

//是否显示
if($agent_flag_qq != "error")
{
	$show_qq_card = true;
}
else
{
	$show_qq_card = false;
}
$server_flag_qq = $GAME_SERVER;
$create_qq_sh = "php /data/sgserver/server/script/create_qq_card.php ".$end_id_qq." ".$agent_flag_qq.$server_flag_qq;


//资料补全卡
$start_id_perfectDate = 1;
$end_id_perfectDate = $allCardInfo['perfectDateCard']['num'];
$agent_flag_perfectDate = $allCardInfo['perfectDateCard']['flag'];

//是否显示
if($agent_flag_perfectDate != "error")
{
	$show_perfectDate_card = true;
}
else
{
	$show_perfectDate_card = false;
}
$server_flag_perfectDate = $GAME_SERVER;
$create_perfectDate_sh = "php /data/sgserver/server/script/create_perfectDate_card.php ".$end_id_perfectDate." ".$agent_flag_perfectDate.$server_flag_perfectDate;


//白金卡
$start_id_platina = 1;
$end_id_platina = $allCardInfo['platinaCard']['num'];
$agent_flag_platina = $allCardInfo['platinaCard']['flag'];

//是否显示
if($agent_flag_platina != "error")
{
	$show_platina_card = true;
}
else
{
	$show_platina_card = false;
}
$server_flag_platina = $GAME_SERVER;
$create_platina_sh = "php /data/sgserver/server/script/create_platina_card.php ".$end_id_platina." ".$agent_flag_platina.$server_flag_platina;

//黄金卡
$start_id_gold = 1;
$end_id_gold = $allCardInfo['goldCard']['num'];
$agent_flag_gold = $allCardInfo['goldCard']['flag'];

//是否显示
if($agent_flag_gold != "error")
{
	$show_gold_card = true;
}
else
{
	$show_gold_card = false;
}
$server_flag_gold = $GAME_SERVER;
$create_gold_sh = "php /data/sgserver/server/script/create_gold_card.php ".$end_id_gold." ".$agent_flag_gold.$server_flag_gold;

//白银卡
$start_id_silver = 1;
$end_id_silver = $allCardInfo['silverCard']['num'];
$agent_flag_silver = $allCardInfo['silverCard']['flag'];

//是否显示
if($agent_flag_silver != "error")
{
	$show_silver_card = true;
}
else
{
	$show_silver_card = false;
}
$server_flag_silver = $GAME_SERVER;
$create_silver_sh = "php /data/sgserver/server/script/create_silver_card.php ".$end_id_silver." ".$agent_flag_silver.$server_flag_silver;

//钻石卡
$start_id_jewel = 1;
$end_id_jewel = $allCardInfo['jewelCard']['num'];
$agent_flag_jewel = $allCardInfo['jewelCard']['flag'];

//是否显示
if($agent_flag_jewel != "error")
{
	$show_jewel_card = true;
}
else
{
	$show_jewel_card = false;
}
$server_flag_jewel= $GAME_SERVER;
$create_jewel_sh = "php /data/sgserver/server/script/create_jewel_card.php ".$end_id_jewel." ".$agent_flag_jewel.$server_flag_jewel;

//水晶卡
$start_id_pebble = 1;
$end_id_pebble = $allCardInfo['pebbleCard']['num'];
$agent_flag_pebble = $allCardInfo['pebbleCard']['flag'];

//是否显示
if($agent_flag_pebble != "error")
{
	$show_pebble_card = true;
}
else
{
	$show_pebble_card = false;
}
$server_flag_pebble = $GAME_SERVER;
$create_pebble_sh = "php /data/sgserver/server/script/create_pebble_card.php ".$end_id_pebble." ".$agent_flag_pebble.$server_flag_pebble;

//备用卡
$start_id_reserve1 = 1;
$end_id_reserve1 = $allCardInfo['reserve1Card']['num'];
$agent_flag_reserve1 = $allCardInfo['reserve1Card']['flag'];

//是否显示
if($agent_flag_reserve1 != "error")
{
	$show_reserve1_card = true;
}
else
{
	$show_reserve1_card = false;
}
$server_flag_reserve1 = $GAME_SERVER;
$create_reserve1_sh = "php /data/sgserver/server/script/create_reserve1_card.php ".$end_id_reserve1." ".$agent_flag_reserve1.$server_flag_reserve1;

//备用卡2
$start_id_reserve2 = 1;
$end_id_reserve2 = $allCardInfo['reserve2Card']['num'];
$agent_flag_reserve2 = $allCardInfo['reserve2Card']['flag'];

//是否显示
if($agent_flag_reserve2 != "error")
{
    $show_reserve2_card = true;
}
else
{
    $show_reserve2_card = false;
}
$server_flag_reserve2 = $GAME_SERVER;
$create_reserve2_sh = "php /data/sgserver/server/script/create_reserve2_card.php ".$end_id_reserve2." ".$agent_flag_reserve2.$server_flag_reserve1;

//备用卡3
$start_id_reserve3 = 1;
$end_id_reserve3 = $allCardInfo['reserve3Card']['num'];
$agent_flag_reserve3 = $allCardInfo['reserve3Card']['flag'];

//是否显示
if($agent_flag_reserve3 != "error")
{
    $show_reserve3_card = true;
}
else
{
    $show_reserve3_card = false;
}
$server_flag_reserve4 = $GAME_SERVER;
$create_reserve_sh = "php /data/sgserver/server/script/create_reserve4_card.php ".$end_id_reserve3." ".$agent_flag_reserve3.$server_flag_reserve4;

//备用卡4
$start_id_reserve4 = 1;
$end_id_reserve4 = $allCardInfo['reserve4Card']['num'];
$agent_flag_reserve4 = $allCardInfo['reserve4Card']['flag'];

//是否显示
if($agent_flag_reserve4 != "error")
{
    $show_reserve4_card = true;
}
else
{
    $show_reserve4_card = false;
}
$server_flag_reserve4 = $GAME_SERVER;
$create_reserve4_sh = "php /data/sgserver/server/script/create_reserve4_card.php ".$end_id_reserve4." ".$agent_flag_reserve4.$server_flag_reserve4;

//备用卡5
$start_id_reserve5 = 1;
$end_id_reserve5 = $allCardInfo['reserve5Card']['num'];
$agent_flag_reserve5 = $allCardInfo['reserve5Card']['flag'];

//是否显示
if($agent_flag_reserve5 != "error")
{
    $show_reserve5_card = true;
}
else
{
    $show_reserve5_card = false;
}
$server_flag_reserve5 = $GAME_SERVER;
$create_reserve5_sh = "php /data/sgserver/server/script/create_reserve5_card.php ".$end_id_reserve5." ".$agent_flag_reserve5.$server_flag_reserve5;

//备用卡6
$start_id_reserve6 = 1;
$end_id_reserve6 = $allCardInfo['reserve6Card']['num'];
$agent_flag_reserve6 = $allCardInfo['reserve6Card']['flag'];

//是否显示
if($agent_flag_reserve6 != "error")
{
    $show_reserve6_card = true;
}
else
{
    $show_reserve6_card = false;
}
$server_flag_reserve6 = $GAME_SERVER;
$create_reserve6_sh = "php /data/sgserver/server/script/create_reserve6_card.php ".$end_id_reserve6." ".$agent_flag_reserve6.$server_flag_reserve6;




//活动卡
if($AGENT_ID == '9' || $AGENT_ID == '26' || $AGENT_ID == '1')
{
	$show_activity_card = true;
}
else
{
	$show_activity_card = true;
}

#print_r($show_activity_card);die();



$action = trim ( $_GET ['action'] );
$type = trim($_GET['type']);
$all_arg = $_POST;

if ($action == 'do1')  //开服卡（有问题）
{

	$start_id = $all_arg['start_id'];	//开始卡号
	$end_id = $all_arg['end_id'];		//结束卡号
	$agent_flag = $all_arg['agent_flag'];	//代理商标识
	$server_flag = $all_arg['server_flag'];		//服务器标识
	$auto_load = intval($all_arg['auto_load']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$fresh_card_flag = $agent_flag.$server_flag;	//生成卡号的唯一标识
	
	$card_name = "media_gift_card";				//文件名
	
	if($type == "doCreateFreshCard")
	{
		$txt = createCard($start_id, $end_id, $fresh_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag, $card_name, $txt);
	}
	else if($type == "doLoadFreshCard")
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
		if($auto_load == 1)
		{
			createCard($start_id, $end_id, $fresh_card_flag, $card_name);
		}
		
		$result = getJson ( $erlangWebAdminHost."gm/load_card/?is_auto={$auto_load}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_CARD,'', '','', '', '');
			infoExit("导入媒体卡到游戏服务器成功");
		} else {
			infoExit("导入媒体卡到游戏服务器失败");
		}
	}
}
/*else if($action == 'do2')
{
	define('CL', "\n");
	$num = 50000;//$serverArgs[1];
	$serverID = '91wanS1';//$serverArgs[2];
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=2;$i<=$num+1;$i++){
		$str = '4399'.$serverID.'aiyou19860706'.$i;
		$md5Str = md5($str);
		$txt.=$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("festival_card.config", $erlConfig);
	
	$result = getJson ( $erlangWebAdminHost."gm/load_festival_card/");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_LOAD_FESTIVAL_CARD,'', '','', '', '');
		header("Content-type:application/txt");
		header("Content-Disposition:attachment;filename=media_card.txt");
		exit($txt);
	} else {
		infoExit("导入活动卡到游戏服务器失败");
	}
}*/
else if($action == 'do3')  //新手卡
{
	$start_id_family = $all_arg['start_id_family'];	//开始卡号
	$end_id_family = $all_arg['end_id_family'];		//结束卡号
	$agent_flag_family = $all_arg['agent_flag_family'];	//代理商标识
	$server_flag_family = $all_arg['server_flag_family'];		//服务器标识
	$auto_load_family = intval($all_arg['auto_load_family']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$family_card_flag = $agent_flag_family.$server_flag_family;	//生成卡号的唯一标识
	
	$card_name = "dujia_gift_card";				//文件名
	
	if($type == "doCreateFamilyCard")
	{
		$txt = createCardFamily($start_id_family, $end_id_family, $family_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag_family, $card_name, $txt);
	}
	else
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
        //echo $auto_load_family;exit;
		if($auto_load_family == 1)
		{
			createCardFamily($start_id_family, $end_id_family, $family_card_flag, $card_name);
		}
		
		$result = getJson ( $erlangWebAdminHost."gm/load_family_card/?is_auto={$auto_load_family}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
			infoExit("导入独家卡到游戏服务器成功");
		} else {
			infoExit("导入独家卡到游戏服务器失败");
		}
	}
}
else if($action == 'do4')  //特权卡  电话卡
{
	$start_id_phone = $all_arg['start_id_phone'];	//开始卡号
	$end_id_phone = $all_arg['end_id_phone'];		//结束卡号
	$agent_flag_phone = $all_arg['agent_flag_phone'];	//代理商标识
	$server_flag_phone = $all_arg['server_flag_phone'];		//服务器标识
	$auto_load_phone = intval($all_arg['auto_load_phone']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$phone_card_flag = $agent_flag_phone.$server_flag_phone;	//生成卡号的唯一标识
	
	$card_name = "tequan_gift_card";				//文件名
	
	if($type == "doCreatePhoneCard")
	{
		$txt = createCardPhone($start_id_phone, $end_id_phone, $phone_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag_phone, $card_name, $txt);
	}
	else
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
		if($auto_load_phone == 1)
		{
			createCardPhone($start_id_phone, $end_id_phone, $phone_card_flag, $card_name);
		}
		
		$result = getJson ( $erlangWebAdminHost."gm/load_phone_card/?is_auto={$auto_load_phone}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
			infoExit("导入手机绑定卡到游戏服务器成功");
		} else {
			infoExit("导入手机绑定卡到游戏服务器失败");
		}
	}
}
else if($action == 'do5')  //贡献卡
{
	$start_id_gx = $all_arg['start_id_gx'];	//开始卡号
	$end_id_gx = $all_arg['end_id_gx'];		//结束卡号
	$agent_flag_gx = $all_arg['agent_flag_gx'];	//代理商标识
	$server_flag_gx = $all_arg['server_flag_gx'];		//服务器标识
	$auto_load_gx = intval($all_arg['auto_load_gx']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$gx_card_flag = $agent_flag_gx.$server_flag_gx;	//生成卡号的唯一标识
	
	$card_name = "gongxian_gift_card";				//文件名
	
	if($type == "doCreateGXCard")
	{
		$txt = createCardGongxian($start_id_gx, $end_id_gx, $gx_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag_gx, $card_name, $txt);
	}
	else if($type == "doLoadGXCard")
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
		if($auto_load_gx == 1)
		{
			createCardGongxian($start_id_gx, $end_id_gx, $gx_card_flag, $card_name);
		}
		
		$result = getJson ( $erlangWebAdminHost."gm/load_gongxian_card/?is_auto={$auto_load_gx}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
			infoExit("导入贡献卡到游戏服务器成功");
		} else {
			infoExit("导入贡献卡到游戏服务器失败");
		}
	}
}
else if($action == 'do6')  //QQ群卡
{
	$start_id_qq = $all_arg['start_id_qq'];	//开始卡号
	$end_id_qq = $all_arg['end_id_qq'];		//结束卡号
	$agent_flag_qq = $all_arg['agent_flag_qq'];	//代理商标识
	$server_flag_qq = $all_arg['server_flag_qq'];		//服务器标识
	$auto_load_qq = intval($all_arg['auto_load_qq']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$qq_card_flag = $agent_flag_qq.$server_flag_qq;	//生成卡号的唯一标识
	
	$card_name = "qq_gift_card";				//文件名
	
	if($type == "doCreateQQCard")
	{
		$txt = createCardQQ($start_id_qq, $end_id_qq, $qq_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag_qq, $card_name, $txt);
	}
	else
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
		if($auto_load_qq == 1)
		{
			createCardQQ($start_id_qq, $end_id_qq, $qq_card_flag, $card_name);
		}
		
		$result = getJson ( $erlangWebAdminHost."gm/load_qq_card/?is_auto={$auto_load_qq}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
			infoExit("导入QQ群卡到游戏服务器成功");
		} else {
			infoExit("导入QQ群卡到游戏服务器失败");
		}
	}
}
else if($action == 'do7')  //资料完善卡
{
    $start_id_perfectDate = $all_arg['start_id_perfectDate'];	//开始卡号
	$end_id_perfectDate = $all_arg['end_id_perfectDate'];		//结束卡号
	$agent_flag_perfectDate = $all_arg['agent_flag_perfectDate'];	//代理商标识
	$server_flag_perfectDate = $all_arg['server_flag_perfectDate'];		//服务器标识
	$auto_load_perfectDate = intval($all_arg['auto_load_perfectDateCard']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$perfectDate_card_flag = $agent_flag_perfectDate.$server_flag_perfectDate;	//生成卡号的唯一标识

	$card_name = "perfectDate_gift_card";				//文件名
    //echo  $type;exit;
	if($type == "doCreatePerfectDateCard")
	{
		$txt = createCardPerfectDate($start_id_perfectDate, $end_id_perfectDate, $perfectDate_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag_perfectDate, $card_name, $txt);
	}
	else
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
		if($auto_load_perfectDateCard == 1)
		{
			createCardPerfectDate($start_id_perfectDate, $end_id_perfectDate, $perfectDate_card_flag, $card_name);
		}

		$result = getJson ( $erlangWebAdminHost."gm/load_perfectDate_card/?is_auto={$auto_load_perfectDate}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
			infoExit("导入资料完善卡到游戏服务器成功");
		} else {
			infoExit("导入资料完善卡到游戏服务器失败");
		}
	}
}
else if($action == 'do18')  //白金卡
{
	$start_id_platina = $all_arg['start_id_platina'];	//开始卡号
	$end_id_platina = $all_arg['end_id_platina'];		//结束卡号
	$agent_flag_platina = $all_arg['agent_flag_platina'];	//代理商标识
	$server_flag_platina = $all_arg['server_flag_platina'];		//服务器标识
	$auto_load_platina = intval($all_arg['auto_load_platina']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$platina_card_flag = $agent_flag_platina.$server_flag_platina;	//生成卡号的唯一标识

	$card_name = "platina_gift_card";				//文件名

	if($type == "doCreatePlatinaCard")
	{

		$txt = createCardPlatina($start_id_platina, $end_id_platina, $platina_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag_platina, $card_name, $txt);
	}
	else
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
		if($auto_load_platina == 1)
		{
			createCardPlatina($start_id_platina, $end_id_platina, $platina_card_flag, $card_name);
		}

		$result = getJson ( $erlangWebAdminHost."gm/load_platina_card/?is_auto={$auto_load_platina}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
			infoExit("导入铂金卡到游戏服务器成功");
		} else {
			infoExit("导入铂金卡到游戏服务器失败");
		}
	}
}
else if($action == 'do8')  //黄金卡
{
    $start_id_gold = $all_arg['start_id_gold'];	//开始卡号
    $end_id_gold = $all_arg['end_id_gold'];		//结束卡号
    $agent_flag_gold = $all_arg['agent_flag_gold'];	//代理商标识
    $server_flag_gold = $all_arg['server_flag_gold'];		//服务器标识
    $auto_load_gold = intval($all_arg['auto_load_gold']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
    $gold_card_flag = $agent_flag_gold.$server_flag_gold;	//生成卡号的唯一标识

    $card_name = "gold_gift_card";				//文件名

    if($type == "doCreateGoldCard")
    {

        $txt = createCardGold($start_id_gold, $end_id_gold, $gold_card_flag, $card_name);
        saveCard($allCardInfo['agentName'], $server_flag_gold, $card_name, $txt);
    }
    else
    {
        //自动导卡时生成文件到当前目录web/admin/module/gm
        //否则远程登录服务器执行脚本生成到文件到config/map路径
        if($auto_load_gold == 1)
        {
            createCardGold($start_id_gold, $end_id_gold, $gold_card_flag, $card_name);
        }

        $result = getJson ( $erlangWebAdminHost."gm/load_gold_card/?is_auto={$auto_load_gold}");
        if ($result['result'] == 'ok') {
            $loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
            infoExit("导入黄金卡到游戏服务器成功");
        } else {
            infoExit("导入黄金卡到游戏服务器失败");
        }
    }
}
else if($action == 'do11')  //白银卡
{

	$start_id_silver = $all_arg['start_id_silver'];	//开始卡号
	$end_id_silver = $all_arg['end_id_silver'];		//结束卡号
	$agent_flag_silver = $all_arg['agent_flag_silver'];	//代理商标识
	$server_flag_silver = $all_arg['server_flag_silver'];		//服务器标识
	$auto_load_silver = intval($all_arg['auto_load_silver']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$silver_card_flag = $agent_flag_silver.$server_flag_silver;	//生成卡号的唯一标识

	$card_name = "silver_gift_card";				//文件名

	if($type == "doCreateSilverCard")
	{
		$txt = createCardSilver($start_id_silver, $end_id_silver, $silver_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag_silver, $card_name, $txt);
	}
	else
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
		if($auto_load_silver == 1)
		{
			createCardSilver($start_id_silver, $end_id_silver, $silver_card_flag, $card_name);
		}

		$result = getJson ( $erlangWebAdminHost."gm/load_silver_card/?is_auto={$auto_load_silver}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
			infoExit("导入白银卡到游戏服务器成功");
		} else {
			infoExit("导入白银卡到游戏服务器失败");
		}
	}
}
else if($action == 'do9')  //钻石卡
{
	$start_id_jewel = $all_arg['start_id_jewel'];	//开始卡号
	$end_id_jewel = $all_arg['end_id_jewel'];		//结束卡号
	$agent_flag_jewel = $all_arg['agent_flag_jewel'];	//代理商标识
	$server_flag_jewel = $all_arg['server_flag_jewel'];		//服务器标识
	$auto_load_jewel = intval($all_arg['auto_load_jewel']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$jewel_card_flag = $agent_flag_jewel.$server_flag_jewel;	//生成卡号的唯一标识

	$card_name = "jewel_gift_card";				//文件名

	if($type == "doCreateJewelCard")
	{
		$txt = createCardJewel($start_id_jewel, $end_id_jewel, $jewel_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag_jewel, $card_name, $txt);
	}
	else
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
		if($auto_load_jewel == 1)
		{
			createCardJewel($start_id_jewel, $end_id_jewel, $jewel_card_flag, $card_name);
		}

		$result = getJson ( $erlangWebAdminHost."gm/load_jewel_card/?is_auto={$auto_load_jewel}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
			infoExit("导入钻石卡到游戏服务器成功");
		} else {
			infoExit("导入钻石卡到游戏服务器失败");
		}
	}
}
else if($action == 'do10')  //水晶卡
{
	$start_id_pebble = $all_arg['start_id_pebble'];	//开始卡号
	$end_id_pebble = $all_arg['end_id_pebble'];		//结束卡号
	$agent_flag_pebble = $all_arg['agent_flag_pebble'];	//代理商标识
	$server_flag_pebble = $all_arg['server_flag_pebble'];		//服务器标识
	$auto_load_pebble = intval($all_arg['auto_load_pebble']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
	$pebble_card_flag = $agent_flag_pebble.$server_flag_pebble;	//生成卡号的唯一标识

	$card_name = "pebble_gift_card";				//文件名

	if($type == "doCreatePebbleCard")
	{
		$txt = createCardPebble($start_id_pebble, $end_id_pebble, $pebble_card_flag, $card_name);
		saveCard($allCardInfo['agentName'], $server_flag_pebble, $card_name, $txt);
	}
	else
	{
		//自动导卡时生成文件到当前目录web/admin/module/gm
		//否则远程登录服务器执行脚本生成到文件到config/map路径
		if($auto_load_pebble == 1)
		{
			createCardPebble($start_id_pebble, $end_id_pebble, $pebble_card_flag, $card_name);
		}

		$result = getJson ( $erlangWebAdminHost."gm/load_pebble_card/?is_auto={$auto_load_pebble}");
		if ($result['result'] == 'ok') {
			$loger = new AdminLogClass();
			$loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
			infoExit("导入水晶卡到游戏服务器成功");
		} else {
			infoExit("导入水晶卡到游戏服务器失败");
		}
	}
}
else if($action == 'do12')  //备用卡
{
    //print_r($all_arg);exit;
    $start_id_reserve1 = $all_arg['start_id_reserve1'];	//开始卡号
    $end_id_reserve1 = $all_arg['end_id_reserve1'];		//结束卡号
    $agent_flag_reserve1 = $all_arg['agent_flag_reserve1'];	//代理商标识
    $server_flag_reserve1 = $all_arg['server_flag_reserve1'];		//服务器标识
    $auto_load_reserve1 = intval($all_arg['auto_load_reserve1']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
    $reserve1_card_flag = $agent_flag_reserve1.$server_flag_reserve1;	//生成卡号的唯一标识

    $card_name = "reserve1_gift_card";				//文件名

    if($type == "doCreateReserve1Card")
    {
        $txt = createCardReserve1($start_id_reserve1, $end_id_reserve1, $reserve1_card_flag, $card_name);
        saveCard($allCardInfo['agentName'], $server_flag_reserve1, $card_name, $txt);
    }else{
        //自动导卡时生成文件到当前目录web/admin/module/gm
        //否则远程登录服务器执行脚本生成到文件到config/map路径
        if($auto_load_reserve1 == 1)
        {
            createCardReserve1($start_id_reserve1, $end_id_reserve1, $reserve1_card_flag, $card_name);
        }

        $result = getJson( $erlangWebAdminHost."gm/load_reserve1_card/?is_auto={$auto_load_reserve1}");
        if ($result['result'] == 'ok') {
            $loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
            infoExit("导入备用卡1到游戏服务器成功");
        } else {
            infoExit("导入备用卡1到游戏服务器失败");
        }
    }
}
else if($action == 'do13')  //备用卡2
{
    $start_id_reserve2 = $all_arg['start_id_reserve2'];	//开始卡号
    $end_id_reserve2 = $all_arg['end_id_reserve2'];		//结束卡号
    $agent_flag_reserve2 = $all_arg['agent_flag_reserve2'];	//代理商标识
    $server_flag_reserve2 = $all_arg['server_flag_reserve2'];		//服务器标识
    $auto_load_reserve2 = intval($all_arg['auto_load_reserve2']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
    $reserve2_card_flag = $agent_flag_reserve2.$server_flag_reserve2;	//生成卡号的唯一标识

    $card_name = "reserve2_gift_card";				//文件名

    if($type == "doCreateReserve2Card")
    {
        $txt = createCardReserve2($start_id_reserve2, $end_id_reserve2, $reserve2_card_flag, $card_name);
        saveCard($allCardInfo['agentName'], $server_flag_reserve2, $card_name, $txt);
    }
    else
    {
        //自动导卡时生成文件到当前目录web/admin/module/gm
        //否则远程登录服务器执行脚本生成到文件到config/map路径
        if($auto_load_reserve2 == 1)
        {
            createCardReserve2($start_id_reserve2, $end_id_reserve2, $reserve2_card_flag, $card_name);
        }

        $result = getJson ( $erlangWebAdminHost."gm/load_reserve2_card/?is_auto={$auto_load_reserve2}");
        if ($result['result'] == 'ok') {
            $loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
            infoExit("导入备用卡2到游戏服务器成功");
        } else {
            infoExit("导入备用卡2到游戏服务器失败");
        }
    }
}
else if($action == 'do14')  //备用卡3
{
    $start_id_reserve3 = $all_arg['start_id_reserve3'];	//开始卡号
    $end_id_reserve3 = $all_arg['end_id_reserve3'];		//结束卡号
    $agent_flag_reserve3 = $all_arg['agent_flag_reserve3'];	//代理商标识
    $server_flag_reserve3 = $all_arg['server_flag_reserve3'];		//服务器标识
    $auto_load_reserve3 = intval($all_arg['auto_load_reserve3']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
    $reserve3_card_flag = $agent_flag_reserve3.$server_flag_reserve3;	//生成卡号的唯一标识

    $card_name = "reserve3_gift_card";				//文件名

    if($type == "doCreateReserve3Card")
    {
        $txt = createCardReserve3($start_id_reserve3, $end_id_reserve3, $reserve3_card_flag, $card_name);
        saveCard($allCardInfo['agentName'], $server_flag_reserve3, $card_name, $txt);
    }
    else
    {
        //自动导卡时生成文件到当前目录web/admin/module/gm
        //否则远程登录服务器执行脚本生成到文件到config/map路径
        if($auto_load_reserve3 == 1)
        {
            createCardReserve3($start_id_reserve3, $end_id_reserve3, $reserve3_card_flag, $card_name);
        }

        $result = getJson ( $erlangWebAdminHost."gm/load_reserve3_card/?is_auto={$auto_load_reserve3}");
        if ($result['result'] == 'ok') {
            $loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
            infoExit("导入备用卡3到游戏服务器成功");
        } else {
            infoExit("导入备用卡3到游戏服务器失败");
        }
    }
}
else if($action == 'do15')  //备用卡4
{
    $start_id_reserve4 = $all_arg['start_id_reserve4'];	//开始卡号
    $end_id_reserve4 = $all_arg['end_id_reserve4'];		//结束卡号
    $agent_flag_reserve4 = $all_arg['agent_flag_reserve4'];	//代理商标识
    $server_flag_reserve4 = $all_arg['server_flag_reserve4'];		//服务器标识
    $auto_load_reserve4 = intval($all_arg['auto_load_reserve4']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
    $reserve4_card_flag = $agent_flag_reserve4.$server_flag_reserve4;	//生成卡号的唯一标识

    $card_name = "reserve4_gift_card";				//文件名

    if($type == "doCreateReserve4Card")
    {
        $txt = createCardReserve4($start_id_reserve4, $end_id_reserve4, $reserve4_card_flag, $card_name);
        saveCard($allCardInfo['agentName'], $server_flag_reserve4, $card_name, $txt);
    }else{
        //自动导卡时生成文件到当前目录web/admin/module/gm
        //否则远程登录服务器执行脚本生成到文件到config/map路径
        if($auto_load_reserve4 == 1)
        {
            createCardReserve4($start_id_reserve4, $end_id_reserve4, $reserve4_card_flag, $card_name);
        }

        $result = getJson ( $erlangWebAdminHost."gm/load_reserve4_card/?is_auto={$auto_load_reserve4}");
        if ($result['result'] == 'ok') {
            $loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
            infoExit("导入备用卡4到游戏服务器成功");
        } else {
            infoExit("导入备用卡4到游戏服务器失败");
        }
    }
}
else if($action == 'do16')  //备用卡5
{
    $start_id_reserve5 = $all_arg['start_id_reserve5'];	//开始卡号
    $end_id_reserve5 = $all_arg['end_id_reserve5'];		//结束卡号
    $agent_flag_reserve5 = $all_arg['agent_flag_reserve5'];	//代理商标识
    $server_flag_reserve5 = $all_arg['server_flag_reserve5'];		//服务器标识
    $auto_load_reserve5 = intval($all_arg['auto_load_reserve5']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
    $reserve5_card_flag = $agent_flag_reserve5.$server_flag_reserve5;	//生成卡号的唯一标识

    $card_name = "reserve5_gift_card";				//文件名

    if($type == "doCreateReserve5Card")
    {
        $txt = createCardReserve5($start_id_reserve5, $end_id_reserve5, $reserve5_card_flag, $card_name);
        saveCard($allCardInfo['agentName'], $server_flag_reserve5, $card_name, $txt);
    }else{
        //自动导卡时生成文件到当前目录web/admin/module/gm
        //否则远程登录服务器执行脚本生成到文件到config/map路径
        //echo $auto_load_reserve5;exit;
        if($auto_load_reserve5 == 1)
        {
            createCardReserve5($start_id_reserve5, $end_id_reserve5, $reserve5_card_flag, $card_name);
        }

        $result = getJson ( $erlangWebAdminHost."gm/load_reserve5_card/?is_auto={$auto_load_reserve5}");
        if ($result['result'] == 'ok') {
            $loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
            infoExit("导入备用卡5到游戏服务器成功");
        } else {
            infoExit("导入备用卡5到游戏服务器失败");
        }
    }
}
else if($action == 'do17')  //备用卡6
{
    $start_id_reserve6 = $all_arg['start_id_reserve6'];	//开始卡号
    $end_id_reserve6 = $all_arg['end_id_reserve6'];		//结束卡号
    $agent_flag_reserve6 = $all_arg['agent_flag_reserve6'];	//代理商标识
    $server_flag_reserve6 = $all_arg['server_flag_reserve6'];		//服务器标识
    $auto_load_reserve6 = intval($all_arg['auto_load_reserve6']);		//1为自动导卡：生成并导入   0为手动：手工生成，导入
    $reserve6_card_flag = $agent_flag_reserve6.$server_flag_reserve6;	//生成卡号的唯一标识

    $card_name = "reserve6_gift_card";				//文件名

    if($type == "doCreateReserve6Card")
    {
        $txt = createCardReserve6($start_id_reserve6, $end_id_reserve6, $reserve6_card_flag, $card_name);
        saveCard($allCardInfo['agentName'], $server_flag_reserve6, $card_name, $txt);
    }else{
        //自动导卡时生成文件到当前目录web/admin/module/gm
        //否则远程登录服务器执行脚本生成到文件到config/map路径
        if($auto_load_reserve6 == 1)
        {
            createCardReserve6($start_id_reserve6, $end_id_reserve6, $reserve6_card_flag, $card_name);
        }

        $result = getJson ( $erlangWebAdminHost."gm/load_reserve6_card/?is_auto={$auto_load_reserve6}");
        if ($result['result'] == 'ok') {
            $loger = new AdminLogClass();
            $loger->Log( AdminLogClass::TYPE_LOAD_FAMILY_CARD,'', '','', '', '');
            infoExit("导入备用卡6到游戏服务器成功");
        } else {
            infoExit("导入备用卡6到游戏服务器失败");
        }
    }
}
else if($action == 'do21')
{
    /*echo '<pre>';
    print_r($_REQUEST);exit;*/
    $card_id = $_REQUEST['card_id'];
    $key = 'youdong1010g';
	$num = trim ($_POST ['create_count']);
	if (empty($num))
	{
		errorExit ( "请输入创建的数量！" );
	}

    if($card_id <28){
        errorExit("输入的卡ID请大于28");
    }

	$serverID = trim ( $_POST ['key_info'] );
	if ($serverID == '') {
		errorExit ( "请输入Key" );
	}
	$num = intval($num);

	if ($num > 50000)
	{
		errorExit ( "不能创建超过5W个卡号！" );
	}


	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=2;$i<=$num+1;$i++){
		$str = $serverID.$key.$i.$card_id;
		$md5Str = $card_id.md5($str);
		$txt.=$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("common_card_{$card_id}.config", $erlConfig);
	
	$result = getJson ( $erlangWebAdminHost."gm/common_card/?card_no={$card_id}");
	if ($result['result'] == 'ok') {
		$loger = new AdminLogClass();
		$loger->Log( AdminLogClass::TYPE_LOAD_FESTIVAL_CARD,'', '','', '', '');
		header("Content-type:application/txt");
		header("Content-Disposition:attachment;filename=media_card_{$card_id}.txt");
		exit($txt);
	} else {
		infoExit("导入活动卡到游戏服务器失败");
	}
}

function createCard($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = 'qq'.$card_flag.'media201312'.$i;
		$md5Str = md5($str);
		$txt.=$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function createCardFamily($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = 'qq'.$card_flag.'dujia201312'.$i;
		$md5Str = md5($str);
		$txt.= "11".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"11'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function createCardPhone($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'tequan20130927'.$i;
		$md5Str = md5($str);
		$txt.="14".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"14'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function createCardGongxian($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'gongxian20131022'.$i;
		$md5Str = md5($str);
		$txt.=$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function createCardQQ($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'qq20131022'.$i;
		$md5Str = md5($str);
		$txt.= "12".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"12'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function createCardPerfectDate($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'perfectDate20150801'.$i;
		$md5Str = md5($str);
		$txt.="13".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"13'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function createCardPlatina($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'platina20150801'.$i;
		$md5Str = md5($str);
		$txt.= "15".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"15'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function createCardGold($start_id, $end_id, $card_flag, $card_name)
{
    $txt="";
    $erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
    for($i=$start_id;$i<=$end_id+50;$i++){
        $str = '内测'.$card_flag.'gold20150801'.$i;
        $md5Str = md5($str);
        $txt.= "16".$md5Str.CL;
        $erlConfig.='{r_newman_gift_card,"16'.$md5Str.'",1,0,""}.'.CL;
    }
    file_put_contents("{$card_name}.txt", $txt);
    file_put_contents("{$card_name}.config", $erlConfig);
    return $txt;
}

function createCardSilver($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'silver20150801'.$i;
		$md5Str = md5($str);
		$txt.= "17".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"17'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function createCardJewel($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'Jewel20150801'.$i;
		$md5Str = md5($str);
		$txt.= "18".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"18'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function createCardPebble($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'pebble20150801'.$i;
		$md5Str = md5($str);
		$txt.= "19".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"19'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}
function createCardReserve1($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'reserve120150801'.$i;
		$md5Str = md5($str);
		$txt.= "20".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"20'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}
function createCardReserve2($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'reserve220150801'.$i;
		$md5Str = md5($str);
		$txt.= "21".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"21'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}
function createCardReserve3($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'reserve320150801'.$i;
		$md5Str = md5($str);
		$txt.= "22".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"22'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}
function createCardReserve4($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'reserve420150801'.$i;
		$md5Str = md5($str);
		$txt.= "23".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"23'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}
function createCardReserve5($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'reserve520150801'.$i;
		$md5Str = md5($str);
		$txt.= "24".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"24'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}
function createCardReserve6($start_id, $end_id, $card_flag, $card_name)
{
	$txt="";
	$erlConfig='%%-record(r_newman_gift_card,{card_num, state, role_id,account_name}).'.CL;
	for($i=$start_id;$i<=$end_id+50;$i++){
		$str = '内测'.$card_flag.'reserve620150801'.$i;
		$md5Str = md5($str);
		$txt.= "25".$md5Str.CL;
		$erlConfig.='{r_newman_gift_card,"25'.$md5Str.'",1,0,""}.'.CL;
	}
	file_put_contents("{$card_name}.txt", $txt);
	file_put_contents("{$card_name}.config", $erlConfig);
	return $txt;
}

function saveCard($agentName, $server_flag, $card_name, $txt)
{
	$file_name = $agentName."_S".$server_flag."_".$card_name.".txt";
	header("Content-type:application/txt");
	header("Content-Disposition:attachment;filename={$file_name}");
	exit($txt);
}


$smarty->assign("show_fresh_card", $show_fresh_card);
$smarty->assign("start_id", $start_id);
$smarty->assign("end_id", $end_id);
$smarty->assign("agent_flag", $agent_flag);
$smarty->assign("server_flag", $server_flag);
$smarty->assign("create_fresh_sh", $create_fresh_sh);

$smarty->assign("show_family_card", $show_family_card);
$smarty->assign("start_id_family", $start_id_family);
$smarty->assign("end_id_family", $end_id_family);
$smarty->assign("agent_flag_family", $agent_flag_family);
$smarty->assign("server_flag_family", $server_flag_family);
$smarty->assign("create_family_sh", $create_family_sh);

$smarty->assign("show_phone_card", $show_phone_card);
$smarty->assign("start_id_phone", $start_id_phone);
$smarty->assign("end_id_phone", $end_id_phone);
$smarty->assign("agent_flag_phone", $agent_flag_phone);
$smarty->assign("server_flag_phone", $server_flag_phone);
$smarty->assign("create_phone_sh", $create_phone_sh);

$smarty->assign("show_gx_card", $show_gx_card);
$smarty->assign("start_id_gx", $start_id_gx);
$smarty->assign("end_id_gx", $end_id_gx);
$smarty->assign("agent_flag_gx", $agent_flag_gx);
$smarty->assign("server_flag_gx", $server_flag_gx);
$smarty->assign("create_gx_sh", $create_gx_sh);

$smarty->assign("show_qq_card", $show_qq_card);
$smarty->assign("start_id_qq", $start_id_qq);
$smarty->assign("end_id_qq", $end_id_qq);
$smarty->assign("agent_flag_qq", $agent_flag_qq);
$smarty->assign("server_flag_qq", $server_flag_qq);
$smarty->assign("create_qq_sh", $create_qq_sh);

$smarty->assign("show_perfectDate_card", $show_perfectDate_card);
$smarty->assign("start_id_perfectDate", $start_id_perfectDate);
$smarty->assign("end_id_perfectDate", $end_id_perfectDate);
$smarty->assign("agent_flag_perfectDate", $agent_flag_perfectDate);
$smarty->assign("server_flag_perfectDate", $server_flag_perfectDate);
$smarty->assign("create_perfectDate_sh", $create_perfectDate_sh);

$smarty->assign("show_platina_card", $show_platina_card);
$smarty->assign("start_id_platina", $start_id_platina);
$smarty->assign("end_id_platina", $end_id_platina);
$smarty->assign("agent_flag_platina", $agent_flag_platina);
$smarty->assign("server_flag_platina", $server_flag_platina);
$smarty->assign("create_platina_sh", $create_platina_sh);

$smarty->assign("show_gold_card", $show_gold_card);
$smarty->assign("start_id_gold", $start_id_gold);
$smarty->assign("end_id_gold", $end_id_gold);
$smarty->assign("agent_flag_gold", $agent_flag_gold);
$smarty->assign("server_flag_gold", $server_flag_gold);
$smarty->assign("create_gold_sh", $create_gold_sh);

$smarty->assign("show_silver_card", $show_silver_card);
$smarty->assign("start_id_silver", $start_id_silver);
$smarty->assign("end_id_silver", $end_id_silver);
$smarty->assign("agent_flag_silver", $agent_flag_silver);
$smarty->assign("server_flag_silver", $server_flag_silver);
$smarty->assign("create_silver_sh", $create_silver_sh);


$smarty->assign("show_jewel_card", $show_jewel_card);
$smarty->assign("start_id_jewel", $start_id_jewel);
$smarty->assign("end_id_jewel", $end_id_jewel);
$smarty->assign("agent_flag_jewel", $agent_flag_jewel);
$smarty->assign("server_flag_jewel", $server_flag_jewel);
$smarty->assign("create_jewel_sh", $create_jewel_sh);

$smarty->assign("show_pebble_card", $show_pebble_card);
$smarty->assign("start_id_pebble", $start_id_pebble);
$smarty->assign("end_id_pebble", $end_id_pebble);
$smarty->assign("agent_flag_pebble", $agent_flag_pebble);
$smarty->assign("server_flag_pebble", $server_flag_pebble);
$smarty->assign("create_pebble_sh", $create_pebble_sh);

$smarty->assign("show_reserve1_card", $show_reserve1_card);
$smarty->assign("start_id_reserve1", $start_id_reserve1);
$smarty->assign("end_id_reserve1", $end_id_reserve1);
$smarty->assign("agent_flag_reserve1", $agent_flag_reserve1);
$smarty->assign("server_flag_reserve1", $server_flag_reserve1);
$smarty->assign("create_reserve1_sh", $create_reserve1_sh);

$smarty->assign("show_reserve2_card", $show_reserve2_card);
$smarty->assign("start_id_reserve2", $start_id_reserve2);
$smarty->assign("end_id_reserve2", $end_id_reserve2);
$smarty->assign("agent_flag_reserve2", $agent_flag_reserve2);
$smarty->assign("server_flag_reserve2", $server_flag_reserve2);
$smarty->assign("create_reserve2_sh", $create_reserve2_sh);

$smarty->assign("show_reserve3_card", $show_reserve3_card);
$smarty->assign("start_id_reserve3", $start_id_reserve3);
$smarty->assign("end_id_reserve3", $end_id_reserve3);
$smarty->assign("agent_flag_reserve3", $agent_flag_reserve3);
$smarty->assign("server_flag_reserve3", $server_flag_reserve3);
$smarty->assign("create_reserve3_sh", $create_reserve3_sh);

$smarty->assign("show_reserve4_card", $show_reserve4_card);
$smarty->assign("start_id_reserve4", $start_id_reserve4);
$smarty->assign("end_id_reserve4", $end_id_reserve4);
$smarty->assign("agent_flag_reserve4", $agent_flag_reserve4);
$smarty->assign("server_flag_reserve4", $server_flag_reserve4);
$smarty->assign("create_reserve4_sh", $create_reserve4_sh);

$smarty->assign("show_reserve5_card", $show_reserve5_card);
$smarty->assign("start_id_reserve5", $start_id_reserve5);
$smarty->assign("end_id_reserve5", $end_id_reserve5);
$smarty->assign("agent_flag_reserve5", $agent_flag_reserve5);
$smarty->assign("server_flag_reserve5", $server_flag_reserve5);
$smarty->assign("create_reserve5_sh", $create_reserve5_sh);

$smarty->assign("show_reserve6_card", $show_reserve6_card);
$smarty->assign("start_id_reserve6", $start_id_reserve6);
$smarty->assign("end_id_reserve6", $end_id_reserve6);
$smarty->assign("agent_flag_reserve6", $agent_flag_reserve6);
$smarty->assign("server_flag_reserv61", $server_flag_reserve6);
$smarty->assign("create_reserve6_sh", $create_reserve6_sh);


$smarty->assign("show_activity_card", $show_activity_card);

$smarty->display("module/gm/gm_load_card.html");
