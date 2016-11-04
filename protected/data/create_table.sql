CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_name` varchar(100) NOT NULL DEFAULT '' COMMENT '登录用户名',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '登录密码',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户性别 0：未知 男：1 女：2',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `nick_name` varchar(100) NOT NULL DEFAULT '' COMMENT '用户呢称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1：正常 0：删除',
  `create_time` datetime NOT NULL DEFAULT '2016-10-28 11:11:11' COMMENT '创建时间',
  `modify_time` datetime NOT NULL DEFAULT '2016-10-28 11:11:11' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

CREATE TABLE `brief` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` varchar(100) NOT NULL DEFAULT '' COMMENT '序号',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `content` varchar(200) NOT NULL DEFAULT '' COMMENT '内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1：正常 0：删除',
  `create_time` datetime NOT NULL DEFAULT '2016-10-10 11:11:11' COMMENT '创建时间',
  `modify_time` datetime NOT NULL DEFAULT '2016-10-10 11:11:11' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;