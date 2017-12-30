<?php
\frontend\assets\CiteAsset::register($this);
?>
<div class="ajax_windows_content" style="min-height: 600px">
    <div id = "top_block">
		<div id = "search">
			<input type = "text" placeholder = "search...">
		</div>
		<div id = "button_group">
			<input type = "button"value = "Добавить домен">
		</div>
	</div>
    <div class="text_windows_content" style="min-width: 99%; width:100%">
		<table>
			<tr>
				<td>Название домена</td>
				<td>Название проекта, к которому прикреплен</td>
				<!-- <td>SSL cert</td>
				<td>Yandex metrica</td>
				<td>Google analytics</td> -->
			</tr>
			<?php foreach($model as $key => $domain):?>
				<tr class = "select_element" id = "<?= $domain->id?>">
					<td><?= $domain->title ?></td>
					<td><?= ($domain->project_id != null) ? $domain->project->title : "Домен свободен"?></td>
				</tr>
			<?php endforeach;?>
		</table>
    </div>
</div>
<style>
#top_block{
	float: left;
}
#button_group{
	float: right;
}
</style>