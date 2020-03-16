<?php

$config = [
    'id' => 'app-backend',
    'language' => 'tr',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
       'dynagrid'=> [
            'class'=>'\kartik\dynagrid\Module',
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
    ],
    'components' => [
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '<controller>/<action>' => '<controller>/<action>',
                '<controller>/<action>/<id:\w+>' => '<controller>/<action>',
            ],
        ],
        'Helper' => [
            'class' => 'components\Helper',
        ],
        'request' => [
            'enableCsrfValidation' => true,
            'csrfParam' => '_csrf-mngr',
            'cookieValidationKey' => '459dkg9495sMMAs5949QvIesh2Qw-5E-fEKkO2JqV6a0bfU02tGq',
        ],
        'user' => [
            'identityClass' => 'backend\models\Admin',
            'enableAutoLogin' => false,
        ],
        'session' => [
            'name' => 'bgbnty-bcknd',
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
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat' => 'php:d/m/Y H:i:s',
            'timeFormat' => 'php:H:i:s'
        ],
        'i18n'=>array(
            'translations' => array(
                '*'=>array(
                    'class' => 'common\models\LanguageBase',
                    'sourceMessageTable' => '{{%language_source}}',
                    'messageTable' => '{{%language_message}}',
                    'db' => 'db'
                )
            )
        ),
        'errorHandler' => [
            'errorAction' => 'site/err',
        ]
    ],
    'params' => [
        'domain' => 'http://bugbounty.com.tr:443'
    ],
];

return $config;