<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CEGOV',

	//select the language
	'language'=>'pt',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
    	'application.helpers.*',
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
		'ftp'=>array(
          'class'=>'application.extensions.ftp.EFtpComponent',
          'host'=>'143.54.64.51',
          //'host'=>'ftp.isape.com.br',
          'port'=>21,
          'username'=>'E_CEPIK',
          //'username'=>'isape',
          'password'=>'Equipe#2010',
          //'password'=>'ipesa123ipesa',
          'ssl'=>false,
          'timeout'=>90,
          'autoConnect'=>true,
    	),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			//'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'image'=>array(
          'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            'params'=>array('directory'=>'/opt/local/bin'),
        ),		
		/*
		'db'=>array(
			'connectionString' => 'pgsql:host=localhost;port=5432;dbname=dev_cegov',
			'emulatePrepare' => true,
			'username' => 'postgres',
			'password' => 'gorder',
			'charset' => 'utf8',
		),
		*/
		
		'db'=>array(
			'connectionString' => 'pgsql:host=bdlivre.ufrgs.br;port=5432;dbname=cegov2',
			'emulatePrepare' => true,
			'username' => 'cegov',
			'password' => '5qLceG0v',
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
		'articlePath' => Yii::app()->request->baseUrl .'/protected/data/files/articles/',
		'filePath' => Yii::app()->request->baseUrl .'/protected/data/files/',
	),
);
