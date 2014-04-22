<?php
return
	array(
//            'theme'=>'dark',
            //pages that not require login
            'modules'=>array(
                'users'=>array(
                    'class'=>'hqcmf.modules.users.UsersModule',
                    'defaultController'=>'UsersModule'
                )
            ),
            'defaultController'=>'Core',
            'aliases'=>array(
            	'hqcmf'=> 'application.modules.hqcmf',
            	'bootstrap' => 'hqcmf.extensions.bootstrap'
            ),

            'import' => array(
            	'hqcmf.models.*',
            	'hqcmf.components.*',
              //  'hqcmf.models.*',
            	'bootstrap.helpers.*',
                'bootstrap.behaviors.*',
    		),
		    // application components
    		'components' => array(
	        	'bootstrap' => array(
    	        	'class' => 'bootstrap.components.TbApi',   
        		),
        		'errorHandler' => array(
                        'errorAction' => 'hqcmf/core/error',
                ),
                'hquser' => array(
                    'class' => 'HqUser',
                    'loginUrl'=>array('hqcmf/core/login'),
                ),

    		),

	);