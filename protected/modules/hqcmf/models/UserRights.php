<?php

/**
 * This is the model class for table "user_rights".
 *
 * The followings are the available columns in table 'user_rights':
 * @property integer $r_id
 * @property integer $r_role
 * @property string $r_task
 * @property integer $r_flag
 *
 * The followings are the available model relations:
 * @property UserRole $rRole
 */
class UserRights extends HqModel
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user_rights}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('r_role, r_task', 'required'),
            array('r_role, r_flag', 'numerical', 'integerOnly'=>true),
            array('r_task', 'length', 'max'=>40),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('r_id, r_role, r_task, r_flag', 'safe', 'on'=>'search'),
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
            'rRole' => array(self::BELONGS_TO, 'UserRole', 'r_role'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'r_id' => 'R',
            'r_role' => 'R Role',
            'r_task' => 'R Task',
            'r_flag' => 'R Flag',
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

        $criteria->compare('r_id',$this->r_id);
        $criteria->compare('r_role',$this->r_role);
        $criteria->compare('r_task',$this->r_task,true);
        $criteria->compare('r_flag',$this->r_flag);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return UserRights the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}