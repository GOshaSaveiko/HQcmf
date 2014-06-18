<?php

/**
 * This is the model class for table "user_role".
 *
 * The followings are the available columns in table 'user_role':
 * @property integer $ur_id
 * @property string $ur_name
 * @property string $ur_caption
 * @property string $ur_switch
 *
 * The followings are the available model relations:
 * @property UserRoleRelation[] $relations
 */
class UserRole extends HqModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_role}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ur_name, ur_caption', 'required'),
			array('ur_name', 'length', 'max'=>24),
			array('ur_caption', 'length', 'max'=>40),
			array('ur_switch', 'length', 'max'=>54),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ur_id, ur_name, ur_caption, ur_switch', 'safe', 'on'=>'search'),
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
			'relations' => array(self::HAS_MANY, 'UserRoleRelation', 'urr_ur_id'),
            'rights' => array(self::HAS_MANY, 'UserRights', 'r_role'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ur_id' => 'Id',
			'ur_name' => 'Name',
			'ur_caption' => 'Caption',
			'ur_switch' => 'Switch',
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

		$criteria->compare('ur_id',$this->ur_id);
		$criteria->compare('ur_name',$this->ur_name,true);
		$criteria->compare('ur_caption',$this->ur_caption,true);
		$criteria->compare('ur_switch',$this->ur_switch,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRole the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getName() {
           return $this->ur_name;
    }

    public function __toString() {
        return $this->getName();
    }
}
