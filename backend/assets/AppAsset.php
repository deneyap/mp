<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle {
	
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/datepicker/css/bootstrap-datepicker.css',
    	'css/fontawesome-all.min.css',
    	'css/bootstrap.css',
    	'css/authentication.css',
    	'css/app.css',
    	'css/corporate.css',
    	'css/ui.css',
        'css/dashboard.css',
        'css/ionicons.css'
    ];
    public $js = ['js/popper.js','js/bootstrap.min.js','js/inputmask/dist/jquery.inputmask.bundle.js','js/datepicker/js/bootstrap-datepicker.min.js','js/main.js'];
    public $depends = ['yii\web\YiiAsset', 'yii\bootstrap4\BootstrapAsset'];
    
}