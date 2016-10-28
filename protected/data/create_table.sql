CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_name` varchar(100) NOT NULL DEFAULT '' COMMENT '登录用户名',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '登录密码',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用户性别 0：未知 男：1 女：2',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `nick_name` varchar(100) NOT NULL DEFAULT '' COMMENT '用户呢称',
  `create_time` datetime NOT NULL DEFAULT '2016-10-28 11:11:11' COMMENT '创建时间',
  `modify_time` datetime NOT NULL DEFAULT '2016-10-28 11:11:11' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;