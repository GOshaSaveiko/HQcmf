<?php
class CoreController extends HqController
{

    /**
	* @var string the default layout for the controller view. Defaults to '//layouts/column1',
	* meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	*/
    //public $layout='/layouts/main';
    public $layout ='';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
    public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
    public $breadcrumbs=array();

    public function actions()
    {
        return array(
		    // captcha action renders the CAPTCHA image displayed on the contact page
		    'captcha'=>array(
			    'class'=>'CCaptchaAction',
			    'backColor'=>0xFFFFFF,
                   'maxLength'=>4,
                   'minLength'=>4,
                   'width'=>80,
                   'padding'=>5
		    ),
		    // page action renders "static" pages stored under 'protected/views/site/pages'
		    // They can be accessed via: index.php?r=site/page&view=FileName
		    'page'=>array(
			    'class'=>'CViewAction',
		    ),
	    );
    }

    public function actionIndex()
    {
       //echo "Core module!";
	   $this->render('index');
    }

    public function actionError()
    {
        if(Yii::app()->errorHandler->error)
        {
            $error = Yii::app()->errorHandler->error;
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->layout = '/layouts/error';
                $this->render('error', $error);
        }
    }
    
    public function actionLogin()
    {
        $model=new UserLoginForm;
        // collect user input data
        if(isset($_POST['UserLoginForm']))
        {
            $model->attributes=$_POST['UserLoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->getModule('hqcmf')->hquser->returnUrl);
        }
        // display the login form
        $this->layout = '/layouts/login';
        $this->render('_login',array('model'=>$model));
    }


    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}

?>