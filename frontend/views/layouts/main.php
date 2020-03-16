<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$this->beginPage() 
?><!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
	<div><h1>HEADER</h1></div>
<?php $this->beginBody() ?>
    <?php echo $content ?>
<?php $this->endBody() ?>
	<div><h1>FOOTER</h1></div>
</body>
</html>
<?php $this->endPage() ?>