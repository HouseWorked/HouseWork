<?php
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
\frontend\assets\ProjectAsset::register($this);
?>
<select name="select_new_performer" id="">
    <optgroup label="Программист">
        <?php foreach($performer as $key => $value): ?>
            <?php if($value['group'] == "Программист"): ?>
                <option value = "<?=  $value['id'] ?>" <?= ($task_info->user_id == $value['id']) ? 'selected' : "" ?>><?= $value['username'] ?></option>
            <?php endif; ?>
        <?php endforeach;?>
    </optgroup>
    <optgroup label="Дизайнер">
        <?php foreach($performer as $key => $value): ?>
            <?php if($value['group'] == "Дизайнер"): ?>
                <option value = "<?=  $value['id'] ?>" <?= ($task_info->user_id == $value['id']) ? 'selected' : "" ?>><?= $value['username'] ?></option>
            <?php endif; ?>
        <?php endforeach;?>
    </optgroup>
</select>
<input type="text" value="<?= $task_info->title_task ?>" name="title_task_edit" id="title_task_edit" placeholder="имя задачи">
<input type="text" value="<?= ($task_info->description !== null && !empty($task_info->description)) ? $task_info->description : "" ?>" name="desc_task_edit" id="desc_task_edit" placeholder="Дескриптона не существует">


