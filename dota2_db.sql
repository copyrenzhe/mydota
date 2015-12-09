/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : dota2_db

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2015-04-09 23:35:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ability_upgrades
-- ----------------------------
DROP TABLE IF EXISTS `ability_upgrades`;
CREATE TABLE `ability_upgrades` (
  `slot_id` mediumint(10) unsigned NOT NULL,
  `ability` smallint(8) unsigned NOT NULL COMMENT '升级的技能ID',
  `time` smallint(10) unsigned NOT NULL COMMENT '升级的时间',
  `level` tinyint(4) unsigned NOT NULL COMMENT '升级的级数',
  PRIMARY KEY (`slot_id`,`level`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ability_upgrades
-- ----------------------------

-- ----------------------------
-- Table structure for additional_units
-- ----------------------------
DROP TABLE IF EXISTS `additional_units`;
CREATE TABLE `additional_units` (
  `slot_id` mediumint(10) unsigned NOT NULL,
  `unitname` varchar(100) NOT NULL,
  `item_0` smallint(10) unsigned NOT NULL,
  `item_1` smallint(10) unsigned NOT NULL,
  `item_2` smallint(10) unsigned NOT NULL,
  `item_3` smallint(10) unsigned NOT NULL,
  `item_4` smallint(10) unsigned NOT NULL,
  `item_5` smallint(10) unsigned NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of additional_units
-- ----------------------------

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost` smallint(5) unsigned NOT NULL,
  `secret_shop` tinyint(3) unsigned NOT NULL,
  `side_shop` tinyint(3) unsigned NOT NULL,
  `recipe` tinyint(3) unsigned NOT NULL,
  `localized_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for leagues
-- ----------------------------
DROP TABLE IF EXISTS `leagues`;
CREATE TABLE `leagues` (
  `leagueid` mediumint(4) unsigned NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `description` varchar(2000) NOT NULL DEFAULT '',
  `tournament_url` varchar(200) DEFAULT '',
  `itemdef` int(11) DEFAULT NULL,
  `is_finished` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`leagueid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of leagues
-- ----------------------------

-- ----------------------------
-- Table structure for league_prize_pools
-- ----------------------------
DROP TABLE IF EXISTS `league_prize_pools`;
CREATE TABLE `league_prize_pools` (
  `league_id` mediumint(8) unsigned NOT NULL,
  `prize_pool` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`league_id`,`date`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of league_prize_pools
-- ----------------------------

-- ----------------------------
-- Table structure for matches
-- ----------------------------
DROP TABLE IF EXISTS `matches`;
CREATE TABLE `matches` (
  `match_id` int(20) unsigned NOT NULL,
  `season` tinyint(4) unsigned DEFAULT NULL,
  `radiant_win` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0.天灾(dire) 1.近卫(radiant)',
  `duration` smallint(11) unsigned NOT NULL DEFAULT '0' COMMENT '游戏持续时间，按秒计',
  `first_blood_time` smallint(11) unsigned NOT NULL DEFAULT '0' COMMENT '第一滴血时间，按秒计',
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '游戏开始时间',
  `match_seq_num` bigint(20) unsigned DEFAULT NULL COMMENT '比赛录像ID（待定）',
  `game_mode` tinyint(4) NOT NULL COMMENT '0 - None\r\n1 - All Pick\r\n2 - Captain''s Mode\r\n3 - Random Draft\r\n4 - Single Draft\r\n5 - All Random\r\n6 - Intro\r\n7 - Diretide\r\n8 - Reverse Captain''s Mode\r\n9 - The Greeviling\r\n10 - Tutorial\r\n11 - Mid Only\r\n12 - Least Played\r\n13 - New Player Pool\r\n14 - Compendium Matchmaking\r\n16 - Captains Draft',
  `tower_status_radiant` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '近卫方塔的状态，需转换成2进制，取后11位，分别是：上方守护塔，下方守护塔，下路高地塔，下路2塔，下路1塔，中路高地塔，中路2塔，中路1塔，上路高地塔，上路2塔，上路1塔\r\n存在则为1，否则为0',
  `tower_status_dire` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '天灾方塔的状态，需转换成2进制',
  `barracks_status_radiant` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '近卫兵营状态，转换成2进制，取后6位，分别是：下路远程兵营，下路近战兵营，中路远程兵营，中路近战兵营，上路远程兵营，上路近战兵营。\r\n存在则为1，否则为0',
  `barracks_status_dire` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '天灾兵营状态',
  `replay_salt` tinyint(4) DEFAULT NULL,
  `lobby_type` tinyint(6) unsigned NOT NULL DEFAULT '0' COMMENT '-1 - Invalid\r\n0 - Public matchmaking\r\n1 - Practise\r\n2 - Tournament\r\n3 - Tutorial\r\n4 - Co-op with bots.\r\n5 - Team match\r\n6 - Solo Queue\r\n7 - 天梯匹配',
  `human_players` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '玩家人数',
  `leagueid` mediumint(4) unsigned NOT NULL DEFAULT '0' COMMENT '比赛所属赛事ID',
  `cluster` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '比赛使用服务器群（地区）：223为中国',
  `positive_votes` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支持票数',
  `negative_votes` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '反对票数',
  `radiant_team_id` int(11) unsigned DEFAULT NULL COMMENT '近卫战队ID',
  `radiant_name` varchar(200) DEFAULT NULL COMMENT '近卫战队名称',
  `radiant_logo` varchar(32) DEFAULT NULL COMMENT '近卫战队logo',
  `radiant_team_complete` tinyint(3) unsigned DEFAULT NULL,
  `dire_team_id` int(11) unsigned DEFAULT NULL,
  `dire_name` varchar(200) DEFAULT NULL,
  `dire_logo` varchar(32) DEFAULT NULL,
  `dire_team_complete` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`match_id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of matches
-- ----------------------------

-- ----------------------------
-- Table structure for picks_bans
-- ----------------------------
DROP TABLE IF EXISTS `picks_bans`;
CREATE TABLE `picks_bans` (
  `id` mediumint(20) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` int(20) unsigned NOT NULL,
  `is_pick` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hero_id` tinyint(10) unsigned NOT NULL DEFAULT '0',
  `team` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of picks_bans
-- ----------------------------

-- ----------------------------
-- Table structure for slots
-- ----------------------------
DROP TABLE IF EXISTS `slots`;
CREATE TABLE `slots` (
  `id` mediumint(10) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` int(20) unsigned NOT NULL DEFAULT '0',
  `account_id` int(20) unsigned NOT NULL DEFAULT '0',
  `hero_id` tinyint(10) unsigned NOT NULL DEFAULT '0',
  `player_slot` tinyint(10) unsigned NOT NULL DEFAULT '0' COMMENT '玩家位置：0-4为近卫1-5楼；128-132为天灾1-5楼',
  `item_0` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '装备左上',
  `item_1` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '装备中上',
  `item_2` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '装备右上',
  `item_3` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '装备左下',
  `item_4` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '装备中下',
  `item_5` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '装备右下',
  `kills` tinyint(10) unsigned NOT NULL DEFAULT '0',
  `deaths` tinyint(10) unsigned NOT NULL DEFAULT '0',
  `assists` tinyint(10) unsigned NOT NULL DEFAULT '0',
  `leaver_status` tinyint(10) NOT NULL DEFAULT '0',
  `gold` mediumint(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时金钱数',
  `last_hits` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '正补',
  `denies` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '反补',
  `gold_per_min` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '每分钟金钱数',
  `xp_per_min` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '每分钟经验',
  `gold_spent` mediumint(10) unsigned NOT NULL DEFAULT '0' COMMENT '花费金钱',
  `hero_damage` mediumint(10) unsigned NOT NULL DEFAULT '0' COMMENT '英雄伤害',
  `tower_damage` mediumint(10) unsigned NOT NULL DEFAULT '0' COMMENT '对塔的伤害',
  `hero_healing` mediumint(10) unsigned NOT NULL DEFAULT '0' COMMENT '英雄治疗',
  `level` tinyint(10) unsigned NOT NULL DEFAULT '0' COMMENT '等级',
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of slots
-- ----------------------------

-- ----------------------------
-- Table structure for teams
-- ----------------------------
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teams
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `account_id` int(20) unsigned NOT NULL DEFAULT '0',
  `personaname` varchar(50) NOT NULL DEFAULT '',
  `steamid` varchar(64) NOT NULL DEFAULT '',
  `avatar` varchar(200) NOT NULL,
  `profileurl` varchar(128) NOT NULL,
  `is_personaname_real` tinyint(1) NOT NULL DEFAULT '0',
  `is_subscribe` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('4294967295', 'Anonymous', '', '', '', '0');
