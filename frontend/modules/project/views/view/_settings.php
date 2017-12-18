<?php
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

\frontend\assets\ProjectAsset::register($this);
?>
<?php $form = ActiveForm::begin() ?>
    <label for="">Основная информация</label>
    <?= $form->field($modelMain, 'title_project')->textInput(['value' => $modelMain->title])->label(false); ?>
    <?= $form->field($modelMain, 'domains_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($modelDomains, 'id', 'title'),
        'language' => 'ru',
        'options' => ['placeholder' => ($currentDomain->title !== null) ? $currentDomain->title : 'К данному проекту домен все еще не прикреплен'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false);?>
    <label for="">Данные о компании</label>

    <?php if($modelMain->company === null): ?>
        Добавить компанию???
    <?php else:  ?>
        <?= $form->field($modelMain, 'project_responsible_form_fio')->textInput(['value' => $modelMain->company->firstname])->label(false); ?>
        <?= $form->field($modelMain, 'project_responsible_form_phone')->textInput(['value' => $modelMain->company->phone])->label(false); ?>
        <?= $form->field($modelMain, 'project_responsible_form_company')->textInput(['value' => $modelMain->company->title])->label(false); ?>
    <?php endif; ?>
    <label for="">Сроки выполнения проекта</label>
    <?= $form->field($modelMain, 'project_responsible_form_company')->textInput(['value' => 'Здесь выводить сроки проекта'])->label(false); ?>
    <?= Html::button('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>
