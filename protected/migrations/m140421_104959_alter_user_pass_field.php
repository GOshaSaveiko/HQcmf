<?php

class m140421_104959_alter_user_pass_field extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('user','u_pass','VARCHAR(64) NOT NULL');
	}

	public function down()
	{
		echo "m140421_104959_alter_user_pass_field does not support migration down.\n";
		return false;
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