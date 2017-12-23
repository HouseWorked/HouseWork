<?php if(empty($errors)): ?>
     Молодцы, давайте дальше так тащить!!!!!
<?php else:?>
    <?php foreach($errors as $key => $error): ?>
        <div class="string_errors_content">
            <?= $error->title ?>
        </div>
    <?php endforeach;?>
<?php endif; ?>
<style>
    .string_errors_content{
        width: 100%;
    }
</style>