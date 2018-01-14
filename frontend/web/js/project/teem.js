// add new типа
$(document).off('click', '.send_new_teem_chlen');
$(document).on('click', '.send_new_teem_chlen', function(e){
    var id = $('#user_id').data('value');
    $.ajax({
        url: 'project/view/teem',
        type: 'POST',
        dataType: 'JSON',
        data: ({
            'id': $('input[name="main_project_id"]').val(),
            'user_id': id,
        }),
        success: function(data){
            switch(data.status){
                case "success":
                    $('.text_windows_content').html(data.content);
                    break;
            }
        }
    });
});
//delete какого то типа
$(document).off('click', '.delete_chlen_teem');
$(document).on('click', '.delete_chlen_teem', function(){
    $.ajax({
        url: 'project/view/teem',
        type: 'POST',
        dataType: 'JSON',
        data: ({
            'id': $('input[name="main_project_id"]').val(),
            'delete_id': $(this).attr('id')
        }),
        success: function(data){
            switch(data.status){
                case 'success':
                    $('.text_windows_content').html(data.content);
                    break;
            }
        }
    });
});
// Открываем модалку и заполняем инфой о юзере
$(document).off('click', '.select2-results__option');
$(document).on('click', '.select2-results__option', function(e){
    var first_id = $(this).attr('id');
    var lastIndex = first_id.lastIndexOf("-");
    var id = first_id.substr(lastIndex+1);
    $('#overlay').fadeIn(400,
        function(){
            $('#modal_form')
                .css('display', 'block')
                .animate({opacity: 1, top: '50%'}, 200);
        });
    $.ajax({
        url: 'project/view/teem-user-info',
        dataType: 'json',
        data: ({
            'id_user': id
        }),
        type: 'POST',
        success: function(data){
            switch(data.status){
                case 'success':
                    $('#user_info_teem').html(data.content);
                    $('input[name="full_id"]').val(first_id);
                    break;
            }
        }
    });
});

