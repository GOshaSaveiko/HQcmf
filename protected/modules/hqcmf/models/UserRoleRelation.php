<?php

/**
 * This is the model class for table "user_role_relation".
 *
 * The followings are the available columns in table 'user_role_relation':
 * @property integer $urr_id
 * @property integer $urr_u_id
 * @property integer $urr_ur_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property UserRole $role
 */
class UserRoleRelation extends HqModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_role_relation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('urr_u_id, urr_ur_id', 'required'),
			array('urr_u_id, urr_ur_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('urr_id, urr_u_id, urr_ur_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'urr_u_id'),
			'role' => array(self::BELONGS_TO, 'UserRole', 'urr_ur_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'urr_id' => 'Id',
			'urr_u_id' => 'User id',
			'urr_ur_id' => 'Relation Id',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('urr_id',$this->urr_id);
		$criteria->compare('urr_u_id',$this->urr_u_id);
		$criteria->compare('urr_ur_id',$this->urr_ur_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRoleRelation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * @param $user_id
     * @return array roles for user
     */
    public static function getUserRoles($user_id)
    {
        $roles=array();
        $ar_roles=self::model()->with('role')->findAllByAttributes(array('urr_u_id'=>$user_id));

        if ($ar_roles!==null)
        {
            foreach ($ar_roles as $role)
            {
                if($role->role->ur_switch)
                    $roles[]=$role->role;
            }
        }
        return $roles;
    }

    /**
     * @param $user_id
     * @return array roles for user
     */
    public static function getUserRolesIds($user_id)
    {
        $roles=array();
        $ar_roles=self::model()->findAll(array(
                'select'=>'urr_ur_id',
                'condition'=>'urr_u_id=:userID',
                'params'=>array(':userID'=>(int)$user_id),
            ));

        if ($ar_roles!==null)
        {
            foreach ($ar_roles as $role)
            {
                    $roles[]=$role->urr_ur_id;
            }
        }
        return $roles;
    }
}
