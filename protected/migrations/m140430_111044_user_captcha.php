<?php

class m140430_111044_user_captcha extends CDbMigration
{
	public function up()
	{
        $this->createTable('user_captcha',array(
            'uc_id'=>'pk',
            'uc_ip'=>'VARCHAR(45) NOT NULL',
            'uc_count'=>'TINYINT(2) NOT NULL',
            'uc_time'=>'int(11)',
        ),'ENGINE=InnoDB');

        $this->createIndex('uc_ip_u_idx','user_captcha','uc_ip');
	}

	public function down()
	{
        $this->dropTable('user_captcha');
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