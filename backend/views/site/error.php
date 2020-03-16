<?php
use yii\helpers\Html;
$e = \Yii::$app->errorHandler->exception;
print_r();
?>
<center class="p-4 m-4">
    <h1 class="display-2 font-weight-bolder mb-4"><?php echo $name; ?></h1>
    <br><br>
    <div class="font-weight-bolder display-4"><?php echo $e->statusCode; ?></div>
    <br><br>
    <div class="error-description font-weight-light display-4"><?php echo $e->getMessage(); ?></div>
    <br><br>
    <a href="/" class="btn btn-primary">←&nbsp; Anasayfa</a>
</center>