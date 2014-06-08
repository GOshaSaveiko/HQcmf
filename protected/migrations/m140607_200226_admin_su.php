<?php

class m140607_200226_admin_su extends CDbMigration
{
	public function up()
	{
        $this->insert('{{user_role}}',
                      array('ur_name'=>'su',
                            'ur_caption'=>'superuser'
                        )
        );
        $z_user=$this->getDbConnection()->createCommand('SELECT `u_id` FROM `{{user}}` WHERE `u_login`=:login')->query(array(':login'=>'admin'));
        if ($z_user->count()!=0)
        {
            $z_role=$this->getDbConnection()->createCommand('SELECT `ur_id` FROM `{{user_role}}` WHERE `ur_name`=:name')->query(array(':name'=>'su'));
            $user=$z_user->read();
            $role=$z_role->read();
            $this->insert('{{user_role_relation}}',
                array('urr_u_id'=>$user['u_id'],
                      'urr_ur_id'=>$role['ur_id'],
                )
            );
        }
	}

	public function down()
	{
        $z_user=$this->getDbConnection()->createCommand('SELECT `u_id` FROM `{{user}}` WHERE `u_login`=:login')->query(array(':login'=>'admin'));
        $z_role=$this->getDbConnection()->createCommand('SELECT `ur_id` FROM `{{user_role}}` WHERE `ur_name`=:name')->query(array(':name'=>'su'));
        $role=$z_role->read();
        if ($z_user->count()!=0)
        {
            $user=$z_user->read();
            $this->delete('{{user_role_relation}}',array('urr_u_id'=>$user['u_id'],'urr_ur_id'=>$role['ur_id'],));
        }
        $this->delete('{{user_role}}',array('ur_id'=>$role['ur_id']));
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