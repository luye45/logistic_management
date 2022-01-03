/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ materials /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE materials;

DROP TABLE IF EXISTS adusers;
CREATE TABLE `adusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `pwd` varchar(20) DEFAULT NULL COMMENT '密码',
  `create_time` datetime NOT NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT current_timestamp() COMMENT '修改时间',
  `create_user_name` varchar(255) NOT NULL COMMENT '修改用户名',
  `login_count` int(11) NOT NULL DEFAULT 0 COMMENT '登录次数',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登陆时间',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态(正常1，禁用-1)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS materials;
CREATE TABLE `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '物资编号',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '物资名称',
  `spec` varchar(20) NOT NULL DEFAULT '' COMMENT '物资规格',
  `number` int(11) NOT NULL DEFAULT 0 COMMENT '物资数量',
  `price` int(11) NOT NULL DEFAULT 0 COMMENT '物资单价',
  `producer` varchar(50) NOT NULL DEFAULT '' COMMENT '生产厂商',
  `create_user_name` varchar(50) NOT NULL COMMENT '创建用户名',
  `create_time` datetime NOT NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT current_timestamp() COMMENT '修改时间',
  `type_id` int(11) NOT NULL COMMENT '物资类别id',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态(正常1，删除-1)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COMMENT='物资表';

DROP TABLE IF EXISTS material_type;
CREATE TABLE `material_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '物资ID',
  `name` varchar(255) DEFAULT NULL COMMENT '物资名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8;