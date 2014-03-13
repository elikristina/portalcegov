<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'SIPESQ',

	'language'=>'pt',

	// preloading 'log' component	
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.models.forms.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gorder',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		//PDF Extension
		'ePdf' => array(
        			'class'         => 'ext.yii-pdf.EYiiPdf',
        			'params'        => array(
			            'mpdf'     => array(
			                'librarySourcePath' => 'application.vendors.mpdf.*',
			                'constants'         => array(
			                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
			                ),
			                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
			            ),
			            
			            'HTML2PDF' => array(
			                'librarySourcePath' => 'application.vendors.html2pdf.*',
			                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
			            )
			        ),
    	),
    	
		'format'=>array(
				'class'=>'application.components.Formatter',
		),
		
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'caseSensitive'=>false, 
			//'showScriptName'=>false,
			'rules'=>array(
				'projeto/despesas/<id:\d+>'=>'projetoDespesa/view',
				'projeto/despesas/<action:\w+>/<id:\d+>'=>'projetoDespesa/<action>',
				'projeto/despesas/<action:\w+>'=>'projetoDespesa/<action>',
						
				'projeto/receitas/<id:\d+>'=>'projetoVerba/view',
				'projeto/receitas/<action:\w+>/<id:\d+>'=>'projetoVerba/<action>',
				'projeto/receitas/<action:\w+>'=>'projetoVerba/<action>',
				
		
				'projeto/rubricas'=>'rubrica',
				'projeto/rubricas/<action:\w+>'=>'rubrica/<action>',
				'projeto/rubricas/<action:\w+>/<id:\d+>'=>'rubrica/<action>/<id>',
		
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			
			),
		),
		
		/*
		
		//Banco de dados de produção
		'db'=>array(
			'connectionString' => 'pgsql:host=143.54.64.104;port=5432;dbname=sipesq',
			'emulatePrepare' => true,
			'username' => 'postgres',
			'password' => 'ecepik',
			'charset' => 'utf8',
		),
		*/
		// Banco de dados de desenvolvimento
		'db'=>array(
			'connectionString' => 'pgsql:host=localhost;port=5432;dbname=sipesq',
			//'emulatePrepare' => true, //causa bug na conversao de boolean
			'username' => 'postgres',
			'password' => 'cegovbrasil',
			'charset' => 'utf8',
		), 
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'grsevero@gmail.com',
		'admins'=>array('grsevero', 'eduardo.u.bueno', 'mcepik','admin', 'pedro.txai', 'gustavom_moller'),
	),
	
);
