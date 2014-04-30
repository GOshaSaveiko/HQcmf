<?php
/* @var $this UserModelController */ 
/* @var $model UserLoginForm */ 
/* @var $form TbActiveForm */ 
?>

<div class="form"> 

    <?php
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array( 
    'id'=>'user-login-form', 
    // Please note: When you enable ajax validation, make sure the corresponding 
    // controller action is handling ajax validation correctly. 
    // There is a call to performAjaxValidation() commented in generated controller code. 
    // See class documentation of CActiveForm for details on this. 
    'enableAjaxValidation'=>false, 
)); ?>

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'username',array('span'=>5,'maxlength'=>24)); ?>

            <?php echo $form->textFieldControlGroup($model,'password',array('span'=>5,'maxlength'=>64)); ?>

            <?php echo $form->checkBoxControlGroup($model,'remember_me',array('span'=>5,'maxlength'=>64)); ?>

            <?php if(IsSet(Yii::app()->user->viewCaptcha)) : ?>
            <div class="row">
                <?php if(extension_loaded('gd')): ?>
                    <div class="hint">
                        <?php echo Hqh::t('You performed more than 3 tries.'); ?><br />
                        <?php echo Hqh::t('Enter the CAPTCHA code.');?>
                    </div>
                    <?php $this->widget('CCaptcha',array('clickableImage'=>true,'showRefreshButton'=>false,'imageOptions'=>array('border'=>"1"))); ?>
                    <div class="hint">
                        <?php echo Hqh::t('Click on the image to refresh CAPTCHA code.');?>
                    </div>
                    <?php echo $form->textField($model,'verify_code'); ?>
                    <?php echo $form->error($model,'verify_code');?>
                <?php endif; ?>
            </div>
     <?php endif; ?>


        <div>
        <?php echo TbHtml::submitButton('Log In',array( 
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY, 
            'size'=>TbHtml::BUTTON_SIZE_LARGE, 
        )); ?>
    </div> 

    <?php $this->endWidget(); ?>

</div><!-- form -->