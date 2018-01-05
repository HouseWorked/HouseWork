<?php

$this->title = 'Панель управления(crm)';

use yii\helpers\Url;
use app\helpers\FileHelper;
?>
<div id="p_prldr"><div class="contpre"><span class="svg_anm"></span><br>Подождите<br><small>идет загрузка</small></div></div>
<div class="wrapper">
    <div class="content">
        
        <!-- Блоки с основной информацией-->
        <div class="main_block_info">
            <div class="widgets__view" id = "task_windows">
                <div class="block_panel_name">curent taskname <span class = "swernut">Свернуть блок</span> </div>
                <div class="block_panel_content">current task content</div>
            </div>
            <div class="widgets__view" id = "errors_windows">
                <div class="block_panel_name">errors log name <span class = "swernut">Свернуть блок</span></div>
                <div class="block_panel_content">errors log content</div>
            </div>
            <div class="widgets__view" id = "domains_windows">
                <div class="block_panel_name">overdue domains  name <span class = "swernut">Свернуть блок</span></div>
                <div class="block_panel_content">overdue domains content</div>
            </div>
        </div>
        <div class="container_windows">
            <div class="windows_panel" style="background: grey;">
                <div style="margin-left: 0" id="back_windows" class="">Назад</div>
				<div style="margin-left: 88%" id="full_browser_windows">На весь экран</div>
                <div style="margin-left: 95%" id="close_windows">Закрыть</div>
            </div>
			<input type="hidden" value="" name="project_type">
            <div class="content_windows" style="background: white">

            </div>
        </div>

    <style>
		.windows_full_screen{
			max-width: 100%;
			min-width: 99.9%;
		}
        .main_block_info{
            position: absolute;
            width: 450px;
            top: 5px;
            right: 5px;
        }
        .block_panel_name{
            background: grey;
        }
		.widgets__view{
            z-index: 1;
            background: white;
            margin-bottom: 10px;
        }
        .block_panel_content{
            padding: 5px;
        }
        .main_menu_settings{
            float: right;
            background: red;
            height: 100%;
            width: 200px;
        }
        .time{
            float: left;
            background: green;
            width: 60%;
            height: 100%;
        }
        .alerts{
            float: left;
            background: white;
            width: 80px;
        }











    </style>
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
                <div class="list" data-type="cite">
                    Управление сайтами
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
                <div class="list" data-type="chat">
                   Сообщения
                </div>
            </div>
            <div class="search">
                <input type="text" placeholder="seacrh..." name="search">
            </div>
        </div>
        <img src="images/menu.png" alt=",enu" width="40" height="40" style="margin-left: 5px" id="toggle_menu">
        <div class="main_menu_settings">
           <div class="alerts">
<!--               <img src="images/static/alerts.png" alt="">-->
				<span id = "btn_open_img_group">button</span>
				<div id = "img_main_block_info">
					<ul>
						<li class = "open_widgets" data-type = "task">1</li>
						<li class = "open_widgets" data-type = "domains">2</li>
					</ul>
				</div>
           </div>
            <div class="time">
                time
            </div>
        </div>
    </div>
</div>
<style>
.alerts{
	position: relative;
}
#img_main_block_info {
    position: absolute;
    top: -90px;
    background: beige;
    padding: 10px;
	display: none;
}
</style>
<!-- Модалка -->
<div id="text-popup-anim" class="zoom-anim-dialog white-popup mfp-hide" style="margin-top: -10%">
<!--    <p style="text-align: right;"><a class="popup-modal-dismiss" href="#">Закрыть</a></p>-->
    <h3>Диалоговое окно</h3>
    <p>You won't be able to dismiss this by usual means (escape or
        click button), but you can close it programatically based on
        user choices or actions.</p>
</div>



<?php
        var_dump(Yii::$app->user->can('project_manager'));
        var_dump(Yii::$app->user->can('director'));
        var_dump(Yii::$app->user->can('developer'));

        ?>












