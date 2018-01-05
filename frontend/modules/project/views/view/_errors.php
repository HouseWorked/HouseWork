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
    #modal_form_errors{
        overflow-y: hidden;
    }
    .container_content_errors img{
        width: 100%;
        height: 100%;
    }
    #prev, #next{
        position: absolute;
    }
</style>
<!-- окно добавления задачи -->

<div id="modal_form_errors"><!-- Сaмo oкнo -->
    <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
    <span id="prev">prev</span>
    <span id="next">next</span>
    <div class="container_content_errors">
        dsfsdfsdfsdfs
    </div>
</div>
<script>
    $(document).off('click', '.string_errors_content',);
    $(document).on('click', '.string_errors_content', function(){// открытие модалки и заполнение ее контентом
        $('#overlay').fadeIn(400,
            function(){
                $('#modal_form_errors')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '50%'}, 200);
            });
        $.ajax({
            url: 'project/view/modal-error-content',
            dataType: 'json',
            type: 'POST',
            data: ({
                'error_id': $(this).attr('id')
            }),
            success: function(data){
                switch(data.status){
                    case 'success':
                        $('#modal_form_errors .container_content_errors').html(data.content);
                        break;
                }
            }
        });
    });
    $(document).off('click', '.main_title_errors');
    $(document).on('click', '.main_title_errors', function(){// Переключение между типами ошибок
        $('.main_title_errors').removeClass('active_content_errors'); //Удаляем у всех класс фсешму
        $(this).addClass('active_content_errors'); // Добавляем текущему класс фсешму
        var type = $(this).data('type'); // Принимаем значение ошибки
        $.ajax({
            url: 'project/view/errors-project',
            dataType: 'json',
            data: ({ 
                'type_errors': type,
                'project_id': $('input[name="main_project_id"]').val() // id текущего проекта
            }),
            type: 'POST',
            success: function(data){
                switch(data.status){
                    case 'success':
                        $('#content_errors').html(data.content); // Замена на полученный ответ относительно выбранного типа ошибки
                        break;
                }
            }
        });
    });
    var id = 0;
    $(document).off('click', '.screen_error_img');
    $(document).on('click', '.screen_error_img', function(){// галерея. Кнопка вперед
        id = $(this).data('key');
    });
    $(document).off('click', '#prev');
    $(document).on('click', '#prev', function(){// галерея. Кнопка вперед
        console.log(id);
    });



</script>
<div id="overlay"></div><!-- Пoдлoжкa -->