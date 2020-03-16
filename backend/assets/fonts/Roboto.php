<?php

namespace backend\assets\fonts;

use yii\web\AssetBundle;

class Roboto extends AssetBundle {
	
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = ['//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=latin-ext'];
    public $cssOptions = ['type' => 'text/css'];
    
}