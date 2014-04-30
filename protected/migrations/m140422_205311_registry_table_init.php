<?php

class m140422_205311_registry_table_init extends CDbMigration
{
	public function up()
	{
        $this->createTable('registry',array(
            'r_key'=>'VARCHAR(32) NOT NULL PRIMARY KEY',
            'r_value'=>'VARCHAR(64) NOT NULL',
        ),'ENGINE=InnoDB');
        $this->createIndex('r_key_UNIQUE','registry','r_key',true);
        $this->createIndex('r_value','registry','r_value');
	}

	public function down()
	{
        $this->dropTable('registry');
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