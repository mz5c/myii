<?php

class m151211_080951_sec extends CDbMigration
{
	public function up()
	{
		$sql = <<<eof
DROP TABLE IF EXISTS `new_user`;
CREATE TABLE `new_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '姓名',
  `sex` enum('male','female','unknown') NOT NULL DEFAULT 'unknown' COMMENT '性别',
  `age` tinyint(3) NOT NULL DEFAULT '0' COMMENT '年龄',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
eof;
		Yii::app()->db_sec->createCommand($sql)->execute();
		return true;

	}

	public function down()
	{
		$sql = "DROP TABLE IF EXISTS `new_user`";
		Yii::app()->db_sec->createCommand($sql)->execute();
		return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}