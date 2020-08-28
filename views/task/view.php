<?php
    $this->title = 'View task';

$css = <<< CSS
    th {
        width: 150px;
    }
CSS;
$this->registerCss($css, ["type" => "text/css"], "viewPageStyles");

?>

<h1><?= $this->title ?></h1>

<table class="table table-striped table-bordered">
    <tbody>
        <tr>
            <th>Title</th>
            <td><?= $task->title ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= $task->status->title ?></td>
        </tr>
        <tr>
            <th>Start date</th>
            <td><?= date('Y-m-d h:i:s', $task->start_date) ?></td>
        </tr>
        <tr>
            <th>End date</th>
            <td><?= date('Y-m-d h:i:s', $task->end_date) ?></td>
        </tr>
        <tr>
            <th>Created at</th>
            <td><?= date('Y-m-d h:i:s', $task->created_at) ?></td>
        </tr>
        <tr>
            <th>Updated at</th>
            <td><?= date('Y-m-d h:i:s', $task->updated_at) ?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?= $task->description ?></td>
        </tr>
    </tbody>
</table>
