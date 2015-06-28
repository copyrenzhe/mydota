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
  KEY `FK_ability_upgrades_slots` (`slot_id`),
  CONSTRAINT `FK_ability_upgrades_slots` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`)
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
  KEY `FK_additional_units_slots` (`slot_id`),
  CONSTRAINT `FK_additional_units_slots` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`)
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
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES ('0', 'item_empty', '0', '0', '0', '0', 'Empty');
INSERT INTO `items` VALUES ('1', 'item_blink', '2150', '0', '1', '0', 'Blink Dagger');
INSERT INTO `items` VALUES ('2', 'item_blades_of_attack', '450', '0', '1', '0', 'Blades of Attack');
INSERT INTO `items` VALUES ('3', 'item_broadsword', '1200', '0', '0', '0', 'Broadsword');
INSERT INTO `items` VALUES ('4', 'item_chainmail', '550', '0', '1', '0', 'Chainmail');
INSERT INTO `items` VALUES ('5', 'item_claymore', '1400', '0', '0', '0', 'Claymore');
INSERT INTO `items` VALUES ('6', 'item_helm_of_iron_will', '950', '0', '1', '0', 'Helm of Iron Will');
INSERT INTO `items` VALUES ('7', 'item_javelin', '1500', '0', '0', '0', 'Javelin');
INSERT INTO `items` VALUES ('8', 'item_mithril_hammer', '1600', '0', '0', '0', 'Mithril Hammer');
INSERT INTO `items` VALUES ('9', 'item_platemail', '1400', '0', '0', '0', 'Platemail');
INSERT INTO `items` VALUES ('10', 'item_quarterstaff', '900', '0', '1', '0', 'Quarterstaff');
INSERT INTO `items` VALUES ('11', 'item_quelling_blade', '225', '0', '1', '0', 'Quelling Blade');
INSERT INTO `items` VALUES ('12', 'item_ring_of_protection', '175', '0', '0', '0', 'Ring of Protection');
INSERT INTO `items` VALUES ('13', 'item_gauntlets', '150', '0', '0', '0', 'Gauntlets of Strength');
INSERT INTO `items` VALUES ('14', 'item_slippers', '150', '0', '1', '0', 'Slippers of Agility');
INSERT INTO `items` VALUES ('15', 'item_mantle', '150', '0', '0', '0', 'Mantle of Intelligence');
INSERT INTO `items` VALUES ('16', 'item_branches', '50', '0', '0', '0', 'Iron Branch');
INSERT INTO `items` VALUES ('17', 'item_belt_of_strength', '450', '0', '1', '0', 'Belt of Strength');
INSERT INTO `items` VALUES ('18', 'item_boots_of_elves', '450', '0', '1', '0', 'Band of Elvenskin');
INSERT INTO `items` VALUES ('19', 'item_robe', '450', '0', '1', '0', 'Robe of the Magi');
INSERT INTO `items` VALUES ('20', 'item_circlet', '185', '0', '0', '0', 'Circlet');
INSERT INTO `items` VALUES ('21', 'item_ogre_axe', '1000', '0', '0', '0', 'Ogre Club');
INSERT INTO `items` VALUES ('22', 'item_blade_of_alacrity', '1000', '0', '0', '0', 'Blade of Alacrity');
INSERT INTO `items` VALUES ('23', 'item_staff_of_wizardry', '1000', '0', '0', '0', 'Staff of Wizardry');
INSERT INTO `items` VALUES ('24', 'item_ultimate_orb', '2100', '0', '1', '0', 'Ultimate Orb');
INSERT INTO `items` VALUES ('25', 'item_gloves', '500', '0', '1', '0', 'Gloves of Haste');
INSERT INTO `items` VALUES ('26', 'item_lifesteal', '900', '0', '1', '0', 'Morbid Mask');
INSERT INTO `items` VALUES ('27', 'item_ring_of_regen', '350', '0', '1', '0', 'Ring of Regen');
INSERT INTO `items` VALUES ('28', 'item_sobi_mask', '325', '0', '1', '0', 'Sage\'s Mask');
INSERT INTO `items` VALUES ('29', 'item_boots', '450', '0', '1', '0', 'Boots of Speed');
INSERT INTO `items` VALUES ('30', 'item_gem', '900', '0', '0', '0', 'Gem of True Sight');
INSERT INTO `items` VALUES ('31', 'item_cloak', '550', '0', '1', '0', 'Cloak');
INSERT INTO `items` VALUES ('32', 'item_talisman_of_evasion', '1800', '0', '1', '0', 'Talisman of Evasion');
INSERT INTO `items` VALUES ('33', 'item_cheese', '1000', '0', '0', '0', 'Cheese');
INSERT INTO `items` VALUES ('34', 'item_magic_stick', '200', '0', '1', '0', 'Magic Stick');
INSERT INTO `items` VALUES ('35', 'item_recipe_magic_wand', '150', '0', '0', '1', 'Recipe: Magic Wand');
INSERT INTO `items` VALUES ('36', 'item_magic_wand', '500', '0', '0', '0', 'Magic Wand');
INSERT INTO `items` VALUES ('37', 'item_ghost', '1600', '0', '0', '0', 'Ghost Scepter');
INSERT INTO `items` VALUES ('38', 'item_clarity', '50', '0', '0', '0', 'Clarity');
INSERT INTO `items` VALUES ('39', 'item_flask', '115', '0', '0', '0', 'Healing Salve');
INSERT INTO `items` VALUES ('40', 'item_dust', '180', '0', '0', '0', 'Dust of Appearance');
INSERT INTO `items` VALUES ('41', 'item_bottle', '650', '0', '0', '0', 'Bottle');
INSERT INTO `items` VALUES ('42', 'item_ward_observer', '150', '0', '0', '0', 'Observer Ward');
INSERT INTO `items` VALUES ('43', 'item_ward_sentry', '200', '0', '0', '0', 'Sentry Ward');
INSERT INTO `items` VALUES ('44', 'item_tango', '125', '0', '0', '0', 'Tango');
INSERT INTO `items` VALUES ('45', 'item_courier', '150', '0', '0', '0', 'Animal Courier');
INSERT INTO `items` VALUES ('46', 'item_tpscroll', '135', '0', '1', '0', 'Town Portal Scroll');
INSERT INTO `items` VALUES ('47', 'item_recipe_travel_boots', '2000', '0', '0', '1', 'Recipe: Boots of Travel');
INSERT INTO `items` VALUES ('48', 'item_travel_boots', '2450', '0', '0', '0', 'Boots of Travel');
INSERT INTO `items` VALUES ('49', 'item_recipe_phase_boots', '0', '0', '0', '1', 'Recipe: Phase Boots');
INSERT INTO `items` VALUES ('50', 'item_phase_boots', '1350', '0', '0', '0', 'Phase Boots');
INSERT INTO `items` VALUES ('51', 'item_demon_edge', '2400', '1', '0', '0', 'Demon Edge');
INSERT INTO `items` VALUES ('52', 'item_eagle', '3300', '1', '0', '0', 'Eaglesong');
INSERT INTO `items` VALUES ('53', 'item_reaver', '3200', '1', '0', '0', 'Reaver');
INSERT INTO `items` VALUES ('54', 'item_relic', '3800', '1', '0', '0', 'Sacred Relic');
INSERT INTO `items` VALUES ('55', 'item_hyperstone', '2000', '1', '0', '0', 'Hyperstone');
INSERT INTO `items` VALUES ('56', 'item_ring_of_health', '875', '1', '1', '0', 'Ring of Health');
INSERT INTO `items` VALUES ('57', 'item_void_stone', '875', '1', '0', '0', 'Void Stone');
INSERT INTO `items` VALUES ('58', 'item_mystic_staff', '2700', '1', '0', '0', 'Mystic Staff');
INSERT INTO `items` VALUES ('59', 'item_energy_booster', '1000', '1', '1', '0', 'Energy Booster');
INSERT INTO `items` VALUES ('60', 'item_point_booster', '1200', '1', '0', '0', 'Point Booster');
INSERT INTO `items` VALUES ('61', 'item_vitality_booster', '1100', '1', '0', '0', 'Vitality Booster');
INSERT INTO `items` VALUES ('62', 'item_recipe_power_treads', '0', '0', '0', '1', 'Recipe: Power Treads');
INSERT INTO `items` VALUES ('63', 'item_power_treads', '1400', '0', '0', '0', 'Power Treads');
INSERT INTO `items` VALUES ('64', 'item_recipe_hand_of_midas', '1550', '0', '0', '1', 'Recipe: Hand of Midas');
INSERT INTO `items` VALUES ('65', 'item_hand_of_midas', '2050', '0', '0', '0', 'Hand of Midas');
INSERT INTO `items` VALUES ('66', 'item_recipe_oblivion_staff', '0', '0', '0', '1', 'Recipe: Oblivion Staff');
INSERT INTO `items` VALUES ('67', 'item_oblivion_staff', '1675', '0', '0', '0', 'Oblivion Staff');
INSERT INTO `items` VALUES ('68', 'item_recipe_pers', '0', '0', '0', '1', 'Recipe: Perseverance');
INSERT INTO `items` VALUES ('69', 'item_pers', '1750', '0', '0', '0', 'Perseverance');
INSERT INTO `items` VALUES ('70', 'item_recipe_poor_mans_shield', '0', '0', '0', '1', 'Recipe: Poor Man\'s Shield');
INSERT INTO `items` VALUES ('71', 'item_poor_mans_shield', '550', '0', '0', '0', 'Poor Man\'s Shield');
INSERT INTO `items` VALUES ('72', 'item_recipe_bracer', '190', '0', '0', '1', 'Recipe: Bracer');
INSERT INTO `items` VALUES ('73', 'item_bracer', '525', '0', '0', '0', 'Bracer');
INSERT INTO `items` VALUES ('74', 'item_recipe_wraith_band', '150', '0', '0', '1', 'Recipe: Wraith Band');
INSERT INTO `items` VALUES ('75', 'item_wraith_band', '485', '0', '0', '0', 'Wraith Band');
INSERT INTO `items` VALUES ('76', 'item_recipe_null_talisman', '135', '0', '0', '1', 'Recipe: Null Talisman');
INSERT INTO `items` VALUES ('77', 'item_null_talisman', '470', '0', '0', '0', 'Null Talisman');
INSERT INTO `items` VALUES ('78', 'item_recipe_mekansm', '900', '0', '0', '1', 'Recipe: Mekansm');
INSERT INTO `items` VALUES ('79', 'item_mekansm', '2300', '0', '0', '0', 'Mekansm');
INSERT INTO `items` VALUES ('80', 'item_recipe_vladmir', '300', '0', '0', '1', 'Recipe: Vladmir\'s Offering');
INSERT INTO `items` VALUES ('81', 'item_vladmir', '2050', '0', '0', '0', 'Vladmir\'s Offering');
INSERT INTO `items` VALUES ('84', 'item_flying_courier', '220', '0', '0', '0', 'Flying Courier');
INSERT INTO `items` VALUES ('85', 'item_recipe_buckler', '200', '0', '0', '1', 'Recipe: Buckler');
INSERT INTO `items` VALUES ('86', 'item_buckler', '800', '0', '0', '0', 'Buckler');
INSERT INTO `items` VALUES ('87', 'item_recipe_ring_of_basilius', '0', '0', '0', '1', 'Recipe: Ring of Basilius');
INSERT INTO `items` VALUES ('88', 'item_ring_of_basilius', '500', '0', '0', '0', 'Ring of Basilius');
INSERT INTO `items` VALUES ('89', 'item_recipe_pipe', '900', '0', '0', '1', 'Recipe: Pipe of Insight');
INSERT INTO `items` VALUES ('90', 'item_pipe', '3625', '0', '0', '0', 'Pipe of Insight');
INSERT INTO `items` VALUES ('91', 'item_recipe_urn_of_shadows', '250', '0', '0', '1', 'Recipe: Urn of Shadows');
INSERT INTO `items` VALUES ('92', 'item_urn_of_shadows', '875', '0', '0', '0', 'Urn of Shadows');
INSERT INTO `items` VALUES ('93', 'item_recipe_headdress', '200', '0', '0', '1', 'Recipe: Headdress');
INSERT INTO `items` VALUES ('94', 'item_headdress', '600', '0', '0', '0', 'Headdress');
INSERT INTO `items` VALUES ('95', 'item_recipe_sheepstick', '0', '0', '0', '1', 'Recipe: Scythe of Vyse');
INSERT INTO `items` VALUES ('96', 'item_sheepstick', '5675', '0', '0', '0', 'Scythe of Vyse');
INSERT INTO `items` VALUES ('97', 'item_recipe_orchid', '775', '0', '0', '1', 'Recipe: Orchid Malevolence');
INSERT INTO `items` VALUES ('98', 'item_orchid', '5025', '0', '0', '0', 'Orchid Malevolence');
INSERT INTO `items` VALUES ('99', 'item_recipe_cyclone', '500', '0', '0', '1', 'Recipe: Eul\'s Scepter of Divinity');
INSERT INTO `items` VALUES ('100', 'item_cyclone', '2700', '0', '0', '0', 'Eul\'s Scepter of Divinity');
INSERT INTO `items` VALUES ('101', 'item_recipe_force_staff', '900', '0', '0', '1', 'Recipe: Force Staff');
INSERT INTO `items` VALUES ('102', 'item_force_staff', '2250', '0', '0', '0', 'Force Staff');
INSERT INTO `items` VALUES ('103', 'item_recipe_dagon', '1250', '0', '0', '1', 'Recipe: Dagon');
INSERT INTO `items` VALUES ('104', 'item_dagon', '2800', '0', '0', '0', 'Dagon');
INSERT INTO `items` VALUES ('105', 'item_recipe_necronomicon', '1250', '0', '0', '1', 'Recipe: Necronomicon');
INSERT INTO `items` VALUES ('106', 'item_necronomicon', '2700', '0', '0', '0', 'Necronomicon');
INSERT INTO `items` VALUES ('107', 'item_recipe_ultimate_scepter', '0', '0', '0', '1', 'Recipe: Aghanim\'s Scepter');
INSERT INTO `items` VALUES ('108', 'item_ultimate_scepter', '4200', '0', '0', '0', 'Aghanim\'s Scepter');
INSERT INTO `items` VALUES ('109', 'item_recipe_refresher', '1800', '0', '0', '1', 'Recipe: Refresher Orb');
INSERT INTO `items` VALUES ('110', 'item_refresher', '5225', '0', '0', '0', 'Refresher Orb');
INSERT INTO `items` VALUES ('111', 'item_recipe_assault', '1300', '0', '0', '1', 'Recipe: Assault Cuirass');
INSERT INTO `items` VALUES ('112', 'item_assault', '5250', '0', '0', '0', 'Assault Cuirass');
INSERT INTO `items` VALUES ('113', 'item_recipe_heart', '1200', '0', '0', '1', 'Recipe: Heart of Tarrasque');
INSERT INTO `items` VALUES ('114', 'item_heart', '5500', '0', '0', '0', 'Heart of Tarrasque');
INSERT INTO `items` VALUES ('115', 'item_recipe_black_king_bar', '1375', '0', '0', '1', 'Recipe: Black King Bar');
INSERT INTO `items` VALUES ('116', 'item_black_king_bar', '3975', '0', '0', '0', 'Black King Bar');
INSERT INTO `items` VALUES ('117', 'item_aegis', '0', '0', '0', '0', 'Aegis of the Immortal');
INSERT INTO `items` VALUES ('118', 'item_recipe_shivas_guard', '600', '0', '0', '1', 'Recipe: Shiva\'s Guard');
INSERT INTO `items` VALUES ('119', 'item_shivas_guard', '4700', '0', '0', '0', 'Shiva\'s Guard');
INSERT INTO `items` VALUES ('120', 'item_recipe_bloodstone', '0', '0', '0', '1', 'Recipe: Bloodstone');
INSERT INTO `items` VALUES ('121', 'item_bloodstone', '5050', '0', '0', '0', 'Bloodstone');
INSERT INTO `items` VALUES ('122', 'item_recipe_sphere', '1325', '0', '0', '1', 'Recipe: Linken\'s Sphere');
INSERT INTO `items` VALUES ('123', 'item_sphere', '5175', '0', '0', '0', 'Linken\'s Sphere');
INSERT INTO `items` VALUES ('124', 'item_recipe_vanguard', '0', '0', '0', '1', 'Recipe: Vanguard');
INSERT INTO `items` VALUES ('125', 'item_vanguard', '2225', '0', '0', '0', 'Vanguard');
INSERT INTO `items` VALUES ('126', 'item_recipe_blade_mail', '0', '0', '0', '1', 'Recipe: Blade Mail');
INSERT INTO `items` VALUES ('127', 'item_blade_mail', '2200', '0', '0', '0', 'Blade Mail');
INSERT INTO `items` VALUES ('128', 'item_recipe_soul_booster', '0', '0', '0', '1', 'Recipe: Soul Booster');
INSERT INTO `items` VALUES ('129', 'item_soul_booster', '3300', '0', '0', '0', 'Soul Booster');
INSERT INTO `items` VALUES ('130', 'item_recipe_hood_of_defiance', '0', '0', '0', '1', 'Recipe: Hood of Defiance');
INSERT INTO `items` VALUES ('131', 'item_hood_of_defiance', '2125', '0', '0', '0', 'Hood of Defiance');
INSERT INTO `items` VALUES ('132', 'item_recipe_rapier', '0', '0', '0', '1', 'Recipe: Divine Rapier');
INSERT INTO `items` VALUES ('133', 'item_rapier', '6200', '0', '0', '0', 'Divine Rapier');
INSERT INTO `items` VALUES ('134', 'item_recipe_monkey_king_bar', '0', '0', '0', '1', 'Recipe: Monkey King Bar');
INSERT INTO `items` VALUES ('135', 'item_monkey_king_bar', '5400', '0', '0', '0', 'Monkey King Bar');
INSERT INTO `items` VALUES ('136', 'item_recipe_radiance', '1350', '0', '0', '1', 'Recipe: Radiance');
INSERT INTO `items` VALUES ('137', 'item_radiance', '5150', '0', '0', '0', 'Radiance');
INSERT INTO `items` VALUES ('138', 'item_recipe_butterfly', '0', '0', '0', '1', 'Recipe: Butterfly');
INSERT INTO `items` VALUES ('139', 'item_butterfly', '6000', '0', '0', '0', 'Butterfly');
INSERT INTO `items` VALUES ('140', 'item_recipe_greater_crit', '1000', '0', '0', '1', 'Recipe: Daedalus');
INSERT INTO `items` VALUES ('141', 'item_greater_crit', '5550', '0', '0', '0', 'Daedalus');
INSERT INTO `items` VALUES ('142', 'item_recipe_basher', '1000', '0', '0', '1', 'Recipe: Skull Basher');
INSERT INTO `items` VALUES ('143', 'item_basher', '2950', '0', '0', '0', 'Skull Basher');
INSERT INTO `items` VALUES ('144', 'item_recipe_bfury', '0', '0', '0', '1', 'Recipe: Battle Fury');
INSERT INTO `items` VALUES ('145', 'item_bfury', '4350', '0', '0', '0', 'Battle Fury');
INSERT INTO `items` VALUES ('146', 'item_recipe_manta', '900', '0', '0', '1', 'Recipe: Manta Style');
INSERT INTO `items` VALUES ('147', 'item_manta', '5050', '0', '0', '0', 'Manta Style');
INSERT INTO `items` VALUES ('148', 'item_recipe_lesser_crit', '500', '0', '0', '1', 'Recipe: Crystalys');
INSERT INTO `items` VALUES ('149', 'item_lesser_crit', '2150', '0', '0', '0', 'Crystalys');
INSERT INTO `items` VALUES ('150', 'item_recipe_armlet', '700', '0', '0', '1', 'Recipe: Armlet of Mordiggian');
INSERT INTO `items` VALUES ('151', 'item_armlet', '2600', '0', '0', '0', 'Armlet of Mordiggian');
INSERT INTO `items` VALUES ('152', 'item_invis_sword', '3000', '0', '0', '0', 'Shadow Blade');
INSERT INTO `items` VALUES ('153', 'item_recipe_sange_and_yasha', '0', '0', '0', '1', 'Recipe: Sange and Yasha');
INSERT INTO `items` VALUES ('154', 'item_sange_and_yasha', '4100', '0', '0', '0', 'Sange and Yasha');
INSERT INTO `items` VALUES ('155', 'item_recipe_satanic', '1100', '0', '0', '1', 'Recipe: Satanic');
INSERT INTO `items` VALUES ('156', 'item_satanic', '6150', '0', '0', '0', 'Satanic');
INSERT INTO `items` VALUES ('157', 'item_recipe_mjollnir', '900', '0', '0', '1', 'Recipe: Mjollnir');
INSERT INTO `items` VALUES ('158', 'item_mjollnir', '5600', '0', '0', '0', 'Mjollnir');
INSERT INTO `items` VALUES ('159', 'item_recipe_skadi', '0', '0', '0', '1', 'Recipe: Eye of Skadi');
INSERT INTO `items` VALUES ('160', 'item_skadi', '5675', '0', '0', '0', 'Eye of Skadi');
INSERT INTO `items` VALUES ('161', 'item_recipe_sange', '600', '0', '0', '1', 'Recipe: Sange');
INSERT INTO `items` VALUES ('162', 'item_sange', '2050', '0', '0', '0', 'Sange');
INSERT INTO `items` VALUES ('163', 'item_recipe_helm_of_the_dominator', '0', '0', '0', '1', 'Recipe: Helm of the Dominator');
INSERT INTO `items` VALUES ('164', 'item_helm_of_the_dominator', '1850', '0', '0', '0', 'Helm of the Dominator');
INSERT INTO `items` VALUES ('165', 'item_recipe_maelstrom', '600', '0', '0', '1', 'Recipe: Maelstrom');
INSERT INTO `items` VALUES ('166', 'item_maelstrom', '2700', '0', '0', '0', 'Maelstrom');
INSERT INTO `items` VALUES ('167', 'item_recipe_desolator', '900', '0', '0', '1', 'Recipe: Desolator');
INSERT INTO `items` VALUES ('168', 'item_desolator', '4100', '0', '0', '0', 'Desolator');
INSERT INTO `items` VALUES ('169', 'item_recipe_yasha', '600', '0', '0', '1', 'Recipe: Yasha');
INSERT INTO `items` VALUES ('170', 'item_yasha', '2050', '0', '0', '0', 'Yasha');
INSERT INTO `items` VALUES ('171', 'item_recipe_mask_of_madness', '1000', '0', '0', '1', 'Recipe: Mask of Madness');
INSERT INTO `items` VALUES ('172', 'item_mask_of_madness', '1900', '0', '0', '0', 'Mask of Madness');
INSERT INTO `items` VALUES ('173', 'item_recipe_diffusal_blade', '850', '0', '0', '1', 'Recipe: Diffusal Blade');
INSERT INTO `items` VALUES ('174', 'item_diffusal_blade', '3300', '0', '0', '0', 'Diffusal Blade');
INSERT INTO `items` VALUES ('175', 'item_recipe_ethereal_blade', '0', '0', '0', '1', 'Recipe: Ethereal Blade');
INSERT INTO `items` VALUES ('176', 'item_ethereal_blade', '4900', '0', '0', '0', 'Ethereal Blade');
INSERT INTO `items` VALUES ('177', 'item_recipe_soul_ring', '125', '0', '0', '1', 'Recipe: Soul Ring');
INSERT INTO `items` VALUES ('178', 'item_soul_ring', '800', '0', '0', '0', 'Soul Ring');
INSERT INTO `items` VALUES ('179', 'item_recipe_arcane_boots', '0', '0', '0', '1', 'Recipe: Arcane Boots');
INSERT INTO `items` VALUES ('180', 'item_arcane_boots', '1450', '0', '0', '0', 'Arcane Boots');
INSERT INTO `items` VALUES ('181', 'item_orb_of_venom', '275', '1', '1', '0', 'Orb of Venom');
INSERT INTO `items` VALUES ('182', 'item_stout_shield', '250', '0', '1', '0', 'Stout Shield');
INSERT INTO `items` VALUES ('183', 'item_recipe_invis_sword', '0', '0', '0', '1', 'Recipe: Shadow Blade');
INSERT INTO `items` VALUES ('184', 'item_recipe_ancient_janggo', '875', '0', '0', '1', 'Recipe: Drum of Endurance');
INSERT INTO `items` VALUES ('185', 'item_ancient_janggo', '1875', '0', '0', '0', 'Drum of Endurance');
INSERT INTO `items` VALUES ('186', 'item_recipe_medallion_of_courage', '200', '0', '0', '1', 'Recipe: Medallion of Courage');
INSERT INTO `items` VALUES ('187', 'item_medallion_of_courage', '1075', '0', '0', '0', 'Medallion of Courage');
INSERT INTO `items` VALUES ('188', 'item_smoke_of_deceit', '100', '0', '0', '0', 'Smoke of Deceit');
INSERT INTO `items` VALUES ('189', 'item_recipe_veil_of_discord', '1250', '0', '0', '1', 'Recipe: Veil of Discord');
INSERT INTO `items` VALUES ('190', 'item_veil_of_discord', '2675', '0', '0', '0', 'Veil of Discord');
INSERT INTO `items` VALUES ('191', 'item_recipe_necronomicon_2', '0', '0', '0', '1', 'Recipe: Necronomicon');
INSERT INTO `items` VALUES ('192', 'item_recipe_necronomicon_3', '0', '0', '0', '1', 'Recipe: Necronomicon');
INSERT INTO `items` VALUES ('193', 'item_necronomicon_2', '2700', '0', '0', '0', 'Necronomicon');
INSERT INTO `items` VALUES ('194', 'item_necronomicon_3', '2700', '0', '0', '0', 'Necronomicon');
INSERT INTO `items` VALUES ('195', 'item_recipe_diffusal_blade_2', '0', '0', '0', '1', 'Recipe: Diffusal Blade');
INSERT INTO `items` VALUES ('196', 'item_diffusal_blade_2', '3300', '0', '0', '0', 'Diffusal Blade');
INSERT INTO `items` VALUES ('197', 'item_recipe_dagon_2', '0', '0', '0', '1', 'Recipe: Dagon');
INSERT INTO `items` VALUES ('198', 'item_recipe_dagon_3', '0', '0', '0', '1', 'Recipe: Dagon');
INSERT INTO `items` VALUES ('199', 'item_recipe_dagon_4', '0', '0', '0', '1', 'Recipe: Dagon');
INSERT INTO `items` VALUES ('200', 'item_recipe_dagon_5', '0', '0', '0', '1', 'Recipe: Dagon');
INSERT INTO `items` VALUES ('201', 'item_dagon_2', '2850', '0', '0', '0', 'Dagon');
INSERT INTO `items` VALUES ('202', 'item_dagon_3', '2850', '0', '0', '0', 'Dagon');
INSERT INTO `items` VALUES ('203', 'item_dagon_4', '2850', '0', '0', '0', 'Dagon');
INSERT INTO `items` VALUES ('204', 'item_dagon_5', '2850', '0', '0', '0', 'Dagon');
INSERT INTO `items` VALUES ('205', 'item_recipe_rod_of_atos', '0', '0', '0', '1', 'Recipe: Rod of Atos');
INSERT INTO `items` VALUES ('206', 'item_rod_of_atos', '3100', '0', '0', '0', 'Rod of Atos');
INSERT INTO `items` VALUES ('207', 'item_recipe_abyssal_blade', '0', '0', '0', '1', 'Recipe: Abyssal Blade');
INSERT INTO `items` VALUES ('208', 'item_abyssal_blade', '6750', '0', '0', '0', 'Abyssal Blade');
INSERT INTO `items` VALUES ('209', 'item_recipe_heavens_halberd', '0', '0', '0', '1', 'Recipe: Heaven\'s Halberd');
INSERT INTO `items` VALUES ('210', 'item_heavens_halberd', '3850', '0', '0', '0', 'Heaven\'s Halberd');
INSERT INTO `items` VALUES ('211', 'item_recipe_ring_of_aquila', '0', '0', '0', '1', 'Recipe: Ring of Aquila');
INSERT INTO `items` VALUES ('212', 'item_ring_of_aquila', '985', '0', '0', '0', 'Ring of Aquila');
INSERT INTO `items` VALUES ('213', 'item_recipe_tranquil_boots', '0', '0', '0', '1', 'Recipe: Tranquil Boots');
INSERT INTO `items` VALUES ('214', 'item_tranquil_boots', '975', '0', '0', '0', 'Tranquil Boots');
INSERT INTO `items` VALUES ('215', 'item_shadow_amulet', '1600', '0', '0', '0', 'Shadow Amulet');
INSERT INTO `items` VALUES ('216', 'item_halloween_candy_corn', '0', '0', '0', '0', 'Greevil Taffy');
INSERT INTO `items` VALUES ('217', 'item_mystery_hook', '0', '0', '0', '0', 'DOTA_Tooltip_Ability_item_mystery_hook');
INSERT INTO `items` VALUES ('218', 'item_mystery_arrow', '0', '0', '0', '0', 'DOTA_Tooltip_Ability_item_mystery_arrow');
INSERT INTO `items` VALUES ('219', 'item_mystery_missile', '0', '0', '0', '0', 'DOTA_Tooltip_Ability_item_mystery_missile');
INSERT INTO `items` VALUES ('220', 'item_mystery_toss', '0', '0', '0', '0', 'DOTA_Tooltip_Ability_item_mystery_toss');
INSERT INTO `items` VALUES ('221', 'item_mystery_vacuum', '0', '0', '0', '0', 'DOTA_Tooltip_Ability_item_mystery_vacuum');
INSERT INTO `items` VALUES ('226', 'item_halloween_rapier', '6200', '0', '0', '0', 'DOTA_Tooltip_Ability_item_halloween_rapier');
INSERT INTO `items` VALUES ('227', 'item_present', '0', '0', '0', '0', 'A Gift!');
INSERT INTO `items` VALUES ('228', 'item_greevil_whistle', '0', '0', '0', '0', 'Greevil Whistle');
INSERT INTO `items` VALUES ('229', 'item_winter_stocking', '0', '0', '0', '0', 'Xmas Stocking');
INSERT INTO `items` VALUES ('230', 'item_winter_skates', '0', '0', '0', '0', 'Speed Skates');
INSERT INTO `items` VALUES ('231', 'item_winter_cake', '0', '0', '0', '0', 'Fruit-bit Cake');
INSERT INTO `items` VALUES ('232', 'item_winter_cookie', '0', '0', '0', '0', 'Wizard Cookie');
INSERT INTO `items` VALUES ('233', 'item_winter_coco', '0', '0', '0', '0', 'Cocoa with Marshmallows');
INSERT INTO `items` VALUES ('234', 'item_winter_ham', '0', '0', '0', '0', 'Clove Studded Ham');
INSERT INTO `items` VALUES ('235', 'item_greevil_whistle_toggle', '0', '0', '0', '0', 'Greevil Whistle');
INSERT INTO `items` VALUES ('236', 'item_winter_kringle', '0', '0', '0', '0', 'Kringle');
INSERT INTO `items` VALUES ('237', 'item_winter_mushroom', '0', '0', '0', '0', 'Snow Mushroom');
INSERT INTO `items` VALUES ('238', 'item_winter_greevil_treat', '0', '0', '0', '0', 'Greevil Treat');
INSERT INTO `items` VALUES ('239', 'item_winter_greevil_garbage', '0', '0', '0', '0', 'Greevil Chow');
INSERT INTO `items` VALUES ('240', 'item_winter_greevil_chewy', '0', '0', '0', '0', 'Greevil Blink Bone');
INSERT INTO `items` VALUES ('241', 'item_tango_single', '30', '0', '0', '0', 'Tango (Shared)');
INSERT INTO `items` VALUES ('242', 'item_crimson_guard', '3850', '0', '0', '0', 'Crimson Guard');

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
  CONSTRAINT `FK_league_prize_pools_leagues` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`leagueid`)
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
  KEY `FK_matches_leagues` (`leagueid`),
  CONSTRAINT `FK_matches_leagues` FOREIGN KEY (`leagueid`) REFERENCES `leagues` (`leagueid`)
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
  KEY `FK_picks_bans_matches` (`match_id`),
  CONSTRAINT `FK_picks_bans_matches` FOREIGN KEY (`match_id`) REFERENCES `matches` (`match_id`)
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
  KEY `FK_slots_users` (`account_id`),
  KEY `FK_slots_matches` (`match_id`),
  KEY `FK_slots_items` (`item_0`),
  KEY `FK_slots_items_2` (`item_1`),
  KEY `FK_slots_items_3` (`item_2`),
  KEY `FK_slots_items_4` (`item_3`),
  KEY `FK_slots_items_5` (`item_4`),
  KEY `FK_slots_items_6` (`item_5`),
  CONSTRAINT `FK_slots_items` FOREIGN KEY (`item_0`) REFERENCES `items` (`id`),
  CONSTRAINT `FK_slots_items_2` FOREIGN KEY (`item_1`) REFERENCES `items` (`id`),
  CONSTRAINT `FK_slots_items_3` FOREIGN KEY (`item_2`) REFERENCES `items` (`id`),
  CONSTRAINT `FK_slots_items_4` FOREIGN KEY (`item_3`) REFERENCES `items` (`id`),
  CONSTRAINT `FK_slots_items_5` FOREIGN KEY (`item_4`) REFERENCES `items` (`id`),
  CONSTRAINT `FK_slots_items_6` FOREIGN KEY (`item_5`) REFERENCES `items` (`id`),
  CONSTRAINT `FK_slots_matches` FOREIGN KEY (`match_id`) REFERENCES `matches` (`match_id`),
  CONSTRAINT `FK_slots_users` FOREIGN KEY (`account_id`) REFERENCES `users` (`account_id`)
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
