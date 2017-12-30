<?= $project->project->title ?>
<?php foreach($teems as $key => $teem):?>
	<?= $teem->user->username ?>
<?php endforeach;?>