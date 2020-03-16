<?php

$dbName = "fugo";
$dbUser = "fugo";
$dbPass = "fugo";

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'setting' => [
            'class' => 'components\Setting',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname='. $dbName .'',
            'username' => $dbUser,
            'password' => $dbPass,
            'charset' => 'utf8',
        ],
        'email' => 'components\Mailer',
    ],
];
