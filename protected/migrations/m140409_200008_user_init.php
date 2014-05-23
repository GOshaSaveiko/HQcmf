<?php

class m140409_200008_user_init extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{user}}',array(
            'u_id'=>'MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'u_login'=>'VARCHAR(24) NOT NULL',
            'u_pass'=>'VARCHAR(40) NOT NULL',
            'u_mail'=>'VARCHAR(54) NULL',
            'u_switch'=>'TINYINT(1) NULL DEFAULT 1',
        ),'ENGINE=InnoDB');
        $this->createIndex('u_id_UNIQUE','{{user}}','u_id',true);
        $this->createIndex('u_login_UNIQUE','{{user}}','u_login',true);
        $this->createIndex('u_mail_UNIQUE','{{user}}','u_mail',true);
        $this->createIndex('u_pass','{{user}}','u_pass');

        $this->createTable('{{user_role}}',array(
            'ur_id'=>'MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'ur_name'=>'VARCHAR(24) NOT NULL',
            'ur_title'=>'VARCHAR(40) NOT NULL',
            'ur_switch'=>'VARCHAR(54) NULL',
        ),'ENGINE=InnoDB');
        $this->createIndex('ur_name_UNIQUE','{{user_role}}','ur_name',true);
        $this->createIndex('ur_title_UNIQUE','{{user_role}}','ur_title',true);

        $this->createTable('{{user_role_relation}}',array(
            'urr_id'=>'MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'urr_u_id'=>'MEDIUMINT UNSIGNED NOT NULL',
            'urr_ur_id'=>'MEDIUMINT UNSIGNED NOT NULL',
        ),'ENGINE=InnoDB');
        $this->createIndex('fk_urr_u_idx','{{user_role_relation}}','urr_u_id');
        $this->createIndex('fk_urr_ur_idx','{{user_role_relation}}','urr_ur_id');
        $this->addForeignKey('fk_urr_u', '{{user_role_relation}}', 'urr_u_id',
            '{{user}}', 'u_id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_urr_ur', '{{user_role_relation}}', 'urr_ur_id',
            '{{user_role}}', 'ur_id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
        $this->dropForeignKey('fk_urr_u','{{user_role_relation}}');
        $this->dropForeignKey('fk_urr_ur','{{user_role_relation}}');
		$this->dropTable('{{user}}');
        $this->dropTable('{{user_role}}');
        $this->dropTable('{{user_role_relation}}');
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