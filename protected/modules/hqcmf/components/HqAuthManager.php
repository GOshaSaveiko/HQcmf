<?php
class HqAuthManager extends CPhpAuthManager
{
    public function init()
    {
        parent::init();
    }

    private static function reduceRights($a,$b)
    {
        return $a|$b;
    }

    public function checkAccess($itemName,$userId,$params=array())
    {
        $access = false;
        $user=UserModel::model()->findByPk((int)$userId);
        if($user!==null)
        {
            $roles = $user->roles;
            if(count($roles)===1 && (string)$roles['0']==='su')
            {
                $access = true;
            } elseif(count($roles)>0) {
                $role_criteria = array();
                $su = false;
                foreach($roles as $role)
                {
                    $role_criteria[] = (int)$role->ur_id;
                    if((string)$role==='su') $su = true;
                }
                $criteria = new CDbCriteria();
                $criteria->condition = 'r_task=:itemName';
                $criteria->params = array(':itemName'=>(string)$itemName);
                $criteria->addInCondition("r_role", $role_criteria);
                $rights = UserRights::model()->findAll($criteria);

                $rights_array = array();
                foreach ($rights as $right)
                {
                    $rights_array[] = (int)$right->r_flag;
                }
                if($su) $rights_array[] = 1; //su role has all flags to Allow
                
                if(count($rights_array)>0)
                    $access = (array_reduce($rights_array,"self::reduceRights") > 0 ? true : false);

            }
        }
        return $access;
    }
}
?>
