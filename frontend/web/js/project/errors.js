$(document).ready(function(){
    $(document).off('click', '.string_errors_content');
    $(document).on('click', '.string_errors_content', function(){// открытие модалки и заполнение ее контентом
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
                        $('#overlay').fadeIn(400,
                            function(){
                                $('#modal_form_errors')
                                    .css('display', 'block')
                                    .animate({opacity: 1, top: '50%'}, 200);
                            });
                        $('#modal_form_errors .container_content_errors').html(data.content);
                        break;
                    case 'fail':
                        toastr.warning(data.content);
                        break;
                }
            }
        });
    });
    $(document).off('click', '#modal_close, #overlay');
    $(document).on('click', '#modal_close, #overlay', function(){ //закрытие модалки
        $('#modal_form_errors') // Закрытие модалки добавления задачи
            .animate({opacity: 0, top: '45%'}, 200,
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
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
//Galery
$(document).off('click', '.next');
$(document).on('click', '.next', function(){// галерея. Кнопка вперед
    var count = $('.thumbnails a').length;                             // Общее количество изображений
    var n = parseInt($('.thumbnails a').index($('.active')) + 1);      // Порядковый номер текущего изображения
    var activeImg = $('.thumbnails .active');                          // Активное на данный момент изображение
    var nextSrc;

    if (count != n){                                                   // - Если изображение не последнее
        nextSrc = activeImg.next().find('img').attr('src');            // В переменную записывается адрес следующего изображения
        $('.thumbnails .active').removeClass('active');                // Удаляется класс .active с предыдущей миниатюры
        activeImg.next().addClass('active');                           // На миниатюру следующего изображения вешается класс .active
    }else{                                                             // - Если текущее изображение последнее в списке
        nextSrc = $('.thumbnails a').first().find('img').attr('src');  // В переменную записывается адрес первого изображения
        $('.thumbnails .active').removeClass('active');                // Удаляется класс .active с предыдущей миниатюры
        $('.thumbnails a').first().addClass('active');                 // На первую миниатюру вешается класс .active
    }
    $('.big-image img').attr({ src: nextSrc });                        // Подменяем адрес большого изображения на адрес следующего
    return false;
});
$(document).off('click', '.prev');
$(document).on('click', '.prev', function(){// галерея. Кнопка вперед
    var count = $('.thumbnails a').length;                             // Общее количество изображений
    var n = parseInt($('.thumbnails a').index($('.active')) + 1);      // Порядковый номер текущего изображения
    var activeImg = $('.thumbnails .active');                          // Активное на данный момент изображение
    var prevSrc;

    if (n != 1){                                                       // - Если текущее изображение не первое
        prevSrc = activeImg.prev().find('img').attr('src');            // В переменную записывается адрес предыдущего изображения
        $('.thumbnails .active').removeClass('active');                // Удаляется класс .active активной до этого миниатюры
        activeImg.prev().addClass('active');                           // На миниатюру изображения слева вешается класс .active
    }else{                                                             // - Если текущее изображение первое
        prevSrc = $('.thumbnails a:last').find('img').attr('src');     // В переменную записывается адрес последнего изображения
        $('.thumbnails .active').removeClass('active');                // Удаляется класс .active с предыдущей миниатюры
        $('.thumbnails a:last').addClass('active');                    // На последнюю миниатюру вешается класс .active
    }
    $('.big-image img').attr({ src: prevSrc });                        // Подменяется адрес большого изображения на адрес следующего
    return false;
});
