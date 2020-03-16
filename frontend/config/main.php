<?php

$appKey = "FUGO";

$config = [
    'id' => 'app-frontend',
    'language' => 'tr',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['gii'],
    'modules' => ['gii' => ['class' => 'yii\gii\Module']],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
    ],
    'components' => [
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                'melih/penez' => 'site/test',
                'turlar/<sehir:\w+>' => 'site/turlar',
                'turlar/<sehir:\w+>/<turId:\d+>' => 'site/tur',
                'user/activation/<token:\w+>' => 'user/activation',
                'user/reset-password/<token:\w+>' => 'user/reset-password',
                'p/<username:\w+>' => 'user/view',
                'user/bounty/<bountyId:\d+>' => 'user/bounty',
                'user/create-report/<bountyId:\d+>' => 'user/create-report',
            ],
        ],
        'request' => [
            'enableCsrfValidation' => true,
            'csrfParam' => '_csrf-'. $appKey,
            'cookieValidationKey' => '31e6awfkOclQvIesh2Qw-5E-fEKkO2JqV6a0bfU02tGq',
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => false,
        ],
        'session' => [
            'name' => $appKey .'-frntnd',
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
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'no-reply@tappo.com',
                'password' => '123456',
                'port' => '587',
                'encryption' => 'tls',
            ]
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat' => 'php:d/m/Y H:i:s',
            'timeFormat' => 'php:H:i:s'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ]
    ],
    'params' => [
        'domain' => 'http://frontend.tappo.com'
    ],
];

return $config;