<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use backend\forms\LoginForm;

class SiteController extends Controller {

    public $isGuest = true;
    public $admin = null;
    public $menus = null;

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex() {
        return $this->redirect('/dashboard');
    }

    public function actionLogin() {
        $this->layout = 'auth';
        $model = new LoginForm();

        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/dashboard');
        }

        if(\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->login()) {
                return $this->redirect('/dashboard');
            }
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }


    public function actionErr() {
        $this->layout = 'error';
        $this->enableCsrfValidation = false;
        return $this->render('error');
    }    

}
