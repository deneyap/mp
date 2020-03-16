<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle {
	
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = ['css/bootstrap.css','css/site.css'];
    public $js = ['js/jquery.min.js','js/bootstrap.min.js','js/main.js'];
    public $depends = ['yii\bootstrap4\BootstrapAsset'];
}