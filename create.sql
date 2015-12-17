delimiter $$

CREATE DATABASE `exercise` /*!40100 DEFAULT CHARACTER SET utf8 */$$

delimiter $$

CREATE DATABASE `exercise` /*!40100 DEFAULT CHARACTER SET utf8 */$$


delimiter $$

CREATE TABLE `exercise_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL COMMENT '计划标题',
  `content` varchar(1024) DEFAULT NULL COMMENT '计划内容',
  `addtime` datetime DEFAULT NULL COMMENT '添加时间',
  `status` int(11) DEFAULT NULL COMMENT '状态标记：0未完成，1已完成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='健身计划表'$$


delimiter $$

CREATE TABLE `exercise_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL COMMENT '用户id',
  `type` varchar(45) DEFAULT NULL COMMENT '运动类型',
  `count` double DEFAULT NULL COMMENT '运动数量',
  `unit` varchar(45) DEFAULT NULL COMMENT '单位',
  `totaltime` double DEFAULT NULL COMMENT '总运动时间',
  `date` date DEFAULT NULL,
  `comment` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='运动记录表'$$


delimiter $$

CREATE TABLE `exercisetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(45) DEFAULT NULL COMMENT '名称',
  `unit` varchar(45) DEFAULT NULL COMMENT '单位',
  PRIMARY KEY (`id`),
  UNIQUE KEY `typename_UNIQUE` (`typename`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='健身类型表'$$


delimiter $$

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nicname` varchar(45) DEFAULT NULL,
  `lastlogin` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8$$


