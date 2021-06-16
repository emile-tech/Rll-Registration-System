<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';
$result = $model->fetchAll('meeting');
$meetings = $result['rows'];
?>

<?= template_header('Meeting List') ?>

<div class="content read">
    <h2>Meetings: List</h2>
    <a href="create_meeting.php" class="create-contact">Create Meeting</a>


    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Theme</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($meetings as $meeting) : ?>
                <tr>
                    <td><?= $meeting['id'] ?></td>
                    <td><?= $meeting['name'] ?></td>
                    <td><?= $meeting['theme'] ?></td>
                    <td class="actions">
                        <a href="edit_meeting.php?id=<?= $meeting['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete_meeting.php?id=<?= $meeting['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach;
            ?>
        </tbody>
    </table>
</div>

<?= template_footer() ?>