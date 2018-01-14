<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
\frontend\assets\CrmAsset::register($this);
?>
<div id="edit_data">
<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'username')->textInput(['placeholder' => 'Введите название команды'])->label(false); ?>
	<?= $form->field($model, 'password_hash')->textInput(['placeholder' => 'Сменить главу команды'])->label(false); ?>
	<?= Html::button('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end();?>
В случае если вам все надоело, можете <span style="color:red;">удалить</span> свою команду!
</div>
<div id="edit_info">
	Блок с безумно важной информацией. Осталось только эту важную инфу придумать))) Ну ниче... Все еще впереди у нас=)
</div>