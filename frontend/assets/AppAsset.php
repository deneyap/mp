<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle {
	
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    	'css/vendor/bootstrap.min.css',
    	'css/vendor/cerebrisans.css',
    	'css/vendor/fontawesome-all.min.css',
    	'css/plugins/swiper.min.css',
    	'css/plugins/animate-text.css',
    	'css/plugins/lightgallery.min.css',
    	'css/style.css'
    ];
    public $js = [
    	'js/vendor/modernizr-2.8.3.min.js',
    	'js/vendor/jquery-3.3.1.min.js',
    	'js/vendor/bootstrap.min.js',
		'js/plugins/swiper.min.js',
		'js/plugins/lightgallery.min.js',
		'js/plugins/waypoints.min.js',
		'js/plugins/countdown.min.js',
		'js/plugins/isotope.min.js',
		'js/plugins/masonry.min.js',
		'js/plugins/images-loaded.min.js',
		'js/plugins/wavify.js',
		'js/plugins/jquery.wavify.js',
		'js/plugins/circle-progress.min.js',
		'js/plugins/counterup.min.js',
		'js/plugins/wow.min.js',
		'js/plugins/animation-text.min.js',
		'js/plugins/vivus.min.js',
		'js/plugins/some-plugins.js'
    ];
    public $depends = ['yii\bootstrap4\BootstrapAsset'];
}