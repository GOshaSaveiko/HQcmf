<?php

class m140421_104959_alter_user_pass_field extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('{{user}}','u_pass','VARCHAR(64) NOT NULL');
	}

	public function down()
	{
		echo "m140421_104959_alter_user_pass_field migration down...\n";
		$this->alterColumn('{{user}}','u_pass','VARCHAR(40) NOT NULL');
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