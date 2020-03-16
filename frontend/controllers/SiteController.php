<?php
namespace frontend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\base\InvalidArgumentException;

class SiteController extends BaseController {

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex() {
        $request = Yii::$app->request;
        return $this->render('index');
    }

    public function actionTur($sehir = null, $turId = null) {
        $request = Yii::$app->request;
        return $this->render('tur', ['sehir' => $sehir, 'turId' => $turId]);
    }

    public function actionTurlar($sehir = null) {
        $request = Yii::$app->request;
        return $this->render('turlar', ['sehir' => $sehir]);
    }

}
