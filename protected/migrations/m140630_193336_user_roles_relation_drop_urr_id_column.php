<?php

class m140630_193336_user_roles_relation_drop_urr_id_column extends CDbMigration
{
	public function up()
	{
        //ALTER TABLE `user_role_relation` DROP `urr_id`
        $this->dropColumn('{{user_role_relation}}','urr_id');
	}

	public function down()
	{
		echo "m140630_193336_user_roles_relation_drop_urr_id_column  migration down...\n";
        $this->addColumn('{{user_role_relation}}','urr_id','mediumint(8) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
		return true;
	}

}