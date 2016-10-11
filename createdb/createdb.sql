CREATE TABLE `xy_battle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_type` varchar(10) DEFAULT NULL COMMENT '玩法名称',
  `root_mark` tinyint(11) DEFAULT NULL COMMENT '0表示未root/未越狱，1表示已root/已越狱',
  `begin_zhanli` int(11) DEFAULT NULL COMMENT '开始时队伍战力，由武将和士兵战力决定',
  `player_geneal_max_attribute` varchar(3000) DEFAULT NULL COMMENT '我方武将最高属性',
  `soldier_begin` varchar(3000) DEFAULT NULL COMMENT '开始时士兵信息，记录士兵ID，名称，等级，等阶',
  `food_cost` int(11) DEFAULT NULL COMMENT '关卡消耗的军粮数值',
  `task_id` int(11) DEFAULT NULL COMMENT '关卡名称',
  `enemy_soldier_get` int(11) DEFAULT NULL,
  `food_end` int(11) DEFAULT NULL COMMENT '关卡结束时军粮数值',
  `role_id` bigint(20) DEFAULT NULL,
  `food_get` int(11) DEFAULT NULL COMMENT '关卡获得的军粮数值',
  `ip` char(15) DEFAULT NULL,
  `star` smallint(6) DEFAULT NULL COMMENT '通过星级',
  `player_soldier_max_attribute` varchar(5000) DEFAULT NULL COMMENT '我方士兵最高属性',
  `end_state` int(11) DEFAULT NULL COMMENT '通过结果，0代表失败、1代表通关',
  `soldier_get` int(11) DEFAULT NULL COMMENT '我方的士兵生成数量',
  `udid` varchar(50) DEFAULT NULL,
  `enemy_general_min_attribute` varchar(8500) DEFAULT NULL COMMENT '敌方武将最低属性',
  `player_level` smallint(6) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `begin_time` int(10) DEFAULT NULL COMMENT '开始关卡时间',
  `food_begin` int(11) DEFAULT NULL COMMENT '关卡开始军粮初始数值',
  `behit_damage` int(11) DEFAULT NULL COMMENT '我方承受敌方伤害的数值总和',
  `role_name` varchar(20) DEFAULT NULL,
  `end_time` int(10) DEFAULT NULL COMMENT '结束关卡时间',
  `server` varchar(10) DEFAULT NULL,
  `old_account_id` varchar(50) DEFAULT NULL,
  `vip` tinyint(4) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `account_id` varchar(50) DEFAULT NULL,
  `hit_damage` int(11) DEFAULT NULL COMMENT '我方攻击敌方的伤害值总和',
  `heros_begin` varchar(2000) DEFAULT NULL COMMENT '开始时记录武将id，名称，等级，类型，等阶，星级)',
  `play_time` int(11) DEFAULT NULL COMMENT '关卡消耗时间（秒）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `channel` varchar(20) DEFAULT NULL,
  `chat_role_vip` tinyint(4) DEFAULT NULL,
  `chat_target_vip` smallint(6) DEFAULT NULL,
  `chat_time` int(10) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `device_model` varchar(15) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `target_id` smallint(6) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_createrole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `app_ver` varchar(8) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `device_model` varchar(50) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `ipv6` varchar(40) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `nation` smallint(6) DEFAULT '86',
  `old_accountid` varchar(50) DEFAULT NULL,
  `os_name` varchar(15) DEFAULT NULL,
  `os_ver` varchar(8) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `role_no` varchar(10) DEFAULT NULL COMMENT '角色创建标示玩家创建的序号。（一个账号可在多个服务器创建角色，第一个创建的角色role_no = 1；第一个创建的角色role_no = 2，以此类推。）',
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_dailycheckin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `goods` varchar(500) DEFAULT NULL COMMENT '本次签到获得',
  `last_sign_time` int(11) DEFAULT NULL COMMENT '上次签到时间',
  `mac_addr` char(17) DEFAULT NULL,
  `month_times` smallint(6) DEFAULT NULL COMMENT '当月第几次签到，累计签到次数，记录数字',
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `sign_time` int(10) DEFAULT NULL COMMENT '每日签到的时间点',
  `udid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_dungeon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `begin_role_level` smallint(6) DEFAULT NULL,
  `begin_time` int(10) DEFAULT NULL,
  `combat` int(11) DEFAULT NULL COMMENT '进入副本的战力',
  `end_role_level` smallint(6) DEFAULT NULL,
  `end_state` smallint(6) DEFAULT NULL,
  `end_time` int(10) DEFAULT NULL,
  `game_type` varchar(10) DEFAULT NULL,
  `hero_list` varchar(3000) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `is_auto` tinyint(4) DEFAULT NULL COMMENT '是否自动(0手动，1自动)',
  `is_first_success` tinyint(4) DEFAULT NULL COMMENT '是否首次通过',
  `is_sweep` tinyint(4) DEFAULT NULL COMMENT '是否扫荡(0非扫荡，1扫荡)',
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `pro_item` varchar(3000) DEFAULT NULL COMMENT '关卡掉落的物品奖励',
  `pro_money` int(11) DEFAULT NULL COMMENT '掉落的金币奖励',
  `pro_ore` int(11) DEFAULT NULL COMMENT '掉落的矿石奖励',
  `pro_star` smallint(6) DEFAULT NULL COMMENT '通过星级',
  `role_id` bigint(20) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `soldier_list` varchar(3000) DEFAULT NULL,
  `task_id` smallint(6) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  `use_stamina` int(11) DEFAULT NULL COMMENT '开启副本消耗的体力',
  `use_time` int(11) DEFAULT NULL COMMENT '关卡战斗耗时的秒数',
  `vip_level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1937 DEFAULT CHARSET=utf8;


