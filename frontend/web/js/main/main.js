$(document).ready(function(){
    // Диалоговое окно
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in',
        preloader: false,
        modal: true
    });
    // Draggable
    $(".container_windows").draggable({
        containment: 'parent',
        cancel: '.text_windows_content'
    });
    // $(".container_windows").resizable();
});

//Настройки рабочего стола
$('.footer').css('margin-top', $(window).height() - 40); // Пуск
$('.menu').css('display', 'none'); // Меню
$('.container_windows').hide();//окно windows
    //ЗАгрузка страницы
$(window).on('load', function () {
    var $preloader = $('#p_prldr'),
        $svg_anm   = $preloader.find('.svg_anm');
    $svg_anm.fadeOut();
    $preloader.delay(500).fadeOut('slow');
});
$(document).on('load', '.text_windows_content', function () {
    // var $preloader = $('#p_prldr'),
    //     $svg_anm   = $preloader.find('.svg_anm');
    // $svg_anm.fadeOut();
    // $preloader.delay(500).fadeOut('slow');
    console.log('load content');
});

$(window).resize(function(){
    console.log($(window).height()+"x"+$(window).width());
    $('.wrapper').css('min-width', $(window).width() - 1);
    $('.wrapper').css('max-width', $(window).width());
    $('.wrapper').css('min-height', $(window).height() - 1);
    $('.wrapper').css('max-height', $(window).height());
    $('.footer').css('margin-top', $(window).height() - 40);

});
// end

// Открывае/Закрываем меню
$(document).on('click', '#toggle_menu', function(){
    $('.menu').toggle();
});
$(document).on('click', '.content', function(){
    $('.menu').hide();
});
// end

// модалка
    //главные настройки
$(document).on('click', '.popup-modal-dismiss', function(e) {
    e.preventDefault();
    $.magnificPopup.close();
});
//end
//fullscreen
$("#fullscreen").on("click", function(e) {
    if (screenfull.enabled) {
        // We can use `this` since we want the clicked element
        screenfull.toggle();
    }
});
//end
//close windows container
$("#close_windows").on("click", function(e) {
    $('.container_windows').hide();
});
//end

/*  AJAX  */
    //Работа с окнами
    $(document).on('click', '#back_windows', function(){ // кнопка назад
        var backType = $('#back_windows').attr('class');
        console.log(backType);
    });
    $(document).on('click', '.list', function(){ // Открытие главного окна
        var type = $(this).data('type');
        $.ajax({
            url: type+'/main/index',
            type: 'POST',
            dataType: 'JSON',
            data: ({
                'type': type
            }),
            success: function(data){
                switch(data.status){
                    case 'success':
                        $('.container_windows').show();
                        $('.content_windows').html(data.page);
                        $('.menu').hide();
                        break;
                    case 'fail':
                        break;
                }
            },
            error: function(){
                toastr.error('Файла нет');
            }
        });
    });
    $(document).on('click', '.select_left_menu', function(){// Открытие окон в главном окне (при выборе в левом меню)
        var type = $(this).data('type');
        $.ajax({
            url: 'project/main/view?type='+type,
            type: 'POST',
            dataType: 'JSON',
            success: function(data){
                switch(data.status){
                    case 'success':
                        $('.text_windows_content').html(data.content);
                        $('.search').find('input[name="search-project"]').attr('id', data.type);
                        break;
                    case 'fail':
                        break;
                }
            }
        });
    });
    $(document).off('click', '.select_element');// Открытие страницы с подробной информацией о элементе
    $(document).on('click', '.select_element', function(){
        var id = $(this).attr('id');
        $.ajax({
            url: 'project/view/index?id='+id,
            type: 'POST',
            dataType: 'JSON',
            success: function(data){
                switch(data.status){
                    case 'success':
                        $('.ajax_windows_content').html(data.page);
                        $('#back_windows').attr('class', 'backkkkkk');
                        break;
                    case 'fail':
                        break;
                }
            }
        });
    });
    $(document).off('click', '.view_element');// Открытие окон в части  "Подробная информация"
    $(document).on('click', '.view_element', function(){
        var id = $(this).attr('id');
        var type = $(this).data('type');
        $.ajax({
            url: 'project/view/'+type,
            type: 'POST',
            dataType: 'JSON',
            data: ({
                'id': $('input[name="main_project_id"]').val()
            }),
            success: function(data){
                switch(data.status){
                    case 'success':
                        $('.text_windows_content').html(data.content);
                        break;
                    case 'fail':
                        break;
                }
            }
        });
    });
    $(document).on('keyup', '.search', function(e){ // функция поиска
        $.ajax({
            url: 'project/main/project-search?search='+$(this).find('input').val(),
            type: 'POST',
            dataType: 'JSON',
            data: ({
                'type': $(this).find('input[name="search-project"]').attr('id')
            }),
            success: function(data){
                switch(data.status){
                    case 'success':
                        $('#table_body').html(data.content);
                        break;
                    case 'fail':
                        break;
                }
            }
        });

    });