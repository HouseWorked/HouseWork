$(document).off('click', '.send_update_settings_project');
$(document).on('click', '.send_update_settings_project', function(){
    var name_project = $('#project-title_project').val(); // Название проекта
    var new_date_start = $('input[name="startsDate"]').val(); // Начало
    var new_date_ends = $('input[name="endsDate"]').val(); // Конец
    var domain_id = $('#project-domains_id').val(); //домены
    var project_type = $('select[name="select_type_project"]').val(); // тип проекта
    // Данные компнаии
    var id_company = $('input[name="company_id"]').val(); // ID привязанной компании
    var responsible_name = $('#project-project_responsible_form_fio').val(); // ФИО ответственного
    var responsible_phone = $('#project-project_responsible_form_phone').val(); // номер телефона ответственного
    var responsible_email = $('#project-project_responsible_form_email').val(); // email ответственного
    var name_company = $('#project-project_responsible_form_company').val(); // Название компании
    console.log(new_date_start + " > " + new_date_ends);

    $.ajax({
        url: 'project/view/save-settings',
        dataType: 'json',
        type: 'POST',
        data: ({
            'project_id': $('input[name="main_project_id"]').val(),
            'name_project': name_project,
            'domain_id': domain_id,
            'new_date_start': new_date_start,
            'new_date_ends': new_date_ends,
            'responsible_name': responsible_name,
            'responsible_phone': responsible_phone,
            'name_company': name_company,
            'responsible_email': responsible_email,
            'project_type': project_type,
            'id_company': id_company
        }),
        success: function(data){
            switch(data.status){
                case 'success':
                    toastr.success(data.content);
                    break;
                case 'error':
                    toastr.error(data.content);
                    break;
            }
        },
        error: function(){
            toastr.error('Выбран не верный диапазон дат');
        }
    });
});