<div class="gallery-box">
    <div class="view">
        <div class="big-image"><img src="<?= $screen->src?>" alt="image11" ></div>
        <a href="#" class="prev">Назад</a>
        <a href="#" class="next">Вперед</a>
    </div>
    <div class="thumbnails">
        <a href="<?= $screen->src?>" class="active"><img src="<?= $screen->src?>" alt="image11"></a>
        <?php foreach($screens as $key => $screen): ?>
            <a href="<?= $screen->src?>"><img src="<?= $screen->src?>" alt="image11"></a>
        <?php endforeach;?>
    </div>
</div>