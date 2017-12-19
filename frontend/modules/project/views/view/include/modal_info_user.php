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
    <table>
        <tr>
            <td>Название проекта</td>
            <td>Статус</td>
        </tr>
        <?php foreach($projects as $key => $project): ?>
        <tr>
            <td><?= $project->project->title ?></td>
            <td>Статус</td>
        <tr>
        <?php endforeach;?>
    </table>
    <?= Html::button('Добавить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>