/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : xx

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2019-09-27 17:56:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for xx_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `xx_admin_role`;
CREATE TABLE `xx_admin_role` (
  `admin_role_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户角色id',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `rid` varchar(20) NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`admin_role_id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `rid` (`rid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xx_admin_role
-- ----------------------------

-- ----------------------------
-- Table structure for xx_channel
-- ----------------------------
DROP TABLE IF EXISTS `xx_channel`;
CREATE TABLE `xx_channel` (
  `channel_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '渠道id',
  `channel_company` varchar(20) NOT NULL DEFAULT '0' COMMENT '公司名',
  `channel_login` varchar(30) NOT NULL DEFAULT '0' COMMENT '登陆账号',
  `channel_vx` varchar(20) NOT NULL DEFAULT '0' COMMENT '微信号',
  `channel_qq` varchar(20) NOT NULL DEFAULT '0' COMMENT 'qq号',
  `channel_sex` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `channel_user_name` varchar(10) NOT NULL DEFAULT '0' COMMENT '姓名',
  `channerl_name` varchar(15) NOT NULL DEFAULT '0' COMMENT '渠道名',
  `channel_mima` varchar(50) NOT NULL DEFAULT '0' COMMENT 'Mima',
  `channel_pwd` char(32) NOT NULL DEFAULT '0' COMMENT '密码',
  `channel_phone` varchar(11) NOT NULL DEFAULT '0' COMMENT '手机号',
  `nid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '权限id',
  `is_lock` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '是否锁定',
  `uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加用户id',
  `jur_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '权限用户id',
  `add_time` varchar(20) NOT NULL DEFAULT '0',
  `user_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '操作时间',
  `lock_com` varchar(150) NOT NULL DEFAULT '0' COMMENT '锁定原因',
  `audit` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '审核',
  `inside` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1' COMMENT '内外部权限',
  `channel_pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `is_del` enum('0','1') NOT NULL DEFAULT '0' COMMENT '未删除',
  `level` tinyint(10) unsigned NOT NULL DEFAULT '1' COMMENT '用户等级',
  PRIMARY KEY (`channel_id`),
  UNIQUE KEY `channel_phone` (`channel_phone`) USING BTREE,
  KEY `channel_login` (`channel_login`) USING BTREE,
  KEY `channel_vx` (`channel_vx`) USING BTREE,
  KEY `channel_qq` (`channel_qq`) USING BTREE,
  KEY `channel_user_name` (`channel_user_name`) USING BTREE,
  KEY `channerl_name` (`channerl_name`) USING BTREE,
  KEY `is_lock` (`is_lock`) USING BTREE,
  KEY `jur_id` (`jur_id`) USING BTREE,
  KEY `user_time` (`user_time`) USING BTREE,
  KEY `audit` (`audit`) USING BTREE,
  KEY `channel_pid` (`channel_pid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xx_channel
-- ----------------------------
INSERT INTO `xx_channel` VALUES ('2', '黄超', 'fdgdfg', 'dfgdfg', 'gdfgfg', '0', '黄超超c', '画虎', '123456', '15da5b87fbda7ab1a95e471a1247abce', '1779641538', '0', '1', '0', '1', '0', '2019-09-26 16:33:35', '0', '1', '1', '0', '0', '1');
INSERT INTO `xx_channel` VALUES ('3', '呼呼', 'asdas', 'asdasd', 'asdasd', '1', '萨达', '啊是大', '123456', '15da5b87fbda7ab1a95e471a1247abce', '177964153', '0', '1', '0', '1', '0', '2019-09-26 16:15:54', '0', '1', '1', '0', '0', '1');
INSERT INTO `xx_channel` VALUES ('4', '呼呼', 'asdas', 'asdasd', 'asdasd', '0', '啊是大', 'aa', '123456', '15da5b87fbda7ab1a95e471a1247abce', '111', '0', '1', '0', '1', '2019:09:26 10:08:52', '2019-09-26 14:02:56', '0', '1', '1', '0', '0', '1');
INSERT INTO `xx_channel` VALUES ('5', '大夫士大夫', 's\'士大夫', 'fsd f', 'sdfsdf', '1', '大师傅似的·', '士大夫', '123456', '15da5b87fbda7ab1a95e471a1247abce', 'sdfsdf', '0', '1', '0', '1', '2019-09-26 10:13:40', '2019-09-26 13:40:45', '0', '1', '1', '0', '0', '1');
INSERT INTO `xx_channel` VALUES ('6', '', '', '', '', '1', '', '', '123456', '15da5b87fbda7ab1a95e471a1247abce', '', '0', '1', '0', '1', '2019-09-26 10:14:19', '2019-09-26 13:37:53', '0', '1', '1', '0', '0', '1');
INSERT INTO `xx_channel` VALUES ('7', '发士大夫s\'d', '撒旦发射点', 'df sdfsdf ', 'fsdf sd ', '1', 'sa\'f\'s\'d\'f', '对方锁定f', '123456', '15da5b87fbda7ab1a95e471a1247abce', 'sdf sdf s', '0', '1', '0', '1', '2019-09-26 11:21:15', '2019-09-26 12:04:00', '0', '1', '1', '0', '0', '1');

-- ----------------------------
-- Table structure for xx_node
-- ----------------------------
DROP TABLE IF EXISTS `xx_node`;
CREATE TABLE `xx_node` (
  `node_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ename` varchar(10) NOT NULL DEFAULT '0' COMMENT '控制器方法名称',
  `cname` varchar(20) NOT NULL DEFAULT '0' COMMENT '页面显示中文名',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  PRIMARY KEY (`node_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xx_node
-- ----------------------------
INSERT INTO `xx_node` VALUES ('1', 'Channel', '渠道用户管理', '0');
INSERT INTO `xx_node` VALUES ('2', 'list', '显示', '1');
INSERT INTO `xx_node` VALUES ('3', 'add', '新增二级账户', '1');
INSERT INTO `xx_node` VALUES ('4', 'deta', '详情查看', '1');
INSERT INTO `xx_node` VALUES ('5', 'edit', '编辑', '1');
INSERT INTO `xx_node` VALUES ('6', 'del', '删除', '1');
INSERT INTO `xx_node` VALUES ('7', 'chk', '审核', '1');

-- ----------------------------
-- Table structure for xx_role
-- ----------------------------
DROP TABLE IF EXISTS `xx_role`;
CREATE TABLE `xx_role` (
  `role_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL DEFAULT '0' COMMENT '角色名称',
  `pid` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '权限用户id',
  `level` varchar(10) NOT NULL DEFAULT '1' COMMENT '权限等级',
  `nw` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0是外部，1是内部',
  PRIMARY KEY (`role_id`),
  KEY `pid` (`pid`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xx_role
-- ----------------------------

-- ----------------------------
-- Table structure for xx_role_node
-- ----------------------------
DROP TABLE IF EXISTS `xx_role_node`;
CREATE TABLE `xx_role_node` (
  `role_node_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `nid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '节点id',
  `level` tinyint(5) unsigned NOT NULL DEFAULT '0' COMMENT '权限等级id',
  PRIMARY KEY (`role_node_id`),
  KEY `rid` (`rid`) USING BTREE,
  KEY `nid` (`nid`) USING BTREE,
  KEY `level` (`level`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xx_role_node
-- ----------------------------
