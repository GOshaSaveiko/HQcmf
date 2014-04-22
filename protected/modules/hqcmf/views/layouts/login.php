<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Google webfonts-->
    <link href='http://fonts.googleapis.com/css?family=Squada+One' rel='stylesheet' type='text/css' />

    <!-- CMFia -->
    <?php
        Yii::app()->controller->module->bootstrap->register();
        $cs=Yii::app()->getClientScript();
        $cs->registerCssFile(Yii::app()->controller->module->shared.'/css/styles.css');
    ?>
</head>
<body>

    <div class="container-fluid">
		<?php echo $content; ?>

        <footer>
            <p>HQCmf v<?php echo Yii::app()->controller->module->VersionCMF;?> - Content management framework =) </p>
        </footer>

    </div><!--/.fluid-container-->
</body>
</html>