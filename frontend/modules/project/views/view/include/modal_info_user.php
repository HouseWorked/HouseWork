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
    <span id = "user_id" data-value = "<?= $users->id ?>"><?= $users->username ?></span><br>
    <label for="">Должность члена команды</label><br>
    <span id = "prof_label"><?= $users->prof->title ?></span><br>
    <label for="">Преокты, в которых участвует</label><br>
	<?php if(!empty($projects)):?>
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
	<?php else: ?>
	В проектах не участвует <br>
	<?php endif;?>
    <?= Html::button('Добавить', ['class' => 'btn btn-success send_new_teem_chlen']) ?>
<?php ActiveForm::end(); ?>