<?php
namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\base\Exception;

class BaseController extends Controller {

    public $isGuest = true;
    public $user = null;

    public function init() {
        
    }

	public function behaviors() { return parent::behaviors(); }

	public function beforeAction($action) {
		if ($action->id == 'error') {
			$this->layout = 'error';
  			$this->enableCsrfValidation = false;
  			return true;
		}
		return true; 
	}

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionError() {
    	return $this->render('error');
    }

}