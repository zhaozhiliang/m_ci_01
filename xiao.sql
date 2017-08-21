/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : xiao

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-08-21 17:07:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `p_activity`
-- ----------------------------
DROP TABLE IF EXISTS `p_activity`;
CREATE TABLE `p_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '活动内容',
  `img` varchar(100) DEFAULT NULL COMMENT '活动主图url',
  `add_time` datetime DEFAULT NULL COMMENT '活动添加时间',
  `end_time` datetime DEFAULT NULL COMMENT '截止日期',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0正常 ，1删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of p_activity
-- ----------------------------
INSERT INTO `p_activity` VALUES ('1', '教师节活动', '1.每个微信团累计步数50万步以上2.微信群排名前三，3达到1,2条件活动结束时，可以获得奖励！', '3.jpg', '2017-08-15 18:49:12', '2017-09-01 18:49:16', '1');
INSERT INTO `p_activity` VALUES ('2', '教师节', '教师节公司', null, '2017-08-16 18:00:36', '2017-08-31 00:00:00', '1');
INSERT INTO `p_activity` VALUES ('3', '教师节', '教师节公司', null, '2017-08-16 18:00:52', '2017-08-31 00:00:00', '0');
INSERT INTO `p_activity` VALUES ('4', '八一建军节2', '间距季节跑步2', '/uploads/2017/08/59941bd365b29688125.png', '2017-08-16 18:05:19', '2017-09-02 18:05:00', '0');

-- ----------------------------
-- Table structure for `p_system_admin`
-- ----------------------------
DROP TABLE IF EXISTS `p_system_admin`;
CREATE TABLE `p_system_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `realname` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '真实姓名',
  `pwd` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `salt` char(6) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '随机数字字母 6位，用于验证密码',
  `phone` char(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '手机',
  `telphone` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '座机',
  `role_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色编号',
  `detail` blob COMMENT '备注',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `create_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建管理员ID',
  `update_time` datetime NOT NULL COMMENT '最后修改时间',
  `update_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后修改ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0删除 1启用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `state` (`status`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT COMMENT='系统管理员';

-- ----------------------------
-- Records of p_system_admin
-- ----------------------------
INSERT INTO `p_system_admin` VALUES ('1', 'admin', '超级管理员', '640b5410570534301f2328d48fa1ecc5', '123abc', '12222222228', '', '1', 0xE8B685E7BAA7E7AEA1E79086E59198, '2014-05-10 14:36:15', '1', '2017-08-15 17:36:48', '1', '1');
INSERT INTO `p_system_admin` VALUES ('2', 'zhaozhiliang', '赵志亮', 'b53b5dc06d7d93b57a3719d572da00fe', 'IPkno0', '13146105128', '', '1,16', 0xE5BC80E58F91, '2017-08-15 18:06:00', '1', '0000-00-00 00:00:00', '0', '1');

-- ----------------------------
-- Table structure for `p_system_log`
-- ----------------------------
DROP TABLE IF EXISTS `p_system_log`;
CREATE TABLE `p_system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '操作内容',
  `type` tinyint(1) DEFAULT NULL COMMENT '操作类型 1:添加 2:更新 3:删除',
  `column` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '所属模块',
  `time` datetime DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT COMMENT='系统日志表';

-- ----------------------------
-- Records of p_system_log
-- ----------------------------

-- ----------------------------
-- Table structure for `p_system_menu`
-- ----------------------------
DROP TABLE IF EXISTS `p_system_menu`;
CREATE TABLE `p_system_menu` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '名称',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级编号',
  `path` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '路径',
  `depth` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '路径层级',
  `controller` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '控制器',
  `action` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示 1是，0否',
  `sort` int(11) NOT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '导航图标',
  `description` blob NOT NULL COMMENT '描述',
  `create_id` int(11) unsigned NOT NULL COMMENT '创建管理员ID',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_id` int(11) unsigned NOT NULL COMMENT '修改管理员ID',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  `status` tinyint(1) NOT NULL COMMENT '状态（0禁用，1开启）',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_id` (`id`),
  KEY `spis` (`status`,`path`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT COMMENT='菜单表';

-- ----------------------------
-- Records of p_system_menu
-- ----------------------------
INSERT INTO `p_system_menu` VALUES ('1', '系统设置', '0', '1', '1', 'authorization', 'index', '1', '100', 'icon-cog', 0xE7B3BBE7BB9FE8AEBEE7BDAE, '1', '2016-03-11 11:16:44', '21', '2016-03-12 18:26:40', '1');
INSERT INTO `p_system_menu` VALUES ('2', '系统管理员', '1', '1_2', '2', 'admin', 'index', '1', '0', '', 0xE7B3BBE7BB9FE7AEA1E79086E59198, '1', '2016-03-11 11:23:11', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('3', '角色管理', '1', '1_3', '2', 'role', 'index', '1', '0', '', 0xE8A792E889B2E7AEA1E79086, '1', '2016-03-11 11:25:09', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('4', '权限列表', '1', '1_4', '2', 'authorization', 'index', '1', '0', '', 0xE69D83E99990E58897E8A1A8, '1', '2016-03-11 11:26:09', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('5', '菜单管理', '1', '1_5', '2', 'menu', 'index', '1', '0', '', 0xE88F9CE58D95E7AEA1E79086, '1', '2016-03-11 11:27:51', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('6', '初始化菜单', '0', '6', '1', 'defaultstart', 'index', '0', '0', 'icon-home', 0xE5889DE5A78BE58C96E88F9CE58D95, '1', '2016-03-11 11:34:35', '1', '2016-05-02 11:39:32', '0');
INSERT INTO `p_system_menu` VALUES ('7', '添加管理员', '2', '1_2_7', '3', 'admin', 'add', '0', '0', '', 0xE6B7BBE58AA0E7AEA1E79086E59198, '1', '2016-03-11 17:28:56', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('8', '编辑管理员', '2', '1_2_8', '3', 'admin', 'edit', '0', '0', '', 0xE7BC96E8BE91E7AEA1E79086E59198, '1', '2016-03-11 17:30:05', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('9', '添加菜单', '5', '1_5_9', '3', 'menu', 'add', '0', '0', '', 0xE6B7BBE58AA0E88F9CE58D95, '1', '2016-03-11 17:37:21', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('10', '编辑菜单', '5', '1_5_10', '3', 'menu', 'edit', '0', '0', '', 0xE7BC96E8BE91E88F9CE58D95, '1', '2016-03-11 17:37:55', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('11', '添加角色', '3', '1_3_11', '3', 'role', 'add', '0', '0', '', 0xE6B7BBE58AA0E8A792E889B2, '1', '2016-03-11 17:39:08', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('12', '编辑角色', '3', '1_3_12', '3', 'role', 'edit', '0', '0', '', 0xE7BC96E8BE91E8A792E889B2, '1', '2016-03-11 17:39:36', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('13', '角色权限配置', '3', '1_3_13', '3', 'role', 'authorization_config', '0', '0', '', 0xE8A792E889B2E69D83E99990E9858DE7BDAE, '1', '2016-03-11 17:40:26', '1', '2016-03-11 17:40:44', '1');
INSERT INTO `p_system_menu` VALUES ('14', '会员管理', '0', '14', '1', 'member', 'index', '1', '1', '', 0x61646620, '1', '2016-05-02 11:02:49', '1', '2016-05-02 11:04:52', '1');
INSERT INTO `p_system_menu` VALUES ('17', '统计报表', '0', '17', '1', 'statisc', 'index', '1', '4', '', 0xE4BDBFE5BE97E58F91E8BEBE, '1', '2016-05-02 11:10:42', '1', '2016-12-03 14:27:53', '0');
INSERT INTO `p_system_menu` VALUES ('18', '注册统计', '17', '17_18', '2', 'statisc', 'register', '1', '1', '', 0xE5958AE79A84E58F91, '1', '2016-05-02 11:11:41', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('19', '搜索统计', '17', '17_19', '2', 'statisc', 'search', '1', '2', '', 0xE69292E697A6E58F91E5B084E782B9E58F91, '1', '2016-05-02 11:12:19', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('22', '配置管理', '24', '24_22', '2', 'config', 'index', '1', '8', '', 0xE998BFE98193E5A4AB, '1', '2016-05-09 13:31:34', '1', '2016-07-16 20:09:47', '1');
INSERT INTO `p_system_menu` VALUES ('23', '字段管理', '24', '24_23', '2', 'field', 'index', '1', '8', ' ', 0x73646620, '1', '2016-05-09 21:16:23', '1', '2016-05-25 14:05:20', '1');
INSERT INTO `p_system_menu` VALUES ('24', '配置管理', '0', '24', '1', 'config', 'index', '0', '6', '', 0x616466616620, '1', '2016-05-25 14:04:26', '1', '2017-06-27 22:24:14', '0');
INSERT INTO `p_system_menu` VALUES ('25', '标签管理', '0', '25', '1', 'tag', 'index', '0', '4', '', 0xE8B78CE5B985E8BEBEE59B9BE696B9, '1', '2016-05-28 15:08:54', '1', '2017-06-27 22:24:03', '0');
INSERT INTO `p_system_menu` VALUES ('27', '会员列表', '14', '14_27', '2', 'member', 'index', '1', '1', 'user', 0xE4BC9AE59198E58897E8A1A8, '1', '2016-06-11 14:36:48', '1', '2016-11-29 23:20:49', '1');
INSERT INTO `p_system_menu` VALUES ('28', '评论管理', '0', '28', '1', 'comment', 'index', '1', '2', '', 0xE8AF84E8AEBA, '1', '2016-12-08 23:34:31', '1', '2017-07-06 21:22:52', '0');
INSERT INTO `p_system_menu` VALUES ('29', '评论列表', '28', '28_29', '2', 'comment', 'index', '1', '1', '', 0xE8AF84E8AEBAE58897E8A1A8, '1', '2016-12-09 00:01:33', '1', '2016-12-09 00:01:47', '1');
INSERT INTO `p_system_menu` VALUES ('30', '资讯管理', '0', '30', '1', 'article', 'index', '1', '0', 'icon-list', 0xE8B584E8AEAFE7AEA1E79086, '1', '2016-12-16 09:29:51', '1', '2017-08-07 21:50:50', '0');
INSERT INTO `p_system_menu` VALUES ('31', '发布文章', '30', '30_31', '2', 'article', 'add', '1', '0', '', 0xE6B7BBE58AA0E69687E7ABA0, '1', '2016-12-16 09:30:49', '1', '2016-12-16 09:33:25', '1');
INSERT INTO `p_system_menu` VALUES ('32', '资讯列表', '30', '30_32', '2', 'news', 'index', '1', '0', '', 0xE8B584E8AEAFE58897E8A1A8, '1', '2016-12-16 09:38:49', '1', '2017-07-01 23:18:09', '1');
INSERT INTO `p_system_menu` VALUES ('33', '频道列表', '30', '30_33', '2', 'channel', 'channel_list', '1', '0', '', 0xE9A291E98193E58897E8A1A8, '1', '2017-01-04 10:33:53', '1', '2017-06-29 23:59:23', '1');
INSERT INTO `p_system_menu` VALUES ('34', '文章分类列表', '30', '30_34', '2', 'type', 'index', '1', '0', '', 0xE69687E7ABA0E58886E7B1BBE58897E8A1A8, '1', '2017-01-04 10:35:05', '1', '2017-07-03 18:17:33', '0');
INSERT INTO `p_system_menu` VALUES ('35', '福利管理', '0', '35', '1', 'Welfare', 'welfare_list', '1', '0', '', 0xE7A68FE588A9E7AEA1E79086, '1', '2017-03-23 23:29:43', '1', '2017-08-07 21:50:55', '0');
INSERT INTO `p_system_menu` VALUES ('36', '福利列表', '35', '35_36', '2', 'welfare', 'welfare_list', '1', '0', '', 0xE7A68FE588A9E58897E8A1A8, '1', '2017-03-23 23:43:46', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('37', '编辑福利', '35', '35_37', '2', 'welfare', 'edit', '0', '0', '', 0xE7BC96E8BE91E7A68FE588A9, '1', '2017-03-24 00:00:28', '1', '2017-03-24 00:02:51', '0');
INSERT INTO `p_system_menu` VALUES ('38', '批量更新频道', '30', '30_38', '2', 'article', 'updateColumn', '1', '0', '', 0x757064617465436F6C756D6E, '1', '2017-03-27 20:09:02', '1', '2017-07-03 18:17:23', '0');
INSERT INTO `p_system_menu` VALUES ('39', '已删除会员', '14', '14_39', '2', 'member', 'del_list', '1', '2', 'user', 0xE5B7B2E588A0E999A4E4BC9AE59198, '1', '2017-06-25 18:08:35', '1', '2017-06-25 18:10:21', '1');
INSERT INTO `p_system_menu` VALUES ('40', '消息管理', '0', '40', '1', 'message', 'index', '1', '0', '', 0xE6B688E681AFE7AEA1E79086, '1', '2017-06-27 22:13:45', '1', '2017-08-07 21:51:08', '0');
INSERT INTO `p_system_menu` VALUES ('41', '发送消息', '40', '40_41', '2', 'message', 'send_message', '1', '0', '', 0xE58F91E98081E6B688E681AF, '1', '2017-06-27 22:14:57', '1', '2017-06-27 22:24:43', '1');
INSERT INTO `p_system_menu` VALUES ('42', '已删除资讯', '30', '30_42', '2', 'news', 'del_news', '1', '0', '', 0xE5B7B2E588A0E999A4E8B584E8AEAF, '1', '2017-07-03 18:18:00', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('43', '意见反馈', '0', '43', '1', 'feedback', 'index', '1', '0', '', 0xE6848FE8A781E58F8DE9A688, '1', '2017-07-03 18:56:49', '1', '2017-08-07 21:51:00', '0');
INSERT INTO `p_system_menu` VALUES ('44', '意见反馈', '43', '43_44', '2', 'feedback', 'index', '1', '0', '', 0xE6848FE8A781E58F8DE9A688, '1', '2017-07-03 18:57:16', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('45', '渠道管理', '0', '45', '1', 'source', 'index', '1', '0', '', 0xE6B8A0E98193E7AEA1E79086, '1', '2017-07-12 22:56:20', '1', '2017-08-07 21:51:03', '0');
INSERT INTO `p_system_menu` VALUES ('46', '渠道列表', '45', '45_46', '2', 'source', 'index', '1', '0', '', 0xE6B8A0E98193E58897E8A1A8, '1', '2017-07-12 22:56:53', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('47', '渠道会员列表', '45', '45_47', '2', 'source', 'source_member', '1', '0', '', 0xE6B8A0E98193E4BC9AE59198E58897E8A1A8, '1', '2017-07-12 22:57:21', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('48', '商品管理', '0', '48', '1', 'goods', 'index', '1', '0', '', 0xE59388E59388, '1', '2017-08-11 14:44:22', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('49', '商品管理', '48', '48_49', '2', 'goods', 'index', '1', '0', '', 0xE59586E59381E7AEA1E79086, '1', '2017-08-11 14:44:57', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('50', '活动管理', '0', '50', '1', 'activity', 'index', '1', '0', '', 0xE6B4BBE58AA8E7AEA1E79086, '1', '2017-08-15 18:10:08', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('51', '活动列表', '50', '50_51', '2', 'activity', 'activityList', '1', '0', '', 0xE6B4BBE58AA8E58897E8A1A8, '1', '2017-08-15 18:12:16', '0', '0000-00-00 00:00:00', '1');
INSERT INTO `p_system_menu` VALUES ('52', '添加活动', '50', '50_52', '2', 'activity', 'add', '1', '0', '', 0xE6B7BBE58AA0E6B4BBE58AA8, '1', '2017-08-15 18:13:07', '0', '0000-00-00 00:00:00', '1');

-- ----------------------------
-- Table structure for `p_system_role`
-- ----------------------------
DROP TABLE IF EXISTS `p_system_role`;
CREATE TABLE `p_system_role` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色名称',
  `description` blob NOT NULL COMMENT '描述',
  `is_super` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为超级管理员',
  `authorization` blob NOT NULL COMMENT '角色权限',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `create_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户编号',
  `update_time` datetime NOT NULL COMMENT '修改时间',
  `update_id` int(11) NOT NULL DEFAULT '0' COMMENT '修改编号',
  `status` tinyint(1) NOT NULL COMMENT '状态 1正常,0删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT COMMENT='管理员角色表';

-- ----------------------------
-- Records of p_system_role
-- ----------------------------
INSERT INTO `p_system_role` VALUES ('1', '超级管理员', 0xE68BA5E69C89E68980E69C89E69D83E99990, '1', '', '2016-03-12 17:03:57', '1', '2016-03-12 18:29:02', '21', '1');
INSERT INTO `p_system_role` VALUES ('12', '客服', 0xE5AEA2E69C8D, '0', '', '2016-03-12 16:55:36', '21', '2016-03-12 18:15:23', '19', '1');
INSERT INTO `p_system_role` VALUES ('13', '财务', 0xE8B4A2E58AA1, '0', '', '2016-03-12 16:55:52', '21', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `p_system_role` VALUES ('14', '市场运营', 0xE5B882E59CBAE8BF90E890A5, '0', '', '2016-03-12 16:56:04', '21', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `p_system_role` VALUES ('15', '行政人力', 0xE8A18CE694BFE4BABAE58A9B, '0', '', '2016-03-12 16:56:23', '21', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `p_system_role` VALUES ('16', '技术开发', 0xE68A80E69CAFE5BC80E58F91, '0', 0x31342C32372C32382C32392C33322C31352C31362C33302C3331, '2016-03-12 16:56:44', '21', '2016-07-07 21:50:56', '1', '1');
INSERT INTO `p_system_role` VALUES ('17', '前端设计', 0xE5898DE7ABAFE8AEBEE8AEA1, '0', '', '2016-03-12 16:56:57', '21', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `p_system_role` VALUES ('18', '产品经理', 0xE4BAA7E59381E7BB8FE79086, '0', '', '2016-03-12 16:57:15', '21', '0000-00-00 00:00:00', '0', '1');
INSERT INTO `p_system_role` VALUES ('19', '仓储', 0xE4BB93E582A8, '0', '', '2016-03-12 16:58:10', '21', '0000-00-00 00:00:00', '0', '1');
