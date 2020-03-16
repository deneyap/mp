<?php
namespace backend\bootstrap;

use Yii;
use yii\base\InvalidConfigException;

class ActiveForm extends \yii\bootstrap4\ActiveForm {
    
    public $fieldClass = 'backend\bootstrap\ActiveField';
    public $errorCssClass = 'is-invalid';
    public $successCssClass = 'is-valid';

}
