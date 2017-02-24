<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'yyuAPmXh5YH7OPPbcKv5nEvFZVIY5bGC',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        /**/
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'link/save' => 'link/save',
                'stat' => 'stat/index',
                '<controller:[0-9a-zA-Z\-\.]+>' => 'link/index',
            ],
        ],
        'ttl' => [
            'class' => 'app\components\TtlComponent',
        ],
        'Stat' =>[
           'class' => 'app\componets\StatComponent',
        ],
        'geolocation' => [
            'class' => 'rodzadra\geolocation\Geolocation',
            'config' => [
                'provider' => '[PLUGIN_NAME]',
                'format' =>  '[SUPORTED_PLUGIN_FORMAT]',
                'api_key' => '[YOUR_API_KEY]',
        ],
        'userAgent' => [
            'class' => 'app\components\UserAgent'
        ],
    ],
    ],
    'params' => $params,
    'defaultRoute' => 'link/index',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1','*'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1','*'],
    ];
}

return $config;