CREATE TABLE `xy_dungeonenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `begin_role_level` int(11) DEFAULT NULL,
  `begin_time` int(10) DEFAULT NULL,
  `combat` int(11) DEFAULT NULL COMMENT '进入副本的战力',
  `game_type` varchar(10) DEFAULT NULL COMMENT '副本类型，如普通关卡，精英关卡',
  `hero_list` varchar(3000) DEFAULT NULL COMMENT '武将信息',
  `ip` char(15) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_name` varchar(20) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `soldier_list` varchar(3000) DEFAULT NULL COMMENT '记录副本开启选则的士兵（士兵类型，对应武将职业，士兵星级，士兵等级）',
  `task_id` smallint(6) DEFAULT NULL,
  `udid` varchar(45) DEFAULT NULL,
  `use_stamina` int(11) DEFAULT NULL COMMENT '消耗的体力值',
  `vip_level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_equipup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `after_ei` int(11) DEFAULT NULL COMMENT '记录进阶后装备对应ID',
  `after_eq` int(11) DEFAULT NULL,
  `equip_id` int(11) DEFAULT NULL COMMENT '记录进阶前装备对应ID',
  `equip_level` smallint(6) DEFAULT NULL COMMENT '装备进阶前等级',
  `equip_quality` int(11) DEFAULT NULL COMMENT '进阶前装备品质',
  `equip_type` smallint(6) DEFAULT NULL COMMENT '装备类型，0代表武器，1代表盔甲，2代表护符，3代表坐骑，4代表卷轴',
  `hero` bigint(20) DEFAULT NULL COMMENT '已装备则记录武将ID，未装备记录为0',
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(20) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `timestamp` int(10) DEFAULT NULL COMMENT '装备进阶时间点',
  `udid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `friend_time` int(10) DEFAULT NULL COMMENT '发起好友申请时间',
  `ip` char(15) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `number` smallint(6) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `rerole_id` bigint(20) DEFAULT NULL COMMENT '被添加者ID',
  `rerole_vip` smallint(6) DEFAULT NULL COMMENT '被添加者VIP等级',
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(20) DEFAULT NULL,
  `server` varchar(8) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  `vip_level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_gameplay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `game_type` varchar(30) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(20) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `task_id` smallint(6) DEFAULT NULL,
  `time` int(10) DEFAULT NULL COMMENT '记录玩家开始玩法的时间',
  `udid` varchar(50) DEFAULT NULL,
  `vip_level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_guild` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(10) DEFAULT NULL,
  `guild_id` bigint(20) DEFAULT NULL COMMENT '记录公会ID',
  `guild_name` varchar(10) DEFAULT NULL COMMENT '公会名',
  `ip` char(15) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `operation` varchar(20) DEFAULT NULL COMMENT '操作如“创建公会”、“加入公会”、“自行退出”、“公会踢人”、“解散公会”、“公会改名”（需求）等',
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `server` varchar(8) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  `vip_level` tinyint(4) DEFAULT NULL COMMENT '角色VIP等级',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_guildtask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `done_timestamp` int(10) DEFAULT NULL,
  `help` smallint(6) DEFAULT NULL,
  `helpip_list` varchar(30) DEFAULT NULL,
  `old_accountid` smallint(50) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `start_timestamp` int(10) DEFAULT NULL,
  `task_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_herochange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `hero` int(11) DEFAULT NULL COMMENT '武将ID',
  `hero_attribute` varchar(10000) DEFAULT NULL COMMENT '武将属性',
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `timestamp` int(10) DEFAULT NULL COMMENT '武将数值变化的时间点',
  `type` smallint(6) DEFAULT NULL COMMENT '1代表武将升级时记录、2代表武将升品质记录、3代表武将升星时记录',
  `udid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_itembuy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `buy_time` int(10) DEFAULT NULL COMMENT '购买物品时间',
  `cost_money` int(11) DEFAULT NULL COMMENT '本次购买花费的游戏币数量',
  `count` int(11) DEFAULT NULL COMMENT '购买这一物品数量',
  `free_yuanbao` int(11) DEFAULT NULL COMMENT '本次购买花费的免费元宝量',
  `ip` char(15) DEFAULT NULL,
  `item_id` smallint(6) DEFAULT NULL COMMENT '物品名字标识符',
  `item_type` smallint(6) DEFAULT NULL COMMENT '物品类型，如weapon(武器)，remedy（药物）',
  `left_free_yuanbao` int(11) DEFAULT NULL COMMENT '购买后角色剩余免费元宝量',
  `left_money` int(11) DEFAULT NULL COMMENT '购买后角色剩余游戏币数量',
  `left_yuanbao` int(11) DEFAULT NULL COMMENT '购买后角色剩余元宝量（付费+免费）',
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `role_vip` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  `yuanbao` int(11) DEFAULT NULL COMMENT '本次购买花费的元宝量（付费+免费）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_levelup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `levelup_time` int(10) DEFAULT NULL COMMENT '升级时间',
  `old_accountid` varchar(50) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `u_aft_level` smallint(6) DEFAULT NULL COMMENT '升级后角色等级',
  `u_bef_level` smallint(6) DEFAULT NULL COMMENT '升级前角色等级',
  `u_online_time` int(11) DEFAULT NULL COMMENT '截止到升级的节点，角色总共的累计在线时长',
  `vip_level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_loginrole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `aid` varchar(10) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `app_ver` varchar(8) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `device_height` smallint(6) DEFAULT NULL,
  `device_model` varchar(20) DEFAULT NULL COMMENT '设备型号',
  `device_width` smallint(6) DEFAULT NULL,
  `idfa` varchar(50) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `ipv6` varchar(45) DEFAULT NULL,
  `isp` varchar(20) DEFAULT NULL,
  `last_logout_time` int(10) DEFAULT NULL,
  `login_time` int(10) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `nation` smallint(6) DEFAULT '86',
  `network` varchar(15) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `os_name` varchar(10) DEFAULT NULL,
  `os_ver` varchar(8) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `role_no` smallint(6) DEFAULT NULL,
  `role_vip` tinyint(4) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(8) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=733 DEFAULT CHARSET=utf8;


