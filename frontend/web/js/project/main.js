$(document).off('click', '#add_new_project');
$(document).on('click', '#add_new_project', function(){
    console.log('click');
    $('#overlay').fadeIn(400,
        function(){
            $('#modal_form')
                .css('display', 'block')
                .animate({opacity: 1, top: '50%'}, 200);
        });
    $('#project-date_start').daterangepicker({
        // "singleDatePicker": true,
        "showDropdowns": true,
        "linkedCalendars": false,
        "locale": {
            "format": "DD.MM.YYYY",
            "applyLabel": "Выбрать",
            "cancelLabel": "Отмена",
            "daysOfWeek": [
                "Вс",
                "Пн",
                "Вт",
                "Ср",
                "Чт",
                "Пт",
                "Сб"
            ],
            "monthNames": [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            "firstDay": 1
        }
    }, function(start, end, label) {
        $('input[name="new_start_date"]').val(start.format('YYYY-MM-DD'));
        $('input[name="new_ends_date"]').val(end.format('YYYY-MM-DD'));
        // console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });
});
$(document).off('click', '.submit_new_project');
$(document).on('click', '.submit_new_project', function(e){
    e.preventDefault();
    var title = $('#project-title').val();
    var start = $('input[name="new_start_date"]').val();
    var end = $('input[name="new_ends_date"]').val();
    var type = $('#add_new_project').data('type');
    var company_id = $('select[name="Project[company_id]"]').val();
    var performer = $('select[name="Project[user_id]"]').val();
    $.ajax({
        url: 'project/main/view?type='+type,
        dataType: 'json',
        type: 'POST',
        data: ({
            'title': title,
            'date_start': start,
            'date_end': end,
            'type': type,
            'company_id': company_id,
            'stage_id': 1,
            'performer_id': performer
        }),
        success: function(data){
            switch(data.status){
                case 'success':
                    $('.text_windows_content').html(data.content);
                    $('#add_new_project').attr('data-type', type);
                    break;
                case 'fail':
                    toastr.error(data.content);
                    break;
            }
        }
    });
});
