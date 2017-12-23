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
</style>
<script>
    $(document).off('click', '.main_title_errors');
    $(document).on('click', '.main_title_errors', function(){
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
</script>