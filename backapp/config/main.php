<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'乐荟网后台管理系统',
    'language'=>'zh_cn',
	// preloading 'log' component
	'preload'=>array('log'),
    'theme'=>'backend',
    
	// autoloading model and component classes
    'aliases'=>array(
            'models'=>LIBRARY.DIRECTORY_SEPARATOR.'models',
        'services'=>LIBRARY.DIRECTORY_SEPARATOR.'services',
    ),
	'import'=>array(
		'models.*',
        'services.*',
        'models.base.*',
		'application.components.*',
        'application.extensions.*',
        'application.extensions.validator.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>false,
		),
        'api',
	),

	// application components
	'components'=>array(
        //enable CSRF check
        'request'=>array(
            'class' => 'application.components.EHttpRequest',
            'enableCsrfValidation'=>true,
            'enableCookieValidation'=>true,
        ),
		'user'=>array(
            'allowAutoLogin'=>true,
            //'class'=>'WebUser',
            'authTimeout'=>'86400',
            'loginUrl'=>array('/site/login'),
        ),
        /*'redis'=>array(
            'class'=>'RidisService',
        ),*/
        'phpThumb'=>array(
            'class'=>'ext.EPhpThumb.EPhpThumb',
        ),
		// uncomment the following to enable URLs in path-format
		'setting'=>array(
            'class'=>'SettingComponet',
        ),
		'urlManager'=>array(
			'urlFormat'=>'path',   
                         'showScriptName'=>false,
			//'urlSuffix' => '.html',			
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
                                '<controller:\w+>/<action:\w+>/<id:\d+>/<type:\d+>/<source:\w+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
           
		),
	
		// uncomment the following to use a MySQL database		
		'db'=>array(
			'connectionString' => 'mysql:host=10.105.14.92;dbname=skg_home',
			'emulatePrepare' => true,
			'username' => 'martin',
			'password' => '123456',
			'charset' => 'utf8',
		),
		'ucenter'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=121.14.195.223;dbname=lehuidb',
			'emulatePrepare' => true,
			'username' => 'lehuidb',
			'password' => '@lehuidb_123546',
			'charset' => 'utf8',
            'schemaCachingDuration'=>'86400',
		),
		'logSQL'=>array(
             'class'=>'system.db.CDbConnection',
             'connectionString'=>'sqlite:'.BASE_PATH.'/runtime/log-1.1.13.db',
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'default/error',
		),
       /* 'cache'=>array(
            'class'=>'CMemCache',
                'servers'=>array(
                    array(
                        'host'=>'127.0.0.1',
                        'port'=>11211,
                        'weight'=>60,
                    ),
                ),
        ),*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
                     'class'=>'CDbLogRoute',
                     'levels'=>'trace, info',
                     'categories'=>'system.*',
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
		'adminEmail'=>'webmaster@example.com',
        //用户密码混合KEY
        'loginCodeKey'=>'bbs13Abc2',
        //authcode加密KEY
        'authcode'=>'4a9RKSx83FBAPAPx',
        'adminName'=>'admin',
        //文件上传目录KEY
        'routeAllow'=>array('user','editor','article','investment','meet','eminent','advertising','slide','life','celebrity','trade','community','study','mation','news','shop'),
	),
);
