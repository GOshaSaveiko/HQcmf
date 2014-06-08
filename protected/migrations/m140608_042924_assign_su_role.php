<?php

class m140608_042924_assign_su_role extends CDbMigration
{
	public function up()
	{
        $this->insert('{{user_role}}',array(
            'ur_id'=>1,
            'ur_name'=>'su',
            'ur_caption'=>'superuser'
        ));
        $this->insert('{{user_role_relation}}',array(
            'urr_u_id'=>1,
            'urr_ur_id'=>1
        ));
	}

	public function down()
	{
		echo "m140608_042924_assign_su_role migration down...\n";
        $this->delete('{{user_role_relation}}',array('urr_u_id=:id','urr_ur_id=:id'),array(':id'=>1));
        $this->delete('{{user_role}}','ur_name=:ur_name',array(':ur_name'=>'su'));
		return true;
	}
}