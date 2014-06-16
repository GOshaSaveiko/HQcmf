<?php

class m140616_191726_rights_rename extends CDbMigration
{
	public function up()
	{
        //RENAME TABLE `hqcmf`.`rights` TO `hqcmf`.`user_rights` ;
        $this->renameTable('{{rights}}','{{user_rights}}');
	}

	public function down()
	{
		echo "m140616_191726_rights_rename migration down...\n";
        $this->renameTable('{{user_rights}}','{{rights}}');
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