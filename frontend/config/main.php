<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'Ukrdeveloper.pro',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => [
        'log',
//        'frontend\components\UserData'
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
            'cookieValidationKey' => 'sdi8s#fnj98jwiqiw;qfh!fjgh0d8f',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,

            'rules' => [
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'project',
                    'pluralize'=>false],
                '' => '/',
                '<controller:(about|login|my-page)>' => 'site/index',
                '<controller:(\w|-)+>/' => '<controller>/index',
                '<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:(\w|-)+>' => '<module>/<controller>/<action>',
                '<controller:\w+>/<action:(\w|-)+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
