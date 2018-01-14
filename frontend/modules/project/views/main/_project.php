<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
\frontend\assets\ProjectAsset::register($this);
?>
<div class="panel">
    <div class="search">
        <input type="text" placeholder="seacrh..." name="search-project" style="width: 200px" id="">
    </div>
	<button class="btn btn-success" id="add_new_project" data-type="">Add project</button>
</div>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Название проекта</th>
        <th>Last Name</th>
        <th>Username</th>
    </tr>
    </thead>
    <tbody id="table_body">
    <?= $this->renderAjax('_project-item', [
            'projects' => $projects
    ]) ?>
    </tbody>
</table>
<!-- окно добавления задачи -->
<div id="modal_form"><!-- Сaмo oкнo -->
    <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
    <input type="hidden" name="new_start_date" value="">
    <input type="hidden" name="new_ends_date" value="">
    <div class="content_add_new_project">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'title')->textInput(['placeholder' => 'Название проекта'])->label(false); ?>
            <?= $form->field($model, 'date_start')->textInput(['placeholder' => 'Начало проекта'])->label(false); ?>
            <?= $form->field($model, 'company_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($companies, 'id', 'title'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выбирете компанию...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label(false); ?>
            <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($users, 'id', 'username'),
                'language' => 'ru',
                'options' => ['placeholder' => 'Выбирете ответственного за проект...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label(false); ?>
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success submit_new_project']); ?>
        <?php ActiveForm::end();?>
    </div>
</div>
<div id="overlay"></div><!-- Пoдлoжкa -->