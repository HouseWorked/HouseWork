<?php
\frontend\assets\ProjectAsset::register($this);
?>

<div class="container_errors">
    <div id="panel">
        <div class="main_title_errors active_content_errors" style="border-right: 1px solid black" data-type="design">Дизайн</div>
        <div class="main_title_errors" style="border-right: 1px solid black" data-type="programming">Программирование</div>
        <div class="main_title_errors" data-type="filling">Наполнение</div>
    </div>
    <div id="content_errors">
        <?= $this->renderAjax('include/content_errors', [
                'errors' => $errors
        ]); ?>
    </div>
</div>
<!-- окно добавления задачи -->
<div id="modal_form_errors"><!-- Сaмo oкнo -->
    <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
    <div class="container_content_errors">
        <!-- Подгружается контент модалки -->
    </div>
</div>
<div id="overlay"></div><!-- Пoдлoжкa -->

<style>
    .container_errors{
        background: grey;
    }
    #panel .main_title_errors{
        text-align: center;
        width: 33.3%;
        float: left;
        cursor: pointer;
        border-bottom: 1px solid black;
    }
    #content_errors{
        float: left;
        width: 100%;
    }
    .active_content_errors{
        background: green;
    }
</style>