<?php foreach($projects as $key => $project):?>
    <tr class="select_element" id="<?= $project->id ?>">
        <td class="project_title"><?= $project->title ?></td>
        <td>Otto</td>
        <td>@mdo</td>
    </tr>
<?php endforeach;?>