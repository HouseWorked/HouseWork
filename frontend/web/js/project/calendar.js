$(document).off('click', '#modal_form #modal_close, #overlay');
$(document).on('click', '#modal_form #modal_close, #overlay', function(){ //закрытие модалки
    $('#modal_form') // Закрытие модалки добавления задачи
        .animate({opacity: 0, top: '45%'}, 200,
            function(){ // пoсле aнимaции
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
    $('#modal_form_edit') // Закрытие модалки редактирования задачи
        .animate({opacity: 0, top: '0', right: '-10%'}, 200,
            function(){ // пoсле aнимaции
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
                $.ajax({
                    url: 'project/view/task?type=edit',
                    dataType: 'json',
                    data: ({
                        'id': $('input[name="main_project_id"]').val(),
                        'id_project': $('input[name="id"]').val(),
                        'title': $('input[name="title_task_edit"]').val(),
                        'desc': $('input[name="desc_task_edit"]').val(),
                        'performer': $('select[name="select_new_performer"]').val(),
                        'importance': $('select[name="importance"]').val()
                    }),
                    type: 'POST',
                    success: function(data){
                        switch(data.status){
                            case 'success':
                                $('.text_windows_content').html(data.content); // Обновление календаря
                                break;
                        }
                    }
                });
            }
        );
});
// new task
$(document).off('click', '.new_task'); // убираем двойной клик
$(document).on('click', '.new_task', function(e){// Добавление новой задачи
    e.preventDefault();
    var date_start = $('input[name="starts"]').val();
    var date_ends = $('input[name="ends"]').val();
    var performer = $('select[name="Task[user_id]"]').val();
    var title = $('#task-title_task').val();
    var desc = $('#task-description').val();
    var start = date_start+" "+$('#w2').val();
    var ends = date_ends+" "+$('#w3').val();
    var importance = $('input[name="Task[type]"]:checked').val();
    // Проверка полей на пустоту
    var hasEmptyFields = false;
    !performer ? $('.select2-container--krajee .select2-selection').css('border', '1px solid red') : $('.select2-container--krajee .select2-selection').css('border', '1px solid green');
    !title ? $('#task-title_task').css('border', '1px solid red') : $('#task-title_task').css('border', '1px solid green');
    !desc ? $('#task-description').css('border', '1px solid red') : $('#task-description').css('border', '1px solid green');
    if(!title || !desc || !performer){
        hasEmptyFields = true;
    }
    if (hasEmptyFields) {
        $('.errors_block').text('Не все поля заполнены!');
        return false;
    }

    $.ajax({
        url: 'project/view/task?type=add',
        dataType: 'json',
        cache: false,
        data: ({
            'id': $('input[name="main_project_id"]').val(),
            'performer': performer,
            'title': title,
            'desc': desc,
            'start': start,
            'ends': ends,
            'importance': importance
        }),
        type: 'POST',
        success: function(data){
            switch(data.status){
                case 'success':
                    $('.text_windows_content').html(data.content);// Обновление календаря
                    break;
            }
        }
    });
});
// отправкка комментария
$(document).off('click', '#send_comment_task_text'); // убираем двойной клик
$(document).on('click', '#send_comment_task_text', function(e){
    e.preventDefault();
	if($('#comment_task_text').val() == ''){
		return false;
	}
    $.ajax({
        url: 'project/view/task?type=send',
        dataType: 'json',
        cache: false,
        data: ({
            'text': $('#comment_task_text').val(),
            'task_id': $('input[name="task_id"]').val()
        }),
        type: 'POST',
        success: function(data){
            switch(data.status){
                case 'success':
                    $(".comment_container").html(data.content);// Обновление комментариев
                    $('textarea[name="commetn_task_text"]').val('');
                    break;
            }
        }
    });
});
// отправкка комментария комбинацией клавиш
$(document).off('keydown', '#comment_task_text'); // убираем двойной клик
$(document).on('keydown', '#comment_task_text', function(event){

    if (event.ctrlKey && (event.keyCode == 13)) {
        event.preventDefault();
        if($('#comment_task_text').val() == ''){
            return false;
        }
        $.ajax({
            url: 'project/view/task?type=send',
            dataType: 'json',
            cache: false,
            data: ({
                'text': $('#comment_task_text').val(),
                'task_id': $('input[name="task_id"]').val()
            }),
            type: 'POST',
            success: function(data){
                switch(data.status){
                    case 'success':
                        $(".comment_container").after(data.content);// Обновление комментариев
                        $('textarea[name="commetn_task_text"]').val('');
                        break;
                }
            }
        });
    }
});
//Удаление коммента
$(document).off('click', '.delet_comment_from_task');
$(document).on('click', '.delet_comment_from_task', function(){
    $(this).parent().parent().hide();
    $.ajax({
        url: 'project/view/delete-comment?id='+$(this).attr('id'),
        dataType: 'json',
        type: 'POST',
        success: function(data){
            switch(data.status){
                case 'success':
                    console.log(success);


                    break;
            }
        }
    });
});
// Задача выполнена
$(document).off('click', '#complete_task'); // убираем двойной клик
$(document).on('click', '#complete_task', function(e){
    $.ajax({
        url: 'project/view/task?type=complete',
        dataType: 'json',
        data: ({
            'task_id': $('input[name="task_id"]').val()
        }),
        type: 'POST',
        success: function(data){
            switch(data.status){
                case 'success':
                    toastr.success('Задача успешно выполнена');
                    break;
            }
        }
    });
});
// Удаление задачи
$(document).off('click', '#delete_task'); // убираем двойной клик
$(document).on('click', '#delete_task', function(event){
    $.ajax({
        url: 'project/view/task?type=delete',
        dataType: 'json',
        cache: false,
        type: 'POST',
        data: ({
            'id': $('input[name="main_project_id"]').val(),
            'task_id': $('input[name="task_id"]').val()
        }),
        success: function(data){
            switch(data.status){
                case 'success':
                    $('.text_windows_content').html(data.content); // Обновление календаря
                    toastr.warning('Задача удалена');
                    break;
            }
        }
    });
});
// Задача заморождена
$(document).off('click', '#freeze_task'); // убираем двойной клик
$(document).on('click', '#freeze_task', function(e){
    // $.ajax({
    //     url: 'project/view/task?type=send',
    //     dataType: 'json',
    //     data: ({
    //         'task_id': $('input[name="task_id"]').val()
    //     }),
    //     type: 'POST',
    //     success: function(data){
    //         switch(data.status){
    //             case 'success':
    //                 $(".comment_container").after(data.content);// Обновление комментариев
    //                 break;
    //         }
    //     }
    // });
});
