<?php

class m140607_201124_rights_table_init extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{rights}}',array(
            'r_id'=>'MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'r_role'=>'MEDIUMINT UNSIGNED NOT NULL',
            'r_task'=>'VARCHAR(40) NOT NULL',
            'r_flag'=>'TINYINT NOT NULL DEFAULT 0',
        ),'ENGINE=InnoDB');
        $this->createIndex('r_id_UNIQUE','{{rights}}','r_id',true);
        $this->createIndex('r_role','{{rights}}','r_role');
        $this->createIndex('r_task','{{rights}}','r_task');
        $this->createIndex('r_role_task_UNIQUE','{{rights}}','r_role,r_task',true);
        $this->addForeignKey('fk_ur_r', '{{user_role}}', 'ur_id',
            '{{rights}}', 'r_role', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		echo "m140607_201124_rights_table_init migration down...\n";
        $this->dropForeignKey('fk_ur_r','{{user_role}}');
        $this->dropTable('{{rights}}');
        return true;
	}
}