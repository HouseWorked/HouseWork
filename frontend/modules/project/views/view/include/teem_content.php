<div id="programmist_teem_project">
	<label for="">Программист</label>
	<ul>
		<?php foreach($projects as $key => $project): ?>
			<?php if($project->user->prof->title === "Программист"): ?>
				<li><?= $project->user->username ?><span class = "delete_chlen_teem" id = "<?= $project->user->id ?>">x</span></li>
				<?php $programmer[] = [$project->user->prof->title];?>
			<?php endif; ?>
		<?php endforeach;?>
		<?= ($programmer === null) ? "На данный проект программист не назначен" : ""; ?>
	</ul>
</div>
<div id="design_teem_project">
	<label for="">Дизайнер</label>
	<ul>
		<?php foreach($projects as $key => $project): ?>
			<?php if($project->user->prof->title === "Дизайнер"): ?>
				<li><?= $project->user->username ?><span class = "delete_chlen_teem" id = "<?= $project->user->id ?>">x</span></li>
				<?php $design[] = [$project->user->prof->title];?>
			<?php endif; ?>
		<?php endforeach;?>
		<?= ($design === null) ? "На данный проект дизайнер не назначен" : ""; ?>
	</ul>
</div>