CREATE TABLE `xy_logoutrole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mac_addr` char(17) DEFAULT NULL,
  `os_ver` varchar(8) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `network` varchar(15) DEFAULT NULL,
  `role_no` smallint(6) DEFAULT NULL COMMENT '角色创建标示玩家创建的序号。（一个账号可在多个服务器创建角色，第一个创建的角色role_no = 1；第一个创建的角色role_no = 2，以此类推。）',
  `idfa` varchar(50) DEFAULT NULL COMMENT '广告标示符',
  `yuanbao_free_own` int(11) DEFAULT NULL COMMENT '免费元宝持有量',
  `online_time` int(11) DEFAULT NULL COMMENT '在线时长',
  `friend_number` smallint(6) DEFAULT NULL COMMENT '好友数量',
  `guild_id` bigint(20) DEFAULT NULL,
  `hero_num` varchar(600) DEFAULT NULL,
  `app_channel` varchar(8) DEFAULT NULL,
  `logout_time` int(10) DEFAULT NULL COMMENT '角色登出时间',
  `login_time` int(10) DEFAULT NULL COMMENT '角色登录时间',
  `root_mark` tinyint(4) DEFAULT NULL,
  `yuanbao_own` int(11) DEFAULT NULL COMMENT '付费元宝持有量',
  `device_width` smallint(6) DEFAULT NULL,
  `soldier_collection` varchar(6000) DEFAULT NULL COMMENT '下线时士兵信息（ID，级别，星级）',
  `money_total_sum` int(11) DEFAULT NULL COMMENT '金钱持有量',
  `town_collection` varchar(600) DEFAULT NULL COMMENT '下线是封地信息(ID/级别)',
  `exp` smallint(6) DEFAULT NULL COMMENT '角色当前经验',
  `udid` varchar(50) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL COMMENT '角色ID，角色唯一标识，在所有服唯一。',
  `server` varchar(10) DEFAULT NULL COMMENT '所在服务器',
  `account_id` varchar(50) DEFAULT NULL,
  `ipv6` varchar(45) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL COMMENT '角色创建时间',
  `device_height` smallint(6) DEFAULT NULL,
  `device_model` varchar(20) DEFAULT NULL,
  `nation` smallint(6) DEFAULT '86' COMMENT '国家',
  `app_ver` varchar(8) DEFAULT NULL COMMENT 'APP版本',
  `role_level` smallint(6) DEFAULT NULL COMMENT '角色等级',
  `top_strength` int(11) DEFAULT NULL COMMENT '？',
  `hero_collection` varchar(3000) DEFAULT NULL COMMENT '下线时武将信息（ID，级别，星阶）',
  `colony_num` smallint(6) DEFAULT NULL COMMENT '殖民地数量',
  `normal_info` varchar(600) DEFAULT NULL COMMENT '普通关卡(最高挑战关卡/最高通关关卡/最高关卡星级)',
  `isp` varchar(10) DEFAULT NULL COMMENT '运营商',
  `ranking` varchar(600) DEFAULT NULL COMMENT '排行榜名次',
  `cream_info` varchar(600) DEFAULT NULL COMMENT '精英关卡进度记录(最高挑战关卡/最高通关关卡/最高关卡星级)',
  `os_name` varchar(10) DEFAULT NULL COMMENT '操作系统名称',
  `role_vip` tinyint(4) DEFAULT NULL COMMENT '角色vip',
  `role_name` varchar(30) DEFAULT NULL COMMENT '角色名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=486 DEFAULT CHARSET=utf8;



