<?php
// Include config file
require_once "../models/BaseModel.php";
require '../functions.php';
$result = $model->fetchAll('how_did_you_hear');
$how_did_you_hears = $result['rows'];
?>

<?= template_header('feedback List') ?>

<div class="content read">
    <h2>Feedbacks: List</h2>
    <a href="create_feedback.php" class="create-contact">Create Feedback</a>


    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($how_did_you_hears as $how_did_you_hear) : ?>
                <tr>
                    <td><?= $how_did_you_hear['id'] ?></td>
                    <td><?= $how_did_you_hear['name'] ?></td>
                    <td class="actions">
                        <a href="edit_feedback.php?id=<?= $how_did_you_hear['id'] ?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="delete_feedback.php?id=<?= $how_did_you_hear['id'] ?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
            <?php endforeach;
            ?>
        </tbody>
    </table>
</div>

<?= template_footer() ?>