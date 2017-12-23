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
    <?= $form->field($model, 'user_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($teem_select, 'id', 'username', 'group'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбирете исполнителя ...', ],
        'pluginOptions' => [
            'allowClear' => true,
            'closeOnSelect' => false
        ],
    ])->label(false);?>
    <?php ActiveForm::end(); ?>
    <div id="teem_content">
        <?php if(empty($projects)): ?>
            Команда еще не выбрана
            <?php else:?>
            <div id="programmist_teem_project">
                <label for="">Программист</label>
                <ul>
                    <?php foreach($projects as $key => $project): ?>
                        <?php if($project->user->prof->title === "Программист"): ?>
                            <li><?= $project->user->username ?></li>
                        <?php endif; ?>
                    <?php endforeach;?>
                </ul>
            </div>
            <div id="design_teem_project">
                <label for=""><?= ($design == true) ? "Дизайнер" : 'false'?></label>
                <ul>
                    <?php foreach($projects as $key => $project): ?>

                        <?php if($project->user->prof->title === "Дизайнер"): ?>

                            <li><?= (isset($project->user->username)) ? 'empty' : $project->user->username ?></li>
                            <?php else:?>
                            <li><?= var_dump('asfasd') ?></li>
                        <?php endif; ?>
                    <?php endforeach;?>
                </ul>
            </div>
            <span></span>
        <?php endif; ?>
    </div>
</div>
<script>
    $(document).off('click', '.select2-results__option');
$(document).on('click', '.select2-results__option', function(e){

    var first_id = $(this).attr('id');
    var lastIndex = first_id.lastIndexOf("-");
    var id = first_id.substr(lastIndex+1);
    $('#overlay').fadeIn(400,
        function(){
            $('#modal_form')
                .css('display', 'block')
                .animate({opacity: 1, top: '50%'}, 200);
        });
    $.ajax({
        url: 'project/view/teem-user-info',
        dataType: 'json',
        data: ({
            'id_user': id
        }),
        type: 'POST',
        success: function(data){
            switch(data.status){
                case 'success':
                    $('#user_info_teem').html(data.content);
                    break;
            }
        }
    });
});

</script>
<!-- окно добавления задачи -->
<div id="modal_form" style="z-index: 10001"><!-- Сaмo oкнo -->
    <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
    <div class="container" id="user_info_teem">
    </div>
</div>
<div id="overlay" style="z-index: 10000"></div><!-- Пoдлoжкa -->