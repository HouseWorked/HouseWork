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
//открытие оконо типа WINDOWS
$(document).on('click', '.list', function(){
    var type = $(this).data('type');
    console.log($(this).data('type'));
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
                    $('.content_windows').replaceWith(data.page);
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