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

INSERT INTO adusers(id,name,pwd,create_time,update_time,create_user_name,login_count,last_login_time,status) VALUES(1,'admin','admin','0000-00-00 00:00:00','0000-00-00 00:00:00','',54,'2021-12-21 19:36:47',1),(11,'lqdfu','jprlq','2021-12-13 23:08:43','2021-12-13 23:08:43','mikul',91,'1982-12-17 06:12:52',1),(12,'abcde','abcd','2021-12-13 23:08:43','2021-12-21 13:39:11','hindq',206,'2016-06-28 22:16:01',1),(13,'olyzr','nktgb','2021-12-13 23:08:43','2021-12-22 03:58:41','gykdd',642,'1996-01-08 11:25:49',-1),(14,'xoefx','hkpvl','2021-12-13 23:08:43','2021-12-13 23:08:43','mempw',436,'1976-07-17 05:27:50',-1),(15,'ujlkm','rhobf','2021-12-13 23:08:43','2021-12-13 23:08:43','nvwkc',969,'1975-01-02 12:22:37',1),(16,'uykic','daycb','2021-12-13 23:08:43','2021-12-13 23:08:43','lmtrb',222,'1972-01-01 00:21:11',1),(17,'mjngq','edwuu','2021-12-13 23:08:43','2021-12-13 23:08:43','ujpey',966,'1979-01-16 06:00:21',1),(18,'zytsx','kcujn','2021-12-13 23:08:43','2021-12-13 23:08:43','wqqrk',281,'1986-03-11 11:47:45',-1),(19,'uffmc','cclvi','2021-12-13 23:08:43','2021-12-13 23:08:43','ucctg',151,'2019-02-19 18:53:18',1),(20,'hecwy','qszor','2021-12-13 23:08:43','2021-12-13 23:08:43','plnwk',473,'2019-03-17 05:30:16',1),(31,'aaaaaaaaaaaa','aaaaaaaaaaaa','2021-12-15 08:18:05','2021-12-15 08:18:05','',0,NULL,1),(32,'aaaaaaaaaaaaaaa','aaaaaaaaaaaaaaa','2021-12-15 08:18:30','2021-12-15 08:18:30','',0,NULL,1),(34,'b','b','2021-12-15 08:38:47','2021-12-15 08:38:47','admin',0,NULL,1),(35,'bbb','bb','2021-12-15 12:41:07','2021-12-15 12:41:31','admin',0,NULL,1),(36,'gsadf','asfdasf','2021-12-19 08:02:56','2021-12-19 08:02:56','admin',0,NULL,1),(37,'make','make','2021-12-21 19:42:25','2021-12-21 19:42:25','admin',0,NULL,1),(38,'test3','qwdaf','2021-12-22 03:45:13','2021-12-22 03:45:13','admin',0,NULL,1),(39,'asfa','asfaf','2021-12-21 19:46:41','2021-12-21 19:46:41','admin',0,NULL,1),(40,'s','s','2021-12-22 03:47:21','2021-12-22 03:47:21','admin',0,NULL,1);

INSERT INTO materials(id,name,spec,number,price,producer,create_user_name,create_time,update_time,type_id,status) VALUES(1,'jymdk','qqoun',825,366,'hnsom','mreep','2021-12-22 03:51:49','2021-12-22 03:51:49',42,1),(2,'sytpn','peulk',472,78,'pxmcc','srrtt','2021-12-22 03:51:49','2021-12-22 03:51:49',823,1),(3,'jykeu','jonvx',868,40,'finhh','iwlli','2021-12-22 03:51:49','2021-12-22 03:57:19',3,1),(4,'rvblk','kklpj',933,796,'gdxof','hayuk','2021-12-22 03:51:49','2021-12-22 03:51:49',441,1),(5,'ktrmn','ibloe',860,945,'wgqdd','pdlbb','2021-12-22 03:51:49','2021-12-22 03:51:49',327,1),(6,'ghtmw','cxdhx',719,770,'xprgb','otthu','2021-12-22 03:51:49','2021-12-22 03:51:49',366,1),(7,'szjpd','znlmy',301,657,'wylgp','wxygc','2021-12-22 03:51:49','2021-12-22 03:51:49',382,1),(8,'uikkn','krikw',765,1003,'pvxnb','lkoil','2021-12-22 03:51:49','2021-12-22 03:51:49',685,1),(9,'jmrbp','cqokw',330,556,'nyfpg','lyhcc','2021-12-22 03:51:49','2021-12-22 03:51:49',881,1),(10,'lrewm','urhlv',868,120,'relqu','onndm','2021-12-22 03:51:49','2021-12-22 03:51:49',914,1),(101,'ewtyp','toqna',313,624,'ggxqq','qddxk','2021-12-22 03:52:00','2021-12-22 03:52:00',624,-1),(102,'tmqlr','pmyjl',944,72,'wvdqr','kmdzl','2021-12-22 03:52:00','2021-12-22 03:52:00',198,-1),(103,'jodsi','hevwo',540,1009,'ebxei','plsat','2021-12-22 03:52:00','2021-12-22 03:52:00',205,-1),(104,'arzer','cjgkt',818,236,'uxrpw','jkekm','2021-12-22 03:52:00','2021-12-22 03:52:00',300,-1),(105,'yeqni','gosuh',538,543,'oajou','tyihi','2021-12-22 03:52:00','2021-12-22 03:52:00',65,-1),(106,'kfxnj','lvcdq',1022,34,'ksgwd','wserx','2021-12-22 03:52:00','2021-12-22 03:52:00',500,-1),(107,'rznrp','higzn',426,189,'yxbrn','ykybo','2021-12-22 03:52:00','2021-12-22 03:52:00',263,-1),(108,'iutxw','dasse',1006,172,'ccafo','pyrjx','2021-12-22 03:52:00','2021-12-22 03:52:00',682,-1),(109,'ptnms','lnwut',953,29,'cpkmo','gymvx','2021-12-22 03:52:00','2021-12-22 03:52:00',129,-1),(110,'mmenf','nuyfj',549,641,'eptna','fidmo','2021-12-22 03:52:00','2021-12-22 03:52:00',758,-1);
INSERT INTO material_type(id,name) VALUES(1,'thjul'),(2,'qexrh'),(3,'osldk'),(4,'vdbtd'),(5,'pprvm'),(6,'macie'),(7,'ibfub'),(8,'vcbhf'),(9,'fhqfu'),(10,'qonok'),(101,'fhsna'),(102,'euzkm'),(103,'lvssc'),(104,'wxqtr'),(105,'rsfyv'),(106,'mukde'),(107,'nimfg'),(108,'tbnby'),(109,'jqcgk'),(110,'zcqtx');