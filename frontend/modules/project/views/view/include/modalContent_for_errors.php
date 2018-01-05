<?php foreach($screens as $key => $screen): ?>
    <img src="<?= $screen->src?>" alt="картинки" data-key="<?= $key ?>" class="screen_error_img"><br>
<?php endforeach;?>