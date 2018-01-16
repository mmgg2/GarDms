<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.


//$model=Config::model()->findByPk(1);

//var_dump($model->db_name);


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Gestor test',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.yiiext.zii.widgets.grid.imageColumn.EImageColumn'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),
        'language'=>'es',
	// application components
	'components'=>array(
	    'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        //'class' => 'WebUser',
		),
            'format' => array(
                    'datetimeFormat'=>"d M, Y h:m:s a",
            ),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=gestorDoc',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'admin2017',
			'charset' => 'utf8',
			'schemaCachingDuration' => 86400
		),

		'authManager'=>array(
		'class'=>'CDbAuthManager',
		'connectionID'=>'db',
		),
		'cache'=>array(
		'class'=>'system.caching.CFileCache',
		//'class'=>'CApcCache',
		),
		//'apcCache'=>array(
		//'class'=>'system.caching.CFileCache',
		//'class'=>'CApcCache',
		//),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace, info',
				),
				// uncomment the following to show log messages on web pages

				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'maximiliano.german@gmail.com',
	),
);
