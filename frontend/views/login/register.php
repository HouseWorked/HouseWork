<?php
use yii\helpers\Url;
?>
<div class="page login-page">
  <div class="container d-flex align-items-center">
    <div class="form-holder has-shadow">
      <div class="row">
        <!-- Logo & Information Panel-->
        <div class="col-lg-6">
          <div class="info d-flex align-items-center">
            <div class="content">
              <div class="logo">
                <h1>Dashboard</h1>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
        <!-- Form Panel    -->
        <div class="col-lg-6 bg-white">
          <div class="form d-flex align-items-center">
            <div class="content">
              <form id="register-form">
                <div class="form-group">
                  <input id="register-username" type="text" name="registerUsername" required class="input-material">
                  <label for="register-username" class="label-material">Имя</label>
                </div>
                <div class="form-group">
                  <input id="register-lastname" type="text" name="registerLastname" required class="input-material">
                  <label for="register-lastname" class="label-material">Фамилия</label>
                </div>
                <div class="form-group">
                  <input id="register-email" type="email" name="registerEmail" required class="input-material">
                  <label for="register-email" class="label-material">Email</label>
                </div>
                <div class="form-group">
                  <input id="register-passowrd" type="password" name="registerPassword" required class="input-material">
                  <label for="register-passowrd" class="label-material">Пароль</label>
                </div>
                <div class="form-group terms-conditions">
                  <input id="license" type="checkbox" class="checkbox-template">
                  <label for="license">Agree the terms and policy</label>
                </div>
                <input id="register" type="submit" value="Register" class="btn btn-primary">
              </form><small>У вас уже есть аккаунт? </small><a href="<?= Url::to(['login/index'])?>" class="signup">Вход</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="copyrights text-center">
    <p>Design by <a href="https://bootstrapious.com" class="external">Bootstrapious</a></p>
  </div>
</div>