<?php
return
	array(
            'defaultController'=>'Core',
            'aliases'=>array(
            	'hqcmf'=> 'application.modules.hqcmf',
            	'bootstrap' => 'hqcmf.extensions.bootstrap'
            ),

            'import' => array(
            	'hqcmf.models.*',
            	'hqcmf.conponents.*',
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