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
        <?= $form->field($modelMain, 'project_responsible_form_email')->textInput(['value' => $modelMain->company->email])->label(false); ?>
        <?= $form->field($modelMain, 'project_responsible_form_company')->textInput(['value' => $modelMain->company->title])->label(false); ?>
        <input type="hidden" value="<?= $modelMain->company->id ?>" name="company_id"> <!-- id компании -->
    <?php endif; ?>
<!--    <label for="">Выберите тип проекта</label><br>-->
<!--    <select name="select_type_project" id="">-->
<!--        <option value="1" --><?//= ($modelMain->type == 1) ? 'selected' : "" ?><!-- >Создание сайтов</option>-->
<!--        <option value="2" --><?//= ($modelMain->type == 2) ? 'selected' : "" ?><!-- >Поддержка</option>-->
<!--        <option value="3" --><?//= ($modelMain->type == 3) ? 'selected' : "" ?><!-- >SEO продвижение</option>-->
<!--        <option value="4" --><?//= ($modelMain->type == 4) ? 'selected' : "" ?><!-- >Крупный проект</option>-->
<!--        <option value="5" --><?//= ($modelMain->type == 5) ? 'selected' : "" ?><!-- >Дизайн</option>-->
<!--        <option value="6" --><?//= ($modelMain->type == 6) ? 'selected' : "" ?><!-- >Реклама</option>-->
<!--    </select><br>-->
	<label for="">Выберите стадию проекта</label><br>
    <select name="select_stage_project" id="">
        <option value="1" <?= ($modelMain->stage_id == 1) ? 'selected' : "" ?> >Начальная</option>
        <option value="2" <?= ($modelMain->stage_id == 2) ? 'selected' : "" ?> >ВТорая</option>
        <option value="3" <?= ($modelMain->stage_id == 3) ? 'selected' : "" ?> >Третья</option>
        <option value="4" <?= ($modelMain->stage_id == 4) ? 'selected' : "" ?> >4</option>
    </select><br>
    <label for="">Сроки выполнения проекта</label><br>
	    Начало:
		<input type="text" name="startsDate" value="<?= Yii::$app->formatter->asDate($modelMain->date_start, 'd.M.yyyy') ?>"/>
		Окончание:
        <input type="text" name="endsDate" value="<?= Yii::$app->formatter->asDate($modelMain->date_end, 'd.M.yyyy') ?>"/>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <script type="text/javascript">
            $(document).ready(function(){
                $('input[name="startsDate"]').daterangepicker({
                    "singleDatePicker": true,
                    "opens": "center",
                    "drops": "up",
                    "locale": {
                        "format": "DD.MM.YYYY",
                        "separator": " - ",
                        "applyLabel": "Apply",
                        "cancelLabel": "Cancel",
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
                    }
                });
                $('input[name="endsDate"]').daterangepicker({
                    "singleDatePicker": true,
                    "opens": "center",
                    "drops": "up",
                    "locale": {
                        "format": "DD.MM.YYYY",
                        "separator": " - ",
                        "applyLabel": "Apply",
                        "cancelLabel": "Cancel",
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
                    }
                });
            });
        </script>
	<br>
	<?= Html::button('Сохранить', ['class' => 'btn btn-success send_update_settings_project']) ?>
<?php ActiveForm::end() ?>