CREATE TABLE `xy_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachments` varchar(1000) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `mail_id` varchar(100) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` tinyint(4) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL COMMENT '文本内容',
  `guild_id` bigint(20) DEFAULT NULL COMMENT '公会ID',
  `ip` char(15) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(15) DEFAULT NULL,
  `operation` varchar(40) DEFAULT NULL COMMENT '操作',
  `re_role_id` smallint(6) DEFAULT NULL COMMENT '接收者唯一标识',
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `udid` varchar(45) DEFAULT NULL,
  `vip_level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_onlinerolenum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `online` int(10) DEFAULT NULL COMMENT '在线角色数',
  `online_time` int(10) DEFAULT NULL COMMENT '记录的时间',
  `server` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `os_name` varchar(10) DEFAULT NULL,
  `os_ver` varchar(8) DEFAULT NULL,
  `package_type` smallint(6) DEFAULT NULL,
  `ps_number` varchar(25) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(8) DEFAULT NULL,
  `sex` smallint(6) DEFAULT NULL,
  `timestamp` int(10) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_prepaid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `cash` smallint(6) DEFAULT NULL COMMENT '本次充值花费现金',
  `cash_total` float DEFAULT NULL COMMENT '玩家累计充值花费现金',
  `device_id` varchar(50) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `os_name` varchar(10) DEFAULT NULL,
  `os_ver` varchar(8) DEFAULT NULL,
  `pay_channel` varchar(20) DEFAULT NULL COMMENT '充值渠道：如app_store，netease 、91_assistant',
  `pay_method` varchar(50) DEFAULT NULL COMMENT '充值通道',
  `pay_time` int(10) DEFAULT NULL COMMENT '角色充值的时间',
  `prepaid_detail` varchar(800) DEFAULT NULL COMMENT '充值点，比如游戏内的购买钻石，购买xxx个钻石，用于分析。',
  `recharge_id` varchar(50) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(20) DEFAULT NULL,
  `role_vip` tinyint(4) DEFAULT NULL,
  `sdk_ver` varchar(10) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `sn` varchar(50) DEFAULT NULL COMMENT '充值的订单编号，一般是唯一的',
  `udid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_pvp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` char(15) DEFAULT NULL,
  `pro_ore` bigint(20) DEFAULT NULL,
  `s_role_id` bigint(20) DEFAULT NULL COMMENT '源角色ID',
  `pro_item` varchar(600) DEFAULT NULL,
  `d_role_id` bigint(20) DEFAULT NULL COMMENT '目标角色ID',
  `app_channel` varchar(20) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `d_logints` int(11) DEFAULT NULL,
  `end_time` int(10) DEFAULT NULL,
  `udid` varchar(45) DEFAULT NULL,
  `mac_addc` char(17) DEFAULT NULL,
  `game_type` varchar(20) DEFAULT NULL,
  `server` varchar(20) DEFAULT NULL,
  `d_ranking` varchar(600) DEFAULT NULL,
  `s_zhanli` int(11) DEFAULT NULL,
  `pro_money` decimal(10,0) DEFAULT NULL,
  `s_role_level` smallint(6) DEFAULT NULL,
  `s_account_id` varchar(15) DEFAULT NULL,
  `s_ranking` varchar(500) DEFAULT NULL,
  `colonized_towns` varchar(3000) DEFAULT NULL COMMENT '记录各城池等级、原拥有者、资源[产能，上限]',
  `cost_money` decimal(10,0) DEFAULT NULL COMMENT '源角色消耗金币',
  `pro_ingot` int(11) DEFAULT NULL,
  `towns` varchar(3000) DEFAULT NULL COMMENT '记录各城池等级、资源[产能，上限]',
  `use_time` int(11) DEFAULT NULL,
  `begin_time` int(10) DEFAULT NULL,
  `d_zhanli` int(11) DEFAULT NULL,
  `s_role_name` varchar(20) DEFAULT NULL,
  `pro_jingji` int(11) DEFAULT NULL,
  `d_role_level` smallint(6) DEFAULT NULL,
  `s_vip_level` tinyint(4) DEFAULT NULL,
  `d_vip_level` tinyint(4) DEFAULT NULL,
  `colonizing_towns` varchar(3000) DEFAULT NULL,
  `s_old_accountid` varchar(10) DEFAULT NULL,
  `task_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_pvpenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_channel` varchar(20) DEFAULT NULL,
  `begin_time` int(10) DEFAULT NULL,
  `cost_money` int(11) DEFAULT NULL,
  `d_logints` int(11) DEFAULT NULL,
  `d_role_id` bigint(20) DEFAULT NULL,
  `d_role_level` smallint(6) DEFAULT NULL,
  `d_vip_level` tinyint(4) DEFAULT NULL,
  `d_zhanli` int(11) DEFAULT NULL,
  `game_type` varchar(20) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `mac_addc` char(17) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `s_account_id` varchar(15) DEFAULT NULL,
  `s_old_accountid` varchar(15) DEFAULT NULL,
  `s_role_id` bigint(20) DEFAULT NULL,
  `s_role_level` smallint(6) DEFAULT NULL,
  `s_role_name` varchar(20) DEFAULT NULL,
  `s_vip_level` tinyint(4) DEFAULT NULL,
  `s_zhanli` int(11) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `task_id` smallint(6) DEFAULT NULL,
  `udid` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_rechargeingotinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `cash` smallint(6) DEFAULT NULL,
  `device_id` varchar(30) DEFAULT NULL,
  `free_yuanbao` smallint(6) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `left_free_yuanbao` smallint(6) DEFAULT NULL,
  `left_yuanbao` smallint(6) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `os_name` varchar(10) DEFAULT NULL,
  `os_ver` varchar(8) DEFAULT NULL,
  `prepaid_detail` varchar(1000) DEFAULT NULL,
  `recharge_id` varchar(100) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `role_vip` tinyint(4) DEFAULT NULL,
  `sdk_ver` varchar(10) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `sn` varchar(40) DEFAULT NULL,
  `time` int(10) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  `yuanbao` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_resourcechange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `action` varchar(10) DEFAULT NULL COMMENT '变化方式：增加或减少',
  `app_channel` varchar(20) DEFAULT NULL,
  `count` int(11) DEFAULT NULL COMMENT '资源变化值',
  `game_type` smallint(6) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `item_id` smallint(6) DEFAULT NULL COMMENT '变化资源的配置id',
  `item_type` smallint(6) DEFAULT NULL,
  `left_count` int(11) DEFAULT NULL COMMENT '资源变化后数值',
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(15) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `task_id` smallint(6) DEFAULT NULL COMMENT '玩法下任务具体标识',
  `udid` varchar(50) DEFAULT NULL,
  `vip_level` tinyint(4) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL COMMENT '变化时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25029 DEFAULT CHARSET=utf8;


