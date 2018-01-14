<?php if($type == 'new'): ?>
    <div class="comment_block">
        <img src="" alt="Фото">
        <div class="comment_title">
            <?=  $comments->creator->username ?>
            время создания кммента <?= yii::$app->formatter->asDate($comments->create_at, 'dd-M-Y H:i') ?>
            <span class="delet_comment_from_task" id="<?= $comments->id ?>">Удалить комментарий</span>
        </div>
        <div class="comment_text">
            <?=  $comments->text ?>
        </div>
    </div>
    <?php else: ?>
    <?php foreach($comments as $key => $comment): ?>
        <div class="comment_block">
            <img src="" alt="Фото">
            <div class="comment_title">
                <?=  $comment->creator->username ?>
                время создания кммента <?= yii::$app->formatter->asDate($comment->create_at, 'dd-M-Y H:i') ?>
                <span class="delet_comment_from_task" id="<?= $comment->id ?>">Удалить комментарий</span>
            </div>
            <div class="comment_text">
                <?=  $comment->text ?>
            </div>
        </div>
    <?php endforeach;?>
<?php endif; ?>