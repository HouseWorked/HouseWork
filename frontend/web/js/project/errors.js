$(document).ready(function(){
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