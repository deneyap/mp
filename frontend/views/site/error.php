<?php
use yii\helpers\Html;
$this->title = $name;
?>
    <div class="overflow-hidden">
        <div class="container d-flex align-items-stretch ui-mh-100vh p-0">
            <div class="row w-100">
                <div class="d-flex col-md justify-content-center align-items-center order-2 order-md-1 position-relative p-5">
                    <div class="error-bg-skew bg-white"></div>
                    <div class="text-md-left text-center">
                        <h1 class="display-2 font-weight-bolder mb-4"><?php echo $this->context->module->controller->action->defaultName; ?></h1>
                        <a href="/" class="btn btn-primary">←&nbsp; Anasayfa</a>
                    </div>
                </div>
                <div class="d-flex col-md-5 justify-content-center align-items-center order-1 order-md-2 text-center text-white p-5">
                    <div>
                        <div class="error-code font-weight-bolder mb-2"><?php echo Yii::$app->errorHandler->exception->statusCode; ?></div>
                        <div class="error-description font-weight-light"><?php echo $message; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>