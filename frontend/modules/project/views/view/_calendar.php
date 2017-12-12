<?php
use \talma\widgets\FullCalendar;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

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
        'draggable' => true,
        'droppable' => true,
        'selectable' => true,
        'selectHelper' => true,
        'unselectAuto' => true,
        'disableResizing' => true,
        'editable' => true,
        'events' => $events,
        'id' => 'calendar',
        'select' => new \yii\web\JsExpression("function (start, end, allDay) { // добавление задачи
                var dateStart = new Date(start._d);
                var dateEnds = new Date(end._d);
                var fullDateStart = dateStart.getFullYear()+'-'+(dateStart.getMonth() + 1)+'-'+dateStart.getDate();
                var fullDateEnds = dateEnds.getFullYear()+'-'+(dateEnds.getMonth() + 1)+'-'+(dateEnds.getDate() - 1);
                $('#overlay').fadeIn(400,
                    function(){
                        $('#modal_form')
                            .css('display', 'block')
                            .animate({opacity: 1, top: '50%'}, 200);
                    });
                    $('input[name=\"starts\"]').val(fullDateStart);
                    $('input[name=\"ends\"]').val(fullDateEnds);
            }"),
        'eventClick' => new \yii\web\JsExpression(' //редактирование задачи
                function(event) {
                   $(\'#overlay\').fadeIn(400,
                    function(){
                        $(\'#modal_form_edit\')
                            .css(\'display\', \'block\')
                            .animate({opacity: 1, top: 0, right: 0}, 200);
                    });
                    console.log(event);
                    $("input[name=\'task_id\']").val(event.id);   // получаем id редактируемой задачи    
                    $("input[name=\'title_task_edit\']").val(event.title);   // получаем id редактируемой задачи    
                    $("input[name=\'desc_task_edit\']").val(event.desc);   // получаем id редактируемой задачи    
                                 $.ajax({
                        url: "project/view/task?type=modal",
                        type: "post",
                        dataType: "JSON",
                        data: ({
                            "task_id": event.id
                        }),
                        success: function(data){
                            switch(data.status){
                                case "success":
                                    $(".comment_container").html(data.content);
                                    break;
                            }
                        }
                    });
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
        <?= $form->field($model, 'description')->textarea(['placeholder' => 'Название задачи', 'style' => 'max-width: 400px; min-height: 50px; max-height: 115px'])->label(false); ?>
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
        <?= $form->field($model, 'type')->radioList(['danger' => 'Важная задачв', 'usual' => 'Обычная задача', 'general' => 'Общая задача'])->label('Выбирите важность задачи') ?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary new_task']) ?>
        </div>
        <input type="text" name="starts" value="">
        <input type="text" name="ends" value="">
        <input type="text" name="id" value="">
        <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- окно редактирования задачи -->
<div id="modal_form_edit"><!-- Сaмo oкнo -->
    <span id="modal_close_edit" style="display: none">X</span> <!-- Кнoпкa зaкрыть -->
    <?php $form = ActiveForm::begin(); ?>
    <div class="head">
        <span>Дата</span>
        <span style="float: right">
            <select name="" id="">
                <option value="">Важная</option>
                <option value="">Обычная</option>
                <option value="">Общая</option>
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
    <div class="container">
        <input type="text" value="Название задачи" name="title_task_edit">
        <input type="text" value="Описание задачи" name="desc_task_edit">
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
<style>

</style>