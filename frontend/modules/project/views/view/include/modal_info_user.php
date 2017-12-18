<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'form_project_add',
        'style' => 'width: 400px; margin-top: 10px'
    ]
]); ?>
    <label for="">Имя члена команды</label><br>
    <?= $users->user->username ?><br>
    <label for="">Должность члена команды</label><br>
    <?= $users->user->prof->title ?><br>
    <label for="">Преокты, в которых участвует</label><br>
    <?php foreach($projects as $key => $project): ?>
        <?= $project->project->title ?><br>
    <?php endforeach;?>
    <?= Html::button('Добавить', ['class' => 'btn btn-success']) ?>
    <?= Html::button('Назад', ['class' => 'btn']) ?>
<?php ActiveForm::end(); ?>