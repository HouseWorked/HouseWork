$(document).ready(function(){

});
// Открытие в главном окне
$(document).on('click', '.controller', function(){
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
// Открытие страницы с подробной информацией
$(document).off('click', '.project');
$(document).on('click', '.project', function(){
    var id = $(this).attr('id');
    $.ajax({
        url: 'project/view/index?id='+id,
        type: 'POST',
        dataType: 'JSON',
        success: function(data){
            switch(data.status){
                case 'success':
                    $('.ajax_windows_content').html(data.page);
                    break;
                case 'fail':
                    break;
            }
        }
    });
});
// Открытие окон в части подробной информации
$(document).off('click', '.view_project');
$(document).on('click', '.view_project', function(){
    var id = $(this).attr('id');
    var type = $(this).data('type');
    $.ajax({
        url: 'project/view/'+type,
        type: 'POST',
        dataType: 'JSON',
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
$(document).on('keyup', '.search', function(e){
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