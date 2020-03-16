<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use components\Helper;

use backend\services\BountyServices;
use backend\services\UserServices;
use backend\services\FirmServices;
use backend\services\ReportServices;

class DashboardController extends BaseController {

    public function actionIndex() {
        if(true === \Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        } else {
			// $mailer = Yii::$app->getMailer();
			// $mailer->htmlLayout = 'layouts/site';
			// $mailer->setViewPath('common\mail');
			// $mailer->setView(['test']);
			// $mailer->setTo('mehmet.aydogmus@uitsec.com');
   //      	//$mailer->setTo('mehmet.aydogmus@uitsec.com');
   //      	print_r($mailer);
   //      	exit();
   //      	\Yii::$app->mailer
   //      		//->useTransport('smtp-1')
   //      		->compose('test', ['token' => 'MERHABA DÜNYA'])
   //      		->setTo('mehmet.aydogmus@uitsec.com')
   //      		->setSubject('Hi')
   //      		->send();

	        $counter = [
	            'bountyTotal' => BountyServices::count(),
              'bountyActive' => BountyServices::countByActive(),
	            'userActive' => UserServices::countByActive(),
              'userPending' => UserServices::countByUnapproved(),
	            'firmActive' => FirmServices::countByActive(),
              'firmPending' => FirmServices::countByUnapproved(),
	            'reportTotal' => ReportServices::count(),
              'reportPending' => ReportServices::countByPending(),
	        ];
          $reports = ReportServices::listByPending(10);
          $bounties = BountyServices::listByPending(10);
          $firms = FirmServices::listByPendingCofirm(10);
	        return $this->render('index', 
            [
              'counter' => Helper::response($counter),
              'reports' => $reports,
              'bounties' => $bounties,
              'firms' => $firms
            ]
          );
        }
    }

}
