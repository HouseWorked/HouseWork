<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
\frontend\assets\CrmAsset::register($this);
?>
<div id="edit_data">
<?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'username')->textInput(['placeholder' => 'Введите новое имя'])->label(false); ?>
	<?= $form->field($model, 'password_hash')->textInput(['placeholder' => 'Введите новый пароль'])->label(false); ?>
	<?= $form->field($model, 'email')->textInput(['placeholder' => 'Введите новый email'])->label(false); ?>
	<?= $form->field($model, 'phone')->textInput(['placeholder' => 'Введите новый номер телефона'])->label(false); ?>
	<?= $form->field($model, 'vk')->textInput(['placeholder' => 'Введите id Вконтакте'])->label(false); ?>
	<?= $form->field($model, 'facebook')->textInput(['placeholder' => 'Введите '])->label(false); ?>
	<?= $form->field($model, 'skype')->textInput(['placeholder' => 'Введите новый номер телефона'])->label(false); ?>
	<?= $form->field($model, 'instagram')->textInput(['placeholder' => 'Введите новый номер телефона'])->label(false); ?>
	<?= $form->field($model, 'odnoklassniki')->textInput(['placeholder' => 'Введите новый номер телефона'])->label(false); ?>
	<?= Html::button('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end();?>
</div>
<div id="edit_info">
	Блок с безумно важной информацией. Осталось только эту важную инфу придумать))) Ну ниче... Все еще впереди у нас=)
</div>