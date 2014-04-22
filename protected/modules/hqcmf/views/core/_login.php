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

    <p class="help-block">Fields with <span class="required">*</span> are required.</p> 

    <?php echo $form->errorSummary($model); ?>

            <?php echo $form->textFieldControlGroup($model,'username',array('span'=>5,'maxlength'=>24)); ?>

            <?php echo $form->textFieldControlGroup($model,'password',array('span'=>5,'maxlength'=>64)); ?>

            <?php if(IsSet($_SESSION['logintry']) && $_SESSION['logintry']>=3): ?>
            <div class="row">
                <?php if(extension_loaded('gd')): ?>
                    <div class="hint"><?php echo Hqh::t('You performed more than 3 tries.'); ?><br /><?php echo Hqh::t('Enter the CAPTCHA code.');?></div>
                    <?php $this->widget('CCaptcha',array('clickableImage'=>true,'showRefreshButton'=>false,'imageOptions'=>array('border'=>"1"))); ?>
                    <div class="hint"><?php echo Hqh::t('Click on the image to refresh CAPTCHA code.');?></div>
                    <?php echo $form->textField($model,'verifyCode'); ?>
                    <?php echo $form->error($model,'verifyCode');?>
                <?php endif; ?>
            </div>
     <?php endif; ?>


        <div class="form-actions"> 
        <?php echo TbHtml::submitButton('Log In',array( 
            'color'=>TbHtml::BUTTON_COLOR_PRIMARY, 
            'size'=>TbHtml::BUTTON_SIZE_LARGE, 
        )); ?>
    </div> 

    <?php $this->endWidget(); ?>

</div><!-- form -->