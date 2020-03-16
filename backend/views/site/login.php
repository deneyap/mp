<?php 
use backend\bootstrap\ActiveForm;
?>
<div class="authentication-wrapper authentication-2 ui-bg-cover ui-bg-overlay-container px-4" style="background-image: url('/images/bg-login.jpg');">
  <div class="ui-bg-overlay bg-dark opacity-25"></div>
  <div class="authentication-inner py-5">
    <div class="card">
      <div class="p-4 p-sm-5">
        <div class="d-flex justify-content-center align-items-center pb-2 mb-4">
          <div>
            <div class="w-100 position-relative">
              <div class="text-large font-weight-bolder text-expanded"><a href="/"><img src="/img/logo-new.png" width="300"></a></div>
            </div>
          </div>
        </div>
        <?php $form = Activeform::begin(['id' => 'login-form']); ?>
        <?php echo $form->field($model, 'email', ['inputOptions' => ['placeHolder' => 'Kullanıcı Adı']])->textInput() ?>
        <?php echo $form->field($model, 'password', ['inputOptions' => ['placeHolder' => 'Şifre']])->passwordInput(['value' => '']) ?>
        <button type="submit" class="btn btn-lg btn-outline-primary btn-block font-weight-bolder">GİRİŞ</button>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>