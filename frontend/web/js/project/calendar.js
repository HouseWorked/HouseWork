$(document).on('click', '#modal_close, #overlay', function(){ //закрытие модалки добавления новой задачи
    $('#modal_form')
        .animate({opacity: 0, top: '45%'}, 200,
            function(){ // пoсле aнимaции
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
    $('#modal_form_edit')
        .animate({opacity: 0, top: '0', right: '-10%'}, 200,
            function(){ // пoсле aнимaции
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
});
// $(document).on('click', '#overlay', function(){ //закрытие модалки редактирвоание
//     $('#modal_form_edit')
//         .animate({opacity: 0, top: '0', right: '-10%'}, 200,
//             function(){ // пoсле aнимaции
//                 $(this).css('display', 'none');
//                 $('#overlay').fadeOut(400);
//             }
//         );
// });
// new task
$(document).off('click', '.new_task'); // убираем двойной клик
$(document).on('click', '.new_task', function(e){
    e.preventDefault();
    var date_start = $('input[name="starts"]').val();
    var date_ends = $('input[name="ends"]').val();

    var performer = $('select[name="Task[user_id]"]').val();
    var title = $('#task-title_task').val();
    var desc = $('#task-description').val();
    var start = date_start+" "+$('#w2').val();
    var ends = date_ends+" "+$('#w3').val();
    var importance = $('input[name="Task[type]"]:checked').val();
    $.ajax({
        url: 'project/view/task?type=add',
        dataType: 'json',
        data: ({
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
                    $('.text_windows_content').html(data.content);
                    // $('input[name="id"]').val(data.lastEventsID);
                    break;
            }
        }
    });
});
// отправкка комментария
$(document).off('click', '#send_comment_task_text'); // убираем двойной клик
$(document).on('click', '#send_comment_task_text', function(e){
    e.preventDefault();

    $.ajax({
        url: 'project/view/task?type=send',
        dataType: 'json',
        data: ({
            'text': $('#comment_task_text').val(),
            'task_id': $('input[name="task_id"]').val()
        }),
        type: 'POST',
        success: function(data){
            switch(data.status){
                case 'success':
                    console.log(data.content);
                    $(".comment_container").after(data.content);
                    break;
            }
        }
    });
});