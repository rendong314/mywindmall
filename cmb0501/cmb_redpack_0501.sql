/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : runnengwx

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2017-04-27 15:38:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cmb_redpack_0501`
-- ----------------------------
DROP TABLE IF EXISTS `cmb_redpack_0501`;
CREATE TABLE `cmb_redpack_0501` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pay_openid` char(28) DEFAULT NULL,
  `msg_openid` char(28) DEFAULT NULL,
  `redpack` int(8) NOT NULL DEFAULT '0',
  `red_time` int(11) DEFAULT NULL,
  `red_status` tinyint(1) NOT NULL DEFAULT '0',
  `red_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1',
  `msg_status` tinyint(1) NOT NULL DEFAULT '0',
  `msg_time` int(11) DEFAULT NULL,
  `gid` int(8) NOT NULL DEFAULT '0' COMMENT 'secret',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

