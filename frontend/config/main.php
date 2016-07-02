<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name'=>'nRefer',
    'language'=>'th',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
    	    'enablePrettyUrl' => true,
    	    'showScriptName' => false,
    	    'rules' => array(
        		'<controller:\w+>/<id:\d+>' => '<controller>/view',
        		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        		'module/<module:\w+>/<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    	    ),
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '',
        ],
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'Input your Google API Key',
                        //'language' => 'th',
                        'version' => '3.1.18'
                    ]
                ]
            ]
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => false,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin','pck']
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1','localhost'],
        ],
        'debug' => [
    		'class' => 'yii\debug\Module',
    		'allowedIPs' => ['127.0.0.1', '::1']
        ],
        'ws' => [
            'class' => 'app\modules\ws\Module',
        ],
        'refer' => [
            'class' => 'app\modules\refer\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'webservice' => [
            'class' => 'app\modules\webservice\Modules',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
    ],
    'params' => $params,
];
