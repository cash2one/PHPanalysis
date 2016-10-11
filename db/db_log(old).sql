/*
Navicat MySQL Data Transfer

Source Server         : vm_192.168.0.81
Source Server Version : 50615
Source Host           : 192.168.0.81:3306
Source Database       : db_log

Target Server Type    : MYSQL
Target Server Version : 50615
File Encoding         : 65001

Date: 2016-07-11 11:45:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `agent_info`
-- ----------------------------
DROP TABLE IF EXISTS `agent_info`;
CREATE TABLE `agent_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `agent_id` mediumint(4) NOT NULL COMMENT '代理ID',
  `agent_name` varchar(50) NOT NULL COMMENT '代理名字',
  `official_website` varchar(200) DEFAULT NULL COMMENT '官网',
  `agent_system` varchar(200) DEFAULT NULL COMMENT '代理后台',
  `bbs` varchar(200) DEFAULT NULL COMMENT '论坛',
  `first_open_time` datetime NOT NULL COMMENT '首服时间',
  `server_num` int(11) NOT NULL COMMENT '已开服总数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `agent_id` (`agent_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of agent_info
-- ----------------------------

-- ----------------------------
-- Table structure for `all_avg_online`
-- ----------------------------
DROP TABLE IF EXISTS `all_avg_online`;
CREATE TABLE `all_avg_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `online` int(11) NOT NULL COMMENT '��������',
  `date` date NOT NULL COMMENT '����',
  `agent_id` smallint(4) NOT NULL COMMENT '����ID',
  `server_id` smallint(4) NOT NULL COMMENT '������ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`agent_id`,`server_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=375 DEFAULT CHARSET=utf8 COMMENT='ÿ��ƽ������';

-- ----------------------------
-- Records of all_avg_online
-- ----------------------------

-- ----------------------------
-- Table structure for `all_log_use_gold`
-- ----------------------------
DROP TABLE IF EXISTS `all_log_use_gold`;
CREATE TABLE `all_log_use_gold` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `unbind_gold` int(11) NOT NULL COMMENT '非绑定元宝',
  `bind_gold` int(11) NOT NULL COMMENT '绑定元宝',
  `customers` int(11) NOT NULL COMMENT '购买人数',
  `buy_times` int(11) NOT NULL COMMENT '购买次数',
  `mtype` int(11) NOT NULL COMMENT '操作类型',
  `ctype` int(11) NOT NULL COMMENT '消费项目类型',
  `itemid` int(11) NOT NULL COMMENT '物品ID',
  `date` date NOT NULL COMMENT '日期',
  `agent_id` smallint(4) NOT NULL COMMENT '代理ID',
  `server_id` smallint(4) NOT NULL COMMENT '服务器ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mtype` (`mtype`,`itemid`,`date`,`agent_id`,`server_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6317 DEFAULT CHARSET=utf8 COMMENT='元宝消费记录';

-- ----------------------------
-- Records of all_log_use_gold
-- ----------------------------

-- ----------------------------
-- Table structure for `all_log_use_points`
-- ----------------------------
DROP TABLE IF EXISTS `all_log_use_points`;
CREATE TABLE `all_log_use_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `points` int(11) NOT NULL COMMENT '积分',
  `customers` int(11) NOT NULL COMMENT '购买人数',
  `buy_times` int(11) NOT NULL COMMENT '购买次数',
  `mtype` int(11) NOT NULL COMMENT '操作类型',
  `ctype` int(11) NOT NULL COMMENT '消费',
  `itemid` int(11) NOT NULL COMMENT '物品ID',
  `date` date NOT NULL COMMENT '日期',
  `agent_id` smallint(4) NOT NULL COMMENT '代理ID',
  `server_id` smallint(4) NOT NULL COMMENT '服务器ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mtype` (`mtype`,`itemid`,`date`,`agent_id`,`server_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='积分消费记录';

-- ----------------------------
-- Records of all_log_use_points
-- ----------------------------

-- ----------------------------
-- Table structure for `all_log_use_silver`
-- ----------------------------
DROP TABLE IF EXISTS `all_log_use_silver`;
CREATE TABLE `all_log_use_silver` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `unbind_silver` int(11) NOT NULL COMMENT '非绑定银两',
  `bind_silver` int(11) NOT NULL COMMENT '绑定银两',
  `customers` int(11) NOT NULL COMMENT '购买人数',
  `buy_times` int(11) NOT NULL COMMENT '购买次数',
  `mtype` int(11) NOT NULL COMMENT '操作类型',
  `ctype` int(11) NOT NULL COMMENT '消费项目类型',
  `date` date NOT NULL COMMENT '日期',
  `agent_id` smallint(4) NOT NULL COMMENT '代理ID',
  `server_id` smallint(4) NOT NULL COMMENT '服务器ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mtype` (`mtype`,`date`,`agent_id`,`server_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=275 DEFAULT CHARSET=utf8 COMMENT='银两消费记录';

-- ----------------------------
-- Records of all_log_use_silver
-- ----------------------------

-- ----------------------------
-- Table structure for `all_register_db`
-- ----------------------------
DROP TABLE IF EXISTS `all_register_db`;
CREATE TABLE `all_register_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `account` int(10) unsigned NOT NULL COMMENT 'ע������',
  `date` date NOT NULL COMMENT '����',
  `agent_id` smallint(4) unsigned NOT NULL COMMENT '����ID',
  `server_id` smallint(4) unsigned NOT NULL COMMENT '������ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`agent_id`,`server_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=256 DEFAULT CHARSET=utf8 COMMENT='ÿ��ע��������';

-- ----------------------------
-- Records of all_register_db
-- ----------------------------

-- ----------------------------
-- Table structure for `all_server_info`
-- ----------------------------
DROP TABLE IF EXISTS `all_server_info`;
CREATE TABLE `all_server_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `agent_id` smallint(4) NOT NULL COMMENT '代理ID',
  `server_id` smallint(4) NOT NULL COMMENT '服务器ID',
  `s_type` smallint(4) NOT NULL COMMENT '服务器类型',
  `ip` varchar(15) NOT NULL COMMENT 'IP',
  `domain_name` varchar(80) NOT NULL COMMENT '域名',
  `stat` smallint(4) NOT NULL COMMENT '服务器状态',
  `open_time` int(11) NOT NULL DEFAULT '0' COMMENT '开服时间',
  `combine_time` int(11) NOT NULL DEFAULT '0' COMMENT '合服时间',
  `close_time` int(11) NOT NULL DEFAULT '0' COMMENT '关服时间',
  `s_desc` varchar(100) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`),
  UNIQUE KEY `agent_id` (`agent_id`,`server_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='服务器信息表';

-- ----------------------------
-- Records of all_server_info
-- ----------------------------

-- ----------------------------
-- Table structure for `all_server_num`
-- ----------------------------
DROP TABLE IF EXISTS `all_server_num`;
CREATE TABLE `all_server_num` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `agent_id` smallint(4) NOT NULL COMMENT '代理ID',
  `date` date NOT NULL COMMENT '日期',
  `total_num` int(11) NOT NULL COMMENT '已开服总数',
  `open_num` int(11) NOT NULL COMMENT '现处于开服状态服务器数量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `agent_id` (`agent_id`,`date`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='每日服务器数量统计';

-- ----------------------------
-- Records of all_server_num
-- ----------------------------

-- ----------------------------
-- Table structure for `all_server_online`
-- ----------------------------
DROP TABLE IF EXISTS `all_server_online`;
CREATE TABLE `all_server_online` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `online` int(11) unsigned NOT NULL COMMENT '��������',
  `date` date NOT NULL COMMENT '����',
  `hour` tinyint(2) unsigned NOT NULL COMMENT 'Сʱ',
  `min` tinyint(2) unsigned NOT NULL COMMENT '����',
  `agent_id` smallint(4) unsigned NOT NULL COMMENT '����ID',
  `server_id` smallint(4) unsigned NOT NULL COMMENT '������ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`hour`,`min`,`agent_id`,`server_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=16301 DEFAULT CHARSET=utf8 COMMENT='��������ͳ���ܱ�';

-- ----------------------------
-- Records of all_server_online
-- ----------------------------

-- ----------------------------
-- Table structure for `all_source_paylog`
-- ----------------------------
DROP TABLE IF EXISTS `all_source_paylog`;
CREATE TABLE `all_source_paylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(128) DEFAULT NULL COMMENT '订单号',
  `role_id` int(11) DEFAULT NULL COMMENT '充值角色id',
  `role_name` varchar(50) DEFAULT NULL COMMENT '充值角色名',
  `account_name` varchar(50) DEFAULT NULL COMMENT '充值账号',
  `pay_time` int(11) DEFAULT NULL COMMENT '充值时间',
  `pay_gold` int(11) DEFAULT NULL COMMENT '游戏币(元宝)',
  `pay_money` int(11) DEFAULT NULL COMMENT '充值金额(人民币)',
  `agent_id` int(11) NOT NULL DEFAULT '0' COMMENT '代理商id',
  `server_id` int(11) NOT NULL DEFAULT '0' COMMENT '服务器id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`,`account_name`,`agent_id`,`server_id`) USING BTREE,
  KEY `account_name` (`account_name`,`pay_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2774 DEFAULT CHARSET=utf8 COMMENT='全平台全服原始订单记录';

-- ----------------------------
-- Records of all_source_paylog
-- ----------------------------

-- ----------------------------
-- Table structure for `all_source_paylog_rmb`
-- ----------------------------
DROP TABLE IF EXISTS `all_source_paylog_rmb`;
CREATE TABLE `all_source_paylog_rmb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(256) DEFAULT NULL COMMENT '订单号',
  `role_id` int(11) DEFAULT NULL COMMENT '充值角色id',
  `role_name` varchar(50) DEFAULT NULL COMMENT '充值角色名',
  `account_name` varchar(50) DEFAULT NULL COMMENT '充值账号',
  `pay_time` int(11) DEFAULT NULL COMMENT '充值时间',
  `pay_gold` int(11) DEFAULT NULL COMMENT '游戏币(元宝)',
  `pay_money` float DEFAULT NULL COMMENT '充值金额(人民币)',
  `agent_id` int(11) NOT NULL DEFAULT '0' COMMENT '代理商id',
  `server_id` int(11) NOT NULL DEFAULT '0' COMMENT '服务器id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`,`account_name`,`agent_id`,`server_id`) USING BTREE,
  KEY `account_name` (`account_name`,`pay_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2774 DEFAULT CHARSET=utf8 COMMENT='全平台全服原始订单记录';

-- ----------------------------
-- Records of all_source_paylog_rmb
-- ----------------------------

-- ----------------------------
-- Table structure for `daily_report`
-- ----------------------------
DROP TABLE IF EXISTS `daily_report`;
CREATE TABLE `daily_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` int(11) NOT NULL COMMENT '日期',
  `total_login` int(11) NOT NULL COMMENT '总登录账号',
  `new_account` int(11) NOT NULL COMMENT '新增账号',
  `total_pay` int(11) NOT NULL COMMENT '充值金额',
  `total_gold` int(11) NOT NULL COMMENT '充值元宝',
  `gold_cons` int(11) NOT NULL COMMENT '消耗元宝',
  `pay_num` int(11) NOT NULL COMMENT '充值人数',
  `arpu` int(11) NOT NULL COMMENT 'ARPU',
  `hight_online` int(11) NOT NULL COMMENT '峰值在线',
  `avg_online` int(11) NOT NULL COMMENT '平均在线',
  `avg_ol_time` int(11) NOT NULL COMMENT '平均在线时长',
  `active_user` int(11) NOT NULL COMMENT '活跃用户数',
  `all_gold` int(11) NOT NULL DEFAULT '0',
  `all_bind_gold` int(11) NOT NULL DEFAULT '0',
  `all_silver` int(11) NOT NULL DEFAULT '0',
  `bind_gold_cons` int(11) NOT NULL DEFAULT '0',
  `gold_gen` int(11) NOT NULL DEFAULT '0',
  `bind_gold_gen` int(11) NOT NULL DEFAULT '0',
  `silver_cons` int(11) NOT NULL DEFAULT '0',
  `silver_gen` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `datetime` (`datetime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of daily_report
-- ----------------------------

-- ----------------------------
-- Table structure for `db_account_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_account_p`;
CREATE TABLE `db_account_p` (
  `account_name` varchar(50) NOT NULL DEFAULT '',
  `create_time` int(11) DEFAULT NULL,
  `gold` int(11) DEFAULT NULL,
  `gold_bind` int(11) DEFAULT NULL,
  `last_login_ip` varchar(50) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `pf` varchar(50) DEFAULT NULL,
  `is_new_role` int(1) DEFAULT '0' COMMENT '0新玩家1老玩家',
  `agent_id` int(11) NOT NULL DEFAULT '0',
  `server_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`account_name`,`agent_id`,`server_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_account_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_equip_refining_rank_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_equip_refining_rank_p`;
CREATE TABLE `db_equip_refining_rank_p` (
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `colour` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `faction_id` int(11) DEFAULT NULL,
  `refining_score` int(11) DEFAULT NULL,
  `reinforce_score` int(11) DEFAULT NULL,
  `stone_score` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_equip_refining_rank_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_equip_reinforce_rank_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_equip_reinforce_rank_p`;
CREATE TABLE `db_equip_reinforce_rank_p` (
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `colour` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `faction_id` int(11) DEFAULT NULL,
  `refining_score` int(11) DEFAULT NULL,
  `reinforce_score` int(11) DEFAULT NULL,
  `stone_score` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_equip_reinforce_rank_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_equip_stone_rank_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_equip_stone_rank_p`;
CREATE TABLE `db_equip_stone_rank_p` (
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `colour` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `faction_id` int(11) DEFAULT NULL,
  `refining_score` int(11) DEFAULT NULL,
  `reinforce_score` int(11) DEFAULT NULL,
  `stone_score` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_equip_stone_rank_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_family_active_rank_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_family_active_rank_p`;
CREATE TABLE `db_family_active_rank_p` (
  `family_id` int(11) NOT NULL DEFAULT '0',
  `family_name` varchar(50) DEFAULT NULL,
  `owner_role_name` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `member_count` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `faction_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`family_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_family_active_rank_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_family_gongxun_persistent_rank_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_family_gongxun_persistent_rank_p`;
CREATE TABLE `db_family_gongxun_persistent_rank_p` (
  `key` int(11) NOT NULL DEFAULT '0',
  `family_id` int(11) DEFAULT NULL,
  `total_gongxun` int(11) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_family_gongxun_persistent_rank_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_pay_log_index_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_pay_log_index_p`;
CREATE TABLE `db_pay_log_index_p` (
  `id` int(11) NOT NULL DEFAULT '0',
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_pay_log_index_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_pay_log_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_pay_log_p`;
CREATE TABLE `db_pay_log_p` (
  `id` int(11) NOT NULL DEFAULT '0',
  `order_id` varchar(20000) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `pay_time` int(11) DEFAULT NULL,
  `pay_gold` int(11) DEFAULT NULL,
  `pay_money` int(11) DEFAULT NULL,
  `pay_ticket` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `agent_id` int(11) NOT NULL DEFAULT '0',
  `server_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_pay_log_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_role_answer_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_role_answer_p`;
CREATE TABLE `db_role_answer_p` (
  `roleid` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `family_name` varchar(50) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `list` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `rightnum` int(11) NOT NULL DEFAULT '0',
  `last_score` int(11) NOT NULL DEFAULT '0',
  `last_rankid` int(11) NOT NULL DEFAULT '0',
  `start_date` int(11) NOT NULL DEFAULT '0',
  `vip_grade` int(11) DEFAULT '0',
  `faction_id` int(11) DEFAULT '0',
  PRIMARY KEY (`roleid`),
  KEY `time` (`time`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_answer_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_role_attr_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_role_attr_p`;
CREATE TABLE `db_role_attr_p` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) NOT NULL DEFAULT '',
  `next_level_exp` int(11) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `five_ele_attr` int(11) NOT NULL DEFAULT '0',
  `last_login_location` varchar(50) NOT NULL DEFAULT '',
  `equips` blob,
  `jungong` int(11) NOT NULL DEFAULT '0',
  `charm` int(11) NOT NULL DEFAULT '0',
  `couple_id` int(11) NOT NULL DEFAULT '0',
  `couple_name` varchar(50) NOT NULL DEFAULT '',
  `skin` blob,
  `cur_energy` int(11) NOT NULL DEFAULT '0',
  `max_energy` int(11) NOT NULL DEFAULT '0',
  `gold` int(11) NOT NULL DEFAULT '0',
  `gold_bind` int(11) NOT NULL DEFAULT '0',
  `silver` int(11) NOT NULL DEFAULT '0',
  `silver_bind` int(11) NOT NULL DEFAULT '0',
  `show_cloth` tinyint(4) NOT NULL DEFAULT '0',
  `moral_values` int(11) NOT NULL DEFAULT '0',
  `gongxun` int(11) NOT NULL DEFAULT '0',
  `last_login_ip` varchar(50) NOT NULL DEFAULT '',
  `office_id` int(11) NOT NULL DEFAULT '0',
  `office_name` varchar(50) NOT NULL DEFAULT '',
  `unbund` tinyint(4) NOT NULL DEFAULT '0',
  `family_contribute` int(11) NOT NULL DEFAULT '0',
  `prestige` int(11) NOT NULL DEFAULT '0',
  `mounts_list` blob,
  `vip_level` int(11) DEFAULT '0',
  `campaign` blob,
  `honor` int(11) NOT NULL DEFAULT '0',
  `camp_job` int(11) NOT NULL DEFAULT '0',
  `camp_seal` blob,
  `points` int(11) NOT NULL DEFAULT '0',
  `copy_result` blob,
  `office_list` blob,
  `fashion_list` blob,
  `vitality` int(11) NOT NULL DEFAULT '0',
  `exploit` int(11) DEFAULT '0',
  `militaryranks` int(11) DEFAULT '0',
  `reincarnation` int(11) DEFAULT '0',
  `soul` int(11) DEFAULT '0',
  `smelt_level` int(11) DEFAULT '0',
  `smelt_value` int(11) DEFAULT '0',
  `copy_exp` blob,
  `chess_max_score` int(11) DEFAULT '0',
  `role_mission_daily` blob,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_attr_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_role_base_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_role_base_p`;
CREATE TABLE `db_role_base_p` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) NOT NULL DEFAULT '',
  `account_name` varchar(50) NOT NULL DEFAULT '',
  `sex` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `head` int(11) NOT NULL DEFAULT '0',
  `faction_id` int(11) NOT NULL DEFAULT '0',
  `team_id` int(11) NOT NULL DEFAULT '0',
  `family_id` int(11) NOT NULL DEFAULT '0',
  `family_name` varchar(50) NOT NULL DEFAULT '',
  `pk_mode` int(11) NOT NULL DEFAULT '0',
  `pk_points` int(11) NOT NULL DEFAULT '0',
  `last_gray_name` int(11) NOT NULL DEFAULT '0',
  `if_gray_name` tinyint(4) NOT NULL DEFAULT '0',
  `max_hp` int(11) NOT NULL DEFAULT '0',
  `max_mp` int(11) NOT NULL DEFAULT '0',
  `hp_recover_speed` int(11) NOT NULL DEFAULT '0',
  `mp_recover_speed` int(11) NOT NULL DEFAULT '0',
  `phy_attack_min` int(11) NOT NULL DEFAULT '0',
  `phy_attack_max` int(11) NOT NULL DEFAULT '0',
  `phy_defence_min` int(11) NOT NULL DEFAULT '0',
  `phy_defence_max` int(11) NOT NULL DEFAULT '0',
  `magic_attack_min` int(11) NOT NULL DEFAULT '0',
  `magic_attack_max` int(11) NOT NULL DEFAULT '0',
  `magic_defence_min` int(11) NOT NULL DEFAULT '0',
  `magic_defence_max` int(11) NOT NULL DEFAULT '0',
  `move_speed` int(11) NOT NULL DEFAULT '0',
  `attack_speed` int(11) NOT NULL DEFAULT '0',
  `miss_level` int(11) NOT NULL DEFAULT '0',
  `crit_level` int(11) NOT NULL DEFAULT '0',
  `crit_damage` int(11) NOT NULL DEFAULT '0',
  `hit_level` int(11) NOT NULL DEFAULT '0',
  `avoid_crit_level` int(11) NOT NULL DEFAULT '0',
  `hurt_reduce` int(11) NOT NULL DEFAULT '0',
  `hurt_deep` int(11) NOT NULL DEFAULT '0',
  `fighting_power` int(11) NOT NULL DEFAULT '0',
  `buffs` blob,
  `agent_id` int(11) NOT NULL DEFAULT '0',
  `server_id` int(11) NOT NULL DEFAULT '0',
  `cur_title` int(11) NOT NULL DEFAULT '0',
  `achievement` int(11) NOT NULL DEFAULT '0',
  `class_id` int(11) NOT NULL DEFAULT '0',
  `gray_name_status` int(11) NOT NULL DEFAULT '0',
  `lucky` int(11) NOT NULL,
  `camp_mission_state` tinyint(4) DEFAULT NULL,
  `kill_roles` blob,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_base_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_role_ext_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_role_ext_p`;
CREATE TABLE `db_role_ext_p` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `signature` varchar(255) DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `constellation` int(11) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `province` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `blog` varchar(255) DEFAULT NULL,
  `family_last_op_time` int(11) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `last_offline_time` int(11) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `skin` blob,
  `date` blob,
  `is_online` tinyint(4) DEFAULT NULL,
  `can_chat` int(11) DEFAULT NULL,
  `vip_repay_state` int(11) DEFAULT NULL,
  `auto_concert` blob,
  `login_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_ext_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_role_foremost_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_role_foremost_p`;
CREATE TABLE `db_role_foremost_p` (
  `head_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `ext_name` varchar(255) DEFAULT NULL,
  `faction_id` int(11) DEFAULT NULL,
  `family_name` varchar(50) DEFAULT NULL,
  `date` blob,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`head_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_foremost_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_role_gongxun_rank_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_role_gongxun_rank_p`;
CREATE TABLE `db_role_gongxun_rank_p` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) DEFAULT NULL,
  `faction_id` int(11) DEFAULT NULL,
  `family_name` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `exp` int(11) DEFAULT NULL,
  `gongxun` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_gongxun_rank_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_role_level_rank_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_role_level_rank_p`;
CREATE TABLE `db_role_level_rank_p` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) DEFAULT NULL,
  `role_sex` int(11) DEFAULT NULL,
  `faction_id` int(11) DEFAULT NULL,
  `family_name` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `exp` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_level_rank_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_role_pkpoint_rank_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_role_pkpoint_rank_p`;
CREATE TABLE `db_role_pkpoint_rank_p` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) DEFAULT NULL,
  `faction_id` int(11) DEFAULT NULL,
  `family_name` varchar(50) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `pk_points` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_pkpoint_rank_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_role_world_pkpoint_rank_p`
-- ----------------------------
DROP TABLE IF EXISTS `db_role_world_pkpoint_rank_p`;
CREATE TABLE `db_role_world_pkpoint_rank_p` (
  `role_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) DEFAULT NULL,
  `faction_id` int(11) DEFAULT NULL,
  `family_name` varchar(50) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `pk_points` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_world_pkpoint_rank_p
-- ----------------------------

-- ----------------------------
-- Table structure for `db_version`
-- ----------------------------
DROP TABLE IF EXISTS `db_version`;
CREATE TABLE `db_version` (
  `version` varchar(32) NOT NULL COMMENT '版本',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='当前数据库版本，更新数据库时使用';

-- ----------------------------
-- Records of db_version
-- ----------------------------

-- ----------------------------
-- Table structure for `forbid_ips`
-- ----------------------------
DROP TABLE IF EXISTS `forbid_ips`;
CREATE TABLE `forbid_ips` (
  `ip` varchar(50) NOT NULL COMMENT 'ip地址',
  `forbid_date` int(11) NOT NULL COMMENT '封停截止日期(0表示永久封停）',
  `forbid_reason` varchar(200) NOT NULL COMMENT '封停原因',
  PRIMARY KEY (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='封停的ip';

-- ----------------------------
-- Records of forbid_ips
-- ----------------------------

-- ----------------------------
-- Table structure for `limit_buy_goods`
-- ----------------------------
DROP TABLE IF EXISTS `limit_buy_goods`;
CREATE TABLE `limit_buy_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `goods_id` int(10) NOT NULL COMMENT '商品ID',
  `num` int(11) NOT NULL COMMENT '商品数量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `goods_id` (`goods_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='限购商城商品表';

-- ----------------------------
-- Records of limit_buy_goods
-- ----------------------------

-- ----------------------------
-- Table structure for `log_building`
-- ----------------------------
DROP TABLE IF EXISTS `log_building`;
CREATE TABLE `log_building` (
  `role_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '角色id',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '角色帐号',
  `hall_level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '大本等级',
  `build_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '建筑id',
  `build_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '建筑类型',
  `build_level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '等级',
  `build_x` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'x',
  `build_y` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT 'y',
  `type` tinyint(4) unsigned DEFAULT '0' COMMENT '操作类型(1、创建，2升级，3取消创建/升级)',
  `happend_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发生时间',
  `log_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '写记录时间',
  KEY `log_time` (`log_time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='建筑日志';

-- ----------------------------
-- Records of log_building
-- ----------------------------

-- ----------------------------
-- Table structure for `log_change_server`
-- ----------------------------
DROP TABLE IF EXISTS `log_change_server`;
CREATE TABLE `log_change_server` (
  `user_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` bigint(20) DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci COMMENT '玩家的完整数据',
  `from` int(11) DEFAULT NULL COMMENT 'nodeid',
  `to` int(11) DEFAULT NULL COMMENT 'nodeid',
  `log_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log_change_server
-- ----------------------------

-- ----------------------------
-- Table structure for `log_clan_rank_gem`
-- ----------------------------
DROP TABLE IF EXISTS `log_clan_rank_gem`;
CREATE TABLE `log_clan_rank_gem` (
  `role_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `role_name` varchar(50) NOT NULL DEFAULT '' COMMENT '角色名称',
  `clan_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '部落id',
  `clan_name` varchar(50) NOT NULL DEFAULT '' COMMENT '部落名称',
  `trophy` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '奖杯数量',
  `gem` int(10) NOT NULL DEFAULT '0' COMMENT '宝石数量',
  `happend_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发生时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='部落排名奖励日志';

-- ----------------------------
-- Records of log_clan_rank_gem
-- ----------------------------

-- ----------------------------
-- Table structure for `log_login`
-- ----------------------------
DROP TABLE IF EXISTS `log_login`;
CREATE TABLE `log_login` (
  `role_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '角色帐号',
  `user_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '角色登录ip',
  `hall_lvl` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '大本等级',
  `happend_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发生时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='上线日志';

-- ----------------------------
-- Records of log_login
-- ----------------------------

-- ----------------------------
-- Table structure for `log_logout`
-- ----------------------------
DROP TABLE IF EXISTS `log_logout`;
CREATE TABLE `log_logout` (
  `role_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '角色帐号',
  `user_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '角色ip',
  `hall_lvl` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '大本等级',
  `reason_id` int(11) NOT NULL COMMENT '下线原因',
  `login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',
  `happend_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发生时间',
  KEY `money_store` (`happend_time`,`hall_lvl`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='下线日志';

-- ----------------------------
-- Records of log_logout
-- ----------------------------

-- ----------------------------
-- Table structure for `log_money`
-- ----------------------------
DROP TABLE IF EXISTS `log_money`;
CREATE TABLE `log_money` (
  `role_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '角色帐号',
  `role_name` varchar(50) NOT NULL DEFAULT '' COMMENT '角色名称',
  `money_type` tinyint(4) NOT NULL COMMENT '货币类型',
  `amount` int(11) NOT NULL COMMENT '货币数量',
  `money_remain` int(11) NOT NULL COMMENT '剩余货币数量',
  `opt` tinyint(4) unsigned NOT NULL COMMENT '货币加减(0：消耗，1：产出)',
  `type` smallint(4) unsigned NOT NULL COMMENT '产出、消耗类型',
  `param1` bigint(20) NOT NULL DEFAULT '0' COMMENT '辅助参数1',
  `param2` bigint(20) NOT NULL DEFAULT '0' COMMENT '辅助参数2',
  `param3` varchar(50) NOT NULL DEFAULT '' COMMENT '辅助参数3',
  `happend_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发生时间',
  `log_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '写日志时间',
  KEY `log_time` (`log_time`) USING BTREE,
  KEY `money_store` (`happend_time`,`money_type`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='货币日志';

-- ----------------------------
-- Records of log_money
-- ----------------------------

-- ----------------------------
-- Table structure for `op_log`
-- ----------------------------
DROP TABLE IF EXISTS `op_log`;
CREATE TABLE `op_log` (
  `role_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '玩家ID',
  `op` varchar(2000) DEFAULT '' COMMENT '操作',
  `happend_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发生时间',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '错误类型（1操作，2服务器错误码，3客户端错误)',
  KEY `role_id` (`role_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='建筑消息记录';

-- ----------------------------
-- Records of op_log
-- ----------------------------

-- ----------------------------
-- Table structure for `t_account`
-- ----------------------------
DROP TABLE IF EXISTS `t_account`;
CREATE TABLE `t_account` (
  `account` varchar(100) NOT NULL COMMENT '帐号',
  `role_name` varchar(100) NOT NULL COMMENT '角色名',
  `account_create_dateline` int(10) unsigned NOT NULL COMMENT '帐号初始化时间',
  `account_create_y` smallint(4) unsigned NOT NULL COMMENT '帐号初始化y',
  `account_create_m` tinyint(2) NOT NULL COMMENT '帐号初始化m',
  `account_create_d` tinyint(2) NOT NULL COMMENT '帐号初始化d',
  `account_create_h` tinyint(2) NOT NULL COMMENT '帐号初始化h',
  `role_create_dateline` int(10) unsigned NOT NULL COMMENT '角色初始化时间',
  `role_create_y` smallint(4) unsigned NOT NULL COMMENT '角色初始化y',
  `role_create_m` tinyint(2) NOT NULL COMMENT '角色初始化m',
  `role_create_d` tinyint(2) NOT NULL COMMENT '角色初始化d',
  `role_create_h` tinyint(2) NOT NULL COMMENT '角色初始化h',
  `account_last_dateline` int(10) unsigned NOT NULL COMMENT '帐号最后一次登录的时间',
  `account_last_y` smallint(4) unsigned NOT NULL COMMENT '帐号最后一次登录y',
  `account_last_m` int(11) NOT NULL COMMENT '帐号最后一次登录m',
  `account_last_d` int(11) NOT NULL COMMENT '帐号最后一次登录d',
  `account_last_h` int(11) NOT NULL COMMENT '帐号最后一次登录h',
  `role_last_dateline` int(10) unsigned NOT NULL COMMENT '角色最后一次登录时间',
  `role_last_y` smallint(4) unsigned NOT NULL COMMENT '角色最后一次登录y',
  `role_last_m` tinyint(2) NOT NULL COMMENT '角色最后一次登录m',
  `role_last_d` tinyint(2) NOT NULL COMMENT '角色最后一次登录d',
  `role_last_h` tinyint(2) NOT NULL COMMENT '角色最后一次登录h',
  `account_login_times` int(10) unsigned NOT NULL COMMENT '帐号登录次数',
  `role_login_times` int(10) unsigned NOT NULL COMMENT '角色登录次数',
  `last_ip` char(30) NOT NULL COMMENT '最后一次的ip',
  `status` tinyint(2) NOT NULL COMMENT '状态 1正常 2进制登录',
  PRIMARY KEY (`account`),
  UNIQUE KEY `role_name` (`role_name`,`role_last_y`,`role_last_m`,`role_last_d`,`role_last_h`) USING BTREE,
  KEY `account_create_y` (`account_create_y`,`account_create_m`,`account_create_d`,`account_create_h`,`role_create_y`,`role_create_m`,`role_create_d`,`role_create_h`,`account_last_y`,`account_last_m`,`account_last_d`,`account_last_h`,`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_account
-- ----------------------------

-- ----------------------------
-- Table structure for `t_account_login_count`
-- ----------------------------
DROP TABLE IF EXISTS `t_account_login_count`;
CREATE TABLE `t_account_login_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `total_number` int(11) NOT NULL,
  `once_number` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1230 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_account_login_count
-- ----------------------------

-- ----------------------------
-- Table structure for `t_account_port`
-- ----------------------------
DROP TABLE IF EXISTS `t_account_port`;
CREATE TABLE `t_account_port` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) NOT NULL COMMENT '玩家账号',
  `ip_address` varchar(50) NOT NULL COMMENT 'IP地址',
  `from` varchar(200) NOT NULL COMMENT '玩家所在地',
  `suppliers` varchar(20) NOT NULL COMMENT '网络供应商',
  `port` varchar(20) NOT NULL COMMENT '连接端口',
  `serverhost` varchar(20) NOT NULL COMMENT '连接服务器地址',
  `type` varchar(20) NOT NULL COMMENT '节点类型',
  `errortype` varchar(20) NOT NULL COMMENT '错误类型',
  PRIMARY KEY (`id`),
  KEY `account` (`account`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='记录登录失败玩家端口信息';

-- ----------------------------
-- Records of t_account_port
-- ----------------------------

-- ----------------------------
-- Table structure for `t_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_user`;
CREATE TABLE `t_admin_user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `user_power` text NOT NULL,
  `last_login_time` int(11) NOT NULL,
  `agent_id` text NOT NULL COMMENT '代理商ID',
  `admin_desc` text COMMENT '账户描述',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin_user
-- ----------------------------

-- ----------------------------
-- Table structure for `t_admin_user_test`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin_user_test`;
CREATE TABLE `t_admin_user_test` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `gid` int(10) NOT NULL COMMENT '群组id',
  `last_login_time` int(11) NOT NULL,
  `agent_id` text NOT NULL COMMENT '代理商ID',
  `admin_desc` text COMMENT '账户描述',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=158 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin_user_test
-- ----------------------------
INSERT INTO `t_admin_user_test` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1', '0', '1 4 7 ', '研发最高管理权限');

-- ----------------------------
-- Table structure for `t_ban_account`
-- ----------------------------
DROP TABLE IF EXISTS `t_ban_account`;
CREATE TABLE `t_ban_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `role_name` varchar(50) DEFAULT NULL COMMENT '角色名',
  `account_name` varchar(50) DEFAULT NULL COMMENT '账号',
  `last_login_ip` varchar(50) DEFAULT NULL COMMENT '最后登录IP',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '等级',
  `pay_all` int(11) NOT NULL DEFAULT '0' COMMENT '充值总额',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '封禁开始时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '封禁结束时间',
  `ban_reason` text NOT NULL COMMENT '封禁原因',
  `admin` varchar(50) NOT NULL COMMENT '操作者',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ban_account
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ban_ip`
-- ----------------------------
DROP TABLE IF EXISTS `t_ban_ip`;
CREATE TABLE `t_ban_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_login_ip` varchar(50) NOT NULL,
  `end_time` int(11) NOT NULL DEFAULT '0',
  `ban_reason` text,
  `admin` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ban_ip
-- ----------------------------

-- ----------------------------
-- Table structure for `t_banned_to_post`
-- ----------------------------
DROP TABLE IF EXISTS `t_banned_to_post`;
CREATE TABLE `t_banned_to_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `role_name` varchar(50) NOT NULL DEFAULT '',
  `account_name` varchar(50) NOT NULL DEFAULT '',
  `last_login_ip` varchar(50) NOT NULL DEFAULT '',
  `level` int(11) NOT NULL DEFAULT '0',
  `pay_all` int(11) NOT NULL DEFAULT '0',
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL DEFAULT '0',
  `ban_reason` text,
  `admin` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_banned_to_post
-- ----------------------------

-- ----------------------------
-- Table structure for `t_family_summary`
-- ----------------------------
DROP TABLE IF EXISTS `t_family_summary`;
CREATE TABLE `t_family_summary` (
  `family_id` int(10) unsigned NOT NULL,
  `family_name` varchar(50) NOT NULL,
  `create_role_id` int(10) unsigned NOT NULL COMMENT '创始人角色ID',
  `create_role_name` varchar(50) NOT NULL,
  `owner_role_id` int(10) unsigned NOT NULL,
  `owner_role_name` varchar(50) NOT NULL,
  `faction_id` int(11) NOT NULL,
  `active_points` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `cur_members` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `gongxun` int(11) NOT NULL,
  `create_time` int(10) unsigned NOT NULL,
  `max_members` int(11) NOT NULL,
  `public_notice` varchar(255) NOT NULL,
  `ally_num` int(11) NOT NULL,
  PRIMARY KEY (`family_id`),
  KEY `cur_members` (`cur_members`) USING BTREE,
  KEY `active_points` (`active_points`) USING BTREE,
  KEY `level` (`level`) USING BTREE,
  KEY `gongxun` (`gongxun`) USING BTREE,
  KEY `create_time` (`create_time`) USING BTREE,
  KEY `faction_id` (`faction_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_family_summary
-- ----------------------------

-- ----------------------------
-- Table structure for `t_GM_Complaint`
-- ----------------------------
DROP TABLE IF EXISTS `t_GM_Complaint`;
CREATE TABLE `t_GM_Complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roleid` int(11) NOT NULL COMMENT '角色ID',
  `account_name` varchar(50) NOT NULL COMMENT '账号',
  `role_name` varchar(50) NOT NULL COMMENT '角色名',
  `level` int(11) NOT NULL COMMENT '角色等级',
  `time` int(11) NOT NULL COMMENT '提交时间',
  `type` int(11) NOT NULL COMMENT 'BUG分类',
  `title` varchar(250) NOT NULL COMMENT '标题',
  `content` varchar(500) NOT NULL COMMENT '内容',
  `reply` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL COMMENT 'BUG状态',
  PRIMARY KEY (`id`),
  KEY `roleid` (`roleid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_GM_Complaint
-- ----------------------------

-- ----------------------------
-- Table structure for `t_group`
-- ----------------------------
DROP TABLE IF EXISTS `t_group`;
CREATE TABLE `t_group` (
  `gid` int(10) NOT NULL AUTO_INCREMENT COMMENT '群组id',
  `name` varchar(50) NOT NULL COMMENT '群组名',
  `power` text NOT NULL COMMENT '群组权限',
  `remark` varchar(200) DEFAULT '请填写群组描述' COMMENT '群组描述',
  PRIMARY KEY (`gid`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='群组信息表';

-- ----------------------------
-- Records of t_group
-- ----------------------------
INSERT INTO `t_group` VALUES ('1', '01-超级管理员', '1 2 81 3 4 5 6 7 8 9 10 67 68 76 85 86 87 88 94 96 97 102 106 11 12 13 14 74 126 133 75 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 58 53 54 63 134 135 136 30 32 33 34 56 60 77 95 98 99 101 105 107 36 37 38 39 41 42 43 44 45 46 51 52 61 89 103 47 79 80 49 50', ' 超级管理员');
INSERT INTO `t_group` VALUES ('7', '11-运营管理', '3 4 5 6 7 8 9 10 57 76 11 12 13 14 126 133 15 16 17 18 19 20 21 22 23 24 29 58 53 54 63 30 32 33 34 56 60 77 95 98 99 101 105 36 37 38 39 41 42 51 52 49 50', ' 运营常规数据');
INSERT INTO `t_group` VALUES ('9', '12-客服权限', '20 21 22 42 51 52 49 50', ' 标准客服权限');
INSERT INTO `t_group` VALUES ('26', '14-客服主管', '4 5 6 7 57 20 21 29 53 63 30 31 56 77 98 99 101 36 37 41 42 51 52 49 50', ' 客服管理人员');
INSERT INTO `t_group` VALUES ('23', '13-运营市场', '3 4 5 6 7 8 9 10 57 76 11 12 13 14 15 16 17 18 19 49 50', ' 运营市场');
INSERT INTO `t_group` VALUES ('24', '02-研发策划', '3 4 5 6 7 8 9 10 57 76 113 11 12 13 14 74 126 133 75 15 16 17 18 19 20 21 22 29 53 54 58 63 30 31 32 33 34 56 60 77 78 95 98 99 101 105 107 108 109 110 114 39 41 49 50', ' 研发策划');
INSERT INTO `t_group` VALUES ('25', '10-运营最高管理', '3 4 5 6 7 8 9 10 57 76 11 12 13 14 126 133 15 16 17 18 19 20 21 22 23 24 28 29 58 53 54 63 30 32 33 34 56 60 77 95 98 99 101 105 36 37 38 39 41 42 51 52 49 50', ' 运营最高管理员权限');
INSERT INTO `t_group` VALUES ('27', '03-研发数据', '3 4 5 6 7 8 9 10 57 113 11 12 13 14 126 133 15 16 17 18 19 20 21 22 23 30 32 33 34 0 47 48 79 80 49 50', '研发数据查询');
INSERT INTO `t_group` VALUES ('28', '04-研发QA', '30 31 32 60 77 98 99 101 105 41 49 50', ' 研发QA专用');

-- ----------------------------
-- Table structure for `t_level_count`
-- ----------------------------
DROP TABLE IF EXISTS `t_level_count`;
CREATE TABLE `t_level_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` int(11) NOT NULL,
  `level1` int(11) NOT NULL,
  `level2` int(11) NOT NULL,
  `level3` int(11) NOT NULL,
  `level4` int(11) NOT NULL,
  `level5` int(11) NOT NULL,
  `level6` int(11) NOT NULL,
  `level7` int(11) NOT NULL,
  `level8` int(11) NOT NULL,
  `level9` int(11) NOT NULL,
  `level10` int(11) NOT NULL,
  `level11` int(11) NOT NULL,
  `level12` int(11) NOT NULL,
  `level13` int(11) NOT NULL,
  `level14` int(11) NOT NULL,
  `level15` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `datetime` (`datetime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_level_count
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_activity`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_activity`;
CREATE TABLE `t_log_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) DEFAULT '0',
  `role_id` int(11) DEFAULT '0',
  `sycee_num` int(11) DEFAULT '0',
  `create_time` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_activity
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_add_exp`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_add_exp`;
CREATE TABLE `t_log_add_exp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `role_name` varchar(50) DEFAULT NULL COMMENT '角色名',
  `level` int(11) DEFAULT NULL COMMENT '等级后的等级',
  `mtime` int(11) DEFAULT NULL COMMENT '升级时间',
  `old_exp` int(11) DEFAULT NULL COMMENT '原有经验',
  `now_exp` int(11) DEFAULT NULL COMMENT '现有经验',
  `add_exp` int(11) DEFAULT NULL COMMENT '增加的经验',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`,`mtime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=105787 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_add_exp
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_admin`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_admin`;
CREATE TABLE `t_log_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `admin_name` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员帐号名',
  `admin_ip` varchar(15) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作的角色ID',
  `user_name` varchar(50) NOT NULL DEFAULT '',
  `mtime` int(11) NOT NULL DEFAULT '0',
  `mtype` int(11) NOT NULL DEFAULT '0' COMMENT '操作类型',
  `mdetail` text NOT NULL COMMENT '操作内容 ',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `desc` varchar(5000) NOT NULL DEFAULT '' COMMENT '详细使用说明',
  `users` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3155 DEFAULT CHARSET=utf8 COMMENT='管理后台的日志表';

-- ----------------------------
-- Records of t_log_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_attendance`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_attendance`;
CREATE TABLE `t_log_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL COMMENT '活动类型',
  `mtime` int(11) NOT NULL DEFAULT '0' COMMENT '日期',
  `sign_up_cnt` int(11) NOT NULL DEFAULT '0' COMMENT '报名人数',
  `attend_cnt` int(11) NOT NULL DEFAULT '0' COMMENT '实际参加人数',
  `other` varchar(250) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_attendance
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_boss_kill`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_boss_kill`;
CREATE TABLE `t_log_boss_kill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `map_id` int(64) DEFAULT NULL COMMENT '地图id',
  `map_name` varchar(128) DEFAULT NULL COMMENT '地图名',
  `boss_name` varchar(128) DEFAULT NULL COMMENT '野外bossid',
  `mtime` int(11) DEFAULT NULL COMMENT '击杀时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_boss_kill
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_boss_refresh`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_boss_refresh`;
CREATE TABLE `t_log_boss_refresh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `map_id` int(11) NOT NULL DEFAULT '0' COMMENT '地图id',
  `map_name` varchar(128) DEFAULT NULL COMMENT '地图名',
  `type_id` int(11) DEFAULT NULL COMMENT '类型id',
  `boss_name` varchar(128) DEFAULT NULL COMMENT '野外boss名',
  `mtime` int(11) DEFAULT NULL COMMENT '刷新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_boss_refresh
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_card`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_card`;
CREATE TABLE `t_log_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `dateline` int(11) NOT NULL COMMENT '领取时间',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `role_name` varchar(50) NOT NULL COMMENT '角色名',
  `account_name` varchar(50) NOT NULL COMMENT '账号名',
  `card_num` varchar(32) NOT NULL COMMENT '卡号',
  `type` smallint(4) NOT NULL COMMENT '类型：0-新手卡，1-帮会卡，2-手机卡',
  PRIMARY KEY (`id`),
  UNIQUE KEY `card_num` (`card_num`,`type`) USING BTREE,
  KEY `account_name` (`account_name`) USING BTREE,
  KEY `role_name` (`role_name`) USING BTREE,
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `dateline` (`dateline`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='各种卡领取信息表';

-- ----------------------------
-- Records of t_log_card
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_comp_stone`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_comp_stone`;
CREATE TABLE `t_log_comp_stone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT 'role ID',
  `role_name` varchar(50) NOT NULL COMMENT 'role name',
  `role_lv` smallint(5) NOT NULL COMMENT 'role level',
  `mtime` int(11) NOT NULL COMMENT 'log datetime',
  `stone_id` int(11) NOT NULL DEFAULT '0' COMMENT 'stone typeid',
  `rune_id` int(11) NOT NULL DEFAULT '0' COMMENT 'cost rune typeid',
  `r_bind` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'if rune is bound',
  `src_id` int(11) NOT NULL DEFAULT '0' COMMENT 'source stone typeid',
  `src_num` int(11) NOT NULL DEFAULT '0' COMMENT 'use count of source stone in one turn',
  `s_bind` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'if stone is bound',
  `fail_n` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'fail count',
  `succ_n` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'succ count',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_comp_stone
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_day_gold`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_day_gold`;
CREATE TABLE `t_log_day_gold` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `left_unbind` int(11) NOT NULL COMMENT '剩余非绑定元宝',
  `left_bind` int(11) NOT NULL COMMENT '剩余绑定元宝',
  `add_unbind` int(11) NOT NULL COMMENT '增加非绑定元宝',
  `add_bind` int(11) NOT NULL COMMENT '增加绑定元宝',
  `used_unbind` int(11) NOT NULL COMMENT '消耗非绑定元宝',
  `used_bind` int(11) NOT NULL COMMENT '消耗绑定元宝',
  `send_unbind` int(11) NOT NULL COMMENT '赠送非绑定元宝',
  `send_bind` int(11) NOT NULL COMMENT '赠送绑定元宝',
  `avg_online` int(11) NOT NULL COMMENT '平均在线',
  `dateline` int(11) NOT NULL COMMENT '日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `dateline` (`dateline`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='每日元宝统计表';

-- ----------------------------
-- Records of t_log_day_gold
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_day_stay`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_day_stay`;
CREATE TABLE `t_log_day_stay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `login_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57111 DEFAULT CHARSET=utf8 COMMENT='单日留存统计';

-- ----------------------------
-- Records of t_log_day_stay
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_drama`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_drama`;
CREATE TABLE `t_log_drama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drama_id` int(11) NOT NULL COMMENT '剧情ID',
  `time` int(11) NOT NULL COMMENT '时间',
  `start_cnt` int(11) NOT NULL COMMENT '剧情开始个数',
  `finish_cnt` int(11) NOT NULL COMMENT '剧情完成个数',
  `skip_cnt` int(11) NOT NULL COMMENT '跳过剧情个数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_drama
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_eq_up`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_eq_up`;
CREATE TABLE `t_log_eq_up` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT 'role ID',
  `role_name` varchar(50) NOT NULL COMMENT 'role name',
  `role_lv` smallint(5) NOT NULL COMMENT 'role level',
  `mtime` int(11) NOT NULL COMMENT 'log datetime',
  `o_equipid` int(11) NOT NULL COMMENT 'old equip typeid ',
  `n_equipid` int(11) NOT NULL COMMENT 'new equip typeid ',
  `item_id` int(11) NOT NULL COMMENT 'pgoods typeid ',
  `num` tinyint(4) NOT NULL COMMENT 'cost num ',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_eq_up
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_exit`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_exit`;
CREATE TABLE `t_log_exit` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `account_name` varchar(50) DEFAULT NULL COMMENT '账号',
  `mtime` int(11) DEFAULT NULL COMMENT '掉线时间戳',
  `ip` varchar(50) NOT NULL COMMENT 'ip地址',
  `reason` varchar(512) NOT NULL COMMENT '掉线原因',
  `state` int(11) NOT NULL COMMENT '掉线前状态',
  `agent_id` int(11) NOT NULL COMMENT '代理平台id',
  PRIMARY KEY (`id`),
  KEY `account_name` (`account_name`,`mtime`,`agent_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10815 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_exit
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_faction_online`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_faction_online`;
CREATE TABLE `t_log_faction_online` (
  `mtime` int(11) NOT NULL,
  `t_role_num` int(11) NOT NULL,
  `s_role_num` int(11) NOT NULL,
  `tonline` int(11) NOT NULL,
  `sonline` int(11) NOT NULL,
  UNIQUE KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_faction_online
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_family_office`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_family_office`;
CREATE TABLE `t_log_family_office` (
  `role_id` int(11) NOT NULL,
  `family_id` int(11) NOT NULL,
  `type` int(3) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_family_office
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_festival_pay`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_festival_pay`;
CREATE TABLE `t_log_festival_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `role_name` varchar(256) DEFAULT NULL COMMENT '角色名',
  `account_name` varchar(256) DEFAULT NULL COMMENT '账号',
  `type_id` int(11) DEFAULT NULL COMMENT '类型',
  `event_id` int(11) DEFAULT NULL COMMENT '活动id',
  `sub_event_id` int(11) DEFAULT NULL COMMENT '活动子id',
  `detail` text COMMENT '详情',
  `mtime` int(11) DEFAULT NULL COMMENT '领取时间',
  PRIMARY KEY (`id`),
  KEY `mtime` (`mtime`) USING BTREE,
  KEY `role_name` (`role_name`) USING BTREE,
  KEY `event_id` (`event_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_festival_pay
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_first_pay`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_first_pay`;
CREATE TABLE `t_log_first_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_id` int(11) DEFAULT NULL COMMENT '角色id',
  `role_name` varchar(256) DEFAULT NULL COMMENT '角色名',
  `account_name` varchar(256) DEFAULT NULL COMMENT '账号',
  `level` int(11) DEFAULT NULL COMMENT '领取时等级',
  `first_pay_money` int(11) DEFAULT NULL COMMENT '首充金额',
  `first_pay_ticket` int(11) DEFAULT NULL COMMENT '首充代金券',
  `first_pay_gold` int(11) DEFAULT NULL COMMENT '首充元宝',
  `first_pay_time` int(11) DEFAULT NULL COMMENT '首充时间',
  `mtime` int(11) DEFAULT NULL COMMENT '领取时间',
  PRIMARY KEY (`id`),
  KEY `mtime` (`mtime`) USING BTREE,
  KEY `role_name` (`role_name`) USING BTREE,
  KEY `first_pay_time` (`first_pay_time`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=213 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_first_pay
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_forge`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_forge`;
CREATE TABLE `t_log_forge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT 'role ID',
  `role_name` varchar(50) NOT NULL COMMENT 'role name',
  `role_lv` smallint(5) NOT NULL COMMENT 'role level',
  `item_id` int(11) NOT NULL COMMENT 'pgoods typeid ',
  `mtime` int(11) NOT NULL COMMENT 'log datetime',
  `o_star` tinyint(4) NOT NULL COMMENT 'old forge star level',
  `n_star` tinyint(4) NOT NULL COMMENT 'new forge star level',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_forge
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_game_event`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_game_event`;
CREATE TABLE `t_log_game_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(50) NOT NULL COMMENT '玩家账号',
  `datetime` int(11) NOT NULL COMMENT '触发时间',
  `event` varchar(50) NOT NULL COMMENT '触发点',
  `server_name` varchar(50) NOT NULL COMMENT '服务器',
  `version` varchar(20) DEFAULT NULL COMMENT '玩家flash版本',
  `resolution` varchar(20) DEFAULT NULL COMMENT '玩家屏幕分辨率',
  `brower` varchar(20) DEFAULT NULL COMMENT '玩家浏览器版本',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_game_event
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_game_event2`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_game_event2`;
CREATE TABLE `t_log_game_event2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(50) NOT NULL COMMENT '玩家账号',
  `datetime` int(11) NOT NULL COMMENT '触发时间',
  `event` varchar(50) NOT NULL COMMENT '触发点',
  `server_name` varchar(50) NOT NULL COMMENT '服务器',
  `version` varchar(20) DEFAULT NULL COMMENT '玩家flash版本',
  `resolution` varchar(20) DEFAULT NULL COMMENT '玩家屏幕分辨率',
  `brower` varchar(20) DEFAULT NULL COMMENT '玩家浏览器版本',
  PRIMARY KEY (`id`),
  KEY `account_name` (`account_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5770 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_game_event2
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_inlay`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_inlay`;
CREATE TABLE `t_log_inlay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT 'role ID',
  `role_name` varchar(50) NOT NULL COMMENT 'role name',
  `role_lv` smallint(5) NOT NULL COMMENT 'role level',
  `item_id` int(11) NOT NULL COMMENT 'pgoods typeid ',
  `mtime` int(11) NOT NULL COMMENT 'log datetime',
  `hole` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'hole index',
  `stone_id` int(11) NOT NULL DEFAULT '0' COMMENT 'stone typeid',
  `s_bind` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'if stone is bound',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_inlay
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_inter_pk_3v3`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_inter_pk_3v3`;
CREATE TABLE `t_log_inter_pk_3v3` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `team_id` int(11) NOT NULL COMMENT '队伍ID',
  `type` smallint(4) NOT NULL COMMENT '类型：1、报名；2、登陆',
  `dateline` int(11) NOT NULL COMMENT '日期',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_id` (`role_id`,`type`,`dateline`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='跨服战3V3统计表';

-- ----------------------------
-- Records of t_log_inter_pk_3v3
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_item`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_item`;
CREATE TABLE `t_log_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '玩家ID',
  `role_name` varchar(50) NOT NULL COMMENT '玩家名',
  `item_id` int(11) NOT NULL COMMENT '道具typeid',
  `item_name` varchar(50) NOT NULL COMMENT '道具名称',
  `item_num` int(11) NOT NULL COMMENT '道具数量',
  `mtime` int(11) NOT NULL COMMENT '时间',
  `mtype` int(11) NOT NULL COMMENT '类型',
  `mdetail` varchar(250) NOT NULL COMMENT '描述',
  `src_role_id` int(11) NOT NULL COMMENT '关联玩家ID',
  `src_role_name` varchar(50) NOT NULL COMMENT '关联玩家名',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`,`role_name`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=767713 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_item
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_levelup`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_levelup`;
CREATE TABLE `t_log_levelup` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` varchar(50) NOT NULL COMMENT '角色名',
  `account_name` varchar(50) NOT NULL COMMENT '账号',
  `old_level` int(11) NOT NULL DEFAULT '1' COMMENT '原等级',
  `new_level` int(11) NOT NULL DEFAULT '1' COMMENT '新等级',
  `mtime` int(11) NOT NULL DEFAULT '0' COMMENT '升级时间',
  `map_id` int(11) NOT NULL DEFAULT '0' COMMENT '升级时所在地图id',
  `reincarnation` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=110925 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_levelup
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_login_error`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_login_error`;
CREATE TABLE `t_log_login_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(50) NOT NULL COMMENT '玩家账号',
  `datetime` int(11) NOT NULL COMMENT '触发时间',
  `server_name` varchar(50) NOT NULL COMMENT '服务器',
  `error_step` int(11) NOT NULL COMMENT '错误发生点',
  `error_id` int(11) NOT NULL COMMENT '错误id',
  `error_msg` text COMMENT '错误字符串',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_login_error
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_mission`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_mission`;
CREATE TABLE `t_log_mission` (
  `mission_id` int(11) NOT NULL COMMENT '任务ID',
  `name` varchar(50) NOT NULL COMMENT '任务名字',
  `accept_num` int(11) NOT NULL COMMENT '接受数量',
  `complete_num` int(11) NOT NULL COMMENT '完成数量',
  `cancel_num` int(11) NOT NULL COMMENT '取消数量',
  PRIMARY KEY (`mission_id`),
  KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_mission
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_mission_complete`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_mission_complete`;
CREATE TABLE `t_log_mission_complete` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mission_id` int(11) NOT NULL COMMENT '任务ID',
  `name` varchar(50) NOT NULL COMMENT '任务名字',
  `complete_num` int(11) NOT NULL COMMENT '完成数量',
  `level` int(11) NOT NULL COMMENT '接受任务级别',
  `level_complete_num` int(11) NOT NULL COMMENT '级别完成数量',
  `year` int(11) NOT NULL COMMENT '年',
  `month` int(11) NOT NULL COMMENT '月',
  `day` int(11) NOT NULL COMMENT '日',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_mission_complete
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_mounts`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_mounts`;
CREATE TABLE `t_log_mounts` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `class_level` int(2) NOT NULL COMMENT '坐骑阶数',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='玩家坐骑表';

-- ----------------------------
-- Records of t_log_mounts
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_notice_reply`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_notice_reply`;
CREATE TABLE `t_log_notice_reply` (
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `goods_id` int(16) NOT NULL,
  `num` int(3) NOT NULL,
  `level_min` int(3) NOT NULL,
  `level_max` int(3) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operator` varchar(50) NOT NULL COMMENT '操作人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_notice_reply
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_online`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_online`;
CREATE TABLE `t_log_online` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `online` int(10) unsigned NOT NULL COMMENT '在线数量',
  `dateline` int(11) NOT NULL,
  `week_day` tinyint(4) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `distinct_ip` int(11) NOT NULL DEFAULT '0' COMMENT '在线IP数量',
  PRIMARY KEY (`id`),
  KEY `year` (`year`) USING BTREE,
  KEY `week_day` (`week_day`) USING BTREE,
  KEY `dateline` (`dateline`) USING BTREE,
  KEY `month` (`month`) USING BTREE,
  KEY `day` (`day`) USING BTREE,
  KEY `hour` (`hour`) USING BTREE,
  KEY `min` (`min`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=774680 DEFAULT CHARSET=utf8 COMMENT='玩家在线日志表';

-- ----------------------------
-- Records of t_log_online
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_online_summary`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_online_summary`;
CREATE TABLE `t_log_online_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `now_time` int(11) DEFAULT '0' COMMENT '此条记录时间',
  `now_online` int(11) DEFAULT '0' COMMENT '当前在线人数',
  `max_online` int(11) DEFAULT '0' COMMENT '当日最高在线',
  `min_online` int(11) DEFAULT '0' COMMENT '当日最低在线',
  `all_max_online` int(11) DEFAULT '0' COMMENT '单服最高在线',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_online_summary
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_online_summary_all`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_online_summary_all`;
CREATE TABLE `t_log_online_summary_all` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `now_time` int(11) DEFAULT '0' COMMENT '此条记录时间',
  `now_online` int(11) DEFAULT '0' COMMENT '当前在线人数',
  `max_online` int(11) DEFAULT '0' COMMENT '当日最高在线',
  `min_online` int(11) DEFAULT '0' COMMENT '当日最低在线',
  `all_max_online` int(11) DEFAULT '0' COMMENT '单服最高在线',
  `game_server_id` int(11) NOT NULL COMMENT '服务器id',
  `agent_id` int(11) NOT NULL COMMENT '运营商id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_online_summary_all
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_pay`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_pay`;
CREATE TABLE `t_log_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20000) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `pay_time` int(11) DEFAULT NULL,
  `pay_gold` int(11) DEFAULT NULL,
  `pay_money` int(11) DEFAULT NULL,
  `pay_ticket` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_pay
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_pay_day`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_pay_day`;
CREATE TABLE `t_log_pay_day` (
  `id` varchar(200) NOT NULL COMMENT '日期运营商服务器拼成唯一id',
  `pay_day` float DEFAULT NULL COMMENT '当天充值总额',
  `role_cnt` int(11) DEFAULT NULL COMMENT '当天充值人数',
  `times_cnt` int(11) DEFAULT NULL COMMENT '当天充值人次',
  `arpu` float DEFAULT NULL COMMENT '当天arpu值',
  `year` int(11) DEFAULT NULL COMMENT '年',
  `month` int(11) DEFAULT NULL COMMENT '月',
  `day` int(11) DEFAULT NULL COMMENT '日',
  `agent_id` int(11) DEFAULT NULL COMMENT '运营商id',
  `game_server_id` int(11) DEFAULT NULL COMMENT '服务器id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_pay_day
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_pay_day_all`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_pay_day_all`;
CREATE TABLE `t_log_pay_day_all` (
  `id` varchar(200) NOT NULL COMMENT '日期运营商服务器拼成唯一id',
  `pay_day` float DEFAULT NULL COMMENT '当天充值总额',
  `role_cnt` int(11) DEFAULT NULL COMMENT '当天充值人数',
  `times_cnt` int(11) DEFAULT NULL COMMENT '当天充值人次',
  `arpu` float DEFAULT NULL COMMENT '当天arpu值',
  `year` int(11) DEFAULT NULL COMMENT '年',
  `month` int(11) DEFAULT NULL COMMENT '月',
  `day` int(11) DEFAULT NULL COMMENT '日',
  `agent_id` int(11) DEFAULT NULL COMMENT '运营商id',
  `game_server_id` int(11) DEFAULT NULL COMMENT '服务器id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_pay_day_all
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_pay_error`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_pay_error`;
CREATE TABLE `t_log_pay_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) DEFAULT NULL,
  `account_name` varchar(50) DEFAULT NULL,
  `pay_time` int(11) DEFAULT NULL,
  `pay_gold` int(11) DEFAULT NULL,
  `pay_money` int(11) DEFAULT NULL,
  `pay_ticket` int(11) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_pay_error
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_potential`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_potential`;
CREATE TABLE `t_log_potential` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `mtype` int(1) NOT NULL DEFAULT '1' COMMENT '1获得2被融合',
  `ptype` int(6) NOT NULL COMMENT '名典typeid',
  `pname` varchar(50) NOT NULL,
  `pcolor` int(1) NOT NULL DEFAULT '1' COMMENT '名典颜色',
  `datetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='玩家历练表';

-- ----------------------------
-- Records of t_log_potential
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_prestige`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_prestige`;
CREATE TABLE `t_log_prestige` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `prestige` int(11) NOT NULL COMMENT '功勋值',
  `dateline` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='玩家功勋表';

-- ----------------------------
-- Records of t_log_prestige
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_reinforce`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_reinforce`;
CREATE TABLE `t_log_reinforce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT 'role ID',
  `role_name` varchar(50) NOT NULL COMMENT 'role name',
  `role_lv` smallint(5) NOT NULL COMMENT 'role level',
  `mtime` int(11) NOT NULL COMMENT 'log datetime',
  `type_id` int(11) NOT NULL COMMENT 'equip typeid',
  `oldrein` tinyint(4) NOT NULL COMMENT 'old reinforce level',
  `newrein` tinyint(4) NOT NULL COMMENT 'new reinforce level',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_reinforce
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_resycle`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_resycle`;
CREATE TABLE `t_log_resycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `mtime` int(11) NOT NULL DEFAULT '0' COMMENT '回炉时间',
  `equip_id` int(11) NOT NULL COMMENT '回炉装备id',
  `equip_name` varchar(50) NOT NULL COMMENT '装备名',
  `bind` varchar(50) NOT NULL COMMENT '是否绑定',
  `current_colour` int(11) NOT NULL COMMENT '装备颜色',
  `reinforce_result` int(11) NOT NULL COMMENT '锻造星数',
  `punch_num` int(11) NOT NULL COMMENT '开孔数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_resycle
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_review`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_review`;
CREATE TABLE `t_log_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员ID',
  `admin_name` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员帐号名',
  `admin_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '管理员ip',
  `user_id` text NOT NULL COMMENT '玩家角色ID列表',
  `user_name` text NOT NULL COMMENT '玩家角色名列表',
  `mtime` int(11) NOT NULL DEFAULT '0',
  `mtype` int(11) NOT NULL DEFAULT '0' COMMENT '操作类型',
  `mdetail` text NOT NULL COMMENT '操作内容 ',
  `item_name` text NOT NULL COMMENT '操作类型',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '道具id',
  `goods_name` varchar(50) DEFAULT NULL COMMENT '增送物品名字',
  `bind` int(11) NOT NULL DEFAULT '1' COMMENT '是否绑定',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `reason` text NOT NULL COMMENT '赠送理由',
  `desc` varchar(5000) NOT NULL DEFAULT '' COMMENT '详细使用说明',
  `status` int(11) NOT NULL DEFAULT '-1' COMMENT '审核状态',
  `review_admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '审核管理员ID',
  `review_admin_name` varchar(50) NOT NULL DEFAULT '' COMMENT '审核管理员帐号名',
  `review_admin_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '审核管理员ip',
  `review_mtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=474 DEFAULT CHARSET=utf8 COMMENT='管理后台的日志表';

-- ----------------------------
-- Records of t_log_review
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_routine`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_routine`;
CREATE TABLE `t_log_routine` (
  `mtime` int(11) NOT NULL COMMENT 'log datetime',
  `r_id` int(11) NOT NULL COMMENT 'routine_id',
  `players` int(11) NOT NULL COMMENT 'player count',
  `do_times` int(11) NOT NULL COMMENT 'total do times',
  UNIQUE KEY `rt` (`mtime`,`r_id`) USING BTREE,
  KEY `r_id` (`r_id`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_routine
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_treasure`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_treasure`;
CREATE TABLE `t_log_treasure` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL,
  `num_type` int(2) NOT NULL COMMENT '刷新次数',
  `role_id` int(10) NOT NULL COMMENT '角色ID',
  `date` int(11) NOT NULL,
  `lucky` int(10) NOT NULL COMMENT '幸运值是否触发',
  `lucky_clear` int(10) NOT NULL COMMENT '幸运值是否清零',
  `goodslist` text NOT NULL,
  `lucky_goods` text NOT NULL COMMENT '幸运值补偿物品',
  KEY `id` (`id`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_treasure
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_unload_stone`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_unload_stone`;
CREATE TABLE `t_log_unload_stone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT 'role ID',
  `role_name` varchar(50) NOT NULL COMMENT 'role name',
  `role_lv` smallint(5) NOT NULL COMMENT 'role level',
  `mtime` int(11) NOT NULL COMMENT 'log datetime',
  `item_id` int(11) NOT NULL COMMENT 'equip typeid ',
  `s1` int(11) NOT NULL DEFAULT '0' COMMENT 'stone1 typeid',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_unload_stone
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_use_gold`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_use_gold`;
CREATE TABLE `t_log_use_gold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '角色名称',
  `account_name` varchar(50) NOT NULL DEFAULT '' COMMENT '登录帐号',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '玩家角色级别',
  `gold_bind` int(11) NOT NULL DEFAULT '0' COMMENT '使用绑定元宝的数量',
  `gold_unbind` int(3) NOT NULL DEFAULT '0' COMMENT '使用不绑定元宝的数量',
  `mtime` int(11) NOT NULL DEFAULT '0' COMMENT '操作时间',
  `mtype` int(11) NOT NULL DEFAULT '0' COMMENT '操作类型',
  `mdetail` varchar(1000) NOT NULL DEFAULT '' COMMENT '操作内容',
  `itemid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '涉及的道具ID',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '涉及的道具等的数量',
  `remain_gold` int(11) NOT NULL DEFAULT '0' COMMENT '当前剩余元宝',
  `remain_goldbind` int(1) NOT NULL DEFAULT '0' COMMENT '当前剩余绑定元宝',
  `agent_id` int(11) NOT NULL DEFAULT '0' COMMENT '代理商ID',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `user_name` (`user_name`) USING BTREE,
  KEY `account_name` (`account_name`) USING BTREE,
  KEY `gold_bind` (`gold_bind`) USING BTREE,
  KEY `gold_unbind` (`gold_unbind`) USING BTREE,
  KEY `mtype` (`mtype`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE,
  KEY `itemid` (`itemid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=350174 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_use_gold
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_use_honor`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_use_honor`;
CREATE TABLE `t_log_use_honor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `honor` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  `mtype` int(11) NOT NULL,
  `mdetail` varchar(50) NOT NULL,
  `itemid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `remain_honor` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_use_honor
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_use_points`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_use_points`;
CREATE TABLE `t_log_use_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  `mtype` int(11) NOT NULL,
  `mdetail` varchar(50) NOT NULL,
  `itemid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `remain_points` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_use_points
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_use_silver`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_use_silver`;
CREATE TABLE `t_log_use_silver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `silver_bind` int(11) NOT NULL DEFAULT '0' COMMENT '使用绑定银两的数量',
  `silver_unbind` int(3) NOT NULL DEFAULT '0' COMMENT '使用不绑定银两的数量',
  `mtime` int(11) NOT NULL DEFAULT '0' COMMENT '操作时间',
  `mtype` int(11) NOT NULL DEFAULT '0' COMMENT '操作类型',
  `mdetail` varchar(1000) NOT NULL DEFAULT '' COMMENT '操作内容',
  `itemid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '涉及的道具ID',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '涉及的道具等的数量',
  `remain_bind` int(11) NOT NULL DEFAULT '0',
  `remain_unbind` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `silver_bind` (`silver_bind`) USING BTREE,
  KEY `silver_unbind` (`silver_unbind`) USING BTREE,
  KEY `mtype` (`mtype`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE,
  KEY `itemid` (`itemid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=31572 DEFAULT CHARSET=utf8 COMMENT='记录玩家银两的获得与使用';

-- ----------------------------
-- Records of t_log_use_silver
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_use_skill_exp`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_use_skill_exp`;
CREATE TABLE `t_log_use_skill_exp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `skill_exp` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  `mtype` int(11) NOT NULL,
  `mdetail` varchar(50) NOT NULL,
  `itemid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `remain_skill_exp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_use_skill_exp
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_use_wuhun`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_use_wuhun`;
CREATE TABLE `t_log_use_wuhun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `wuhun` int(11) NOT NULL,
  `mtime` int(11) NOT NULL,
  `mtype` int(11) NOT NULL,
  `mdetail` varchar(50) NOT NULL,
  `itemid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `remain_wuhun` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_use_wuhun
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_wish`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_wish`;
CREATE TABLE `t_log_wish` (
  `type` int(1) NOT NULL,
  `num_type` int(1) NOT NULL,
  `role_id` int(10) NOT NULL,
  `date` int(11) NOT NULL,
  `oldgold` int(10) NOT NULL,
  `newgold` int(10) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `goodslist` text NOT NULL,
  KEY `id` (`id`) USING BTREE,
  KEY `date` (`date`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log_wish
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_athletics`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_athletics`;
CREATE TABLE `t_ranking_athletics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL COMMENT '时间',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` text NOT NULL COMMENT '角色名',
  `role_level` int(11) NOT NULL COMMENT '角色等级',
  `role_score` int(11) NOT NULL COMMENT '战斗分数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_athletics
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_camp_battle`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_camp_battle`;
CREATE TABLE `t_ranking_camp_battle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL COMMENT '时间',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` text NOT NULL COMMENT '角色名',
  `account_name` text NOT NULL COMMENT '账号',
  `sex` int(11) NOT NULL COMMENT '性别',
  `faction_id` int(11) NOT NULL COMMENT '阵营id',
  `family_name` text NOT NULL COMMENT '帮派',
  `camp_job` text NOT NULL COMMENT '阵营官职',
  `category` int(11) NOT NULL COMMENT '门派',
  `add_honor` int(11) NOT NULL COMMENT '增加的荣誉-排行条件',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_camp_battle
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_campaign`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_campaign`;
CREATE TABLE `t_ranking_campaign` (
  `rank` int(11) NOT NULL COMMENT '排名',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` text NOT NULL COMMENT '角色名',
  `role_level` int(11) NOT NULL COMMENT '等级',
  `map_name` text NOT NULL COMMENT '地图名',
  `scene_id` int(11) NOT NULL COMMENT '征战id',
  `family_name` text NOT NULL COMMENT '帮派',
  `vip_grade` int(11) NOT NULL COMMENT 'vip等级',
  PRIMARY KEY (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_campaign
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_defend`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_defend`;
CREATE TABLE `t_ranking_defend` (
  `rank` int(11) NOT NULL COMMENT '排名',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` varchar(255) NOT NULL COMMENT '角色名',
  `sex` int(11) NOT NULL COMMENT '性别',
  `level` int(11) NOT NULL COMMENT '等级',
  `family_name` varchar(255) NOT NULL COMMENT '帮派',
  `chapter` int(11) NOT NULL COMMENT '章节',
  `count` int(11) NOT NULL COMMENT '关数',
  `vip_grade` int(11) NOT NULL COMMENT 'vip等级',
  PRIMARY KEY (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_defend
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_fightpower`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_fightpower`;
CREATE TABLE `t_ranking_fightpower` (
  `rank` int(11) NOT NULL COMMENT '排名',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` text NOT NULL COMMENT '角色名',
  `fightingpower` int(11) NOT NULL COMMENT '战斗力',
  `title` text NOT NULL COMMENT '称号名',
  `faction_id` int(11) NOT NULL COMMENT '阵营id',
  `family_name` text NOT NULL COMMENT '帮派',
  `vip_grade` int(11) NOT NULL COMMENT 'vip等级',
  PRIMARY KEY (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_fightpower
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_jade`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_jade`;
CREATE TABLE `t_ranking_jade` (
  `rank` int(11) NOT NULL COMMENT '排名',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` text NOT NULL COMMENT '角色名',
  `role_level` int(11) NOT NULL COMMENT '等级',
  `sex` int(11) NOT NULL COMMENT '性别',
  `jade_name` text NOT NULL COMMENT '宠物名',
  `jade_level` int(11) NOT NULL COMMENT '宠物等级',
  `jade_quality` int(11) NOT NULL COMMENT '宠物品质',
  `faction_id` int(11) NOT NULL COMMENT '阵营ID',
  `family_name` text NOT NULL COMMENT '帮派',
  `vip_grade` int(11) NOT NULL COMMENT 'vip等级',
  PRIMARY KEY (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_jade
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_meet_fight`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_meet_fight`;
CREATE TABLE `t_ranking_meet_fight` (
  `rank` int(11) NOT NULL COMMENT '排名',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` text NOT NULL COMMENT '角色名',
  `role_level` int(11) NOT NULL COMMENT '等级',
  `family_name` text NOT NULL COMMENT '称号名',
  `faction_id` int(11) NOT NULL COMMENT '阵营id',
  `kill` int(11) NOT NULL COMMENT '杀人数',
  `killed` int(11) NOT NULL COMMENT '被杀次数',
  `date` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_meet_fight
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_monster_attack`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_monster_attack`;
CREATE TABLE `t_ranking_monster_attack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL COMMENT '时间',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` text NOT NULL COMMENT '角色名',
  `kill` int(11) NOT NULL COMMENT '战斗分数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_monster_attack
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_mounts_quality`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_mounts_quality`;
CREATE TABLE `t_ranking_mounts_quality` (
  `rank` int(11) NOT NULL COMMENT '排名',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` text NOT NULL COMMENT '角色名',
  `role_level` int(11) NOT NULL COMMENT '等级',
  `sex` int(11) NOT NULL COMMENT '性别',
  `mounts_name` text NOT NULL COMMENT '坐骑名',
  `fight_power` int(11) NOT NULL COMMENT '战斗力',
  `faction_id` int(11) NOT NULL COMMENT '阵营ID',
  `vip_grade` int(11) NOT NULL COMMENT 'vip等级',
  PRIMARY KEY (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_mounts_quality
-- ----------------------------

-- ----------------------------
-- Table structure for `t_ranking_villain`
-- ----------------------------
DROP TABLE IF EXISTS `t_ranking_villain`;
CREATE TABLE `t_ranking_villain` (
  `rank` int(11) NOT NULL COMMENT '排名',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  `role_name` varchar(255) NOT NULL COMMENT '角色名',
  `role_level` int(11) NOT NULL COMMENT '等级',
  `pk_point` int(11) NOT NULL COMMENT 'pk值',
  `kill_num` int(11) NOT NULL COMMENT '杀人数',
  `family_name` varchar(255) NOT NULL COMMENT '帮派',
  `vip_grade` varchar(255) NOT NULL COMMENT 'vip等级',
  PRIMARY KEY (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_ranking_villain
-- ----------------------------

-- ----------------------------
-- Table structure for `t_role_exchange`
-- ----------------------------
DROP TABLE IF EXISTS `t_role_exchange`;
CREATE TABLE `t_role_exchange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `silver` int(11) DEFAULT NULL,
  `gold` int(11) DEFAULT NULL,
  `goods` varchar(512) DEFAULT NULL,
  `goodsinfo` varchar(512) DEFAULT NULL,
  `other_role_id` int(11) NOT NULL,
  `other_role_name` varchar(50) NOT NULL,
  `other_silver` int(11) DEFAULT NULL,
  `other_gold` int(11) DEFAULT NULL,
  `other_goods` varchar(512) DEFAULT NULL,
  `other_goodsinfo` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX1` (`role_id`) USING BTREE,
  KEY `INDEX2` (`other_role_id`) USING BTREE,
  KEY `EXCHANGE_INDEX3` (`datetime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1080 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_role_exchange
-- ----------------------------

-- ----------------------------
-- Table structure for `t_stat_yb`
-- ----------------------------
DROP TABLE IF EXISTS `t_stat_yb`;
CREATE TABLE `t_stat_yb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mtime` int(11) NOT NULL DEFAULT '0',
  `used_gold` int(11) NOT NULL DEFAULT '0',
  `new_gold` int(11) NOT NULL DEFAULT '0',
  `mail_gold` int(11) NOT NULL DEFAULT '0',
  `remain_gold` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_stat_yb
-- ----------------------------

-- ----------------------------
-- Table structure for `t_stat_yb_item`
-- ----------------------------
DROP TABLE IF EXISTS `t_stat_yb_item`;
CREATE TABLE `t_stat_yb_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mtime` int(11) NOT NULL DEFAULT '20111111',
  `itemID` int(11) NOT NULL,
  `price` int(11) DEFAULT '0' COMMENT 'sell price',
  `buycount` int(11) DEFAULT '0',
  `usecount` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `itemID` (`itemID`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_stat_yb_item
-- ----------------------------

-- ----------------------------
-- Table structure for `t_sum_enhance`
-- ----------------------------
DROP TABLE IF EXISTS `t_sum_enhance`;
CREATE TABLE `t_sum_enhance` (
  `mtime` int(11) NOT NULL COMMENT 'format as 20120210',
  `do_type` int(11) NOT NULL COMMENT 'routine_id',
  `players` int(11) NOT NULL COMMENT 'player count',
  `do_times` int(11) NOT NULL COMMENT 'total do times',
  `succ_n` int(11) NOT NULL COMMENT 'success times',
  UNIQUE KEY `time_type` (`mtime`,`do_type`) USING BTREE,
  KEY `do_type` (`do_type`) USING BTREE,
  KEY `mtime` (`mtime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_sum_enhance
-- ----------------------------
