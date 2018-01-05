<?php if(empty($errors)): ?>
     Молодцы, давайте дальше так тащить!!!!!
<?php else:?>
    <?php foreach($errors as $key => $error): ?>
        <div class="string_errors_content" id="<?= $error->id ?>">
            <?= ($key+1).". ".$error->title ?>
			Обнаружил ошибку - <?= $error->creator->username?>
			В <?= Yii::$app->formatter->asDate($error->create_at, 'd.M.yyyy')?>
        </div>
    <?php endforeach;?>
<?php endif; ?>
<style>
    .string_errors_content{
        width: 100%;
    }
</style>