CREATE TABLE `xy_resourcechange_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `action` varchar(10) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `game_type` smallint(6) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `item_dict` smallint(6) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `reason` varchar(50) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `src_dict` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  `vip_level` tinyint(4) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL COMMENT '变化时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_speedabnormal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `app_ver` varchar(8) DEFAULT NULL,
  `device_height` smallint(6) DEFAULT NULL,
  `device_mode` varchar(20) DEFAULT NULL,
  `device_width` smallint(6) DEFAULT NULL,
  `game_frame` int(11) DEFAULT NULL,
  `game_rate` smallint(6) DEFAULT NULL,
  `game_type` smallint(6) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `mac_addr` char(17) DEFAULT NULL,
  `old_account` varchar(50) DEFAULT NULL,
  `os_name` varchar(10) DEFAULT NULL,
  `os_ver` varchar(8) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` tinyint(4) DEFAULT NULL,
  `root` smallint(6) DEFAULT NULL,
  `t_in` int(11) DEFAULT NULL,
  `t_interval` double DEFAULT NULL,
  `t_out` int(10) DEFAULT NULL,
  `task_id` smallint(6) DEFAULT NULL,
  `tc_interval` smallint(6) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  `vip` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_usesp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `hero` smallint(6) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` smallint(6) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `rsp` smallint(6) DEFAULT NULL COMMENT '使用后剩余技能点',
  `server` varchar(10) DEFAULT NULL,
  `skill_points` smallint(6) DEFAULT NULL COMMENT '使用前技能点',
  `sp_id` int(11) DEFAULT NULL COMMENT '技能点消耗对应技能ID',
  `timestamp` int(10) DEFAULT NULL COMMENT '武将技能提升时间',
  `udid` varchar(50) DEFAULT NULL,
  `use_sp` smallint(6) DEFAULT NULL COMMENT '本次使用的技能点',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `xy_yuanbaogain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `device_model` varchar(20) DEFAULT NULL,
  `free_yuanbao` int(11) DEFAULT NULL COMMENT '获得的免费元宝',
  `gain_time` int(10) DEFAULT NULL COMMENT '获取时间',
  `ip` char(15) DEFAULT NULL,
  `left_free_yuanbao` int(11) DEFAULT NULL COMMENT '获取后免费元宝量',
  `left_yuanbao` int(11) DEFAULT NULL COMMENT '获取后元宝量（付费+免费）',
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(50) DEFAULT NULL,
  `reason` smallint(6) DEFAULT NULL COMMENT '获取原因，如节日赠送等',
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` tinyint(4) DEFAULT NULL,
  `role_name` varchar(30) DEFAULT NULL,
  `root_mark` tinyint(4) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  `vip_level` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `xy_yuanbaouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) DEFAULT NULL,
  `app_channel` varchar(20) DEFAULT NULL,
  `device_model` varchar(50) DEFAULT NULL,
  `free_yuanbao` int(11) DEFAULT NULL COMMENT '本次购买花费的免费元宝量',
  `ip` char(15) DEFAULT NULL,
  `left_free_yuanbao` int(11) DEFAULT NULL COMMENT '购买后角色剩余免费元宝量',
  `left_yuanbao` int(11) DEFAULT NULL COMMENT '购买后角色剩余元宝量（付费+免费）',
  `mac_addr` char(17) DEFAULT NULL,
  `old_accountid` varchar(15) DEFAULT NULL,
  `reason` smallint(6) DEFAULT NULL COMMENT '消耗原因：如补充体力等',
  `role_id` bigint(20) DEFAULT NULL,
  `role_level` tinyint(4) DEFAULT NULL,
  `role_name` varchar(20) DEFAULT NULL,
  `server` varchar(10) DEFAULT NULL,
  `udid` varchar(50) DEFAULT NULL,
  `use_time` int(10) DEFAULT NULL,
  `vip_level` smallint(6) DEFAULT NULL,
  `yuanbao` int(11) DEFAULT NULL COMMENT '本次花费元宝量（付费+免费）',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2019 DEFAULT CHARSET=utf8;

