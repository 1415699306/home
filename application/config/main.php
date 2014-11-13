<?php
define('UC_CONNECT', 'mysql');
define('UC_DBHOST', '121.14.195.223');
define('UC_DBUSER', 'lehuidb');
define('UC_DBPW', '@lehuidb_123546');
define('UC_DBNAME', 'lehuidb');
define('UC_DBCHARSET', 'utf8');
define('UC_DBTABLEPRE', '`lehuidb`.pre_ucenter_');
define('UC_DBCONNECT', '0');
define('UC_KEY', '4c9dTPefDC3J0AkZe4TVz0NCdATxURoqI7BA9+o');
define('UC_API', 'http://quanzi.lfeel.com/uc_server');
define('UC_CHARSET', 'utf-8');
define('UC_IP', '');
define('UC_APPID', '2');
define('UC_PPP', '20');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'乐荟网',
    'language'=>'zh_cn',
	// preloading 'log' component
	'preload'=>array('log'),
    'theme'=>'website',
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
		
		/*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>false,
		),
        'backend'=>array(
            'adminName'=>'admin',
        ),*/
        'api',   
        'trade',
        'article',
        'shop',
        'usercenter',
	),

	// application components
	'components'=>array(
        'alipay'=>array(
            'class'=>'application.vendors.alipay.AlipayProxy',
            'key'=>'8ny1supd78ea92or8tnd16i650nbhmcf',
            'partner'=>'2088901555548905',
            'seller_email'=>'caiwu@lfeel.com',
            'return_url'=>'http://www.lfeel.com/pay/return',
            'notify_url'=>'http://www.lfeel.com/pay/notify',
            'show_url'=>'url for product detail',
        ),
        //enable CSRF check
        'request'=>array(
            'class' => 'application.components.EHttpRequest',
            'enableCsrfValidation'=>true,
            'enableCookieValidation'=>true,
        ),
	/*	'redis'=>array(
            'class'=>'RidisService',
        ),*/
		'user'=>array(
            'allowAutoLogin'=>true,
            'authTimeout'=>'86400',
            'loginUrl'=>array('/site/login'),
        ),
        'phpThumb'=>array(
            'class'=>'ext.EPhpThumb.EPhpThumb',
        ),
		// uncomment the following to enable URLs in path-format
		'setting'=>array(
            'class'=>'SettingComponet',
        ),
		'urlManager'=>array(
			'urlFormat'=>'path',      
			'urlSuffix' => '.html',			
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>/<page:\d+>'=>'<module>/<controller>/<action>',
                                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>/pay/<pledge:\d+>'=>'<module>/<controller>/<action>',
                                '<module:\w+>/<controller:payment>/<action:pay>/<order:\d+>'=>'<module>/<controller>/<action>',
                                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
			),
            'showScriptName'=>false,
		),
	
		// uncomment the following to use a MySQL database		
		'db'=>array(
			'connectionString' => 'mysql:host=10.105.14.92;dbname=skg_home',
			'emulatePrepare' => true,
			'username' => 'martin',
			'password' => '123456',
			'charset' => 'utf8',
			'schemaCachingDuration'=>'86400',
			//'queryCachingDuration' => 3600,
            //'queryCachingDependency' => null,
            //'queryCachingCount' => 2, 
            //'queryCacheID' => 'cache',
		),
		/*'ucenter'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=121.14.195.223;dbname=lehuidb',
			'emulatePrepare' => true,
			'username' => 'lehuidb',
			'password' => '@lehuidb_123546',
			'charset' => 'utf8',
            'schemaCachingDuration'=>'86400',
		),*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        /*'cache'=>array(
            'class'=>'CMemCache',
                'servers'=>array(
                    array(
                        'host'=>'127.0.0.1',
                        'port'=>11211,
                        'weight'=>60,
                    ),
                ),
        ),*/
		'fileCache'=>array(
                'class'=>'CFileCache',    
                'directoryLevel' => 2,
		),
		//'session' => array(  
         //   'class' => 'CCacheHttpSession',
       //),  
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
        //文件上传目录KEY
        'routeAllow'=>array('user','editor','article','investment','meet','eminent','advertising','slide','life','celebrity','trade','community','study','mation'),
	),
);
