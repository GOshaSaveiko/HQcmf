<?php

/**
 * This is the model class for table "user_captcha".
 *
 * The followings are the available columns in table 'user_captcha':
 * @property integer $uc_id
 * @property string $uc_ip
 * @property integer $uc_count
 * @property integer $uc_time
 */
class UserCaptcha extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_captcha}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uc_ip, uc_count', 'required'),
			array('uc_count, uc_time', 'numerical', 'integerOnly'=>true),
			array('uc_ip', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uc_id, uc_ip, uc_count, uc_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uc_id' => 'Uc',
			'uc_ip' => 'Uc Ip',
			'uc_count' => 'Uc Count',
			'uc_time' => 'Uc Time',
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

		$criteria->compare('uc_id',$this->uc_id);
		$criteria->compare('uc_ip',$this->uc_ip,true);
		$criteria->compare('uc_count',$this->uc_count);
		$criteria->compare('uc_time',$this->uc_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserCaptcha the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'uc_time',
                'updateAttribute' => 'uc_time',
            ),
        );
    }

    public static function isCaptcha()
    {
        if (!isset(Yii::app()->user->viewCaptcha))
        {
            $ip=Yii::app()->request->getUserHostAddress();
            $uc=self::model()->findByAttributes(array('uc_ip'=>$ip));
            if ($uc!==null && $uc->uc_count>=3)
            {
                Yii::app()->user->setState('viewCaptcha',true);
            }
        }
    }

    public static function addCaptcha()
    {
        if (!isset(Yii::app()->user->viewCaptcha))
        {
            $ip=Yii::app()->request->getUserHostAddress();
            $uc=self::model()->findByAttributes(array('uc_ip'=>$ip));
            if ($uc!==null)
            {
                $uc->uc_count++;
                $uc->save(true,array('uc_count'));
            }
            else
            {
                $uc=new self;
                $uc->uc_ip=$ip;
                $uc->uc_count=1;
                $uc->save();
            }
        }
    }

    public static function clearCaptcha()
    {
        $ip=Yii::app()->request->getUserHostAddress();
        $uc=self::model()->deleteAll('uc_time<=:time',array(':time'=>time()+15*60)); //15 min
        $uc=self::model()->deleteAllByAttributes(array('uc_ip'=>$ip));
        unset(Yii::app()->user->viewCaptcha);
    }
}
