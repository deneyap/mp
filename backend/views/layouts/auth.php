<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use backend\assets\fonts\Roboto;

Roboto::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language; ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags(); ?>
    <title><?php echo Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
	<?php echo $content; ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>