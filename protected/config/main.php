<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name' => 'Offer',
    'language' => 'ru',

	// preloading 'log' component
	'preload'=>array('log', 'booster'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.library.controller.*',
        'application.library.auth.*',
        'application.library.twig-renderer.*',
		'application.library.Employee.*',
		'application.library.Helpers.*',
		'application.library.Request.*',
		'application.library.RequestType.*',
		'application.library.yiibooster.components.*',
		'application.library.swiftMailer.*',
		'application.extensions.*',
	),

	'defaultController' => 'home',

	'modules'=>array(
		'gii' => array(
			'class' => 'system.gii.GiiModule',
			'generatorPaths' => array(
				'application.gii',
			),
			'password' => '123123',
			'ipFilters' => array('*'),
		),

	),

	// application components
	'components'=>array(
		'clientScript' => array(
			'scriptMap' => array(
				'jquery.js'=>false
			),
		),

		'viewRenderer' => array(
            'class' => 'ETwigViewRenderer',
            'fileExtension' => '.twig',
            'options' => array(
                'autoescape' => true,
            )
        ),

		'booster' => array(
			'class' => 'Booster',
		),

		'swiftMailer' => array(
			'class' => 'SwiftMailer',
		),

		'user'=>array(
			'class' => 'WebUser',
			'allowAutoLogin' => true,
			'loginUrl' => array('home/login'),
		),

		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => require(dirname(__FILE__) . '/urlrules.php')
		),

		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler' => array(
			'class' => 'CErrorHandler',
			'errorAction' => 'home/error',
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

		'authManager'=>array(

			'class'=>'PhpAuthManager',
			'defaultRoles' => array('guest'),
		),

	),
	'params' => require(dirname(__FILE__) . '/params.php'),
);
