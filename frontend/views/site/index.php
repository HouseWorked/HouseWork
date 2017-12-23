<?php

/* @var $this yii\web\View */

$this->title = 'Панель управления(crm)';


use yii\helpers\Url;
use app\helpers\FileHelper;
?>
<div id="p_prldr"><div class="contpre"><span class="svg_anm"></span><br>Подождите<br><small>идет загрузка</small></div></div>
<div class="wrapper">
    <div class="content">
        <?php
        var_dump(Yii::$app->user->can('project_manager'));
        var_dump(Yii::$app->user->can('director'));
        var_dump(Yii::$app->user->can('developer'));

        ?>
        <div class="container_windows">
            <div class="windows_panel" style="background: grey;">
                <div style="margin-left: 0" id="back_windows" data-type="">Назад</div>
                <div style="margin-left: 95%" id="close_windows">Закрыть</div>
            </div>
            <div class="content_windows" style="background: white">

            </div>
        </div>
    </div>
    <div class="footer">
        <div class="menu">
            <div class="panel">
                <div class="user-img">
                    <img src="<?= FileHelper::getImageThumb('/images/images-ava/avatar-1.jpg', 50, 50); ?>" alt="" style="margin: 5px">
                </div>
                <div class="panel-settings">
                    <ul>
                        <li><a class="popup-with-zoom-anim" href="#text-popup-anim"><img src="<?= FileHelper::getImageThumb('/images/static/settings.png', 50, 50); ?>" alt="" id="modal_main_settings"></a></li>
                        <li><img src="<?= FileHelper::getImageThumb('/images/static/fullscreen.png', 50, 50); ?>" alt="" id="fullscreen"></li>
                        <li><a href="<?= Url::to(['/login/logout']) ?>"><img src="<?= FileHelper::getImageThumb('/images/static/exit.png', 50, 50); ?>"></a></li>
                    </ul>
                </div>
            </div>
            <div class="list-wrapper">
                <div class="list" data-type="site">
                    Сайты
                </div>
                <div class="list" data-type="project">
                    Проекты
                </div>
                <div class="list" data-type="staff">
                    Персонал
                </div>
                <div class="list" data-type="fin">
                    Финансы
                </div>
                <div class="list" data-type="bid">
                    Заявки
                </div>
                <div class="list" data-type="company">
                    Компании
                </div>
                <div class="list" data-type="ad">
                    Рекламный блок
                </div>
            </div>
            <div class="search">
                <input type="text" placeholder="seacrh..." name="search">
            </div>
        </div>
        <img src="images/menu.png" alt=",enu" width="40" height="40" style="margin-left: 5px" id="toggle_menu">
    </div>
</div>


<!-- Модалка -->
<div id="text-popup-anim" class="zoom-anim-dialog white-popup mfp-hide" style="margin-top: -10%">
    <p style="text-align: right;"><a class="popup-modal-dismiss" href="#">Закрыть</a></p>
    <h3>Диалоговое окно</h3>
    <p>You won't be able to dismiss this by usual means (escape or
        click button), but you can close it programatically based on
        user choices or actions.</p>
</div>
















