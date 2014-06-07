<?php

class m140607_193446_alter_roles_table_switch_attribute extends CDbMigration
{
	public function up()
	{
        //ALTER TABLE `user_role` CHANGE `ur_switch` `ur_switch` VARCHAR( 54 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1'
        $this->alterColumn('{{user_role}}','ur_switch','VARCHAR( 54 ) NULL DEFAULT \'1\'');
	}

	public function down()
	{
		echo "m140607_193446_alter_roles_table_switch_attribute migration down...\n";
        return true; //not so important to do backroll
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