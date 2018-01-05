<?php
use \talma\widgets\FullCalendar;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
\frontend\assets\ProjectAsset::register($this);
?>
<?php
echo FullCalendar::widget([
    'loading' => 'Carregando...',
    'config' => [
        'lang' => 'ru',
        'header' => [
            'left' => 'prev,next today',
            'center' => 'title',
            'right' => 'month, basicWeek, basicDay,'
        ],
        'events' => $events,
        'id' => 'calendar',
        'draggable' => true,
        'selectable' => true,
        'selectHelper' => true,
        'unselectAuto' => true,
        'editable' => true,
        'droppable' => true,
        'select' => new \yii\web\JsExpression("function (start, end, allDay) { // добавление задачи      
                var testDate = true;
                var dateStart = new Date(start._d);
                var dateEnds = new Date(end._d);
                var dateCurrent = new Date();
                var fullDateStart = dateStart.getFullYear()+'-'+(dateStart.getMonth() + 1)+'-'+dateStart.getDate();              
                var fullDateEnds = dateEnds.getFullYear()+'-'+(dateEnds.getMonth() + 1)+'-'+(dateEnds.getDate() - 1);
                if(dateStart.getFullYear() >= dateCurrent.getFullYear()){ // проверка на прошлый год
                    testDate = true;
                     if((dateStart.getMonth() + 1) >= (dateCurrent.getMonth() + 1)){
                        testDate = true;
                        if(dateStart.getDate() >= dateCurrent.getDate()){
                            testDate = true;
                        }else{
                            testDate = false; // если день меньше текущего
                        }
                     }else{
                        testDate = false; // если месяц меньше текущего
                     }
                }else{
                   testDate = false; // если год меньше текущего
                }
               if(testDate){
                    $('#overlay').fadeIn(400,
                    function(){
                        $('#modal_form')
                            .css('display', 'block')
                            .animate({opacity: 1, top: '50%'}, 200);
                    });
                    $('#task-title_task').val('');
                    $('#task-description').val('');
                    $('input[name=\"starts\"]').val(fullDateStart);
                    $('input[name=\"ends\"]').val(fullDateEnds);       
               }
                        
            }"),
        'eventClick' => new \yii\web\JsExpression(' //редактирование задачи
                function(event) {                                   
                    $(\'#overlay\').fadeIn(400,
                    function(){
                        $(\'#modal_form_edit\')
                            .css(\'display\', \'block\')
                            .animate({opacity: 1, top: 0, right: 0}, 200);
                    });                   
                    $("input[name=\'task_id\']").val(event.id);   // получаем id редактируемой задачи    
                    $("input[name=\'title_task_edit\']").val(event.title);   // получаем название редактируемой задачи    
                    $("input[name=\'desc_task_edit\']").val(event.desc);   // получаем описание редактируемой задачи                    
                    $(\'#importance_edit option\').each(function(){ // получаем важность(тип) задачи
                      if($(this).val() == event.type){
                        $(this).attr(\'selected\', \'selected\');
                      }
                    });    
                    // Получение даты задачи                                                  
                    var dateS = new Date(event.start._i);
                    var dateE = new Date(event.end._i);
                    var full_date_start = dateS.getDate()+"."+(dateS.getMonth() + 1)+"."+dateS.getFullYear();
                    var full_date_end = dateE.getDate()+"."+(dateE.getMonth() + 1)+"."+dateE.getFullYear();
                    
                    
                    var myEndsDate = new Date(event.myDate);  // плагин fullcalendar работает не правильно!! Приходиться мудрить с датой=((
                    var myFulldate = myEndsDate.getDate()+"."+(myEndsDate.getMonth()+1)+"."+myEndsDate.getFullYear()
                    if(full_date_start == full_date_end){
                        $("input[name=\'daterange\']").val(full_date_start + " - " + myFulldate);
                    }else{
                        var full_date_end1 = (dateE.getDate() - 1)+"."+(dateE.getMonth() + 1)+"."+dateE.getFullYear();                 
                        $("input[name=\'daterange\']").val(full_date_start + " - " + myFulldate);
                    }                 
                    
                    if(full_date_start == full_date_end){
                        $("#db_date").html(full_date_start);                     
                    }else{
                        var full_date_start1 = dateS.getDate()+"."+dateE.getMonth()+"."+dateS.getFullYear();
                        var full_date_end1 = (dateE.getDate() - 1)+"."+(dateE.getMonth() + 1)+"."+dateE.getFullYear();
                        $("#db_date").html(full_date_start1+" - "+full_date_end1);                       
                    }
                    $.ajax({
                        url: "project/view/task?type=modal",
                        type: "post",
                        dataType: "JSON",
                        data: ({
                            "project_id": $(\'input[name="main_project_id"]\').val(),
                            "task_id": event.id
                        }),
                        success: function(data){
                            switch(data.status){
                                case "success":
                                    $("#task_info_container").html(data.contentInfo);
                                    $(".comment_container").html(data.content);
                                    $("input[name=\'id\']").val(data.id);
                                    break;
                            }
                        }                  
                    });
                   
                    $(\'input[name="new_start_date"]\').val(event.start._i);
                    $(\'input[name="new_ends_date"]\').val(event.end._i);                                    
                }
            ')
    ],
]);
?>
<!-- окно добавления задачи -->
<div id="modal_form"><!-- Сaмo oкнo -->
    <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
    <div class="container">
        <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'form_project_add',
                    'style' => 'width: 400px; margin-top: 10px'
                ]
        ]); ?>
        <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($users, 'id', 'username', 'group'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выбирете исполнителя ...', ],
                'pluginOptions' => [
                    'allowClear' => true,
            ],
        ])->label(false);?>
        <?= $form->field($model, 'title_task')->textInput(['placeholder' => 'Название задачи'])->label(false); ?>
        <?= $form->field($model, 'description')->textarea(['placeholder' => 'Описание задачи', 'style' => 'max-width: 400px; min-height: 50px; max-height: 115px'])->label(false); ?>
        <div class="errors_block"></div> <!-- Вывод ошибок -->
        <div class="time_picker">
           <ul>
               <li>
                   <?=  TimePicker::widget([
                       'name' => 'start',
                       'pluginOptions' => [
                           'showSeconds' => false,
                           'showMeridian' => false,
                           'minuteStep' => 1,
                       ]
                   ]);?>

               </li>
               <li>
                   <?=  TimePicker::widget([
                       'name' => 'end',
                       'pluginOptions' => [
                           'showSeconds' => false,
                           'showMeridian' => false,
                           'minuteStep' => 1,
                       ]
                   ]);?>

               </li>
           </ul>
       </div>
       <?php $model->type = 'danger'; ?>
        <?= $form->field($model, 'type')->radioList(['danger' => 'Важная задачв', 'usual' => 'Обычная задача', 'general' => 'Общая задача'])->label('Выбирите важность задачи') ?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary new_task']) ?>
        </div>
        <input type="hidden" name="starts" value="">
        <input type="hidden" name="ends" value="">
        <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- окно редактирования задачи -->
<div id="modal_form_edit"><!-- Сaмo oкнo -->
    <span id="modal_close_edit" style="display: none">X</span> <!-- Кнoпкa зaкрыть -->
    <?php $form = ActiveForm::begin(); ?>
    <div class="head">
        <input type="text" name="daterange" value="" id="daterange_edit"/>
        <input type="hidden" value="" name="id"> <!-- поля для хранения id задачи -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('input[name="daterange"]').daterangepicker({
                    "showWeekNumbers": true,
                    "timePicker": true,
                    "timePicker24Hour": true,
                    "timePickerIncrement": 30,
                    "locale": {
                        "format": "DD.MM.YYYY",
                        "separator": " - ",
                        "applyLabel": "Выбрать",
                        "cancelLabel": "Отмена",
                        "fromLabel": "From",
                        "toLabel": "To",
                        "customRangeLabel": "Custom",
                        "weekLabel": "W",
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
                    },
                    "opens": "left"
                }, function(start , end, ranges) {
                    var new_start_date = start.format('YYYY-MM-DD H:m:s');
                    var new_ends_date = end.format('YYYY-MM-DD H:m:s');

                    $.ajax({
                        url: 'project/view/task?type=edit',
                        dataType: 'json',
                        type: 'POST',
                        data: ({
                            'id': $('input[name="main_project_id"]').val(),
                            'id_project': $('input[name="id"]').val(),
                            'newStart': new_start_date,
                            'newEnds': new_ends_date
                        }),
                        success: function(data){
                            switch(data.status){
                                case 'success':
                                    break;
                            }
                        }
                    });
                });

            });
        </script>
        <style>
            body > div.daterangepicker.dropdown-menu.ltr.show-calendar.opensleft > div.ranges{ /*убираем кнопки управлвление в плагине календаря*/
                display: none;
            }
        </style>
        <span style="float: right">
            <select name="importance" id="importance_edit">
                <option value="danger">Важная</option>
                <option value="usual">Обычная</option>
                <option value="general">Общая</option>
            </select>
        </span>
    </div>
    <div class="head_sub">
        <span>Напоминание</span>
        <span>
            <label><input type="checkbox" title="ПН">ПН</label>
            <label><input type="checkbox" title="ВТ">ВТ</label>
            <label><input type="checkbox" title="СР">СР</label>
            <label><input type="checkbox" title="ЧТ">ЧТ</label>
            <label><input type="checkbox" title="ПТ">ПТ</label>
            <label><input type="checkbox" title="СБ">СБ</label>
            <label><input type="checkbox" title="ВС">ВС</label>
        </span>
        <span style="float: right">
            <select name="" id="">
                <option value="">08:00</option>
                <option value="">09:00</option>
                <option value="">10:00</option>
                <option value="">11:00</option>
                <option value="">12:00</option>
                <option value="">13:00</option>
                <option value="">14:00</option>
                <option value="">15:00</option>
                <option value="">16:00</option>
                <option value="">17:00</option>
                <option value="">18:00</option>
                <option value="">19:00</option>
                <option value="">20:00</option>
                <option value="">21:00</option>
                <option value="">22:00</option>
                <option value="">23:00</option>
            </select>
        </span>
    </div>
    <div class="container" id="task_info_container">
        Контент с инфой о задачи
    </div>
    <div class="comment">
        <div class="comment_container">
            Комментарии
        </div>
        <input type="button"  id="send_comment_task_text" value="send">
        <div class="comment_create_block">
            <img src="" alt="Фото текущего юзера">
            <textarea name="commetn_task_text" id="comment_task_text" cols="30" rows="10" placeholder="Ваш комментарий"></textarea>
        </div>
        <input type="hidden" name="task_id">
    </div>
    <?php ActiveForm::end(); ?>
</div>
<div id="overlay"></div><!-- Пoдлoжкa -->