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
        $cs->registerCssFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('hqcmf.assets')).'/css/styles.css');
    ?>
</head>
<body>
<?php
    $this->widget('bootstrap.widgets.TbNavbar',array(
            'brandLabel'=>'<span class="cmf-logo-cl">CMF</span>ia',
            'brandUrl'=>'/',
            'fluid'=>true,
            'collapse'=>true,
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbNav',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>TbHtml::menuDivider(array('class'=>'divider-vertical'))),
                        array('label'=>TbHtml::icon('icon-fire icon-white').'&nbsp;Burner&nbsp;'.TbHtml::badge(0,array('class'=>'badge-important')), 'url'=>'#'),
                        array('label'=>TbHtml::icon('icon-envelope icon-white').'&nbsp;Messages&nbsp;'.TbHtml::badge(0,array('class'=>'badge-info')), 'url'=>'#'),
                    ),
                ),
                array(
                    'class'=>'bootstrap.widgets.TbNav',
                    'htmlOptions'=>array('class'=>'pull-right'),
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>TbHtml::icon('icon-info-sign icon-white').'&nbsp;Info&nbsp;',
                              'items'=>array(
                                    array('label'=>TbHtml::icon('icon-question-sign').'&nbsp;About','url'=>'#'),
                                    array('label'=>TbHtml::menuDivider()),
                                    array('label'=>TbHtml::icon('icon-bullhorn').'&nbsp;CMFia news','url'=>'#'),
                              )
                        ),
                        array('label'=>TbHtml::icon('icon-cog icon-white').'&nbsp;Settings&nbsp;',
                              'items'=>array(
                                  array('label'=>TbHtml::icon('icon-user').'&nbsp;Users','url'=>'#'),
                                  array('label'=>TbHtml::icon('icon-list-alt').'&nbsp;Modules','url'=>'#'),
                                  array('label'=>TbHtml::icon('icon-wrench').'&nbsp;Maintenance','url'=>'#'),
                                  array('label'=>TbHtml::icon('icon-list').'&nbsp;System Log','url'=>'#'),
                                  array('label'=>TbHtml::menuDivider()),
                                  array('label'=>TbHtml::icon('icon-cog').'&nbsp;System settings','url'=>'#'),
                              )
                        ),
                        array('label'=>TbHtml::menuDivider(array('class'=>'divider-vertical'))),
                        array('label'=>TbHtml::icon('icon-user icon-white').'&nbsp;Info&nbsp;',
                            'items'=>array(
                                array('label'=>TbHtml::icon('icon-briefcase').'&nbsp;Profile','url'=>'#'),
                                array('label'=>TbHtml::menuDivider()),
                                array('label'=>TbHtml::icon('icon-off').'&nbsp;Settings','url'=>'#'),
                            )
                        ),
                    ),
                ),
            )
        )

    );
?>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="left-menu span2">
                <div class="well sidebar-nav">
                    <?php
                        $this->widget('bootstrap.widgets.TbNav',array(
                           'htmlOptions'=>array('class'=>
                                                    'nav-list',
                           ),
                           'items'=>array(
                               array('label'=>'Sidebar'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Sidebar'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Sidebar'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                               array('label'=>'Link','url'=>'#'),
                           ),
                        ));
                    ?>
                </div><!--/.well -->
            </div><!--/span-->
            <div class="content span10">

                <div class="row-fluid">
                    <hgroup>
                        <h1><?php echo $this->getPageTitle(); ?></h1>
                    </hgroup>
                    <hr/>
                </div>
                <div class="row-fluid">
                    <?php
                        echo $content;
                    ?>
                </div>
            </div><!--/span-->
        </div><!--/row-->

        <hr>

        <footer>
            <p>CMFia v.0.1 - Content management framework =)</p>
        </footer>

    </div><!--/.fluid-container-->
</body>
</html>