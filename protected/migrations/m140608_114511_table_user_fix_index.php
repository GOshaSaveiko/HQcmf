<?php

class m140608_114511_table_user_fix_index extends CDbMigration
{
	public function up()
	{
        $this->dropIndex('u_id_UNIQUE','{{user}}');
        $this->dropIndex('u_pass','{{user}}');
	}

	public function down()
	{
        $this->createIndex('u_id_UNIQUE','{{user}}','u_id',true);
        $this->createIndex('u_pass','{{user}}','u_pass');
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