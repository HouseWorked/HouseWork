<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
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
<!--                --><?//= Yii::$app->getSecurity()->generatePasswordHash("111")?>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                <div class="form-group">
                                    <input type="email" id="loginform-email" class="input-material" name="LoginForm[email]" aria-required="true" aria-invalid="true">
                                    <label class="label-material" for="loginform-email">Email</label>
                                    <p class="help-block help-block-error"></p>
                                </div>
                            <div class="form-group">
                            </div>
                                <div class="form-group">
                                    <input type="password" id="loginform-password" class="input-material" name="LoginForm[password]" aria-required="true" aria-invalid="true" >
                                    <label class="label-material" for="loginform-password">Пароль</label>
                                    <p class="help-block help-block-error"></p>
                                </div>
<!--                            --><?//= $form->field($model, 'rememberMe')->checkbox() ?>
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            <?php ActiveForm::end(); ?>
                            <a href="#" class="forgot-pass">Forgot Password?</a><br><small>Еще нет аккаунта? </small><a href="<?= Url::to(['login/register'])?>" class="signup">Зарегестрироваться</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>Design by <a href="https://bootstrapious.com/admin-templates" class="external">Bootstrapious</a></p>
    </div>
</div>
<style>
    @-webkit-keyframes autofill {
        to {
            color: #8a8d93;
            background: transparent;
        }
    }

    input:-webkit-autofill {
        -webkit-animation-name: autofill;
        -webkit-animation-fill-mode: both;
    }
</style>