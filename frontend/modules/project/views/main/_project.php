<div class="panel">
    <div class="search">
        <input type="text" placeholder="seacrh..." name="search-project" style="width: 200px" id="">
    </div>
	<button class="btn btn-success" id="add_new_project">Add project</button>
</div>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Название проекта</th>
        <th>Last Name</th>
        <th>Username</th>
    </tr>
    </thead>
    <tbody id="table_body">
    <?= $this->renderAjax('_project-item', [
            'projects' => $projects
    ]) ?>
    </tbody>
</table>
