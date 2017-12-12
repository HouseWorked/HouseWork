<?php if($type == 'new'): ?>
    <div class="comment_block">
        <img src="" alt="Фото">
        <div class="comment_title">
            <?=  $comments->creator->username ?>
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
            </div>
            <div class="comment_text">
                <?=  $comment->text ?>
            </div>
        </div>
    <?php endforeach;?>
<?php endif; ?>


