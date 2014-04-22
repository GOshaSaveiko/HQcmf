<?php

class m140422_140559_init_user_admin extends CDbMigration
{
	public function up()
	{
        $this->insert('user',array(
           'u_login'=>'admin',
           'u_pass'=>CPasswordHelper::hashPassword('admin'),
           'u_mail'=>'admin@admin.com',
        ));
	}

	public function down()
	{
		$this->delete('user','u_login=:u_login',array(':u_login'=>'admin'));
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