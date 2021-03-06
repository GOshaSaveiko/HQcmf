<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $u_id
 * @property string $u_login
 * @property string $u_pass
 * @property string $u_mail
 * @property integer $u_switch
 *
 * The followings are the available model relations:
 * @property UserRoleRelation[] $userRoleRelations
 */
class UserModel extends HqModel
{
    public $u_pass_repeat;
    public $u_roles;

    public function init(){
        parent::init();
       //
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('u_id, u_login, u_mail','unique','className' => 'UserModel','message'=>Hqh::t('{attribute} "{value}" has already been taken.')),
            array('u_login','match','pattern'=>'~^[A-z0-9-_]+$~','message'=>Hqh::t('{attribute} can contain only %p',array('%p'=>'(A-z0-9-_)'))),
            array('u_mail','email','message'=>Hqh::t('{attribute} seems not to be e-mail')),
            array('u_login, u_mail, u_switch', 'required'),
            array('u_pass, u_pass_repeat', 'required', 'on'=>'create'),
            array('u_roles', 'required', 'message'=>Hqh::t('User must have at least one role')),
            array('u_pass_repeat', 'compare', 'compareAttribute'=>'u_pass'),
            array('u_switch', 'numerical', 'integerOnly'=>true),
            array('u_login', 'length', 'max'=>24,'min'=>3),
            array('u_pass, u_pass_repeat', 'length', 'max'=>64),
            array('u_mail', 'length', 'max'=>54),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('u_id, u_login, u_pass, u_mail, u_switch', 'safe', 'on'=>'search'),
            //Specific rules for the future
            //array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
            //array('passwd', 'authenticate', 'on' => 'login'),
            //array('login', 'match', 'pattern' => '/^[A-Za-z0-9_-\s,]+$/u','message' => 'Incorrect symbols in login'),
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
            'userRoleRelations' => array(self::HAS_MANY, 'UserRoleRelation', 'urr_u_id'),
        );
    }

    public function behaviors(){
        return array(
            'userBehavior' => array(
                'class' => 'hqcmf.modules.users.components.UserBehavior'
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'u_id' => 'U',
            'u_login' => 'U Login',
            'u_pass' => 'U Pass',
            'u_mail' => 'U Mail',
            'u_switch' => 'U Switch',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('u_id',$this->u_id);
        $criteria->compare('u_login',$this->u_login,true);
        $criteria->compare('u_pass',$this->u_pass,true);
        $criteria->compare('u_mail',$this->u_mail,true);
        $criteria->compare('u_switch',$this->u_switch);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }


    public function getRoles()
    {
        $roles=$this->getInstanceRelation('userRoleRelations')->getUserRoles($this->u_id);

        return $roles;
    }

    public function getRolesList()
    {
        $list = array();
        $roles = new UserRole();
        $list_roles = $roles::model()->findAll('ur_switch = 1');
        foreach($list_roles as $role)
        {
           $list[$role['ur_id']] = $role['ur_caption'];
        }
        return $list;
    }


}