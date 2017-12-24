<?php
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\time\TimePicker;

\frontend\assets\ProjectAsset::register($this);
?>
<?php $form = ActiveForm::begin() ?>
    <label for="">Основная информация</label>
    <?= $form->field($modelMain, 'title_project')->textInput(['value' => $modelMain->title])->label(false); ?>
    <?php if(isset($modelDomains) && !empty($modelDomains)): ?>
	<?= $form->field($modelMain, 'domains_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($modelDomains, 'id', 'title'),
        'language' => 'ru',
        'options' => ['placeholder' => ($currentDomain->title !== null) ? false : 'К данному проекту домен все еще не прикреплен'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false);?>
	<?php else: ?>
	В базе свободных доменов нет... Добавить новый? <br>
	<?php endif; ?>
    <label for="">Данные о компании</label>

    <?php if($modelMain->company === null): ?>
        <p>Добавить компанию??? или выбрать из существующих</p>
    <?php else:  ?>
        <?= $form->field($modelMain, 'project_responsible_form_fio')->textInput(['value' => $modelMain->company->firstname])->label(false); ?>
        <?= $form->field($modelMain, 'project_responsible_form_phone')->textInput(['value' => $modelMain->company->phone])->label(false); ?>
        <?= $form->field($modelMain, 'project_responsible_form_company')->textInput(['value' => $modelMain->company->title])->label(false); ?>
    <?php endif; ?>
    <label for="">Сроки выполнения проекта</label>
    <?= $form->field($modelMain, 'project_responsible_form_company')->textInput(['value' => 'Здесь выводить сроки проекта'])->label(false); ?>
	
		<input type="text" name="daterange" value="01/01/2015 1:30 PM - 01/01/2015 2:00 PM" id="daterange_edit"/>
        <input type="hidden" value="" name="new_start_date">
        <input type="hidden" value="" name="new_ends_date">
        <input type="hidden" value="" name="id">
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <script type="text/javascript">
            $(document).ready(function(){
                $('input[name="daterange"]').daterangepicker({
                    "showWeekNumbers": true,
                    "timePicker": true,
                    "timePicker24Hour": true,
                    "locale": {
                        "format": "DD.MM.YYYY",
                        "separator": " - ",
                        "applyLabel": "Выбрать",
                        "cancelLabel": "Отмена",
                        "fromLabel": "From",
                        "toLabel": "To",
                        "timePickerIncrement": 5,
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
                    "startDate": "12/06/2017",
                    "endDate": "12/12/2017",
                    "opens": "left"
                }, function(start , end, label) {
                    var hourse_left = ($('.left').find('.hourselect').val() < 10) ? "0"+$('.left').find('.hourselect').val() : $('.left').find('.hourselect').val();
                    var hourse_right = ($('.right').find('.hourselect').val() < 10) ? "0"+$('.right').find('.hourselect').val() : $('.right').find('.hourselect').val();
                    var minute_left = ($('.left').find('.minuteselect').val() < 10) ? "0"+$('.left').find('.minuteselect').val() : $('.left').find('.minuteselect').val();
                    var minute_right = ($('.right').find('.minuteselect').val() < 10) ? "0"+$('.right').find('.minuteselect').val() : $('.right').find('.minuteselect').val();
                    var new_start_date = start.format('YYYY-MM-DD') + " " + hourse_left + ":" + minute_left + ":" + "00";
                    var new_ends_date = end.format('YYYY-MM-DD') + " " + hourse_right + ":" + minute_right + ":" + "00";
                    $('input[name="new_start_date"]').val(new_start_date);
                    $('input[name="new_ends_date"]').val(new_ends_date);
                });

            });
        </script>
	
	<br>
	<?= Html::button('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>
