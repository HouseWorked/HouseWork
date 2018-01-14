<?php
use \talma\widgets\FullCalendar;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
\frontend\assets\ProjectAsset::register($this);

$design = true;
?>
<div id="table_teem_select">
    <div class="title">Выбор команды</div>
    <?php $form = ActiveForm::begin() ?>
	<?php if(empty($teem_select)): ?>
		Команда еще не выбрана
		<?php else: ?>
		<?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($teem_select, 'id', 'username', 'group'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбирете исполнителя ...', ],
        'pluginOptions' => [
            'allowClear' => true,
            'closeOnSelect' => false
        ],
    ])->label(false);?>
	<?php endif; ?>
    
    <?php ActiveForm::end(); ?>
    <div id="teem_content">
	<?php if(empty($projects)): ?>
		Команда еще не выбрана
		<?php else: ?>
        <?= $this->render('include/teem_content', [
			'projects' => $projects
		]);?>
	<?php endif; ?>
    </div>
</div>
<!-- окно добавления задачи -->
<div id="modal_form" style="z-index: 10001"><!-- Сaмo oкнo -->
    <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
    <div class="container" id="user_info_teem">
    </div>
</div>
<div id="overlay" style="z-index: 10000"></div><!-- Пoдлoжкa -->