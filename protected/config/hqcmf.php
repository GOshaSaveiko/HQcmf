<?php
return
	array(
//            'theme'=>'dark',
            'modules'=>array(
                'users'=>array('class'=>'hqcmf.modules.users.usersModule',
                'defaultController'=>'UsersModule')
            ),
            'defaultController'=>'Core',
            'aliases'=>array(
            	'hqcmf'=> 'application.modules.hqcmf',
            	'bootstrap' => 'hqcmf.extensions.bootstrap'
            ),

            'import' => array(
            	'hqcmf.models.*',
            	'hqcmf.components.*',
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
                'user' => array(
                    'class' => 'CMFUser',
                    'loginUrl'=>array('hqcmf/core/login'),
                ),
    		),

	);