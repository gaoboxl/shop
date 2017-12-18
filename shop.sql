/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-12-18 13:35:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for me_activity
-- ----------------------------
DROP TABLE IF EXISTS `me_activity`;
CREATE TABLE `me_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '活动名称',
  `img` varchar(255) DEFAULT NULL COMMENT '图片id',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '状态:0正常,1禁用',
  `start_time` int(11) unsigned DEFAULT NULL COMMENT '开始时间',
  `end_time` int(11) unsigned DEFAULT NULL COMMENT '结束时间',
  `content` text COMMENT '活动内容',
  `rule` varchar(255) DEFAULT NULL COMMENT '活动规则',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='活动表';

-- ----------------------------
-- Records of me_activity
-- ----------------------------

-- ----------------------------
-- Table structure for me_admin
-- ----------------------------
DROP TABLE IF EXISTS `me_admin`;
CREATE TABLE `me_admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员id ',
  `name` varchar(50) DEFAULT NULL COMMENT '管理员名称',
  `rule_id` int(11) unsigned DEFAULT '0' COMMENT '管理员权限',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '状态',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of me_admin
-- ----------------------------

-- ----------------------------
-- Table structure for me_category
-- ----------------------------
DROP TABLE IF EXISTS `me_category`;
CREATE TABLE `me_category` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `name` varchar(50) DEFAULT NULL COMMENT '分类名称',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of me_category
-- ----------------------------

-- ----------------------------
-- Table structure for me_goods
-- ----------------------------
DROP TABLE IF EXISTS `me_goods`;
CREATE TABLE `me_goods` (
  `goods_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '状态：0显示，1禁用',
  `price` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '商品价格',
  `original_price` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '原始价格',
  `img` varchar(255) NOT NULL COMMENT '图片id',
  `desc` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` varchar(255) DEFAULT NULL COMMENT '内容',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of me_goods
-- ----------------------------

-- ----------------------------
-- Table structure for me_menu
-- ----------------------------
DROP TABLE IF EXISTS `me_menu`;
CREATE TABLE `me_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `name` varchar(100) DEFAULT NULL COMMENT '菜单名称',
  `url` varchar(100) DEFAULT NULL COMMENT '菜单地址',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '状态：0正常，1禁用',
  `flag` tinyint(1) unsigned DEFAULT '0' COMMENT '显示到导航：0显示，1不显示',
  `icon` varchar(30) DEFAULT NULL COMMENT '菜单icon',
  `pid` int(11) unsigned DEFAULT '0' COMMENT '父id ',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of me_menu
-- ----------------------------

-- ----------------------------
-- Table structure for me_order
-- ----------------------------
DROP TABLE IF EXISTS `me_order`;
CREATE TABLE `me_order` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `user_id` int(11) unsigned DEFAULT '0' COMMENT '会员id ',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '状态：0正常，1禁用',
  `goods_id` int(11) unsigned DEFAULT '0' COMMENT '商品id',
  `order_time` int(11) unsigned DEFAULT '0' COMMENT '预定时间',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of me_order
-- ----------------------------

-- ----------------------------
-- Table structure for me_picture
-- ----------------------------
DROP TABLE IF EXISTS `me_picture`;
CREATE TABLE `me_picture` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片id',
  `goods_id` int(11) unsigned DEFAULT '0' COMMENT '商品id',
  `path` varchar(255) DEFAULT NULL COMMENT '图片',
  `source_img` varchar(255) DEFAULT NULL COMMENT '原图',
  `thum_img` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '开始时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片表';

-- ----------------------------
-- Records of me_picture
-- ----------------------------

-- ----------------------------
-- Table structure for me_users
-- ----------------------------
DROP TABLE IF EXISTS `me_users`;
CREATE TABLE `me_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '会员id ',
  `user_name` varchar(255) NOT NULL COMMENT '会员名称',
  `stataus` tinyint(2) DEFAULT '0' COMMENT '会员状态：0正常，1禁用',
  `open_id` varchar(100) DEFAULT NULL COMMENT '微信open_id',
  `nick_name` varchar(255) DEFAULT NULL COMMENT '微信昵称',
  `icon` varchar(255) DEFAULT NULL COMMENT '微信头像',
  `phone` varchar(11) DEFAULT NULL COMMENT '绑定手机',
  `balance` decimal(10,0) NOT NULL DEFAULT '0' COMMENT '余额',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of me_users
-- ----------------------------

-- ----------------------------
-- Table structure for me_user_activi
-- ----------------------------
DROP TABLE IF EXISTS `me_user_activi`;
CREATE TABLE `me_user_activi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(11) unsigned DEFAULT '0' COMMENT '会员id',
  `act_id` int(11) unsigned DEFAULT NULL COMMENT '活动id',
  `status` tinyint(4) DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) unsigned DEFAULT NULL COMMENT '修改时间',
  `delete_time` int(11) unsigned DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员活动表';

-- ----------------------------
-- Records of me_user_activi
-- ----------------------------
