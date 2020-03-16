<?php

defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', true );
defined( 'YII_ENV' ) or define( 'YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../config/main.php')
);

(new yii\web\Application($config))->run();


switch (YII_ENV) {
  case 'prod':
    $envLabel = 'PRODUCTION';
    $envColor = 'success';
    break;

  case 'test':
    $envLabel = 'TEST';
    $envColor = 'warning';
    break;

  default:
    $envLabel = 'DEVELOPER';
    $envColor = 'danger';
    break;
}
echo "<div style=\"opacity:0.9; position: fixed; right: 0px; bottom: 0px; padding: 10px 15px; background-color: #2e323a; border-radius: 3px 0px 0px 0px;\" class=\"text-light font-weight-bold mr-3 float-left\"><span class=\"font-weight-bolder mr-3\">YAYIN TİPİ :</span><span class=\"badge badge-$envColor\">$envLabel</span></div>";
